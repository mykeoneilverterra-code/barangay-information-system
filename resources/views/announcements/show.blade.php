@extends('layouts.app')

@section('title', 'Announcement Details')

@section('page-title', 'Announcement Details')

@section(
    'page-subtitle',
    'Review the selected barangay announcement.'
)

@section('content')


@include('announcements._styles')


@php

    $categoryClass =
        strtolower(
            $announcement->category
        );

@endphp


<div class="announcement-page">


    <div class="announcement-breadcrumb">

        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <span>›</span>

        <a href="{{ route('announcements.index') }}">
            Announcements
        </a>

        <span>›</span>

        <strong>
            View
        </strong>

    </div>


    <div class="announcement-show-actions">


        <a
            href="{{ route(
                'announcements.edit',
                $announcement
            ) }}"
            class="announcement-button-secondary"
        >
            Edit
        </a>


        <a
            href="{{ route('announcements.index') }}"
            class="announcement-button-primary"
        >
            Back to Announcements
        </a>


    </div>


    <section class="announcement-detail-card">


        <div class="announcement-detail-hero">


            <div class="announcement-detail-icon">

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


            <div class="announcement-detail-heading">


                <span
                    class="
                        announcement-category-badge
                        {{ $categoryClass }}
                    "
                >
                    {{ $announcement->category }}
                </span>


                <h2>
                    {{ $announcement->title }}
                </h2>


                <div class="announcement-detail-meta">


                    <span>
                        {{
                            $announcement
                                ->announcement_date
                                ->format('F d, Y')
                        }}
                    </span>


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


                </div>


            </div>


        </div>


        <div class="announcement-detail-body">


            <div class="announcement-detail-section">

                <h3>
                    Description
                </h3>

                <p>
                    {{ $announcement->description }}
                </p>

            </div>


            <div class="announcement-detail-section">


                <h3>
                    Details
                </h3>


                <div class="announcement-detail-grid">


                    <div>

                        <span>
                            Category
                        </span>

                        <strong>
                            {{ $announcement->category }}
                        </strong>

                    </div>


                    <div>

                        <span>
                            Announcement Date
                        </span>

                        <strong>
                            {{
                                $announcement
                                    ->announcement_date
                                    ->format('F d, Y')
                            }}
                        </strong>

                    </div>


                    <div>

                        <span>
                            Status
                        </span>

                        <strong>
                            {{ $announcement->status }}
                        </strong>

                    </div>


                    <div>

                        <span>
                            Created
                        </span>

                        <strong>
                            {{
                                $announcement
                                    ->created_at
                                    ->format(
                                        'M d, Y h:i A'
                                    )
                            }}
                        </strong>

                    </div>


                    <div>

                        <span>
                            Last Updated
                        </span>

                        <strong>
                            {{
                                $announcement
                                    ->updated_at
                                    ->format(
                                        'M d, Y h:i A'
                                    )
                            }}
                        </strong>

                    </div>


                </div>


            </div>


        </div>


    </section>


</div>


@endsection