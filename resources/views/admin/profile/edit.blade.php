@extends('layouts.admin')

@section('title', 'Admin Profile Settings')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none small text-muted">Dashboard</a></li>
    <li class="breadcrumb-item active small" aria-current="page">Profile</li>
@endsection

@section('page_title', 'Admin Profile')

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
        width: 120px;
        height: 120px;
        margin-bottom: 0;
    }
    
    .avatar-img {
        width: 100%;
        height: 100%;
        border-radius: 2.5rem;
        background: var(--accent-color, #f97316);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3.5rem;
        font-weight: 800;
        box-shadow: 0 15px 35px rgba(249, 115, 22, 0.2);
        border: 5px solid white;
    }
    
    .avatar-upload-overlay {
        position: absolute;
        bottom: -5px;
        right: -5px;
        width: 40px;
        height: 40px;
        background: var(--sidebar-bg, #0f172a);
        border-radius: 12px;
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
        background: #1e293b;
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
        border-color: #f97316;
        background: white;
        box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.1);
        outline: none;
    }

    .btn-save-custom {
        background: #0f172a;
        color: white;
        padding: 1rem 3rem;
        border-radius: 14px;
        font-weight: 700;
        border: none;
        transition: all 0.3s;
        box-shadow: 0 10px 20px rgba(15, 23, 42, 0.2);
    }
    
    .btn-save-custom:hover {
        background: #1e293b;
        transform: translateY(-3px);
        box-shadow: 0 15px 25px rgba(15, 23, 42, 0.3);
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

@section('admin_content')
<div class="settings-container">
    <div class="settings-content">
        <!-- General Info Section -->
        <section id="general" class="profile-card shadow-sm">
            <div class="profile-card-header d-flex align-items-center gap-4">
                <div class="avatar-wrapper">
                    <div class="avatar-img">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <label for="avatar-input" class="avatar-upload-overlay">
                        <i class="bi bi-camera-fill fs-6"></i>
                    </label>
                    <input type="file" id="avatar-input" class="d-none">
                </div>
                <div>
                    <h3 class="fw-bold mb-1">{{ Auth::user()->name }}</h3>
                    <p class="text-muted mb-3">{{ Auth::user()->email }}</p>
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-4 py-2 fw-bold border border-primary border-opacity-10">
                        <i class="bi bi-shield-lock-fill me-1"></i> System Administrator
                    </span>
                </div>
            </div>
            <div class="profile-card-body">
                <h5 class="section-title">Personal Details</h5>
                <p class="section-desc">Update your personal information and how we can reach you.</p>
                @include('profile.partials.update-profile-information-form')
            </div>
        </section>

        <!-- Security Section -->
        <section id="security" class="profile-card shadow-sm">
            <div class="profile-card-body">
                <h5 class="section-title">Security Settings</h5>
                <p class="section-desc">Ensure your account is using a long, random password to stay secure.</p>
                @include('profile.partials.update-password-form')
            </div>
        </section>
    </div>
</div>
@endsection
