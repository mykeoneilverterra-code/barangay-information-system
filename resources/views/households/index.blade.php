@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Households</h1>

        <a href="{{ route('households.create') }}" class="btn btn-primary">
            Add Household
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
                        <th>Household Number</th>
                        <th>Household Head</th>
                        <th>Address</th>
                        <th>Purok</th>
                        <th>Contact Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($households as $household)

                        <tr>
                            <td>{{ $household->household_number }}</td>

                            <td>{{ $household->household_head }}</td>

                            <td>{{ $household->address }}</td>

                            <td>{{ $household->purok }}</td>

                            <td>{{ $household->contact_number ?? 'N/A' }}</td>

                            <td class="actions-cell">
                                <div class="action-group">
                                <a
                                    href="{{ route('households.show', $household) }}"
                                    class="btn btn-sm btn-info"
                                >
                                    View details
                                </a>

                                <a
                                    href="{{ route('households.edit', $household) }}"
                                    class="btn btn-sm btn-warning"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('households.destroy', $household) }}"
                                    method="POST"
                                    class="d-inline action-form"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this household? Its residents will also be removed.')"
                                    >
                                        Delete
                                    </button>
                                </form>
                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center">
                                No households found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

                </table>
            </div>

            {{ $households->links() }}

        </div>
    </div>

@endsection