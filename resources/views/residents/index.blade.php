@extends('layouts.app')

@section('title', 'Residents')

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
        RESIDENT RECORDS CARD
    ====================================================== --}}
    <div class="records-card">


        {{-- =====================================================
            HEADER
        ====================================================== --}}
        <div class="records-card-header">

            <div>

                <h3>
                    Resident Records
                </h3>

                <p>
                    Registered residents of Barangay San Antonio
                    organized by address and Village / Street.
                </p>

            </div>


            <div class="records-card-actions">

                <div class="record-count-inline">

                    <strong>
                        {{ $totalResidents }}
                    </strong>

                    <span>
                        Total Residents
                    </span>

                </div>


                <a
                    href="{{ route('residents.create') }}"
                    class="primary-action-btn"
                >

                    <span class="action-icon">
                        +
                    </span>

                    Add Resident

                </a>

            </div>

        </div>



        {{-- =====================================================
            SEARCH + FILTER
        ====================================================== --}}
        <form
            action="{{ route('residents.index') }}"
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
                    placeholder="Search name, ID, address, occupation or contact..."
                    autocomplete="off"
                >

            </div>



            {{-- Area Filter --}}
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



            {{-- Clear Filter --}}
            @if($search !== '' || $area !== '')

                <a
                    href="{{ route('residents.index') }}"
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
                    {{ $residents->total() }}
                </strong>

                matching resident{{ $residents->total() === 1 ? '' : 's' }}.

            </div>

        @endif



        {{-- =====================================================
            RESIDENT TABLE
        ====================================================== --}}
        <div class="records-table-wrapper">

            <table class="records-table">

                <thead>

                    <tr>

                        <th>
                            Resident No.
                        </th>

                        <th>
                            Resident
                        </th>

                        <th>
                            Address
                        </th>

                        <th>
                            Village / Street
                        </th>

                        <th>
                            Sex
                        </th>

                        <th>
                            Voter
                        </th>

                        <th class="actions-heading">
                            Actions
                        </th>

                    </tr>

                </thead>



                <tbody>

                    @forelse($residents as $resident)

                        <tr>


                            {{-- =================================================
                                RESIDENT NUMBER
                            ================================================== --}}
                            <td>

                                <a
                                    href="{{ route('residents.show', $resident) }}"
                                    class="record-id"
                                >
                                    {{ $resident->resident_number }}
                                </a>

                            </td>



                            {{-- =================================================
                                RESIDENT
                            ================================================== --}}
                            <td>

                                <div class="record-person">


                                    {{-- Profile Photo / Initial --}}
                                    <div class="record-avatar">

                                        @if($resident->profile_photo_path)

                                            <img
                                                src="{{ asset(
                                                    'storage/'
                                                    . $resident->profile_photo_path
                                                ) }}"
                                                alt="{{ $resident->full_name }}"
                                                class="record-avatar-image"
                                            >

                                        @else

                                            {{ strtoupper(
                                                substr(
                                                    $resident->first_name,
                                                    0,
                                                    1
                                                )
                                            ) }}

                                        @endif

                                    </div>


                                    <div class="resident-name-info">

                                        <span class="resident-name">
                                            {{ $resident->full_name }}
                                        </span>

                                        <small>
                                            {{ $resident->occupation ?? 'No occupation listed' }}
                                        </small>

                                    </div>

                                </div>

                            </td>



                            {{-- =================================================
                                ADDRESS
                            ================================================== --}}
                            <td class="record-address">

                                {{ $resident->address }}

                            </td>



                            {{-- =================================================
                                VILLAGE / STREET
                            ================================================== --}}
                            <td>

                                <span class="area-badge">

                                    {{ $resident->area }}

                                </span>

                            </td>



                            {{-- =================================================
                                SEX
                            ================================================== --}}
                            <td>

                                <span class="resident-sex-badge">

                                    {{ $resident->sex }}

                                </span>

                            </td>



                            {{-- =================================================
                                VOTER STATUS
                            ================================================== --}}
                            <td>

                                @if($resident->is_voter)

                                    <span class="voter-badge voter-yes">
                                        Registered
                                    </span>

                                @else

                                    <span class="voter-badge voter-no">
                                        Not Registered
                                    </span>

                                @endif

                            </td>



                            {{-- =================================================
                                ACTIONS
                            ================================================== --}}
                            <td>

                                <div class="records-actions">


                                    {{-- View --}}
                                    <a
                                        href="{{ route('residents.show', $resident) }}"
                                        class="record-action record-action-view"
                                    >
                                        View
                                    </a>



                                    {{-- More Menu --}}
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
                                                href="{{ route('residents.edit', $resident) }}"
                                                class="action-menu-item"
                                            >

                                                <span class="menu-item-icon">
                                                    ✎
                                                </span>

                                                Edit Resident

                                            </a>


                                            <div class="action-menu-divider">
                                            </div>


                                            {{-- Delete --}}
                                            <form
                                                action="{{ route('residents.destroy', $resident) }}"
                                                method="POST"
                                                class="action-menu-form"
                                            >

                                                @csrf
                                                @method('DELETE')


                                                <button
                                                    type="submit"
                                                    class="action-menu-item action-menu-delete"
                                                    onclick="return confirm('Are you sure you want to delete {{ $resident->resident_number }}?')"
                                                >

                                                    <span class="menu-item-icon">
                                                        ×
                                                    </span>

                                                    Delete Resident

                                                </button>

                                            </form>

                                        </div>

                                    </details>

                                </div>

                            </td>

                        </tr>


                    @empty

                        {{-- =================================================
                            EMPTY STATE
                        ================================================== --}}
                        <tr>

                            <td
                                colspan="7"
                                class="records-empty"
                            >

                                <div class="empty-icon">
                                    ⌕
                                </div>

                                <strong>
                                    No residents found
                                </strong>

                                <p>

                                    @if($search !== '' || $area !== '')

                                        Try changing your search or
                                        Village / Street filter.

                                    @else

                                        Add your first resident record
                                        to get started.

                                    @endif

                                </p>

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


            {{-- Pagination Info --}}
            <div class="pagination-info">

                @if($residents->total() > 0)

                    Showing

                    <strong>
                        {{ $residents->firstItem() }}
                    </strong>

                    to

                    <strong>
                        {{ $residents->lastItem() }}
                    </strong>

                    of

                    <strong>
                        {{ $residents->total() }}
                    </strong>

                    residents

                @else

                    No residents found

                @endif

            </div>



            {{-- Pagination Buttons --}}
            @if($residents->hasPages())

                <div class="custom-pagination">


                    {{-- Previous --}}
                    @if($residents->onFirstPage())

                        <span class="pagination-button disabled">
                            ‹
                        </span>

                    @else

                        <a
                            href="{{ $residents->previousPageUrl() }}"
                            class="pagination-button"
                        >
                            ‹
                        </a>

                    @endif



                    {{-- Page Numbers --}}
                    @for(
                        $page = 1;
                        $page <= $residents->lastPage();
                        $page++
                    )

                        @if($page == $residents->currentPage())

                            <span class="pagination-button active">
                                {{ $page }}
                            </span>

                        @else

                            <a
                                href="{{ $residents->url($page) }}"
                                class="pagination-button"
                            >
                                {{ $page }}
                            </a>

                        @endif

                    @endfor



                    {{-- Next --}}
                    @if($residents->hasMorePages())

                        <a
                            href="{{ $residents->nextPageUrl() }}"
                            class="pagination-button"
                        >
                            ›
                        </a>

                    @else

                        <span class="pagination-button disabled">
                            ›
                        </span>

                    @endif

                </div>

            @endif

        </div>

    </div>

</div>

@endsection