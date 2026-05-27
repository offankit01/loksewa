@extends('layouts.main')

@section('title', $title . ' - Study Notes | LokSewa')

@section('content')
    <!-- Subpage Header -->
    <header class="py-5 bg-gradient-dark text-white overflow-hidden position-relative">
        <div class="hero-bg-overlay opacity-25"></div>
        <div class="container py-4 text-center position-relative z-1">
            <div class="badge-premium d-inline-flex align-items-center gap-2 mb-4 animate-fade-in mx-auto">
                <div class="badge-icon"><i class="bi bi-book-half"></i></div>
                <span class="badge-text">Study Materials</span>
            </div>
            <h1 class="display-4 fw-extrabold text-white mb-3">{{ $title }} Study Notes</h1>
            <p class="lead text-white-50 mx-auto" style="max-width: 600px;">Master your syllabus with structured, expert-curated notes designed for rapid learning and retention.</p>
        </div>
        <div class="cta-pattern"></div>
    </header>

    <div class="container py-5">
        <div class="row justify-content-center">
            <!-- Notes List -->
            <div class="col-lg-9">
                <div class="d-flex align-items-center justify-content-between mb-5">
                    <h2 class="fw-bold mb-0">Available Chapters</h2>
                    <div class="badge-premium d-flex align-items-center gap-2">
                        <div class="badge-icon"><i class="bi bi-stack"></i></div>
                        <span class="badge-text">12 Total Chapters</span>
                    </div>
                </div>

                    @forelse ($materials as $index => $material)
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden animate-slide-up" style="animation-delay: {{ $index * 0.1 }}s;">
                        <div class="card-body p-4">
                            <div class="row align-items-center g-4">
                                <div class="col-auto">
                                    <div class="icon-circle text-primary-blue fs-4" style="width: 60px; height: 60px; background-color: rgba(30, 58, 138, 0.1);">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <span class="badge rounded-pill px-3 py-1 small border" style="background-color: rgba(30, 58, 138, 0.1); color: var(--primary-blue); border-color: rgba(30, 58, 138, 0.1);">{{ strtoupper($material->type) }}</span>
                                        <span class="text-muted small">• Published {{ $material->created_at->diffForHumans() }}</span>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-2">{{ $material->title }}</h5>
                                    <div class="d-flex align-items-center gap-4">
                                        <span class="text-muted small"><i class="bi bi-file-earmark-pdf me-1"></i> PDF Material</span>
                                        @if($material->is_premium)
                                            <span class="text-warning small fw-bold"><i class="bi bi-star-fill me-1"></i> Premium</span>
                                        @else
                                            <span class="text-success small fw-bold"><i class="bi bi-unlock-fill me-1"></i> Free Access</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-auto">
                                    <a href="{{ Storage::url($material->file_path) }}" target="_blank" class="btn btn-accent-custom rounded-pill px-4 py-2 fw-bold shadow-sm hover-scale">
                                        Download <i class="bi bi-download ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5">
                        <div class="icon-circle bg-light text-muted mx-auto mb-4" style="width: 80px; height: 80px;">
                            <i class="bi bi-folder2-open fs-1"></i>
                        </div>
                        <h4 class="fw-bold text-dark">No Notes Found</h4>
                        <p class="text-muted">We haven't uploaded any notes for this section yet. Please check back soon!</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

