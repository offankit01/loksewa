@extends('layouts.main')

@section('title', $title . ' - Mock Tests | LokSewa Tayari')

@section('extra_css')
    <style>
        .subpage-header { background: var(--primary-blue); color: white; padding: 3rem 0; margin-bottom: 2rem; }
        .test-instruction-card { background: white; border: none; border-radius: 1rem; }
    </style>
@endsection

@section('content')
    <header class="subpage-header">
        <div class="container text-center">
            <h1 class="fw-bold mb-0">{{ $title }} Mock Tests</h1>
            <p class="text-white-50 mt-2 mb-0">Simulated exam environment to boost your confidence</p>
        </div>
    </header>

    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="test-instruction-card shadow-sm p-4 p-md-5">
                    <h3 class="fw-bold mb-4">Exam Instructions</h3>
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item border-0 px-0 d-flex gap-3">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <div><strong>Total Questions:</strong> 50 Multiple Choice Questions (MCQs)</div>
                        </li>
                        <li class="list-group-item border-0 px-0 d-flex gap-3">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <div><strong>Time Limit:</strong> 45 minutes from start.</div>
                        </li>
                        <li class="list-group-item border-0 px-0 d-flex gap-3">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <div><strong>Negative Marking:</strong> 20% marks will be deducted for each wrong answer.</div>
                        </li>
                        <li class="list-group-item border-0 px-0 d-flex gap-3">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <div><strong>Result:</strong> Instant score analysis and review available after submission.</div>
                        </li>
                    </ul>

                    <div class="p-4 bg-light rounded-4 mb-4 text-center">
                        <p class="mb-0 text-muted">Click the button below to start the session. Your timer will begin immediately.</p>
                    </div>

                    @auth
                        <a href="#" class="btn btn-accent-custom btn-lg w-100 rounded-pill py-3 fw-bold">
                            START MOCK TEST NOW <i class="bi bi-play-fill ms-1"></i>
                        </a>
                    @else
                        <div class="alert alert-warning rounded-4 border-0 mb-0 d-flex align-items-center gap-3">
                            <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                            <div>Please <a href="{{ route('login') }}" class="fw-bold">Log In</a> to start taking mock tests and track your history.</div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
