@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="modern-admin-dashboard">

    {{-- =====================================================
        WELCOME / HERO
    ====================================================== --}}
    <section class="modern-dashboard-hero">

        <div class="modern-dashboard-welcome">

            <p class="modern-dashboard-eyebrow">
                BARANGAY SAN ANTONIO, BIÑAN, LAGUNA
            </p>

            <h1>
                Welcome back, Barangay Admin!
            </h1>

            <p>
                Here’s an overview of your barangay’s information
                and latest updates.
            </p>

        </div>


        {{-- Dashboard Banner --}}
        <div class="modern-dashboard-banner">

            <img
                src="{{ asset('images/dashboard/barangay-banner.png') }}"
                alt="Barangay San Antonio"
            >

            <div class="modern-dashboard-banner-overlay">

                <div class="modern-banner-symbol">
                    ☀
                </div>

                <div>
                    <span>
                        A progressive and united
                    </span>

                    <strong>
                        Barangay San Antonio
                    </strong>
                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
        MAIN STATISTICS
    ====================================================== --}}
    <section class="modern-stat-grid">

        {{-- Total Residents --}}
        <a
            href="{{ route('residents.index') }}"
            class="modern-stat-card modern-stat-green"
        >

            <div class="modern-stat-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>

            </div>

            <div class="modern-stat-content">

                <span>
                    Total Residents
                </span>

                <strong>
                    {{ $totalResidents }}
                </strong>

                <small>
                    Registered residents
                </small>

            </div>

        </a>


        {{-- Registered Voters --}}
        <div class="modern-stat-card modern-stat-blue">

            <div class="modern-stat-icon">

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

            <div class="modern-stat-content">

                <span>
                    Registered Voters
                </span>

                <strong>
                    {{ $registeredVoters }}
                </strong>

                <small>
                    Voter records
                </small>

            </div>

        </div>


        {{-- Villages / Streets --}}
        <div class="modern-stat-card modern-stat-gold">

            <div class="modern-stat-icon">

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

            <div class="modern-stat-content">

                <span>
                    Villages / Streets
                </span>

                <strong>
                    {{ $totalAreas }}
                </strong>

                <small>
                    Areas represented
                </small>

            </div>

        </div>


        {{-- Voter Classification --}}
        <div class="modern-stat-card modern-stat-indigo">

            <div class="modern-stat-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <circle cx="8" cy="7" r="3"/>
                    <path d="M3 21v-3a5 5 0 0 1 10 0v3"/>
                    <path d="M17 8v6"/>
                    <path d="M14 11h6"/>
                </svg>

            </div>

            <div class="modern-stat-content">

                <span>
                    Voter Classification
                </span>

                <strong class="modern-voter-main-number">
                    {{ $skVoters }}
                    <span>/</span>
                    {{ $regularVoters }}
                </strong>

                <small>
                    SK Voters / Regular Voters
                </small>

            </div>

        </div>

    </section>


    {{-- =====================================================
        ANALYTICS
    ====================================================== --}}
    <section class="modern-dashboard-analytics">

        {{-- =================================================
            RESIDENT DISTRIBUTION
        ================================================== --}}
        <div class="modern-dashboard-panel modern-location-panel">

            <div class="modern-panel-header">

                <div class="modern-panel-heading">

                    <div class="modern-panel-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        >
                            <path d="M4 20V10"/>
                            <path d="M10 20V4"/>
                            <path d="M16 20v-7"/>
                            <path d="M22 20V7"/>
                        </svg>

                    </div>

                    <div>
                        <h2>
                            Resident Distribution by Village / Street
                        </h2>

                        <p>
                            Number of registered residents per area
                        </p>
                    </div>

                </div>


                <div class="modern-panel-period">
                    Current
                </div>

            </div>


            <div class="modern-bar-chart">

                {{-- Y Axis --}}
                <div class="modern-chart-y-axis">

                    <span>
                        {{ $maxAreaCount }}
                    </span>

                    <span>
                        {{ max(1, (int) round($maxAreaCount * 0.66)) }}
                    </span>

                    <span>
                        {{ max(1, (int) round($maxAreaCount * 0.33)) }}
                    </span>

                    <span>
                        0
                    </span>

                </div>


                {{-- Chart --}}
                <div class="modern-chart-content">

                    <div class="modern-chart-lines">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>


                    <div class="modern-chart-bars">

                        @foreach($areaDistribution as $index => $area)

                            @php
                                $barHeight = max(
                                    12,
                                    round(
                                        ((int) $area->total / $maxAreaCount)
                                        * 100
                                    )
                                );
                            @endphp

                            <div class="modern-chart-column">

                                <div class="modern-chart-value">
                                    {{ $area->total }}
                                </div>

                                <div class="modern-chart-bar-space">

                                    <div
                                        class="modern-chart-bar bar-tone-{{ ($index % 6) + 1 }}"
                                        style="height: {{ $barHeight }}%;"
                                    ></div>

                                </div>

                                <div class="modern-chart-label">
                                    {{ $area->area }}
                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

        </div>


        {{-- =================================================
            VOTER CLASSIFICATION
        ================================================== --}}
        <div class="modern-dashboard-panel modern-voter-panel">

            <div class="modern-panel-header">

                <div class="modern-panel-heading">

                    <div class="modern-panel-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M12 2v10l8 4"/>
                            <path d="M12 12 5 19"/>
                            <circle cx="12" cy="12" r="10"/>
                        </svg>

                    </div>

                    <div>
                        <h2>
                            Voter Classification
                        </h2>

                        <p>
                            Distribution of registered voters
                        </p>
                    </div>

                </div>

            </div>


            <div class="modern-voter-list">

                {{-- SK Voters --}}
                <div class="modern-voter-item">

                    <div class="modern-voter-icon modern-voter-sk">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <circle cx="9" cy="7" r="3"/>
                            <circle cx="17" cy="8" r="2"/>
                            <path d="M3 21v-3a6 6 0 0 1 12 0v3"/>
                            <path d="M15 14a4 4 0 0 1 6 3.5V21"/>
                        </svg>

                    </div>


                    <div class="modern-voter-data">

                        <div class="modern-voter-row">

                            <div>

                                <span>
                                    SK Voters
                                </span>

                                <strong>
                                    {{ $skVoters }}
                                </strong>

                                <small>
                                    Ages 15–30
                                </small>

                            </div>

                            <b>
                                {{ $skVoterPercentage }}%
                            </b>

                        </div>


                        <div class="modern-progress-track">

                            <div
                                class="modern-progress-bar modern-progress-sk"
                                style="width: {{ min(100, $skVoterPercentage) }}%;"
                            ></div>

                        </div>

                    </div>

                </div>


                {{-- Regular Voters --}}
                <div class="modern-voter-item">

                    <div class="modern-voter-icon modern-voter-regular">

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


                    <div class="modern-voter-data">

                        <div class="modern-voter-row">

                            <div>

                                <span>
                                    Regular Voters
                                </span>

                                <strong>
                                    {{ $regularVoters }}
                                </strong>

                                <small>
                                    Ages 18+
                                </small>

                            </div>

                            <b>
                                {{ $regularVoterPercentage }}%
                            </b>

                        </div>


                        <div class="modern-progress-track">

                            <div
                                class="modern-progress-bar modern-progress-regular"
                                style="width: {{ min(100, $regularVoterPercentage) }}%;"
                            ></div>

                        </div>

                    </div>

                </div>

            </div>


            <div class="modern-voter-note">
                Residents ages 18–30 may appear in both classifications.
            </div>

        </div>

    </section>


    {{-- =====================================================
        LOWER DASHBOARD ROW
    ====================================================== --}}
    <section class="modern-dashboard-lower-grid">

        {{-- =================================================
            BARANGAY ANNOUNCEMENTS
        ================================================== --}}
        <div class="modern-dashboard-panel modern-announcement-panel">

            <div class="modern-panel-header">

                <div class="modern-panel-heading">

                    <div class="modern-panel-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="m3 11 18-5v12L3 13z"/>
                            <path d="M11.6 15.4 13 21H8l-1.6-6.7"/>
                        </svg>

                    </div>

                    <div>

                        <h2>
                            Barangay Announcements
                        </h2>

                        <p>
                            Latest updates and important reminders
                        </p>

                    </div>

                </div>

            </div>


            <div class="modern-announcement-list">

                @foreach($announcements as $announcement)

                    <div class="modern-announcement-item">

                        {{-- Icon --}}
                        <div class="modern-announcement-symbol announcement-{{ $announcement['type'] }}">

                            @if($announcement['icon'] === 'leaf')

                                <span>⌁</span>

                            @elseif($announcement['icon'] === 'people')

                                <span>●</span>

                            @elseif($announcement['icon'] === 'health')

                                <span>+</span>

                            @else

                                <span>▤</span>

                            @endif

                        </div>


                        {{-- Announcement --}}
                        <div class="modern-announcement-content">

                            <strong>
                                {{ $announcement['title'] }}
                            </strong>

                            <p>
                                {{ $announcement['description'] }}
                            </p>

                        </div>


                        {{-- Date --}}
                        <div class="modern-announcement-date">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.7"
                                stroke-linecap="round"
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

                            {{ $announcement['date'] }}

                        </div>


                        {{-- Category --}}
                        <span class="modern-announcement-category announcement-tag-{{ $announcement['type'] }}">
                            {{ $announcement['category'] }}
                        </span>

                    </div>

                @endforeach

            </div>

        </div>


        {{-- =================================================
            DOCUMENT REQUEST QUEUE
        ================================================== --}}
        <div class="modern-dashboard-panel modern-request-panel">

            <div class="modern-panel-header">

                <div class="modern-panel-heading">

                    <div class="modern-panel-icon">

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
                            <path d="M9 13h6"/>
                            <path d="M9 17h6"/>
                        </svg>

                    </div>

                    <div>

                        <h2>
                            Document Request Queue
                        </h2>

                        <p>
                            Latest document requests submitted by residents
                        </p>

                    </div>

                </div>


                <a
                    href="{{ route('document-requests.index') }}"
                    class="modern-view-all"
                >
                    View All

                    <span>
                        →
                    </span>
                </a>

            </div>


            <div class="modern-request-table-wrapper">

                <table class="modern-request-table">

                    <thead>

                        <tr>

                            <th>
                                #
                            </th>

                            <th>
                                Resident
                            </th>

                            <th>
                                Document
                            </th>

                            <th>
                                Date
                            </th>

                            <th>
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($latestDocumentRequests as $requestItem)

                            @php
                                $statusClass = match($requestItem->status) {
                                    'Pending' => 'modern-status-pending',
                                    'Processing' => 'modern-status-processing',
                                    'Ready for Release' => 'modern-status-ready',
                                    'Released' => 'modern-status-released',
                                    'Cancelled' => 'modern-status-cancelled',
                                    default => 'modern-status-pending',
                                };

                                $requestResident = $requestItem->resident;

                                $residentPhoto = (
                                    $requestResident
                                    && $requestResident->profile_photo_path
                                )
                                    ? asset(
                                        'storage/'
                                        . $requestResident->profile_photo_path
                                    )
                                    : null;
                            @endphp


                            <tr>

                                {{-- Number --}}
                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                {{-- Resident --}}
                                <td>

                                    <div class="modern-request-resident">

                                        <div class="modern-request-avatar">

                                            @if($residentPhoto)

                                                <img
                                                    src="{{ $residentPhoto }}"
                                                    alt="{{ $requestResident->full_name }}"
                                                >

                                            @elseif($requestResident)

                                                {{ strtoupper(
                                                    substr(
                                                        $requestResident->first_name,
                                                        0,
                                                        1
                                                    )
                                                ) }}

                                            @else

                                                ?

                                            @endif

                                        </div>


                                        <div>

                                            <strong>
                                                {{ $requestResident
                                                    ? $requestResident->full_name
                                                    : 'Resident unavailable'
                                                }}
                                            </strong>

                                            <span>
                                                {{ $requestResident
                                                    ? $requestResident->resident_number
                                                    : '—'
                                                }}
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                {{-- Document --}}
                                <td>

                                    <span class="modern-document-badge">
                                        {{ $requestItem->document_type }}
                                    </span>

                                </td>


                                {{-- Date --}}
                                <td>

                                    @if($requestItem->date_requested)

                                        {{ $requestItem
                                            ->date_requested
                                            ->format('M d, Y') }}

                                    @else

                                        —

                                    @endif

                                </td>


                                {{-- Status --}}
                                <td>

                                    <span class="modern-request-status {{ $statusClass }}">
                                        {{ $requestItem->status }}
                                    </span>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="modern-empty-row"
                                >
                                    No document requests yet.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </section>

</div>

@endsection