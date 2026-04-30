<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'LokSewa Tayari Platform - The best place to prepare for LokSewa exams.')">

    <title>@yield('title', config('app.name', 'LokSewa Tayari'))</title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif

    @yield('extra_css')
</head>
<body class="@yield('body_class')">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-custom py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary-blue d-flex align-items-center" href="{{ url('/') }}">
                <i class="bi bi-journal-bookmark-fill me-2 fs-3 text-accent-orange"></i>
                LokSewa Tayari
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
                        <a class="nav-link dropdown-toggle {{ Request::is('services') || Request::is('service/*') ? 'active' : '' }}" href="{{ route('services') }}">
                            Services
                        </a>
                        <!-- Submenu logic simplified for layout -->
                        <ul class="dropdown-menu shadow-sm border-0 mt-2">
                             <li><a class="dropdown-item" href="{{ route('services') }}">All Services Roadmap</a></li>
                             <li><hr class="dropdown-divider"></li>
                             <li><a class="dropdown-item" href="{{ route('service.show', 'kharidar') }}">Kharidar</a></li>
                             <li><a class="dropdown-item" href="{{ route('service.show', 'nayab-subba') }}">Nayab Subba</a></li>
                             <li><a class="dropdown-item" href="{{ route('service.show', 'section-officer') }}">Section Officer</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/#mock-tests') }}">Mock Tests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/#features') }}">Features</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary-custom">Dashboard</a>
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

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer py-5 bg-dark text-white">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <a class="navbar-brand fw-bold text-white d-flex align-items-center mb-3" href="#">
                        <i class="bi bi-journal-bookmark-fill me-2 fs-3 text-accent-orange"></i>
                        LokSewa Tayari
                    </a>
                    <p class="text-white-50 small mb-4">Empowering students across Nepal to achieve their dreams of serving the nation. Quality preparation, accessible to all.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white-50 hover-text-white transition fs-5"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white-50 hover-text-white transition fs-5"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="text-white-50 hover-text-white transition fs-5"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white-50 hover-text-white transition fs-5"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold text-white mb-4">Platform</h6>
                    <ul class="list-unstyled text-white-50 small d-flex flex-column gap-2">
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
                <p class="mb-0">&copy; {{ date('Y') }} LokSewa Tayari Platform. All rights reserved.</p>
                <p class="mb-0">Made with <i class="bi bi-heart-fill text-danger"></i> for aspirants.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"></script>
    
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
