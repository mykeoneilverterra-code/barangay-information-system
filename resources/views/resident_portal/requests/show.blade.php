@extends('layouts.resident')


@section(
    'title',
    'Request Details'
)


@section(
    'page-title',
    'Request Details'
)


@section(
    'page-subtitle',
    'Review your document request, payment information, and current status.'
)


@section('content')


@include('payments._styles')


@php

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

        <div
            class="
                payment-alert
                payment-alert-success
            "
        >
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div
            class="
                payment-alert
                payment-alert-error
            "
        >
            {{ session('error') }}
        </div>

    @endif



    {{-- =====================================================
        REQUEST INFORMATION
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


            <a
                href="{{ route(
                    'resident.requests.index'
                ) }}"
                class="payment-secondary"
            >
                Back to My Requests
            </a>


        </div>



        <div class="payment-card-body">


            <div class="payment-grid">


                <div class="payment-info-item">

                    <span>
                        Request Number
                    </span>

                    <strong>
                        {{ $documentRequest->request_number }}
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
                                ->format(
                                    'M d, Y'
                                )
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



                <div class="payment-info-item">

                    <span>
                        Admin Remarks
                    </span>

                    <strong>

                        {{
                            $documentRequest
                                ->admin_remarks
                            ?: 'No remarks'
                        }}

                    </strong>

                </div>


            </div>


        </div>


    </section>



    {{-- =====================================================
        PAYMENT INFORMATION
    ====================================================== --}}

    <section class="payment-card">


        <div class="payment-card-header">


            <div>

                <h2>
                    Payment Information
                </h2>

                <p>
                    Payment details for this document request.
                </p>

            </div>



            @if(
                $documentRequest->payment_required
                &&
                $documentRequest->payment_status !== 'Paid'
                &&
                $documentRequest->payment_status !== 'Pending Verification'
                &&
                $documentRequest->payment_method !== 'Cash'
            )

                <a
                    href="{{ route(
                        'resident.payments.choose',
                        $documentRequest
                    ) }}"
                    class="payment-primary"
                >
                    Choose Payment Method
                </a>

            @endif


        </div>



        <div class="payment-card-body">


            @if(
                !$documentRequest->payment_required
            )


                <div
                    class="
                        payment-alert
                        payment-alert-success
                    "
                >

                    No payment is required
                    for this document.

                </div>


            @else


                <div class="payment-grid">


                    <div class="payment-info-item">

                        <span>
                            Amount Due
                        </span>

                        <strong>

                            ₱{{ number_format(
                                (float)
                                $documentRequest->amount,
                                2
                            ) }}

                        </strong>

                    </div>



                    <div class="payment-info-item">

                        <span>
                            Payment Method
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
                                {{
                                    $documentRequest
                                        ->payment_status
                                }}
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
                            ->payment_proof_path
                    )

                        <div class="payment-info-item">

                            <span>
                                Payment Proof
                            </span>

                            <strong>

                                <a
                                    href="{{ route(
                                        'resident.payments.proof',
                                        $documentRequest
                                    ) }}"
                                    target="_blank"
                                    class="payment-proof-link"
                                >
                                    View Receipt
                                </a>

                            </strong>

                        </div>

                    @endif


                </div>



                {{-- CASH PAYMENT NOTICE --}}

                @if(
                    $documentRequest->payment_method === 'Cash'
                    &&
                    $documentRequest->payment_status === 'Unpaid'
                )

                    <div
                        class="
                            payment-alert
                            payment-alert-success
                        "
                        style="margin-top: 15px;"
                    >

                        Payment will be collected
                        at the Barangay Hall.

                        <br>

                        Please prepare the

                        <strong>
                            exact amount of
                            ₱{{ number_format(
                                (float)
                                $documentRequest->amount,
                                2
                            ) }}
                        </strong>.

                    </div>

                @endif



                {{-- GCASH REJECTED --}}

                @if(
                    $documentRequest->payment_status
                    === 'Rejected'
                )

                    <div
                        class="
                            payment-alert
                            payment-alert-error
                        "
                        style="margin-top: 15px;"
                    >

                        <strong>
                            Payment rejected.
                        </strong>

                        <br>

                        {{
                            $documentRequest
                                ->payment_admin_remarks
                            ?: 'Please submit another payment proof.'
                        }}

                    </div>


                    <div class="payment-actions">

                        <a
                            href="{{ route(
                                'resident.payments.choose',
                                $documentRequest
                            ) }}"
                            class="payment-primary"
                        >
                            Try Again
                        </a>

                    </div>

                @endif


            @endif


        </div>


    </section>



    {{-- =====================================================
        PICKUP STATUS
    ====================================================== --}}

    @if(
        $documentRequest->status === 'Ready for Release'
        ||
        $documentRequest->status === 'Released'
    )


        <section class="payment-card">


            <div class="payment-card-header">


                <div>

                    <h2>
                        Document Status
                    </h2>

                    <p>
                        Information about claiming
                        your requested document.
                    </p>

                </div>


            </div>



            <div class="payment-card-body">


                @if(
                    $documentRequest->status
                    === 'Ready for Release'
                )


                    <div
                        class="
                            payment-alert
                            payment-alert-success
                        "
                    >

                        <strong>

                            {{ $documentRequest->document_type }}
                            is ready for pickup.

                        </strong>

                        <br><br>

                        Your document is now available at

                        <strong>
                            Barangay San Antonio Barangay Hall
                        </strong>.


                        @if(
                            $documentRequest->payment_method === 'Cash'
                            &&
                            $documentRequest->payment_status === 'Unpaid'
                        )

                            Please prepare the

                            <strong>
                                exact amount of
                                ₱{{ number_format(
                                    (float)
                                    $documentRequest->amount,
                                    2
                                ) }}
                            </strong>

                            and bring a

                            <strong>
                                valid ID
                            </strong>

                            when claiming.

                        @else

                            Please bring a

                            <strong>
                                valid ID
                            </strong>

                            when claiming.

                        @endif


                    </div>


                @else


                    <div
                        class="
                            payment-alert
                            payment-alert-success
                        "
                    >

                        <strong>
                            Document Released
                        </strong>

                        <br><br>

                        This document has already
                        been released by the
                        Barangay Hall.

                    </div>


                @endif


            </div>


        </section>


    @endif


</div>


@endsection