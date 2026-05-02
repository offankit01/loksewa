<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') - LokSewa Tayari</title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif

    <style>
        body { background-color: #f8fafc; }
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #1e3a8a;
            color: white;
            padding-top: 1.5rem;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            z-index: 1030;
        }
        .main-content {
            margin-left: 260px;
            padding: 2rem;
            min-height: 100vh;
        }
        .nav-link {
            color: rgba(255, 255, 255, 0.7);
            padding: 0.85rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 4px solid transparent;
        }
        .nav-link:hover, .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.08);
            border-left-color: #f97316;
        }
        .sidebar-brand {
            padding: 0 1.5rem 2rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 1.5rem;
        }
        .card-custom {
            background: white;
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .badge-soft-success { background: rgba(16, 185, 129, 0.1); color: #10b981; }
        .badge-soft-warning { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
        .badge-soft-primary { background: rgba(30, 58, 138, 0.1); color: #1e3a8a; }
    </style>
    @yield('extra_css')
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column">
        <div class="sidebar-brand">
            <h5 class="fw-bold d-flex align-items-center m-0">
                <i class="bi bi-shield-lock-fill me-2 text-accent-orange"></i>
                Admin Panel
            </h5>
        </div>
        
        <ul class="nav flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-people"></i> Manage Users
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-journal-text"></i> Mock Tests
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.materials.index') }}" class="nav-link {{ Request::is('admin/materials*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-pdf"></i> Study Materials
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.courses.index') }}" class="nav-link {{ Request::is('admin/courses*') ? 'active' : '' }}">
                    <i class="bi bi-briefcase"></i> Services / Courses
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.content.blogs') }}" class="nav-link {{ Request::is('admin/content/blogs*') ? 'active' : '' }}">
                    <i class="bi bi-newspaper"></i> Blog Posts
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#contentSubmenu">
                    <i class="bi bi-window-sidebar"></i> Site Content
                </a>
                <div class="collapse {{ Request::is('admin/content*') && !Request::is('admin/content/blogs*') ? 'show' : '' }} bg-black bg-opacity-10" id="contentSubmenu">
                    <a href="{{ route('admin.content.testimonials') }}" class="nav-link ps-5 small py-2 {{ Request::is('admin/content/testimonials*') ? 'active' : '' }}">Testimonials</a>
                    <a href="{{ route('admin.content.faqs') }}" class="nav-link ps-5 small py-2 {{ Request::is('admin/content/faqs*') ? 'active' : '' }}">FAQs</a>
                    <a href="#" class="nav-link ps-5 small py-2">Pricing Plans</a>
                </div>
            </li>
            <li class="nav-item mt-3">
                <a href="#" class="nav-link">
                    <i class="bi bi-gear"></i> Settings
                </a>
            </li>
        </ul>
        
        <div class="p-4 mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100 d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item small"><a href="#" class="text-decoration-none">Admin</a></li>
                        @yield('breadcrumb')
                    </ol>
                </nav>
                <h2 class="fw-bold mb-0 text-dark">@yield('page_title', 'Dashboard Overview')</h2>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="dropdown">
                    <button class="btn btn-white bg-white shadow-sm dropdown-toggle rounded-pill px-4" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-1"></i> Admin
                    </button>
                    <ul class="dropdown-menu border-0 shadow-sm">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ url('/') }}">Back to Site</a></li>
                    </ul>
                </div>
            </div>
        </header>

        @yield('admin_content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"></script>
    @yield('extra_js')
</body>
</html>
