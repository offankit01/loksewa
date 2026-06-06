<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', $site_settings['site_description'] ?? 'LokSewa Tayari Platform - The best place to prepare for LokSewa exams.')">

    <title>@yield('title', $site_settings['site_name'] ?? config('app.name', 'LokSewa Tayari'))</title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif

    <style>
        /* Premium Dropdown Styling */
        .dropdown-menu-premium {
            min-width: 280px;
            padding: 1rem;
            border-radius: 1.25rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12) !important;
            border: 1px solid rgba(0, 0, 0, 0.05);
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            animation: dropdownFadeIn 0.3s ease-out;
        }

        @keyframes dropdownFadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .dropdown-item-premium {
            padding: 0.85rem 1rem;
            border-radius: 12px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--dark-text);
            font-weight: 500;
        }

        .dropdown-item-premium:hover {
            background-color: rgba(var(--primary-blue-rgb), 0.05);
            color: var(--primary-blue);
            transform: translateX(5px);
        }

        .dropdown-item-premium i {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 1.25rem;
            transition: all 0.2s ease;
        }

        .dropdown-item-premium:hover i {
            background-color: var(--primary-blue);
            color: white;
            transform: scale(1.1);
        }

        .item-desc {
            display: block;
            font-size: 0.75rem;
            color: var(--muted-text);
            font-weight: 400;
            margin-top: 2px;
        }

        .dropdown-header-premium {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--muted-text);
            padding: 0.5rem 1rem;
            margin-bottom: 0.5rem;
        }

        .navbar-custom .nav-link.active {
            color: var(--primary-blue) !important;
            font-weight: 700;
        }
    </style>
    @yield('extra_css')
