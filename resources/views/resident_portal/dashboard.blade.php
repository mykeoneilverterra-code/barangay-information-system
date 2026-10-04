@extends('layouts.resident')


@section(
    'title',
    'Dashboard'
)


@section(
    'page-title',
    'Dashboard'
)


@section(
    'page-subtitle',
    'Access barangay services, requests, and community updates.'
)


@section('content')


@include(
    'resident_portal._dashboard_announcement_styles'
)


@include(
    'resident_portal._dashboard_alert_styles'
)


@php

    $resident =
        auth()
            ->user()
            ->resident;


    $firstName =
        $resident
            ? explode(
                ' ',
                trim(
                    $resident->full_name
                )
            )[0]
            : 'Resident';

@endphp



<div class="resident-modern-dashboard">


    {{-- =====================================================
        HERO
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

                Good day,
                <strong>
                    {{ $firstName }}
                </strong>.

                Request barangay documents,
                track your requests,
                and stay informed with
                the latest community updates.

            </p>


            <div class="resident-home-hero-actions">


                <a
                    href="{{ route(
                        'resident.requests.create'
                    ) }}"
                    class="resident-modern-primary-button"
                >
                    Request Document
                </a>


                <a
                    href="{{ route(
                        'resident.requests.index'
                    ) }}"
                    class="resident-modern-secondary-button"
                >
                    View My Requests
                </a>


            </div>


        </div>



        <div class="resident-home-hero-visual">


            <img
                src="{{ asset(
                    'images/dashboard/barangay-banner.png'
                ) }}"
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
        IMPORTANT PICKUP ALERT
    ====================================================== --}}

    @include(
        'resident_portal._dashboard_alerts'
    )



    {{-- =====================================================
        LATEST ANNOUNCEMENTS
    ====================================================== --}}

    <section class="resident-modern-section">


        <div class="resident-modern-section-heading">


            <div>

                <p class="resident-modern-eyebrow">
                    COMMUNITY UPDATES
                </p>

                <h3>
                    Latest Announcements
                </h3>

                <p>
                    Stay informed with the latest
                    barangay news and activities.
                </p>

            </div>


            <a
                href="{{ route(
                    'resident.announcements.index'
                ) }}"
                class="resident-modern-text-link"
            >

                View All Announcements

                <span>
                    →
                </span>

            </a>


        </div>



        <div class="resident-dashboard-announcement-grid">


            @forelse($latestAnnouncements as $announcement)


                @php

                    $category =
                        strtolower(
                            $announcement->category
                            ?? 'other'
                        );

                @endphp


                <article class="resident-dashboard-announcement-card">


                    <div class="resident-dashboard-announcement-top">


                        <div
                            class="
                                resident-dashboard-announcement-icon
                                resident-announcement-{{ $category }}
                            "
                        >


                            @if($category === 'health')

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path d="M12 21s-7-4.5-7-11a4 4 0 0 1 7-2 4 4 0 0 1 7 2c0 6.5-7 11-7 11z"/>
                                </svg>


                            @elseif($category === 'youth')

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <circle cx="9" cy="8" r="3"/>
                                    <circle cx="17" cy="8" r="3"/>
                                    <path d="M3 20v-2a6 6 0 0 1 12 0v2"/>
                                    <path d="M14 14a6 6 0 0 1 7 6"/>
                                </svg>


                            @elseif($category === 'community')

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path d="M4 13h3l10-5v8L7 11H4z"/>
                                    <path d="M7 13l2 6"/>
                                </svg>


                            @elseif($category === 'government')

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path d="M3 10h18"/>
                                    <path d="M5 10v8"/>
                                    <path d="M9 10v8"/>
                                    <path d="M15 10v8"/>
                                    <path d="M19 10v8"/>
                                    <path d="M2 18h20"/>
                                    <path d="m12 3 9 5H3z"/>
                                </svg>


                            @elseif($category === 'emergency')

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path d="M12 3 2 21h20L12 3z"/>
                                    <path d="M12 9v5"/>
                                    <path d="M12 18h.01"/>
                                </svg>


                            @else

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path d="M3 11 18 5v14L3 13z"/>
                                    <path d="M11 15v5"/>
                                </svg>

                            @endif


                        </div>



                        <span
                            class="
                                resident-dashboard-announcement-category
                                resident-category-{{ $category }}
                            "
                        >
                            {{ $announcement->category }}
                        </span>


                    </div>



                    <div class="resident-dashboard-announcement-content">


                        <h4>
                            {{ $announcement->title }}
                        </h4>


                        <p>
                            {{ $announcement->description }}
                        </p>


                    </div>



                    <div class="resident-dashboard-announcement-date">


                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <rect
                                x="3"
                                y="5"
                                width="18"
                                height="16"
                                rx="2"
                            />

                            <path d="M16 3v4"/>

                            <path d="M8 3v4"/>

                            <path d="M3 11h18"/>
                        </svg>


                        <span>

                            {{
                                $announcement
                                    ->announcement_date
                                    ->format(
                                        'M d, Y'
                                    )
                            }}

                        </span>


                    </div>


                </article>


            @empty


                <div class="resident-dashboard-announcement-empty">

                    No published announcements
                    are available right now.

                </div>


            @endforelse


        </div>


    </section>



    {{-- =====================================================
        RESIDENT SERVICES
    ====================================================== --}}

    <section
        class="
            resident-modern-section
            resident-modern-services-section
        "
    >


        <div class="resident-modern-section-heading">


            <div>

                <p class="resident-modern-eyebrow">
                    RESIDENT SERVICES
                </p>

                <h3>
                    Quick Access
                </h3>

                <p>
                    Manage your barangay records
                    and document requests.
                </p>

            </div>


        </div>



        <div class="resident-modern-service-grid">


            {{-- REQUEST DOCUMENT --}}

            <a
                href="{{ route(
                    'resident.requests.create'
                ) }}"
                class="resident-modern-service-card"
            >


                <div class="resident-modern-service-top">


                    <div class="resident-modern-service-icon">


                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path d="M6 2h9l5 5v15H6z"/>
                            <path d="M14 2v6h6"/>
                            <path d="M13 12H9"/>
                            <path d="M11 10v4"/>
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

                        Submit a request for
                        barangay clearance,
                        residency,
                        or indigency certificate.

                    </p>

                </div>


                <div class="resident-modern-service-footer">
                    Create Request →
                </div>


            </a>



            {{-- MY REQUESTS --}}

            <a
                href="{{ route(
                    'resident.requests.index'
                ) }}"
                class="resident-modern-service-card"
            >


                <div class="resident-modern-service-top">


                    <div class="resident-modern-service-icon">


                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path d="M8 6h13"/>
                            <path d="M8 12h13"/>
                            <path d="M8 18h13"/>
                            <path d="M3 6h.01"/>
                            <path d="M3 12h.01"/>
                            <path d="M3 18h.01"/>
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

                        Track document status,
                        payment details,
                        and processing updates.

                    </p>

                </div>


                <div class="resident-modern-service-footer">
                    View Requests →
                </div>


            </a>



            {{-- MY PROFILE --}}

            <a
                href="{{ route(
                    'resident.profile'
                ) }}"
                class="resident-modern-service-card"
            >


                <div class="resident-modern-service-top">


                    <div class="resident-modern-service-icon">


                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <circle
                                cx="12"
                                cy="8"
                                r="4"
                            />

                            <path
                                d="
                                    M4 21
                                    v-2
                                    a8 8 0 0 1
                                    16 0
                                    v2
                                "
                            />
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

                        Review your personal
                        information and resident
                        record.

                    </p>

                </div>


                <div class="resident-modern-service-footer">
                    View Profile →
                </div>


            </a>


        </div>


    </section>


</div>


@endsection