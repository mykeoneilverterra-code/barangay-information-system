@extends('layouts.app')

@section('content')

    <h1 class="mb-4">Edit Resident</h1>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('residents.update', $resident) }}" method="POST">

                @method('PUT')

                @include('residents._form')

                <button type="submit" class="btn btn-primary">
                    Update Resident
                </button>

                <a href="{{ route('residents.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>

@endsection
