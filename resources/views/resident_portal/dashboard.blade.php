@extends('layouts.resident')


@section('title', 'Dashboard')


@section(
    'page-title',
    'Welcome, ' . auth()->user()->resident->first_name
)


@section(
    'page-subtitle',
    'Here is an overview of your resident account and barangay services.'
)


@section('content')


@php

    $resident =
        auth()->user()->resident;

@endphp


<div class="resident-dashboard">


    {{-- =====================================================
        SUCCESS MESSAGE
    ====================================================== --}}
    @if(session('success'))

        <div class="resident-portal-success">


            <div class="resident-portal-success-icon">
                ✓
            </div>


            <div>

                <strong>
                    Request submitted
                </strong>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        </div>

    @endif



    {{-- =====================================================
        WELCOME
    ====================================================== --}}
    <section class="resident-welcome-card">


        <div class="resident-welcome-content">

            <p class="resident-dashboard-eyebrow">
                RESIDENT ACCOUNT
            </p>


            <h2>
                Hello, {{ $resident->first_name }}!
            </h2>


            <p>
                Your resident account is connected to
                Barangay San Antonio, Biñan, Laguna.
                You can use this portal to manage your
                resident services and document requests.
            </p>

        </div>


        <div class="resident-welcome-id">

            <span>
                Resident Number
            </span>

            <strong>
                {{ $resident->resident_number }}
            </strong>

        </div>

    </section>



    {{-- =====================================================
        RESIDENT INFORMATION
    ====================================================== --}}
    <div class="resident-dashboard-cards">


        {{-- Profile --}}
        <div class="resident-dashboard-card">

            <div class="resident-dashboard-card-icon">
                ◉
            </div>


            <div>

                <span>
                    Resident Profile
                </span>

                <strong>
                    {{ $resident->full_name }}
                </strong>

                <small>
                    Registered resident
                </small>

            </div>

        </div>



        {{-- Area --}}
        <div class="resident-dashboard-card">

            <div class="resident-dashboard-card-icon">
                ⌖
            </div>


            <div>

                <span>
                    Village / Street
                </span>

                <strong>
                    {{ $resident->area }}
                </strong>

                <small>
                    Barangay San Antonio
                </small>

            </div>

        </div>



        {{-- Voter --}}
        <div class="resident-dashboard-card">

            <div class="resident-dashboard-card-icon">
                ✓
            </div>


            <div>

                <span>
                    Voter Status
                </span>

                <strong>

                    @if($resident->is_voter)

                        Registered Voter

                    @else

                        Not Registered

                    @endif

                </strong>

                <small>
                    Resident voting information
                </small>

            </div>

        </div>

    </div>



    {{-- =====================================================
        SERVICES
    ====================================================== --}}
    <section class="resident-dashboard-panel">


        <div class="resident-dashboard-panel-header">

            <div>

                <h3>
                    Resident Services
                </h3>

                <p>
                    Access available barangay services.
                </p>

            </div>

        </div>



        <div class="resident-service-grid">


            {{-- Request Document --}}
            <a
                href="{{ route('resident.requests.create') }}"
                class="resident-service-card resident-service-link"
            >

                <div class="resident-service-icon">
                    ＋
                </div>


                <div>

                    <h4>
                        Request Document
                    </h4>

                    <p>
                        Request barangay certificates
                        and clearances online.
                    </p>

                </div>


                <span class="resident-service-open">
                    Open →
                </span>

            </a>



            {{-- My Requests --}}
            <div class="resident-service-card">

                <div class="resident-service-icon">
                    ▤
                </div>


                <div>

                    <h4>
                        My Requests
                    </h4>

                    <p>
                        Track the status of your submitted
                        document requests.
                    </p>

                </div>


                <span class="resident-service-coming">
                    Coming next
                </span>

            </div>



            {{-- My Profile --}}
            <div class="resident-service-card">

                <div class="resident-service-icon">
                    ◉
                </div>


                <div>

                    <h4>
                        My Profile
                    </h4>

                    <p>
                        View your registered barangay
                        resident information.
                    </p>

                </div>


                <span class="resident-service-coming">
                    Coming next
                </span>

            </div>

        </div>

    </section>

</div>

@endsection