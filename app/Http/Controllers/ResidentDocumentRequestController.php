<?php

namespace App\Http\Controllers;

use App\Models\DocumentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ResidentDocumentRequestController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | My Requests
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $resident =
            $this->resident();


        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $baseQuery =
            DocumentRequest::query()
                ->where(
                    'resident_id',
                    $resident->id
                );


        $totalRequests =
            (clone $baseQuery)
                ->count();


        $pendingRequests =
            (clone $baseQuery)
                ->where(
                    'status',
                    'Pending'
                )
                ->count();


        $processingRequests =
            (clone $baseQuery)
                ->where(
                    'status',
                    'Processing'
                )
                ->count();


        $readyRequests =
            (clone $baseQuery)
                ->whereIn(
                    'status',
                    [
                        'Ready for Release',
                        'Released',
                    ]
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | Resident Requests
        |--------------------------------------------------------------------------
        */

        $requests =
            DocumentRequest::query()

                ->where(
                    'resident_id',
                    $resident->id
                )

                ->latest(
                    'date_requested'
                )

                ->latest(
                    'id'
                )

                ->paginate(10);


        return view(
            'resident_portal.requests.index',
            compact(
                'resident',
                'requests',
                'totalRequests',
                'pendingRequests',
                'processingRequests',
                'readyRequests'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Request Document Form
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $resident =
            $this->resident();


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

    public function store(
        Request $request
    ) {
        $resident =
            $this->resident();


        /*
        |--------------------------------------------------------------------------
        | Resident Input Validation
        |--------------------------------------------------------------------------
        |
        | Resident cannot choose:
        |
        | - resident_id
        | - request_number
        | - date_requested
        | - status
        |
        | Those fields are controlled by the system.
        |
        */

        $validated =
            $request->validate([

                'document_type' => [
                    'required',

                    Rule::in([
                        'Barangay Clearance',
                        'Certificate of Residency',
                        'Certificate of Indigency',
                        'Barangay Certification',
                    ]),
                ],


                'purpose' => [
                    'required',
                    'string',
                    'min:3',
                    'max:1000',
                ],

            ], [

                'document_type.required' =>
                    'Please select a document type.',

                'document_type.in' =>
                    'Please select a valid document type.',

                'purpose.required' =>
                    'Please provide the purpose of your request.',

                'purpose.min' =>
                    'Please provide a more descriptive purpose.',

                'purpose.max' =>
                    'Purpose must not exceed 1000 characters.',

            ]);


        /*
        |--------------------------------------------------------------------------
        | Create Request
        |--------------------------------------------------------------------------
        */

        $documentRequest =
            DocumentRequest::create([

                'request_number' =>
                    $this->generateRequestNumber(),

                'resident_id' =>
                    $resident->id,

                'document_type' =>
                    $validated['document_type'],

                'purpose' =>
                    $validated['purpose'],

                'date_requested' =>
                    now('Asia/Manila')
                        ->toDateString(),

                'status' =>
                    'Pending',

                'admin_remarks' =>
                    null,

                'processed_at' =>
                    null,

            ]);


        return redirect()

            ->route(
                'resident.requests.show',
                $documentRequest
            )

            ->with(
                'success',
                'Your document request has been submitted successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Resident Request Details
    |--------------------------------------------------------------------------
    */

    public function show(
        DocumentRequest $documentRequest
    ) {
        $resident =
            $this->resident();


        /*
        |--------------------------------------------------------------------------
        | Ownership Protection
        |--------------------------------------------------------------------------
        |
        | A resident may only view requests
        | connected to their own resident record.
        |
        */

        abort_unless(
            (int) $documentRequest->resident_id
            ===
            (int) $resident->id,
            403
        );


        return view(
            'resident_portal.requests.show',
            compact(
                'resident',
                'documentRequest'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Logged-in Resident
    |--------------------------------------------------------------------------
    */

    private function resident()
    {
        $user =
            Auth::user();


        abort_unless(
            $user
            && $user->role === 'resident'
            && $user->resident_id
            && $user->resident,
            403
        );


        return $user->resident;
    }


    /*
    |--------------------------------------------------------------------------
    | Generate Request Number
    |--------------------------------------------------------------------------
    |
    | Format:
    |
    | REQ-2026-00001
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

                ->orderByDesc('id')

                ->value(
                    'request_number'
                );


        if (!$lastRequest) {

            $nextNumber = 1;

        } else {

            $parts =
                explode(
                    '-',
                    $lastRequest
                );


            $lastNumber =
                (int) end(
                    $parts
                );


            $nextNumber =
                $lastNumber + 1;
        }


        /*
        |--------------------------------------------------------------------------
        | Prevent accidental duplicate number
        |--------------------------------------------------------------------------
        */

        do {

            $requestNumber =
                $prefix
                . str_pad(
                    $nextNumber,
                    5,
                    '0',
                    STR_PAD_LEFT
                );


            $exists =
                DocumentRequest::where(
                    'request_number',
                    $requestNumber
                )
                ->exists();


            if ($exists) {

                $nextNumber++;
            }

        } while ($exists);


        return $requestNumber;
    }
}