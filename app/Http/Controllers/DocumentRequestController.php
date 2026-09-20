<?php

namespace App\Http\Controllers;

use App\Models\DocumentRequest;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DocumentRequestController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Document Request Directory
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $search = trim(
            (string) $request->query(
                'search',
                ''
            )
        );

        $documentType = trim(
            (string) $request->query(
                'document_type',
                ''
            )
        );

        $status = trim(
            (string) $request->query(
                'status',
                ''
            )
        );


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
            )->count();


        $releasedRequests =
            DocumentRequest::where(
                'status',
                'Released'
            )->count();


        /*
        |--------------------------------------------------------------------------
        | Request Query
        |--------------------------------------------------------------------------
        */

        $documentRequests =
            DocumentRequest::query()

                ->with('resident')

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
                                        'document_type',
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
                                                    ['%' . $search . '%']
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

                ->orderByDesc('date_requested')
                ->orderByDesc('id')

                ->paginate(10)

                ->withQueryString();


        return view(
            'document_requests.index',
            compact(
                'documentRequests',
                'totalRequests',
                'pendingRequests',
                'releasedRequests',
                'search',
                'documentType',
                'status'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $residents =
            Resident::query()
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get();


        $nextRequestNumber =
            $this->generateRequestNumber();


        return view(
            'document_requests.create',
            compact(
                'residents',
                'nextRequestNumber'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $data = $request->validate([

            'resident_id' => [
                'required',
                'exists:residents,id',
            ],

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

            'date_requested' => [
                'required',
                'date',
            ],

            'status' => [
                'required',
                Rule::in(
                    $this->statuses()
                ),
            ],
        ]);


        $data['request_number'] =
            $this->generateRequestNumber();


        $documentRequest =
            DocumentRequest::create($data);


        return redirect()
            ->route(
                'document-requests.show',
                $documentRequest
            )
            ->with(
                'success',
                'Document request created successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Show
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
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit(
        DocumentRequest $documentRequest
    ) {
        $residents =
            Resident::query()
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get();


        return view(
            'document_requests.edit',
            compact(
                'documentRequest',
                'residents'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        DocumentRequest $documentRequest
    ) {
        $data = $request->validate([

            'resident_id' => [
                'required',
                'exists:residents,id',
            ],

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

            'date_requested' => [
                'required',
                'date',
            ],

            'status' => [
                'required',
                Rule::in(
                    $this->statuses()
                ),
            ],
        ]);


        $documentRequest->update(
            $data
        );


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


    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    public function destroy(
        DocumentRequest $documentRequest
    ) {
        $documentRequest->delete();


        return redirect()
            ->route(
                'document-requests.index'
            )
            ->with(
                'success',
                'Document request deleted successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Automatic Request Number
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


    /*
    |--------------------------------------------------------------------------
    | Document Types
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
    | Request Status
    |--------------------------------------------------------------------------
    */

    private function statuses(): array
    {
        return [
            'Pending',
            'Processing',
            'Ready for Release',
            'Released',
            'Cancelled',
        ];
    }
}