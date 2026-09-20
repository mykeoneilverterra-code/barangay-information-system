@extends('layouts.app')

@section('title', 'Document Requests')

@section('content')

<div class="records-page">


    @if(session('success'))

        <div class="records-alert records-alert-success">

            <div class="alert-icon">
                ✓
            </div>

            <div>

                <strong>
                    Success
                </strong>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        </div>

    @endif


    <div class="records-card">


        {{-- Header --}}
        <div class="records-card-header">

            <div>

                <h3>
                    Document Requests
                </h3>

                <p>
                    Barangay certificates and clearance requests for registered residents.
                </p>

            </div>


            <div class="document-header-actions">

                <div class="record-count-inline">

                    <strong>
                        {{ $totalRequests }}
                    </strong>

                    <span>
                        Total Requests
                    </span>

                </div>


                <a
                    href="{{ route('document-requests.create') }}"
                    class="primary-action-btn"
                >
                    <span class="action-icon">
                        +
                    </span>

                    New Request
                </a>

            </div>

        </div>


        {{-- Filters --}}
        <form
            action="{{ route('document-requests.index') }}"
            method="GET"
            class="document-filter-bar"
        >

            <div class="filter-search document-search">

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


            <div class="filter-select">

                <select name="document_type">

                    <option value="">
                        All Document Types
                    </option>

                    @foreach([
                        'Barangay Clearance',
                        'Certificate of Residency',
                        'Certificate of Indigency',
                        'Barangay Certification'
                    ] as $type)

                        <option
                            value="{{ $type }}"
                            @selected($documentType === $type)
                        >
                            {{ $type }}
                        </option>

                    @endforeach

                </select>

            </div>


            <div class="filter-select">

                <select name="status">

                    <option value="">
                        All Statuses
                    </option>

                    @foreach([
                        'Pending',
                        'Processing',
                        'Ready for Release',
                        'Released',
                        'Cancelled'
                    ] as $statusOption)

                        <option
                            value="{{ $statusOption }}"
                            @selected($status === $statusOption)
                        >
                            {{ $statusOption }}
                        </option>

                    @endforeach

                </select>

            </div>


            <button
                type="submit"
                class="filter-submit-btn"
            >
                Search
            </button>


            @if(
                $search !== ''
                || $documentType !== ''
                || $status !== ''
            )

                <a
                    href="{{ route('document-requests.index') }}"
                    class="filter-clear-btn"
                >
                    Clear
                </a>

            @endif

        </form>


        <div class="records-table-wrapper">

            <table class="document-requests-table">

                <thead>

                    <tr>
                        <th>Request No.</th>
                        <th>Resident</th>
                        <th>Document</th>
                        <th>Purpose</th>
                        <th>Date Requested</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($documentRequests as $documentRequest)

                        <tr>

                            <td>

                                <a
                                    href="{{ route(
                                        'document-requests.show',
                                        $documentRequest
                                    ) }}"
                                    class="record-id"
                                >
                                    {{ $documentRequest->request_number }}
                                </a>

                            </td>


                            <td>

                                @if($documentRequest->resident)

                                    <div class="record-person">

                                        <div class="record-avatar">

                                            {{ strtoupper(
                                                substr(
                                                    $documentRequest->resident->first_name,
                                                    0,
                                                    1
                                                )
                                            ) }}

                                        </div>


                                        <div class="resident-name-info">

                                            <span class="resident-name">
                                                {{ $documentRequest->resident->full_name }}
                                            </span>

                                            <small>
                                                {{ $documentRequest->resident->resident_number }}
                                            </small>

                                        </div>

                                    </div>

                                @else

                                    <span class="record-muted">
                                        Resident unavailable
                                    </span>

                                @endif

                            </td>


                            <td>

                                <span class="document-type-badge">
                                    {{ $documentRequest->document_type }}
                                </span>

                            </td>


                            <td class="document-purpose-cell">
                                {{ $documentRequest->purpose }}
                            </td>


                            <td>
                                {{ $documentRequest->date_requested->format('M d, Y') }}
                            </td>


                            <td>

                                <span class="request-status request-status-{{ \Illuminate\Support\Str::slug($documentRequest->status) }}">
                                    {{ $documentRequest->status }}
                                </span>

                            </td>


                            <td>

                                <div class="records-actions">

                                    <a
                                        href="{{ route(
                                            'document-requests.show',
                                            $documentRequest
                                        ) }}"
                                        class="record-action record-action-view"
                                    >
                                        View
                                    </a>


                                    <details class="action-menu">

                                        <summary class="action-menu-trigger">
                                            ⋮
                                        </summary>


                                        <div class="action-menu-dropdown">

                                            <a
                                                href="{{ route(
                                                    'document-requests.edit',
                                                    $documentRequest
                                                ) }}"
                                                class="action-menu-item"
                                            >
                                                ✎ Edit Request
                                            </a>


                                            <div class="action-menu-divider"></div>


                                            <form
                                                action="{{ route(
                                                    'document-requests.destroy',
                                                    $documentRequest
                                                ) }}"
                                                method="POST"
                                                class="action-menu-form"
                                            >

                                                @csrf
                                                @method('DELETE')


                                                <button
                                                    type="submit"
                                                    class="action-menu-item action-menu-delete"
                                                    onclick="return confirm('Delete {{ $documentRequest->request_number }}?')"
                                                >
                                                    × Delete Request
                                                </button>

                                            </form>

                                        </div>

                                    </details>

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="records-empty"
                            >

                                <div class="empty-icon">
                                    ▤
                                </div>

                                <strong>
                                    No document requests found
                                </strong>

                                <p>
                                    Create the first document request to get started.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <div class="records-pagination">

            <div class="pagination-info">

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

                <div>
                    {{ $documentRequests->links() }}
                </div>

            @endif

        </div>

    </div>

</div>

@endsection