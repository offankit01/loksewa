<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LokSewa Tayari') }} - {{ $title }}</title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif

    <style>
        body {
            background-color: var(--light-bg);
            padding-top: 76px;
        }
        .navbar-custom {
            background: white;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .service-header {
            background: linear-gradient(135deg, var(--primary-blue), #152c6e);
            color: white;
            padding: 5rem 0;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }
        .header-content {
            position: relative;
            z-index: 1;
        }
        .header-bg-shape {
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(249, 115, 22, 0.1);
            border-radius: 50%;
            filter: blur(60px);
            top: -100px;
            right: -50px;
        }
        .action-card {
            background: white;
            border: 1px solid rgba(0,0,0,0.05);
            border-radius: 1.25rem;
            padding: 2.5rem 2rem;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--dark-text);
        }
        .action-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.08);
            border-color: var(--accent-orange);
            color: var(--primary-blue);
        }
        .action-icon {
            width: 70px;
            height: 70px;
            background: rgba(30, 58, 138, 0.05);
            color: var(--primary-blue);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }
        .action-card:hover .action-icon {
            background: var(--accent-orange);
            color: white;
        }
        .action-title {
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
        }
        .action-desc {
            font-size: 0.9rem;
            color: var(--muted-text);
            margin-bottom: 0;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-custom py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary-blue d-flex align-items-center" href="{{ url('/') }}">
                <i class="bi bi-journal-bookmark-fill me-2 fs-3 text-accent-orange"></i>
                LokSewa Tayari
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fw-medium">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('services') }}">Services</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ url('/services') }}" class="btn btn-outline-secondary rounded-pill px-4 me-2">
                        <i class="bi bi-arrow-left me-1"></i> Back to Roadmap
                    </a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary-custom">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary-custom">Log In</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <div class="service-header">
        <div class="header-bg-shape"></div>
        <div class="container header-content text-center">
            <span class="badge bg-accent-orange px-3 py-2 rounded-pill mb-3 fw-bold">SERVICE DETAIL</span>
            <h1 class="display-4 fw-bold mb-0">{{ $title }}</h1>
            <p class="lead text-white-50 mt-3">Access all preparation materials and tools for the {{ $title }} exam.</p>
        </div>
    </div>

    <!-- Actions Grid -->
    <div class="container mb-5">
        <div class="row g-4">
            
            <!-- Notes -->
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('service.notes', $slug) }}" class="action-card">
                    <div class="action-icon">
                        <i class="bi bi-journal-text"></i>
                    </div>
                    <h5 class="action-title">Study Notes</h5>
                    <p class="action-desc">Comprehensive notes and chapters curated by experts.</p>
                </a>
            </div>

            <!-- Question Papers -->
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('service.questions', $slug) }}" class="action-card">
                    <div class="action-icon">
                        <i class="bi bi-file-earmark-pdf"></i>
                    </div>
                    <h5 class="action-title">Question Bank</h5>
                    <p class="action-desc">Previous year papers and model questions with solutions.</p>
                </a>
            </div>

            <!-- Syllabus -->
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('service.syllabus', $slug) }}" class="action-card">
                    <div class="action-icon">
                        <i class="bi bi-list-check"></i>
                    </div>
                    <h5 class="action-title">Exam Syllabus</h5>
                    <p class="action-desc">Detailed syllabus breakdown for all levels of examination.</p>
                </a>
            </div>

            <!-- Mock Test -->
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('service.mock-tests', $slug) }}" class="action-card">
                    <div class="action-icon">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <h5 class="action-title">Mock Tests</h5>
                    <p class="action-desc">Take a simulated exam and get instant score analysis.</p>
                </a>
            </div>

        </div>

        <!-- Secondary Actions -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 bg-white p-4 p-md-5 text-center">
                    <h4 class="fw-bold mb-3">Ready to start your journey?</h4>
                    <p class="text-muted mb-4 mx-auto" style="max-width: 600px;">Get personalized progress tracking, earn badges, and join thousands of other aspirants preparing for the {{ $title }} exam.</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('register') }}" class="btn btn-accent-custom btn-lg px-5">Join the Platform</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0 text-white-50 small">&copy; {{ date('Y') }} LokSewa Tayari Platform. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
