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
        :root {
            --sidebar-width: 280px;
            --sidebar-bg: #0f172a;
            --sidebar-hover: rgba(255, 255, 255, 0.05);
            --sidebar-active: rgba(249, 115, 22, 0.15);
            --accent-color: #f97316;
        }
        body { background-color: #f1f5f9; font-family: 'Inter', system-ui, sans-serif; }
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: var(--sidebar-bg);
            color: #94a3b8;
            padding: 0;
            box-shadow: 10px 0 30px rgba(0,0,0,0.05);
            z-index: 1030;
            border-right: 1px solid rgba(255,255,255,0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sidebar-brand {
            padding: 2rem 1.5rem;
            background: linear-gradient(to bottom, rgba(255,255,255,0.03), transparent);
            margin-bottom: 1rem;
        }
        .nav-section-label {
            padding: 1.5rem 1.75rem 0.75rem;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #475569;
        }
        .nav-link {
            color: #94a3b8;
            padding: 0.75rem 1.5rem;
            margin: 0.2rem 1rem;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            font-size: 0.9rem;
            border-radius: 12px;
            transition: all 0.2s ease;
            border: none;
        }
        .nav-link i { font-size: 1.1rem; transition: transform 0.2s; }
        .nav-link:hover {
            color: #f8fafc;
            background-color: var(--sidebar-hover);
            transform: translateX(4px);
        }
        .nav-link:hover i { transform: scale(1.1); }
        .nav-link.active {
            color: white;
            background-color: var(--sidebar-active);
            box-shadow: 0 4px 12px rgba(249, 115, 22, 0.1);
        }
        .nav-link.active i { color: var(--accent-color); }
        
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2.5rem;
            min-height: 100vh;
        }
        
        /* Dropdown custom styling */
        .submenu-container {
            margin: 0.2rem 1rem 0.2rem 2.5rem;
            border-left: 1px solid rgba(255,255,255,0.1);
        }
        .submenu-link {
            padding: 0.5rem 1.25rem;
            font-size: 0.85rem;
            color: #64748b;
            display: block;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .submenu-link:hover, .submenu-link.active {
            color: white;
            background: rgba(255,255,255,0.03);
        }
        
        .user-profile-mini {
            margin: 1.5rem;
            padding: 1rem;
            background: rgba(255,255,255,0.03);
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.05);
        }
    </style>
    @yield('extra_css')
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column">
        <div class="sidebar-brand">
            <h4 class="fw-bold d-flex align-items-center m-0 text-white">
                @if(isset($site_settings['site_logo']))
                    <img src="{{ asset('storage/' . $site_settings['site_logo']) }}" alt="Logo" style="height: 35px; filter: brightness(0) invert(1);" class="me-2">
                @else
                    <div class="bg-accent-orange p-2 rounded-3 me-3 shadow-sm">
                        <i class="bi bi-shield-lock-fill text-white fs-5"></i>
                    </div>
                @endif
                LokSewa <span class="text-accent-orange ms-1">Pro</span>
            </h4>
        </div>
        
        <div class="flex-grow-1 overflow-y-auto custom-scrollbar">
            <div class="nav-section-label">General</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i> User Management
                    </a>
                </li>
            </ul>

            <div class="nav-section-label">Academic Content</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('admin.tests.index') }}" class="nav-link {{ Request::is('admin/tests*') ? 'active' : '' }}">
                        <i class="bi bi-pencil-square"></i> Mock Exams
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.materials.index') }}" class="nav-link {{ Request::is('admin/materials*') ? 'active' : '' }}">
                        <i class="bi bi-journal-bookmark-fill"></i> Study Materials
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.courses.index') }}" class="nav-link {{ Request::is('admin/courses*') ? 'active' : '' }}">
                        <i class="bi bi-mortarboard-fill"></i> Programs & Courses
                    </a>
                </li>
            </ul>

            <div class="nav-section-label">Marketing & Site</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('admin.content.blogs') }}" class="nav-link {{ Request::is('admin/content/blogs*') ? 'active' : '' }}">
                        <i class="bi bi-megaphone-fill"></i> Announcements
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#contentSubmenu" class="nav-link dropdown-toggle" data-bs-toggle="collapse">
                        <i class="bi bi-window-stack"></i> Page Builder
                    </a>
                    <div class="collapse {{ Request::is('admin/content*') && !Request::is('admin/content/blogs*') ? 'show' : '' }}" id="contentSubmenu">
                        <div class="submenu-container">
                            <a href="{{ route('admin.content.testimonials') }}" class="submenu-link {{ Request::is('admin/content/testimonials*') ? 'active' : '' }}">
                                <i class="bi bi-dot me-1"></i> Testimonials
                            </a>
                            <a href="{{ route('admin.content.faqs') }}" class="submenu-link {{ Request::is('admin/content/faqs*') ? 'active' : '' }}">
                                <i class="bi bi-dot me-1"></i> FAQ List
                            </a>
                            <a href="{{ route('admin.content.plans') }}" class="submenu-link {{ Request::is('admin/content/plans*') ? 'active' : '' }}">
                                <i class="bi bi-dot me-1"></i> Membership Plans
                            </a>
                        </div>
                    </div>
                </li>
            </ul>

            <div class="nav-section-label">System</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('admin.settings.index') }}" class="nav-link {{ Request::is('admin/settings*') ? 'active' : '' }}">
                        <i class="bi bi-sliders2"></i> Global Settings
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="user-profile-mini">
            <div class="d-flex align-items-center gap-3">
                <div class="avatar bg-accent-orange text-white rounded-3 d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px;">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <h6 class="text-white mb-0 small text-truncate">{{ Auth::user()->name }}</h6>
                    <p class="text-muted extra-small mb-0">System Admin</p>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="ms-auto">
                    @csrf
                    <button type="submit" class="btn btn-link text-muted p-0 border-0">
                        <i class="bi bi-power fs-5"></i>
                    </button>
                </form>
            </div>
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
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ url('/') }}">Back to Site</a></li>
                    </ul>
                </div>
            </div>
        </header>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('admin_content')
    </div>

    <!-- Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @endif
    @yield('extra_js')
</body>
</html>
