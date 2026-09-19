@extends('layouts.app')

@section('title', 'Households')

@section('content')

<div class="records-page">


    {{-- =====================================================
        SUCCESS MESSAGE
    ====================================================== --}}
    @if(session('success'))

        <div class="records-alert records-alert-success">

            <div class="alert-icon">
                ✓
            </div>

            <div>

                <strong>
                    Success
                </strong>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        </div>

    @endif


    {{-- =====================================================
        HOUSEHOLD RECORDS CARD
    ====================================================== --}}
    <div class="records-card">


        {{-- =====================================================
            HEADER
        ====================================================== --}}
        <div class="records-card-header">

            <div>

                <h3>
                    Household Records
                </h3>

                <p>
                    Complete list of registered households in Barangay San Antonio, Biñan, Laguna.
                </p>

            </div>


            <div class="records-card-actions">

                <div class="record-count-inline">

                    <strong>
                        {{ $totalHouseholds }}
                    </strong>

                    <span>
                        Total Households
                    </span>

                </div>


                <a
                    href="{{ route('households.create') }}"
                    class="primary-action-btn"
                >
                    <span class="action-icon">
                        +
                    </span>

                    Add Household
                </a>

            </div>

        </div>


        {{-- =====================================================
            SEARCH + FILTER
        ====================================================== --}}
        <form
            action="{{ route('households.index') }}"
            method="GET"
            class="records-filter-bar"
        >

            {{-- Search --}}
            <div class="filter-search">

                <span class="filter-search-icon">
                    ⌕
                </span>

                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Search household no., head, address or contact..."
                    autocomplete="off"
                >

            </div>


            {{-- Village / Street Filter --}}
            <div class="filter-select">

                <select name="area">

                    <option value="">
                        All Villages / Streets
                    </option>


                    @foreach($areas as $areaOption)

                        <option
                            value="{{ $areaOption }}"
                            {{ $area === $areaOption ? 'selected' : '' }}
                        >
                            {{ $areaOption }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Search Button --}}
            <button
                type="submit"
                class="filter-submit-btn"
            >
                Search
            </button>


            {{-- Clear Button --}}
            @if($search !== '' || $area !== '')

                <a
                    href="{{ route('households.index') }}"
                    class="filter-clear-btn"
                >
                    Clear
                </a>

            @endif

        </form>


        {{-- =====================================================
            SEARCH RESULT INFO
        ====================================================== --}}
        @if($search !== '' || $area !== '')

            <div class="filter-result-info">

                Found

                <strong>
                    {{ $households->total() }}
                </strong>

                matching household{{ $households->total() === 1 ? '' : 's' }}.

            </div>

        @endif


        {{-- =====================================================
            TABLE
        ====================================================== --}}
        <div class="records-table-wrapper">

            <table class="records-table">

                <thead>

                    <tr>

                        <th>
                            Household No.
                        </th>

                        <th>
                            Household Head
                        </th>

                        <th>
                            Address
                        </th>

                        <th>
                            Village / Street
                        </th>

                        <th>
                            Contact Number
                        </th>

                        <th class="actions-heading">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($households as $household)

                        <tr>


                            {{-- Household Number --}}
                            <td>

                                <a
                                    href="{{ route('households.show', $household) }}"
                                    class="record-id"
                                >
                                    {{ $household->household_number }}
                                </a>

                            </td>


                            {{-- Household Head --}}
                            <td>

                                <div class="record-person">

                                    <div class="record-avatar">

                                        {{ strtoupper(
                                            substr(
                                                $household->household_head,
                                                0,
                                                1
                                            )
                                        ) }}

                                    </div>

                                    <span>
                                        {{ $household->household_head }}
                                    </span>

                                </div>

                            </td>


                            {{-- Address --}}
                            <td class="record-address">

                                {{ $household->address }}

                            </td>


                            {{-- Village / Street --}}
                            <td>

                                <span class="area-badge">

                                    {{ $household->area }}

                                </span>

                            </td>


                            {{-- Contact Number --}}
                            <td>

                                @if($household->contact_number)

                                    {{ $household->contact_number }}

                                @else

                                    <span class="record-muted">
                                        Not provided
                                    </span>

                                @endif

                            </td>


                            {{-- =====================================================
                                ACTIONS
                            ====================================================== --}}
                            <td>

                                <div class="records-actions">


                                    {{-- View --}}
                                    <a
                                        href="{{ route('households.show', $household) }}"
                                        class="record-action record-action-view"
                                    >
                                        View
                                    </a>


                                    {{-- More Actions --}}
                                    <details class="action-menu">

                                        <summary
                                            class="action-menu-trigger"
                                            title="More actions"
                                        >
                                            ⋮
                                        </summary>


                                        <div class="action-menu-dropdown">


                                            {{-- Edit --}}
                                            <a
                                                href="{{ route('households.edit', $household) }}"
                                                class="action-menu-item"
                                            >

                                                <span class="menu-item-icon">
                                                    ✎
                                                </span>

                                                Edit Household

                                            </a>


                                            <div class="action-menu-divider">
                                            </div>


                                            {{-- Delete --}}
                                            <form
                                                action="{{ route('households.destroy', $household) }}"
                                                method="POST"
                                                class="action-menu-form"
                                            >

                                                @csrf
                                                @method('DELETE')


                                                <button
                                                    type="submit"
                                                    class="action-menu-item action-menu-delete"
                                                    onclick="return confirm('Are you sure you want to delete {{ $household->household_number }}? Residents connected to this household may also be removed.')"
                                                >

                                                    <span class="menu-item-icon">
                                                        ×
                                                    </span>

                                                    Delete Household

                                                </button>

                                            </form>

                                        </div>

                                    </details>

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="records-empty"
                            >

                                <div class="empty-icon">
                                    ⌕
                                </div>


                                <strong>
                                    No households found
                                </strong>


                                <p>

                                    @if($search !== '' || $area !== '')

                                        Try changing your search or Village / Street filter.

                                    @else

                                        Add your first household record to get started.

                                    @endif

                                </p>


                                @if($search !== '' || $area !== '')

                                    <a
                                        href="{{ route('households.index') }}"
                                        class="secondary-action-btn"
                                    >
                                        Clear Filters
                                    </a>

                                @else

                                    <a
                                        href="{{ route('households.create') }}"
                                        class="primary-action-btn"
                                    >
                                        + Add Household
                                    </a>

                                @endif

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- =====================================================
            PAGINATION
        ====================================================== --}}
        <div class="records-pagination">

            <div class="pagination-info">

                @if($households->total() > 0)

                    Showing

                    <strong>
                        {{ $households->firstItem() }}
                    </strong>

                    to

                    <strong>
                        {{ $households->lastItem() }}
                    </strong>

                    of

                    <strong>
                        {{ $households->total() }}
                    </strong>

                    households

                @else

                    No households found

                @endif

            </div>


            @if($households->hasPages())

                <div>
                    {{ $households->links() }}
                </div>

            @endif

        </div>

    </div>

</div>

@endsection