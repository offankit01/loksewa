@extends('layouts.admin')

@section('title', 'Edit User - ' . $user->name)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none small text-muted">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}" class="text-decoration-none small text-muted">Users</a></li>
    <li class="breadcrumb-item active small" aria-current="page">Edit User</li>
@endsection

@section('page_title', 'Edit User Details')

@section('admin_content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Full Name</label>
                            <input type="text" name="name" class="form-control bg-light border-0 py-2" value="{{ old('name', $user->name) }}" required>
                            @error('name') <span class="text-danger extra-small">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Email Address</label>
                            <input type="email" name="email" class="form-control bg-light border-0 py-2" value="{{ old('email', $user->email) }}" required>
                            @error('email') <span class="text-danger extra-small">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Phone Number</label>
                            <input type="text" name="phone" class="form-control bg-light border-0 py-2" value="{{ old('phone', $user->phone) }}">
                            @error('phone') <span class="text-danger extra-small">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Address</label>
                            <input type="text" name="address" class="form-control bg-light border-0 py-2" value="{{ old('address', $user->address) }}">
                            @error('address') <span class="text-danger extra-small">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-12 pt-3">
                            <button type="submit" class="btn btn-primary-blue rounded-pill px-5">Save Changes</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-light rounded-pill px-4 ms-2">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 bg-white p-4 mb-4">
                <h6 class="fw-bold mb-4">Account Information</h6>
                <div class="mb-3">
                    <label class="text-muted extra-small fw-bold text-uppercase">Account Created</label>
                    <div class="fw-bold">{{ $user->created_at->format('M d, Y') }}</div>
                </div>
                <div class="mb-3">
                    <label class="text-muted extra-small fw-bold text-uppercase">Last Updated</label>
                    <div class="fw-bold">{{ $user->updated_at->diffForHumans() }}</div>
                </div>
                <div class="mb-3">
                    <label class="text-muted extra-small fw-bold text-uppercase">Current Role</label>
                    <div class="mt-1">
                        @if($user->is_admin)
                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill fw-bold">Administrator</span>
                        @else
                            <span class="badge bg-primary-blue bg-opacity-10 text-primary-blue px-3 py-2 rounded-pill fw-bold">Regular Student</span>
                        @endif
                    </div>
                </div>
                <div class="mb-0">
                    <label class="text-muted extra-small fw-bold text-uppercase">Status</label>
                    <div class="mt-1">
                        @if($user->is_active)
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-bold">Active Account</span>
                        @else
                            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill fw-bold">Suspended Account</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
                <h6 class="fw-bold mb-4">Danger Zone</h6>
                <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="mb-3">
                    @csrf
                    <button type="submit" class="btn {{ $user->is_active ? 'btn-soft-danger' : 'btn-soft-success' }} w-100 rounded-pill py-2 fw-bold">
                        {{ $user->is_active ? 'Suspend Account' : 'Reactivate Account' }}
                    </button>
                </form>
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('WARNING: This will permanently delete the user account. This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger w-100 rounded-pill py-2 fw-bold">
                        Delete Permanently
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
