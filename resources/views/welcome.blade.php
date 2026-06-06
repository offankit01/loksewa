@extends('layouts.main')

@section('title', config('app.name', 'Lok Siksha') . ' - Home')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section py-5 overflow-hidden position-relative">
        <div class="hero-bg-overlay"></div>
        <div class="container position-relative z-1">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="badge-premium d-inline-flex align-items-center gap-2 mb-4 animate-fade-in">
                        <div class="badge-icon"><i class="bi bi-shield-check"></i></div>
                        <span class="badge-text">The Future of Lok Siksha Preparation</span>
                    </div>
                    <h1 class="display-2 fw-extrabold mb-4 lh-1">
                        Empower Your <br>
                        <span class="text-gradient">Lok Siksha</span> Journey
                    </h1>
                    <p class="lead text-muted mb-5 fs-4 fw-light">
                        Unlock your potential with the most advanced Lok Siksha platform. Expert notes, real-time analytics, and a community of success.
                    </p>
                    
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('register') }}" class="btn btn-primary-custom btn-lg rounded-pill px-5 py-3 shadow-xl hover-scale d-inline-flex align-items-center gap-2">
                            Get Started Free <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                        <a href="{{ route('services') }}" class="btn btn-outline-dark btn-lg rounded-pill px-4 py-3 fw-bold border-2 hover-bg-light">
                            View Study Roadmap
                        </a>
                    </div>
                    
                    <div class="mt-5 d-flex align-items-center gap-4 animate-slide-up">
                        <div class="d-flex overlap-avatars">
                            <div class="avatar-circle bg-light shadow-sm">A</div>
                            <div class="avatar-circle bg-primary-blue text-white shadow-sm">B</div>
                            <div class="avatar-circle bg-accent-orange text-white shadow-sm">+</div>
                        </div>
                        <div class="text-muted border-start ps-4">
                            <span class="fw-bold text-dark fs-5">50,000+</span> Aspirants already joined
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-visual position-relative">
                        <div class="hero-glow"></div>
                        <img src="{{ asset('assets/images/hero.png') }}" alt="Lok Siksha Learning" class="img-fluid rounded-5 shadow-2xl animate-float hero-main-img">
                        
                        <!-- Floating Glass Cards -->
                        <div class="glass-card p-3 rounded-4 shadow-lg position-absolute animate-float" style="top: 15%; right: -5%; z-index: 10;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle bg-success">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">98%</h6>
                                    <p class="small text-muted mb-0">Success Rate</p>
                                </div>
                            </div>
                        </div>

                        <div class="glass-card p-3 rounded-4 shadow-lg position-absolute animate-float-delayed" style="bottom: 15%; left: -5%; z-index: 10;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle bg-accent-orange">
                                    <i class="bi bi-lightning-charge-fill"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Smart Prep</h6>
                                    <p class="small text-muted mb-0">AI-Powered Insights</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Exam Categories -->
    <section class="py-5 bg-white position-relative overflow-hidden">
        <div class="container text-center mb-5">
            <h2 class="fw-extrabold display-5 mb-3">Popular Exam Categories</h2>
            <p class="text-muted max-w-2xl mx-auto">Specialized preparation for all major Lok Siksha positions in Nepal.</p>
        </div>
        <div class="container">
            <div class="row g-4">
                @foreach([
                    ['name' => 'Section Officer', 'icon' => 'bi-briefcase-fill', 'count' => '120+ Sets', 'color' => 'var(--primary-blue)'],
                    ['name' => 'Nayab Subba', 'icon' => 'bi-journal-check', 'count' => '95+ Sets', 'color' => '#6366f1'],
                    ['name' => 'Kharidar', 'icon' => 'bi-person-badge-fill', 'count' => '80+ Sets', 'color' => '#8b5cf6'],
                    ['name' => 'Bank & Finance', 'icon' => 'bi-bank2', 'count' => '60+ Sets', 'color' => '#ec4899'],
                    ['name' => 'Security Forces', 'icon' => 'bi-shield-shaded', 'count' => '50+ Sets', 'color' => '#10b981'],
                    ['name' => 'TSC (Teachers)', 'icon' => 'bi-mortarboard-fill', 'count' => '110+ Sets', 'color' => 'var(--accent-orange)']
                ] as $exam)
                <div class="col-md-4 col-lg-2">
                    <div class="category-card p-4 text-center h-100 hover-translate shadow-sm">
                        <div class="category-icon-wrapper mb-3" style="background-color: {{ $exam['color'] }}20; color: {{ $exam['color'] }};">
                            <i class="bi {{ $exam['icon'] }}"></i>
                        </div>
                        <h6 class="fw-bold mb-1 text-dark">{{ $exam['name'] }}</h6>
                        <span class="badge rounded-pill bg-light text-muted fw-normal">{{ $exam['count'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-light" id="features">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="badge-premium d-inline-flex align-items-center gap-2 mb-4 animate-fade-in">
                        <div class="badge-icon"><i class="bi bi-patch-check-fill"></i></div>
                        <span class="badge-text">Why Lok Siksha?</span>
                    </div>
                    <h2 class="display-5 fw-extrabold mb-4">Why Aspirants Choose Us?</h2>
                    <p class="text-muted mb-5 fs-5">We provide the most comprehensive ecosystem for your government job preparation journey, trusted by thousands of successful candidates.</p>
                    
                    <div class="row g-4">
                        @forelse($features as $feature)
                        <div class="col-md-6">
                            <div class="feature-card-premium p-4 h-100">
                                <div class="feature-icon-box bg-{{ $feature->theme_color }}">
                                    <i class="bi {{ $feature->icon }}"></i>
                                </div>
                                <h4 class="fw-bold mb-3">{{ $feature->title }}</h4>
                                <p class="text-muted small mb-0">{{ $feature->description }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="col-md-6">
                            <div class="feature-card-premium p-4">
                                <div class="feature-icon-box bg-primary-blue">
                                    <i class="bi bi-person-video3"></i>
                                </div>
                                <h4 class="fw-bold mb-3">Expert Mentorship</h4>
                                <p class="text-muted small mb-0">Get direct guidance and strategies from former Lok Siksha officers and toppers.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card-premium p-4">
                                <div class="feature-icon-box bg-accent-orange">
                                    <i class="bi bi-laptop"></i>
                                </div>
                                <h4 class="fw-bold mb-3">Smart Mock Tests</h4>
                                <p class="text-muted small mb-0">Real exam simulation with detailed AI-driven performance analytics.</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="position-relative">
                        <div class="feature-img-glow"></div>
                        <img src="{{ asset('assets/images/why-us.png') }}" alt="Lok Siksha Features" class="img-fluid rounded-5 shadow-2xl position-relative z-1">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-5 bg-gradient-dark text-white overflow-hidden position-relative">
        <div class="hero-bg-overlay opacity-25"></div>
        <div class="container text-center mb-5 position-relative z-1">
            <div class="badge bg-white bg-opacity-10 text-white px-3 py-2 rounded-pill mb-4 fw-bold">
                <i class="bi bi-gear-wide-connected me-1"></i> THE PROCESS
            </div>
            <h2 class="display-5 fw-extrabold text-white">How It Works</h2>
            <p class="text-white-50 fs-5">3 simple steps to achieve your government service goals</p>
        </div>
        <div class="container position-relative z-1">
            <div class="row g-5">
                <div class="col-md-4 position-relative">
                    <div class="flow-connector"></div>
                    <div class="step-card-glass text-center">
                        <div class="step-number-wrap">
                            <span class="step-number">1</span>
                            <div class="step-icon-overlay"><i class="bi bi-person-plus-fill"></i></div>
                        </div>
                        <h4 class="fw-bold mb-3">Register</h4>
                        <p class="text-white-50">Create your account in seconds and choose your targeted categories.</p>
                    </div>
                </div>
                <div class="col-md-4 position-relative">
                    <div class="flow-connector"></div>
                    <div class="step-card-glass text-center">
                        <div class="step-number-wrap">
                            <span class="step-number">2</span>
                            <div class="step-icon-overlay"><i class="bi bi-journal-text"></i></div>
                        </div>
                        <h4 class="fw-bold mb-3">Practice</h4>
                        <p class="text-white-50">Daily curated notes and unlimited high-quality mock tests.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-card-glass text-center">
                        <div class="step-number-wrap">
                            <span class="step-number">3</span>
                            <div class="step-icon-overlay"><i class="bi bi-trophy-fill"></i></div>
                        </div>
                        <h4 class="fw-bold mb-3">Succeed</h4>
                        <p class="text-white-50">Detailed performance insights to help you crack the real exam.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5 bg-soft-light">
        <div class="container">
            <div class="text-center mb-5">
                <div class="badge-premium d-inline-flex align-items-center gap-2 mb-4 animate-fade-in">
                    <div class="badge-icon"><i class="bi bi-chat-heart-fill"></i></div>
                    <span class="badge-text">Success Stories</span>
                </div>
                <h2 class="display-5 fw-extrabold mb-3">Voices of Success</h2>
                <p class="text-muted fs-5">Join thousands of students who have achieved their dreams with Lok Siksha.</p>
            </div>
            <div class="row g-4">
                @forelse($testimonials as $testimonial)
                <div class="col-md-4">
                    <div class="testimonial-card-premium h-100">
                        <div class="testimonial-quote"><i class="bi bi-quote"></i></div>
                        <div class="star-rating mb-3">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star{{ $i <= $testimonial->rating ? '-fill' : '' }}"></i>
                            @endfor
                        </div>
                        <p class="testimonial-content">"{{ $testimonial->content }}"</p>
                        <div class="d-flex align-items-center gap-3 mt-auto">
                            <div class="user-avatar-styled">
                                @if($testimonial->avatar)
                                    <img src="{{ Storage::url($testimonial->avatar) }}" class="w-100 h-100 object-fit-cover rounded-3" alt="User">
                                @else
                                    {{ strtoupper(substr($testimonial->user_name, 0, 1)) }}
                                @endif
                            </div>
                            <div>
                                <h6 class="user-name-styled mb-0">{{ $testimonial->user_name }}</h6>
                                <small class="user-designation-styled">{{ $testimonial->designation ?? 'Verified Student' }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                @foreach([
                    ['name' => 'Ankit Yadav', 'text' => 'Lok Siksha has transformed the way I prepare for LokSewa. The mock tests are incredibly realistic!', 'role' => 'Section Officer Aspirant'],
                    ['name' => 'Priya Sharma', 'text' => 'The bilingual notes are a lifesaver. I can switch between Nepali and English easily.', 'role' => 'Nayab Subba Candidate'],
                    ['name' => 'Suman Thapa', 'text' => 'I passed my Kharidar exam thanks to the consistent practice on this platform. Highly recommended!', 'role' => 'Successful Candidate']
                ] as $item)
                <div class="col-md-4">
                    <div class="testimonial-card-premium h-100">
                        <div class="testimonial-quote"><i class="bi bi-quote"></i></div>
                        <div class="star-rating mb-3">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-content">"{{ $item['text'] }}"</p>
                        <div class="d-flex align-items-center gap-3 mt-auto">
                            <div class="user-avatar-styled">
                                {{ strtoupper(substr($item['name'], 0, 1)) }}
                            </div>
                            <div>
                                <h6 class="user-name-styled mb-0">{{ $item['name'] }}</h6>
                                <small class="user-designation-styled">{{ $item['role'] }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="py-5 bg-white position-relative overflow-hidden">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-end mb-5 gap-4">
                <div>
                    <div class="badge-premium d-inline-flex align-items-center gap-2 mb-4 animate-fade-in">
                        <div class="badge-icon"><i class="bi bi-journal-bookmark-fill"></i></div>
                        <span class="badge-text">Knowledge Hub</span>
                    </div>
                    <h2 class="display-5 fw-extrabold mb-2">Latest from Our Blog</h2>
                    <p class="text-muted mb-0 fs-5">Stay updated with the latest news, prep strategies, and Lok Siksha insights.</p>
                </div>
                <a href="{{ route('blogs.index') }}" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-bold border-2 hover-bg-light">
                    View All Posts <i class="bi bi-arrow-up-right ms-1"></i>
                </a>
            </div>
            
            <!-- Blog Slider -->
            <div class="swiper blogSwiper pb-5">
                <div class="swiper-wrapper">
                    @forelse($blogs as $blog)
                    <div class="swiper-slide h-auto">
                        <div class="blog-card-premium h-100">
                            <div class="blog-img-wrap">
                                <div class="blog-badge">Preparation</div>
                                <img src="{{ $blog->image ? Storage::url($blog->image) : 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=800' }}" alt="{{ $blog->title }}">
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="blog-date-styled">
                                    <i class="bi bi-calendar3 text-primary-blue"></i> {{ $blog->created_at->format('M d, Y') }}
                                </div>
                                <h4 class="fw-bold mb-3 lh-base">
                                    <a href="{{ route('blogs.show', $blog->slug) }}" class="text-dark text-decoration-none hover-text-primary">{{ $blog->title }}</a>
                                </h4>
                                <p class="text-muted small mb-4 line-clamp-2">{{ $blog->excerpt }}</p>
                                
                                <div class="d-flex align-items-center justify-content-between mt-auto pt-3 border-top border-light">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="user-avatar-styled" style="width: 32px; height: 32px; font-size: 0.8rem; border-radius: 8px;">
                                            {{ strtoupper(substr($blog->author->name ?? 'A', 0, 1)) }}
                                        </div>
                                        <span class="small fw-bold text-dark">{{ $blog->author->name ?? 'Admin' }}</span>
                                    </div>
                                    <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-link text-primary-blue fw-bold text-decoration-none p-0 small">
                                        Read Full <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    @foreach([
                        ['title' => 'Top 10 Tips to Crack Lok Siksha Exams', 'tag' => 'Strategy', 'date' => 'May 15', 'img' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=800'],
                        ['title' => 'Daily Current Affairs: Nepal & Global', 'tag' => 'News', 'date' => 'May 14', 'img' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&q=80&w=800'],
                        ['title' => 'How to Master Mathematics for Exams', 'tag' => 'Study Guide', 'date' => 'May 12', 'img' => 'https://images.unsplash.com/photo-1635070041078-e363dbe005cb?auto=format&fit=crop&q=80&w=800']
                    ] as $blog)
                    <div class="swiper-slide h-auto">
                        <div class="blog-card-premium h-100">
                            <div class="blog-img-wrap">
                                <div class="blog-badge">{{ $blog['tag'] }}</div>
                                <img src="{{ $blog['img'] }}" alt="{{ $blog['title'] }}">
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="blog-date-styled">
                                    <i class="bi bi-calendar3 text-primary-blue"></i> {{ $blog['date'] }}, 2024
                                </div>
                                <h4 class="fw-bold mb-3 lh-base">
                                    <a href="#" class="text-dark text-decoration-none hover-text-primary">{{ $blog['title'] }}</a>
                                </h4>
                                <p class="text-muted small mb-4 line-clamp-2">Master the essential strategies and time management skills needed to ace your upcoming civil service examinations.</p>
                                
                                <div class="d-flex align-items-center justify-content-between mt-auto pt-3 border-top border-light">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="user-avatar-styled">A</div>
                                        <span class="small fw-bold text-dark">Admin</span>
                                    </div>
                                    <a href="#" class="btn btn-link text-primary-blue fw-bold text-decoration-none p-0 small">
                                        Read Full <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endforelse
                </div>
                
                <!-- Navigation Buttons -->
                <div class="d-flex justify-content-center gap-3 mt-5">
                    <div class="swiper-button-prev-custom">
                        <i class="bi bi-chevron-left"></i>
                    </div>
                    <div class="swiper-button-next-custom">
                        <i class="bi bi-chevron-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.blogSwiper', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                speed: 800,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next-custom',
                    prevEl: '.swiper-button-prev-custom',
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    }
                }
            });
        });
    </script>

    <!-- FAQ Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5">
                    <div class="badge-premium d-inline-flex align-items-center gap-2 mb-4 animate-fade-in">
                        <div class="badge-icon"><i class="bi bi-question-lg"></i></div>
                        <span class="badge-text">Support Center</span>
                    </div>
                    <h2 class="display-5 fw-extrabold mb-4">Frequently Asked Questions</h2>
                    <p class="text-muted mb-5 fs-5">Everything you need to know about the platform and how to get the most out of it.</p>
                    <a href="{{ route('contact') }}" class="btn btn-outline-dark rounded-pill px-5 py-3 fw-bold border-2 hover-bg-light">
                        Contact Support <i class="bi bi-headset ms-2"></i>
                    </a>
                </div>
                <div class="col-lg-7">
                    <div class="accordion accordion-flush" id="faqAccordion">
                        @forelse($faqs as $faq)
                        <div class="accordion-item bg-transparent faq-item-custom">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent fw-bold text-dark faq-btn-custom" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $faq->id }}">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="faq{{ $faq->id }}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body px-0 text-muted fs-6 pb-4">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                        @empty
                        @foreach([
                            ['q' => 'How do I get started with Lok Siksha?', 'a' => 'Simply click on the "Get Started" button, create a free account, and you can immediately access our basic study materials and trial mock tests.'],
                            ['q' => 'Is there a bilingual option for all materials?', 'a' => 'Yes! Lok Siksha is designed to be fully bilingual. You can switch between Nepali and English for most of our notes and exam sets.'],
                            ['q' => 'How often are the mock tests updated?', 'a' => 'Our expert team updates the test bank weekly to reflect the latest Lok Siksha patterns and current affairs.']
                        ] as $index => $item)
                        <div class="accordion-item bg-transparent faq-item-custom">
                            <h2 class="accordion-header">
                                <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }} bg-transparent fw-bold text-dark faq-btn-custom" type="button" data-bs-toggle="collapse" data-bs-target="#faqDef{{ $index }}">
                                    {{ $item['q'] }}
                                </button>
                            </h2>
                            <div id="faqDef{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                                <div class="accordion-body px-0 text-muted fs-6 pb-4">
                                    {{ $item['a'] }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="cta-block-premium text-center text-white">
                <div class="cta-pattern"></div>
                <div class="cta-pattern-2"></div>
                <div class="position-relative z-1">
                    <h2 class="display-3 fw-extrabold mb-4">Start Your Preparation Today</h2>
                    <p class="lead mb-5 opacity-75 max-w-2xl mx-auto">Join thousands of aspirants who are already ahead of the competition. Your government career starts here with Lok Siksha.</p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="{{ route('register') }}" class="btn btn-accent-custom btn-lg rounded-pill px-5 py-3 shadow-lg hover-scale">
                            Join for Free <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                        <a href="{{ route('services') }}" class="btn btn-outline-light btn-lg rounded-pill px-5 py-3 fw-bold border-2">
                            View Premium Plans
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
