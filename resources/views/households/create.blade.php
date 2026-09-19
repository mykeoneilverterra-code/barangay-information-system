@extends('layouts.app')

@section('title', 'Add Household')

@section('content')

<div class="form-page">

    <div class="form-card">

        <div class="form-card-header">

            <div>

                <p class="records-eyebrow">
                    HOUSEHOLD MANAGEMENT
                </p>

                <h2>
                    Add Household
                </h2>

                <p>
                    Register a new household in Barangay San Antonio, Biñan.
                </p>

            </div>

        </div>


        <form
            action="{{ route('households.store') }}"
            method="POST"
        >

            <div class="form-card-body">

                @include('households._form')

            </div>


            <div class="form-card-footer">

                <a
                    href="{{ route('households.index') }}"
                    class="secondary-action-btn"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="primary-action-btn"
                >
                    Save Household
                </button>

            </div>

        </form>

    </div>

</div>

@endsection