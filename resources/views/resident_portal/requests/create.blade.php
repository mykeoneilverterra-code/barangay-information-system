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

        </div>



        {{-- =====================================================
            SYSTEM INFORMATION
        ====================================================== --}}
        <div class="resident-request-system-info">


            {{-- Request Number --}}
            <div class="resident-request-info-item">

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



            {{-- Resident --}}
            <div class="resident-request-info-item">

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



            {{-- Date --}}
            <div class="resident-request-info-item">

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



            {{-- Status --}}
            <div class="resident-request-info-item">

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
            class="resident-request-form"
        >

            @csrf



            {{-- =================================================
                DOCUMENT
            ================================================== --}}
            <div class="resident-request-section">


                <div class="resident-request-section-title">


                    <div>
                        01
                    </div>


                    <span>

                        <strong>
                            Document Information
                        </strong>

                        <small>
                            Choose the document you want to request.
                        </small>

                    </span>

                </div>



                <div class="resident-request-field">


                    <label for="document_type">

                        Document Type

                        <span>
                            *
                        </span>

                    </label>


                    <select
                        name="document_type"
                        id="document_type"
                        class="@error('document_type') resident-request-input-error @enderror"
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
                        ] as $documentType)

                            <option
                                value="{{ $documentType }}"
                                @selected(
                                    old('document_type')
                                    === $documentType
                                )
                            >
                                {{ $documentType }}
                            </option>

                        @endforeach

                    </select>


                    @error('document_type')

                        <div class="resident-request-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>



            {{-- =================================================
                PURPOSE
            ================================================== --}}
            <div class="resident-request-section">


                <div class="resident-request-section-title">


                    <div>
                        02
                    </div>


                    <span>

                        <strong>
                            Request Purpose
                        </strong>

                        <small>
                            Tell the barangay why you need this document.
                        </small>

                    </span>

                </div>



                <div class="resident-request-field">


                    <label for="purpose">

                        Purpose

                        <span>
                            *
                        </span>

                    </label>


                    <textarea
                        name="purpose"
                        id="purpose"
                        rows="5"
                        maxlength="1000"
                        class="@error('purpose') resident-request-input-error @enderror"
                        placeholder="Example: Employment requirement, school requirement, scholarship application..."
                        required
                    >{{ old('purpose') }}</textarea>


                    @error('purpose')

                        <div class="resident-request-error">
                            {{ $message }}
                        </div>

                    @enderror


                    <small class="resident-request-helper">
                        Provide a short and clear reason for requesting the document.
                    </small>

                </div>

            </div>



            {{-- =================================================
                ACTIONS
            ================================================== --}}
            <div class="resident-request-footer">


                <a
                    href="{{ route('resident.portal') }}"
                    class="resident-request-cancel"
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