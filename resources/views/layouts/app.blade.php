<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Barangay Information System')
    </title>


    {{-- Google Fonts --}}
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


    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    {{-- Project Files --}}
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="app-body">

<div class="app-shell">


    {{-- =====================================================
        MOBILE BACKDROP
    ====================================================== --}}
    <button
        class="sidebar-backdrop"
        type="button"
        aria-label="Close navigation"
        data-sidebar-close
    ></button>


    {{-- =====================================================
        SIDEBAR
    ====================================================== --}}
    <aside
        class="app-sidebar"
        id="app-sidebar"
    >

        {{-- =================================================
            SIDEBAR HEADER / BRAND
        ================================================== --}}
        <div class="sidebar-head">

            <a
                class="brand"
                href="{{ route('dashboard') }}"
            >

                <span class="brand-mark">
                    BI
                </span>


                <span class="brand-copy">

                    <strong>
                        Barangay San Antonio
                    </strong>

                    <small>
                        Information System
                    </small>

                    <small class="brand-location">
                        Biñan, Laguna
                    </small>

                </span>

            </a>


            {{-- Mobile Close Button --}}
            <button
                class="sidebar-close"
                type="button"
                aria-label="Close navigation"
                data-sidebar-close
            >
                &times;
            </button>

        </div>


        {{-- =================================================
            MANAGEMENT LABEL
        ================================================== --}}
        <div class="sidebar-label">
            Management
        </div>


        {{-- =================================================
            SIDEBAR NAVIGATION
        ================================================== --}}
        <nav class="sidebar-nav">


            {{-- Dashboard --}}
            <a
                class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                href="{{ route('dashboard') }}"
                data-sidebar-link
            >

                <span class="nav-icon">
                    ▦
                </span>

                Dashboard

            </a>


            {{-- Residents --}}
            <a
                class="sidebar-link {{ request()->routeIs('residents.*') ? 'active' : '' }}"
                href="{{ route('residents.index') }}"
                data-sidebar-link
            >

                <span class="nav-icon">
                    ◉
                </span>

                Residents

            </a>


            {{-- Document Requests --}}
            <a
                class="sidebar-link {{ request()->routeIs('document-requests.*') ? 'active' : '' }}"
                href="{{ route('document-requests.index') }}"
                data-sidebar-link
            >

                <span class="nav-icon">
                    ▤
                </span>

                Document Requests

            </a>

        </nav>


        {{-- =================================================
            SIDEBAR FOOTER
        ================================================== --}}
        <div class="sidebar-footer">

            <div>

                <span class="status-dot"></span>

                <span>
                    System online
                </span>

            </div>


            <small class="sidebar-location">
                Barangay San Antonio<br>
                Biñan, Laguna
            </small>

        </div>

    </aside>


    {{-- =====================================================
        MAIN CONTENT
    ====================================================== --}}
    <div class="app-content">


        {{-- =================================================
            PAGE TITLE / SUBTITLE LOGIC
        ================================================== --}}
        @php

            /*
            |--------------------------------------------------------------------------
            | Dashboard
            |--------------------------------------------------------------------------
            */

            if (request()->routeIs('dashboard')) {

                $pageTitle = 'Dashboard';

                $pageSubtitle =
                    'Barangay resident information overview';


            /*
            |--------------------------------------------------------------------------
            | Residents
            |--------------------------------------------------------------------------
            */

            } elseif (request()->routeIs('residents.index')) {

                $pageTitle = 'Residents';

                $pageSubtitle =
                    'Manage registered resident records';


            } elseif (request()->routeIs('residents.create')) {

                $pageTitle = 'Add Resident';

                $pageSubtitle =
                    'Register a new barangay resident';


            } elseif (request()->routeIs('residents.edit')) {

                $pageTitle = 'Edit Resident';

                $pageSubtitle =
                    'Update resident information';


            } elseif (request()->routeIs('residents.show')) {

                $pageTitle = 'Resident Details';

                $pageSubtitle =
                    'View registered resident information';


            /*
            |--------------------------------------------------------------------------
            | Document Requests
            |--------------------------------------------------------------------------
            */

            } elseif (request()->routeIs('document-requests.index')) {

                $pageTitle = 'Document Requests';

                $pageSubtitle =
                    'Manage barangay certificate and clearance requests';


            } elseif (request()->routeIs('document-requests.create')) {

                $pageTitle = 'New Document Request';

                $pageSubtitle =
                    'Create a new barangay document request';


            } elseif (request()->routeIs('document-requests.edit')) {

                $pageTitle = 'Edit Document Request';

                $pageSubtitle =
                    'Update request information and status';


            } elseif (request()->routeIs('document-requests.show')) {

                $pageTitle = 'Request Details';

                $pageSubtitle =
                    'View barangay document request information';


            /*
            |--------------------------------------------------------------------------
            | Default
            |--------------------------------------------------------------------------
            */

            } else {

                $pageTitle =
                    'Barangay Information System';

                $pageSubtitle =
                    'Barangay administration';

            }

        @endphp


        {{-- =====================================================
            TOP HEADER
        ====================================================== --}}
        <header class="top-header">


            {{-- =================================================
                HEADER LEFT
            ================================================== --}}
            <div class="top-header-left">


                {{-- Mobile Menu Button --}}
                <button
                    class="menu-button"
                    type="button"
                    aria-label="Open navigation"
                    aria-controls="app-sidebar"
                    aria-expanded="false"
                    data-sidebar-open
                >

                    <span></span>
                    <span></span>
                    <span></span>

                </button>


                {{-- Breadcrumb --}}
                <div class="breadcrumb">

                    <a href="{{ route('dashboard') }}">
                        Home
                    </a>

                    <span class="breadcrumb-separator">
                        /
                    </span>

                    <span>
                        {{ $pageTitle }}
                    </span>

                </div>


                {{-- Page Title --}}
                <div class="top-header-title">

                    <p class="top-eyebrow">
                        BARANGAY SAN ANTONIO, BIÑAN, LAGUNA
                    </p>

                    <h1>
                        {{ $pageTitle }}
                    </h1>

                    <p>
                        {{ $pageSubtitle }}
                    </p>

                </div>

            </div>


            {{-- =================================================
                HEADER RIGHT
            ================================================== --}}
            <div class="top-header-right">


                {{-- Date --}}
                <div class="header-date">

                    <div class="header-date-icon">
                        ◫
                    </div>


                    <div>

                        <span class="header-date-label">
                            Today
                        </span>

                        <strong>
                            {{ now('Asia/Manila')->format('M d, Y') }}
                        </strong>

                    </div>

                </div>


                {{-- Admin Profile --}}
                <div class="admin-profile">

                    <div class="admin-avatar">
                        BA
                    </div>


                    <div class="admin-info">

                        <strong>
                            Barangay Admin
                        </strong>

                        <span>
                            Administrator
                        </span>

                    </div>

                </div>

            </div>

        </header>


        {{-- =====================================================
            PAGE CONTENT
        ====================================================== --}}
        <main class="page-content">

            @yield('content')

        </main>

    </div>

</div>

</body>

</html>