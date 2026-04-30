@extends('layouts.main')

@section('title', config('app.name', 'LokSewa Tayari') . ' - Home')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section text-center text-lg-start">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="badge bg-accent-orange bg-opacity-10 text-accent-orange px-3 py-2 rounded-pill mb-4 fw-bold">
                        <i class="bi bi-stars me-1"></i> #1 LokSewa Preparation Platform
                    </div>
                    <h1 class="display-3 fw-bold mb-4">Master Your <span class="text-accent-orange">LokSewa</span> Journey with Confidence</h1>
                    <p class="lead text-muted mb-5">Access premium notes, practice mock tests, and track your progress in real-time. Prepare in both English and Nepali with our expert-curated content.</p>
                    <div class="d-flex flex-column flex-sm-row gap-3">
                        <a href="{{ route('register') }}" class="btn btn-primary-custom btn-lg rounded-pill px-4 py-3 fw-bold shadow">
                            Start Preparation Free <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                        <a href="{{ route('services') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-4 py-3 fw-bold">
                            View Services Roadmap
                        </a>
                    </div>
                    <div class="mt-5 d-flex align-items-center gap-4">
                        <div class="d-flex -space-x-3">
                            <div class="avatar border-2 border-white rounded-circle bg-light d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; margin-right: -12px; z-index: 3;">A</div>
                            <div class="avatar border-2 border-white rounded-circle bg-primary-blue text-white d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; margin-right: -12px; z-index: 2;">B</div>
                            <div class="avatar border-2 border-white rounded-circle bg-accent-orange text-white d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; z-index: 1;">+</div>
                        </div>
                        <div class="small text-muted">
                            <span class="fw-bold text-dark">10,000+</span> Students Joined
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image-container position-relative">
                        <div class="hero-blob"></div>
                        <img src="https://img.freepik.com/free-vector/learning-concept-illustration_114360-6186.jpg" alt="Learning" class="img-fluid position-relative z-1 rounded-4 shadow-lg">
                        
                        <!-- Floating Stat Cards -->
                        <div class="stat-card p-3 rounded-3 shadow-sm bg-white d-flex align-items-center gap-3 position-absolute" style="top: 10%; right: -5%;">
                            <div class="bg-success bg-opacity-10 text-success p-2 rounded-2">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">98%</h6>
                                <p class="small text-muted mb-0">Success Rate</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-5 bg-white" id="features">
        <div class="container py-5 text-center">
            <h2 class="fw-bold mb-5">Everything You Need to Succeed</h2>
            <div class="row g-4 text-start">
                <div class="col-md-4">
                    <div class="p-4 rounded-4 border-0 shadow-sm h-100 bg-light">
                        <i class="bi bi-translate text-accent-orange fs-1 mb-3 d-block"></i>
                        <h4 class="fw-bold">Bilingual Content</h4>
                        <p class="text-muted">Study materials available in both English and Nepali to match your preference.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 rounded-4 border-0 shadow-sm h-100 bg-light">
                        <i class="bi bi-laptop text-primary-blue fs-1 mb-3 d-block"></i>
                        <h4 class="fw-bold">Smart Mock Tests</h4>
                        <p class="text-muted">Real-time exam simulation with instant feedback and score analysis.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 rounded-4 border-0 shadow-sm h-100 bg-light">
                        <i class="bi bi-trophy text-warning fs-1 mb-3 d-block"></i>
                        <h4 class="fw-bold">Gamified Learning</h4>
                        <p class="text-muted">Earn points, level up, and maintain streaks as you prepare for your future.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
