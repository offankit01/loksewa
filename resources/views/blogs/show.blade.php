@extends('layouts.main')

@section('title', $blog['title'] . ' - LokSiksha')

@section('content')
    <!-- Blog Post Header -->
    <section class="py-5 bg-gradient-dark text-white overflow-hidden position-relative">
        <div class="hero-bg-overlay opacity-25"></div>
        <div class="container py-5 position-relative z-1">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <div class="badge-premium d-inline-flex align-items-center gap-2 mb-4 animate-fade-in mx-auto">
                        <div class="badge-icon"><i class="bi bi-tag-fill"></i></div>
                        <span class="badge-text">Preparation Guide</span>
                    </div>
                    <h1 class="display-3 fw-extrabold text-white mb-4 lh-tight">{{ $blog['title'] }}</h1>
                    
                    <div class="d-flex align-items-center justify-content-center gap-4 flex-wrap mt-4">
                        <div class="d-flex align-items-center gap-2">
                            <div class="user-avatar-styled bg-white bg-opacity-10" style="width: 40px; height: 40px;">
                                {{ strtoupper(substr($blog['author'], 0, 1)) }}
                            </div>
                            <span class="fw-bold">{{ $blog['author'] }}</span>
                        </div>
                        <div class="vr opacity-25 d-none d-md-block"></div>
                        <div class="d-flex align-items-center gap-2 opacity-75">
                            <i class="bi bi-calendar3"></i>
                            <span>{{ $blog['date'] }}</span>
                        </div>
                        <div class="vr opacity-25 d-none d-md-block"></div>
                        <div class="d-flex align-items-center gap-2 opacity-75">
                            <i class="bi bi-clock"></i>
                            <span>8 Min Read</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cta-pattern"></div>
    </section>

    <!-- Main Content Section -->
    <section class="py-5 bg-soft-light">
        <div class="container py-4">
            <div class="row g-5">
                <!-- Blog Content -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-2xl rounded-5 overflow-hidden animate-slide-up">
                        <div class="position-relative">
                            <img src="{{ $blog['image'] }}" alt="{{ $blog['title'] }}" class="w-100" style="height: 450px; object-fit: cover;">
                            <div class="position-absolute bottom-0 start-0 w-100 p-4 bg-gradient-to-t from-black opacity-50 h-50"></div>
                        </div>
                        <div class="card-body p-5">
                            <div class="blog-content-rich fs-5 text-muted lh-lg">
                                <p class="lead fw-bold text-dark mb-4">{{ $blog['excerpt'] }}</p>
                                
                                <h3 class="fw-bold text-dark mb-3 mt-5">The Importance of Strategy</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                
                                <div class="p-4 bg-light rounded-4 border-start border-primary-blue border-5 my-5">
                                    <p class="fst-italic mb-0">"Success in LokSewa isn't just about how much you study, but how effectively you plan your preparation journey."</p>
                                </div>

                                <h3 class="fw-bold text-dark mb-3 mt-5">Core Preparation Pillars</h3>
                                <ul class="list-unstyled">
                                    <li class="mb-3 d-flex gap-3">
                                        <i class="bi bi-check-circle-fill text-success"></i>
                                        <span><strong>Syllabus Mastery:</strong> Understand every sub-topic and its weightage in the final score.</span>
                                    </li>
                                    <li class="mb-3 d-flex gap-3">
                                        <i class="bi bi-check-circle-fill text-success"></i>
                                        <span><strong>Consistent Revision:</strong> Information retention is key for GK and written papers.</span>
                                    </li>
                                    <li class="mb-3 d-flex gap-3">
                                        <i class="bi bi-check-circle-fill text-success"></i>
                                        <span><strong>Mock Practice:</strong> Simulate the exam environment weekly to improve speed.</span>
                                    </li>
                                </ul>

                                <p class="mt-5">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>

                            <!-- Share Section -->
                            <div class="mt-5 pt-5 border-top border-light d-flex flex-wrap align-items-center justify-content-between gap-3">
                                <h6 class="fw-bold mb-0">Did you find this helpful? Share it!</h6>
                                <div class="d-flex gap-2">
                                    <a href="#" class="btn btn-light rounded-pill px-4 shadow-sm border border-light"><i class="bi bi-facebook text-primary me-2"></i> Share</a>
                                    <a href="#" class="btn btn-light rounded-pill px-4 shadow-sm border border-light"><i class="bi bi-twitter-x text-dark me-2"></i> Tweet</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Author Card -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 animate-slide-up" style="animation-delay: 0.1s;">
                        <div class="text-center">
                            <div class="user-avatar-styled mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                                {{ strtoupper(substr($blog['author'], 0, 1)) }}
                            </div>
                            <h5 class="fw-bold mb-1">{{ $blog['author'] }}</h5>
                            <p class="text-primary-blue small fw-bold mb-3 text-uppercase">Senior Content Strategist</p>
                            <p class="text-muted small mb-4">Dedicated to helping students navigate the complex world of civil service exams with expert insights.</p>
                            <a href="#" class="btn btn-outline-primary-blue w-100 rounded-pill">View Profile</a>
                        </div>
                    </div>

                    <!-- Related Posts -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 animate-slide-up" style="animation-delay: 0.2s;">
                        <h5 class="fw-bold mb-4">Recent Articles</h5>
                        @foreach($recentBlogs as $recent)
                        <div class="d-flex gap-3 mb-4 last-child-mb-0">
                            <img src="{{ $recent['image'] }}" class="rounded-3" style="width: 80px; height: 60px; object-fit: cover;">
                            <div>
                                <h6 class="fw-bold mb-1 small lh-base">
                                    <a href="{{ route('blogs.show', $recent['slug']) }}" class="text-dark text-decoration-none hover-text-primary">{{ $recent['title'] }}</a>
                                </h6>
                                <p class="text-muted small mb-0">{{ $recent['date'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <!-- Newsletter -->
                    <div class="card border-0 bg-primary-blue text-white rounded-4 p-4 mt-4 animate-slide-up" style="animation-delay: 0.3s;">
                        <h5 class="fw-bold mb-3">Stay Updated</h5>
                        <p class="small opacity-75 mb-4">Get the latest exam news and study materials delivered to your inbox weekly.</p>
                        <form class="position-relative">
                            <input type="email" class="form-control rounded-pill border-0 p-3 shadow-none small" placeholder="Your Email">
                            <button type="submit" class="btn btn-accent-custom rounded-pill py-2 px-3 position-absolute end-0 top-50 translate-middle-y me-2">Join</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-5 bg-white">
        <div class="container py-5 text-center">
            <div class="cta-block-premium p-5 shadow-lg">
                <div class="cta-pattern"></div>
                <div class="position-relative z-1">
                    <h2 class="display-4 fw-extrabold text-white mb-4">Master Your Preparation</h2>
                    <p class="text-white-50 mb-5 max-w-xl mx-auto fs-5">Access thousands of mock tests, expert notes, and real-time performance tracking.</p>
                    <a href="{{ route('register') }}" class="btn btn-accent-custom btn-lg rounded-pill px-5 py-3 shadow-xl hover-scale">
                        Start Learning for Free <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
