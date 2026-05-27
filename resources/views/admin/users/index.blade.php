@extends('layouts.admin')

@section('title', 'Manage Users')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none small text-muted">Dashboard</a></li>
    <li class="breadcrumb-item active small" aria-current="page">Users</li>
@endsection

@section('page_title', 'User Management')

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
        width: 55px;
        height: 55px;
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
    .bg-primary-light { background-color: rgba(30, 58, 138, 0.1) !important; }
    .bg-accent-light { background-color: rgba(249, 115, 22, 0.1) !important; }
    
    .badge-soft {
        padding: 0.5rem 1rem;
        border-radius: 50rem;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .badge-soft.warning { background-color: rgba(245, 158, 11, 0.1) !important; color: #d97706 !important; }
    .badge-soft.primary { background-color: rgba(30, 58, 138, 0.1) !important; color: #1e3a8a !important; }
    .badge-soft.success { background-color: rgba(16, 185, 129, 0.1) !important; color: #10b981 !important; }
    .badge-soft.danger { background-color: rgba(239, 68, 68, 0.1) !important; color: #ef4444 !important; }
</style>
@endsection

@section('admin_content')
    {{-- Stats Row --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white stat-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary-light text-primary-blue p-3 rounded-4 fs-3 icon-box shadow-sm">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0 text-dark">{{ \App\Models\User::count() }}</h4>
                        <p class="text-muted small fw-medium mb-0 text-uppercase tracking-wider">Total Users</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white stat-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-4 fs-3 icon-box shadow-sm">
                        <i class="bi bi-person-check-fill"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0 text-dark">{{ \App\Models\User::where('is_active', true)->count() }}</h4>
                        <p class="text-muted small fw-medium mb-0 text-uppercase tracking-wider">Active</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white stat-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-4 fs-3 icon-box shadow-sm">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0 text-dark">{{ \App\Models\User::where('is_admin', true)->count() }}</h4>
                        <p class="text-muted small fw-medium mb-0 text-uppercase tracking-wider">Admins</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white stat-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-danger bg-opacity-10 text-danger p-3 rounded-4 fs-3 icon-box shadow-sm">
                        <i class="bi bi-person-x-fill"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0 text-dark">{{ \App\Models\User::where('is_active', false)->count() }}</h4>
                        <p class="text-muted small fw-medium mb-0 text-uppercase tracking-wider">Suspended</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter & Search --}}
    <div class="card border-0 shadow-sm rounded-4 bg-white mb-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.users.index') }}" method="GET" class="row g-3">
                <div class="col-md-5">
                    <div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden">
                        <span class="input-group-text bg-light border-0 ps-4"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control bg-light border-0 py-3" placeholder="Search name, email, or phone..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="role" class="form-select form-select-lg bg-light border-0 shadow-sm rounded-pill py-3 px-4">
                        <option value="">All Roles</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrators</option>
                        <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Students</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary-custom btn-lg w-100 rounded-pill shadow-sm"><i class="bi bi-funnel me-2"></i>Filter</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-light btn-lg w-100 rounded-pill shadow-sm text-muted fw-bold">Reset</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Users Table --}}
    <div class="card border-0 shadow-sm rounded-4 bg-white">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-4 text-muted small fw-bold text-uppercase border-0">User Info</th>
                            <th class="py-4 text-muted small fw-bold text-uppercase border-0">Contact</th>
                            <th class="py-4 text-muted small fw-bold text-uppercase border-0">Role</th>
                            <th class="py-4 text-muted small fw-bold text-uppercase border-0">Status</th>
                            <th class="py-4 text-muted small fw-bold text-uppercase border-0 text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td class="ps-4 py-3 border-0">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 45px; height: 45px;">
                                        @if($user->is_admin)
                                            <i class="bi bi-shield-lock-fill text-warning fs-5"></i>
                                        @else
                                            <i class="bi bi-person-fill text-secondary fs-5"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $user->name }}</div>
                                        <div class="small text-muted">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 border-0">
                                <div class="small fw-medium text-dark">{{ $user->phone ?? 'N/A' }}</div>
                                <div class="extra-small text-muted">{{ $user->address ?? 'No address' }}</div>
                            </td>
                            <td class="py-3 border-0">
                                @if($user->is_admin)
                                    <span class="badge badge-soft warning">Admin</span>
                                @else
                                    <span class="badge badge-soft primary">Student</span>
                                @endif
                            </td>
                            <td class="py-3 border-0">
                                @if($user->is_active)
                                    <span class="badge badge-soft success">Active</span>
                                @else
                                    <span class="badge badge-soft danger">Suspended</span>
                                @endif
                            </td>
                            <td class="text-end pe-4 border-0">
                                <div class="dropdown shadow-none">
                                    <button class="btn btn-sm btn-light rounded-circle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3 mt-2" style="z-index: 1050; min-width: 200px;">
                                        <li><a class="dropdown-item small py-2" href="{{ route('admin.users.show', $user) }}"><i class="bi bi-eye me-2 text-info"></i>View Profile</a></li>
                                        <li><a class="dropdown-item small py-2" href="{{ route('admin.users.edit', $user) }}"><i class="bi bi-pencil me-2 text-primary"></i>Edit Details</a></li>
                                        <li>
                                            <button type="button" class="dropdown-item small py-2" data-bs-toggle="modal" data-bs-target="#resetPasswordModal{{ $user->id }}">
                                                <i class="bi bi-key me-2 text-secondary"></i>Reset Password
                                            </button>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('admin.users.toggle-admin', $user) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item small py-2"><i class="bi bi-shield-shaded me-2 text-warning"></i>{{ $user->is_admin ? 'Demote to Student' : 'Promote to Admin' }}</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item small py-2"><i class="bi bi-slash-circle me-2 text-danger"></i>{{ $user->is_active ? 'Suspend Account' : 'Activate Account' }}</button>
                                            </form>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item small py-2 text-danger"><i class="bi bi-trash me-2"></i>Delete User</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>

                                {{-- Reset Password Modal --}}
                                <div class="modal fade text-start" id="resetPasswordModal{{ $user->id }}" tabindex="-1" aria-labelledby="resetPasswordModalLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow-lg rounded-4">
                                            <div class="modal-header border-0 pb-0 pt-4 px-4 text-start">
                                                <h5 class="modal-title fw-bold text-dark" id="resetPasswordModalLabel{{ $user->id }}">Change Password for {{ $user->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.users.reset-password', $user) }}" method="POST">
                                                @csrf
                                                <div class="modal-body p-4 text-start">
                                                    <p class="text-muted small mb-4 text-start lh-base">Enter the new password for this user below. They will be able to log in with this new password immediately.</p>
                                                    
                                                    <div class="mb-3 text-start">
                                                        <label class="form-label fw-bold small text-dark">New Password</label>
                                                        <div class="input-group input-group-custom shadow-sm rounded-pill overflow-hidden bg-light">
                                                            <span class="input-group-text bg-light border-0 ps-4"><i class="bi bi-lock text-muted"></i></span>
                                                            <input type="password" name="password" class="form-control bg-light border-0 py-2" placeholder="At least 8 characters" required minlength="8">
                                                            <button class="btn bg-light border-0 pe-4 text-muted toggle-password" type="button"><i class="bi bi-eye"></i></button>
                                                        </div>
                                                    </div>

                                                    <div class="mb-4 text-start">
                                                        <label class="form-label fw-bold small text-dark">Confirm New Password</label>
                                                        <div class="input-group input-group-custom shadow-sm rounded-pill overflow-hidden bg-light">
                                                            <span class="input-group-text bg-light border-0 ps-4"><i class="bi bi-lock-fill text-muted"></i></span>
                                                            <input type="password" name="password_confirmation" class="form-control bg-light border-0 py-2" placeholder="Re-enter password" required minlength="8">
                                                            <button class="btn bg-light border-0 pe-4 text-muted toggle-password" type="button"><i class="bi bi-eye"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0 pt-0 pb-4 px-4 d-flex gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light rounded-pill px-4 m-0" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary-custom rounded-pill px-5 m-0">Save Password</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">No users found matching your criteria.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-4 py-3 border-top">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection

@section('extra_js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Manually initialize dropdowns if needed
        var dropdownElementList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'))
        var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl)
        });
    });

    // Robust Password visibility toggle using Event Delegation
    document.addEventListener('click', function(e) {
        var toggleBtn = e.target.closest('.toggle-password');
        if (toggleBtn) {
            var input = toggleBtn.closest('.input-group').querySelector('input');
            var icon = toggleBtn.querySelector('i');
            if (input && icon) {
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            }
        }
    });
</script>
@endsection
