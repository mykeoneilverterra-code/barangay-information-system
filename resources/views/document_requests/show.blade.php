@extends('layouts.app')

@section('title', 'Request Details')

@section('content')

<div class="details-page">

    <div class="details-card">


        <div class="details-header">

            <div class="request-profile-heading">

                <div class="request-profile-icon">
                    ▤
                </div>


                <div>

                    <p class="records-eyebrow">
                        DOCUMENT REQUEST
                    </p>

                    <h2>
                        {{ $documentRequest->document_type }}
                    </h2>

                    <p>
                        {{ $documentRequest->request_number }}
                    </p>

                </div>

            </div>


            <div class="details-header-actions">

                <a
                    href="{{ route(
                        'document-requests.edit',
                        $documentRequest
                    ) }}"
                    class="secondary-action-btn"
                >
                    Edit Request
                </a>


                <a
                    href="{{ route('document-requests.index') }}"
                    class="primary-action-btn"
                >
                    Back to Requests
                </a>

            </div>

        </div>


        <div class="details-grid">


            <div class="detail-item">

                <span>
                    Request Number
                </span>

                <strong>
                    {{ $documentRequest->request_number }}
                </strong>

            </div>


            <div class="detail-item">

                <span>
                    Status
                </span>

                <strong>
                    {{ $documentRequest->status }}
                </strong>

            </div>


            <div class="detail-item">

                <span>
                    Resident
                </span>

                <strong>
                    {{ $documentRequest->resident?->full_name ?? 'Resident unavailable' }}
                </strong>

            </div>


            <div class="detail-item">

                <span>
                    Resident Number
                </span>

                <strong>
                    {{ $documentRequest->resident?->resident_number ?? '—' }}
                </strong>

            </div>


            <div class="detail-item">

                <span>
                    Document Type
                </span>

                <strong>
                    {{ $documentRequest->document_type }}
                </strong>

            </div>


            <div class="detail-item">

                <span>
                    Date Requested
                </span>

                <strong>
                    {{ $documentRequest->date_requested->format('F d, Y') }}
                </strong>

            </div>


            @if($documentRequest->resident)

                <div class="detail-item">

                    <span>
                        Village / Street
                    </span>

                    <strong>
                        {{ $documentRequest->resident->area }}
                    </strong>

                </div>


                <div class="detail-item">

                    <span>
                        Contact Number
                    </span>

                    <strong>
                        {{ $documentRequest->resident->contact_number ?? 'Not provided' }}
                    </strong>

                </div>

            @endif


            <div class="detail-item detail-item-wide">

                <span>
                    Purpose
                </span>

                <strong>
                    {{ $documentRequest->purpose }}
                </strong>

            </div>


            @if($documentRequest->resident)

                <div class="detail-item detail-item-wide">

                    <span>
                        Resident Address
                    </span>

                    <strong>
                        {{ $documentRequest->resident->address }}
                    </strong>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection