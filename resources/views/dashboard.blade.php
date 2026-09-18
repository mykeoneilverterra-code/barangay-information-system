@extends('layouts.app')

@section('content')

<div class="dashboard-page">


    {{-- STAT CARDS --}}
    <div class="dashboard-stats">

        <div class="stat-card">
            <div class="stat-icon stat-icon-green">
                <span>⌂</span>
            </div>

            <div>
                <p class="stat-label">Total Households</p>

                <h2>{{ $totalHouseholds }}</h2>

                <p class="stat-caption">
                    Registered households
                </p>
            </div>
        </div>


        <div class="stat-card">
            <div class="stat-icon stat-icon-blue">
                <span>👥</span>
            </div>

            <div>
                <p class="stat-label">Total Residents</p>

                <h2>{{ $totalResidents }}</h2>

                <p class="stat-caption">
                    Registered residents
                </p>
            </div>
        </div>


        <div class="stat-card">
            <div class="stat-icon stat-icon-purple">
                <span>✓</span>
            </div>

            <div>
                <p class="stat-label">Registered Voters</p>

                <h2>{{ $registeredVoters }}</h2>

                <p class="stat-caption">
                    Eligible registered voters
                </p>
            </div>
        </div>


        <div class="stat-card">
            <div class="stat-icon stat-icon-yellow">
                <span>★</span>
            </div>

            <div>
                <p class="stat-label">Household Heads</p>

                <h2>{{ $householdHeads }}</h2>

                <p class="stat-caption">
                    Registered household heads
                </p>
            </div>
        </div>

    </div>


    {{-- DASHBOARD TABLES --}}
    <div class="dashboard-grid">


        {{-- RECENT RESIDENTS --}}
        <div class="dashboard-panel">

            <div class="panel-header">

                <div>
                    <h3>Recent Residents</h3>

                    <p>Latest registered residents</p>
                </div>

                <a
                    href="{{ route('residents.index') }}"
                    class="panel-link"
                >
                    View all
                </a>

            </div>


            <div class="table-responsive">

                <table class="dashboard-table">

                    <thead>
                        <tr>
                            <th>Resident No.</th>
                            <th>Name</th>
                            <th>Purok</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($recentResidents as $resident)

                            <tr>

                                <td class="record-number">
                                    {{ $resident->resident_number }}
                                </td>

                                <td>
                                    {{ $resident->full_name }}
                                </td>

                                <td>
                                    {{ $resident->household->purok ?? 'N/A' }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="3">
                                    No residents found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- RECENT HOUSEHOLDS --}}
        <div class="dashboard-panel">

            <div class="panel-header">

                <div>
                    <h3>Recent Households</h3>

                    <p>Latest registered households</p>
                </div>

                <a
                    href="{{ route('households.index') }}"
                    class="panel-link"
                >
                    View all
                </a>

            </div>


            <div class="table-responsive">

                <table class="dashboard-table">

                    <thead>

                        <tr>
                            <th>Household No.</th>
                            <th>Head</th>
                            <th>Purok</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($recentHouseholds as $household)

                            <tr>

                                <td class="record-number">
                                    {{ $household->household_number }}
                                </td>

                                <td>
                                    {{ $household->household_head }}
                                </td>

                                <td>
                                    {{ $household->purok }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="3">
                                    No households found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection