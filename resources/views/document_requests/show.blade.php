@extends('layouts.app')

@section(
    'title',
    'Document Request'
)

@section(
    'page-title',
    'Document Request'
)

@section(
    'page-subtitle',
    'Review request, payment, and release information.'
)

@section('content')


@include('payments._styles')


@php

    $resident =
        $documentRequest->resident;


    $paymentStatusClass =
        match(
            $documentRequest->payment_status
        ) {

            'Paid' =>
                'payment-status-paid',

            'Pending Verification' =>
                'payment-status-pending',

            'Rejected' =>
                'payment-status-rejected',

            'Unpaid' =>
                'payment-status-unpaid',

            default =>
                'payment-status-none',

        };

@endphp


<div class="payment-page">


    @if(session('success'))

        <div class="
            payment-alert
            payment-alert-success
        ">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="
            payment-alert
            payment-alert-error
        ">
            {{ session('error') }}
        </div>

    @endif


    {{-- =====================================================
        REQUEST
    ====================================================== --}}

    <section class="payment-card">


        <div class="payment-card-header">

            <div>

                <h2>
                    {{ $documentRequest->document_type }}
                </h2>

                <p>
                    {{ $documentRequest->request_number }}
                </p>

            </div>


            <div class="payment-actions">

                <a
                    href="{{ route(
                        'document-requests.edit',
                        $documentRequest
                    ) }}"
                    class="payment-secondary"
                >
                    Process Request
                </a>


                <a
                    href="{{ route(
                        'document-requests.index'
                    ) }}"
                    class="payment-secondary"
                >
                    Back
                </a>

            </div>

        </div>


        <div class="payment-card-body">


            <div class="payment-grid">


                <div class="payment-info-item">

                    <span>
                        Resident
                    </span>

                    <strong>
                        {{
                            $resident
                                ? $resident->full_name
                                : 'Resident unavailable'
                        }}
                    </strong>

                </div>


                <div class="payment-info-item">

                    <span>
                        Resident Number
                    </span>

                    <strong>
                        {{
                            $resident
                                ? $resident->resident_number
                                : '—'
                        }}
                    </strong>

                </div>


                <div class="payment-info-item">

                    <span>
                        Document
                    </span>

                    <strong>
                        {{ $documentRequest->document_type }}
                    </strong>

                </div>


                <div class="payment-info-item">

                    <span>
                        Purpose
                    </span>

                    <strong>
                        {{ $documentRequest->purpose }}
                    </strong>

                </div>


                <div class="payment-info-item">

                    <span>
                        Date Requested
                    </span>

                    <strong>

                        {{
                            $documentRequest
                                ->date_requested
                                ->format('M d, Y')
                        }}

                    </strong>

                </div>


                <div class="payment-info-item">

                    <span>
                        Request Status
                    </span>

                    <strong>
                        {{ $documentRequest->status }}
                    </strong>

                </div>


            </div>


        </div>


    </section>


    {{-- =====================================================
        PAYMENT
    ====================================================== --}}

    <section class="payment-card">


        <div class="payment-card-header">

            <div>

                <h2>
                    Payment Information
                </h2>

                <p>
                    Verify GCash payments or record onsite cash payment.
                </p>

            </div>

        </div>


        <div class="payment-card-body">


            @if(!$documentRequest->payment_required)


                <div
                    class="
                        payment-alert
                        payment-alert-success
                    "
                >
                    This document has no required payment.
                </div>


            @else


                <div class="payment-grid">


                    <div class="payment-info-item">

                        <span>
                            Amount
                        </span>

                        <strong>
                            ₱{{ number_format(
                                (float) $documentRequest->amount,
                                2
                            ) }}
                        </strong>

                    </div>


                    <div class="payment-info-item">

                        <span>
                            Method
                        </span>

                        <strong>
                            {{
                                $documentRequest
                                    ->payment_method
                                ?? 'Not selected'
                            }}
                        </strong>

                    </div>


                    <div class="payment-info-item">

                        <span>
                            Payment Status
                        </span>

                        <strong>

                            <span
                                class="
                                    payment-status
                                    {{ $paymentStatusClass }}
                                "
                            >
                                {{ $documentRequest->payment_status }}
                            </span>

                        </strong>

                    </div>


                    @if(
                        $documentRequest
                            ->payment_reference
                    )

                        <div class="payment-info-item">

                            <span>
                                GCash Reference
                            </span>

                            <strong>
                                {{
                                    $documentRequest
                                        ->payment_reference
                                }}
                            </strong>

                        </div>

                    @endif


                    @if(
                        $documentRequest
                            ->payment_submitted_at
                    )

                        <div class="payment-info-item">

                            <span>
                                Submitted
                            </span>

                            <strong>
                                {{
                                    $documentRequest
                                        ->payment_submitted_at
                                        ->format(
                                            'M d, Y h:i A'
                                        )
                                }}
                            </strong>

                        </div>

                    @endif


                    @if(
                        $documentRequest
                            ->payment_verified_at
                    )

                        <div class="payment-info-item">

                            <span>
                                Verified
                            </span>

                            <strong>
                                {{
                                    $documentRequest
                                        ->payment_verified_at
                                        ->format(
                                            'M d, Y h:i A'
                                        )
                                }}
                            </strong>

                        </div>

                    @endif


                </div>


                {{-- PAYMENT PROOF --}}

                @if(
                    $documentRequest
                        ->payment_proof_path
                )

                    <div
                        class="payment-actions"
                    >

                        <a
                            href="{{ route(
                                'admin.payments.proof',
                                $documentRequest
                            ) }}"
                            target="_blank"
                            class="payment-secondary"
                        >
                            View Payment Proof
                        </a>

                    </div>

                @endif


                {{-- GCASH PENDING --}}

                @if(
                    $documentRequest
                        ->payment_method
                    === 'GCash'
                    &&
                    $documentRequest
                        ->payment_status
                    === 'Pending Verification'
                )


                    <div
                        class="payment-actions"
                    >


                        <form
                            action="{{ route(
                                'admin.payments.verify-gcash',
                                $documentRequest
                            ) }}"
                            method="POST"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="payment-primary"
                            >
                                Verify GCash Payment
                            </button>

                        </form>


                    </div>


                    <form
                        action="{{ route(
                            'admin.payments.reject-gcash',
                            $documentRequest
                        ) }}"
                        method="POST"
                        class="payment-form"
                        style="
                            margin-top: 16px;
                            max-width: 600px;
                        "
                    >

                        @csrf


                        <div class="payment-field">

                            <label
                                for="payment_admin_remarks"
                            >
                                Reason for Rejection
                            </label>

                            <textarea
                                id="payment_admin_remarks"
                                name="payment_admin_remarks"
                                placeholder="Example: Receipt amount does not match the required fee."
                            >{{ old('payment_admin_remarks') }}</textarea>

                            @error(
                                'payment_admin_remarks'
                            )

                                <div class="payment-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <div>

                            <button
                                type="submit"
                                class="payment-danger"
                            >
                                Reject Payment
                            </button>

                        </div>


                    </form>


                @endif


                {{-- CASH --}}

                @if(
                    $documentRequest
                        ->payment_method
                    === 'Cash'
                    &&
                    $documentRequest
                        ->payment_status
                    !== 'Paid'
                )

                    <div
                        class="payment-actions"
                    >

                        <form
                            action="{{ route(
                                'admin.payments.mark-cash-paid',
                                $documentRequest
                            ) }}"
                            method="POST"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="payment-primary"
                                onclick="return confirm('Confirm that the cash payment was received at the Barangay Hall?')"
                            >
                                Mark Cash Payment as Paid
                            </button>

                        </form>

                    </div>

                @endif


                @if(
                    $documentRequest
                        ->payment_admin_remarks
                )

                    <div
                        class="
                            payment-alert
                            {{
                                $documentRequest
                                    ->payment_status
                                === 'Rejected'
                                    ? 'payment-alert-error'
                                    : 'payment-alert-success'
                            }}
                        "
                        style="margin-top: 15px;"
                    >

                        {{
                            $documentRequest
                                ->payment_admin_remarks
                        }}

                    </div>

                @endif


            @endif


        </div>


    </section>


    {{-- =====================================================
        PRINT
    ====================================================== --}}

    <section class="payment-card">


        <div class="payment-card-header">

            <div>

                <h2>
                    Printable Document
                </h2>

                <p>
                    Generate the approved barangay document.
                </p>

            </div>

        </div>


        <div class="payment-card-body">


            @if(
                $documentRequest
                    ->canGenerateDocument()
            )


                <div class="payment-print-ready">

                    <strong>
                        Document is ready to generate.
                    </strong>

                    <p>
                        Request status and payment requirements have been satisfied.
                    </p>

                </div>


                <div class="payment-actions">

                    <a
                        href="{{ route(
                            'document-requests.print',
                            $documentRequest
                        ) }}"
                        target="_blank"
                        class="payment-primary"
                    >
                        Generate / Print Document
                    </a>

                </div>


            @else


                <div
                    class="
                        payment-alert
                        payment-alert-error
                    "
                >

                    Generate / Print is locked.

                    <br>

                    The request must be
                    <strong>
                        Ready for Release
                    </strong>

                    or

                    <strong>
                        Released
                    </strong>

                    and payment must be completed when required.

                </div>


            @endif


        </div>


    </section>


</div>


@endsection