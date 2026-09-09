<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Barangay Information System')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="app-body">

    <div class="app-shell">
        <button class="sidebar-backdrop" type="button" aria-label="Close navigation" data-sidebar-close></button>
        <aside class="app-sidebar" id="app-sidebar">
            <div class="sidebar-head">
                <a class="brand" href="{{ url('/') }}">
                <span class="brand-mark">BI</span>
                <span>
                    <strong>Barangay</strong>
                    <small>Information System</small>
                </span>
                </a>
                <button class="sidebar-close" type="button" aria-label="Close navigation" data-sidebar-close>&times;</button>
            </div>

            <div class="sidebar-label">Management</div>
            <nav class="sidebar-nav">
                <a class="sidebar-link {{ request()->routeIs('households.*') ? 'active' : '' }}" href="{{ route('households.index') }}" data-sidebar-link>
                    <span class="nav-icon">⌂</span>
                    Households
                </a>
                <a class="sidebar-link {{ request()->routeIs('residents.*') ? 'active' : '' }}" href="{{ route('residents.index') }}" data-sidebar-link>
                    <span class="nav-icon">◉</span>
                    Residents
                </a>
            </nav>

            <div class="sidebar-footer">
                <span class="status-dot"></span>
                <span>System online</span>
            </div>
        </aside>

        <div class="app-content">
            <header class="topbar">
                <div>
                    <button class="menu-button" type="button" aria-label="Open navigation" aria-controls="app-sidebar" aria-expanded="false" data-sidebar-open>
                        <span></span><span></span><span></span>
                    </button>
                    <span class="eyebrow">BARANGAY ADMINISTRATION</span>
                    <h1>@yield('page-heading', 'Resident records at a glance')</h1>
                </div>
                <div class="topbar-date">{{ now()->format('M d, Y') }}</div>
            </header>

            <main class="page-content">
                @yield('content')
            </main>

        </div>
    </div>

</body>

</html>