@extends('layouts.dashboard')

@section('title', 'Upgrade Plan')

@section('extra_css')
<style>
    .plan-card {
        background: white;
        border-radius: 1.5rem;
        padding: 2.5rem;
        border: 1px solid rgba(0,0,0,0.05);
        position: relative;
        transition: all 0.3s ease;
        height: 100%;
    }
    .plan-card.recommended {
        border-color: var(--primary-blue);
        background: linear-gradient(135deg, white 0%, rgba(30, 58, 138, 0.02) 100%);
    }
    .plan-card.recommended::before {
        content: 'Recommended';
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--primary-blue);
        color: white;
        padding: 4px 16px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .price-value { font-size: 3rem; font-weight: 800; color: var(--primary-blue); }
    .price-symbol { font-size: 1.5rem; vertical-align: super; font-weight: 600; margin-right: 4px; }
    
    .current-plan-banner {
        background: var(--primary-blue);
        color: white;
        border-radius: 1.25rem;
        padding: 2rem;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
    }
    .current-plan-banner::after {
        content: '';
        position: absolute;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
        bottom: -100px;
        right: -50px;
    }
</style>
@endsection

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h3 class="fw-bold mb-1">Upgrade Your Plan</h3>
        <p class="text-muted small mb-0">Unlock premium features and accelerate your preparation</p>
    </div>
</div>

<!-- Current Plan Banner -->
<div class="current-plan-banner shadow-sm">
    <div class="row align-items-center">
        <div class="col-md-8">
            <div class="d-flex align-items-center gap-3 mb-2">
                <span class="badge rounded-pill fw-bold small" style="background: rgba(255,255,255,0.15); color: white; border: 1px solid rgba(255,255,255,0.2); padding: 0.5rem 1rem;">
                    <i class="bi bi-star-fill text-accent-orange me-1"></i> Current Plan
                </span>
                <h4 class="fw-bold mb-0 text-white">{{ $currentPlan['name'] }}</h4>
            </div>
            <p class="text-white-50 mb-0">Your plan is active and expires on <span class="text-white fw-bold">{{ $currentPlan['expiry'] }}</span>.</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <div class="bg-white bg-opacity-10 p-3 rounded-4 d-inline-block text-start">
                <div class="small text-white-50">Monthly Value</div>
                <div class="h4 fw-bold mb-0 text-white">Rs. {{ $currentPlan['price'] }}</div>
            </div>
        </div>
    </div>
</div>

<h5 class="fw-bold mb-4">Available Upgrades</h5>
<div class="row g-4">
    @foreach($availablePlans as $plan)
    <div class="col-lg-6">
        <div class="plan-card shadow-sm {{ $plan['recommended'] ? 'recommended' : '' }}">
            <div class="mb-4">
                <h4 class="fw-bold mb-1">{{ $plan['name'] }}</h4>
                <p class="text-muted small">{{ $plan['duration'] }}</p>
            </div>
            
            <div class="mb-4">
                <span class="price-symbol">Rs.</span>
                <span class="price-value">{{ $plan['price'] }}</span>
            </div>
            
            <ul class="list-unstyled mb-5">
                @foreach($plan['features'] as $feature)
                <li class="mb-3 d-flex align-items-center gap-3">
                    <i class="bi bi-check-circle-fill text-success"></i>
                    <span class="text-dark">{{ $feature }}</span>
                </li>
                @endforeach
            </ul>
            
            <button class="btn {{ $plan['recommended'] ? 'btn-primary-custom' : 'btn-outline-primary border-primary-blue text-primary-blue' }} w-100 rounded-pill py-3 fw-bold">
                Upgrade to {{ $plan['name'] }}
            </button>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-5 p-4 bg-white rounded-4 border border-dashed border-primary-blue border-opacity-25 text-center">
    <p class="text-muted mb-0">Looking for institutional or group discounts? <a href="#" class="text-primary-blue fw-bold">Contact our sales team</a></p>
</div>
@endsection
