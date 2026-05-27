@extends('layouts.main')

@section('title', 'Exam Result - ' . $result['title'])

@section('extra_css')
    <style>
        .result-header { background: #f8fafc; border-bottom: 1px solid #e2e8f0; padding: 4rem 0; }
        .score-circle { width: 180px; height: 180px; border-radius: 50%; border: 8px solid #e2e8f0; display: flex; flex-column: column; align-items: center; justify-content: center; margin: 0 auto; position: relative; }
        .score-circle.passed { border-color: #22c55e; color: #22c55e; }
        .score-circle.failed { border-color: #ef4444; color: #ef4444; }
        .stat-box { background: white; border-radius: 1.25rem; padding: 1.5rem; border: 1px solid #f1f5f9; text-align: center; height: 100%; }
    </style>
@endsection

@section('content')
    <div class="result-header">
        <div class="container text-center">
            <div class="badge bg-primary-blue bg-opacity-10 text-primary-blue px-3 py-2 rounded-pill mb-3 fw-bold">EXAM COMPLETED</div>
            <h1 class="fw-bold mb-4">Performance Analysis</h1>
            
            <div class="score-circle {{ $result['status'] == 'Passed' ? 'passed' : 'failed' }} mb-4 shadow-lg bg-white">
                <div>
                    <h1 class="display-4 fw-bold mb-0">{{ $result['score'] }}</h1>
                    <p class="small fw-bold text-uppercase mb-0">Total Score</p>
                </div>
            </div>
            
            <h3 class="fw-bold {{ $result['status'] == 'Passed' ? 'text-success' : 'text-danger' }} mb-2">
                {{ $result['status'] == 'Passed' ? 'Congratulations! You Passed' : 'Keep Practicing! You Failed' }}
            </h3>
            <p class="text-muted">Exam Date: {{ $result['date'] }}</p>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="stat-box shadow-sm">
                    <div class="text-primary-blue fs-2 mb-2"><i class="bi bi-question-circle"></i></div>
                    <h4 class="fw-bold mb-1">{{ $result['total_questions'] }}</h4>
                    <p class="text-muted small mb-0">Total Questions</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-box shadow-sm border-success border-opacity-25">
                    <div class="text-success fs-2 mb-2"><i class="bi bi-check-circle"></i></div>
                    <h4 class="fw-bold mb-1 text-success">{{ $result['correct'] }}</h4>
                    <p class="text-muted small mb-0">Correct Answers</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-box shadow-sm border-danger border-opacity-25">
                    <div class="text-danger fs-2 mb-2"><i class="bi bi-x-circle"></i></div>
                    <h4 class="fw-bold mb-1 text-danger">{{ $result['incorrect'] }}</h4>
                    <p class="text-muted small mb-0">Incorrect Answers</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-box shadow-sm">
                    <div class="text-warning fs-2 mb-2"><i class="bi bi-dash-circle"></i></div>
                    <h4 class="fw-bold mb-1 text-warning">{{ $result['unattempted'] }}</h4>
                    <p class="text-muted small mb-0">Unattempted</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white h-100">
                    <h5 class="fw-bold mb-4">Detailed Breakdown</h5>
                    <div class="d-flex justify-content-between mb-3 pb-3 border-bottom border-light">
                        <span class="text-muted">Accuracy</span>
                        <span class="fw-bold text-dark">{{ $result['percentage'] }}%</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 pb-3 border-bottom border-light">
                        <span class="text-muted">Total Marks</span>
                        <span class="fw-bold text-dark">{{ $result['total_questions'] * 2 }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 pb-3 border-bottom border-light">
                        <span class="text-muted">Negative Marks (Penalty)</span>
                        <span class="fw-bold text-danger">-{{ number_format($result['incorrect'] * 0.4, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Time Spent</span>
                        <span class="fw-bold text-dark">32:45 Mins</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-primary-blue text-white h-100">
                    <h5 class="fw-bold mb-4">What's Next?</h5>
                    <p class="text-white-50 mb-4">You have performed better than 75% of candidates who attempted this test today. Focus more on General Knowledge to improve your score.</p>
                    <div class="d-grid gap-3">
                        <a href="{{ route('dashboard') }}" class="btn btn-accent-custom rounded-pill fw-bold py-2">Go to Dashboard</a>
                        <a href="{{ route('mock-tests.start', $mockTest->slug) }}" class="btn btn-outline-light rounded-pill fw-bold py-2">Retake Test</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
