@extends('layouts.dashboard')

@section('title', 'Platform Settings')

@section('extra_css')
<style>
    .settings-container {
        max-width: 900px;
        margin: 0 auto;
    }
    
    .settings-content {
        display: flex;
        flex-direction: column;
        gap: 2.5rem;
    }

    .settings-section-card {
        background: white;
        border-radius: 1.5rem;
        border: 1px solid rgba(0,0,0,0.03);
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }
    
    .settings-section-header {
        padding: 2rem 2.5rem;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fafbfc;
    }
    
    .settings-section-body {
        padding: 2.5rem;
    }

    .feature-toggle-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem;
        border: 1px solid #f1f5f9;
        border-radius: 1.25rem;
        margin-bottom: 1rem;
        transition: all 0.2s;
        background: #ffffff;
    }
    
    .feature-toggle-item:hover {
        background: #f8fafc;
        border-color: var(--primary-blue);
        transform: translateY(-2px);
    }

    .session-item {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        padding: 1.5rem;
        background: #f8fafc;
        border-radius: 1.25rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        transition: all 0.2s;
    }
    
    .session-item:hover {
        border-color: #e2e8f0;
        background: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .form-control-custom {
        border-radius: 14px;
        padding: 0.9rem 1.25rem;
        border: 2px solid #f1f5f9;
        background: #f8fafc;
        transition: all 0.2s;
    }

    .form-control-custom:focus {
        border-color: var(--primary-blue);
        background: white;
        box-shadow: 0 0 0 4px rgba(30, 58, 138, 0.1);
        outline: none;
    }

    .btn-save-custom {
        background: var(--primary-blue);
        color: white;
        padding: 1rem 3rem;
        border-radius: 14px;
        font-weight: 700;
        border: none;
        transition: all 0.3s;
        box-shadow: 0 10px 20px rgba(30, 58, 138, 0.2);
    }

    /* Rating Stars */
    .rating-stars {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
        gap: 0.5rem;
    }
    .rating-stars input {
        display: none;
    }
    .rating-stars label {
        cursor: pointer;
        font-size: 2rem;
        color: #e2e8f0;
        transition: color 0.2s;
    }
    .rating-stars input:checked ~ label,
    .rating-stars label:hover,
    .rating-stars label:hover ~ label {
        color: #fbbf24;
    }
</style>
@endsection

@section('dashboard_content')
<div class="mb-5 text-center">
    <h2 class="fw-bold mb-2">Platform Settings</h2>
    <p class="text-muted">Manage your security, identity, and preferences</p>
</div>

{{-- Flash Messages --}}
@if(session('status') === 'email-updated')
    <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> <strong>Email updated!</strong> A verification link has been sent to your new address.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@elseif(session('status') === 'verification-sent')
    <div class="alert alert-info alert-dismissible fade show rounded-4 mb-4 shadow-sm" role="alert">
        <i class="bi bi-envelope-fill me-2"></i> <strong>Verification email sent!</strong> Please check your inbox.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@elseif(session('status') === 'notifications-updated')
    <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 shadow-sm" role="alert">
        <i class="bi bi-bell-fill me-2"></i> <strong>Notification preferences saved!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@elseif(session('status') === '2fa-enabled')
    <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 shadow-sm" role="alert">
        <i class="bi bi-shield-fill-check me-2"></i> <strong>Two-Factor Authentication enabled!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@elseif(session('status') === '2fa-disabled')
    <div class="alert alert-warning alert-dismissible fade show rounded-4 mb-4 shadow-sm" role="alert">
        <i class="bi bi-shield-exclamation me-2"></i> <strong>Two-Factor Authentication disabled.</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@elseif(session('status') === 'sessions-cleared')
    <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 shadow-sm" role="alert">
        <i class="bi bi-display me-2"></i> <strong>All other sessions have been logged out.</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@elseif(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="settings-container">
    <div class="settings-content">

        {{-- Feedback & Testimonial --}}
        <section id="feedback" class="settings-section-card shadow-sm">
            <div class="settings-section-header">
                <h5 class="fw-bold mb-0">Feedback & Testimonial</h5>
                @if($testimonial)
                    @if($testimonial->is_active)
                        <span class="badge bg-success bg-opacity-10 text-success px-4 py-2 rounded-pill"><i class="bi bi-check-circle-fill me-1"></i> Published</span>
                    @else
                        <span class="badge bg-warning bg-opacity-10 text-warning px-4 py-2 rounded-pill"><i class="bi bi-clock-history me-1"></i> Pending Review</span>
                    @endif
                @endif
            </div>
            <div class="settings-section-body">
                <p class="text-muted small mb-4">Share your experience with LokSiksha. Your testimonial helps others choose the right preparation platform.</p>
                
                <form method="POST" action="{{ route('testimonials.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-uppercase">Your Rating</label>
                        <div class="rating-stars">
                            @for($i = 5; $i >= 1; $i--)
                                <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" {{ ($testimonial && $testimonial->rating == $i) || (!$testimonial && $i == 5) ? 'checked' : '' }}>
                                <label for="star{{ $i }}"><i class="bi bi-star-fill"></i></label>
                            @endfor
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-uppercase">Your Review</label>
                        <textarea name="content" class="form-control form-control-custom @error('content') is-invalid @enderror" 
                                  rows="4" placeholder="How has LokSiksha helped you in your preparation?" required>{{ old('content', $testimonial->content ?? '') }}</textarea>
                        @error('content')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-save-custom w-100">
                        {{ $testimonial ? 'Update Testimonial' : 'Submit Testimonial' }}
                    </button>
                </form>
            </div>
        </section>

        {{-- Email & Identity --}}
        <section id="identity" class="settings-section-card shadow-sm">
            <div class="settings-section-header">
                <h5 class="fw-bold mb-0">Email & Identity</h5>
                @if($user->email_verified_at)
                    <span class="badge bg-success bg-opacity-10 text-success px-4 py-2 rounded-pill"><i class="bi bi-patch-check-fill me-1"></i> Verified</span>
                @else
                    <span class="badge bg-warning bg-opacity-10 text-warning px-4 py-2 rounded-pill"><i class="bi bi-exclamation-triangle-fill me-1"></i> Unverified</span>
                @endif
            </div>
            <div class="settings-section-body">
                <form method="POST" action="{{ route('settings.email') }}" class="mb-4">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 rounded-start-4"><i class="bi bi-envelope text-muted"></i></span>
                            <input type="email" name="email" class="form-control form-control-custom border-start-0 rounded-end-4 @error('email') is-invalid @enderror"
                                   value="{{ old('email', $user->email) }}" required>
                        </div>
                        @error('email')
                            <div class="text-danger small mt-2"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn-save-custom w-100">Update Email Address</button>
                </form>

                @if(!$user->hasVerifiedEmail())
                <div class="p-3 bg-warning bg-opacity-10 rounded-4 border border-warning border-opacity-20">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="small text-warning-emphasis mb-0 fw-bold"><i class="bi bi-exclamation-triangle me-1"></i>Your email address is not verified.</p>
                        </div>
                        <form method="POST" action="{{ route('settings.verification') }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-warning rounded-pill px-3 fw-bold">Resend Link</button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </section>

        {{-- Password & Security --}}
        <section id="security" class="settings-section-card shadow-sm">
            <div class="settings-section-header">
                <h5 class="fw-bold mb-0">Password & Security</h5>
            </div>
            <div class="settings-section-body">
                @include('profile.partials.update-password-form')
            </div>
        </section>

        {{-- Two-Step Authentication --}}
        <section id="2fa" class="settings-section-card shadow-sm">
            <div class="settings-section-header">
                <h5 class="fw-bold mb-0">Two-Step Authentication</h5>
                @if($user->two_fa_enabled)
                    <span class="badge bg-success bg-opacity-10 text-success px-4 py-2 rounded-pill"><i class="bi bi-shield-check me-1"></i> Active</span>
                @else
                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-4 py-2 rounded-pill"><i class="bi bi-shield me-1"></i> Inactive</span>
                @endif
            </div>
            <div class="settings-section-body">
                <div class="d-flex align-items-start gap-4 mb-4 p-4 bg-primary-blue bg-opacity-5 rounded-4 border border-primary-blue border-opacity-10">
                    <div class="bg-primary-blue text-white p-3 rounded-4 shadow-sm">
                        <i class="bi bi-shield-lock-fill fs-3"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-2">Secure your account</h6>
                        <p class="text-muted small mb-0">Two-step authentication adds an extra layer of security by requiring a code from your authenticator app every time you log in.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('settings.2fa') }}" id="form2FA">
                    @csrf
                    <div class="feature-toggle-item">
                        <div>
                            <h6 class="fw-bold mb-1">Enable Two-Step Authentication</h6>
                            <p class="text-muted small mb-0">Use an authenticator app like Google Authenticator or Authy.</p>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="toggle2FA" {{ $user->two_fa_enabled ? 'checked' : '' }} onchange="this.form.submit()">
                        </div>
                    </div>
                </form>

                @if($user->two_fa_enabled)
                <div class="mt-4 p-4 border border-success border-opacity-20 rounded-4 bg-success bg-opacity-5">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-check-circle-fill text-success fs-4"></i>
                        <div>
                            <div class="fw-bold">2FA is Active</div>
                            <div class="text-muted small">Your account is protected with two-step authentication.</div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>

        {{-- Active Sessions --}}
        <section id="sessions" class="settings-section-card shadow-sm">
            <div class="settings-section-header">
                <h5 class="fw-bold mb-0">Active Sessions</h5>
            </div>
            <div class="settings-section-body">
                <p class="text-muted small mb-4">These are the devices currently logged into your account. You can sign out of all other sessions if you suspect unauthorized access.</p>

                <div class="session-item mb-3">
                    <div class="bg-primary-blue bg-opacity-10 text-primary-blue p-3 rounded-circle">
                        <i class="bi bi-display fs-5"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="fw-bold mb-1">Current Session</h6>
                        <p class="text-muted small mb-0 text-truncate" style="max-width: 300px;">{{ request()->userAgent() }}</p>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-bold">Active Now</span>
                </div>

                <form method="POST" action="{{ route('settings.logout-sessions') }}" class="mt-4 p-4 border rounded-4 bg-light">
                    @csrf
                    <h6 class="fw-bold mb-3">Sign out of all other devices</h6>
                    <p class="text-muted small mb-3">Enter your password to confirm you want to sign out of all other browser sessions.</p>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control form-control-custom @error('password', 'logoutSessions') is-invalid @enderror"
                               placeholder="Your current password" required>
                        @error('password', 'logoutSessions')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-outline-danger rounded-pill px-4 fw-bold">Sign Out Other Devices</button>
                </form>
            </div>
        </section>

        {{-- Notification Preferences --}}
        <section id="notifications" class="settings-section-card shadow-sm">
            <div class="settings-section-header">
                <h5 class="fw-bold mb-0">Notification Preferences</h5>
            </div>
            <div class="settings-section-body">
                <form method="POST" action="{{ route('settings.notifications') }}">
                    @csrf
                    @method('PATCH')

                    <div class="feature-toggle-item">
                        <div>
                            <h6 class="fw-bold mb-1">Email Newsletter</h6>
                            <p class="text-muted small mb-0">Daily current affairs and GK updates directly to your inbox.</p>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="notify_email_newsletter"
                                   {{ $user->notify_email_newsletter ? 'checked' : '' }}>
                        </div>
                    </div>

                    <div class="feature-toggle-item">
                        <div>
                            <h6 class="fw-bold mb-1">Mock Test Alerts</h6>
                            <p class="text-muted small mb-0">Get notified when new mock tests are published.</p>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="notify_mock_tests"
                                   {{ $user->notify_mock_tests ? 'checked' : '' }}>
                        </div>
                    </div>

                    <button type="submit" class="btn-save-custom mt-4 w-100">Save Notification Settings</button>
                </form>
            </div>
        </section>

    </div>
</div>
@endsection
