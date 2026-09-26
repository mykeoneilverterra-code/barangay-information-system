@extends('layouts.app')

@section('title', 'Process Document Request')

@section('content')


<div class="admin-processing-page">


    <div class="admin-processing-card">


        {{-- =================================================
            HEADER
        ================================================== --}}
        <div class="admin-processing-header">

            <div>

                <p class="records-eyebrow">
                    DOCUMENT PROCESSING
                </p>

                <h2>
                    Process Request
                </h2>

                <p>
                    {{ $documentRequest->request_number }}
                </p>

            </div>


            <a
                href="{{ route(
                    'document-requests.show',
                    $documentRequest
                ) }}"
                class="secondary-action-btn"
            >
                ← Back to Request
            </a>

        </div>



        {{-- =================================================
            REQUEST SUMMARY
        ================================================== --}}
        <div class="admin-processing-summary">


            <div>

                <span>
                    Resident
                </span>

                <strong>
                    {{ $documentRequest
                        ->resident
                        ->full_name }}
                </strong>

                <small>
                    {{ $documentRequest
                        ->resident
                        ->resident_number }}
                </small>

            </div>



            <div>

                <span>
                    Document
                </span>

                <strong>
                    {{ $documentRequest->document_type }}
                </strong>

                <small>
                    {{ $documentRequest
                        ->date_requested
                        ->format('M d, Y') }}
                </small>

            </div>



            <div>

                <span>
                    Current Status
                </span>

                <strong>
                    {{ $documentRequest->status }}
                </strong>

                <small>
                    Request status
                </small>

            </div>

        </div>



        {{-- =================================================
            PURPOSE
        ================================================== --}}
        <div class="admin-processing-purpose">

            <span>
                Request Purpose
            </span>

            <p>
                {{ $documentRequest->purpose }}
            </p>

        </div>



        {{-- =================================================
            FORM
        ================================================== --}}
        <form
            action="{{ route(
                'document-requests.update',
                $documentRequest
            ) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            <div class="admin-processing-form">


                {{-- Status --}}
                <div class="form-field">

                    <label for="status">

                        Request Status

                        <span class="required-mark">
                            *
                        </span>

                    </label>


                    <select
                        name="status"
                        id="status"
                        class="form-select @error('status') is-invalid @enderror"
                        required
                    >

                        @foreach($statuses as $statusOption)

                            <option
                                value="{{ $statusOption }}"
                                @selected(
                                    old(
                                        'status',
                                        $documentRequest->status
                                    )
                                    ===
                                    $statusOption
                                )
                            >
                                {{ $statusOption }}
                            </option>

                        @endforeach

                    </select>


                    @error('status')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>



                {{-- Remarks --}}
                <div class="form-field">

                    <label for="admin_remarks">

                        Admin Remarks

                        <span class="optional-label">
                            Optional
                        </span>

                    </label>


                    <textarea
                        name="admin_remarks"
                        id="admin_remarks"
                        rows="6"
                        class="form-control @error('admin_remarks') is-invalid @enderror"
                        placeholder="Example: Please bring one valid ID when claiming the document."
                    >{{ old(
                        'admin_remarks',
                        $documentRequest->admin_remarks
                    ) }}</textarea>


                    <div class="field-helper">
                        These remarks will be visible to the resident.
                    </div>


                    @error('admin_remarks')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>



            <div class="admin-processing-footer">

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
                    Save Processing Update
                </button>

            </div>

        </form>

    </div>

</div>

@endsection