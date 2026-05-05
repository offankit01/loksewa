@extends('layouts.dashboard')

@section('title', 'Profile Settings')

@section('extra_css')
<style>
    .settings-container {
        max-width: 1000px;
        margin: 0 auto;
    }
    
    .settings-content {
        display: flex;
        flex-direction: column;
        gap: 2.5rem;
    }

    .profile-card {
        background: white;
        border-radius: 1.5rem;
        border: 1px solid rgba(0,0,0,0.03);
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }
    
    .profile-card-header {
        padding: 2.5rem;
        border-bottom: 1px solid #f1f5f9;
        background: linear-gradient(to right, #ffffff, #f8fafc);
    }
    
    .profile-card-body {
        padding: 3rem;
    }

    .avatar-wrapper {
        position: relative;
        width: 140px;
        height: 140px;
        margin-bottom: 0;
    }
    
    .avatar-img {
        width: 100%;
        height: 100%;
        border-radius: 2.5rem;
        background: var(--primary-blue);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        font-weight: 800;
        box-shadow: 0 15px 35px rgba(30, 58, 138, 0.2);
        border: 5px solid white;
    }
    
    .avatar-upload-overlay {
        position: absolute;
        bottom: -5px;
        right: -5px;
        width: 44px;
        height: 44px;
        background: var(--accent-orange);
        border-radius: 14px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid white;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 8px 15px rgba(0,0,0,0.1);
    }
    
    .avatar-upload-overlay:hover {
        transform: translateY(-3px) scale(1.1);
        background: #ea580c;
    }

    .form-label {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
    }
    
    .form-control-custom {
        border-radius: 14px;
        padding: 0.9rem 1.25rem;
        border: 2px solid #f1f5f9;
        transition: all 0.2s;
        font-size: 1rem;
        background: #f8fafc;
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
    
    .btn-save-custom:hover {
        background: #152c6e;
        transform: translateY(-3px);
        box-shadow: 0 15px 25px rgba(30, 58, 138, 0.3);
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 0.75rem;
    }
    
    .section-desc {
        color: #64748b;
        font-size: 1rem;
        margin-bottom: 3rem;
    }
</style>
@endsection

@section('dashboard_content')
<div class="mb-5 text-center">
    <h2 class="fw-bold mb-2">My Profile</h2>
    <p class="text-muted">Manage your personal information and subscription</p>
</div>

<div class="settings-container">
    <div class="settings-content">
        <!-- General Info Section -->
        <section id="general" class="profile-card shadow-sm">
            <div class="profile-card-header d-flex align-items-center gap-5">
                <div class="avatar-wrapper">
                    <div class="avatar-img">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <label for="avatar-input" class="avatar-upload-overlay">
                        <i class="bi bi-camera-fill fs-5"></i>
                    </label>
                    <input type="file" id="avatar-input" class="d-none">
                </div>
                <div>
                    <h3 class="fw-bold mb-1">{{ Auth::user()->name }}</h3>
                    <p class="text-muted mb-3">{{ Auth::user()->email }}</p>
                    <div class="d-flex gap-2">
                        <span class="badge bg-primary-blue bg-opacity-10 text-primary-blue rounded-pill px-4 py-2 fw-bold">Standard Learner</span>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-4 py-2 fw-bold">Verified Account</span>
                    </div>
                </div>
            </div>
            <div class="profile-card-body">
                <h5 class="section-title">Personal Details</h5>
                <p class="section-desc">Update your personal information and how we can reach you.</p>
                @include('profile.partials.update-profile-information-form')
            </div>
        </section>

        <!-- Billing Section -->
        <section id="billing" class="profile-card shadow-sm">
            <div class="profile-card-body">
                <h5 class="section-title">Subscription & Billing</h5>
                <p class="section-desc">View your current plan details and manage your subscription.</p>
                
                <div class="p-5 bg-light rounded-4 mb-5 border border-2">
                    <div class="row align-items-center">
                        <div class="col-md-7">
                            <h6 class="text-uppercase fw-bold text-muted small mb-2">Current Plan</h6>
                            <h3 class="fw-bold mb-2 text-primary-blue">Premium LokSewa Preparation</h3>
                            <p class="text-muted mb-0">Your plan includes full access to all mock tests and premium study materials.</p>
                        </div>
                        <div class="col-md-5 text-md-end mt-4 mt-md-0">
                            <h2 class="fw-bold mb-1">Rs. 499<span class="fs-6 text-muted fw-normal"> / year</span></h2>
                            <p class="text-success small fw-bold mb-0">Renews on Dec 24, 2024</p>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex gap-3">
                    <a href="{{ route('upgrade-plan') }}" class="btn btn-primary-custom rounded-pill px-5 py-3 fw-bold">Upgrade My Plan</a>
                    <button class="btn btn-outline-secondary rounded-pill px-5 py-3 fw-bold border-2">View Invoices</button>
                </div>
            </div>
        </section>

        <!-- Danger Zone -->
        <section id="danger" class="profile-card shadow-sm border-danger border-opacity-10">
            <div class="profile-card-body">
                <h5 class="section-title text-danger">Delete Account</h5>
                <p class="section-desc">Once your account is deleted, all of your progress, saved materials, and results will be permanently removed. This action cannot be undone.</p>
                @include('profile.partials.delete-user-form')
            </div>
        </section>
    </div>
</div>
@endsection

@section('extra_js')
<script>
    // No JS needed for sidebar anymore
</script>
@endsection


