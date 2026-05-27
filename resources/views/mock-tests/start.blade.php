@extends('layouts.main')

@section('title', 'Start Mock Test - ' . $mockTest->title)

@section('extra_css')
<style>
    .exam-start-card {
        background: white;
        border: 1px solid rgba(0,0,0,0.05);
        border-radius: 1.5rem;
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    .exam-start-header {
        background: linear-gradient(135deg, var(--primary-blue), #1e3a8a);
        padding: 4rem 3rem;
        position: relative;
    }
    .exam-start-header::after {
        content: '';
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        background: radial-gradient(circle at top right, rgba(255,255,255,0.1), transparent 60%);
        pointer-events: none;
    }
    .stat-pill {
        background: #f8fafc;
        border: 1px solid #f1f5f9;
        border-radius: 1rem;
        padding: 1.25rem 1rem;
        text-align: center;
        transition: all 0.2s ease;
    }
    .stat-pill:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.03);
        border-color: #e2e8f0;
    }
    .exam-rules-box {
        background: rgba(30, 58, 138, 0.03);
        border-left: 4px solid var(--primary-blue);
        border-radius: 0 1rem 1rem 0;
        padding: 1.5rem;
    }
    .btn-begin-exam {
        background: var(--primary-blue);
        color: white;
        padding: 1.25rem 2.5rem;
        border-radius: 50rem;
        font-weight: 700;
        font-size: 1.1rem;
        letter-spacing: 0.5px;
        box-shadow: 0 10px 25px rgba(30, 58, 138, 0.3);
        transition: all 0.3s ease;
        border: none;
    }
    .btn-begin-exam:hover {
        background: #1e3a8a;
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(30, 58, 138, 0.4);
        color: white;
    }
</style>
@endsection

@section('content')
<div class="container py-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="exam-start-card">
                {{-- Header Banner --}}
                <div class="exam-start-header text-center text-white">
                    <div class="bg-white bg-opacity-20 d-inline-flex p-4 rounded-circle mb-4 shadow-sm">
                        <i class="bi bi-shield-check fs-1"></i>
                    </div>
                    <span class="badge bg-accent-orange px-3 py-2 rounded-pill fw-bold mb-3 tracking-widest text-uppercase small">Official Examination</span>
                    <h2 class="fw-bolder mb-3 display-6 tracking-tight">{{ $mockTest->title }}</h2>
                    <p class="opacity-75 mb-0 px-md-5 fw-medium">{{ $mockTest->description ?? 'Official curated assessment designed to test your knowledge and readiness for the exam.' }}</p>
                </div>
                
                <div class="card-body p-4 p-md-5">
                    {{-- Exam Metadata Row --}}
                    <div class="row g-4 mb-5">
                        <div class="col-md-4">
                            <div class="stat-pill">
                                <div class="text-primary-blue fs-3 mb-2"><i class="bi bi-clock-history"></i></div>
                                <div class="text-muted extra-small fw-bold text-uppercase mb-1 tracking-wider">Time Limit</div>
                                <div class="fw-bolder text-dark fs-5">{{ $mockTest->time_limit }} Minutes</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-pill">
                                <div class="text-accent-orange fs-3 mb-2"><i class="bi bi-list-ol"></i></div>
                                <div class="text-muted extra-small fw-bold text-uppercase mb-1 tracking-wider">Questions</div>
                                <div class="fw-bolder text-dark fs-5">{{ $mockTest->questions->count() }} Total</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-pill">
                                <div class="text-success fs-3 mb-2"><i class="bi bi-bar-chart-line-fill"></i></div>
                                <div class="text-muted extra-small fw-bold text-uppercase mb-1 tracking-wider">Difficulty</div>
                                <div class="fw-bolder text-dark fs-5">{{ ucfirst($mockTest->difficulty) }} Level</div>
                            </div>
                        </div>
                    </div>

                    {{-- Important Instructions Callout --}}
                    <div class="exam-rules-box mb-5">
                        <h6 class="fw-bold text-primary-blue mb-3 d-flex align-items-center gap-2">
                            <i class="bi bi-info-circle-fill"></i> Examination Instructions & Rules
                        </h6>
                        <ul class="text-muted small mb-0 d-flex flex-column gap-2 ps-3">
                            <li><strong class="text-dark">Negative Marking Applies:</strong> Standard LokSewa penalty (20% deduction) will be applied for every incorrect answer.</li>
                            <li><strong class="text-dark">Admin Curated Set:</strong> The difficulty and question weighting for this set have been strictly configured by the examination board.</li>
                            <li><strong class="text-dark">No Page Refreshing:</strong> Do not refresh or close the browser tab during the test, as it may terminate your attempt.</li>
                            <li><strong class="text-dark">Auto-Submission:</strong> The examination will automatically submit when the countdown timer reaches zero.</li>
                        </ul>
                    </div>

                    {{-- Action Form --}}
                    <form action="{{ route('mock-tests.attempt', $mockTest) }}" method="POST" class="text-center">
                        @csrf
                        <input type="hidden" name="difficulty" value="{{ $mockTest->difficulty }}">
                        
                        <button type="submit" class="btn btn-begin-exam w-100 py-3 mb-3">
                            Begin Mock Test Now <i class="bi bi-arrow-right ms-2 fs-5 align-middle"></i>
                        </button>
                        
                        <p class="small text-muted mb-0 mt-3">
                            <i class="bi bi-lock-fill text-secondary me-1"></i> Secure session established. Best of luck!
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
