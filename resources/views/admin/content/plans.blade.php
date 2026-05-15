@extends('layouts.admin')

@section('title', 'Manage Pricing Plans')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none small text-muted">Dashboard</a></li>
    <li class="breadcrumb-item active small" aria-current="page">Pricing Plans</li>
@endsection

@section('page_title', 'Membership Plans')

@section('admin_content')
    <div class="card border-0 shadow-sm rounded-4 bg-white mb-5">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">Existing Plans</h5>
            <button class="btn btn-primary-blue rounded-pill px-4 btn-sm" data-bs-toggle="modal" data-bs-target="#addPlanModal">
                <i class="bi bi-plus-lg me-2"></i>New Plan
            </button>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-muted small fw-medium text-uppercase border-0">Plan Name</th>
                            <th class="text-muted small fw-medium text-uppercase border-0">Price</th>
                            <th class="text-muted small fw-medium text-uppercase border-0">Duration</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-center">Status</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($plans as $plan)
                        <tr>
                            <td class="border-0">
                                <div class="fw-bold text-dark">{{ $plan->name }}</div>
                                @if($plan->is_popular)
                                    <span class="badge bg-accent-orange bg-opacity-10 text-accent-orange extra-small rounded-pill">Popular</span>
                                @endif
                            </td>
                            <td class="border-0 fw-bold text-primary-blue">Rs. {{ number_format($plan->price) }}</td>
                            <td class="border-0 small text-muted text-uppercase">{{ $plan->duration }}</td>
                            <td class="border-0 text-center">
                                @if($plan->is_active)
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 rounded-pill extra-small">Active</span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 rounded-pill extra-small">Disabled</span>
                                @endif
                            </td>
                            <td class="border-0 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <button class="btn btn-sm btn-soft-primary rounded-3 p-2" data-bs-toggle="modal" data-bs-target="#editPlanModal{{ $plan->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('admin.content.plans.destroy', $plan) }}" method="POST" onsubmit="return confirm('Delete this plan?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-soft-danger rounded-3 p-2">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Plan Modal -->
                        <div class="modal fade" id="editPlanModal{{ $plan->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg rounded-4">
                                    <form action="{{ route('admin.content.plans.update', $plan) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-header border-0 pt-4 px-4">
                                            <h5 class="fw-bold m-0">Edit Pricing Plan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label class="form-label small fw-bold">Plan Name</label>
                                                    <input type="text" name="name" class="form-control rounded-3" value="{{ $plan->name }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-bold">Price (NPR)</label>
                                                    <input type="number" name="price" class="form-control rounded-3" value="{{ $plan->price }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-bold">Duration</label>
                                                    <select name="duration" class="form-select rounded-3">
                                                        <option value="monthly" {{ $plan->duration == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                                        <option value="yearly" {{ $plan->duration == 'yearly' ? 'selected' : '' }}>Yearly</option>
                                                        <option value="lifetime" {{ $plan->duration == 'lifetime' ? 'selected' : '' }}>Lifetime</option>
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label small fw-bold">Features (One per line)</label>
                                                    <textarea name="features" class="form-control rounded-3" rows="5" required>{{ $plan->features }}</textarea>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check form-switch mt-2">
                                                        <input class="form-check-input" type="checkbox" name="is_popular" id="pop{{ $plan->id }}" {{ $plan->is_popular ? 'checked' : '' }}>
                                                        <label class="form-check-label small fw-bold" for="pop{{ $plan->id }}">Mark as Popular</label>
                                                    </div>
                                                    <div class="form-check form-switch mt-2">
                                                        <input class="form-check-input" type="checkbox" name="is_active" id="act{{ $plan->id }}" {{ $plan->is_active ? 'checked' : '' }}>
                                                        <label class="form-check-label small fw-bold" for="act{{ $plan->id }}">Active Status</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 pb-4 px-4">
                                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary-blue rounded-pill px-4 fw-bold">Update Plan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted small italic">No pricing plans found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- User Subscriptions Record --}}
    <div class="card border-0 shadow-sm rounded-4 bg-white mb-5">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">Subscription Purchase History</h5>
            <div class="badge bg-primary-blue bg-opacity-10 text-primary-blue px-3 rounded-pill extra-small fw-bold">
                Total: {{ $subscriptions->count() }} Records
            </div>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-muted small fw-medium text-uppercase border-0">User</th>
                            <th class="text-muted small fw-medium text-uppercase border-0">Plan Details</th>
                            <th class="text-muted small fw-medium text-uppercase border-0">Purchase Price</th>
                            <th class="text-muted small fw-medium text-uppercase border-0">Validity</th>
                            <th class="text-muted small fw-medium text-uppercase border-0 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subscriptions as $sub)
                        <tr>
                            <td class="border-0">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar bg-soft-primary text-primary-blue rounded-3 d-flex align-items-center justify-content-center fw-bold" style="width: 38px; height: 38px;">
                                        {{ substr($sub->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold small text-dark">{{ $sub->user->name }}</div>
                                        <div class="extra-small text-muted">{{ $sub->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="border-0">
                                <span class="badge bg-light text-primary-blue rounded-pill px-3 extra-small fw-bold border">{{ $sub->plan->name }}</span>
                                <div class="extra-small text-muted mt-1">{{ ucfirst($sub->plan->duration) }} Access</div>
                            </td>
                            <td class="border-0">
                                <div class="fw-bold small text-dark">Rs. {{ number_format($sub->price_at_purchase) }}</div>
                                <div class="extra-small text-muted">Paid at checkout</div>
                            </td>
                            <td class="border-0">
                                <div class="small text-dark">{{ $sub->starts_at ? \Carbon\Carbon::parse($sub->starts_at)->format('M d, Y') : 'N/A' }}</div>
                                <div class="extra-small text-muted">to {{ $sub->ends_at ? \Carbon\Carbon::parse($sub->ends_at)->format('M d, Y') : 'Lifetime' }}</div>
                            </td>
                            <td class="border-0 text-center">
                                @php
                                    $statusClass = match($sub->status) {
                                        'active' => 'bg-success text-success',
                                        'expired' => 'bg-danger text-danger',
                                        'pending' => 'bg-warning text-warning',
                                        default => 'bg-secondary text-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }} bg-opacity-10 px-3 rounded-pill extra-small fw-bold text-uppercase">{{ $sub->status }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted small italic">No user subscriptions recorded yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Plan Modal -->
    <div class="modal fade" id="addPlanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <form action="{{ route('admin.content.plans.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-0 pt-4 px-4">
                        <h5 class="fw-bold m-0">Create New Plan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold">Plan Name</label>
                                <input type="text" name="name" class="form-control rounded-3" placeholder="e.g. Premium Pro" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Price (NPR)</label>
                                <input type="number" name="price" class="form-control rounded-3" placeholder="999" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Duration</label>
                                <select name="duration" class="form-select rounded-3">
                                    <option value="monthly">Monthly</option>
                                    <option value="yearly">Yearly</option>
                                    <option value="lifetime">Lifetime</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Features (One per line)</label>
                                <textarea name="features" class="form-control rounded-3" rows="5" placeholder="Access to all notes&#10;Unlimited mock tests&#10;24/7 Support" required></textarea>
                            </div>
                            <div class="col-12">
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="is_popular" id="is_popular">
                                    <label class="form-check-label small fw-bold" for="is_popular">Mark as Popular</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pb-4 px-4">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary-blue rounded-pill px-4 fw-bold">Save Plan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('extra_css')
<style>
    .extra-small { font-size: 0.7rem; }
    .btn-soft-primary { background: #eef2ff; color: #4f46e5; border: none; }
    .btn-soft-danger { background: #fef2f2; color: #dc2626; border: none; }
    .btn-soft-primary:hover { background: #4f46e5; color: white; }
    .btn-soft-danger:hover { background: #dc2626; color: white; }
</style>
@endsection
