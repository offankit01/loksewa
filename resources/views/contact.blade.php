@extends('layouts.main')

@section('title', 'Contact Us - LokSiksha')

@section('content')
    <!-- Contact Header -->
    <section class="py-5 bg-gradient-dark text-white overflow-hidden position-relative">
        <div class="hero-bg-overlay opacity-25"></div>
        <div class="container py-5 text-center position-relative z-1">
            <div class="badge-premium d-inline-flex align-items-center gap-2 mb-4 animate-fade-in mx-auto">
                <div class="badge-icon"><i class="bi bi-headset"></i></div>
                <span class="badge-text">Support Center</span>
            </div>
            <h1 class="display-3 fw-extrabold text-white mb-4">Let's Connect</h1>
            <p class="lead text-white-50 mx-auto fs-4" style="max-width: 700px;">Have questions about our courses or need technical help? Our team is here to support your preparation journey.</p>
        </div>
        <div class="cta-pattern"></div>
    </section>

    <section class="py-5 bg-soft-light">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Contact Information -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm rounded-4 p-5 h-100 animate-slide-up">
                        <h3 class="fw-bold mb-5">Contact Details</h3>
                        
                        <div class="d-flex align-items-start gap-4 mb-4 pb-4 border-bottom border-light">
                            <div class="icon-circle bg-primary-blue shadow-lg">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Our Location</h6>
                                <p class="text-muted mb-0 small">Baneshwor, Kathmandu, Nepal</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-4 mb-4 pb-4 border-bottom border-light">
                            <div class="icon-circle bg-accent-orange shadow-lg">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Email Support</h6>
                                <p class="text-muted mb-0 small">hello@loksiksha.com</p>
                                <p class="text-muted mb-0 small">support@loksiksha.com</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-4 mb-4 pb-4 border-bottom border-light">
                            <div class="icon-circle bg-success shadow-lg">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Phone Number</h6>
                                <p class="text-muted mb-0 small">+977 1-4XXXXXX</p>
                                <p class="text-muted mb-0 small">+977 98XXXXXXXX</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-4">
                            <div class="icon-circle bg-info shadow-lg">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Operating Hours</h6>
                                <p class="text-muted mb-0 small">Sun - Fri: 10:00 AM - 6:00 PM</p>
                                <p class="text-muted mb-0 small text-danger fw-bold mt-1">Saturday: Closed</p>
                            </div>
                        </div>

                        <div class="mt-5 pt-4">
                            <h6 class="fw-bold mb-4">Follow Our Updates</h6>
                            <div class="d-flex gap-3">
                                <a href="#" class="btn btn-light rounded-4 p-3 text-primary-blue fs-5 shadow-sm border border-light"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="btn btn-light rounded-4 p-3 text-primary-blue fs-5 shadow-sm border border-light"><i class="bi bi-twitter-x"></i></a>
                                <a href="#" class="btn btn-light rounded-4 p-3 text-primary-blue fs-5 shadow-sm border border-light"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="btn btn-light rounded-4 p-3 text-danger fs-5 shadow-sm border border-light"><i class="bi bi-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm rounded-4 p-5 h-100 animate-slide-up" style="animation-delay: 0.1s;">
                        <h3 class="fw-bold mb-2">Send us a Message</h3>
                        <p class="text-muted mb-5 fs-6">Fill out the form below and we'll get back to you within 24 hours.</p>
                        
                        <form action="#" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted text-uppercase letter-spacing-1">Full Name</label>
                                    <div class="input-group-premium">
                                        <input type="text" class="form-control" placeholder="Enter your name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted text-uppercase letter-spacing-1">Email Address</label>
                                    <div class="input-group-premium">
                                        <input type="email" class="form-control" placeholder="email@example.com" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label small fw-bold text-muted text-uppercase letter-spacing-1">How can we help?</label>
                                    <div class="input-group-premium">
                                        <select class="form-select shadow-none">
                                            <option selected disabled>Choose a subject</option>
                                            <option>Course Inquiry</option>
                                            <option>Technical Issue</option>
                                            <option>Payment/Upgrade Help</option>
                                            <option>General Feedback</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label small fw-bold text-muted text-uppercase letter-spacing-1">Your Message</label>
                                    <div class="input-group-premium">
                                        <textarea class="form-control" rows="6" placeholder="Describe your inquiry..." required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-accent-custom btn-lg w-100 rounded-pill py-3 fw-bold mt-2 shadow-lg hover-scale">
                                        Send Message <i class="bi bi-send-fill ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="rounded-5 overflow-hidden shadow-lg border border-light position-relative" style="height: 450px;">
                <div class="w-100 h-100 bg-light d-flex flex-column align-items-center justify-content-center text-center p-5">
                    <div class="feature-img-glow" style="opacity: 0.05;"></div>
                    <div class="icon-circle bg-primary-blue mb-4 animate-pulse" style="width: 80px; height: 80px;">
                        <i class="bi bi-geo-fill display-5"></i>
                    </div>
                    <h2 class="fw-extrabold mb-2">Visit Our Office</h2>
                    <p class="text-muted fs-5 mb-4">New Baneshwor, Kathmandu, Nepal</p>
                    <a href="https://maps.google.com" target="_blank" class="btn btn-outline-dark rounded-pill px-5 py-3 fw-bold border-2">
                        Get Directions <i class="bi bi-map ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

