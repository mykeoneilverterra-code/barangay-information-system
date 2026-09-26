<?php

namespace App\Http\Controllers;

use App\Models\DocumentRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DocumentRequestController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Document Request Queue
    |--------------------------------------------------------------------------
    */

    public function index(
        Request $request
    ) {
        $search =
            trim(
                (string)
                $request->query(
                    'search',
                    ''
                )
            );


        $documentType =
            trim(
                (string)
                $request->query(
                    'document_type',
                    ''
                )
            );


        $status =
            trim(
                (string)
                $request->query(
                    'status',
                    ''
                )
            );


        /*
        |--------------------------------------------------------------------------
        | Filter Options
        |--------------------------------------------------------------------------
        */

        $documentTypes = [

            'Barangay Clearance',

            'Certificate of Residency',

            'Certificate of Indigency',

            'Barangay Certification',

        ];


        $statuses = [

            'Pending',

            'Processing',

            'Ready for Release',

            'Released',

            'Cancelled',

        ];


        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $totalRequests =
            DocumentRequest::count();


        $pendingRequests =
            DocumentRequest::where(
                'status',
                'Pending'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Request Queue
        |--------------------------------------------------------------------------
        */

        $documentRequests =
            DocumentRequest::query()

                ->with(
                    'resident'
                )

                ->when(
                    $search !== '',
                    function ($query) use ($search) {

                        $query->where(
                            function ($subQuery) use ($search) {

                                $subQuery

                                    ->where(
                                        'request_number',
                                        'like',
                                        '%' . $search . '%'
                                    )

                                    ->orWhere(
                                        'purpose',
                                        'like',
                                        '%' . $search . '%'
                                    )

                                    ->orWhereHas(
                                        'resident',
                                        function ($residentQuery) use ($search) {

                                            $residentQuery

                                                ->where(
                                                    'resident_number',
                                                    'like',
                                                    '%' . $search . '%'
                                                )

                                                ->orWhere(
                                                    'first_name',
                                                    'like',
                                                    '%' . $search . '%'
                                                )

                                                ->orWhere(
                                                    'middle_name',
                                                    'like',
                                                    '%' . $search . '%'
                                                )

                                                ->orWhere(
                                                    'last_name',
                                                    'like',
                                                    '%' . $search . '%'
                                                )

                                                ->orWhereRaw(
                                                    "CONCAT_WS(' ', first_name, middle_name, last_name, suffix) LIKE ?",
                                                    [
                                                        '%' . $search . '%'
                                                    ]
                                                );
                                        }
                                    );
                            }
                        );
                    }
                )

                ->when(
                    $documentType !== '',
                    function ($query) use ($documentType) {

                        $query->where(
                            'document_type',
                            $documentType
                        );
                    }
                )

                ->when(
                    $status !== '',
                    function ($query) use ($status) {

                        $query->where(
                            'status',
                            $status
                        );
                    }
                )

                ->orderByRaw(
                    "
                    CASE status
                        WHEN 'Pending' THEN 1
                        WHEN 'Processing' THEN 2
                        WHEN 'Ready for Release' THEN 3
                        WHEN 'Released' THEN 4
                        WHEN 'Cancelled' THEN 5
                        ELSE 6
                    END
                    "
                )

                ->latest(
                    'date_requested'
                )

                ->latest(
                    'id'
                )

                ->paginate(10)

                ->withQueryString();


        return view(
            'document_requests.index',
            compact(
                'documentRequests',
                'documentTypes',
                'statuses',
                'totalRequests',
                'pendingRequests',
                'search',
                'documentType',
                'status'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | View Request
    |--------------------------------------------------------------------------
    */

    public function show(
        DocumentRequest $documentRequest
    ) {
        $documentRequest->load(
            'resident'
        );


        return view(
            'document_requests.show',
            compact(
                'documentRequest'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Process Request
    |--------------------------------------------------------------------------
    */

    public function edit(
        DocumentRequest $documentRequest
    ) {
        $documentRequest->load(
            'resident'
        );


        $statuses = [

            'Pending',

            'Processing',

            'Ready for Release',

            'Released',

            'Cancelled',

        ];


        return view(
            'document_requests.edit',
            compact(
                'documentRequest',
                'statuses'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Save Processing Update
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        DocumentRequest $documentRequest
    ) {
        $validated =
            $request->validate([

                'status' => [
                    'required',

                    Rule::in([
                        'Pending',
                        'Processing',
                        'Ready for Release',
                        'Released',
                        'Cancelled',
                    ]),
                ],


                'admin_remarks' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],

            ], [

                'status.required' =>
                    'Please select the request status.',

                'status.in' =>
                    'Please select a valid request status.',

                'admin_remarks.max' =>
                    'Admin remarks must not exceed 1000 characters.',

            ]);


        /*
        |--------------------------------------------------------------------------
        | Processed Date
        |--------------------------------------------------------------------------
        |
        | Pending = not processed yet.
        |
        | Once Admin begins processing, processed_at
        | records the first processing date.
        |
        */

        if (
            $validated['status']
            ===
            'Pending'
        ) {

            $processedAt =
                null;

        } else {

            $processedAt =
                $documentRequest->processed_at
                ??
                now('Asia/Manila');

        }


        $documentRequest->update([

            'status' =>
                $validated['status'],

            'admin_remarks' =>
                $validated['admin_remarks']
                ?? null,

            'processed_at' =>
                $processedAt,

        ]);


        return redirect()

            ->route(
                'document-requests.show',
                $documentRequest
            )

            ->with(
                'success',
                'Document request updated successfully.'
            );
    }
}