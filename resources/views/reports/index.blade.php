@extends('layouts.app')


@section(
    'title',
    'Reports'
)


@section(
    'page-title',
    'Reports'
)


@section(
    'page-subtitle',
    'Review barangay records, document requests, and payment activity.'
)


@section('content')


@include('reports._styles')


<div class="admin-report-page">


    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <section class="admin-report-header">


        <div>

            <div class="admin-report-eyebrow">
                BARANGAY ANALYTICS
            </div>

            <h2>
                Administrative Reports
            </h2>

            <p>

                Reporting period:

                <strong>
                    {{
                        \Carbon\Carbon::parse(
                            $fromDate
                        )->format('M d, Y')
                    }}
                </strong>

                –

                <strong>
                    {{
                        \Carbon\Carbon::parse(
                            $toDate
                        )->format('M d, Y')
                    }}
                </strong>

            </p>

        </div>


        <div class="admin-report-actions">


            <a
                href="{{ route(
                    'dashboard'
                ) }}"
                class="report-secondary-button"
            >
                ← Dashboard
            </a>


            <a
                href="{{ route(
                    'reports.print',
                    [
                        'from' =>
                            $fromDate,

                        'to' =>
                            $toDate,
                    ]
                ) }}"
                target="_blank"
                class="report-secondary-button"
            >
                Print Report
            </a>


            <a
                href="{{ route(
                    'reports.export',
                    [
                        'from' =>
                            $fromDate,

                        'to' =>
                            $toDate,
                    ]
                ) }}"
                class="report-primary-button"
            >
                Export CSV
            </a>


        </div>


    </section>



    {{-- =====================================================
        FILTER
    ====================================================== --}}

    <form
        action="{{ route(
            'reports.index'
        ) }}"
        method="GET"
        class="admin-report-filter"
    >


        <div class="admin-report-field">

            <label for="from">
                From Date
            </label>

            <input
                type="date"
                name="from"
                id="from"
                value="{{ $fromDate }}"
            >

        </div>


        <div class="admin-report-field">

            <label for="to">
                To Date
            </label>

            <input
                type="date"
                name="to"
                id="to"
                value="{{ $toDate }}"
            >

        </div>


        <button
            type="submit"
            class="report-primary-button"
        >
            Apply Filter
        </button>


        <a
            href="{{ route(
                'reports.index'
            ) }}"
            class="report-secondary-button"
        >
            Current Month
        </a>


    </form>



    {{-- =====================================================
        MAIN STATS
    ====================================================== --}}

    <section class="admin-report-stats">


        <div class="admin-report-stat">

            <div class="admin-report-stat-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M2 21v-2a7 7 0 0 1 14 0v2"/>
                    <path d="M16 3a4 4 0 0 1 0 8"/>
                </svg>

            </div>

            <div class="admin-report-stat-copy">

                <span>
                    Total Residents
                </span>

                <strong>
                    {{ $totalResidents }}
                </strong>

                <small>
                    All resident records
                </small>

            </div>

        </div>


        <div class="admin-report-stat">

            <div class="admin-report-stat-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path d="M6 2h9l5 5v15H6z"/>
                    <path d="M9 13h6"/>
                </svg>

            </div>

            <div class="admin-report-stat-copy">

                <span>
                    Document Requests
                </span>

                <strong>
                    {{ $totalRequests }}
                </strong>

                <small>
                    Selected period
                </small>

            </div>

        </div>


        <div class="admin-report-stat">

            <div class="admin-report-stat-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path d="m5 12 4 4L19 6"/>
                </svg>

            </div>

            <div class="admin-report-stat-copy">

                <span>
                    Released Documents
                </span>

                <strong>
                    {{ $releasedRequests }}
                </strong>

                <small>
                    Selected period
                </small>

            </div>

        </div>


        <div class="admin-report-stat">

            <div class="admin-report-stat-icon">

                <strong>
                    ₱
                </strong>

            </div>

            <div class="admin-report-stat-copy">

                <span>
                    Payments Collected
                </span>

                <strong>
                    ₱{{ number_format(
                        $totalCollected,
                        2
                    ) }}
                </strong>

                <small>
                    Verified payments
                </small>

            </div>

        </div>


        <div class="admin-report-stat">

            <div class="admin-report-stat-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path d="M6 2h9l5 5v15H6z"/>
                    <path d="M14 2v6h6"/>
                </svg>

            </div>

            <div class="admin-report-stat-copy">

                <span>
                    Ready for Release
                </span>

                <strong>
                    {{ $readyRequests }}
                </strong>

                <small>
                    Awaiting release
                </small>

            </div>

        </div>


        <div class="admin-report-stat">

            <div class="admin-report-stat-icon">

                <strong>
                    G
                </strong>

            </div>

            <div class="admin-report-stat-copy">

                <span>
                    GCash Collected
                </span>

                <strong>
                    ₱{{ number_format(
                        $gcashCollected,
                        2
                    ) }}
                </strong>

                <small>
                    {{ $gcashPaymentCount }} payments
                </small>

            </div>

        </div>


        <div class="admin-report-stat">

            <div class="admin-report-stat-icon">

                <strong>
                    ₱
                </strong>

            </div>

            <div class="admin-report-stat-copy">

                <span>
                    Cash Collected
                </span>

                <strong>
                    ₱{{ number_format(
                        $cashCollected,
                        2
                    ) }}
                </strong>

                <small>
                    {{ $cashPaymentCount }} payments
                </small>

            </div>

        </div>


        <div class="admin-report-stat">

            <div class="admin-report-stat-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path d="M3 11 18 5v14L3 13z"/>
                </svg>

            </div>

            <div class="admin-report-stat-copy">

                <span>
                    Published Updates
                </span>

                <strong>
                    {{ $publishedAnnouncements }}
                </strong>

                <small>
                    Selected period
                </small>

            </div>

        </div>


    </section>



    {{-- =====================================================
        DISTRIBUTIONS
    ====================================================== --}}

    <section class="admin-report-grid">


        {{-- Status --}}

        <div class="admin-report-panel">


            <div class="admin-report-panel-header">

                <h3>
                    Requests by Status
                </h3>

                <p>
                    Document request distribution for the selected period.
                </p>

            </div>


            <div class="admin-report-distribution">


                @forelse($statusDistribution as $item)

                    @php

                        $width =
                            max(
                                4,
                                round(
                                    (
                                        $item->total
                                        / $maxStatusCount
                                    )
                                    * 100
                                )
                            );

                    @endphp


                    <div class="admin-report-bar-item">

                        <div class="admin-report-bar-label">
                            {{ $item->status }}
                        </div>

                        <div class="admin-report-bar-track">

                            <div
                                class="admin-report-bar-fill"
                                style="width: {{ $width }}%;"
                            ></div>

                        </div>

                        <div class="admin-report-bar-total">
                            {{ $item->total }}
                        </div>

                    </div>


                @empty

                    <div>
                        No request data for this period.
                    </div>

                @endforelse


            </div>


        </div>



        {{-- Type --}}

        <div class="admin-report-panel">


            <div class="admin-report-panel-header">

                <h3>
                    Requests by Document Type
                </h3>

                <p>
                    Most requested barangay documents.
                </p>

            </div>


            <div class="admin-report-distribution">


                @forelse($documentTypeDistribution as $item)

                    @php

                        $width =
                            max(
                                4,
                                round(
                                    (
                                        $item->total
                                        / $maxDocumentTypeCount
                                    )
                                    * 100
                                )
                            );

                    @endphp


                    <div class="admin-report-bar-item">

                        <div class="admin-report-bar-label">
                            {{ $item->document_type }}
                        </div>

                        <div class="admin-report-bar-track">

                            <div
                                class="admin-report-bar-fill"
                                style="width: {{ $width }}%;"
                            ></div>

                        </div>

                        <div class="admin-report-bar-total">
                            {{ $item->total }}
                        </div>

                    </div>


                @empty

                    <div>
                        No document request data.
                    </div>

                @endforelse


            </div>


        </div>


    </section>



    {{-- =====================================================
        PAYMENT SUMMARY
    ====================================================== --}}

    <section class="admin-report-panel">


        <div class="admin-report-panel-header">

            <h3>
                Payment Summary
            </h3>

            <p>
                Verified payments recorded during the selected period.
            </p>

        </div>


        <div class="admin-report-payment-grid">


            <div class="admin-report-payment-item">

                <span>
                    Total Collected
                </span>

                <strong>
                    ₱{{ number_format(
                        $totalCollected,
                        2
                    ) }}
                </strong>

            </div>


            <div class="admin-report-payment-item">

                <span>
                    GCash
                </span>

                <strong>
                    ₱{{ number_format(
                        $gcashCollected,
                        2
                    ) }}
                </strong>

            </div>


            <div class="admin-report-payment-item">

                <span>
                    Cash / Barangay Hall
                </span>

                <strong>
                    ₱{{ number_format(
                        $cashCollected,
                        2
                    ) }}
                </strong>

            </div>


        </div>


    </section>



    {{-- =====================================================
        RECENT REQUESTS
    ====================================================== --}}

    <section class="admin-report-table-panel">


        <div class="admin-report-panel-header">

            <h3>
                Recent Requests
            </h3>

            <p>
                Latest requests within the reporting period.
            </p>

        </div>


        <div class="admin-report-table-wrapper">


            <table class="admin-report-table">


                <thead>

                    <tr>

                        <th>
                            Request
                        </th>

                        <th>
                            Resident
                        </th>

                        <th>
                            Document
                        </th>

                        <th>
                            Date
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Payment
                        </th>

                        <th>
                            Amount
                        </th>

                    </tr>

                </thead>


                <tbody>


                    @forelse($latestRequests as $requestItem)

                        <tr>

                            <td>
                                <strong>
                                    {{ $requestItem->request_number }}
                                </strong>
                            </td>

                            <td>

                                {{
                                    $requestItem->resident
                                        ? $requestItem
                                            ->resident
                                            ->full_name
                                        : 'Resident unavailable'
                                }}

                            </td>

                            <td>
                                {{ $requestItem->document_type }}
                            </td>

                            <td>

                                {{
                                    $requestItem
                                        ->date_requested
                                        ->format('M d, Y')
                                }}

                            </td>

                            <td>
                                {{ $requestItem->status }}
                            </td>

                            <td>
                                {{ $requestItem->payment_status }}
                            </td>

                            <td>

                                ₱{{ number_format(
                                    (float)
                                    $requestItem->amount,
                                    2
                                ) }}

                            </td>

                        </tr>


                    @empty


                        <tr>

                            <td
                                colspan="7"
                                style="
                                    text-align: center;
                                    padding: 30px;
                                "
                            >
                                No requests for this period.
                            </td>

                        </tr>


                    @endforelse


                </tbody>


            </table>


        </div>


    </section>


</div>


@endsection