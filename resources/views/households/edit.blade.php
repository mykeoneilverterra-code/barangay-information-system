@extends('layouts.app')

@section('content')

    <h1 class="mb-4">Edit Household</h1>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('households.update', $household) }}"
                  method="POST">

                @method('PUT')

                @include('households._form')

                <button type="submit" class="btn btn-primary">
                    Update Household
                </button>

                <a href="{{ route('households.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>

@endsection