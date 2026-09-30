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
    'Access your resident information and barangay services.'
)


@section('content')


@include(
    'resident_portal._dashboard_announcement_styles'
)


<div class="resident-home-dashboard">


    {{-- =====================================================
        HERO
    ====================================================== --}}

    <section class="resident-home-hero">


        <div class="resident-home-hero-content">


            <p class="resident-home-eyebrow">
                BARANGAY SAN ANTONIO
            </p>


            <h2>
                Barangay services made easier.
            </h2>


            <p class="resident-home-hero-description">

                Request documents, monitor your applications,
                and stay updated with the latest barangay
                announcements in one place.

            </p>


            <div class="resident-home-hero-actions">


                <a
                    href="{{ route(
                        'resident.requests.create'
                    ) }}"
                    class="resident-home-primary"
                >

                    <svg
                        width="16"
                        height="16"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path d="M6 2h9l5 5v15H6z"/>
                        <path d="M14 2v6h6"/>
                        <path d="M12 12v6"/>
                        <path d="M9 15h6"/>
                    </svg>

                    Request Document

                    <span>
                        →
                    </span>

                </a>


                <a
                    href="{{ route(
                        'resident.requests.index'
                    ) }}"
                    class="resident-home-secondary"
                >

                    <svg
                        width="16"
                        height="16"
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

                    View My Requests

                </a>


            </div>


        </div>


        <div class="resident-home-visual">


            <img
                src="{{ asset(
                    'images/dashboard/barangay-banner.png'
                ) }}"
                alt="Barangay San Antonio"
            >


            <div class="resident-home-visual-overlay"></div>


            <div class="resident-home-badge">


                <div class="resident-home-badge-logo">
                    BI
                </div>


                <div class="resident-home-badge-copy">

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
        LATEST ANNOUNCEMENTS
    ====================================================== --}}

    <section class="resident-home-section">


        <div class="resident-home-section-header">


            <div class="resident-home-section-heading">


                <div class="resident-home-section-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M3 11 18 5v14L3 13z"/>
                        <path d="M7 14l2 5h3l-2-6"/>
                    </svg>

                </div>


                <div class="resident-home-section-copy">

                    <span class="resident-home-section-eyebrow">
                        BARANGAY UPDATES
                    </span>

                    <h3>
                        Latest Announcements
                    </h3>

                    <p>
                        Stay informed with the latest news and activities from Barangay San Antonio.
                    </p>

                </div>


            </div>


            <a
                href="{{ route(
                    'resident.announcements.index'
                ) }}"
                class="resident-home-view-all"
            >

                View All Announcements

                <span>
                    →
                </span>

            </a>


        </div>


        <div class="resident-announcement-grid">


            @forelse(
                $latestAnnouncements
                as $announcement
            )


                @php

                    $categoryClass =
                        strtolower(
                            $announcement->category
                        );

                @endphp


                <article class="resident-announcement-card">


                    <div class="resident-announcement-card-top">


                        <div
                            class="
                                resident-announcement-icon
                                {{ $categoryClass }}
                            "
                        >

                            @if(
                                $announcement->category
                                === 'Community'
                            )

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path d="M12 22V10"/>
                                    <path d="M8 6c2 0 4 2 4 4-2 0-4-2-4-4Z"/>
                                    <path d="M16 4c-2 0-4 2-4 6 3 0 5-3 4-6Z"/>
                                </svg>


                            @elseif(
                                $announcement->category
                                === 'Youth'
                            )

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <circle cx="9" cy="7" r="3"/>
                                    <circle cx="17" cy="8" r="2"/>
                                    <path d="M3 21v-3a6 6 0 0 1 12 0v3"/>
                                    <path d="M15 14a4 4 0 0 1 6 4v3"/>
                                </svg>


                            @elseif(
                                $announcement->category
                                === 'Health'
                            )

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path d="M12 21S4 16 4 9a4 4 0 0 1 7-2.7A4 4 0 0 1 18 9c0 7-6 12-6 12Z"/>
                                </svg>


                            @elseif(
                                $announcement->category
                                === 'Government'
                            )

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
                                    <path d="m12 3 9 5H3Z"/>
                                </svg>


                            @elseif(
                                $announcement->category
                                === 'Emergency'
                            )

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path d="M12 3 2 21h20Z"/>
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
                                </svg>

                            @endif


                        </div>


                        <span
                            class="
                                resident-announcement-category
                                {{ $categoryClass }}
                            "
                        >
                            {{ $announcement->category }}
                        </span>


                    </div>


                    <h4>
                        {{ $announcement->title }}
                    </h4>


                    <p>
                        {{
                            \Illuminate\Support\Str::limit(
                                $announcement->description,
                                125
                            )
                        }}
                    </p>


                    <div class="resident-announcement-date">

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

                        {{
                            $announcement
                                ->announcement_date
                                ->format(
                                    'M d, Y'
                                )
                        }}

                    </div>


                </article>


            @empty


                <div class="resident-announcement-empty">

                    <strong>
                        No announcements available.
                    </strong>

                    <span>
                        Published barangay announcements will appear here.
                    </span>

                </div>


            @endforelse


        </div>


    </section>



    {{-- =====================================================
        RESIDENT SERVICES
    ====================================================== --}}

    <section class="resident-home-section">


        <div class="resident-home-section-header">


            <div class="resident-home-section-heading">


                <div class="resident-home-section-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <rect
                            x="3"
                            y="3"
                            width="7"
                            height="7"
                            rx="1"
                        />
                        <rect
                            x="14"
                            y="3"
                            width="7"
                            height="7"
                            rx="1"
                        />
                        <rect
                            x="3"
                            y="14"
                            width="7"
                            height="7"
                            rx="1"
                        />
                        <rect
                            x="14"
                            y="14"
                            width="7"
                            height="7"
                            rx="1"
                        />
                    </svg>

                </div>


                <div class="resident-home-section-copy">

                    <span class="resident-home-section-eyebrow">
                        ONLINE SERVICES
                    </span>

                    <h3>
                        Resident Services
                    </h3>

                    <p>
                        Choose a service to continue.
                    </p>

                </div>


            </div>


        </div>


        <div class="resident-service-grid">


            {{-- Request Document --}}

            <a
                href="{{ route(
                    'resident.requests.create'
                ) }}"
                class="resident-service-card"
            >


                <div class="resident-service-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path d="M6 2h9l5 5v15H6z"/>
                        <path d="M14 2v6h6"/>
                        <path d="M12 12v6"/>
                        <path d="M9 15h6"/>
                    </svg>

                </div>


                <div class="resident-service-copy">

                    <strong>
                        Request Document
                    </strong>

                    <span>
                        Submit requests for barangay clearances and certificates.
                    </span>

                </div>


                <span class="resident-service-arrow">
                    ›
                </span>


            </a>



            {{-- My Requests --}}

            <a
                href="{{ route(
                    'resident.requests.index'
                ) }}"
                class="resident-service-card"
            >


                <div class="
                    resident-service-icon
                    blue
                ">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <rect
                            x="5"
                            y="3"
                            width="14"
                            height="18"
                            rx="2"
                        />
                        <path d="M8 8h8"/>
                        <path d="M8 12h8"/>
                        <path d="M8 16h5"/>
                    </svg>

                </div>


                <div class="resident-service-copy">

                    <strong>
                        My Requests
                    </strong>

                    <span>
                        Track requests, payment status, and document progress.
                    </span>

                </div>


                <span class="resident-service-arrow">
                    ›
                </span>


            </a>



            {{-- My Profile --}}

            <a
                href="{{ route(
                    'resident.profile'
                ) }}"
                class="resident-service-card"
            >


                <div class="
                    resident-service-icon
                    gold
                ">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <circle
                            cx="12"
                            cy="7"
                            r="4"
                        />
                        <path d="M5 21v-2a7 7 0 0 1 14 0v2"/>
                    </svg>

                </div>


                <div class="resident-service-copy">

                    <strong>
                        My Profile
                    </strong>

                    <span>
                        Review your official barangay resident information.
                    </span>

                </div>


                <span class="resident-service-arrow">
                    ›
                </span>


            </a>


        </div>


    </section>


</div>


@endsection