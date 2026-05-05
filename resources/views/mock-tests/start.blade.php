@extends('layouts.app')

@section('title', 'Start Mock Test - ' . $mockTest->title)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="bg-primary-blue p-5 text-center text-white">
                    <div class="bg-white bg-opacity-20 d-inline-flex p-3 rounded-circle mb-4">
                        <i class="bi bi-journal-check fs-1"></i>
                    </div>
                    <h2 class="fw-bold mb-2">{{ $mockTest->title }}</h2>
                    <p class="opacity-75 mb-0">{{ $mockTest->description }}</p>
                </div>
                
                <div class="card-body p-5">
                    <div class="row g-4 mb-5">
                        <div class="col-6">
                            <div class="p-3 bg-light rounded-4 text-center">
                                <div class="text-muted extra-small fw-bold text-uppercase mb-1">Time Limit</div>
                                <div class="fw-bold text-dark">{{ $mockTest->time_limit }} Minutes</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-light rounded-4 text-center">
                                <div class="text-muted extra-small fw-bold text-uppercase mb-1">Questions</div>
                                <div class="fw-bold text-dark">{{ $mockTest->questions->count() }} Total</div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('mock-tests.attempt', $mockTest) }}" method="POST">
                        @csrf
                        <h6 class="fw-bold mb-4">Choose Your Difficulty Level</h6>
                        
                        <div class="d-grid gap-3 mb-5">
                            <input type="radio" class="btn-check" name="difficulty" id="easy" value="easy" autocomplete="off">
                            <label class="btn btn-outline-success border-2 py-3 rounded-4 d-flex align-items-center justify-content-between px-4" for="easy">
                                <div class="text-start">
                                    <div class="fw-bold">Easy Mode</div>
                                    <div class="extra-small opacity-75">Basic questions, more time per question.</div>
                                </div>
                                <i class="bi bi-reception-1 fs-4"></i>
                            </label>

                            <input type="radio" class="btn-check" name="difficulty" id="medium" value="medium" autocomplete="off" checked>
                            <label class="btn btn-outline-warning border-2 py-3 rounded-4 d-flex align-items-center justify-content-between px-4" for="medium">
                                <div class="text-start">
                                    <div class="fw-bold">Standard Mode</div>
                                    <div class="extra-small opacity-75">Mixed difficulty, standard exam timing.</div>
                                </div>
                                <i class="bi bi-reception-2 fs-4"></i>
                            </label>

                            <input type="radio" class="btn-check" name="difficulty" id="hard" value="hard" autocomplete="off">
                            <label class="btn btn-outline-danger border-2 py-3 rounded-4 d-flex align-items-center justify-content-between px-4" for="hard">
                                <div class="text-start">
                                    <div class="fw-bold">Expert Mode</div>
                                    <div class="extra-small opacity-75">Complex analysis, strict timing.</div>
                                </div>
                                <i class="bi bi-reception-4 fs-4"></i>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary-blue w-100 py-3 rounded-pill fw-bold shadow-sm">
                            Begin Mock Test Now <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </form>

                    <div class="mt-4 text-center">
                        <p class="small text-muted mb-0">
                            <i class="bi bi-info-circle me-1"></i> Your progress is auto-saved. Do not refresh the page.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
