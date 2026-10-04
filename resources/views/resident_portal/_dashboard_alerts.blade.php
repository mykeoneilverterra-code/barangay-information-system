@if(
    isset($readyForPickupRequests)
    &&
    $readyForPickupRequests->isNotEmpty()
)

    <section class="resident-attention-section">


        <div class="resident-attention-heading">

            <div class="resident-attention-heading-copy">

                <span>
                    IMPORTANT UPDATES
                </span>

                <h3>
                    What needs your attention
                </h3>

            </div>

        </div>



        <div class="resident-attention-list">


            @foreach($readyForPickupRequests as $requestItem)


                @php

                    $cashPaymentDue =
                        $requestItem->payment_required
                        &&
                        $requestItem->payment_method === 'Cash'
                        &&
                        $requestItem->payment_status === 'Unpaid';


                    $paymentCompleted =
                        !$requestItem->payment_required
                        ||
                        $requestItem->payment_status === 'Paid';

                @endphp



                <article class="resident-pickup-alert">


                    {{-- ICON --}}

                    <div class="resident-pickup-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2.4"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M20 6 9 17l-5-5"/>
                        </svg>

                    </div>



                    {{-- CONTENT --}}

                    <div class="resident-pickup-content">


                        {{-- CASH + UNPAID --}}

                        @if($cashPaymentDue)


                            <h4>
                                {{ $requestItem->document_type }}
                                is ready for pickup and payment
                                at the Barangay Hall.
                            </h4>


                            <p>

                                Your document is now available at

                                <strong>
                                    Barangay San Antonio Barangay Hall
                                </strong>.

                                Please prepare the

                                <strong>
                                    exact amount of
                                    ₱{{ number_format(
                                        (float) $requestItem->amount,
                                        2
                                    ) }}
                                </strong>

                                and bring a

                                <strong>
                                    valid ID
                                </strong>

                                when claiming.

                            </p>



                        {{-- PAID / NO PAYMENT REQUIRED --}}

                        @elseif($paymentCompleted)


                            <h4>
                                {{ $requestItem->document_type }}
                                is ready for pickup.
                            </h4>


                            <p>

                                Your document is now available at

                                <strong>
                                    Barangay San Antonio Barangay Hall
                                </strong>.

                                Please bring a

                                <strong>
                                    valid ID
                                </strong>

                                when claiming.

                            </p>



                        {{-- OTHER PAYMENT STATE --}}

                        @else


                            <h4>
                                {{ $requestItem->document_type }}
                                is ready for release.
                            </h4>


                            <p>

                                Please complete the required payment
                                before claiming your document at

                                <strong>
                                    Barangay San Antonio Barangay Hall
                                </strong>.

                            </p>


                        @endif


                    </div>



                    {{-- ACTION --}}

                    <a
                        href="{{ route(
                            'resident.requests.show',
                            $requestItem
                        ) }}"
                        class="resident-pickup-action"
                    >

                        View Request

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M5 12h14"/>
                            <path d="m13 6 6 6-6 6"/>
                        </svg>

                    </a>


                </article>


            @endforeach


        </div>


    </section>

@endif