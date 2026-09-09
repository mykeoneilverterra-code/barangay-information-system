@extends('layouts.app')

@section('content')

<h1 class="mb-4">Add Resident</h1>

<div class="card">
    <div class="card-body">

        <form action="{{ route('residents.store') }}" method="POST">

            @include('residents._form')

            <button type="submit" class="btn btn-primary">
                Save Resident
            </button>

            <a href="{{ route('residents.index') }}" class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>
</div>

@endsection
