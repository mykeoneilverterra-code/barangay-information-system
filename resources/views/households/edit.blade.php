@extends('layouts.app')

@section('title', 'Edit Household')

@section('content')

<div class="form-page">

    <div class="form-card">

        <div class="form-card-header">

            <div>

                <p class="records-eyebrow">
                    HOUSEHOLD MANAGEMENT
                </p>

                <h2>
                    Edit Household
                </h2>

                <p>
                    Update {{ $household->household_number }} household information.
                </p>

            </div>

        </div>


        <form
            action="{{ route('households.update', $household) }}"
            method="POST"
        >

            @method('PUT')

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
                    Save Changes
                </button>

            </div>

        </form>

    </div>

</div>

@endsection