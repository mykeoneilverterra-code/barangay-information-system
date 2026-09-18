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


    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="app-body">

<div class="app-shell">


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


            <button
                class="sidebar-close"
                type="button"
                aria-label="Close navigation"
                data-sidebar-close
            >
                &times;
            </button>

        </div>


        <div class="sidebar-label">
            Management
        </div>


        <nav class="sidebar-nav">


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


            <a
                class="sidebar-link {{ request()->routeIs('households.*') ? 'active' : '' }}"
                href="{{ route('households.index') }}"
                data-sidebar-link
            >
                <span class="nav-icon">
                    ⌂
                </span>

                Households
            </a>


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

        </nav>


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


        @php

            if (request()->routeIs('dashboard')) {

                $pageTitle = 'Dashboard';
                $pageSubtitle = 'Barangay information overview';

            } elseif (request()->routeIs('households.index')) {

                $pageTitle = 'Households';
                $pageSubtitle = 'Manage registered household records';

            } elseif (request()->routeIs('households.create')) {

                $pageTitle = 'Add Household';
                $pageSubtitle = 'Register a new household';

            } elseif (request()->routeIs('households.edit')) {

                $pageTitle = 'Edit Household';
                $pageSubtitle = 'Update household information';

            } elseif (request()->routeIs('households.show')) {

                $pageTitle = 'Household Details';
                $pageSubtitle = 'View household information';

            } elseif (request()->routeIs('residents.*')) {

                $pageTitle = 'Residents';
                $pageSubtitle = 'Manage registered resident records';

            } else {

                $pageTitle = 'Barangay Information System';
                $pageSubtitle = 'Barangay administration';

            }

        @endphp


        <header class="top-header">


            <div class="top-header-left">


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


            <div class="top-header-right">


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


        <main class="page-content">

            @yield('content')

        </main>

    </div>

</div>

</body>

</html>