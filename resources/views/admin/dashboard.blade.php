<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LokSewa Tayari') }} - Admin Dashboard</title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif

    <style>
        body {
            background-color: var(--light-bg);
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: var(--primary-blue);
            color: white;
            padding-top: 1rem;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }
        .main-content {
            margin-left: 250px;
            padding: 2rem;
        }
        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.8rem 1.5rem;
            display: flex;
            align-items: center;
            transition: all 0.2s;
        }
        .nav-link:hover, .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .stat-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column">
        <div class="px-4 mb-4 text-center">
            <h5 class="fw-bold d-flex align-items-center justify-content-center m-0">
                <i class="bi bi-shield-lock-fill me-2 text-accent-orange"></i>
                Admin Panel
            </h5>
        </div>
        
        <ul class="nav flex-column mb-auto">
            <li class="nav-item">
                <a href="#" class="nav-link active">
                    <i class="bi bi-speedometer2 me-3 fs-5"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-people me-3 fs-5"></i>
                    Manage Users
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-journal-text me-3 fs-5"></i>
                    Mock Tests
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-translate me-3 fs-5"></i>
                    Content
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-gear me-3 fs-5"></i>
                    Settings
                </a>
            </li>
        </ul>
        
        <div class="p-4 mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100 d-flex align-items-center justify-content-center">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0 text-dark">Dashboard Overview</h2>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted"><i class="bi bi-person-circle me-1"></i> Hello, {{ Auth::user()->name }}</span>
            </div>
        </div>
        
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon bg-primary-blue bg-opacity-10 text-primary-blue">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">1,204</h3>
                        <p class="text-muted small mb-0">Total Students</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-journal-check"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">45</h3>
                        <p class="text-muted small mb-0">Active Mock Tests</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">342</h3>
                        <p class="text-muted small mb-0">Study Materials</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon bg-accent-orange bg-opacity-10 text-accent-orange">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">$5,240</h3>
                        <p class="text-muted small mb-0">Revenue (This Month)</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                        <h5 class="fw-bold mb-0">Recent Registrations</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-muted small fw-medium text-uppercase border-0">Name</th>
                                        <th class="text-muted small fw-medium text-uppercase border-0">Email</th>
                                        <th class="text-muted small fw-medium text-uppercase border-0">Joined</th>
                                        <th class="text-muted small fw-medium text-uppercase border-0 text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border-0">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light rounded-circle p-2 me-2">
                                                    <i class="bi bi-person text-secondary"></i>
                                                </div>
                                                <span class="fw-medium">Ram Sharma</span>
                                            </div>
                                        </td>
                                        <td class="border-0 text-muted">ram@example.com</td>
                                        <td class="border-0 text-muted">Today</td>
                                        <td class="border-0 text-end">
                                            <button class="btn btn-sm btn-light rounded-pill px-3">View</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-0">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light rounded-circle p-2 me-2">
                                                    <i class="bi bi-person text-secondary"></i>
                                                </div>
                                                <span class="fw-medium">Sita Khadka</span>
                                            </div>
                                        </td>
                                        <td class="border-0 text-muted">sita@example.com</td>
                                        <td class="border-0 text-muted">Yesterday</td>
                                        <td class="border-0 text-end">
                                            <button class="btn btn-sm btn-light rounded-pill px-3">View</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 bg-primary-blue text-white overflow-hidden position-relative">
                    <div class="position-absolute top-0 end-0 opacity-25 w-100 h-100" style="background: radial-gradient(circle at top right, rgba(249,115,22,0.8), transparent 60%);"></div>
                    <div class="card-body p-4 position-relative z-1 d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="fw-bold mb-3 d-flex align-items-center">
                                <i class="bi bi-lightning-charge-fill text-accent-orange me-2"></i> Quick Action
                            </h5>
                            <p class="text-white-50 small mb-4">Need to add a new set of mock questions for the upcoming Section Officer exam?</p>
                        </div>
                        <button class="btn btn-accent-custom w-100">Create New Mock Test</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
