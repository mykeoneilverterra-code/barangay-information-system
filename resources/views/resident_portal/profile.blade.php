@extends('layouts.resident')


@section('title', 'My Profile')


@section(
    'page-title',
    'My Profile'
)


@section(
    'page-subtitle',
    'View your registered barangay resident information.'
)


@section('content')


@php

    $residentPhoto = $resident->profile_photo_path
        ? asset('storage/' . $resident->profile_photo_path)
        : null;


    $residentInitial = strtoupper(
        substr(
            $resident->first_name ?? 'R',
            0,
            1
        )
    );

@endphp


<div class="resident-profile-page">


    {{-- =====================================================
        PROFILE HEADER
    ====================================================== --}}
    <section class="resident-profile-main-card">


        <div class="resident-profile-main-header">


            {{-- Profile Identity --}}
            <div class="resident-profile-identity">


                {{-- Photo --}}
                <div class="resident-profile-main-photo">

                    @if($residentPhoto)

                        <img
                            src="{{ $residentPhoto }}"
                            alt="{{ $resident->full_name }}"
                        >

                    @else

                        <span>
                            {{ $residentInitial }}
                        </span>

                    @endif

                </div>


                {{-- Name / ID --}}
                <div class="resident-profile-identity-info">

                    <p class="resident-dashboard-eyebrow">
                        REGISTERED RESIDENT
                    </p>


                    <h2>
                        {{ $resident->full_name }}
                    </h2>


                    <div class="resident-profile-number">

                        <span>
                            Resident Number
                        </span>

                        <strong>
                            {{ $resident->resident_number }}
                        </strong>

                    </div>

                </div>

            </div>



            {{-- Status --}}
            <div class="resident-profile-status">

                <span class="resident-profile-status-dot">
                </span>

                Active Resident

            </div>

        </div>


        {{-- Profile Note --}}
        <div class="resident-profile-main-note">

            <div class="resident-profile-note-icon">
                i
            </div>


            <div>

                <strong>
                    Official Barangay Record
                </strong>

                <p>
                    The information shown on this page comes from your
                    registered resident record. Contact the barangay
                    administrator if any information needs to be corrected.
                </p>

            </div>

        </div>

    </section>



    {{-- =====================================================
        PERSONAL INFORMATION
    ====================================================== --}}
    <section class="resident-profile-section">


        <div class="resident-profile-section-header">

            <div class="resident-profile-section-number">
                01
            </div>


            <div>

                <h3>
                    Personal Information
                </h3>

                <p>
                    Basic information registered in your barangay record.
                </p>

            </div>

        </div>



        <div class="resident-profile-info-grid">


            {{-- Full Name --}}
            <div class="resident-profile-info-item">

                <span>
                    Full Name
                </span>

                <strong>
                    {{ $resident->full_name }}
                </strong>

            </div>



            {{-- Resident Number --}}
            <div class="resident-profile-info-item">

                <span>
                    Resident Number
                </span>

                <strong>
                    {{ $resident->resident_number }}
                </strong>

            </div>



            {{-- Sex --}}
            <div class="resident-profile-info-item">

                <span>
                    Sex
                </span>

                <strong>
                    {{ $resident->sex }}
                </strong>

            </div>



            {{-- Birth Date --}}
            <div class="resident-profile-info-item">

                <span>
                    Birth Date
                </span>

                <strong>

                    @if($resident->birth_date)

                        {{ $resident
                            ->birth_date
                            ->format('F d, Y') }}

                    @else

                        Not provided

                    @endif

                </strong>

            </div>



            {{-- Civil Status --}}
            <div class="resident-profile-info-item">

                <span>
                    Civil Status
                </span>

                <strong>
                    {{ $resident->civil_status ?? 'Not provided' }}
                </strong>

            </div>



            {{-- Occupation --}}
            <div class="resident-profile-info-item">

                <span>
                    Occupation
                </span>

                <strong>
                    {{ $resident->occupation ?? 'Not provided' }}
                </strong>

            </div>

        </div>

    </section>



    {{-- =====================================================
        CONTACT INFORMATION
    ====================================================== --}}
    <section class="resident-profile-section">


        <div class="resident-profile-section-header">

            <div class="resident-profile-section-number">
                02
            </div>


            <div>

                <h3>
                    Contact Information
                </h3>

                <p>
                    Contact details connected to your resident account.
                </p>

            </div>

        </div>



        <div class="resident-profile-info-grid">


            {{-- Contact --}}
            <div class="resident-profile-info-item">

                <span>
                    Contact Number
                </span>

                <strong>
                    {{ $resident->contact_number ?? 'Not provided' }}
                </strong>

            </div>



            {{-- Email --}}
            <div class="resident-profile-info-item">

                <span>
                    Email Address
                </span>

                <strong class="resident-profile-break">
                    {{ $resident->email ?? 'Not provided' }}
                </strong>

            </div>

        </div>

    </section>



    {{-- =====================================================
        LOCATION INFORMATION
    ====================================================== --}}
    <section class="resident-profile-section">


        <div class="resident-profile-section-header">

            <div class="resident-profile-section-number">
                03
            </div>


            <div>

                <h3>
                    Location Information
                </h3>

                <p>
                    Your registered address within Barangay San Antonio.
                </p>

            </div>

        </div>



        <div class="resident-profile-info-grid">


            {{-- Village / Street --}}
            <div class="resident-profile-info-item">

                <span>
                    Village / Street
                </span>

                <strong>
                    {{ $resident->area ?? 'Not provided' }}
                </strong>

            </div>



            {{-- Barangay --}}
            <div class="resident-profile-info-item">

                <span>
                    Barangay
                </span>

                <strong>
                    Barangay San Antonio
                </strong>

            </div>



            {{-- Complete Address --}}
            <div class="resident-profile-info-item resident-profile-info-wide">

                <span>
                    Complete Address
                </span>

                <strong>
                    {{ $resident->address ?? 'Not provided' }}
                </strong>

            </div>

        </div>

    </section>



    {{-- =====================================================
        REGISTRATION INFORMATION
    ====================================================== --}}
    <section class="resident-profile-section">


        <div class="resident-profile-section-header">

            <div class="resident-profile-section-number">
                04
            </div>


            <div>

                <h3>
                    Registration Information
                </h3>

                <p>
                    Barangay registration and voting information.
                </p>

            </div>

        </div>



        <div class="resident-profile-info-grid">


            {{-- Voter --}}
            <div class="resident-profile-info-item">

                <span>
                    Voter Status
                </span>


                @if($resident->is_voter)

                    <strong class="resident-profile-positive">
                        Registered Voter
                    </strong>

                @else

                    <strong>
                        Not Registered
                    </strong>

                @endif

            </div>



            {{-- Record Created --}}
            <div class="resident-profile-info-item">

                <span>
                    Resident Record Created
                </span>

                <strong>

                    @if($resident->created_at)

                        {{ $resident
                            ->created_at
                            ->timezone('Asia/Manila')
                            ->format('F d, Y') }}

                    @else

                        Not available

                    @endif

                </strong>

            </div>

        </div>

    </section>



    {{-- =====================================================
        FOOTER NOTE
    ====================================================== --}}
    <section class="resident-profile-support-card">


        <div class="resident-profile-support-icon">
            !
        </div>


        <div>

            <strong>
                Need to update your information?
            </strong>

            <p>
                Resident records cannot be edited directly through the
                Resident Portal. Please contact the barangay office if
                your name, contact information, address, or other
                registered details need to be updated.
            </p>

        </div>


        <a
            href="{{ route('resident.portal') }}"
            class="resident-profile-back-button"
        >
            Back to Dashboard
        </a>

    </section>


</div>

@endsection