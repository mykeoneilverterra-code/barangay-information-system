<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Admin') | Barangay San Antonio
    </title>

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap"
        rel="stylesheet"
    >

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="admin-modern-body">

@php

    $sidebarPendingRequests =
        \App\Models\DocumentRequest::query()
            ->where('status', 'Pending')
            ->count();

@endphp


<div class="admin-modern-shell">


    {{-- =====================================================
        SIDEBAR
    ====================================================== --}}
    <aside class="admin-modern-sidebar">

        <a
            href="{{ route('dashboard') }}"
            class="admin-modern-brand"
        >

            <div class="admin-modern-brand-mark">
                BI
            </div>

            <div>

                <strong>
                    Barangay San Antonio
                </strong>

                <span>
                    Information System
                </span>

                <small>
                    Biñan, Laguna
                </small>

            </div>

        </a>


        <p class="admin-modern-nav-label">
            Management
        </p>


        <nav class="admin-modern-nav">


            {{-- Dashboard --}}
            <a
                href="{{ route('dashboard') }}"
                class="admin-modern-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
            >

                <span class="admin-modern-nav-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M3 11 12 3l9 8"/>
                        <path d="M5 10v10h14V10"/>
                    </svg>

                </span>

                Dashboard

            </a>


            {{-- Residents --}}
            <a
                href="{{ route('residents.index') }}"
                class="admin-modern-nav-link {{ request()->routeIs('residents.*') ? 'active' : '' }}"
            >

                <span class="admin-modern-nav-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <circle cx="9" cy="7" r="3"/>
                        <path d="M3 21v-3a6 6 0 0 1 12 0v3"/>
                        <circle cx="17" cy="8" r="2"/>
                        <path d="M15 14a4 4 0 0 1 6 4v3"/>
                    </svg>

                </span>

                Residents

            </a>


            {{-- Document Requests --}}
            <a
                href="{{ route('document-requests.index') }}"
                class="admin-modern-nav-link {{ request()->routeIs('document-requests.*') ? 'active' : '' }}"
            >

                <span class="admin-modern-nav-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M6 2h9l5 5v15H6z"/>
                        <path d="M14 2v6h6"/>
                        <path d="M9 13h6"/>
                        <path d="M9 17h6"/>
                    </svg>

                </span>

                Document Requests


                @if($sidebarPendingRequests > 0)

                    <span class="admin-modern-nav-count">
                        {{ $sidebarPendingRequests }}
                    </span>

                @endif

            </a>

        </nav>


        {{-- Sidebar artwork --}}
        <div class="admin-modern-sidebar-art">

            <img
                src="{{ asset('images/dashboard/sidebar-community.png') }}"
                alt=""
            >

        </div>


        <div class="admin-modern-sidebar-message">

            Serving a Safer,
            <br>

            Stronger, United
            <br>

            Barangay San Antonio

        </div>

    </aside>


    {{-- =====================================================
        MAIN
    ====================================================== --}}
    <div class="admin-modern-main">


        {{-- =================================================
            TOP BAR
        ================================================== --}}
        <header class="admin-modern-topbar">


            {{-- Resident Search --}}
            <form
                action="{{ route('residents.index') }}"
                method="GET"
                class="admin-modern-search"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                >
                    <circle cx="11" cy="11" r="7"/>
                    <path d="m20 20-4-4"/>
                </svg>

                <input
                    type="search"
                    name="search"
                    placeholder="Search residents..."
                    autocomplete="off"
                >

            </form>


            <div class="admin-modern-top-actions">


                {{-- Date --}}
                <div class="admin-modern-date">

                    <div class="admin-modern-date-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        >
                            <rect
                                x="3"
                                y="5"
                                width="18"
                                height="16"
                                rx="2"
                            />

                            <path d="M16 3v4"/>
                            <path d="M8 3v4"/>
                            <path d="M3 11h18"/>
                        </svg>

                    </div>

                    <div>

                        <span>
                            Today
                        </span>

                        <strong>
                            {{ now('Asia/Manila')->format('M d, Y') }}
                        </strong>

                    </div>

                </div>


                {{-- Pending requests --}}
                <a
                    href="{{ route('document-requests.index', ['status' => 'Pending']) }}"
                    class="admin-modern-notification"
                    title="Pending document requests"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    >
                        <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                        <path d="M10 21h4"/>
                    </svg>


                    @if($sidebarPendingRequests > 0)

                        <span>
                            {{ $sidebarPendingRequests }}
                        </span>

                    @endif

                </a>


                {{-- Admin menu --}}
                <details class="admin-modern-profile">

                    <summary>

                        <div class="admin-modern-avatar">
                            BA
                        </div>

                        <div class="admin-modern-profile-copy">

                            <strong>
                                Barangay Admin
                            </strong>

                            <span>
                                Administrator
                            </span>

                        </div>

                        <svg
                            class="admin-modern-chevron"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path d="m6 9 6 6 6-6"/>
                        </svg>

                    </summary>


                    <div class="admin-modern-profile-menu">

                        <div>

                            <strong>
                                Administrator
                            </strong>

                            <span>
                                Barangay San Antonio
                            </span>

                        </div>


                        <form
                            action="{{ route('admin.logout') }}"
                            method="POST"
                        >

                            @csrf

                            <button type="submit">
                                Logout
                            </button>

                        </form>

                    </div>

                </details>

            </div>

        </header>


        {{-- =================================================
            PAGE TITLE FOR NON-DASHBOARD PAGES
        ================================================== --}}
        @unless(request()->routeIs('dashboard'))

            @php

                if (request()->routeIs('residents.*')) {

                    $adminPageTitle = 'Residents';

                    $adminPageSubtitle =
                        'Manage registered resident records.';

                } elseif (request()->routeIs('document-requests.*')) {

                    $adminPageTitle = 'Document Requests';

                    $adminPageSubtitle =
                        'Review and process resident document requests.';

                } else {

                    $adminPageTitle =
                        trim($__env->yieldContent('title'));

                    $adminPageSubtitle =
                        'Barangay administration';

                }

            @endphp


            <section class="admin-modern-page-heading">

                <div>

                    <p>
                        BARANGAY SAN ANTONIO, BIÑAN, LAGUNA
                    </p>

                    <h1>
                        {{ $adminPageTitle }}
                    </h1>

                    <span>
                        {{ $adminPageSubtitle }}
                    </span>

                </div>


                @hasSection('header-actions')

                    <div class="admin-modern-heading-actions">
                        @yield('header-actions')
                    </div>

                @endif

            </section>

        @endunless


        <main class="admin-modern-content">
            @yield('content')
        </main>

    </div>

</div>

</body>

</html>