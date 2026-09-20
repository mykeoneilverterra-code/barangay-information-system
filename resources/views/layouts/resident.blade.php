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


<body class="resident-portal-body">


@php

    $portalUser =
        auth()->user();


    $portalResident =
        $portalUser->resident;


    $residentFirstName =
        $portalResident->first_name
        ?? 'Resident';


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

@endphp


<div class="resident-portal-shell">


    {{-- =====================================================
        MOBILE BACKDROP
    ====================================================== --}}
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
        class="resident-sidebar"
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



        {{-- Label --}}
        <div class="resident-sidebar-label">
            My Account
        </div>



        {{-- =================================================
            NAVIGATION
        ================================================== --}}
        <nav class="resident-sidebar-nav">


            {{-- Dashboard --}}
            <a
                href="{{ route('resident.portal') }}"
                class="resident-nav-link
                {{ request()->routeIs('resident.portal') ? 'active' : '' }}"
            >

                <span class="resident-nav-icon">
                    ▦
                </span>

                <span>
                    Dashboard
                </span>

            </a>



            {{-- My Profile --}}
            <a
                href="#"
                class="resident-nav-link"
            >

                <span class="resident-nav-icon">
                    ◉
                </span>

                <span>
                    My Profile
                </span>

            </a>



            {{-- Request Document --}}
            <a
                href="{{ route('resident.requests.create') }}"
                class="resident-nav-link
                {{ request()->routeIs('resident.requests.create') ? 'active' : '' }}"
            >

                <span class="resident-nav-icon">
                    ＋
                </span>

                <span>
                    Request Document
                </span>

            </a>



            {{-- My Requests --}}
            <a
                href="#"
                class="resident-nav-link"
            >

                <span class="resident-nav-icon">
                    ▤
                </span>

                <span>
                    My Requests
                </span>

            </a>

        </nav>



        {{-- =================================================
            LOGGED-IN RESIDENT
        ================================================== --}}
        <div class="resident-sidebar-user">


            <div class="resident-sidebar-avatar">

                {{ $residentInitial }}

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



        {{-- =================================================
            LOGOUT
        ================================================== --}}
        <form
            action="{{ route('resident.logout') }}"
            method="POST"
            class="resident-sidebar-logout"
            data-logout-form
        >

            @csrf


            <button
                type="button"
                class="resident-logout-button"
                data-logout-trigger
                aria-expanded="false"
            >

                <span>
                    ↪
                </span>

                Logout

            </button>

            <div
                class="resident-logout-confirmation"
                data-logout-confirmation
                role="dialog"
                aria-label="Confirm logout"
                hidden
            >

                <strong>
                    Sign out?
                </strong>

                <span>
                    Your session will end on this device.
                </span>

                <div class="resident-logout-confirmation-actions">

                    <button
                        type="button"
                        class="resident-logout-cancel"
                        data-logout-cancel
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="resident-logout-confirm"
                    >
                        Log out
                    </button>

                </div>

            </div>

        </form>

    </aside>



    {{-- =====================================================
        MAIN
    ====================================================== --}}
    <div class="resident-portal-main">


        {{-- =================================================
            HEADER
        ================================================== --}}
        <header class="resident-portal-header">


            <div class="resident-header-left">


                {{-- Mobile Menu --}}
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

                        @yield(
                            'page-title',
                            'Welcome, ' . $residentFirstName
                        )

                    </h1>


                    <p class="resident-header-subtitle">

                        @yield(
                            'page-subtitle',
                            'Access your resident information and barangay services.'
                        )

                    </p>

                </div>

            </div>



            {{-- =================================================
                HEADER RIGHT
            ================================================== --}}
            <div class="resident-header-right">


                {{-- Date --}}
                <div class="resident-header-date">


                    <span class="resident-header-date-icon">
                        ◫
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



                {{-- Dynamic Resident --}}
                <div class="resident-header-profile">


                    <div class="resident-header-avatar">

                        {{ $residentInitial }}

                    </div>


                    <div class="resident-header-profile-info">

                        <strong>

                            {{ $residentFullName }}

                        </strong>


                        <span>

                            {{ $portalResident->resident_number }}

                        </span>

                    </div>

                </div>

            </div>

        </header>



        {{-- =====================================================
            PAGE CONTENT
        ====================================================== --}}
        <main class="resident-portal-content">

            @yield('content')

        </main>

    </div>

</div>



{{-- =========================================================
    MOBILE SIDEBAR SCRIPT
========================================================= --}}
<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const sidebar =
                document.getElementById(
                    'resident-sidebar'
                );


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


            const navigationLinks =
                document.querySelectorAll(
                    '.resident-nav-link'
                );


            if (openButton) {

                openButton.addEventListener(
                    'click',
                    function () {

                        sidebar?.classList.add(
                            'open'
                        );


                        backdrop?.classList.add(
                            'show'
                        );


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
                        function () {

                            sidebar?.classList.remove(
                                'open'
                            );


                            backdrop?.classList.remove(
                                'show'
                            );


                            openButton?.setAttribute(
                                'aria-expanded',
                                'false'
                            );

                        }
                    );

                }
            );


            navigationLinks.forEach(
                function (link) {

                    link.addEventListener(
                        'click',
                        function () {

                            if (
                                window.innerWidth <= 800
                            ) {

                                sidebar?.classList.remove(
                                    'open'
                                );


                                backdrop?.classList.remove(
                                    'show'
                                );


                                openButton?.setAttribute(
                                    'aria-expanded',
                                    'false'
                                );

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