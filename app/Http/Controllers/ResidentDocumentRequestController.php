<?php

namespace App\Http\Controllers;

use App\Models\DocumentRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResidentDocumentRequestController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Request Document Form
    |--------------------------------------------------------------------------
    */

    public function create(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user
            && $user->role === 'resident'
            && $user->resident_id
            && $user->resident,
            403
        );

        $resident = $user->resident;

        $nextRequestNumber =
            $this->generateRequestNumber();

        return view(
            'resident_portal.requests.create',
            compact(
                'resident',
                'nextRequestNumber'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Submit Document Request
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user
            && $user->role === 'resident'
            && $user->resident_id
            && $user->resident,
            403
        );

        $validated = $request->validate([

            'document_type' => [
                'required',
                Rule::in(
                    $this->documentTypes()
                ),
            ],

            'purpose' => [
                'required',
                'string',
                'max:1000',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | System-controlled information
        |--------------------------------------------------------------------------
        |
        | Resident does NOT choose:
        |
        | - resident_id
        | - request_number
        | - date_requested
        | - status
        |
        */

        $documentRequest = DocumentRequest::create([

            'request_number' =>
                $this->generateRequestNumber(),

            'resident_id' =>
                $user->resident_id,

            'document_type' =>
                $validated['document_type'],

            'purpose' =>
                $validated['purpose'],

            'date_requested' =>
                now('Asia/Manila')->toDateString(),

            'status' =>
                'Pending',

        ]);


        return redirect()
            ->route('resident.portal')
            ->with(
                'success',
                'Your document request '
                . $documentRequest->request_number
                . ' was submitted successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Available Document Types
    |--------------------------------------------------------------------------
    */

    private function documentTypes(): array
    {
        return [
            'Barangay Clearance',
            'Certificate of Residency',
            'Certificate of Indigency',
            'Barangay Certification',
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Generate Request Number
    |--------------------------------------------------------------------------
    |
    | Example:
    |
    | REQ-2026-00001
    | REQ-2026-00002
    |
    */

    private function generateRequestNumber(): string
    {
        $year =
            now('Asia/Manila')
                ->format('Y');


        $prefix =
            'REQ-' . $year . '-';


        $lastRequest =
            DocumentRequest::query()

                ->where(
                    'request_number',
                    'like',
                    $prefix . '%'
                )

                ->orderByRaw(
                    "CAST(SUBSTRING_INDEX(request_number, '-', -1) AS UNSIGNED) DESC"
                )

                ->value(
                    'request_number'
                );


        if (!$lastRequest) {

            $nextNumber = 1;

        } else {

            $lastNumber =
                (int) substr(
                    $lastRequest,
                    -5
                );

            $nextNumber =
                $lastNumber + 1;
        }


        return $prefix
            . str_pad(
                $nextNumber,
                5,
                '0',
                STR_PAD_LEFT
            );
    }
}