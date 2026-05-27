@extends('layouts.dashboard')

@section('title', 'My Mock Tests')

@section('extra_css')
    <style>
        .stat-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            border: 1px solid rgba(0,0,0,0.05);
            text-align: center;
            transition: all 0.3s ease;
        }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
        .stat-value { font-size: 2.5rem; font-weight: 800; color: var(--primary-blue); }
        .stat-label { font-size: 0.85rem; color: var(--muted-text); text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }
        
        .topic-progress { margin-bottom: 1.5rem; }
        .progress { height: 10px; border-radius: 5px; }
        
        .mock-test-card {
            background: white;
            border: 1px solid rgba(0,0,0,0.05);
            border-radius: 1.25rem;
            transition: all 0.3s ease;
        }
        .mock-test-card:hover {
            border-color: var(--primary-blue);
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }
    </style>
@endsection

@section('dashboard_content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">My Mock Tests</h3>
            <p class="text-muted small mb-0">Track your performance and start new practice sets</p>
        </div>

    </div>

    @auth
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="stat-card shadow-sm">
                <div class="stat-value">{{ $totalTests }}</div>
                <div class="stat-label">Tests Taken</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card shadow-sm">
                <div class="stat-value">{{ number_format($avgScore, 1) }}%</div>
                <div class="stat-label">Avg. Score</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card shadow-sm">
                <div class="stat-value text-accent-orange">{{ number_format($accuracy, 1) }}%</div>
                <div class="stat-label">Accuracy</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card shadow-sm">
                <div class="stat-value text-success">
                    @if($accuracy > 80) A+ @elseif($accuracy > 60) B @else C @endif
                </div>
                <div class="stat-label">Current Grade</div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <h5 class="fw-bold mb-4">Weak Topic Analysis</h5>
                @foreach($weakTopics as $topic)
                <div class="topic-progress">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="fw-medium text-dark">{{ $topic['name'] }}</span>
                        <span class="text-muted">{{ $topic['score'] }}%</span>
                    </div>
                    <div class="progress bg-light">
                        <div class="progress-bar @if($topic['score'] < 40) bg-danger @elseif($topic['score'] < 70) bg-warning @else bg-success @endif" 
                             style="width: {{ $topic['score'] }}%"></div>
                    </div>
                </div>
                @endforeach
                <p class="small text-muted mt-3 mb-0"><i class="bi bi-info-circle me-1"></i> These topics require more attention based on your recent attempts.</p>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <h5 class="fw-bold mb-4">Progress Insights</h5>
                <div class="d-flex align-items-center gap-4 mb-4 pb-3 border-bottom border-light">
                    <div class="bg-primary-blue bg-opacity-10 text-primary-blue p-3 rounded-circle">
                        <i class="bi bi-calendar-check fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Consistency</h6>
                        <p class="small text-muted mb-0">You've taken tests 3 days in a row!</p>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-4">
                    <div class="bg-accent-orange bg-opacity-10 text-accent-orange p-3 rounded-circle">
                        <i class="bi bi-lightning-fill fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Speed Factor</h6>
                        <p class="small text-muted mb-0">Average time per question: 42s</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endauth


    <h4 class="fw-bold mb-4 mt-5">Your Attempt History</h4>
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-5">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 text-muted small fw-bold px-4 py-3">EXAM NAME</th>
                        <th class="border-0 text-muted small fw-bold py-3 text-center">SCORE</th>
                        <th class="border-0 text-muted small fw-bold py-3 text-center">STATUS</th>
                        <th class="border-0 text-muted small fw-bold py-3 text-end px-4">DATE</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attempts as $attempt)
                    <tr>
                        <td class="px-4 border-0 py-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary-blue bg-opacity-10 text-primary-blue p-2 rounded-3">
                                    <i class="bi bi-journal-check"></i>
                                </div>
                                <span class="fw-bold text-dark">{{ $attempt->mockTest->title ?? 'Deleted Exam' }}</span>
                            </div>
                        </td>
                        <td class="text-center border-0 py-3">
                            <div class="fw-bold">{{ number_format($attempt->score, 2) }}</div>
                            <div class="small text-muted">{{ $attempt->total_questions > 0 ? number_format(($attempt->correct_answers / $attempt->total_questions) * 100, 1) : 0 }}% Accuracy</div>
                        </td>
                        <td class="text-center border-0 py-3">
                            @php
                                $isPassed = $attempt->total_questions > 0 && ($attempt->score / ($attempt->total_questions * 2)) >= 0.4;
                            @endphp
                            <span class="badge {{ $isPassed ? 'bg-success' : 'bg-danger' }} bg-opacity-10 {{ $isPassed ? 'text-success' : 'text-danger' }} px-3 py-2 rounded-pill small fw-bold">
                                {{ $isPassed ? 'Passed' : 'Failed' }}
                            </span>
                        </td>
                        <td class="text-end px-4 border-0 py-3 text-muted small">{{ $attempt->completed_at ? $attempt->completed_at->format('M d, Y') : $attempt->created_at->format('M d, Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="bi bi-clipboard-x fs-2 d-block mb-2 opacity-25"></i>
                            You haven't taken any mock tests yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
