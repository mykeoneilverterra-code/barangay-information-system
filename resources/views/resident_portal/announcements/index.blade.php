@extends('layouts.resident')


@section(
    'title',
    'Announcements'
)


@section(
    'page-title',
    'Announcements'
)


@section(
    'page-subtitle',
    'Stay informed with barangay news, activities, and community updates.'
)


@section('content')


@include(
    'resident_portal.announcements._styles'
)


<div class="resident-announcements-page">


    {{-- =====================================================
        PAGE HERO
    ====================================================== --}}

    <section class="resident-announcements-hero">


        <div class="resident-announcements-hero-content">


            <p class="resident-announcements-eyebrow">
                BARANGAY SAN ANTONIO
            </p>


            <h2>
                Barangay Announcements
            </h2>


            <p class="resident-announcements-hero-description">

                Keep up with community programs, health
                activities, youth events, government notices,
                and other important barangay updates.

            </p>


        </div>


        <div class="resident-announcements-hero-right">


            <div class="resident-announcements-count">

                <strong>
                    {{ $announcements->total() }}
                </strong>

                <span>
                    Published Updates
                </span>

            </div>


            <a
                href="{{ route(
                    'resident.portal'
                ) }}"
                class="resident-announcements-back"
            >

                <span>
                    ←
                </span>

                Back to Dashboard

            </a>


        </div>


    </section>



    {{-- =====================================================
        ANNOUNCEMENTS
    ====================================================== --}}

    <section class="resident-announcements-panel">


        <div class="resident-announcements-panel-header">


            <div class="resident-announcements-panel-title">


                <div class="resident-announcements-panel-icon">

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


                <div class="resident-announcements-panel-copy">

                    <span>
                        BARANGAY UPDATES
                    </span>

                    <h3>
                        Latest Published Announcements
                    </h3>

                </div>


            </div>


        </div>



        <div class="resident-announcements-grid">


            @forelse($announcements as $announcement)


                @php

                    $categoryClass =
                        strtolower(
                            $announcement->category
                        );

                @endphp


                <article class="resident-announcement-full-card">


                    <div class="resident-announcement-full-top">


                        <div
                            class="
                                resident-announcement-full-icon
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
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
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
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
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
                                resident-announcement-full-category
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
                        {{ $announcement->description }}
                    </p>



                    <div class="resident-announcement-full-footer">


                        <div class="resident-announcement-full-date">

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


                    </div>


                </article>


            @empty


                <div class="resident-announcements-empty">


                    <div class="resident-announcements-empty-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path d="M3 11 18 5v14L3 13z"/>
                            <path d="M7 14l2 5h3l-2-6"/>
                        </svg>

                    </div>


                    <strong>
                        No published announcements.
                    </strong>


                    <span>
                        Barangay announcements will appear here once published.
                    </span>


                </div>


            @endforelse


        </div>



        {{-- =================================================
            PAGINATION
        ================================================== --}}

        @if($announcements->hasPages())


            <div class="resident-announcements-pagination">


                <div>

                    Showing

                    <strong>
                        {{ $announcements->firstItem() }}
                    </strong>

                    to

                    <strong>
                        {{ $announcements->lastItem() }}
                    </strong>

                    of

                    <strong>
                        {{ $announcements->total() }}
                    </strong>

                    announcements

                </div>



                <div class="resident-announcements-pagination-controls">


                    @if($announcements->onFirstPage())

                        <span class="disabled">
                            ‹
                        </span>

                    @else

                        <a
                            href="{{ $announcements->previousPageUrl() }}"
                        >
                            ‹
                        </a>

                    @endif



                    <span class="active">

                        {{ $announcements->currentPage() }}

                    </span>



                    @if($announcements->hasMorePages())

                        <a
                            href="{{ $announcements->nextPageUrl() }}"
                        >
                            ›
                        </a>

                    @else

                        <span class="disabled">
                            ›
                        </span>

                    @endif


                </div>


            </div>


        @endif


    </section>


</div>


@endsection