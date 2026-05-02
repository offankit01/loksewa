@extends('layouts.main')

@section('title', config('app.name', 'LokSewa Tayari') . ' - Home')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section py-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="badge bg-accent-orange bg-opacity-10 text-accent-orange px-3 py-2 rounded-pill mb-4 fw-bold">
                        <i class="bi bi-star-fill me-1"></i> Most Trusted Platform
                    </div>
                    <h1 class="display-3 fw-bold mb-4">Master Your <span class="text-accent-orange">LokSewa</span> Journey with Confidence</h1>
                    <p class="lead text-muted mb-5">Access premium notes, practice mock tests, and track your progress in real-time. Prepare in both English and Nepali with our expert-curated content.</p>
                    
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('register') }}" class="btn btn-primary-custom btn-lg rounded-pill px-5 py-3 shadow-lg">
                            Get Started Free
                        </a>
                        <a href="{{ route('services') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-4 py-3 fw-bold border-2">
                            View Roadmap
                        </a>
                    </div>
                    
                    <div class="mt-5 d-flex align-items-center gap-4">
                        <div class="d-flex">
                            <div class="avatar border-2 border-white rounded-circle bg-light d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; margin-right: -12px; z-index: 3;">A</div>
                            <div class="avatar border-2 border-white rounded-circle bg-primary-blue text-white d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; margin-right: -12px; z-index: 2;">B</div>
                            <div class="avatar border-2 border-white rounded-circle bg-accent-orange text-white d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; z-index: 1;">+</div>
                        </div>
                        <div class="text-muted small">
                            <span class="fw-bold text-dark">50,000+</span> Students already joined
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image-container position-relative">
                        <div class="hero-blob"></div>
                        <img src="https://img.freepik.com/free-vector/learning-concept-illustration_114360-6186.jpg" alt="Learning" class="img-fluid position-relative z-1 rounded-4 shadow-lg">
                        
                        <!-- Floating Stat Cards -->
                        <div class="stat-card p-3 rounded-3 shadow-sm bg-white d-flex align-items-center gap-3 position-absolute" style="top: 10%; right: 2%; z-index: 10;">
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

    <!-- Exam Categories -->
    <section class="py-5 bg-white">
        <div class="container text-center mb-5">
            <h2 class="fw-bold">Popular Exam Categories</h2>
            <p class="text-muted">Specialized preparation for all major LokSewa positions</p>
        </div>
        <div class="container">
            <div class="row g-4">
                @foreach([
                    ['name' => 'Section Officer', 'icon' => 'bi-briefcase', 'count' => '120+ Sets'],
                    ['name' => 'Nayab Subba', 'icon' => 'bi-journal-text', 'count' => '95+ Sets'],
                    ['name' => 'Kharidar', 'icon' => 'bi-file-earmark-person', 'count' => '80+ Sets'],
                    ['name' => 'Bank & Finance', 'icon' => 'bi-bank', 'count' => '60+ Sets'],
                    ['name' => 'Security Forces', 'icon' => 'bi-shield-check', 'count' => '50+ Sets'],
                    ['name' => 'TSC (Teachers)', 'icon' => 'bi-mortarboard', 'count' => '110+ Sets']
                ] as $exam)
                <div class="col-md-4 col-lg-2">
                    <div class="card border-0 shadow-none text-center h-100 py-3 bg-light rounded-4 hover-translate">
                        <div class="fs-1 text-primary-blue mb-2"><i class="bi {{ $exam['icon'] }}"></i></div>
                        <h6 class="fw-bold mb-1">{{ $exam['name'] }}</h6>
                        <span class="small text-muted">{{ $exam['count'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5" id="features">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <h2 class="display-5 fw-bold mb-4">Why Aspirants Choose Us?</h2>
                    <p class="text-muted mb-5">We provide the most comprehensive ecosystem for your government job preparation journey.</p>
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-4 rounded-4 border-0 shadow-sm h-100 bg-white">
                                <div class="bg-primary-blue bg-opacity-10 text-primary-blue p-2 rounded-3 d-inline-block mb-3">
                                    <i class="bi bi-translate fs-4"></i>
                                </div>
                                <h4 class="fw-bold">Bilingual Content</h4>
                                <p class="text-muted small">Switch seamlessly between Nepali and English materials.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-4 rounded-4 border-0 shadow-sm h-100 bg-white">
                                <div class="bg-accent-orange bg-opacity-10 text-accent-orange p-2 rounded-3 d-inline-block mb-3">
                                    <i class="bi bi-laptop fs-4"></i>
                                </div>
                                <h4 class="fw-bold">Smart Mock Tests</h4>
                                <p class="text-muted small">Real exam simulation with detailed performance analytics.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <img src="https://img.freepik.com/free-vector/expert-concept-illustration_114360-6180.jpg" alt="Features" class="img-fluid rounded-4 shadow-sm">
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-5 bg-primary-blue text-white overflow-hidden position-relative">
        <div class="container text-center mb-5 position-relative z-1">
            <h2 class="fw-bold text-white">How It Works</h2>
            <p class="text-white-50">3 Simple steps to your dream job</p>
        </div>
        <div class="container position-relative z-1">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-center p-4">
                        <div class="bg-white bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                            <span class="display-5 fw-bold text-accent-orange">1</span>
                        </div>
                        <h4 class="fw-bold">Register</h4>
                        <p class="text-white-50">Create your account and select your targeted exam categories.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4">
                        <div class="bg-white bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                            <span class="display-5 fw-bold text-accent-orange">2</span>
                        </div>
                        <h4 class="fw-bold">Practice</h4>
                        <p class="text-white-50">Access daily notes and attempt unlimited mock tests in your language.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4">
                        <div class="bg-white bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                            <span class="display-5 fw-bold text-accent-orange">3</span>
                        </div>
                        <h4 class="fw-bold">Succeed</h4>
                        <p class="text-white-50">Analyze your weak areas and improve until you crack the real exam.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Voices of Success</h2>
                <p class="text-muted">Thousands of students have achieved their government service goals with us.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-light">
                        <div class="text-warning mb-3">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p class="text-dark font-italic mb-4">"The bilingual feature helped me understand complex legal terms in the Constitution paper. Highly recommended!"</p>
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary-blue text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 50px; height: 50px;">A</div>
                            <div>
                                <h6 class="fw-bold mb-0">Ankit Adhikari</h6>
                                <small class="text-muted">Section Officer Candidate</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-light">
                        <div class="text-warning mb-3">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p class="text-dark font-italic mb-4">"The performance analytics showed me exactly where I was lacking. My IQ scores improved by 40%."</p>
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-accent-orange text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 50px; height: 50px;">S</div>
                            <div>
                                <h6 class="fw-bold mb-0">Sunita Rai</h6>
                                <small class="text-muted">Nayab Subba Selected</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-light">
                        <div class="text-warning mb-3">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p class="text-dark font-italic mb-4">"Best interface for mock tests. It feels exactly like the real computer-based exam."</p>
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 50px; height: 50px;">B</div>
                            <div>
                                <h6 class="fw-bold mb-0">Bibek Thapa</h6>
                                <small class="text-muted">Kharidar Aspirant</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <h2 class="fw-bold mb-2">Latest from Our Blog</h2>
                    <p class="text-muted mb-0">Stay updated with the latest news and preparation strategies.</p>
                </div>
                <a href="{{ route('blogs.index') }}" class="btn btn-outline-primary border-primary-blue text-primary-blue rounded-pill px-4">View All Posts</a>
            </div>
            
            <div class="row g-4">
                @foreach([
                    ['title' => 'Top 10 Tips to Crack LokSewa Exams', 'tag' => 'Strategy', 'date' => 'May 15', 'img' => 'https://img.freepik.com/free-vector/blogging-concept-illustration_114360-788.jpg'],
                    ['title' => 'Understanding the New Exam Pattern 2081', 'tag' => 'News', 'date' => 'May 12', 'img' => 'https://img.freepik.com/free-vector/writing-concept-illustration_114360-1011.jpg'],
                    ['title' => 'Daily GK & Current Affairs Capsule', 'tag' => 'Daily GK', 'date' => 'May 10', 'img' => 'https://img.freepik.com/free-vector/reading-news-concept-illustration_114360-1013.jpg']
                ] as $blog)
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 hover-translate">
                        <img src="{{ $blog['img'] }}" class="card-img-top" alt="Blog" style="height: 200px; object-fit: cover;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="badge bg-primary-blue bg-opacity-10 text-primary-blue px-3 py-1 rounded-pill small fw-bold">{{ $blog['tag'] }}</span>
                                <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i> {{ $blog['date'] }}</span>
                            </div>
                            <h5 class="fw-bold mb-3">{{ $blog['title'] }}</h5>
                            <p class="text-muted small mb-4">Preparation is the key to success. Here are the top 10 strategies used by toppers to secure their dream job...</p>
                            <a href="#" class="text-primary-blue fw-bold text-decoration-none small d-flex align-items-center gap-2">
                                Read More <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5">
                    <h2 class="fw-bold mb-4">Frequently Asked Questions</h2>
                    <p class="text-muted mb-4">Everything you need to know about the platform and how to get the most out of it.</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary-custom rounded-pill">Contact Support</a>
                </div>
                <div class="col-lg-7">
                    <div class="accordion accordion-flush" id="faqAccordion">
                        <div class="accordion-item bg-transparent border-bottom">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent fw-bold text-dark px-0 py-4" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    How do I switch between Nepali and English?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body px-0 text-muted">
                                    Every study material and mock test has a language switcher toggle at the top right of the content area.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item bg-transparent border-bottom">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent fw-bold text-dark px-0 py-4" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Can I access materials offline?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body px-0 text-muted">
                                    Yes, premium members can download PDF notes and mock test results for offline viewing.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent fw-bold text-dark px-0 py-4" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Is there negative marking in mock tests?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body px-0 text-muted">
                                    Yes, our system calculates scores exactly like the LokSewa commission, including 20% negative marking for wrong answers.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-5">
        <div class="container">
            <div class="bg-primary-blue rounded-5 p-5 text-center text-white position-relative overflow-hidden shadow-lg">
                <div class="position-absolute top-0 end-0 opacity-10" style="width: 300px; height: 300px; background: white; border-radius: 50%; margin-top: -100px; margin-right: -100px;"></div>
                <h2 class="display-5 fw-bold mb-4">Start Your Preparation Today</h2>
                <p class="lead text-white-50 mb-5 max-w-2xl mx-auto">Join thousands of aspirants who are already ahead of the competition. Your government career starts here.</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ route('register') }}" class="btn btn-accent-custom btn-lg rounded-pill px-5">Join for Free</a>
                    <a href="{{ route('pricing') }}" class="btn btn-outline-light btn-lg rounded-pill px-4">View Premium Plans</a>
                </div>
            </div>
        </div>
    </section>
@endsection
