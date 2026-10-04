<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\DocumentRequest;
use App\Models\Resident;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Report Dashboard
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $data =
            $this->buildReportData(
                $request
            );


        return view(
            'reports.index',
            $data
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Printable Report
    |--------------------------------------------------------------------------
    */

    public function print(Request $request)
    {
        $data =
            $this->buildReportData(
                $request
            );


        return view(
            'reports.print',
            $data
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CSV Export
    |--------------------------------------------------------------------------
    */

    public function export(Request $request)
    {
        $data =
            $this->buildReportData(
                $request
            );


        $requests =
            $data['reportRequests'];


        $filename =
            'barangay-report-'
            . $data['fromDate']
            . '-to-'
            . $data['toDate']
            . '.csv';


        return response()
            ->streamDownload(
                function () use ($requests) {

                    $handle =
                        fopen(
                            'php://output',
                            'w'
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | UTF-8 BOM for Excel
                    |--------------------------------------------------------------------------
                    */

                    fwrite(
                        $handle,
                        "\xEF\xBB\xBF"
                    );


                    fputcsv(
                        $handle,
                        [
                            'Request Number',
                            'Resident Number',
                            'Resident Name',
                            'Document Type',
                            'Purpose',
                            'Date Requested',
                            'Request Status',
                            'Payment Method',
                            'Payment Status',
                            'Amount',
                        ]
                    );


                    foreach (
                        $requests
                        as $documentRequest
                    ) {

                        $resident =
                            $documentRequest
                                ->resident;


                        fputcsv(
                            $handle,
                            [

                                $documentRequest
                                    ->request_number,

                                $resident
                                    ? $resident
                                        ->resident_number
                                    : '',

                                $resident
                                    ? $resident
                                        ->full_name
                                    : 'Resident unavailable',

                                $documentRequest
                                    ->document_type,

                                $documentRequest
                                    ->purpose,

                                $documentRequest
                                    ->date_requested
                                    ? $documentRequest
                                        ->date_requested
                                        ->format('Y-m-d')
                                    : '',

                                $documentRequest
                                    ->status,

                                $documentRequest
                                    ->payment_method
                                    ?? 'None',

                                $documentRequest
                                    ->payment_status,

                                number_format(
                                    (float)
                                    $documentRequest
                                        ->amount,
                                    2,
                                    '.',
                                    ''
                                ),

                            ]
                        );

                    }


                    fclose(
                        $handle
                    );

                },
                $filename,
                [
                    'Content-Type' =>
                        'text/csv; charset=UTF-8',
                ]
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Build Report Data
    |--------------------------------------------------------------------------
    */

    private function buildReportData(
        Request $request
    ): array {

        $request->validate([

            'from' => [
                'nullable',
                'date',
            ],

            'to' => [
                'nullable',
                'date',
                'after_or_equal:from',
            ],

        ]);


        $timezone =
            'Asia/Manila';


        $from =
            $request->filled('from')
                ? Carbon::parse(
                    $request->from,
                    $timezone
                )
                : now($timezone)
                    ->startOfMonth();


        $to =
            $request->filled('to')
                ? Carbon::parse(
                    $request->to,
                    $timezone
                )
                : now($timezone);


        $fromDate =
            $from->format('Y-m-d');


        $toDate =
            $to->format('Y-m-d');


        /*
        |--------------------------------------------------------------------------
        | Global Resident Statistics
        |--------------------------------------------------------------------------
        */

        $totalResidents =
            Resident::count();


        $registeredVoters =
            Resident::query()
                ->where(
                    'is_voter',
                    true
                )
                ->count();


        $totalAreas =
            Resident::query()
                ->whereNotNull('area')
                ->where(
                    'area',
                    '!=',
                    ''
                )
                ->distinct()
                ->count('area');


        /*
        |--------------------------------------------------------------------------
        | Request Base Query
        |--------------------------------------------------------------------------
        */

        $requestBase =
            DocumentRequest::query()
                ->whereDate(
                    'date_requested',
                    '>=',
                    $fromDate
                )
                ->whereDate(
                    'date_requested',
                    '<=',
                    $toDate
                );


        $totalRequests =
            (clone $requestBase)
                ->count();


        $pendingRequests =
            (clone $requestBase)
                ->where(
                    'status',
                    'Pending'
                )
                ->count();


        $processingRequests =
            (clone $requestBase)
                ->where(
                    'status',
                    'Processing'
                )
                ->count();


        $readyRequests =
            (clone $requestBase)
                ->where(
                    'status',
                    'Ready for Release'
                )
                ->count();


        $releasedRequests =
            (clone $requestBase)
                ->where(
                    'status',
                    'Released'
                )
                ->count();


        $cancelledRequests =
            (clone $requestBase)
                ->where(
                    'status',
                    'Cancelled'
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | Request Status Distribution
        |--------------------------------------------------------------------------
        */

        $statusDistribution =
            (clone $requestBase)
                ->select(
                    'status',
                    DB::raw(
                        'COUNT(*) as total'
                    )
                )
                ->groupBy('status')
                ->orderByDesc('total')
                ->get();


        $maxStatusCount =
            max(
                1,
                (int) (
                    $statusDistribution
                        ->max('total')
                    ?? 1
                )
            );


        /*
        |--------------------------------------------------------------------------
        | Document Type Distribution
        |--------------------------------------------------------------------------
        */

        $documentTypeDistribution =
            (clone $requestBase)
                ->select(
                    'document_type',
                    DB::raw(
                        'COUNT(*) as total'
                    )
                )
                ->groupBy(
                    'document_type'
                )
                ->orderByDesc('total')
                ->get();


        $maxDocumentTypeCount =
            max(
                1,
                (int) (
                    $documentTypeDistribution
                        ->max('total')
                    ?? 1
                )
            );


        /*
        |--------------------------------------------------------------------------
        | Payment Query
        |--------------------------------------------------------------------------
        */

        $paymentBase =
            DocumentRequest::query()
                ->where(
                    'payment_status',
                    'Paid'
                )
                ->whereNotNull(
                    'payment_verified_at'
                )
                ->whereDate(
                    'payment_verified_at',
                    '>=',
                    $fromDate
                )
                ->whereDate(
                    'payment_verified_at',
                    '<=',
                    $toDate
                );


        $paidPayments =
            (clone $paymentBase)
                ->count();


        $totalCollected =
            (float) (
                (clone $paymentBase)
                    ->sum('amount')
            );


        $cashCollected =
            (float) (
                (clone $paymentBase)
                    ->where(
                        'payment_method',
                        'Cash'
                    )
                    ->sum('amount')
            );


        $gcashCollected =
            (float) (
                (clone $paymentBase)
                    ->where(
                        'payment_method',
                        'GCash'
                    )
                    ->sum('amount')
            );


        $cashPaymentCount =
            (clone $paymentBase)
                ->where(
                    'payment_method',
                    'Cash'
                )
                ->count();


        $gcashPaymentCount =
            (clone $paymentBase)
                ->where(
                    'payment_method',
                    'GCash'
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | Published Announcements
        |--------------------------------------------------------------------------
        */

        $publishedAnnouncements =
            Announcement::query()
                ->where(
                    'status',
                    'Published'
                )
                ->whereDate(
                    'announcement_date',
                    '>=',
                    $fromDate
                )
                ->whereDate(
                    'announcement_date',
                    '<=',
                    $toDate
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | Report Table
        |--------------------------------------------------------------------------
        */

        $reportRequests =
            (clone $requestBase)
                ->with('resident')
                ->orderByDesc(
                    'date_requested'
                )
                ->orderByDesc('id')
                ->get();


        $latestRequests =
            (clone $requestBase)
                ->with('resident')
                ->orderByDesc(
                    'date_requested'
                )
                ->orderByDesc('id')
                ->take(8)
                ->get();


        return compact(

            'fromDate',

            'toDate',

            'totalResidents',

            'registeredVoters',

            'totalAreas',

            'totalRequests',

            'pendingRequests',

            'processingRequests',

            'readyRequests',

            'releasedRequests',

            'cancelledRequests',

            'statusDistribution',

            'maxStatusCount',

            'documentTypeDistribution',

            'maxDocumentTypeCount',

            'paidPayments',

            'totalCollected',

            'cashCollected',

            'gcashCollected',

            'cashPaymentCount',

            'gcashPaymentCount',

            'publishedAnnouncements',

            'reportRequests',

            'latestRequests'

        );
    }
}