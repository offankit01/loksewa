@extends('layouts.main')

@section('title', 'About Us - LokSiksha')

@section('content')
    <!-- About Hero -->
    <section class="py-5 bg-gradient-dark text-white overflow-hidden position-relative">
        <div class="hero-bg-overlay opacity-25"></div>
        <div class="container py-5 position-relative z-1">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="badge-premium d-inline-flex align-items-center gap-2 mb-4 animate-fade-in">
                        <div class="badge-icon"><i class="bi bi-rocket-takeoff-fill"></i></div>
                        <span class="badge-text">Our Journey</span>
                    </div>
                    <h1 class="display-3 fw-extrabold text-white mb-4">Empowering the Next Generation of <span class="text-accent-orange">Public Leaders</span></h1>
                    <p class="lead text-white-50 mb-0 fs-4">LokSiksha was founded on a simple belief: that every talented aspirant in Nepal deserves access to world-class preparation tools, regardless of their location.</p>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative animate-float">
                        <div class="bg-white bg-opacity-10 p-2 rounded-5 backdrop-blur shadow-2xl">
                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&q=80&w=800" alt="About LokSiksha" class="img-fluid rounded-5 shadow-lg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cta-pattern"></div>
    </section>

    <!-- Mission & Values -->
    <section class="py-5 bg-soft-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-extrabold mb-3">Built on Strong Foundations</h2>
                <p class="text-muted fs-5">Our core values guide every feature we build and every note we curate.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="category-card p-5 h-100 text-center animate-slide-up">
                        <div class="category-icon-wrapper bg-primary-blue bg-opacity-10 text-primary-blue mb-4">
                            <i class="bi bi-eye"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Our Vision</h4>
                        <p class="text-muted mb-0">To be the definitive digital ecosystem for civil service preparation in Nepal, fostering a merit-based future.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="category-card p-5 h-100 text-center animate-slide-up" style="animation-delay: 0.1s;">
                        <div class="category-icon-wrapper bg-accent-orange bg-opacity-10 text-accent-orange mb-4">
                            <i class="bi bi-bullseye"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Our Mission</h4>
                        <p class="text-muted mb-0">To democratize education by providing expert-led materials and AI-driven analytics that reveal student potential.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="category-card p-5 h-100 text-center animate-slide-up" style="animation-delay: 0.2s;">
                        <div class="category-icon-wrapper bg-success bg-opacity-10 text-success mb-4">
                            <i class="bi bi-heart-pulse"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Our Core Values</h4>
                        <p class="text-muted mb-0">Integrity, Accessibility, and a Student-First approach. We measure our success by your success.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact Stats -->
    <section class="py-5 bg-gradient-dark text-white overflow-hidden">
        <div class="container py-4">
            <div class="row g-4 text-center">
                <div class="col-6 col-md-3">
                    <div class="p-3">
                        <h2 class="display-4 fw-extrabold mb-1 text-accent-orange">50K+</h2>
                        <p class="text-white-50 small text-uppercase fw-bold letter-spacing-1">Active Students</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3">
                        <h2 class="display-4 fw-extrabold mb-1 text-white">1M+</h2>
                        <p class="text-white-50 small text-uppercase fw-bold letter-spacing-1">Tests Attempted</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3">
                        <h2 class="display-4 fw-extrabold mb-1 text-white">500+</h2>
                        <p class="text-white-50 small text-uppercase fw-bold letter-spacing-1">Study Modules</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3">
                        <h2 class="display-4 fw-extrabold mb-1 text-success">98%</h2>
                        <p class="text-white-50 small text-uppercase fw-bold letter-spacing-1">Success Rate</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <div class="badge-premium d-inline-flex align-items-center gap-2 mb-4 mx-auto">
                    <div class="badge-icon"><i class="bi bi-people-fill"></i></div>
                    <span class="badge-text">The Experts</span>
                </div>
                <h2 class="display-5 fw-extrabold mb-3">Meet the Minds Behind LokSiksha</h2>
                <p class="text-muted fs-5">A dedicated team of educators, technologists, and civil service veterans.</p>
            </div>
            <div class="row g-4">
                @foreach([
                    ['name' => 'Dr. Keshav Bhatta', 'role' => 'Content Director', 'desc' => 'Ex-Civil Servant with 20+ years of domain expertise in Nepali administration.'],
                    ['name' => 'Prabin Rai', 'role' => 'Technical Architect', 'desc' => 'Innovation-driven developer focused on building intuitive preparation tools.'],
                    ['name' => 'Anjali Thapa', 'role' => 'Exam Analyst', 'desc' => 'Expert in pattern recognition and syllabus optimization for LokSewa exams.']
                ] as $member)
                <div class="col-md-4">
                    <div class="feature-card-premium p-5 text-center h-100">
                        <div class="bg-soft-light rounded-4 mx-auto mb-4 d-flex align-items-center justify-content-center shadow-inner" style="width: 120px; height: 120px;">
                            <i class="bi bi-person-badge display-4 text-primary-blue"></i>
                        </div>
                        <h4 class="fw-bold mb-1">{{ $member['name'] }}</h4>
                        <p class="text-primary-blue small fw-extrabold mb-3 text-uppercase letter-spacing-1">{{ $member['role'] }}</p>
                        <p class="text-muted mb-0 small">{{ $member['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Feedback Section -->
    <section class="py-5 bg-soft-light">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-2xl rounded-5 overflow-hidden">
                        <div class="row g-0">
                            <div class="col-md-5 bg-gradient-dark p-5 text-white d-flex flex-column justify-content-center position-relative overflow-hidden">
                                <div class="hero-bg-overlay opacity-25"></div>
                                <div class="position-relative z-1">
                                    <h2 class="fw-extrabold mb-4 display-6">Share Your LokSiksha Experience</h2>
                                    <p class="text-white-50 mb-5">Your feedback fuels our innovation and helps thousands of other aspirants find their path.</p>
                                    <div class="d-flex align-items-center gap-4 mb-4">
                                        <div class="icon-circle bg-white bg-opacity-10 text-white">
                                            <i class="bi bi-chat-heart"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Genuine Reviews</h6>
                                            <small class="opacity-50">Verified student stories</small>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="icon-circle bg-white bg-opacity-10 text-white">
                                            <i class="bi bi-lightning-charge"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Direct Impact</h6>
                                            <small class="opacity-50">We listen to every word</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 p-5 bg-white">
                                @if(session('success'))
                                    <div class="alert alert-success border-0 rounded-4 p-4 mb-4 animate-fade-in shadow-sm">
                                        <div class="d-flex gap-3 align-items-center">
                                            <i class="bi bi-check-circle-fill fs-3 text-success"></i>
                                            <div>
                                                <h6 class="fw-bold mb-1">Thank You!</h6>
                                                <p class="small mb-0">{{ session('success') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <form action="{{ route('feedback.store') }}" method="POST">
                                    @csrf
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-muted text-uppercase">Full Name</label>
                                            <div class="input-group-premium">
                                                <input type="text" name="user_name" class="form-control" placeholder="Your name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-muted text-uppercase">Target Role</label>
                                            <div class="input-group-premium">
                                                <input type="text" name="designation" class="form-control" placeholder="e.g. Section Officer Aspirant">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label small fw-bold text-muted text-uppercase">Experience Rating</label>
                                            <div class="input-group-premium">
                                                <select name="rating" class="form-select">
                                                    <option value="5">⭐⭐⭐⭐⭐ - Highly Recommended</option>
                                                    <option value="4">⭐⭐⭐⭐ - Very Good</option>
                                                    <option value="3">⭐⭐⭐ - Satisfactory</option>
                                                    <option value="2">⭐⭐ - Needs Improvement</option>
                                                    <option value="1">⭐ - Poor</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label small fw-bold text-muted text-uppercase">Your Story</label>
                                            <div class="input-group-premium">
                                                <textarea name="content" class="form-control" rows="4" placeholder="Tell us how LokSiksha helped you..." required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-accent-custom w-100 rounded-pill py-3 fw-bold shadow-lg hover-scale mt-2">
                                                Submit Feedback <i class="bi bi-arrow-right ms-2"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Join Us CTA -->
    <section class="py-5 bg-white">
        <div class="container text-center py-5">
            <div class="cta-block-premium p-5 shadow-lg">
                <div class="cta-pattern"></div>
                <div class="position-relative z-1">
                    <h2 class="display-4 fw-extrabold text-white mb-4">Ready to Change Your Life?</h2>
                    <p class="text-white-50 mb-5 max-w-xl mx-auto fs-5">Join thousands of students who have already started their journey with LokSiksha. Let's make your dream a reality.</p>
                    <a href="{{ route('register') }}" class="btn btn-accent-custom btn-lg rounded-pill px-5 py-3 shadow-xl hover-scale">
                        Join Now <i class="bi bi-person-plus ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

