@extends('layouts.resident')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section(
    'page-subtitle',
    'Access your resident information and barangay services.'
)

@section('content')

@php
    $resident = auth()->user()->resident;
@endphp


<div class="resident-modern-dashboard">


    {{-- =====================================================
        HERO / QUICK ACTION
    ====================================================== --}}
    <section class="resident-home-hero">

        <div class="resident-home-hero-content">

            <p class="resident-modern-eyebrow">
                BARANGAY SAN ANTONIO
            </p>

            <h2>
                Barangay services made easier.
            </h2>

            <p>
                Request documents, monitor your applications,
                and review your registered resident information
                in one place.
            </p>


            <div class="resident-home-hero-actions">

                <a
                    href="{{ route('resident.requests.create') }}"
                    class="resident-modern-primary-button"
                >
                    Request Document

                    <span>
                        →
                    </span>
                </a>


                <a
                    href="{{ route('resident.requests.index') }}"
                    class="resident-modern-secondary-button"
                >
                    View My Requests
                </a>

            </div>

        </div>


        <div class="resident-home-hero-visual">

            <img
                src="{{ asset('images/dashboard/barangay-banner.png') }}"
                alt="Barangay San Antonio"
            >

            <div class="resident-home-hero-overlay"></div>

            <div class="resident-home-hero-badge">

                <div class="resident-home-hero-badge-icon">
                    BI
                </div>

                <div>

                    <span>
                        Resident Portal
                    </span>

                    <strong>
                        Barangay San Antonio
                    </strong>

                </div>

            </div>

        </div>

    </section>



    {{-- =====================================================
        ACCOUNT SUMMARY
    ====================================================== --}}
    <section class="resident-modern-section">

        <div class="resident-modern-section-heading">

            <div>

                <p class="resident-modern-eyebrow">
                    YOUR ACCOUNT
                </p>

                <h3>
                    Resident Overview
                </h3>

            </div>


            <a
                href="{{ route('resident.profile') }}"
                class="resident-modern-text-link"
            >
                View Profile
                <span>→</span>
            </a>

        </div>


        <div class="resident-modern-summary-grid">


            {{-- Resident Number --}}
            <div class="resident-modern-summary-card">

                <div class="resident-modern-summary-icon resident-summary-green">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    >
                        <path d="M10 3 8 21"/>
                        <path d="M16 3 14 21"/>
                        <path d="M4 9h16"/>
                        <path d="M3 15h16"/>
                    </svg>

                </div>


                <div>

                    <span>
                        Resident Number
                    </span>

                    <strong>
                        {{ $resident->resident_number }}
                    </strong>

                    <small>
                        Your barangay resident ID
                    </small>

                </div>

            </div>



            {{-- Location --}}
            <div class="resident-modern-summary-card">

                <div class="resident-modern-summary-icon resident-summary-blue">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"/>
                        <circle cx="12" cy="10" r="2.5"/>
                    </svg>

                </div>


                <div>

                    <span>
                        Village / Street
                    </span>

                    <strong>
                        {{ $resident->area ?? 'Not provided' }}
                    </strong>

                    <small>
                        Barangay San Antonio
                    </small>

                </div>

            </div>



            {{-- Voter --}}
            <div class="resident-modern-summary-card">

                <div class="resident-modern-summary-icon resident-summary-gold">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M6 2h9l5 5v15H6z"/>
                        <path d="M14 2v6h6"/>
                        <path d="m9 14 2 2 4-4"/>
                    </svg>

                </div>


                <div>

                    <span>
                        Voter Status
                    </span>

                    <strong>
                        {{ $resident->is_voter
                            ? 'Registered Voter'
                            : 'Not Registered'
                        }}
                    </strong>

                    <small>
                        Barangay voter information
                    </small>

                </div>

            </div>

        </div>

    </section>



    {{-- =====================================================
        RESIDENT SERVICES
    ====================================================== --}}
    <section class="resident-modern-section resident-modern-services-section">

        <div class="resident-modern-section-heading">

            <div>

                <p class="resident-modern-eyebrow">
                    ONLINE SERVICES
                </p>

                <h3>
                    Resident Services
                </h3>

                <p>
                    Choose a service to continue.
                </p>

            </div>

        </div>


        <div class="resident-modern-service-grid">


            {{-- Request Document --}}
            <a
                href="{{ route('resident.requests.create') }}"
                class="resident-modern-service-card"
            >

                <div class="resident-modern-service-top">

                    <div class="resident-modern-service-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M6 2h9l5 5v15H6z"/>
                            <path d="M14 2v6h6"/>
                            <path d="M12 12v6"/>
                            <path d="M9 15h6"/>
                        </svg>

                    </div>


                    <span class="resident-modern-service-arrow">
                        ↗
                    </span>

                </div>


                <div class="resident-modern-service-content">

                    <h4>
                        Request Document
                    </h4>

                    <p>
                        Submit requests for barangay clearances
                        and certificates online.
                    </p>

                </div>


                <div class="resident-modern-service-footer">
                    Start a new request
                </div>

            </a>



            {{-- My Requests --}}
            <a
                href="{{ route('resident.requests.index') }}"
                class="resident-modern-service-card"
            >

                <div class="resident-modern-service-top">

                    <div class="resident-modern-service-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <rect
                                x="5"
                                y="3"
                                width="14"
                                height="18"
                                rx="2"
                            />

                            <path d="M9 8h6"/>
                            <path d="M9 12h6"/>
                            <path d="M9 16h4"/>
                        </svg>

                    </div>


                    <span class="resident-modern-service-arrow">
                        ↗
                    </span>

                </div>


                <div class="resident-modern-service-content">

                    <h4>
                        My Requests
                    </h4>

                    <p>
                        Track your submitted document requests
                        and their current processing status.
                    </p>

                </div>


                <div class="resident-modern-service-footer">
                    View request history
                </div>

            </a>



            {{-- My Profile --}}
            <a
                href="{{ route('resident.profile') }}"
                class="resident-modern-service-card"
            >

                <div class="resident-modern-service-top">

                    <div class="resident-modern-service-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <circle cx="12" cy="7" r="4"/>
                            <path d="M5 21v-2a7 7 0 0 1 14 0v2"/>
                        </svg>

                    </div>


                    <span class="resident-modern-service-arrow">
                        ↗
                    </span>

                </div>


                <div class="resident-modern-service-content">

                    <h4>
                        My Profile
                    </h4>

                    <p>
                        Review your registered personal,
                        contact, and address information.
                    </p>

                </div>


                <div class="resident-modern-service-footer">
                    View resident information
                </div>

            </a>

        </div>

    </section>


    {{-- =====================================================
        INFORMATION STRIP
    ====================================================== --}}
    <section class="resident-modern-help-strip">

        <div class="resident-modern-help-icon">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
            >
                <circle cx="12" cy="12" r="10"/>
                <path d="M12 11v6"/>
                <path d="M12 7h.01"/>
            </svg>

        </div>


        <div>

            <strong>
                Need to correct your resident information?
            </strong>

            <p>
                Official resident records are maintained by the
                barangay administrator. Contact the barangay office
                if your registered information needs to be updated.
            </p>

        </div>

    </section>

</div>

@endsection