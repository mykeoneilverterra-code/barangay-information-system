@extends('layouts.app')

@section('title', 'Add Announcement')

@section('page-title', 'Add Announcement')

@section(
    'page-subtitle',
    'Create a new announcement for barangay residents.'
)

@section('content')


@include('announcements._styles')


<div class="announcement-page">


    <div class="announcement-breadcrumb">

        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <span>›</span>

        <a href="{{ route('announcements.index') }}">
            Announcements
        </a>

        <span>›</span>

        <strong>
            Add
        </strong>

    </div>


    <div class="announcement-form-card">


        <div class="announcement-form-heading">

            <span class="announcement-eyebrow">
                BARANGAY UPDATE
            </span>

            <h2>
                Add Announcement
            </h2>

            <p>
                Create information that can be published
                to residents.
            </p>

        </div>


        <form
            action="{{ route('announcements.store') }}"
            method="POST"
        >

            @csrf


            @include('announcements._form')


            <div class="announcement-form-actions">


                <a
                    href="{{ route('announcements.index') }}"
                    class="announcement-button-secondary"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="announcement-button-primary"
                >
                    Save Announcement
                </button>


            </div>


        </form>


    </div>


</div>


@endsection