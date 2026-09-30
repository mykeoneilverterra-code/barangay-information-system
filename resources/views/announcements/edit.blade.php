@extends('layouts.app')

@section('title', 'Edit Announcement')

@section('page-title', 'Edit Announcement')

@section(
    'page-subtitle',
    'Update the announcement details.'
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
            Edit
        </strong>

    </div>


    <div class="announcement-form-card">


        <div class="announcement-form-heading">

            <span class="announcement-eyebrow">
                UPDATE ANNOUNCEMENT
            </span>

            <h2>
                Edit Announcement
            </h2>

            <p>
                Update the selected barangay announcement.
            </p>

        </div>


        <form
            action="{{ route(
                'announcements.update',
                $announcement
            ) }}"
            method="POST"
        >

            @csrf

            @method('PUT')


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
                    Update Announcement
                </button>


            </div>


        </form>


    </div>


</div>


@endsection