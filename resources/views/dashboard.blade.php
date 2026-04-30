<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LokSewa Tayari') }} - Student Dashboard</title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif

    <style>
        body {
            background-color: var(--light-bg);
            padding-top: 76px; /* Space for fixed navbar */
        }
        .navbar-custom {
            background: white;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .dashboard-card {
            background: white;
            border-radius: 1rem;
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
            transition: transform 0.2s;
            height: 100%;
        }
        .dashboard-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px rgba(0,0,0,0.05);
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }
        .progress-thin {
            height: 6px;
            border-radius: 3px;
        }
        .badge-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            background: linear-gradient(135deg, #ffd700, #ff8c00);
            color: white;
            box-shadow: 0 4px 6px rgba(255, 140, 0, 0.2);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-custom py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary-blue d-flex align-items-center" href="{{ url('/dashboard') }}">
                <i class="bi bi-journal-bookmark-fill me-2 fs-4 text-accent-orange"></i>
                LokSewa Portal
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-medium align-items-center gap-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Mock Tests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Study Materials</a>
                    </li>
                    <li class="nav-item d-none d-lg-block">
                        <div class="vr bg-secondary opacity-25" style="width: 2px; height: 24px;"></div>
                    </li>
                    <li class="nav-item d-flex align-items-center ms-lg-3 mt-3 mt-lg-0">
                        <div class="d-flex align-items-center gap-2 me-3">
                            <div class="bg-primary-blue text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px; font-size: 0.8rem;">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="d-none d-lg-inline">{{ Auth::user()->name }}</span>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-2">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-4 py-lg-5">
        
        <!-- Welcome Section -->
        <div class="row mb-4 align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold mb-1">Welcome back, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h2>
                <p class="text-muted mb-0">Ready to crush your next LokSewa exam?</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <button class="btn btn-primary-custom d-inline-flex align-items-center gap-2 shadow-sm">
                    <i class="bi bi-play-fill"></i> Start Quick Test
                </button>
            </div>
        </div>

        <!-- Gamification & Stats Row -->
        <div class="row g-4 mb-5">
            <!-- Streak Card -->
            <div class="col-md-4">
                <div class="dashboard-card p-4">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div>
                            <h6 class="text-muted text-uppercase fw-semibold small mb-1">Current Streak</h6>
                            <h3 class="fw-bold mb-0">12 Days</h3>
                        </div>
                        <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                            <i class="bi bi-fire"></i>
                        </div>
                    </div>
                    <div class="progress progress-thin bg-light">
                        <div class="progress-bar bg-danger" style="width: 80%"></div>
                    </div>
                    <p class="small text-muted mt-2 mb-0">2 days away from new record!</p>
                </div>
            </div>

            <!-- Badges Card -->
            <div class="col-md-4">
                <div class="dashboard-card p-4">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div>
                            <h6 class="text-muted text-uppercase fw-semibold small mb-1">Earned Badges</h6>
                            <h3 class="fw-bold mb-0">4 Badges</h3>
                        </div>
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-award"></i>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <div class="badge-icon" title="Early Bird"><i class="bi bi-brightness-alt-high"></i></div>
                        <div class="badge-icon" title="7-Day Streak"><i class="bi bi-calendar2-check"></i></div>
                        <div class="badge-icon" title="First Perfect Score"><i class="bi bi-star-fill"></i></div>
                        <div class="badge-icon" style="background: #e9ecef; color: #adb5bd;" title="Locked"><i class="bi bi-lock-fill"></i></div>
                    </div>
                </div>
            </div>

            <!-- Performance Card -->
            <div class="col-md-4">
                <div class="dashboard-card p-4">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div>
                            <h6 class="text-muted text-uppercase fw-semibold small mb-1">Average Score</h6>
                            <h3 class="fw-bold mb-0">78%</h3>
                        </div>
                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                    </div>
                    <div class="progress progress-thin bg-light">
                        <div class="progress-bar bg-success" style="width: 78%"></div>
                    </div>
                    <p class="small text-success mt-2 mb-0"><i class="bi bi-arrow-up-short"></i> +5% from last week</p>
                </div>
            </div>
        </div>

        <!-- Main Action Area -->
        <div class="row g-4 mb-5">
            <div class="col-lg-8">
                <h5 class="fw-bold mb-3">Your Study Path</h5>
                <div class="dashboard-card p-0 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-5 bg-primary-blue text-white p-4 p-lg-5 d-flex flex-column justify-content-center position-relative">
                            <div class="position-absolute top-0 end-0 opacity-25 w-100 h-100" style="background: radial-gradient(circle at top left, rgba(249,115,22,0.8), transparent 70%);"></div>
                            <div class="position-relative z-1">
                                <span class="badge bg-white text-primary-blue mb-3">Next Up</span>
                                <h4 class="fw-bold mb-2">Section Officer - GK</h4>
                                <p class="text-white-50 small mb-4">Topic: Nepal History & Geography</p>
                                <button class="btn btn-accent-custom w-100">Resume Learning</button>
                            </div>
                        </div>
                        <div class="col-md-7 p-4 p-lg-5 d-flex flex-column justify-content-center">
                            <h6 class="fw-bold mb-4">Syllabus Progress</h6>
                            
                            <div class="mb-3">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span class="text-dark fw-medium">General Knowledge</span>
                                    <span class="text-muted">60%</span>
                                </div>
                                <div class="progress progress-thin bg-light">
                                    <div class="progress-bar bg-primary-blue" style="width: 60%"></div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span class="text-dark fw-medium">IQ / Aptitude</span>
                                    <span class="text-muted">35%</span>
                                </div>
                                <div class="progress progress-thin bg-light">
                                    <div class="progress-bar bg-primary-blue" style="width: 35%"></div>
                                </div>
                            </div>
                            
                            <div>
                                <div class="d-flex justify-content-between small mb-1">
                                    <span class="text-dark fw-medium">English Language</span>
                                    <span class="text-muted">85%</span>
                                </div>
                                <div class="progress progress-thin bg-light">
                                    <div class="progress-bar bg-success" style="width: 85%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <h5 class="fw-bold mb-3">Recent Activity</h5>
                <div class="dashboard-card p-4">
                    <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom border-light-subtle">
                        <div class="bg-success bg-opacity-10 text-success rounded-circle p-2">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold fs-6">Mock Test: Kharidar Level</h6>
                            <p class="text-muted small mb-0">Scored 42/50 • Yesterday</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom border-light-subtle">
                        <div class="bg-primary-blue bg-opacity-10 text-primary-blue rounded-circle p-2">
                            <i class="bi bi-book-fill"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold fs-6">Read Note: Constitution</h6>
                            <p class="text-muted small mb-0">Completed • 2 days ago</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-2">
                            <i class="bi bi-x-circle-fill"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold fs-6">Mock Test: IQ Practice</h6>
                            <p class="text-muted small mb-0">Scored 20/50 • 3 days ago</p>
                        </div>
                    </div>
                    
                    <div class="mt-4 text-center">
                        <a href="#" class="text-primary-blue text-decoration-none fw-medium small">View All Activity <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
