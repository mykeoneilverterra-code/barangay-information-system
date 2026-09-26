<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Resident Portal') | Barangay San Antonio
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


<body class="resident-portal-body resident-modern-body">

@php

    $portalUser = auth()->user();

    $portalResident = $portalUser->resident;

    $residentFullName =
        $portalResident->full_name
        ?? $portalUser->name;

    $residentInitial =
        strtoupper(
            substr(
                $portalResident->first_name
                    ?? $portalUser->name
                    ?? 'R',
                0,
                1
            )
        );

    $residentPhoto =
        $portalResident->profile_photo_path
            ? asset(
                'storage/'
                . $portalResident->profile_photo_path
            )
            : null;

@endphp


<div class="resident-portal-shell resident-modern-shell">


    {{-- Mobile backdrop --}}
    <button
        type="button"
        class="resident-sidebar-backdrop"
        aria-label="Close navigation"
        data-resident-sidebar-close
    ></button>


    {{-- =====================================================
        SIDEBAR
    ====================================================== --}}
    <aside
        class="resident-sidebar resident-modern-sidebar"
        id="resident-sidebar"
    >


        {{-- Brand --}}
        <div class="resident-sidebar-brand">

            <a
                href="{{ route('resident.portal') }}"
                class="resident-brand-link"
            >

                <div class="resident-brand-mark">
                    BI
                </div>

                <div class="resident-brand-copy">

                    <strong>
                        Barangay San Antonio
                    </strong>

                    <span>
                        Resident Portal
                    </span>

                    <small>
                        Biñan, Laguna
                    </small>

                </div>

            </a>


            <button
                type="button"
                class="resident-sidebar-close"
                aria-label="Close navigation"
                data-resident-sidebar-close
            >
                ×
            </button>

        </div>


        <div class="resident-sidebar-label">
            My Account
        </div>


        {{-- Navigation --}}
        <nav class="resident-sidebar-nav">


            <a
                href="{{ route('resident.portal') }}"
                class="resident-nav-link {{ request()->routeIs('resident.portal') ? 'active' : '' }}"
            >

                <span class="resident-nav-icon">

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


            <a
                href="{{ route('resident.profile') }}"
                class="resident-nav-link {{ request()->routeIs('resident.profile') ? 'active' : '' }}"
            >

                <span class="resident-nav-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    >
                        <circle cx="12" cy="7" r="4"/>
                        <path d="M5 21v-2a7 7 0 0 1 14 0v2"/>
                    </svg>

                </span>

                My Profile

            </a>


            <a
                href="{{ route('resident.requests.create') }}"
                class="resident-nav-link {{ request()->routeIs('resident.requests.create') ? 'active' : '' }}"
            >

                <span class="resident-nav-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    >
                        <path d="M6 2h9l5 5v15H6z"/>
                        <path d="M14 2v6h6"/>
                        <path d="M12 12v6"/>
                        <path d="M9 15h6"/>
                    </svg>

                </span>

                Request Document

            </a>


            <a
                href="{{ route('resident.requests.index') }}"
                class="resident-nav-link {{ request()->routeIs('resident.requests.index') || request()->routeIs('resident.requests.show') ? 'active' : '' }}"
            >

                <span class="resident-nav-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    >
                        <path d="M6 2h12v20H6z"/>
                        <path d="M9 7h6"/>
                        <path d="M9 11h6"/>
                        <path d="M9 15h4"/>
                    </svg>

                </span>

                My Requests

            </a>

        </nav>


        {{-- Sidebar artwork --}}
        <div class="resident-modern-sidebar-art">

            <img
                src="{{ asset('images/dashboard/sidebar-community.png') }}"
                alt=""
            >

        </div>


        {{-- Resident account --}}
        <div class="resident-sidebar-user">

            <div class="resident-sidebar-avatar">

                @if($residentPhoto)

                    <img
                        src="{{ $residentPhoto }}"
                        alt="{{ $residentFullName }}"
                        class="resident-sidebar-avatar-image"
                    >

                @else

                    {{ $residentInitial }}

                @endif

            </div>


            <div class="resident-sidebar-user-info">

                <strong>
                    {{ $residentFullName }}
                </strong>

                <span>
                    {{ $portalResident->resident_number }}
                </span>

            </div>

        </div>


        {{-- Logout --}}
        <form
            action="{{ route('resident.logout') }}"
            method="POST"
            class="resident-sidebar-logout"
        >

            @csrf

            <button
                type="submit"
                class="resident-logout-button"
            >

                <span>
                    ↪
                </span>

                Logout

            </button>

        </form>

    </aside>


    {{-- =====================================================
        MAIN
    ====================================================== --}}
    <div class="resident-portal-main resident-modern-main">


        {{-- =================================================
            TOP HEADER
        ================================================== --}}
        <header class="resident-portal-header resident-modern-topbar">


            <div class="resident-header-left">

                <button
                    type="button"
                    class="resident-menu-button"
                    aria-label="Open navigation"
                    aria-controls="resident-sidebar"
                    aria-expanded="false"
                    data-resident-sidebar-open
                >
                    <span></span>
                    <span></span>
                    <span></span>
                </button>


                <div>

                    <p class="resident-header-eyebrow">
                        BARANGAY SAN ANTONIO RESIDENT PORTAL
                    </p>

                    <h1>
                        @yield('page-title', 'Dashboard')
                    </h1>

                    <p class="resident-header-subtitle">
                        @yield(
                            'page-subtitle',
                            'Access your resident information and barangay services.'
                        )
                    </p>

                </div>

            </div>


            <div class="resident-header-right">


                {{-- Date --}}
                <div class="resident-header-date">

                    <span class="resident-header-date-icon">

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

                    </span>


                    <div>

                        <small>
                            Today
                        </small>

                        <strong>
                            {{ now('Asia/Manila')->format('M d, Y') }}
                        </strong>

                    </div>

                </div>


                {{-- Resident Profile --}}
                <a
                    href="{{ route('resident.profile') }}"
                    class="resident-header-profile"
                >

                    <div class="resident-header-avatar">

                        @if($residentPhoto)

                            <img
                                src="{{ $residentPhoto }}"
                                alt="{{ $residentFullName }}"
                                class="resident-header-avatar-image"
                            >

                        @else

                            {{ $residentInitial }}

                        @endif

                    </div>


                    <div class="resident-header-profile-info">

                        <strong>
                            {{ $residentFullName }}
                        </strong>

                        <span>
                            {{ $portalResident->resident_number }}
                        </span>

                    </div>

                </a>

            </div>

        </header>


        <main class="resident-portal-content resident-modern-content">
            @yield('content')
        </main>

    </div>

</div>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const sidebar =
            document.getElementById('resident-sidebar');

        const backdrop =
            document.querySelector(
                '.resident-sidebar-backdrop'
            );

        const openButton =
            document.querySelector(
                '[data-resident-sidebar-open]'
            );

        const closeButtons =
            document.querySelectorAll(
                '[data-resident-sidebar-close]'
            );


        function closeSidebar() {

            sidebar?.classList.remove('open');

            backdrop?.classList.remove('show');

            openButton?.setAttribute(
                'aria-expanded',
                'false'
            );

        }


        if (openButton) {

            openButton.addEventListener(
                'click',
                function () {

                    sidebar?.classList.add('open');

                    backdrop?.classList.add('show');

                    openButton.setAttribute(
                        'aria-expanded',
                        'true'
                    );

                }
            );

        }


        closeButtons.forEach(
            function (button) {

                button.addEventListener(
                    'click',
                    closeSidebar
                );

            }
        );


        document
            .querySelectorAll('.resident-nav-link')
            .forEach(
                function (link) {

                    link.addEventListener(
                        'click',
                        function () {

                            if (window.innerWidth <= 800) {
                                closeSidebar();
                            }

                        }
                    );

                }
            );

    }
);

</script>

</body>

</html>