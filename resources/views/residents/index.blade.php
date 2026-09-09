@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Residents</h1>

        <a href="{{ route('residents.create') }}" class="btn btn-primary">
            Add Resident
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Resident Number</th>
                        <th>Name</th>
                        <th>Sex</th>
                        <th>Birth Date</th>
                        <th>Household</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($residents as $resident)
                        <tr>
                            <td>{{ $resident->resident_number }}</td>
                            <td>{{ $resident->full_name }}</td>
                            <td>{{ $resident->sex }}</td>
                            <td>{{ $resident->birth_date?->format('M d, Y') }}</td>
                            <td>{{ $resident->household->household_number }}</td>
                            <td class="actions-cell">
                                <div class="action-group">
                                <a href="{{ route('residents.show', $resident) }}" class="btn btn-sm btn-info">View details</a>
                                <a href="{{ route('residents.edit', $resident) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('residents.destroy', $resident) }}" method="POST" class="d-inline action-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this resident?')">
                                        Delete
                                    </button>
                                </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No residents found.</td>
                        </tr>
                    @endforelse
                </tbody>
                </table>
            </div>

            {{ $residents->links() }}

        </div>
    </div>

@endsection
