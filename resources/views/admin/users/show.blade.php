@extends('layouts.admin')

@section('title', 'User Profile - ' . $user->name)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none small text-muted">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}" class="text-decoration-none small text-muted">Users</a></li>
    <li class="breadcrumb-item active small" aria-current="page">View Profile</li>
@endsection

@section('page_title', 'User Profile Details')

@section('admin_content')
    <div class="row g-4">
        {{-- Profile Sidebar --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 bg-white text-center p-4">
                <div class="mb-4">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px;">
                        <i class="bi bi-person text-secondary" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                    <p class="text-muted small mb-3">{{ $user->email }}</p>
                    <div class="d-flex justify-content-center gap-2">
                        @if($user->is_admin)
                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill fw-bold">Admin</span>
                        @else
                            <span class="badge bg-primary-blue bg-opacity-10 text-primary-blue px-3 py-2 rounded-pill fw-bold">Student</span>
                        @endif
                        
                        @if($user->is_active)
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-bold">Active</span>
                        @else
                            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill fw-bold">Suspended</span>
                        @endif
                    </div>
                </div>
                
                <hr class="text-muted opacity-10">
                
                <div class="text-start mt-3">
                    <h6 class="extra-small fw-bold text-uppercase text-muted mb-3">Contact Details</h6>
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <i class="bi bi-telephone text-primary-blue fs-5"></i>
                        <div>
                            <div class="small text-muted">Phone</div>
                            <div class="fw-bold">{{ $user->phone ?? 'Not provided' }}</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-geo-alt text-accent-orange fs-5"></i>
                        <div>
                            <div class="small text-muted">Address</div>
                            <div class="fw-bold">{{ $user->address ?? 'Not provided' }}</div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top d-grid gap-2">
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary-blue rounded-pill py-2">
                        <i class="bi bi-pencil me-2"></i>Edit Profile
                    </a>
                </div>
            </div>
        </div>

        {{-- Main Activity Area --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 bg-white p-4 h-100">
                <ul class="nav nav-tabs nav-tabs-custom border-0 mb-4" id="profileTabs">
                    <li class="nav-item">
                        <a class="nav-link active border-0 fw-bold px-4" data-bs-toggle="tab" href="#activity">Activity Log</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border-0 fw-bold px-4" data-bs-toggle="tab" href="#tests">Mock Tests</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="activity">
                        <div class="text-center py-5">
                            <i class="bi bi-activity text-muted opacity-25" style="font-size: 4rem;"></i>
                            <h5 class="mt-3 fw-bold">No recent activity</h5>
                            <p class="text-muted small">This user hasn't performed any logged actions recently.</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tests">
                        <div class="text-center py-5">
                            <i class="bi bi-journal-text text-muted opacity-25" style="font-size: 4rem;"></i>
                            <h5 class="mt-3 fw-bold">No test attempts</h5>
                            <p class="text-muted small">This student hasn't appeared for any mock tests yet.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_css')
<style>
    .nav-tabs-custom .nav-link {
        color: #64748b;
        border-bottom: 3px solid transparent !important;
        background: none !important;
    }
    .nav-tabs-custom .nav-link.active {
        color: #1e3a8a;
        border-bottom-color: #1e3a8a !important;
    }
</style>
@endsection
