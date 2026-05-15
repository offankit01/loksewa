@extends('layouts.main')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center bg-light py-5 px-3">
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="max-width: 500px; width: 100%;">
        <div class="card-body p-5 text-center">
            <!-- Icon -->
            <div class="mb-4">
                <div class="bg-primary-blue bg-opacity-10 text-primary-blue d-inline-flex p-4 rounded-circle">
                    <i class="bi bi-shield-lock fs-1"></i>
                </div>
            </div>

            <!-- Title -->
            <h3 class="fw-bold text-dark mb-2">Verify Phone</h3>
            <p class="text-muted mb-4 small">
                We have sent a 6-digit verification code to your phone <br>
                <span class="fw-bold text-dark">{{ Auth::user()->phone }}</span>
            </p>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="alert alert-danger border-0 rounded-4 mb-4 small py-3 px-4 text-start">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li class="fw-bold">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success border-0 rounded-4 mb-4 small py-3 px-4 text-start fw-bold">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('otp.verify.submit') }}">
                @csrf
                <div class="mb-4">
                    <input type="text" name="otp" 
                           class="form-control form-control-lg text-center fw-bold fs-2 border-2 rounded-4" 
                           placeholder="000000" 
                           maxlength="6" 
                           required 
                           autofocus
                           style="letter-spacing: 10px;">
                </div>

                <button type="submit" class="btn btn-primary-blue w-100 py-3 rounded-4 fw-bold fs-5 mb-4 shadow-sm hover-lift">
                    VERIFY & CONTINUE <i class="bi bi-arrow-right ms-2"></i>
                </button>
            </form>

            <div class="d-flex justify-content-center align-items-center gap-2 small">
                <span class="text-muted">Didn't receive code?</span>
                <form method="POST" action="{{ route('otp.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 text-primary-blue fw-bold text-decoration-none small">
                        Resend Code
                    </button>
                </form>
            </div>

            <div class="mt-4 pt-4 border-top">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary btn-sm rounded-pill px-4">
                        <i class="bi bi-box-arrow-left me-2"></i>Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.hover-lift { transition: transform 0.2s; }
.hover-lift:hover { transform: translateY(-2px); }
.btn-primary-blue {
    background-color: #1e40af;
    border-color: #1e40af;
    color: white;
}
.btn-primary-blue:hover {
    background-color: #1e3a8a;
    border-color: #1e3a8a;
}
.text-primary-blue { color: #1e40af; }
</style>
@endsection
