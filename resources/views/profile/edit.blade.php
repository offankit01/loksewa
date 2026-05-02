@extends('layouts.dashboard')

@section('title', 'My Profile')

@section('extra_css')
<style>
    .profile-section {
        background: white;
        border-radius: 1.25rem;
        padding: 2.5rem;
        border: 1px solid rgba(0,0,0,0.03);
        margin-bottom: 2rem;
    }
    .profile-header {
        display: flex;
        align-items: center;
        gap: 2rem;
        margin-bottom: 3rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid #f0f0f0;
    }
    .avatar-upload {
        position: relative;
        width: 120px;
        height: 120px;
    }
    .avatar-preview {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-color: var(--primary-blue);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-weight: 800;
        border: 4px solid white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .avatar-edit-btn {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--accent-orange);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid white;
        cursor: pointer;
    }
    /* Style Laravel's default forms to match our design */
    input[type="text"], input[type="email"], input[type="password"] {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        border: 1px solid #e0e0e0;
        margin-top: 0.5rem;
        width: 100%;
    }
    input:focus {
        border-color: var(--primary-blue);
        outline: none;
        box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
    }
    .btn-save {
        background: var(--primary-blue);
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        margin-top: 1.5rem;
        transition: all 0.3s;
    }
    .btn-save:hover {
        background: #152c6e;
        transform: translateY(-2px);
    }
</style>
@endsection

@section('dashboard_content')
<div class="mb-5">
    <h3 class="fw-bold mb-1">Account Settings</h3>
    <p class="text-muted small mb-0">Manage your profile information and account security</p>
</div>

<div class="profile-section shadow-sm">
    <div class="profile-header">
        <div class="avatar-upload">
            <div class="avatar-preview">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="avatar-edit-btn">
                <i class="bi bi-camera-fill small"></i>
            </div>
        </div>
        <div>
            <h4 class="fw-bold mb-1 text-dark">{{ Auth::user()->name }}</h4>
            <p class="text-muted mb-3">{{ Auth::user()->email }}</p>
            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-bold">Verified Account</span>
        </div>
    </div>

    <div class="max-w-xl">
        <h5 class="fw-bold mb-4">Profile Information</h5>
        @include('profile.partials.update-profile-information-form')
    </div>
</div>

<div class="profile-section shadow-sm">
    <div class="max-w-xl">
        <h5 class="fw-bold mb-4">Update Password</h5>
        @include('profile.partials.update-password-form')
    </div>
</div>

<div class="profile-section shadow-sm border-danger border-opacity-10">
    <div class="max-w-xl">
        <h5 class="fw-bold mb-4 text-danger">Delete Account</h5>
        <p class="text-muted small mb-4">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
        @include('profile.partials.delete-user-form')
    </div>
</div>
@endsection
