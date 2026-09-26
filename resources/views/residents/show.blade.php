@extends('layouts.app')

@section('title', 'Resident Details')

@section('content')

<div class="details-page">


    {{-- =====================================================
        RESIDENT PROFILE
    ====================================================== --}}
    <div class="details-card">


        <div class="details-header">

            <div class="resident-profile-heading">


                {{-- Profile Photo / Initial --}}
                <div class="resident-profile-avatar">

                    @if($resident->profile_photo_path)

                        <img
                            src="{{ asset('storage/' . $resident->profile_photo_path) }}"
                            alt="{{ $resident->full_name }}"
                            class="resident-profile-avatar-image"
                        >

                    @else

                        {{ strtoupper(
                            substr(
                                $resident->first_name,
                                0,
                                1
                            )
                        ) }}

                    @endif

                </div>


                <div>

                    <p class="records-eyebrow">
                        RESIDENT PROFILE
                    </p>

                    <h2>
                        {{ $resident->full_name }}
                    </h2>

                    <p>
                        {{ $resident->resident_number }}
                    </p>

                </div>

            </div>


            <div class="details-header-actions">

                <a
                    href="{{ route('residents.edit', $resident) }}"
                    class="secondary-action-btn"
                >
                    Edit Resident
                </a>


                <a
                    href="{{ route('residents.index') }}"
                    class="primary-action-btn"
                >
                    Back to Residents
                </a>

            </div>

        </div>


        {{-- =====================================================
            DETAILS GRID
        ====================================================== --}}
        <div class="details-grid">


            <div class="detail-item">

                <span>
                    Resident Number
                </span>

                <strong>
                    {{ $resident->resident_number }}
                </strong>

            </div>


            <div class="detail-item">

                <span>
                    Full Name
                </span>

                <strong>
                    {{ $resident->full_name }}
                </strong>

            </div>


            <div class="detail-item">

                <span>
                    Sex
                </span>

                <strong>
                    {{ $resident->sex }}
                </strong>

            </div>


            <div class="detail-item">

                <span>
                    Birth Date
                </span>

                <strong>
                    {{ $resident->birth_date->format('F d, Y') }}
                </strong>

            </div>


            <div class="detail-item">

                <span>
                    Civil Status
                </span>

                <strong>
                    {{ $resident->civil_status }}
                </strong>

            </div>


            <div class="detail-item">

                <span>
                    Occupation
                </span>

                <strong>
                    {{ $resident->occupation ?? 'Not provided' }}
                </strong>

            </div>


            <div class="detail-item">

                <span>
                    Contact Number
                </span>

                <strong>
                    {{ $resident->contact_number ?? 'Not provided' }}
                </strong>

            </div>


            <div class="detail-item">

                <span>
                    Email Address
                </span>

                <strong>
                    {{ $resident->email ?? 'Not provided' }}
                </strong>

            </div>


            <div class="detail-item">

                <span>
                    Voter Status
                </span>


                @if($resident->is_voter)

                    <strong class="detail-status-positive">
                        Registered Voter
                    </strong>

                @else

                    <strong>
                        Not Registered
                    </strong>

                @endif

            </div>


            <div class="detail-item">

                <span>
                    Village / Street
                </span>

                <strong>
                    {{ $resident->area }}
                </strong>

            </div>


            <div class="detail-item detail-item-wide">

                <span>
                    Complete Address
                </span>

                <strong>
                    {{ $resident->address }}
                </strong>

            </div>

        </div>

    </div>

</div>

@endsection