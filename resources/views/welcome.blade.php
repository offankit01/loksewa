<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="LokSewa Tayari Platform - The best place to prepare for LokSewa exams with bilingual support, mock tests, and gamified learning.">

    <title>{{ config('app.name', 'LokSewa Tayari') }} - Home</title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-custom py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary-blue d-flex align-items-center" href="{{ url('/') }}">
                <i class="bi bi-journal-bookmark-fill me-2 fs-3 text-accent-orange"></i>
                LokSewa Tayari
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fw-medium">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ route('services') }}">
                            Services
                        </a>
                        <ul class="dropdown-menu shadow-sm border-0 mt-2">
                            <!-- 1. Administrative -->
                            <li>
                                <a class="dropdown-item py-2 dropdown-toggle" href="#">Nepal Administrative Service</a>
                                <ul class="dropdown-menu dropdown-submenu">
                                    <li><h6 class="dropdown-header">NON-GAZETTED</h6></li>
                                    <li><a class="dropdown-item" href="{{ route('service.show', 'kharidar') }}">Kharidar</a></li>
                                    <li><a class="dropdown-item" href="{{ route('service.show', 'nayab-subba') }}">Nayab Subba</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><h6 class="dropdown-header">GAZETTED</h6></li>
                                    <li><a class="dropdown-item" href="{{ route('service.show', 'section-officer') }}">Section Officer</a></li>
                                    <li><a class="dropdown-item" href="#">Under Secretary</a></li>
                                    <li><a class="dropdown-item" href="#">Joint Secretary</a></li>
                                    <li><a class="dropdown-item" href="#">Secretary</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><h6 class="dropdown-header">SPECIAL CLASS</h6></li>
                                    <li><a class="dropdown-item" href="#">Chief Secretary</a></li>
                                </ul>
                            </li>
                            
                            <!-- 2. Police -->
                            <li>
                                <a class="dropdown-item py-2 dropdown-toggle" href="#">Nepal Police Service</a>
                                <ul class="dropdown-menu dropdown-submenu">
                                    <li><a class="dropdown-item" href="#">Constable</a></li>
                                    <li><a class="dropdown-item" href="#">Head Constable</a></li>
                                    <li><a class="dropdown-item" href="#">Assistant Sub Inspector (ASI)</a></li>
                                    <li><a class="dropdown-item" href="#">Sub Inspector (SI)</a></li>
                                    <li><a class="dropdown-item" href="#">Inspector</a></li>
                                    <li><a class="dropdown-item" href="#">Deputy Superintendent (DSP)</a></li>
                                    <li><a class="dropdown-item" href="#">Superintendent (SP)</a></li>
                                    <li><a class="dropdown-item" href="#">Senior Superintendent (SSP)</a></li>
                                    <li><a class="dropdown-item" href="#">Deputy Inspector General (DIG)</a></li>
                                    <li><a class="dropdown-item" href="#">Additional Inspector General (AIG)</a></li>
                                    <li><a class="dropdown-item" href="#">Inspector General (IGP)</a></li>
                                </ul>
                            </li>

                            <!-- 3. Army -->
                            <li>
                                <a class="dropdown-item py-2 dropdown-toggle" href="#">Nepal Army Service</a>
                                <ul class="dropdown-menu dropdown-submenu">
                                    <li><a class="dropdown-item" href="#">Sainik (Soldier)</a></li>
                                    <li><a class="dropdown-item" href="#">Lance Corporal</a></li>
                                    <li><a class="dropdown-item" href="#">Corporal</a></li>
                                    <li><a class="dropdown-item" href="#">Sergeant</a></li>
                                    <li><a class="dropdown-item" href="#">Warrant Officer</a></li>
                                    <li><a class="dropdown-item" href="#">Second Lieutenant</a></li>
                                    <li><a class="dropdown-item" href="#">Lieutenant</a></li>
                                    <li><a class="dropdown-item" href="#">Captain</a></li>
                                    <li><a class="dropdown-item" href="#">Major</a></li>
                                    <li><a class="dropdown-item" href="#">Lieutenant Colonel</a></li>
                                    <li><a class="dropdown-item" href="#">Colonel</a></li>
                                    <li><a class="dropdown-item" href="#">Brigadier General</a></li>
                                    <li><a class="dropdown-item" href="#">Major General</a></li>
                                    <li><a class="dropdown-item" href="#">General</a></li>
                                </ul>
                            </li>

                            <!-- 4. Judicial -->
                            <li>
                                <a class="dropdown-item py-2 dropdown-toggle" href="#">Nepal Judicial Service</a>
                                <ul class="dropdown-menu dropdown-submenu">
                                    <li><h6 class="dropdown-header">NON-GAZETTED</h6></li>
                                    <li><a class="dropdown-item" href="{{ route('service.show', 'kharidar') }}">Kharidar</a></li>
                                    <li><a class="dropdown-item" href="{{ route('service.show', 'nayab-subba') }}">Nayab Subba</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><h6 class="dropdown-header">GAZETTED</h6></li>
                                    <li><a class="dropdown-item" href="{{ route('service.show', 'section-officer') }}">Section Officer</a></li>
                                    <li><a class="dropdown-item" href="#">Under Secretary</a></li>
                                    <li><a class="dropdown-item" href="#">Joint Secretary</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><h6 class="dropdown-header">JUDICIAL OFFICERS</h6></li>
                                    <li><a class="dropdown-item" href="#">Judge</a></li>
                                    <li><a class="dropdown-item" href="#">District Judge</a></li>
                                    <li><a class="dropdown-item" href="#">High Court Judge</a></li>
                                    <li><a class="dropdown-item" href="#">Supreme Court Judge</a></li>
                                </ul>
                            </li>

                            <!-- 5. Foreign Affairs -->
                            <li>
                                <a class="dropdown-item py-2 dropdown-toggle" href="#">Nepal Foreign Affairs Service</a>
                                <ul class="dropdown-menu dropdown-submenu">
                                    <li><a class="dropdown-item" href="{{ route('service.show', 'section-officer') }}">Section Officer</a></li>
                                    <li><a class="dropdown-item" href="#">Under Secretary</a></li>
                                    <li><a class="dropdown-item" href="#">Joint Secretary</a></li>
                                    <li><a class="dropdown-item" href="#">Ambassador</a></li>
                                    <li><a class="dropdown-item" href="#">Foreign Secretary</a></li>
                                </ul>
                            </li>

                            <!-- 6. Audit -->
                            <li>
                                <a class="dropdown-item py-2 dropdown-toggle" href="#">Nepal Audit Service</a>
                                <ul class="dropdown-menu dropdown-submenu">
                                    <li><h6 class="dropdown-header">NON-GAZETTED</h6></li>
                                    <li><a class="dropdown-item" href="{{ route('service.show', 'kharidar') }}">Kharidar</a></li>
                                    <li><a class="dropdown-item" href="{{ route('service.show', 'nayab-subba') }}">Nayab Subba</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><h6 class="dropdown-header">GAZETTED</h6></li>
                                    <li><a class="dropdown-item" href="{{ route('service.show', 'section-officer') }}">Section Officer</a></li>
                                    <li><a class="dropdown-item" href="#">Under Secretary</a></li>
                                    <li><a class="dropdown-item" href="#">Auditor General</a></li>
                                </ul>
                            </li>

                            <!-- 7. Parliamentary -->
                            <li>
                                <a class="dropdown-item py-2 dropdown-toggle" href="#">Nepal Parliamentary Service</a>
                                <ul class="dropdown-menu dropdown-submenu">
                                    <li><h6 class="dropdown-header">NON-GAZETTED</h6></li>
                                    <li><a class="dropdown-item" href="{{ route('service.show', 'kharidar') }}">Kharidar</a></li>
                                    <li><a class="dropdown-item" href="{{ route('service.show', 'nayab-subba') }}">Nayab Subba</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><h6 class="dropdown-header">GAZETTED</h6></li>
                                    <li><a class="dropdown-item" href="{{ route('service.show', 'section-officer') }}">Section Officer</a></li>
                                    <li><a class="dropdown-item" href="#">Under Secretary</a></li>
                                    <li><a class="dropdown-item" href="#">Secretary General</a></li>
                                </ul>
                            </li>

                            <!-- 8. Technical -->
                            <li>
                                <a class="dropdown-item py-2 dropdown-toggle" href="#">Technical Services</a>
                                <ul class="dropdown-menu dropdown-submenu">
                                    <li><h6 class="dropdown-header">ENGINEERING</h6></li>
                                    <li><a class="dropdown-item" href="#">Sub Engineer</a></li>
                                    <li><a class="dropdown-item" href="#">Engineer</a></li>
                                    <li><a class="dropdown-item" href="#">Senior Engineer</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><h6 class="dropdown-header">AGRICULTURE</h6></li>
                                    <li><a class="dropdown-item" href="#">Junior Technical Assistant</a></li>
                                    <li><a class="dropdown-item" href="#">Technical Assistant</a></li>
                                    <li><a class="dropdown-item" href="#">Agriculture Officer</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><h6 class="dropdown-header">FOREST</h6></li>
                                    <li><a class="dropdown-item" href="#">Forest Guard</a></li>
                                    <li><a class="dropdown-item" href="#">Forest Ranger</a></li>
                                    <li><a class="dropdown-item" href="#">Forest Officer</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><h6 class="dropdown-header">HEALTH</h6></li>
                                    <li><a class="dropdown-item" href="#">Health Assistant</a></li>
                                    <li><a class="dropdown-item" href="#">Staff Nurse</a></li>
                                    <li><a class="dropdown-item" href="#">Lab Technician</a></li>
                                    <li><a class="dropdown-item" href="#">Health Officer</a></li>
                                    <li><a class="dropdown-item" href="#">Doctor/Medical Officer</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><h6 class="dropdown-header">EDUCATION</h6></li>
                                    <li><a class="dropdown-item" href="#">Primary Teacher</a></li>
                                    <li><a class="dropdown-item" href="#">Lower Secondary Teacher</a></li>
                                    <li><a class="dropdown-item" href="#">Secondary Teacher</a></li>
                                    <li><a class="dropdown-item" href="#">Education Officer</a></li>
                                </ul>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <!-- 9. Provincial -->
                            <li>
                                <a class="dropdown-item py-2 dropdown-toggle" href="#">Provincial Services</a>
                                <ul class="dropdown-menu dropdown-submenu">
                                    <li><a class="dropdown-item" href="#">Province No. 1 (Koshi)</a></li>
                                    <li><a class="dropdown-item" href="#">Province No. 2 (Madhesh)</a></li>
                                    <li><a class="dropdown-item" href="#">Bagmati Province</a></li>
                                    <li><a class="dropdown-item" href="#">Gandaki Province</a></li>
                                    <li><a class="dropdown-item" href="#">Lumbini Province</a></li>
                                    <li><a class="dropdown-item" href="#">Karnali Province</a></li>
                                    <li><a class="dropdown-item" href="#">Sudurpashchim Province</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#mock-tests">Mock Tests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle rounded-pill px-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-globe me-1"></i> EN / NE
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                            <li><a class="dropdown-item" href="#">English</a></li>
                            <li><a class="dropdown-item" href="#">नेपाली</a></li>
                        </ul>
                    </div>
                    
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

    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center min-vh-100">
        <div class="hero-shape hero-shape-1"></div>
        <div class="hero-shape hero-shape-2"></div>
        
        <div class="container position-relative z-1">
            <div class="row align-items-center g-5 pt-5 mt-5">
                <div class="col-lg-6 text-center text-lg-start">
                    <span class="badge bg-primary-blue bg-opacity-10 text-primary-blue px-3 py-2 rounded-pill mb-3 fw-medium">
                        <i class="bi bi-stars me-1"></i> The #1 Platform for LokSewa Preparation
                    </span>
                    <h1 class="display-4 fw-bold mb-4 lh-sm">
                        Ace Your LokSewa Exams with <span class="text-accent-orange">Confidence</span>
                    </h1>
                    <p class="lead text-muted mb-5 pe-lg-5">
                        Prepare effectively with our comprehensive bilingual study materials, real-time mock tests, and smart progress tracking. Start your journey towards a successful career today.
                    </p>
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start">
                        <a href="{{ route('register') ?? '#' }}" class="btn btn-accent-custom btn-lg d-flex align-items-center justify-content-center">
                            Start Learning Now <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                        <a href="#features" class="btn btn-outline-secondary btn-lg bg-white">
                            Explore Features
                        </a>
                    </div>
                    
                    <div class="mt-5 d-flex align-items-center justify-content-center justify-content-lg-start gap-4">
                        <div class="d-flex align-items-center gap-2">
                            <h3 class="fw-bold mb-0">10k+</h3>
                            <span class="text-muted small lh-sm">Active<br>Students</span>
                        </div>
                        <div class="vr bg-secondary opacity-25" style="width: 2px;"></div>
                        <div class="d-flex align-items-center gap-2">
                            <h3 class="fw-bold mb-0">500+</h3>
                            <span class="text-muted small lh-sm">Mock<br>Tests</span>
                        </div>
                        <div class="vr bg-secondary opacity-25" style="width: 2px;"></div>
                        <div class="d-flex align-items-center gap-2">
                            <div class="d-flex text-warning">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                            <span class="text-muted small ms-1">4.8/5 Rating</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 d-none d-lg-block position-relative">
                    <!-- Dashboard Mockup -->
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden transform" style="rotate: 2deg;">
                        <div class="card-header bg-light border-bottom border-light-subtle py-2 d-flex gap-2">
                            <div class="rounded-circle bg-danger" style="width: 10px; height: 10px;"></div>
                            <div class="rounded-circle bg-warning" style="width: 10px; height: 10px;"></div>
                            <div class="rounded-circle bg-success" style="width: 10px; height: 10px;"></div>
                        </div>
                        <div class="card-body p-4 bg-white">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <h5 class="fw-bold mb-1">Your Progress</h5>
                                    <p class="text-muted small mb-0">Section Officer Mock Test</p>
                                </div>
                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">+15% this week</span>
                            </div>
                            
                            <!-- Progress Bar Mock -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span class="fw-medium">General Knowledge</span>
                                    <span class="text-muted">75%</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-primary-blue" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            
                            <!-- Stats Mock -->
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="border rounded-3 p-3 text-center bg-light">
                                        <i class="bi bi-fire text-accent-orange fs-4 mb-2"></i>
                                        <h4 class="fw-bold mb-0">12</h4>
                                        <p class="text-muted small mb-0">Day Streak</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border rounded-3 p-3 text-center bg-light">
                                        <i class="bi bi-award text-warning fs-4 mb-2"></i>
                                        <h4 class="fw-bold mb-0">3</h4>
                                        <p class="text-muted small mb-0">New Badges</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Decorative Element -->
                    <div class="position-absolute bg-white rounded-3 shadow p-3 d-flex align-items-center gap-3" style="bottom: -20px; left: -30px; z-index: 2; rotate: -5deg;">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px;">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        <div>
                            <p class="fw-bold mb-0 fs-6">Test Passed!</p>
                            <p class="text-muted small mb-0">Scored 85/100</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5 my-5">
        <div class="container">
            <div class="text-center max-w-2xl mx-auto mb-5">
                <span class="text-accent-orange fw-bold text-uppercase tracking-wider small">Why Choose Us</span>
                <h2 class="display-6 fw-bold mt-2 mb-3">Everything you need to succeed</h2>
                <p class="text-muted lead">Our platform provides comprehensive tools designed specifically for LokSewa aspirants.</p>
            </div>
            
            <div class="row g-4 pt-3">
                <!-- Feature 1 -->
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon bg-primary-blue bg-opacity-10 text-primary-blue">
                            <i class="bi bi-translate"></i>
                        </div>
                        <h4 class="fw-bold h5 mb-3">Bilingual Support</h4>
                        <p class="text-muted small mb-0">Switch seamlessly between English and Nepali content to study in the language you're most comfortable with.</p>
                    </div>
                </div>
                
                <!-- Feature 2 -->
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon bg-accent-orange bg-opacity-10 text-accent-orange">
                            <i class="bi bi-stopwatch"></i>
                        </div>
                        <h4 class="fw-bold h5 mb-3">Real-time Mock Tests</h4>
                        <p class="text-muted small mb-0">Experience exam-like conditions with timed mock tests tailored for various LokSewa positions.</p>
                    </div>
                </div>
                
                <!-- Feature 3 -->
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon bg-success bg-opacity-10 text-success">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h4 class="fw-bold h5 mb-3">Progress Tracking</h4>
                        <p class="text-muted small mb-0">Visualize your growth with detailed analytics, identifying your strengths and areas needing improvement.</p>
                    </div>
                </div>
                
                <!-- Feature 4 -->
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-trophy"></i>
                        </div>
                        <h4 class="fw-bold h5 mb-3">Gamified Learning</h4>
                        <p class="text-muted small mb-0">Stay motivated by maintaining study streaks, earning badges, and climbing the leaderboard.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary-blue text-white position-relative overflow-hidden">
        <div class="position-absolute top-0 end-0 opacity-25 w-50 h-100" style="background: radial-gradient(circle, rgba(249,115,22,0.8) 0%, rgba(30,58,138,0) 70%);"></div>
        <div class="container py-5 text-center position-relative z-1">
            <h2 class="display-5 fw-bold mb-4">Ready to start your LokSewa journey?</h2>
            <p class="lead text-white-50 mb-5 max-w-2xl mx-auto">Join thousands of students who are already preparing for their dream government jobs using our platform.</p>
            <div class="d-flex gap-3 justify-content-center">
                <a href="{{ route('register') ?? '#' }}" class="btn btn-accent-custom btn-lg">Create Free Account</a>
                <a href="#mock-tests" class="btn btn-outline-light btn-lg">View Sample Questions</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-4 mt-auto">
        <div class="container pt-4">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6">
                    <h5 class="fw-bold text-white d-flex align-items-center mb-4">
                        <i class="bi bi-journal-bookmark-fill me-2 text-accent-orange"></i>
                        LokSewa Tayari
                    </h5>
                    <p class="text-white-50 small pe-lg-5">
                        Your ultimate companion for LokSewa examination preparation. Providing high-quality study materials, mock tests, and smart tracking.
                    </p>
                    <div class="d-flex gap-2 mt-4">
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold text-white mb-4">Platform</h6>
                    <ul class="list-unstyled text-white-50 small d-flex flex-column gap-2">
                        <li><a href="#" class="text-decoration-none text-white-50 hover-text-white transition">Mock Tests</a></li>
                        <li><a href="#" class="text-decoration-none text-white-50 hover-text-white transition">Study Materials</a></li>
                        <li><a href="#" class="text-decoration-none text-white-50 hover-text-white transition">Current Affairs</a></li>
                        <li><a href="#" class="text-decoration-none text-white-50 hover-text-white transition">Syllabus</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold text-white mb-4">Company</h6>
                    <ul class="list-unstyled text-white-50 small d-flex flex-column gap-2">
                        <li><a href="#" class="text-decoration-none text-white-50 hover-text-white transition">About Us</a></li>
                        <li><a href="#" class="text-decoration-none text-white-50 hover-text-white transition">Contact</a></li>
                        <li><a href="#" class="text-decoration-none text-white-50 hover-text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="text-decoration-none text-white-50 hover-text-white transition">Terms of Service</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <h6 class="fw-bold text-white mb-4">Subscribe to our Newsletter</h6>
                    <p class="text-white-50 small mb-3">Get the latest updates on exam dates, new study materials, and tips.</p>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control bg-dark border-secondary text-white" placeholder="Email address" aria-label="Email address">
                        <button class="btn btn-accent-custom" type="button">Subscribe</button>
                    </div>
                </div>
            </div>
            
            <hr class="border-secondary mt-5 mb-4">
            
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center text-white-50 small">
                <p class="mb-0">&copy; {{ date('Y') }} LokSewa Tayari Platform. All rights reserved.</p>
                <p class="mb-0 mt-2 mt-md-0">Made with <i class="bi bi-heart-fill text-danger"></i> for LokSewa aspirants.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS (Optional, for dropdowns/collapse) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Navbar Scroll Effect -->
    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-sm');
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
            } else {
                navbar.classList.remove('shadow-sm');
                navbar.style.background = 'rgba(255, 255, 255, 0.9)';
            }
        });
    </script>
</body>
</html>
