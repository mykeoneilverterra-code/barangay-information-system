@extends('layouts.resident')


@section('title', 'Request Document')


@section(
    'page-title',
    'Request Document'
)


@section(
    'page-subtitle',
    'Submit a request for a barangay certificate or clearance.'
)


@section('content')


<div class="resident-request-page">


    <div class="resident-request-card">


        {{-- =====================================================
            HEADER
        ====================================================== --}}
        <div class="resident-request-card-header">

            <div>

                <p class="resident-dashboard-eyebrow">
                    DOCUMENT REQUEST
                </p>

                <h2>
                    New Document Request
                </h2>

                <p>
                    Select the document you need and provide
                    the purpose of your request.
                </p>

            </div>


            <a
                href="{{ route('resident.requests.index') }}"
                class="resident-request-back"
            >
                My Requests →
            </a>

        </div>



        {{-- =====================================================
            REQUEST SUMMARY
        ====================================================== --}}
        <div class="resident-request-summary">


            <div class="resident-request-summary-item">

                <span>
                    Request Number
                </span>

                <strong>
                    {{ $nextRequestNumber }}
                </strong>

                <small>
                    Automatically assigned
                </small>

            </div>



            <div class="resident-request-summary-item">

                <span>
                    Requesting Resident
                </span>

                <strong>
                    {{ $resident->full_name }}
                </strong>

                <small>
                    {{ $resident->resident_number }}
                </small>

            </div>



            <div class="resident-request-summary-item">

                <span>
                    Date Requested
                </span>

                <strong>
                    {{ now('Asia/Manila')->format('M d, Y') }}
                </strong>

                <small>
                    Current date
                </small>

            </div>



            <div class="resident-request-summary-item">

                <span>
                    Initial Status
                </span>

                <strong class="resident-request-pending">
                    Pending
                </strong>

                <small>
                    Awaiting barangay review
                </small>

            </div>

        </div>



        {{-- =====================================================
            FORM
        ====================================================== --}}
        <form
            action="{{ route('resident.requests.store') }}"
            method="POST"
        >

            @csrf


            <div class="resident-request-form-section">


                <div class="resident-request-section-heading">

                    <span>
                        01
                    </span>


                    <div>

                        <h3>
                            Document Information
                        </h3>

                        <p>
                            Choose the document you want to request.
                        </p>

                    </div>

                </div>



                <div class="form-field">

                    <label for="document_type">

                        Document Type

                        <span class="required-mark">
                            *
                        </span>

                    </label>


                    <select
                        name="document_type"
                        id="document_type"
                        class="form-select @error('document_type') is-invalid @enderror"
                        required
                    >

                        <option value="">
                            Select document type
                        </option>


                        @foreach([
                            'Barangay Clearance',
                            'Certificate of Residency',
                            'Certificate of Indigency',
                            'Barangay Certification'
                        ] as $type)

                            <option
                                value="{{ $type }}"
                                @selected(
                                    old('document_type')
                                    ===
                                    $type
                                )
                            >
                                {{ $type }}
                            </option>

                        @endforeach

                    </select>


                    @error('document_type')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>



            <div class="resident-request-form-section">


                <div class="resident-request-section-heading">

                    <span>
                        02
                    </span>


                    <div>

                        <h3>
                            Request Purpose
                        </h3>

                        <p>
                            Tell the barangay why you need this document.
                        </p>

                    </div>

                </div>



                <div class="form-field">

                    <label for="purpose">

                        Purpose

                        <span class="required-mark">
                            *
                        </span>

                    </label>


                    <textarea
                        name="purpose"
                        id="purpose"
                        rows="5"
                        class="form-control @error('purpose') is-invalid @enderror"
                        placeholder="Example: Employment requirement, school requirement, scholarship application..."
                        required
                    >{{ old('purpose') }}</textarea>


                    @error('purpose')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>



            {{-- =================================================
                ACTIONS
            ================================================== --}}
            <div class="resident-request-form-footer">

                <a
                    href="{{ route('resident.portal') }}"
                    class="resident-request-secondary"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="resident-request-submit"
                >
                    Submit Request
                </button>

            </div>

        </form>

    </div>

</div>

@endsection