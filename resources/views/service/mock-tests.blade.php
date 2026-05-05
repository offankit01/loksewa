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
            <p class="text-white-50 mt-2 mb-0">Choose between official manual tests or AI-powered practice</p>
        </div>
    </header>

    <div class="container pb-5">
        <div class="row g-4">
            {{-- AI Practice Section --}}
            <div class="col-lg-7">
                <h4 class="fw-bold mb-4 d-flex align-items-center gap-2">
                    <i class="bi bi-robot text-primary-blue"></i> AI-Powered Personal Practice
                </h4>
                <p class="text-muted small mb-4">AI will automatically generate fresh questions based on the specific notes and PDFs in this section.</p>
                
                <div class="d-flex flex-column gap-3">
                    @forelse($materials as $material)
                    <div class="test-card p-4 d-flex align-items-center justify-content-between shadow-sm border-start border-4 border-primary-blue">
                        <div>
                            <div class="extra-small text-uppercase fw-bold text-primary-blue mb-1">Practice from Note</div>
                            <h5 class="fw-bold mb-1">{{ $material->title }}</h5>
                            <div class="d-flex gap-3 small text-muted">
                                <span><i class="bi bi-question-circle me-1"></i> 10 Questions</span>
                                <span><i class="bi bi-clock me-1"></i> 15 Mins</span>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-primary-blue rounded-pill px-4 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Start AI Test
                            </button>
                            <ul class="dropdown-menu border-0 shadow-lg rounded-3">
                                <li><h6 class="dropdown-header extra-small text-uppercase">Select Difficulty</h6></li>
                                <li><a class="dropdown-item py-2" href="{{ route('materials.generate-test', ['material' => $material->slug, 'difficulty' => 'easy']) }}"><i class="bi bi-reception-1 text-success me-2"></i>Easy Level</a></li>
                                <li><a class="dropdown-item py-2" href="{{ route('materials.generate-test', ['material' => $material->slug, 'difficulty' => 'medium']) }}"><i class="bi bi-reception-2 text-warning me-2"></i>Medium Level</a></li>
                                <li><a class="dropdown-item py-2" href="{{ route('materials.generate-test', ['material' => $material->slug, 'difficulty' => 'hard']) }}"><i class="bi bi-reception-4 text-danger me-2"></i>Hard Level</a></li>
                            </ul>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                        <i class="bi bi-journal-x fs-1 text-muted opacity-25"></i>
                        <p class="mt-3 text-muted">No notes found in this section to generate tests from.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- Manual Tests Sidebar --}}
            <div class="col-lg-5">
                <h4 class="fw-bold mb-4 d-flex align-items-center gap-2">
                    <i class="bi bi-clipboard-check text-accent-orange"></i> Official Manual Tests
                </h4>
                <p class="text-muted small mb-4">Official mock tests curated by our expert team.</p>

                <div class="d-flex flex-column gap-3">
                    @forelse($manualTests as $test)
                    <div class="test-card p-3 shadow-sm border-start border-4 border-accent-orange">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="fw-bold mb-0">{{ $test->title }}</h6>
                            <span class="badge bg-light text-dark extra-small">{{ ucfirst($test->difficulty) }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="extra-small text-muted">
                                <i class="bi bi-clock me-1"></i> {{ $test->time_limit }} mins | <i class="bi bi-list-ol me-1"></i> {{ $test->questions_count }} Qs
                            </div>
                            <a href="{{ route('mock-tests.start', $test->slug) }}" class="btn btn-sm btn-outline-accent rounded-pill px-3">Begin Test</a>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                        <p class="text-muted small">No official manual tests uploaded yet.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
