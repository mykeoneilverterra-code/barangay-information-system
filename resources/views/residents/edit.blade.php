@extends('layouts.app')

@section('title', 'Edit Resident')

@section('content')

<div class="resident-form-page">


    <div class="resident-form-card">


        {{-- =====================================================
            HEADER
        ====================================================== --}}
        <div class="resident-form-main-header">

            <div>

                <p class="records-eyebrow">
                    RESIDENT MANAGEMENT
                </p>

                <h2>
                    Edit Resident
                </h2>

                <p>
                    Update the registered information of
                    <strong>
                        {{ $resident->full_name }}
                    </strong>.
                </p>

            </div>


            <a
                href="{{ route(
                    'residents.show',
                    $resident
                ) }}"
                class="form-back-link"
            >
                ← Back to Resident Details
            </a>

        </div>


        {{-- =====================================================
            RESIDENT SUMMARY
        ====================================================== --}}
        <div class="edit-resident-summary">


            <div class="edit-resident-avatar">

                @if($resident->profile_photo_path)

                    <img
                        src="{{ asset(
                            'storage/'
                            . $resident->profile_photo_path
                        ) }}"
                        alt="{{ $resident->full_name }}"
                        class="edit-resident-avatar-image"
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


            <div class="edit-resident-summary-info">

                <span class="edit-resident-label">
                    Editing Resident
                </span>

                <strong>
                    {{ $resident->full_name }}
                </strong>

                <small>
                    {{ $resident->resident_number }}
                </small>

            </div>


            <div class="edit-resident-status">

                @if($resident->is_voter)

                    <span class="voter-badge voter-yes">
                        Registered Voter
                    </span>

                @else

                    <span class="voter-badge voter-no">
                        Not Registered
                    </span>

                @endif

            </div>

        </div>


        {{-- =====================================================
            EDIT FORM
        ====================================================== --}}
        <form
            action="{{ route(
                'residents.update',
                $resident
            ) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @method('PUT')


            <div class="resident-form-body">

                @include('residents._form')

            </div>


            <div class="resident-form-footer">

                <div class="form-footer-note">

                    <span class="required-mark">
                        *
                    </span>

                    Required fields

                </div>


                <div class="resident-form-actions">

                    <a
                        href="{{ route(
                            'residents.show',
                            $resident
                        ) }}"
                        class="secondary-action-btn"
                    >
                        Cancel
                    </a>


                    <button
                        type="submit"
                        class="primary-action-btn"
                    >
                        Save Changes
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection