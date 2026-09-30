@extends('layouts.app')

@section('title', 'Announcements')

@section('page-title', 'Announcements')

@section(
    'page-subtitle',
    'Manage barangay announcements and information for residents.'
)

@section('content')


@include('announcements._styles')


<div class="announcement-page">


    <div class="announcement-breadcrumb">

        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <span>›</span>

        <strong>
            Announcements
        </strong>

    </div>


    <div class="announcement-page-heading">

        <div>

            <span class="announcement-eyebrow">
                BARANGAY UPDATES
            </span>

            <h2>
                Announcements
            </h2>

            <p>
                Create and manage information shown to residents.
            </p>

        </div>


        <a
            href="{{ route('announcements.create') }}"
            class="announcement-button-primary"
        >

            <span>
                +
            </span>

            Add Announcement

        </a>

    </div>


    <div class="announcement-stats">


        <div class="announcement-stat-card">

            <div class="announcement-stat-icon total">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path d="M3 11 18 5v14L3 13z"/>
                    <path d="M7 14l2 5h3l-2-6"/>
                </svg>

            </div>

            <div>

                <span>
                    Total Announcements
                </span>

                <strong>
                    {{ $totalAnnouncements }}
                </strong>

            </div>

        </div>


        <div class="announcement-stat-card">

            <div class="announcement-stat-icon published">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path d="m5 12 4 4L19 6"/>
                </svg>

            </div>

            <div>

                <span>
                    Published
                </span>

                <strong>
                    {{ $publishedAnnouncements }}
                </strong>

            </div>

        </div>


        <div class="announcement-stat-card">

            <div class="announcement-stat-icon draft">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <circle cx="12" cy="12" r="9"/>
                    <path d="M12 7v5l3 2"/>
                </svg>

            </div>

            <div>

                <span>
                    Draft
                </span>

                <strong>
                    {{ $draftAnnouncements }}
                </strong>

            </div>

        </div>

    </div>


    @if(session('success'))

        <div class="announcement-success-alert">

            <span class="announcement-success-icon">
                ✓
            </span>

            {{ session('success') }}

        </div>

    @endif


    <section class="announcement-table-card">


        <form
            action="{{ route('announcements.index') }}"
            method="GET"
            class="announcement-filters"
        >


            <div class="announcement-search">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <circle cx="11" cy="11" r="7"/>
                    <path d="m20 20-3.5-3.5"/>
                </svg>

                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search announcements..."
                >

            </div>


            <select name="category">

                <option value="">
                    All Categories
                </option>

                @foreach([
                    'Community',
                    'Youth',
                    'Health',
                    'Government',
                    'Emergency',
                    'Other'
                ] as $category)

                    <option
                        value="{{ $category }}"
                        @selected(
                            request('category')
                                === $category
                        )
                    >
                        {{ $category }}
                    </option>

                @endforeach

            </select>


            <select name="status">

                <option value="">
                    All Status
                </option>

                <option
                    value="Published"
                    @selected(
                        request('status')
                        === 'Published'
                    )
                >
                    Published
                </option>

                <option
                    value="Draft"
                    @selected(
                        request('status')
                        === 'Draft'
                    )
                >
                    Draft
                </option>

            </select>


            <button
                type="submit"
                class="announcement-filter-button"
            >
                Filter
            </button>


            @if(
                request()->filled('search')
                || request()->filled('category')
                || request()->filled('status')
            )

                <a
                    href="{{ route('announcements.index') }}"
                    class="announcement-clear-filter"
                >
                    Clear
                </a>

            @endif

        </form>


        <div class="announcement-table-wrap">


            <table class="announcement-table">


                <thead>

                    <tr>

                        <th>
                            #
                        </th>

                        <th>
                            Title
                        </th>

                        <th>
                            Category
                        </th>

                        <th>
                            Date
                        </th>

                        <th>
                            Status
                        </th>

                        <th class="announcement-actions-heading">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>


                @forelse($announcements as $announcement)

                    @php

                        $categoryClass =
                            strtolower(
                                $announcement->category
                            );

                    @endphp


                    <tr>


                        <td class="announcement-row-number">

                            {{
                                $announcements->firstItem()
                                + $loop->index
                            }}

                        </td>


                        <td>

                            <div class="announcement-title-cell">

                                <strong>
                                    {{ $announcement->title }}
                                </strong>

                                <span>
                                    {{
                                        \Illuminate\Support\Str::limit(
                                            $announcement->description,
                                            75
                                        )
                                    }}
                                </span>

                            </div>

                        </td>


                        <td>

                            <span
                                class="
                                    announcement-category-badge
                                    {{ $categoryClass }}
                                "
                            >
                                {{ $announcement->category }}
                            </span>

                        </td>


                        <td>

                            {{
                                $announcement
                                    ->announcement_date
                                    ->format('M d, Y')
                            }}

                        </td>


                        <td>

                            <span
                                class="
                                    announcement-status-badge
                                    {{
                                        strtolower(
                                            $announcement->status
                                        )
                                    }}
                                "
                            >
                                {{ $announcement->status }}
                            </span>

                        </td>


                        <td>

                            <div class="announcement-row-actions">


                                <a
                                    href="{{ route(
                                        'announcements.show',
                                        $announcement
                                    ) }}"
                                    class="
                                        announcement-icon-button
                                        view
                                    "
                                    title="View"
                                >

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12Z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>

                                </a>


                                <a
                                    href="{{ route(
                                        'announcements.edit',
                                        $announcement
                                    ) }}"
                                    class="
                                        announcement-icon-button
                                        edit
                                    "
                                    title="Edit"
                                >

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path d="M12 20h9"/>
                                        <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"/>
                                    </svg>

                                </a>


                                <button
                                    type="button"
                                    class="
                                        announcement-icon-button
                                        delete
                                    "
                                    title="Delete"
                                    data-delete-announcement
                                    data-delete-id="{{ $announcement->id }}"
                                    data-delete-title="{{ $announcement->title }}"
                                >

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path d="M3 6h18"/>
                                        <path d="M8 6V4h8v2"/>
                                        <path d="M19 6l-1 14H6L5 6"/>
                                    </svg>

                                </button>


                            </div>

                        </td>


                    </tr>


                @empty


                    <tr>

                        <td
                            colspan="6"
                            class="announcement-empty"
                        >

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path d="M3 11 18 5v14L3 13z"/>
                            </svg>

                            <strong>
                                No announcements found.
                            </strong>

                            <span>
                                Create an announcement
                                or adjust your filters.
                            </span>

                        </td>

                    </tr>


                @endforelse


                </tbody>


            </table>


        </div>


        @if($announcements->hasPages())

            <div class="announcement-pagination">


                <div>

                    Showing

                    {{ $announcements->firstItem() }}

                    to

                    {{ $announcements->lastItem() }}

                    of

                    {{ $announcements->total() }}

                    results

                </div>


                <div class="announcement-pagination-controls">


                    @if($announcements->onFirstPage())

                        <span class="disabled">
                            ‹
                        </span>

                    @else

                        <a
                            href="{{ $announcements->previousPageUrl() }}"
                        >
                            ‹
                        </a>

                    @endif


                    <span class="current">

                        {{ $announcements->currentPage() }}

                    </span>


                    @if($announcements->hasMorePages())

                        <a
                            href="{{ $announcements->nextPageUrl() }}"
                        >
                            ›
                        </a>

                    @else

                        <span class="disabled">
                            ›
                        </span>

                    @endif


                </div>


            </div>

        @endif


    </section>


