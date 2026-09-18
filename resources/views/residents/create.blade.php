@extends('layouts.app')

@section('title', 'Add Resident')

@section('content')

<div class="resident-form-page">


    {{-- =====================================================
        FORM CARD
    ====================================================== --}}
    <div class="resident-form-card">


        {{-- =====================================================
            FORM HEADER
        ====================================================== --}}
        <div class="resident-form-main-header">

            <div>

                <p class="records-eyebrow">
                    RESIDENT MANAGEMENT
                </p>

                <h2>
                    Add New Resident
                </h2>

                <p>
                    Register a resident under Barangay San Antonio, Biñan, Laguna.
                </p>

            </div>


            <a
                href="{{ route('residents.index') }}"
                class="form-back-link"
            >
                ← Back to Residents
            </a>

        </div>


        {{-- =====================================================
            FORM
        ====================================================== --}}
        <form
            action="{{ route('residents.store') }}"
            method="POST"
        >


            {{-- Form Fields --}}
            <div class="resident-form-body">

                @include('residents._form')

            </div>


            {{-- =====================================================
                FORM FOOTER
            ====================================================== --}}
            <div class="resident-form-footer">

                <div class="form-footer-note">

                    <span class="required-mark">
                        *
                    </span>

                    Required fields

                </div>


                <div class="resident-form-actions">

                    <a
                        href="{{ route('residents.index') }}"
                        class="secondary-action-btn"
                    >
                        Cancel
                    </a>


                    <button
                        type="submit"
                        class="primary-action-btn"
                    >
                        Save Resident
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection