@extends('layouts.dashboard')

@section('title', 'Performance Analytics')

@section('extra_css')
<style>
    .trend-container {
        height: 200px;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        padding: 0 10px;
        margin-top: 2rem;
    }
    .trend-bar-wrapper {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }
    .trend-bar {
        width: 40px;
        background: rgba(30, 58, 138, 0.1);
        border-radius: 8px 8px 0 0;
        transition: all 0.5s ease;
        position: relative;
    }
    .trend-bar:hover {
        background: var(--primary-blue);
        box-shadow: 0 0 15px rgba(30, 58, 138, 0.3);
    }
    .trend-bar::after {
        content: attr(data-score) '%';
        position: absolute;
        top: -25px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--primary-blue);
        opacity: 0;
        transition: opacity 0.3s;
    }
    .trend-bar:hover::after { opacity: 1; }
    
    .subject-pill {
        background: white;
        border-radius: 1rem;
        padding: 1.5rem;
        border: 1px solid rgba(0,0,0,0.03);
        margin-bottom: 1rem;
    }
    
    .rank-badge {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent-orange), #ea580c);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        font-weight: 800;
        box-shadow: 0 10px 20px rgba(249, 115, 22, 0.3);
        margin: 0 auto 1.5rem;
    }
</style>
@endsection

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h3 class="fw-bold mb-1">Performance Analytics</h3>
        <p class="text-muted small mb-0">Deep dive into your preparation progress and competitive standing</p>
    </div>
    <div class="dropdown">
        <button class="btn btn-white bg-white shadow-sm dropdown-toggle rounded-pill px-4" type="button" data-bs-toggle="dropdown">
            Last 6 Months
        </button>
        <ul class="dropdown-menu border-0 shadow-sm">
            <li><a class="dropdown-item" href="#">Last Month</a></li>
            <li><a class="dropdown-item" href="#">Last 3 Months</a></li>
            <li><a class="dropdown-item" href="#">All Time</a></li>
        </ul>
    </div>
</div>

<div class="row g-4 mb-5">
    <!-- Score Trend Chart -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
            <h5 class="fw-bold mb-2">Score Trend</h5>
            <p class="small text-muted mb-0">Your average mock test scores over the recent months</p>
            
            <div class="trend-container">
                @foreach($monthlyProgress as $data)
                <div class="trend-bar-wrapper">
                    <div class="trend-bar" 
                         style="height: {{ $data['score'] * 1.8 }}px;" 
                         data-score="{{ $data['score'] }}"></div>
                    <span class="small text-muted">{{ $data['month'] }}</span>
                </div>
                @endforeach
            </div>
            
            <div class="mt-4 pt-3 border-top border-light d-flex gap-4">
                <div class="d-flex align-items-center gap-2">
                    <span class="rounded-circle" style="width: 10px; height: 10px; background: var(--primary-blue);"></span>
                    <span class="small text-muted">Monthly Avg.</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="text-success small fw-bold">+12% growth</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Competitive Standing -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100 text-center">
            <h5 class="fw-bold mb-4">Global Standing</h5>
            <div class="rank-badge">
                {{ $stats['rank'] }}
            </div>
            <h4 class="fw-bold mb-1">{{ $stats['percentile'] }}</h4>
            <p class="small text-muted mb-4">Top percentile among all aspirants</p>
            
            <hr class="opacity-10 mb-4">
            
            <div class="row g-2">
                <div class="col-6 text-start">
                    <div class="text-muted small">Avg. Speed</div>
                    <div class="fw-bold">{{ $stats['avg_time'] }} / qstn</div>
                </div>
                <div class="col-6 text-start">
                    <div class="text-muted small">Consistency</div>
                    <div class="fw-bold text-success">Excellent</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Subject Breakdown -->
    <div class="col-lg-6">
        <h5 class="fw-bold mb-4">Subject-wise Mastery</h5>
        @foreach($subjectPerformance as $subject)
        <div class="subject-pill shadow-sm">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="fw-bold text-dark">{{ $subject['subject'] }}</div>
                <div class="fw-bold {{ $subject['score'] > 80 ? 'text-success' : ($subject['score'] > 60 ? 'text-primary' : 'text-danger') }}">
                    {{ $subject['score'] }}%
                </div>
            </div>
            <div class="progress bg-light" style="height: 8px;">
                <div class="progress-bar {{ $subject['color'] }}" style="width: {{ $subject['score'] }}%"></div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Insights & Goals -->
    <div class="col-lg-6">
        <h5 class="fw-bold mb-4">Personal Insights</h5>
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
            <div class="d-flex align-items-start gap-3 mb-4">
                <div class="bg-success bg-opacity-10 text-success p-2 rounded-3">
                    <i class="bi bi-lightbulb-fill fs-4"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-1">Strongest Area</h6>
                    <p class="small text-muted mb-0">You are performing exceptionally well in **Current Affairs**. Keep up the daily reading!</p>
                </div>
            </div>
            
            <div class="d-flex align-items-start gap-3 mb-4">
                <div class="bg-warning bg-opacity-10 text-warning p-2 rounded-3">
                    <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-1">Improvement Needed</h6>
                    <p class="small text-muted mb-0">Your **IQ & Aptitude** score has dipped slightly. We recommend focused practice on "Arithmetic Reasoning".</p>
                </div>
            </div>
            
            <div class="mt-auto">
                <h6 class="fw-bold mb-3 small text-uppercase letter-spacing-1 text-muted">Preparation Goal</h6>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="small fw-bold">Daily Quiz Target</span>
                    <span class="small text-muted">4/5 completed</span>
                </div>
                <div class="progress bg-light" style="height: 6px;">
                    <div class="progress-bar bg-accent-orange" style="width: 80%"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