</div>



<div
    class="announcement-modal-backdrop"
    id="announcement-delete-modal"
    hidden
>


    <div class="announcement-delete-modal">


        <div class="announcement-delete-icon">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path d="M3 6h18"/>
                <path d="M8 6V4h8v2"/>
                <path d="M19 6l-1 14H6L5 6"/>
            </svg>

        </div>


        <h3>
            Delete Announcement
        </h3>


        <p>
            Are you sure you want to delete
            <strong id="announcement-delete-name"></strong>?
        </p>


        <span class="announcement-delete-warning">
            This action cannot be undone.
        </span>


        <div class="announcement-delete-actions">


            <button
                type="button"
                class="announcement-button-secondary"
                id="announcement-delete-cancel"
            >
                Cancel
            </button>


            <form
                method="POST"
                id="announcement-delete-form"
            >

                @csrf

                @method('DELETE')


                <button
                    type="submit"
                    class="announcement-button-danger"
                >
                    Delete Announcement
                </button>

            </form>


        </div>


    </div>


</div>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const modal =
            document.getElementById(
                'announcement-delete-modal'
            );

        const form =
            document.getElementById(
                'announcement-delete-form'
            );

        const name =
            document.getElementById(
                'announcement-delete-name'
            );

        const cancel =
            document.getElementById(
                'announcement-delete-cancel'
            );


        document
            .querySelectorAll(
                '[data-delete-announcement]'
            )
            .forEach(function (button) {

                button.addEventListener(
                    'click',
                    function () {

                        const id =
                            button.dataset.deleteId;

                        const title =
                            button.dataset.deleteTitle;

                        name.textContent =
                            '"' + title + '"';

                        form.action =
                            "{{ url('/announcements') }}"
                            + '/'
                            + id;

                        modal.hidden = false;

                        document.body.classList.add(
                            'announcement-modal-open'
                        );

                    }
                );

            });


        function closeModal() {

            modal.hidden = true;

            document.body.classList.remove(
                'announcement-modal-open'
            );

        }


        cancel.addEventListener(
            'click',
            closeModal
        );


        modal.addEventListener(
            'click',
            function (event) {

                if (event.target === modal) {
                    closeModal();
                }

            }
        );


        document.addEventListener(
            'keydown',
            function (event) {

                if (
                    event.key === 'Escape'
                    && !modal.hidden
                ) {
                    closeModal();
                }

            }
        );

    }
);

</script>


@endsection