</head>
<body class="@yield('body_class')">

    <!-- Navbar -->
    @if(!isset($hide_nav_footer) || !$hide_nav_footer)
    <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-custom py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
                <img src="/storage/logo1.png" alt="Lok Siksha" width="42" height="42" class="d-inline-block align-text-top rounded-circle shadow-sm">
                <span class="fw-extrabold fs-4 tracking-tight text-primary-blue">Lok <span class="text-accent-orange">Siksha</span></span>
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fw-medium">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('services') || Request::is('service/*') ? 'active' : '' }}" href="{{ route('services') }}" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Services
                        </a>
                        <ul class="dropdown-menu dropdown-menu-premium" aria-labelledby="servicesDropdown">
                             <li class="dropdown-header-premium">Academic Roadmap</li>
                             <li>
                                <a class="dropdown-item dropdown-item-premium" href="{{ route('services') }}">
                                    <i class="bi bi-map text-primary-blue bg-primary-blue bg-opacity-10"></i>
                                    <div>
                                        <span>All Services Roadmap</span>
                                        <span class="item-desc">Explore all career paths</span>
                                    </div>
                                </a>
                             </li>
                             <li><hr class="dropdown-divider mx-3"></li>
                             <li class="dropdown-header-premium">All Services</li>
                             <li>
                                <a class="dropdown-item dropdown-item-premium" href="{{ route('service.show', 'nepal-administrative-service') }}">
                                    <i class="bi bi-building text-accent-orange bg-accent-orange bg-opacity-10"></i>
                                    <div>
                                        <span>Administrative Service</span>
                                        <span class="item-desc">Nepal Administrative Service</span>
                                    </div>
                                </a>
                             </li>
                             <li>
                                <a class="dropdown-item dropdown-item-premium" href="{{ route('service.show', 'nepal-police-service') }}">
                                    <i class="bi bi-shield-check text-primary-blue bg-primary-blue bg-opacity-10"></i>
                                    <div>
                                        <span>Police Service</span>
                                        <span class="item-desc">Nepal Police Service</span>
                                    </div>
                                </a>
                             </li>
                             <li>
                                <a class="dropdown-item dropdown-item-premium" href="{{ route('service.show', 'nepal-army-service') }}">
                                    <i class="bi bi-star text-danger bg-danger bg-opacity-10"></i>
                                    <div>
                                        <span>Army Service</span>
                                        <span class="item-desc">Nepal Army Service</span>
                                    </div>
                                </a>
                             </li>
                             <li>
                                <a class="dropdown-item dropdown-item-premium" href="{{ route('service.show', 'nepal-judicial-service') }}">
                                    <i class="bi bi-bank text-info bg-info bg-opacity-10"></i>
                                    <div>
                                        <span>Judicial Service</span>
                                        <span class="item-desc">Nepal Judicial Service</span>
                                    </div>
                                </a>
                             </li>
                             <li>
                                <a class="dropdown-item dropdown-item-premium" href="{{ route('service.show', 'nepal-foreign-affairs-service') }}">
                                    <i class="bi bi-globe text-success bg-success bg-opacity-10"></i>
                                    <div>
                                        <span>Foreign Affairs Service</span>
                                        <span class="item-desc">Nepal Foreign Affairs Service</span>
                                    </div>
                                </a>
                             </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('blogs*') ? 'active' : '' }}" href="{{ route('blogs.index') }}">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact Us</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    @if (Route::has('login'))
                        @auth
                            <div class="d-flex align-items-center gap-3">
                                @if(Auth::user()->is_admin)
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary border-primary-blue text-primary-blue">Admin Panel</a>
                                @else
                                    <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary border-primary-blue text-primary-blue">Dashboard</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-primary-custom">
                                        <i class="bi bi-box-arrow-right me-1"></i> Log Out
                                    </button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-decoration-none text-dark fw-medium pe-2 hover-text-primary">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary-custom">Get Started</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>
    @endif

    <!-- Page Content -->
    <main>
        @if(session('success'))
            <div class="container mt-4">
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container mt-4">
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    @if(!isset($hide_nav_footer) || !$hide_nav_footer)
    <footer class="footer py-5 bg-dark text-white">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <a class="navbar-brand fw-bold text-white d-flex align-items-center mb-3 gap-2" href="{{ url('/') }}">
                        <img src="/storage/logo1.png" alt="Lok Siksha" style="height: 45px; width: auto; filter: brightness(0) invert(1);">
                        <span class="fs-2 fw-extrabold text-white tracking-tight">Lok Siksha</span>
                    </a>
                    <p class="text-white-50 small mb-4">{{ $site_settings['site_description'] ?? 'Empowering students across Nepal to achieve their dreams of serving the nation.' }}</p>
                    <div class="d-flex gap-3">
                        <a href="{{ $site_settings['facebook_url'] ?? '#' }}" class="text-white-50 hover-text-white transition fs-5"><i class="bi bi-facebook"></i></a>
                        <a href="{{ $site_settings['youtube_url'] ?? '#' }}" class="text-white-50 hover-text-white transition fs-5"><i class="bi bi-youtube"></i></a>
                        <a href="{{ $site_settings['instagram_url'] ?? '#' }}" class="text-white-50 hover-text-white transition fs-5"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold text-white mb-4">Platform</h6>
                    <ul class="list-unstyled text-white-50 small d-flex flex-column gap-2">
                        <li><a href="{{ route('pricing') }}" class="text-decoration-none text-white-50 hover-text-white">Pricing Plans</a></li>
                        <li><a href="#" class="text-decoration-none text-white-50 hover-text-white">Mock Tests</a></li>
                        <li><a href="#" class="text-decoration-none text-white-50 hover-text-white">Study Materials</a></li>
                        <li><a href="#" class="text-decoration-none text-white-50 hover-text-white">Current Affairs</a></li>
                        <li><a href="#" class="text-decoration-none text-white-50 hover-text-white">Syllabus</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold text-white mb-4">Company</h6>
                    <ul class="list-unstyled text-white-50 small d-flex flex-column gap-2">
                        <li><a href="#" class="text-decoration-none text-white-50 hover-text-white">About Us</a></li>
                        <li><a href="#" class="text-decoration-none text-white-50 hover-text-white">Contact</a></li>
                        <li><a href="#" class="text-decoration-none text-white-50 hover-text-white">Privacy Policy</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <h6 class="fw-bold text-white mb-4">Subscribe</h6>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control bg-dark border-secondary text-white" placeholder="Email">
                        <button class="btn btn-accent-custom" type="button">Join</button>
                    </div>
                </div>
            </div>
            <hr class="border-secondary mt-5 mb-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center text-white-50 small">
                <p class="mb-0">&copy; {{ date('Y') }} {{ $site_settings['site_name'] ?? 'Lok Siksha' }}. All rights reserved.</p>
                <p class="mb-0">Made with <i class="bi bi-heart-fill text-danger"></i> for aspirants.</p>
            </div>
        </div>
    </footer>
    @endif

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-custom');
            if (navbar) {
                if (window.scrollY > 50) {
                    navbar.classList.add('shadow-sm');
                    navbar.style.background = 'rgba(255, 255, 255, 0.98)';
                } else {
                    navbar.classList.remove('shadow-sm');
                    navbar.style.background = 'rgba(255, 255, 255, 0.9)';
                }
            }
        });
    </script>
    @yield('extra_js')
</body>
</html>
