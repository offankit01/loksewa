@extends('layouts.main')

@section('title', 'About Us - LokSewa Tayari')

@section('content')
    <!-- About Hero -->
    <section class="py-5 bg-light overflow-hidden">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h6 class="text-primary-blue fw-bold text-uppercase mb-3 letter-spacing-1">Our Journey</h6>
                    <h1 class="display-4 fw-bold mb-4">Empowering the Next Generation of <span class="text-accent-orange">Civil Servants</span></h1>
                    <p class="lead text-muted mb-0">LokSewa Tayari started with a simple mission: to make government exam preparation accessible, affordable, and high-quality for every aspirant in Nepal.</p>
                </div>
                <div class="col-lg-6 position-relative">
                    <div class="bg-primary-blue rounded-5 p-2 shadow-lg rotate-3">
                        <img src="https://img.freepik.com/free-vector/vision-statement-concept-illustration_114360-7576.jpg" alt="About" class="img-fluid rounded-4 rotate--3">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Values -->
    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-4 rounded-4 bg-light h-100 border-0 shadow-sm text-center">
                        <div class="bg-primary-blue bg-opacity-10 text-primary-blue p-3 rounded-circle d-inline-flex mb-4">
                            <i class="bi bi-eye fs-2"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Our Vision</h4>
                        <p class="text-muted small mb-0">To be the #1 digital ecosystem for civil service preparation in Nepal, fostering excellence and transparency.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 rounded-4 bg-light h-100 border-0 shadow-sm text-center">
                        <div class="bg-accent-orange bg-opacity-10 text-accent-orange p-3 rounded-circle d-inline-flex mb-4">
                            <i class="bi bi-bullseye fs-2"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Our Mission</h4>
                        <p class="text-muted small mb-0">To provide expert-curated materials and smart analytics that help students identify and overcome their weaknesses.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 rounded-4 bg-light h-100 border-0 shadow-sm text-center">
                        <div class="bg-success bg-opacity-10 text-success p-3 rounded-circle d-inline-flex mb-4">
                            <i class="bi bi-heart fs-2"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Our Values</h4>
                        <p class="text-muted small mb-0">Integrity, Accessibility, and Student-First approach in everything we build and curate.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact Stats -->
    <section class="py-5 bg-primary-blue text-white">
        <div class="container py-4">
            <div class="row g-4 text-center">
                <div class="col-6 col-md-3">
                    <h2 class="display-5 fw-bold mb-1">50K+</h2>
                    <p class="text-white-50 small text-uppercase fw-bold">Active Students</p>
                </div>
                <div class="col-6 col-md-3">
                    <h2 class="display-5 fw-bold mb-1">1M+</h2>
                    <p class="text-white-50 small text-uppercase fw-bold">Tests Attempted</p>
                </div>
                <div class="col-6 col-md-3">
                    <h2 class="display-5 fw-bold mb-1">500+</h2>
                    <p class="text-white-50 small text-uppercase fw-bold">Study Materials</p>
                </div>
                <div class="col-6 col-md-3">
                    <h2 class="display-5 fw-bold mb-1">98%</h2>
                    <p class="text-white-50 small text-uppercase fw-bold">Satisfaction Rate</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Meet the Experts</h2>
                <p class="text-muted">The minds behind our curated content and technology.</p>
            </div>
            <div class="row g-4">
                @foreach([
                    ['name' => 'Dr. Keshav Bhatta', 'role' => 'Content Director', 'desc' => 'Ex-Civil Servant with 20 years of expertise.'],
                    ['name' => 'Prabin Rai', 'role' => 'Technical Architect', 'desc' => 'Passionate about building scalable ed-tech solutions.'],
                    ['name' => 'Anjali Thapa', 'role' => 'Exam Analyst', 'desc' => 'Specializes in LokSewa syllabus and patterns.']
                ] as $member)
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 text-center p-4 bg-light hover-translate h-100">
                        <div class="bg-white rounded-circle mx-auto mb-4 d-flex align-items-center justify-content-center shadow-sm" style="width: 100px; height: 100px;">
                            <i class="bi bi-person-fill fs-1 text-primary-blue"></i>
                        </div>
                        <h5 class="fw-bold mb-1">{{ $member['name'] }}</h5>
                        <p class="text-primary-blue small fw-bold mb-3">{{ $member['role'] }}</p>
                        <p class="text-muted small mb-0">{{ $member['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Join Us CTA -->
    <section class="py-5 bg-light">
        <div class="container text-center py-5">
            <h2 class="fw-bold mb-4">Ready to Change Your Life?</h2>
            <p class="text-muted mb-5 max-w-xl mx-auto">Join thousands of students who have already started their journey with us. Let's make your dream of a government career a reality.</p>
            <a href="{{ route('register') }}" class="btn btn-primary-custom btn-lg rounded-pill px-5">Join Now</a>
        </div>
    </section>
@endsection
