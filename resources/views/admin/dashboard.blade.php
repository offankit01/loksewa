@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active small" aria-current="page">Dashboard</li>
@endsection

@section('page_title', 'Dashboard Overview')

@section('extra_css')
<style>
    .stat-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.06) !important;
    }
    .stat-card::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, rgba(255,255,255,0.1), transparent);
        border-radius: 0 0 0 100%;
        pointer-events: none;
    }
    .icon-box {
        transition: transform 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
    }
    .stat-card:hover .icon-box {
        transform: scale(1.1) rotate(5deg);
    }
    
    .table-hover tbody tr {
        transition: background-color 0.2s ease;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(30, 58, 138, 0.03) !important;
    }
    .badge-soft-success {
        background-color: rgba(16, 185, 129, 0.1) !important;
        color: #10b981 !important;
        padding: 0.5rem 1rem;
        border-radius: 50rem;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .badge-soft-primary {
        background-color: rgba(30, 58, 138, 0.1) !important;
        color: #1e3a8a !important;
        padding: 0.5rem 1rem;
        border-radius: 50rem;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .bg-primary-light {
        background-color: rgba(30, 58, 138, 0.1) !important;
    }
    .bg-accent-light {
        background-color: rgba(249, 115, 22, 0.1) !important;
    }
</style>
@endsection

@section('admin_content')
    <div class="row g-4 mb-5">
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 d-flex flex-row align-items-center gap-4 bg-white stat-card">
                <div class="bg-primary-light text-primary-blue p-3 rounded-4 fs-3 icon-box shadow-sm">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0 text-dark">1,204</h3>
                    <p class="text-muted small fw-medium mb-0 text-uppercase tracking-wider">Total Students</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 d-flex flex-row align-items-center gap-4 bg-white stat-card">
                <div class="bg-success bg-opacity-10 text-success p-3 rounded-4 fs-3 icon-box shadow-sm">
                    <i class="bi bi-journal-check"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0 text-dark">45</h3>
                    <p class="text-muted small fw-medium mb-0 text-uppercase tracking-wider">Mock Tests</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 d-flex flex-row align-items-center gap-4 bg-white stat-card">
                <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-4 fs-3 icon-box shadow-sm">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0 text-dark">342</h3>
                    <p class="text-muted small fw-medium mb-0 text-uppercase tracking-wider">Materials</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 d-flex flex-row align-items-center gap-4 bg-white stat-card">
                <div class="bg-accent-light text-accent-orange p-3 rounded-4 fs-3 icon-box shadow-sm">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0 text-dark">$5,240</h3>
                    <p class="text-muted small fw-medium mb-0 text-uppercase tracking-wider">Revenue</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 bg-white">
                <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Recent User Activity</h5>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-light rounded-pill fw-bold px-3 text-primary-blue hover-text-primary transition-all shadow-sm">View All</a>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="text-muted small fw-bold text-uppercase border-0 pb-3">Student</th>
                                    <th class="text-muted small fw-bold text-uppercase border-0 pb-3">Action</th>
                                    <th class="text-muted small fw-bold text-uppercase border-0 pb-3">Time</th>
                                    <th class="text-muted small fw-bold text-uppercase border-0 text-end pb-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border-0 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle p-2 me-3 shadow-sm">
                                                <i class="bi bi-person text-secondary"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark">Ram Sharma</div>
                                                <div class="small text-muted">ram@example.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-0 small fw-medium text-dark py-3">Enrolled in Section Officer</td>
                                    <td class="border-0 small text-muted py-3"><i class="bi bi-clock me-1"></i> 2 mins ago</td>
                                    <td class="border-0 text-end py-3">
                                        <span class="badge badge-soft-success">Success</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-0 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle p-2 me-3 shadow-sm">
                                                <i class="bi bi-person text-secondary"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark">Sita Khadka</div>
                                                <div class="small text-muted">sita@example.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-0 small fw-medium text-dark py-3">Started IQ Mock Test</td>
                                    <td class="border-0 small text-muted py-3"><i class="bi bi-clock me-1"></i> 15 mins ago</td>
                                    <td class="border-0 text-end py-3">
                                        <span class="badge badge-soft-primary">Active</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
