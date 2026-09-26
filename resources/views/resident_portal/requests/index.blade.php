@extends('layouts.resident')


@section('title', 'My Requests')


@section(
    'page-title',
    'My Requests'
)


@section(
    'page-subtitle',
    'Track your submitted document requests and their current status.'
)


@section('content')


<div class="resident-my-requests-page">


    {{-- =====================================================
        SUCCESS
    ====================================================== --}}
    @if(session('success'))

        <div class="resident-portal-success">

            <div class="resident-portal-success-icon">
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



    {{-- =====================================================
        STATISTICS
    ====================================================== --}}
    <div class="resident-request-stats">


        <div class="resident-request-stat-card">

            <span>
                Total Requests
            </span>

            <strong>
                {{ $totalRequests }}
            </strong>

            <small>
                Submitted requests
            </small>

        </div>



        <div class="resident-request-stat-card">

            <span>
                Pending
            </span>

            <strong>
                {{ $pendingRequests }}
            </strong>

            <small>
                Awaiting review
            </small>

        </div>



        <div class="resident-request-stat-card">

            <span>
                Processing
            </span>

            <strong>
                {{ $processingRequests }}
            </strong>

            <small>
                Being processed
            </small>

        </div>



        <div class="resident-request-stat-card">

            <span>
                Ready / Released
            </span>

            <strong>
                {{ $readyRequests }}
            </strong>

            <small>
                Completed requests
            </small>

        </div>

    </div>



    {{-- =====================================================
        REQUESTS
    ====================================================== --}}
    <section class="resident-request-history">


        <div class="resident-request-history-header">

            <div>

                <p class="resident-dashboard-eyebrow">
                    REQUEST HISTORY
                </p>

                <h2>
                    Document Requests
                </h2>

                <p>
                    Only requests submitted using your resident account
                    are shown here.
                </p>

            </div>


            <a
                href="{{ route('resident.requests.create') }}"
                class="resident-new-request-button"
            >
                + New Request
            </a>

        </div>



        <div class="resident-request-table-wrapper">

            <table class="resident-request-table">

                <thead>

                    <tr>

                        <th>
                            Request No.
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
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($requests as $requestItem)

                        @php

                            $statusClass =
                                match($requestItem->status) {

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

                            <td>

                                <strong class="resident-request-number">
                                    {{ $requestItem->request_number }}
                                </strong>

                            </td>


                            <td>

                                <div class="resident-request-document">

                                    <strong>
                                        {{ $requestItem->document_type }}
                                    </strong>

                                    <span>
                                        {{ \Illuminate\Support\Str::limit(
                                            $requestItem->purpose,
                                            55
                                        ) }}
                                    </span>

                                </div>

                            </td>


                            <td>

                                {{ $requestItem
                                    ->date_requested
                                    ->format('M d, Y') }}

                            </td>


                            <td>

                                <span class="request-status-badge {{ $statusClass }}">

                                    {{ $requestItem->status }}

                                </span>

                            </td>


                            <td>

                                <a
                                    href="{{ route(
                                        'resident.requests.show',
                                        $requestItem
                                    ) }}"
                                    class="resident-request-view-button"
                                >
                                    View
                                </a>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="resident-request-empty"
                            >

                                <strong>
                                    No document requests yet
                                </strong>

                                <p>
                                    Submit your first document request
                                    using the Request Document service.
                                </p>


                                <a
                                    href="{{ route('resident.requests.create') }}"
                                >
                                    Request Document
                                </a>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>



        {{-- =================================================
            PAGINATION
        ================================================== --}}
        @if($requests->hasPages())

            <div class="resident-request-pagination">

                {{ $requests->links() }}

            </div>

        @endif

    </section>

</div>

@endsection