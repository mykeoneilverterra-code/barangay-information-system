@extends('layouts.app')

@section('content')

<h1 class="mb-4">Add Household</h1>

<div class="card">
    <div class="card-body">

        <form action="{{ route('households.store') }}" method="POST">

            @include('households._form')

            <button type="submit" class="btn btn-primary">
                Save Household
            </button>

            <a href="{{ route('households.index') }}"
                class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>
</div>

@endsection