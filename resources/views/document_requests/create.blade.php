@extends('layouts.app')

@section('title', 'New Document Request')

@section('content')

<div class="resident-form-page">

    <div class="resident-form-card">


        <div class="resident-form-main-header">

            <div>

                <p class="records-eyebrow">
                    DOCUMENT MANAGEMENT
                </p>

                <h2>
                    New Document Request
                </h2>

                <p>
                    Create a barangay certificate or clearance request.
                </p>

            </div>


            <a
                href="{{ route('document-requests.index') }}"
                class="form-back-link"
            >
                ← Back to Requests
            </a>

        </div>


        <form
            action="{{ route('document-requests.store') }}"
            method="POST"
        >

            <div class="resident-form-body">

                @include('document_requests._form')

            </div>


            <div class="resident-form-footer">

                <div class="form-footer-note">
                    <span class="required-mark">*</span>
                    Required fields
                </div>


                <div class="resident-form-actions">

                    <a
                        href="{{ route('document-requests.index') }}"
                        class="secondary-action-btn"
                    >
                        Cancel
                    </a>


                    <button
                        type="submit"
                        class="primary-action-btn"
                    >
                        Save Request
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection