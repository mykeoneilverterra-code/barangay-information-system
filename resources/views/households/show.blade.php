@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Household Details</h1>

        <div class="detail-actions">
            <a href="{{ route('households.edit', $household) }}"
               class="btn btn-warning">
                Edit
            </a>

            <form action="{{ route('households.destroy', $household) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this household? Its residents will also be removed.')">
                    Delete
                </button>
            </form>

            <a href="{{ route('households.index') }}"
               class="btn btn-secondary">
                Back
            </a>
        </div>
    </div>


    <div class="card mb-4">
        <div class="card-body">

            <h4 class="card-title mb-3">
                {{ $household->household_number }}
            </h4>

            <p>
                <strong>Household Head:</strong>
                {{ $household->household_head }}
            </p>

            <p>
                <strong>Address:</strong>
                {{ $household->address }}
            </p>

            <p>
                <strong>Purok:</strong>
                {{ $household->purok }}
            </p>

            <p>
                <strong>Contact Number:</strong>
                {{ $household->contact_number ?? 'N/A' }}
            </p>

        </div>
    </div>


    <div class="card">

        <div class="card-header">
            <h5 class="mb-0">Residents</h5>
        </div>

        <div class="card-body">

            @forelse($household->residents as $resident)

                <div class="border-bottom py-2">

                    <strong>
                        {{ $resident->first_name }}
                        {{ $resident->middle_name }}
                        {{ $resident->last_name }}
                        {{ $resident->suffix }}
                    </strong>

                    <br>

                    <small>
                        Resident No:
                        {{ $resident->resident_number }}
                    </small>

                </div>

            @empty

                <p class="text-muted mb-0">
                    No residents found for this household.
                </p>

            @endforelse

        </div>
    </div>

@endsection