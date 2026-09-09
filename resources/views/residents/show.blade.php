@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Resident Details</h1>

        <div class="detail-actions">
            <a href="{{ route('residents.edit', $resident) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('residents.destroy', $resident) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this resident?')">
                    Delete
                </button>
            </form>
            <a href="{{ route('residents.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">{{ $resident->full_name }}</h4>

            <p><strong>Resident Number:</strong> {{ $resident->resident_number }}</p>
            <p><strong>Sex:</strong> {{ $resident->sex }}</p>
            <p><strong>Birth Date:</strong> {{ $resident->birth_date?->format('M d, Y') }}</p>
            <p><strong>Civil Status:</strong> {{ $resident->civil_status }}</p>
            <p><strong>Contact Number:</strong> {{ $resident->contact_number ?? 'N/A' }}</p>
            <p><strong>Email:</strong> {{ $resident->email ?? 'N/A' }}</p>
            <p><strong>Occupation:</strong> {{ $resident->occupation ?? 'N/A' }}</p>
            <p><strong>Registered Voter:</strong> {{ $resident->is_voter ? 'Yes' : 'No' }}</p>
            <p><strong>Household Head:</strong> {{ $resident->is_household_head ? 'Yes' : 'No' }}</p>
            <p class="mb-0">
                <strong>Household:</strong>
                <a href="{{ route('households.show', $resident->household) }}">
                    {{ $resident->household->household_number }}
                </a>
            </p>
        </div>
    </div>

@endsection
