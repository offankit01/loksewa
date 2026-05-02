@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active small" aria-current="page">Dashboard</li>
@endsection

@section('page_title', 'Dashboard Overview')

@section('admin_content')
    <div class="row g-4 mb-5">
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 d-flex flex-row align-items-center gap-4 bg-white">
                <div class="bg-primary-blue bg-opacity-10 text-primary-blue p-3 rounded-3 fs-3">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0">1,204</h3>
                    <p class="text-muted small mb-0">Total Students</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 d-flex flex-row align-items-center gap-4 bg-white">
                <div class="bg-success bg-opacity-10 text-success p-3 rounded-3 fs-3">
                    <i class="bi bi-journal-check"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0">45</h3>
                    <p class="text-muted small mb-0">Active Mock Tests</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 d-flex flex-row align-items-center gap-4 bg-white">
                <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3 fs-3">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0">342</h3>
                    <p class="text-muted small mb-0">Study Materials</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 d-flex flex-row align-items-center gap-4 bg-white">
                <div class="bg-accent-orange bg-opacity-10 text-accent-orange p-3 rounded-3 fs-3">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0">$5,240</h3>
                    <p class="text-muted small mb-0">Monthly Revenue</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 bg-white">
                <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Recent User Activity</h5>
                    <button class="btn btn-sm btn-light rounded-pill">View All</button>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="text-muted small fw-medium text-uppercase border-0">Student</th>
                                    <th class="text-muted small fw-medium text-uppercase border-0">Action</th>
                                    <th class="text-muted small fw-medium text-uppercase border-0">Time</th>
                                    <th class="text-muted small fw-medium text-uppercase border-0 text-end">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border-0">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle p-2 me-3">
                                                <i class="bi bi-person text-secondary"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">Ram Sharma</div>
                                                <div class="small text-muted">ram@example.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-0 small">Enrolled in Section Officer</td>
                                    <td class="border-0 small text-muted">2 mins ago</td>
                                    <td class="border-0 text-end">
                                        <span class="badge badge-soft-success">Success</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-0">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle p-2 me-3">
                                                <i class="bi bi-person text-secondary"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">Sita Khadka</div>
                                                <div class="small text-muted">sita@example.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-0 small">Started IQ Mock Test</td>
                                    <td class="border-0 small text-muted">15 mins ago</td>
                                    <td class="border-0 text-end">
                                        <span class="badge badge-soft-primary">Active</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body p-4 d-flex flex-column">
                    <h5 class="fw-bold mb-4">Quick Shortcuts</h5>
                    <div class="d-grid gap-3">
                        <a href="#" class="btn btn-light border-0 d-flex align-items-center justify-content-between p-3 rounded-3 text-dark text-decoration-none">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-plus-circle-fill text-primary-blue fs-5"></i>
                                <span class="fw-bold">Add Study PDF</span>
                            </div>
                            <i class="bi bi-chevron-right text-muted small"></i>
                        </a>
                        <a href="#" class="btn btn-light border-0 d-flex align-items-center justify-content-between p-3 rounded-3 text-dark text-decoration-none">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-pencil-square text-accent-orange fs-5"></i>
                                <span class="fw-bold">New Mock Test</span>
                            </div>
                            <i class="bi bi-chevron-right text-muted small"></i>
                        </a>
                        <a href="#" class="btn btn-light border-0 d-flex align-items-center justify-content-between p-3 rounded-3 text-dark text-decoration-none">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-megaphone text-success fs-5"></i>
                                <span class="fw-bold">Post Blog</span>
                            </div>
                            <i class="bi bi-chevron-right text-muted small"></i>
                        </a>
                    </div>
                    
                    <div class="mt-auto pt-4">
                        <div class="p-3 bg-light rounded-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="small text-muted fw-bold">Server Storage</span>
                                <span class="small fw-bold">65%</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-accent-orange" style="width: 65%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
