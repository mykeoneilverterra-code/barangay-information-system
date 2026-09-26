@extends('layouts.resident')


@section('title', 'Request Details')


@section(
    'page-title',
    'Request Details'
)


@section(
    'page-subtitle',
    'View the current status and information for your document request.'
)


@section('content')


@php

    $statusClass =
        match($documentRequest->status) {

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


<div class="resident-request-details-page">


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
                    Request submitted
                </strong>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        </div>

    @endif



    <div class="resident-request-details-card">


        {{-- =================================================
            HEADER
        ================================================== --}}
        <div class="resident-request-details-header">

            <div>

                <p class="resident-dashboard-eyebrow">
                    DOCUMENT REQUEST
                </p>

                <h2>
                    {{ $documentRequest->request_number }}
                </h2>

                <p>
                    {{ $documentRequest->document_type }}
                </p>

            </div>


            <span class="request-status-badge {{ $statusClass }}">

                {{ $documentRequest->status }}

            </span>

        </div>



        {{-- =================================================
            INFORMATION GRID
        ================================================== --}}
        <div class="resident-request-details-grid">


            <div class="resident-request-detail-item">

                <span>
                    Request Number
                </span>

                <strong>
                    {{ $documentRequest->request_number }}
                </strong>

            </div>



            <div class="resident-request-detail-item">

                <span>
                    Document Type
                </span>

                <strong>
                    {{ $documentRequest->document_type }}
                </strong>

            </div>



            <div class="resident-request-detail-item">

                <span>
                    Date Requested
                </span>

                <strong>
                    {{ $documentRequest
                        ->date_requested
                        ->format('F d, Y') }}
                </strong>

            </div>



            <div class="resident-request-detail-item">

                <span>
                    Current Status
                </span>

                <strong>
                    {{ $documentRequest->status }}
                </strong>

            </div>



            <div class="resident-request-detail-item resident-request-detail-wide">

                <span>
                    Purpose
                </span>

                <strong>
                    {{ $documentRequest->purpose }}
                </strong>

            </div>



            <div class="resident-request-detail-item resident-request-detail-wide">

                <span>
                    Barangay Remarks
                </span>

                <strong>
                    {{ $documentRequest->admin_remarks
                        ?: 'No remarks from the barangay yet.' }}
                </strong>

            </div>



            <div class="resident-request-detail-item resident-request-detail-wide">

                <span>
                    Processing Date
                </span>

                <strong>

                    @if($documentRequest->processed_at)

                        {{ $documentRequest
                            ->processed_at
                            ->timezone('Asia/Manila')
                            ->format('F d, Y — h:i A') }}

                    @else

                        Not yet processed

                    @endif

                </strong>

            </div>

        </div>



        {{-- =================================================
            FOOTER
        ================================================== --}}
        <div class="resident-request-details-footer">

            <a
                href="{{ route('resident.requests.index') }}"
                class="resident-request-secondary"
            >
                ← Back to My Requests
            </a>


            <a
                href="{{ route('resident.requests.create') }}"
                class="resident-request-submit"
            >
                New Request
            </a>

        </div>

    </div>

</div>

@endsection