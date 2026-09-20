@extends('layouts.app')

@section('title', 'Edit Document Request')

@section('content')

<div class="resident-form-page">

    <div class="resident-form-card">


        <div class="resident-form-main-header">

            <div>

                <p class="records-eyebrow">
                    DOCUMENT MANAGEMENT
                </p>

                <h2>
                    Edit Document Request
                </h2>

                <p>
                    Update {{ $documentRequest->request_number }}.
                </p>

            </div>


            <a
                href="{{ route(
                    'document-requests.show',
                    $documentRequest
                ) }}"
                class="form-back-link"
            >
                ← Back to Request
            </a>

        </div>


        <form
            action="{{ route(
                'document-requests.update',
                $documentRequest
            ) }}"
            method="POST"
        >

            @method('PUT')


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
                        href="{{ route(
                            'document-requests.show',
                            $documentRequest
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