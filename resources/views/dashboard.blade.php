@extends('layouts.dashboard')

@section('title', 'User Dashboard')

@section('extra_css')
<style>
    .info-card {
        background: white;
        border-radius: 1.25rem;
        padding: 1.5rem;
        border: 1px solid rgba(0,0,0,0.03);
        transition: all 0.3s ease;
    }
    .info-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
    .icon-box {
        width: 54px;
        height: 54px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
    .course-card {
        background: linear-gradient(135deg, var(--primary-blue), #152c6e);
        color: white;
        border-radius: 1.5rem;
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }
    .course-card::after {
        content: '';
        position: absolute;
        width: 150px;
        height: 150px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        top: -50px;
        right: -50px;
    }
    .table-custom {
        background: white;
        border-radius: 1rem;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.03);
    }
    .table-custom thead { background: #f8f9fa; }
    .table-custom th { border: 0; padding: 1.25rem; font-weight: 700; color: var(--muted-text); }
    .table-custom td { padding: 1.25rem; vertical-align: middle; border-bottom: 1px solid rgba(0,0,0,0.02); }
</style>
@endsection

@section('dashboard_content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4 p-4" role="alert">
    <div class="d-flex align-items-center gap-3">
        <i class="bi bi-check-circle-fill fs-3"></i>
        <div>
            <h6 class="fw-bold mb-1">Success!</h6>
            <p class="mb-0 small">{{ session('success') }}</p>
        </div>
    </div>
    <button type="button" class="btn-close mt-2 me-2" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="row g-4 mb-5">
    <!-- Course Tracking -->
    <div class="col-lg-8">
        <div class="course-card h-100 shadow-sm">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <span class="badge bg-white text-primary-blue mb-3 px-3 py-2 rounded-pill fw-bold">Active Enrollment</span>
                    <h2 class="fw-bold mb-2">Nepal Administrative Service</h2>
                    <p class="text-white-50 mb-4">Section Officer (शाखा अधिकृत) - 2081 Batch</p>
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="flex-grow-1">
                            <div class="progress bg-white bg-opacity-20" style="height: 8px;">
                                <div class="progress-bar bg-accent-orange" style="width: 65%"></div>
                            </div>
                        </div>
                        <span class="fw-bold">65% Complete</span>
                    </div>
                    <a href="{{ route('services') }}" class="btn btn-accent-custom px-4 rounded-pill">Resume Learning</a>
                </div>
                <div class="col-md-5 d-none d-md-block text-center">
                    <i class="bi bi-mortarboard text-white-50" style="font-size: 8rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="col-lg-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="info-card shadow-sm d-flex align-items-center gap-4">
                    <div class="icon-box bg-success bg-opacity-10 text-success mb-0">
                        <i class="bi bi-journal-check"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">12</h3>
                        <p class="text-muted small mb-0">Mock Tests Appeared</p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="info-card shadow-sm d-flex align-items-center gap-4">
                    <div class="icon-box bg-primary-blue bg-opacity-10 text-primary-blue mb-0">
                        <i class="bi bi-trophy"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">84%</h3>
                        <p class="text-muted small mb-0">Highest Accuracy</p>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center">
                <div class="p-3 bg-white rounded-4 border border-dashed border-primary-blue border-opacity-25">
                    <p class="small text-muted mb-2">Preparation Streak</p>
                    <div class="d-flex justify-content-center gap-2">
                        @foreach(['S','M','T','W','T','F','S'] as $day)
                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold {{ $loop->index < 4 ? 'bg-primary-blue text-white' : 'bg-light text-muted' }}" style="width: 32px; height: 32px; font-size: 0.75rem;">
                                {{ $day }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Performance Table -->
    <div class="col-xl-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">Recent Mock Test Results</h5>
            <a href="{{ url('/mock-tests') }}" class="btn btn-link text-primary-blue fw-bold text-decoration-none small p-0">View All</a>
        </div>
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
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
                        @foreach([
                            ['name' => 'Section Officer - Paper I', 'score' => '62.00', 'accuracy' => '78%', 'status' => 'Passed', 'date' => 'May 02, 2026'],
                            ['name' => 'Kharidar - GK Set', 'score' => '45.50', 'accuracy' => '62%', 'status' => 'Passed', 'date' => 'Apr 28, 2026'],
                            ['name' => 'Nayab Subba - IQ', 'score' => '32.00', 'accuracy' => '40%', 'status' => 'Failed', 'date' => 'Apr 25, 2026']
                        ] as $result)
                        <tr>
                            <td class="px-4 border-0 py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-primary-blue bg-opacity-10 text-primary-blue p-2 rounded-3">
                                        <i class="bi bi-journal-check"></i>
                                    </div>
                                    <span class="fw-bold text-dark">{{ $result['name'] }}</span>
                                </div>
                            </td>
                            <td class="text-center border-0 py-3">
                                <div class="fw-bold">{{ $result['score'] }}</div>
                                <div class="small text-muted">{{ $result['accuracy'] }} Accuracy</div>
                            </td>
                            <td class="text-center border-0 py-3">
                                <span class="badge {{ $result['status'] == 'Passed' ? 'bg-success' : 'bg-danger' }} bg-opacity-10 {{ $result['status'] == 'Passed' ? 'text-success' : 'text-danger' }} px-3 py-2 rounded-pill small fw-bold">
                                    {{ $result['status'] }}
                                </span>
                            </td>
                            <td class="text-end px-4 border-0 py-3 text-muted small">{{ $result['date'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recommended Topics -->
    <div class="col-xl-4">
        <h5 class="fw-bold mb-4">Recommended for You</h5>
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
            <h6 class="fw-bold mb-3">Improve your IQ Score</h6>
            <p class="small text-muted mb-4">Based on your last test, you should focus on "Verbal Reasoning" topics.</p>
            <div class="d-flex flex-column gap-2">
                <div class="p-3 bg-light rounded-3 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-file-earmark-text text-primary-blue"></i>
                        <span class="small fw-bold">Reasoning Notes</span>
                    </div>
                    <i class="bi bi-chevron-right small text-muted"></i>
                </div>
                <div class="p-3 bg-light rounded-3 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-question-circle text-primary-blue"></i>
                        <span class="small fw-bold">Practice Questions</span>
                    </div>
                    <i class="bi bi-chevron-right small text-muted"></i>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
