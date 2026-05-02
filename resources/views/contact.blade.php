@extends('layouts.main')

@section('title', 'Contact Us - LokSewa Tayari')

@section('content')
    <!-- Contact Header -->
    <section class="py-5 bg-primary-blue text-white overflow-hidden position-relative">
        <div class="container py-5 text-center position-relative z-1">
            <h1 class="display-4 fw-bold mb-3">Get In Touch</h1>
            <p class="lead text-white-50 mx-auto" style="max-width: 700px;">Have questions about our courses or technical issues? We're here to help you succeed on your LokSewa journey.</p>
        </div>
        <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10" style="background-image: radial-gradient(circle at 20% 30%, white 0%, transparent 50%);"></div>
    </section>

    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Contact Information -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm rounded-4 p-5 h-100">
                        <h3 class="fw-bold mb-5">Contact Details</h3>
                        
                        <div class="d-flex align-items-start gap-4 mb-4 pb-4 border-bottom border-light">
                            <div class="bg-primary-blue bg-opacity-10 text-primary-blue p-3 rounded-4">
                                <i class="bi bi-geo-alt fs-3"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Our Location</h6>
                                <p class="text-muted mb-0 small">Shanti Nagar, Kathmandu, Nepal</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-4 mb-4 pb-4 border-bottom border-light">
                            <div class="bg-accent-orange bg-opacity-10 text-accent-orange p-3 rounded-4">
                                <i class="bi bi-envelope fs-3"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Email Support</h6>
                                <p class="text-muted mb-0 small">support@loksewa.com</p>
                                <p class="text-muted mb-0 small">info@loksewatayari.com.np</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-4 mb-4 pb-4 border-bottom border-light">
                            <div class="bg-success bg-opacity-10 text-success p-3 rounded-4">
                                <i class="bi bi-telephone fs-3"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Phone Number</h6>
                                <p class="text-muted mb-0 small">+977 1-423XXXX</p>
                                <p class="text-muted mb-0 small">+977 9841XXXXXX</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-4">
                            <div class="bg-primary-blue bg-opacity-10 text-primary-blue p-3 rounded-4">
                                <i class="bi bi-clock fs-3"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Operating Hours</h6>
                                <p class="text-muted mb-0 small">Sun - Fri: 10:00 AM - 6:00 PM</p>
                                <p class="text-muted mb-0 small text-danger fw-bold mt-1">Saturday: Closed</p>
                            </div>
                        </div>

                        <div class="mt-5 pt-4">
                            <h6 class="fw-bold mb-3">Follow Us</h6>
                            <div class="d-flex gap-3">
                                <a href="#" class="btn btn-light rounded-circle p-2 text-primary-blue fs-5 shadow-sm"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="btn btn-light rounded-circle p-2 text-primary-blue fs-5 shadow-sm"><i class="bi bi-twitter-x"></i></a>
                                <a href="#" class="btn btn-light rounded-circle p-2 text-primary-blue fs-5 shadow-sm"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="btn btn-light rounded-circle p-2 text-primary-blue fs-5 shadow-sm"><i class="bi bi-youtube text-danger"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm rounded-4 p-5 h-100">
                        <h3 class="fw-bold mb-2">Send us a Message</h3>
                        <p class="text-muted mb-5">Fill out the form below and our team will get back to you within 24 hours.</p>
                        
                        <form action="#" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted text-uppercase letter-spacing-1">Full Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><i class="bi bi-person text-muted"></i></span>
                                        <input type="text" class="form-control bg-light border-0 py-3" placeholder="Enter your name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted text-uppercase letter-spacing-1">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><i class="bi bi-envelope text-muted"></i></span>
                                        <input type="email" class="form-control bg-light border-0 py-3" placeholder="email@example.com" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label small fw-bold text-muted text-uppercase letter-spacing-1">Subject</label>
                                    <select class="form-select bg-light border-0 py-3 shadow-none">
                                        <option selected disabled>Choose a subject</option>
                                        <option>Course Inquiry</option>
                                        <option>Technical Issue</option>
                                        <option>Payment/Upgrade Help</option>
                                        <option>General Feedback</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label small fw-bold text-muted text-uppercase letter-spacing-1">Your Message</label>
                                    <textarea class="form-control bg-light border-0 py-3 shadow-none" rows="6" placeholder="How can we help you?" required></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary-custom btn-lg w-100 rounded-pill py-3 fw-bold mt-2 shadow-lg">
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
            <div class="rounded-5 overflow-hidden shadow-sm" style="height: 400px;">
                <!-- Placeholder for Google Maps -->
                <div class="w-100 h-100 bg-light d-flex flex-column align-items-center justify-content-center text-center p-5">
                    <i class="bi bi-map-fill display-1 text-primary-blue bg-opacity-10 mb-4"></i>
                    <h4 class="fw-bold">Find Us on Google Maps</h4>
                    <p class="text-muted">Shanti Nagar, Kathmandu, Nepal</p>
                    <button class="btn btn-outline-primary border-primary-blue text-primary-blue rounded-pill mt-3 px-4">Open in Google Maps</button>
                </div>
            </div>
        </div>
    </section>
@endsection
