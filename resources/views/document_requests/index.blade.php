@extends('layouts.app')

@section('title', 'Document Requests')

@section('content')

<div class="records-page">

    {{-- =====================================================
        SUCCESS MESSAGE
    ====================================================== --}}
    @if(session('success'))

        <div class="records-alert records-alert-success">

            <div class="alert-icon">
                ✓
            </div>

            <div>
                <strong>Success</strong>

                <span>
                    {{ session('success') }}
                </span>
            </div>

        </div>

    @endif


    {{-- =====================================================
        DOCUMENT REQUESTS CARD
    ====================================================== --}}
    <div class="records-card document-request-card">


        {{-- =================================================
            HEADER
        ================================================== --}}
        <div class="records-card-header document-request-header">

            <div>

                <p class="records-eyebrow">
                    DOCUMENT MANAGEMENT
                </p>

                <h3>
                    Document Request Queue
                </h3>

                <p>
                    Review and process requests submitted
                    through the Resident Portal.
                </p>

            </div>


            <div class="admin-request-counts">

                <div class="admin-request-count-item">

                    <strong>
                        {{ $totalRequests }}
                    </strong>

                    <span>
                        Total Requests
                    </span>

                </div>


                <div class="admin-request-count-item">

                    <strong>
                        {{ $pendingRequests }}
                    </strong>

                    <span>
                        Pending
                    </span>

                </div>

            </div>

        </div>


        {{-- =================================================
            FILTER BAR
        ================================================== --}}
        <form
            action="{{ route('document-requests.index') }}"
            method="GET"
            class="document-request-filter-bar"
        >

            {{-- Search --}}
            <div class="document-request-search">

                <span class="filter-search-icon">
                    ⌕
                </span>

                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Search request no., resident or purpose..."
                    autocomplete="off"
                >

            </div>


            {{-- Document Type --}}
            <div class="document-request-filter-select">

                <select name="document_type">

                    <option value="">
                        All Document Types
                    </option>

                    @foreach($documentTypes as $type)

                        <option
                            value="{{ $type }}"
                            @selected($documentType === $type)
                        >
                            {{ $type }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Status --}}
            <div class="document-request-filter-select">

                <select name="status">

                    <option value="">
                        All Statuses
                    </option>

                    @foreach($statuses as $statusOption)

                        <option
                            value="{{ $statusOption }}"
                            @selected($status === $statusOption)
                        >
                            {{ $statusOption }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Search Button --}}
            <button
                type="submit"
                class="document-request-search-button"
            >
                Search
            </button>


            {{-- Clear --}}
            @if(
                $search !== ''
                || $documentType !== ''
                || $status !== ''
            )

                <a
                    href="{{ route('document-requests.index') }}"
                    class="document-request-clear-button"
                >
                    Clear
                </a>

            @endif

        </form>


        {{-- =================================================
            TABLE
        ================================================== --}}
        <div class="document-request-table-wrapper">

            <table class="document-request-table">

                {{-- Exact column sizing --}}
                <colgroup>

                    <col class="col-request-number">

                    <col class="col-request-resident">

                    <col class="col-request-document">

                    <col class="col-request-purpose">

                    <col class="col-request-date">

                    <col class="col-request-status">

                    <col class="col-request-actions">

                </colgroup>


                <thead>

                    <tr>

                        <th>
                            Request No.
                        </th>

                        <th>
                            Resident
                        </th>

                        <th>
                            Document
                        </th>

                        <th>
                            Purpose
                        </th>

                        <th>
                            Date Requested
                        </th>

                        <th>
                            Status
                        </th>

                        <th class="document-request-actions-heading">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($documentRequests as $documentRequest)

                        @php

                            $statusClass = match($documentRequest->status) {

                                'Pending'
                                    => 'request-status-pending',

                                'Processing'
                                    => 'request-status-processing',

                                'Ready for Release'
                                    => 'request-status-ready',

                                'Released'
                                    => 'request-status-released',

                                'Cancelled'
                                    => 'request-status-cancelled',

                                default
                                    => 'request-status-pending',
                            };

                        @endphp


                        <tr>

                            {{-- =========================================
                                REQUEST NUMBER
                            ========================================== --}}
                            <td class="document-request-number-cell">

                                <a
                                    href="{{ route(
                                        'document-requests.show',
                                        $documentRequest
                                    ) }}"
                                    class="document-request-number-link"
                                >
                                    {{ $documentRequest->request_number }}
                                </a>

                            </td>


                            {{-- =========================================
                                RESIDENT
                            ========================================== --}}
                            <td>

                                <div class="document-request-resident">


                                    {{-- Photo --}}
                                    <div class="document-request-avatar">

                                        @if(
                                            $documentRequest->resident
                                            && $documentRequest->resident->profile_photo_path
                                        )

                                            <img
                                                src="{{ asset(
                                                    'storage/'
                                                    . $documentRequest
                                                        ->resident
                                                        ->profile_photo_path
                                                ) }}"
                                                alt="{{ $documentRequest
                                                    ->resident
                                                    ->full_name }}"
                                            >

                                        @elseif($documentRequest->resident)

                                            {{ strtoupper(
                                                substr(
                                                    $documentRequest
                                                        ->resident
                                                        ->first_name,
                                                    0,
                                                    1
                                                )
                                            ) }}

                                        @else

                                            ?

                                        @endif

                                    </div>


                                    {{-- Resident Details --}}
                                    <div class="document-request-resident-info">

                                        @if($documentRequest->resident)

                                            <strong>
                                                {{ $documentRequest
                                                    ->resident
                                                    ->full_name }}
                                            </strong>

                                            <span>
                                                {{ $documentRequest
                                                    ->resident
                                                    ->resident_number }}
                                            </span>

                                        @else

                                            <strong>
                                                Resident unavailable
                                            </strong>

                                            <span>
                                                No linked resident
                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- =========================================
                                DOCUMENT
                            ========================================== --}}
                            <td>

                                <span class="document-request-type-badge">

                                    {{ $documentRequest->document_type }}

                                </span>

                            </td>


                            {{-- =========================================
                                PURPOSE
                            ========================================== --}}
                            <td>

                                <div class="document-request-purpose">

                                    {{ \Illuminate\Support\Str::limit(
                                        $documentRequest->purpose,
                                        55
                                    ) }}

                                </div>

                            </td>


                            {{-- =========================================
                                DATE REQUESTED
                            ========================================== --}}
                            <td class="document-request-date-cell">

                                {{ $documentRequest
                                    ->date_requested
                                    ->format('M d, Y') }}

                            </td>


                            {{-- =========================================
                                STATUS
                            ========================================== --}}
                            <td>

                                <span class="request-status-badge {{ $statusClass }}">

                                    {{ $documentRequest->status }}

                                </span>

                            </td>


                            {{-- =========================================
                                ACTIONS
                            ========================================== --}}
                            <td>

                                <div class="document-request-actions">

                                    <a
                                        href="{{ route(
                                            'document-requests.show',
                                            $documentRequest
                                        ) }}"
                                        class="document-request-action-view"
                                    >
                                        View
                                    </a>


                                    <a
                                        href="{{ route(
                                            'document-requests.edit',
                                            $documentRequest
                                        ) }}"
                                        class="document-request-action-process"
                                    >
                                        Process
                                    </a>

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="document-request-empty"
                            >

                                <div class="empty-icon">
                                    ▤
                                </div>

                                <strong>
                                    No document requests found
                                </strong>

                                <p>
                                    Requests submitted through the
                                    Resident Portal will appear here.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- =================================================
            FOOTER / PAGINATION
        ================================================== --}}
        <div class="document-request-table-footer">

            <div>

                @if($documentRequests->total() > 0)

                    Showing

                    <strong>
                        {{ $documentRequests->firstItem() }}
                    </strong>

                    to

                    <strong>
                        {{ $documentRequests->lastItem() }}
                    </strong>

                    of

                    <strong>
                        {{ $documentRequests->total() }}
                    </strong>

                    requests

                @else

                    No requests found

                @endif

            </div>


            @if($documentRequests->hasPages())

                <div class="custom-pagination">

                    {{-- Previous --}}
                    @if($documentRequests->onFirstPage())

                        <span class="pagination-button disabled">
                            ‹
                        </span>

                    @else

                        <a
                            href="{{ $documentRequests->previousPageUrl() }}"
                            class="pagination-button"
                        >
                            ‹
                        </a>

                    @endif


                    {{-- Page Numbers --}}
                    @for(
                        $page = 1;
                        $page <= $documentRequests->lastPage();
                        $page++
                    )

                        @if(
                            $page
                            ===
                            $documentRequests->currentPage()
                        )

                            <span class="pagination-button active">
                                {{ $page }}
                            </span>

                        @else

                            <a
                                href="{{ $documentRequests->url($page) }}"
                                class="pagination-button"
                            >
                                {{ $page }}
                            </a>

                        @endif

                    @endfor


                    {{-- Next --}}
                    @if($documentRequests->hasMorePages())

                        <a
                            href="{{ $documentRequests->nextPageUrl() }}"
                            class="pagination-button"
                        >
                            ›
                        </a>

                    @else

                        <span class="pagination-button disabled">
                            ›
                        </span>

                    @endif

                </div>

            @endif

        </div>

    </div>

</div>

@endsection