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
                            <span class="badge" style="background-color: rgba(245, 158, 11, 0.1); color: #d97706; padding: 0.5rem 1rem; border-radius: 50rem; font-weight: 700;">Admin</span>
                        @else
                            <span class="badge" style="background-color: rgba(30, 58, 138, 0.1); color: #1e3a8a; padding: 0.5rem 1rem; border-radius: 50rem; font-weight: 700;">Student</span>
                        @endif
                        
                        @if($user->is_active)
                            <span class="badge" style="background-color: rgba(16, 185, 129, 0.1); color: #10b981; padding: 0.5rem 1rem; border-radius: 50rem; font-weight: 700;">Active</span>
                        @else
                            <span class="badge" style="background-color: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 0.5rem 1rem; border-radius: 50rem; font-weight: 700;">Suspended</span>
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
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <i class="bi bi-geo-alt text-accent-orange fs-5"></i>
                        <div>
                            <div class="small text-muted">Address</div>
                            <div class="fw-bold">{{ $user->address ?? 'Not provided' }}</div>
                        </div>
                    </div>
                    
                    <h6 class="extra-small fw-bold text-uppercase text-muted mb-3 mt-4">Account Preferences</h6>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="small text-muted">Theme</span>
                        <span class="badge bg-light text-dark fw-medium border">{{ ucfirst($user->theme_preference ?? 'System') }}</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="small text-muted">Two-Factor Auth</span>
                        @if($user->two_fa_enabled)
                            <span class="badge bg-success bg-opacity-10 text-success fw-medium"><i class="bi bi-check-circle me-1"></i> Enabled</span>
                        @else
                            <span class="badge bg-secondary bg-opacity-10 text-secondary fw-medium">Disabled</span>
                        @endif
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="small text-muted">Joined Date</span>
                        <span class="small fw-bold">{{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top d-grid gap-2">
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary-blue rounded-pill py-2 shadow-sm">
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
                        <a class="nav-link active border-0 fw-bold px-4" data-bs-toggle="tab" href="#tests"><i class="bi bi-journal-text me-2"></i>Mock Tests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border-0 fw-bold px-4" data-bs-toggle="tab" href="#subscriptions"><i class="bi bi-credit-card me-2"></i>Subscriptions</a>
                    </li>
                </ul>

                <div class="tab-content">
                    {{-- Mock Tests Tab --}}
                    <div class="tab-pane fade show active" id="tests">
                        @php
                            $attempts = $user->testAttempts()->with('mockTest')->latest()->get();
                        @endphp
                        
                        @if($attempts->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="border-0 text-muted small fw-bold text-uppercase py-3 rounded-start">Test Name</th>
                                            <th class="border-0 text-muted small fw-bold text-uppercase py-3">Score</th>
                                            <th class="border-0 text-muted small fw-bold text-uppercase py-3">Date Taken</th>
                                            <th class="border-0 text-muted small fw-bold text-uppercase py-3 rounded-end text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($attempts as $attempt)
                                        <tr>
                                            <td class="border-0 py-3">
                                                <div class="fw-bold text-dark">{{ $attempt->mockTest->title ?? 'Deleted Test' }}</div>
                                                <div class="small text-muted">{{ $attempt->total_questions }} Questions</div>
                                            </td>
                                            <td class="border-0 py-3">
                                                <div class="d-flex align-items-center gap-2">
                                                    @php
                                                        $percentage = ($attempt->score / $attempt->total_questions) * 100;
                                                        $colorClass = $percentage >= 50 ? 'text-success' : 'text-danger';
                                                    @endphp
                                                    <span class="fw-bold fs-5 {{ $colorClass }}">{{ $attempt->score }}</span>
                                                    <span class="text-muted small">/ {{ $attempt->total_questions }}</span>
                                                </div>
                                            </td>
                                            <td class="border-0 py-3 small text-muted">
                                                <i class="bi bi-calendar me-1"></i> {{ $attempt->created_at->format('M d, Y h:i A') }}
                                            </td>
                                            <td class="border-0 py-3 text-end">
                                                <button class="btn btn-sm btn-light rounded-pill px-3 text-primary-blue hover-text-primary transition-all">Details</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 80px; height: 80px;">
                                    <i class="bi bi-journal-x text-muted" style="font-size: 2.5rem;"></i>
                                </div>
                                <h5 class="mt-3 fw-bold">No test attempts</h5>
                                <p class="text-muted small">This student hasn't appeared for any mock tests yet.</p>
                            </div>
                        @endif
                    </div>
                    
                    {{-- Subscriptions Tab --}}
                    <div class="tab-pane fade" id="subscriptions">
                        @php
                            $subscriptions = $user->subscriptions()->with('plan')->latest()->get();
                        @endphp
                        
                        @if($subscriptions->count() > 0)
                            <div class="row g-3">
                                @foreach($subscriptions as $sub)
                                <div class="col-md-6">
                                    <div class="card border shadow-sm rounded-4 h-100">
                                        <div class="card-body p-4">
                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                <div>
                                                    <span class="badge {{ $sub->status == 'active' ? 'bg-success' : 'bg-secondary' }} bg-opacity-10 {{ $sub->status == 'active' ? 'text-success' : 'text-secondary' }} mb-2 px-2 py-1 rounded-pill fw-bold text-uppercase" style="font-size: 0.7rem;">{{ $sub->status }}</span>
                                                    <h5 class="fw-bold mb-0 text-primary-blue">{{ $sub->plan->name ?? 'Custom Plan' }}</h5>
                                                </div>
                                                <div class="text-end">
                                                    <div class="fw-bold fs-5 text-dark">Rs. {{ number_format($sub->price_at_purchase, 2) }}</div>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-2 small text-muted mb-2">
                                                <i class="bi bi-calendar-check text-success"></i> Started: {{ \Carbon\Carbon::parse($sub->starts_at)->format('M d, Y') }}
                                            </div>
                                            <div class="d-flex align-items-center gap-2 small text-muted">
                                                <i class="bi bi-calendar-x text-danger"></i> Ends: {{ \Carbon\Carbon::parse($sub->ends_at)->format('M d, Y') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 80px; height: 80px;">
                                    <i class="bi bi-credit-card text-muted" style="font-size: 2.5rem;"></i>
                                </div>
                                <h5 class="mt-3 fw-bold">No Subscriptions</h5>
                                <p class="text-muted small">This user does not have any active or past subscriptions.</p>
                            </div>
                        @endif
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
        transition: all 0.2s ease;
    }
    .nav-tabs-custom .nav-link:hover {
        color: #1e3a8a;
    }
    .nav-tabs-custom .nav-link.active {
        color: #1e3a8a;
        border-bottom-color: #1e3a8a !important;
    }
    .table-hover tbody tr {
        transition: background-color 0.2s ease;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(30, 58, 138, 0.03) !important;
    }
</style>
@endsection
