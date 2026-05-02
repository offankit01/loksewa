<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') - LokSewa Tayari</title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif

    <style>
        :root {
            --sidebar-width: 280px;
            --top-nav-height: 70px;
        }
        
        body {
            background-color: #f4f7fe;
            overflow-x: hidden;
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: white;
            border-right: 1px solid rgba(0,0,0,0.05);
            z-index: 1030;
            transition: all 0.3s ease;
        }

        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .top-navbar {
            height: var(--top-nav-height);
            background: white;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: var(--muted-text);
            text-decoration: none;
            font-weight: 500;
            border-radius: 12px;
            margin: 4px 16px;
            transition: all 0.2s;
        }

        .sidebar-link:hover {
            background: rgba(30, 58, 138, 0.05);
            color: var(--primary-blue);
        }

        .sidebar-link.active {
            background: var(--primary-blue);
            color: white;
            box-shadow: 0 4px 12px rgba(30, 58, 138, 0.2);
        }

        .sidebar-brand {
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            font-size: 1.25rem;
            color: var(--primary-blue);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            margin-bottom: 24px;
        }

        @media (max-width: 991px) {
            .sidebar {
                left: calc(-1 * var(--sidebar-width));
            }
            .sidebar.show {
                left: 0;
            }
            .main-wrapper {
                margin-left: 0;
            }
        }

        .content-area {
            padding: 2rem;
        }
    </style>
    @yield('extra_css')
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar shadow-sm" id="sidebar">
        <a href="{{ url('/') }}" class="text-decoration-none">
            <div class="sidebar-brand">
                <i class="bi bi-journal-bookmark-fill text-accent-orange"></i>
                <span>LokSewa Portal</span>
            </div>
        </a>
        
        <div class="sidebar-menu">
            <a href="{{ url('/') }}" class="sidebar-link">
                <i class="bi bi-house-door"></i> Back to Home
            </a>
            <hr class="mx-4 opacity-10">
            <a href="{{ url('/dashboard') }}" class="sidebar-link {{ Request::is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>
            <a href="{{ route('mock-tests') }}" class="sidebar-link {{ Request::is('mock-tests*') ? 'active' : '' }}">
                <i class="bi bi-laptop"></i> My Mock Tests
            </a>
            <a href="{{ route('study-library') }}" class="sidebar-link {{ Request::is('study-library*') ? 'active' : '' }}">
                <i class="bi bi-book"></i> Study Library
            </a>
            <a href="{{ route('performance') }}" class="sidebar-link {{ Request::is('performance*') ? 'active' : '' }}">
                <i class="bi bi-graph-up"></i> Performance
            </a>
            <a href="{{ route('upgrade-plan') }}" class="sidebar-link {{ Request::is('upgrade-plan*') ? 'active' : '' }}">
                <i class="bi bi-star"></i> Upgrade Plan
            </a>
            <hr class="mx-4 opacity-10">
            <a href="{{ route('profile.edit') }}" class="sidebar-link {{ Request::is('profile*') ? 'active' : '' }}">
                <i class="bi bi-person"></i> My Profile
            </a>
            <a href="{{ route('settings') }}" class="sidebar-link {{ Request::is('settings*') ? 'active' : '' }}">
                <i class="bi bi-gear"></i> Settings
            </a>
            
            <div class="mt-auto pt-5 pb-4 px-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-light text-danger w-100 d-flex align-items-center justify-content-center gap-2 rounded-3 border-0">
                        <i class="bi bi-box-arrow-right"></i> Log Out
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Top Navbar -->
        <header class="top-navbar shadow-sm d-flex justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <button class="btn d-lg-none p-0 text-muted" type="button" id="sidebarToggle">
                    <i class="bi bi-list fs-2"></i>
                </button>
                <h5 class="fw-bold mb-0 d-none d-md-block">Welcome back, {{ explode(' ', Auth::user()->name)[0] }}!</h5>
            </div>
            
            <div class="d-flex align-items-center gap-4">
                <div class="d-none d-md-flex align-items-center gap-3 pe-4 border-end">
                    <div class="text-end">
                        <div class="fw-bold small lh-1">{{ Auth::user()->name }}</div>
                        <div class="text-muted small">Standard Plan</div>
                    </div>
                    <div class="bg-primary-blue text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px;">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
                <button class="btn btn-light position-relative p-2 rounded-circle border-0">
                    <i class="bi bi-bell fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="padding: 3px 6px; font-size: 0.6rem;">
                        3
                    </span>
                </button>
            </div>
        </header>

        <!-- Content Area -->
        <main class="content-area">
            @yield('dashboard_content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });
    </script>
</body>
</html>
