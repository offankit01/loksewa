@extends('layouts.main')

@section('title', 'Knowledge Hub - LokSewa')

@section('content')
    <!-- Blog Hero -->
    <section class="py-5 bg-gradient-dark text-white overflow-hidden position-relative">
        <div class="hero-bg-overlay opacity-25"></div>
        <div class="container py-5 text-center position-relative z-1">
            <div class="badge-premium d-inline-flex align-items-center gap-2 mb-4 animate-fade-in mx-auto">
                <div class="badge-icon"><i class="bi bi-journal-bookmark-fill"></i></div>
                <span class="badge-text">Knowledge Hub</span>
            </div>
            <h1 class="display-3 fw-extrabold text-white mb-3">Preparation Guides & News</h1>
            <p class="lead text-white-50 mx-auto fs-4" style="max-width: 800px;">Stay ahead with expert insights, daily current affairs, and proven strategies for your career journey.</p>
        </div>
        <div class="cta-pattern"></div>
    </section>

    <!-- Blog Grid / Slider -->
    <section class="py-5 bg-soft-light">
        <div class="container py-4">
            <!-- Search & Filter Bar (Visual) -->
            <div class="row mb-5 justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-pill p-2 animate-slide-up">
                        <div class="row g-0 align-items-center">
                            <div class="col px-4">
                                <div class="input-group border-0">
                                    <span class="input-group-text bg-transparent border-0 text-muted"><i class="bi bi-search"></i></span>
                                    <input type="text" class="form-control border-0 bg-transparent shadow-none" placeholder="Search for articles, topics, or news...">
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary-blue rounded-pill px-4 py-2 fw-bold">Search Hub</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Blog Slider -->
            <div class="swiper blogIndexSwiper pb-5">
                <div class="swiper-wrapper">
                    @foreach($blogs as $blog)
                    <div class="swiper-slide h-auto">
                        <div class="blog-card-premium h-100">
                            <div class="blog-img-wrap">
                                <div class="blog-badge">Preparation</div>
                                <img src="{{ $blog['image'] }}" alt="{{ $blog['title'] }}">
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="blog-date-styled">
                                    <i class="bi bi-calendar3 text-primary-blue"></i> {{ $blog['date'] }}
                                </div>
                                <h4 class="fw-bold mb-3 lh-base">
                                    <a href="{{ route('blogs.show', $blog['slug']) }}" class="text-dark text-decoration-none hover-text-primary">{{ $blog['title'] }}</a>
                                </h4>
                                <p class="text-muted small mb-4 line-clamp-3">{{ $blog['excerpt'] }}</p>
                                
                                <div class="d-flex align-items-center justify-content-between mt-auto pt-3 border-top border-light">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="user-avatar-styled" style="width: 32px; height: 32px; font-size: 0.8rem; border-radius: 8px;">
                                            {{ strtoupper(substr($blog['author'], 0, 1)) }}
                                        </div>
                                        <span class="small fw-bold text-dark">{{ $blog['author'] }}</span>
                                    </div>
                                    <a href="{{ route('blogs.show', $blog['slug']) }}" class="btn btn-link text-primary-blue fw-bold text-decoration-none p-0 small">
                                        Read Full <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Custom Navigation Buttons -->
                <div class="d-flex justify-content-center gap-4 mt-5">
                    <div class="swiper-button-prev-index-custom shadow-lg">
                        <i class="bi bi-chevron-left fs-4"></i>
                    </div>
                    <div class="swiper-button-next-index-custom shadow-lg">
                        <i class="bi bi-chevron-right fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof Swiper !== 'undefined') {
                new Swiper('.blogIndexSwiper', {
                    slidesPerView: 1,
                    spaceBetween: 30,
                    loop: false,
                    speed: 800,
                    navigation: {
                        nextEl: '.swiper-button-next-index-custom',
                        prevEl: '.swiper-button-prev-index-custom',
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
            }
        });
    </script>
@endsection

