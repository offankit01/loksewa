@extends('layouts.admin')

@section('title', 'Manage Users')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none small text-muted">Dashboard</a></li>
    <li class="breadcrumb-item active small" aria-current="page">Users</li>
@endsection

@section('page_title', 'User Management')

@section('admin_content')
    {{-- Stats Row --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary-blue bg-opacity-10 text-primary-blue p-3 rounded-3 fs-4">
                        <i class="bi bi-people"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">{{ \App\Models\User::count() }}</h4>
                        <p class="text-muted small mb-0">Total Users</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-3 fs-4">
                        <i class="bi bi-person-check"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">{{ \App\Models\User::where('is_active', true)->count() }}</h4>
                        <p class="text-muted small mb-0">Active Users</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3 fs-4">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">{{ \App\Models\User::where('is_admin', true)->count() }}</h4>
                        <p class="text-muted small mb-0">Admins</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-danger bg-opacity-10 text-danger p-3 rounded-3 fs-4">
                        <i class="bi bi-person-x"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">{{ \App\Models\User::where('is_active', false)->count() }}</h4>
                        <p class="text-muted small mb-0">Suspended</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter & Search --}}
    <div class="card border-0 shadow-sm rounded-4 bg-white mb-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.users.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control bg-light border-0" placeholder="Search name, email, or phone..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="role" class="form-select bg-light border-0">
                        <option value="">All Roles</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admins</option>
                        <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Students</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary-blue w-100 rounded-pill">Filter</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-light w-100 rounded-pill">Reset</a>
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
                            <th class="ps-4 text-muted small fw-medium text-uppercase border-0">User Info</th>
                            <th class="text-muted small fw-medium text-uppercase border-0">Contact</th>
                            <th class="text-muted small fw-medium text-uppercase border-0">Role</th>
                            <th class="text-muted small fw-medium text-uppercase border-0">Status</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td class="ps-4 border-0">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="bi bi-person text-secondary fs-5"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $user->name }}</div>
                                        <div class="small text-muted">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="border-0">
                                <div class="small fw-medium">{{ $user->phone ?? 'N/A' }}</div>
                                <div class="extra-small text-muted">{{ $user->address ?? 'No address' }}</div>
                            </td>
                            <td class="border-0">
                                @if($user->is_admin)
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill fw-bold">Admin</span>
                                @else
                                    <span class="badge bg-primary-blue bg-opacity-10 text-primary-blue px-3 py-2 rounded-pill fw-bold">Student</span>
                                @endif
                            </td>
                            <td class="border-0">
                                @if($user->is_active)
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-bold">Active</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill fw-bold">Suspended</span>
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
                                            <form action="{{ route('admin.users.reset-password', $user) }}" method="POST" onsubmit="return confirm('Reset password to default (password123)?')">
                                                @csrf
                                                <button type="submit" class="dropdown-item small py-2"><i class="bi bi-key me-2 text-secondary"></i>Reset Password</button>
                                            </form>
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
    // Manually initialize dropdowns if they don't work automatically
    document.addEventListener('DOMContentLoaded', function () {
        var dropdownElementList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'))
        var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl)
        });
    });
</script>
@endsection
