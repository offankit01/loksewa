@extends('layouts.dashboard')

@section('title', 'Platform Settings')

@section('extra_css')
<style>
    .settings-card {
        background: white;
        border-radius: 1.25rem;
        padding: 2rem;
        border: 1px solid rgba(0,0,0,0.03);
        margin-bottom: 2rem;
    }
    .settings-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.25rem 0;
        border-bottom: 1px solid #f8f9fa;
    }
    .settings-item:last-child {
        border-bottom: 0;
    }
    .form-check-input:checked {
        background-color: var(--primary-blue);
        border-color: var(--primary-blue);
    }
    .icon-square {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
</style>
@endsection

@section('dashboard_content')
<div class="mb-5">
    <h3 class="fw-bold mb-1">Platform Settings</h3>
    <p class="text-muted small mb-0">Customize your notification preferences and platform experience</p>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <!-- Notification Settings -->
        <div class="settings-card shadow-sm">
            <h5 class="fw-bold mb-4 d-flex align-items-center gap-3">
                <i class="bi bi-bell text-primary-blue"></i> Notifications
            </h5>
            
            <div class="settings-item">
                <div>
                    <h6 class="fw-bold mb-1">Email Alerts</h6>
                    <p class="text-muted small mb-0">Receive important updates and test results via email.</p>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" checked>
                </div>
            </div>
            
            <div class="settings-item">
                <div>
                    <h6 class="fw-bold mb-1">Mock Test Reminders</h6>
                    <p class="text-muted small mb-0">Get notified when new mock tests matching your courses are available.</p>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" checked>
                </div>
            </div>
            
            <div class="settings-item">
                <div>
                    <h6 class="fw-bold mb-1">Performance Weekly Digest</h6>
                    <p class="text-muted small mb-0">A weekly summary of your preparation progress and areas of improvement.</p>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox">
                </div>
            </div>
        </div>

        <!-- Privacy Settings -->
        <div class="settings-card shadow-sm">
            <h5 class="fw-bold mb-4 d-flex align-items-center gap-3">
                <i class="bi bi-shield-lock text-success"></i> Privacy & Security
            </h5>
            
            <div class="settings-item">
                <div>
                    <h6 class="fw-bold mb-1">Public Profile</h6>
                    <p class="text-muted small mb-0">Allow other students to see your mock test rankings and progress.</p>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox">
                </div>
            </div>
            
            <div class="settings-item">
                <div>
                    <h6 class="fw-bold mb-1">Two-Factor Authentication</h6>
                    <p class="text-muted small mb-0">Secure your account with an additional layer of security.</p>
                </div>
                <button class="btn btn-sm btn-light border px-3 rounded-pill">Enable</button>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Display Settings -->
        <div class="settings-card shadow-sm">
            <h5 class="fw-bold mb-4 d-flex align-items-center gap-3">
                <i class="bi bi-palette text-accent-orange"></i> Preference
            </h5>
            
            <div class="mb-4">
                <label class="form-label small fw-bold text-muted text-uppercase">Interface Language</label>
                <select class="form-select border-light-subtle rounded-3">
                    <option selected>English</option>
                    <option>Nepali (नेपाली)</option>
                </select>
            </div>
            
            <div class="mb-0">
                <label class="form-label small fw-bold text-muted text-uppercase">Timezone</label>
                <select class="form-select border-light-subtle rounded-3">
                    <option selected>Kathmandu (GMT+5:45)</option>
                    <option>New Delhi (GMT+5:30)</option>
                </select>
            </div>
        </div>
        
        <div class="card border-0 bg-light rounded-4 p-4 text-center">
            <i class="bi bi-info-circle text-muted fs-3 mb-3"></i>
            <h6 class="fw-bold mb-2">Need Help?</h6>
            <p class="small text-muted mb-3">Check our FAQ or contact support if you're having trouble with settings.</p>
            <a href="#" class="btn btn-primary-custom w-100 rounded-pill">Go to Help Center</a>
        </div>
    </div>
</div>

<div class="mt-2 text-end">
    <button class="btn btn-primary-custom px-5 rounded-pill shadow-sm">Save All Changes</button>
</div>
@endsection
