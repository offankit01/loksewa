@extends('layouts.main')

@section('title', $title . ' - Question Bank | LokSewa')

@section('content')
    <!-- Subpage Header -->
    <header class="py-5 bg-gradient-dark text-white overflow-hidden position-relative">
        <div class="hero-bg-overlay opacity-25"></div>
        <div class="container py-4 text-center position-relative z-1">
            <div class="badge-premium d-inline-flex align-items-center gap-2 mb-4 animate-fade-in mx-auto">
                <div class="badge-icon"><i class="bi bi-question-circle-fill"></i></div>
                <span class="badge-text">Resource Vault</span>
            </div>
            <h1 class="display-4 fw-extrabold text-white mb-3">{{ $title }} Question Bank</h1>
            <p class="lead text-white-50 mx-auto" style="max-width: 600px;">Access high-quality past papers and model questions curated by experts to sharpen your exam skills.</p>
        </div>
        <div class="cta-pattern"></div>
    </header>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row g-4">
                    @forelse($materials as $index => $material)
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 animate-slide-up" style="animation-delay: {{ $index * 0.1 }}s;">
                            <div class="card-body p-4 text-center">
                                <div class="badge rounded-pill px-3 py-1 mb-3 small fw-bold text-uppercase" 
                                     style="background-color: {{ $material->type == 'pyq' ? 'rgba(255, 136, 0, 0.1)' : 'rgba(30, 58, 138, 0.1)' }}; 
                                            color: {{ $material->type == 'pyq' ? '#ff8800' : 'var(--primary-blue)' }};">
                                    {{ $material->type == 'pyq' ? "Past Exam Paper" : "Model Question" }}
                                </div>
                                
                                <div class="icon-circle mx-auto mb-3" style="width: 70px; height: 70px; background-color: rgba(30, 58, 138, 0.05); color: var(--primary-blue);">
                                    <i class="bi {{ $material->type == 'pyq' ? 'bi-file-earmark-check' : 'bi-lightbulb' }} fs-2"></i>
                                </div>

                                <h5 class="fw-bold mb-4 px-2 lh-base" style="min-height: 3rem;">{{ $material->title }}</h5>
                                
                                <div class="d-flex flex-column gap-2">
                                    <a href="{{ Storage::url($material->file_path) }}" target="_blank" class="btn btn-accent-custom w-100 rounded-pill fw-bold shadow-sm py-2">
                                        <i class="bi bi-eye-fill me-2"></i> View Online
                                    </a>
                                    <a href="{{ Storage::url($material->file_path) }}" download class="btn btn-light w-100 rounded-pill fw-bold py-2 border border-light">
                                        <i class="bi bi-download me-2"></i> Download PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <div class="icon-circle bg-light text-muted mx-auto mb-4" style="width: 80px; height: 80px;">
                            <i class="bi bi-folder2-open fs-1"></i>
                        </div>
                        <h4 class="fw-bold text-dark">No Questions Found</h4>
                        <p class="text-muted">Our academic team is currently compiling past papers for this section.</p>
                        <a href="{{ route('service.show', $slug) }}" class="btn btn-primary-blue rounded-pill px-4 mt-3">Back to Overview</a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

