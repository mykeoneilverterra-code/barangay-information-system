@extends('layouts.resident')

@section(
    'title',
    'Payment'
)

@section(
    'page-title',
    'Payment'
)

@section(
    'page-subtitle',
    'Choose how you would like to settle the document fee.'
)

@section('content')


@include('payments._styles')


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


    <section class="payment-card">


        <div class="payment-card-header">

            <div>

                <h2>
                    Payment Summary
                </h2>

                <p>
                    {{ $documentRequest->request_number }}
                </p>

            </div>


            <a
                href="{{ route(
                    'resident.requests.show',
                    $documentRequest
                ) }}"
                class="payment-secondary"
            >
                Back to Request
            </a>

        </div>


        <div class="payment-card-body">


            <div class="payment-grid">


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
                        Amount Due
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
                        Selected Method
                    </span>

                    <strong>
                        {{
                            $documentRequest->payment_method
                            ?? 'Not selected'
                        }}
                    </strong>

                </div>


                <div class="payment-info-item">

                    <span>
                        Payment Status
                    </span>

                    @php

                        $paymentStatusClass =
                            match(
                                $documentRequest
                                    ->payment_status
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


            </div>


        </div>


    </section>


    @if(
        $documentRequest->payment_status
        !== 'Paid'
        &&
        $documentRequest->payment_status
        !== 'Pending Verification'
    )


        <section class="payment-card">


            <div class="payment-card-header">

                <div>

                    <h2>
                        Choose Payment Method
                    </h2>

                    <p>
                        GCash is optional. You may also pay personally at the Barangay Hall.
                    </p>

                </div>

            </div>


            <div class="payment-card-body">


                <div class="payment-method-grid">


                    {{-- GCash --}}
                    <div class="
                        payment-method-card
                        {{
                            $documentRequest->payment_method
                            === 'GCash'
                                ? 'selected'
                                : ''
                        }}
                    ">

                        <div class="payment-method-icon">
                            G
                        </div>

                        <h3>
                            Pay via GCash
                        </h3>

                        <p>
                            Scan the barangay GCash QR code,
                            then upload your payment receipt
                            and reference number.
                        </p>

                        <form
                            action="{{ route(
                                'resident.payments.method',
                                $documentRequest
                            ) }}"
                            method="POST"
                        >

                            @csrf

                            <input
                                type="hidden"
                                name="payment_method"
                                value="GCash"
                            >

                            <button
                                type="submit"
                                class="payment-primary"
                            >
                                Choose GCash
                            </button>

                        </form>

                    </div>


                    {{-- CASH --}}
                    <div class="
                        payment-method-card
                        {{
                            $documentRequest->payment_method
                            === 'Cash'
                                ? 'selected'
                                : ''
                        }}
                    ">

                        <div class="payment-method-icon">
                            ₱
                        </div>

                        <h3>
                            Pay at Barangay Hall
                        </h3>

                        <p>
                            Settle the fee personally at
                            the Barangay Hall. Present your
                            request number when paying.
                        </p>

                        <form
                            action="{{ route(
                                'resident.payments.method',
                                $documentRequest
                            ) }}"
                            method="POST"
                        >

                            @csrf

                            <input
                                type="hidden"
                                name="payment_method"
                                value="Cash"
                            >

                            <button
                                type="submit"
                                class="payment-primary"
                            >
                                Pay at Barangay Hall
                            </button>

                        </form>

                    </div>


                </div>


            </div>


        </section>


    @endif



    {{-- =====================================================
        GCASH FORM
    ====================================================== --}}

    @if(
        $documentRequest->payment_method
        === 'GCash'
        &&
        in_array(
            $documentRequest->payment_status,
            [
                'Unpaid',
                'Rejected',
            ],
            true
        )
    )


        <section class="payment-card">


            <div class="payment-card-header">

                <div>

                    <h2>
                        GCash Payment
                    </h2>

                    <p>
                        Pay the exact amount and submit your receipt below.
                    </p>

                </div>

            </div>


            <div class="payment-card-body">


                @if(
                    $documentRequest->payment_status
                    === 'Rejected'
                )

                    <div
                        class="
                            payment-alert
                            payment-alert-error
                        "
                        style="margin-bottom: 16px;"
                    >

                        <strong>
                            Previous payment was rejected.
                        </strong>

                        @if(
                            $documentRequest
                                ->payment_admin_remarks
                        )

                            <div>
                                Reason:
                                {{
                                    $documentRequest
                                        ->payment_admin_remarks
                                }}
                            </div>

                        @endif

                    </div>

                @endif


                <div class="gcash-box">


                    <div class="gcash-qr">


                        @php

                            $qrPath =
                                config(
                                    'barangay.gcash.qr_path'
                                );

                            $qrExists =
                                $qrPath
                                && file_exists(
                                    public_path(
                                        $qrPath
                                    )
                                );

                        @endphp


                        @if($qrExists)

                            <img
                                src="{{ asset(
                                    $qrPath
                                ) }}"
                                alt="Barangay GCash QR Code"
                            >

                        @else

                            <div class="gcash-qr-placeholder">

                                GCash QR image is not
                                configured yet.

                                <br><br>

                                Add:

                                <br>

                                <strong>
                                    public/images/payments/gcash-qr.png
                                </strong>

                            </div>

                        @endif


                    </div>


                    <div class="gcash-details">


                        <h3>
                            Pay ₱{{ number_format(
                                (float) $documentRequest->amount,
                                2
                            ) }}
                        </h3>


                        <p>
                            Scan the QR code using GCash.
                            After completing the payment,
                            enter the reference number and
                            upload your receipt.
                        </p>


                        <div class="gcash-account">

                            <span>
                                GCash Account
                            </span>

                            <strong>
                                {{
                                    config(
                                        'barangay.gcash.account_name'
                                    )
                                }}
                            </strong>

                            <strong>
                                {{
                                    config(
                                        'barangay.gcash.account_number'
                                    )
                                }}
                            </strong>

                        </div>


                        <form
                            action="{{ route(
                                'resident.payments.gcash.submit',
                                $documentRequest
                            ) }}"
                            method="POST"
                            enctype="multipart/form-data"
                            class="payment-form"
                        >

                            @csrf


                            <div class="payment-field">

                                <label for="payment_reference">
                                    GCash Reference Number
                                </label>

                                <input
                                    type="text"
                                    id="payment_reference"
                                    name="payment_reference"
                                    value="{{ old(
                                        'payment_reference'
                                    ) }}"
                                    placeholder="Example: 1234567890123"
                                >

                                @error('payment_reference')

                                    <div class="payment-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            <div class="payment-field">

                                <label for="payment_proof">
                                    Payment Receipt
                                </label>

                                <input
                                    type="file"
                                    id="payment_proof"
                                    name="payment_proof"
                                    accept=".jpg,.jpeg,.png,.pdf"
                                >

                                @error('payment_proof')

                                    <div class="payment-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            <div>

                                <button
                                    type="submit"
                                    class="payment-primary"
                                >
                                    Submit Payment Proof
                                </button>

                            </div>


                        </form>


                    </div>


                </div>


            </div>


        </section>


    @endif



    {{-- CASH INSTRUCTIONS --}}

    @if(
        $documentRequest->payment_method
        === 'Cash'
        &&
        $documentRequest->payment_status
        !== 'Paid'
    )


        <section class="payment-card">


            <div class="payment-card-header">

                <div>

                    <h2>
                        Pay at Barangay Hall
                    </h2>

                    <p>
                        Your payment will be verified by the administrator after you pay onsite.
                    </p>

                </div>

            </div>


            <div class="payment-card-body">


                <div class="payment-grid">


                    <div class="payment-info-item">

                        <span>
                            Amount to Pay
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
                            Present This Request Number
                        </span>

                        <strong>
                            {{ $documentRequest->request_number }}
                        </strong>

                    </div>


                </div>


            </div>


        </section>


    @endif



    {{-- PENDING --}}

    @if(
        $documentRequest->payment_status
        === 'Pending Verification'
    )


        <section class="payment-card">


            <div class="payment-card-body">


                <div
                    class="
                        payment-alert
                        payment-alert-success
                    "
                >

                    Your GCash receipt has been submitted.
                    The Barangay Administrator will verify
                    the payment before it is marked Paid.

                </div>


                <div
                    class="payment-grid"
                    style="margin-top: 14px;"
                >


                    <div class="payment-info-item">

                        <span>
                            Reference Number
                        </span>

                        <strong>
                            {{
                                $documentRequest
                                    ->payment_reference
                            }}
                        </strong>

                    </div>


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
                                View Submitted Receipt
                            </a>

                        </strong>

                    </div>


                </div>


            </div>


        </section>


    @endif


</div>


@endsection