@extends('layouts.main')

@section('title', $title . ' - Mock Tests | LokSewa Tayari')

@section('extra_css')
    <style>
        .subpage-header { background: var(--primary-blue); color: white; padding: 3rem 0; margin-bottom: 2rem; }
        .test-card { background: white; border: none; border-radius: 1rem; transition: all 0.3s ease; }
        .test-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    </style>
@endsection

@section('content')
    <header class="subpage-header">
        <div class="container text-center">
            <h1 class="fw-bold mb-0">{{ $title }} Exam Center</h1>
            <p class="text-white-50 mt-2 mb-0">Prepare with official mock tests curated by our expert team.</p>
        </div>
    </header>

    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h4 class="fw-bold mb-4 d-flex align-items-center gap-2">
                    <i class="bi bi-clipboard-check text-accent-orange"></i> Official Mock Tests
                </h4>
                
                <div class="row g-4">
                    @forelse($manualTests as $test)
                    <div class="col-md-6">
                        <div class="test-card p-4 shadow-sm border-start border-4 border-accent-orange">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="fw-bold mb-1">{{ $test->title }}</h5>
                                    <span class="badge bg-light text-dark extra-small">{{ ucfirst($test->difficulty) }} Level</span>
                                </div>
                                <div class="bg-accent-orange bg-opacity-10 text-accent-orange p-2 rounded-3">
                                    <i class="bi bi-file-earmark-text fs-4"></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <div class="small text-muted">
                                    <span class="me-3"><i class="bi bi-clock me-1"></i> {{ $test->time_limit }} mins</span>
                                    <span><i class="bi bi-list-ol me-1"></i> {{ $test->questions_count }} Qs</span>
                                </div>
                                <a href="{{ route('mock-tests.start', $test->slug) }}" class="btn btn-primary-blue rounded-pill px-4 fw-bold">Begin Test</a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5 bg-white rounded-4 shadow-sm">
                        <i class="bi bi-clipboard-x fs-1 text-muted opacity-25"></i>
                        <p class="mt-3 text-muted">No official mock tests uploaded for this section yet.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
