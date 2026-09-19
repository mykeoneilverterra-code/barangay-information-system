@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="dashboard-page">


    {{-- =====================================================
        STATISTICS
    ====================================================== --}}
    <div class="dashboard-stats">


        {{-- Total Residents --}}
        <div class="stat-card">

            <div class="stat-icon">
                ◉
            </div>

            <div>

                <span class="stat-label">
                    Total Residents
                </span>

                <strong class="stat-value">
                    {{ $totalResidents }}
                </strong>

                <small>
                    Registered residents
                </small>

            </div>

        </div>


        {{-- Registered Voters --}}
        <div class="stat-card">

            <div class="stat-icon">
                ✓
            </div>

            <div>

                <span class="stat-label">
                    Registered Voters
                </span>

                <strong class="stat-value">
                    {{ $registeredVoters }}
                </strong>

                <small>
                    Voter records
                </small>

            </div>

        </div>


        {{-- Areas --}}
        <div class="stat-card">

            <div class="stat-icon">
                ⌖
            </div>

            <div>

                <span class="stat-label">
                    Villages / Streets
                </span>

                <strong class="stat-value">
                    {{ $totalAreas }}
                </strong>

                <small>
                    Areas represented
                </small>

            </div>

        </div>


        {{-- Sex Distribution --}}
        <div class="stat-card">

            <div class="stat-icon">
                ↔
            </div>

            <div>

                <span class="stat-label">
                    Male / Female
                </span>

                <strong class="stat-value stat-value-split">
                    {{ $maleResidents }}
                    /
                    {{ $femaleResidents }}
                </strong>

                <small>
                    Resident distribution
                </small>

            </div>

        </div>

    </div>


    {{-- =====================================================
        DASHBOARD PANELS
    ====================================================== --}}
    <div class="dashboard-grid">


        {{-- Recent Residents --}}
        <section class="dashboard-panel">

            <div class="panel-header">

                <div>

                    <h3>
                        Recent Residents
                    </h3>

                    <p>
                        Recently registered resident records.
                    </p>

                </div>


                <a
                    href="{{ route('residents.index') }}"
                    class="panel-link"
                >
                    View all
                </a>

            </div>


            <div class="records-table-wrapper">

                <table class="dashboard-table">

                    <thead>

                        <tr>

                            <th>
                                Resident
                            </th>

                            <th>
                                Village / Street
                            </th>

                            <th>
                                Voter
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($recentResidents as $resident)

                            <tr>

                                <td>

                                    <a
                                        href="{{ route('residents.show', $resident) }}"
                                        class="dashboard-person"
                                    >

                                        <span class="record-avatar">

                                            {{ strtoupper(
                                                substr(
                                                    $resident->first_name,
                                                    0,
                                                    1
                                                )
                                            ) }}

                                        </span>


                                        <span>

                                            <strong>
                                                {{ $resident->full_name }}
                                            </strong>

                                            <small>
                                                {{ $resident->resident_number }}
                                            </small>

                                        </span>

                                    </a>

                                </td>


                                <td>

                                    <span class="area-badge">
                                        {{ $resident->area }}
                                    </span>

                                </td>


                                <td>

                                    @if($resident->is_voter)

                                        <span class="voter-badge voter-yes">
                                            Registered
                                        </span>

                                    @else

                                        <span class="voter-badge voter-no">
                                            No
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="3">
                                    No resident records available.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </section>


        {{-- Areas --}}
        <section class="dashboard-panel">

            <div class="panel-header">

                <div>

                    <h3>
                        Residents by Location
                    </h3>

                    <p>
                        Resident distribution by Village / Street.
                    </p>

                </div>

            </div>


            <div class="area-overview-list">

                @forelse($areaDistribution as $location)

                    <a
                        href="{{ route(
                            'residents.index',
                            ['area' => $location->area]
                        ) }}"
                        class="area-overview-item"
                    >

                        <div>

                            <strong>
                                {{ $location->area }}
                            </strong>

                            <span>
                                Barangay San Antonio
                            </span>

                        </div>


                        <div class="area-overview-count">

                            {{ $location->total }}

                            <small>
                                Residents
                            </small>

                        </div>

                    </a>

                @empty

                    <div class="records-empty">
                        No location information available.
                    </div>

                @endforelse

            </div>

        </section>

    </div>

</div>

@endsection