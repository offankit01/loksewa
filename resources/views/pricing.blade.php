@extends('layouts.main')

@section('title', 'Pricing Plans - LokSewa Tayari')

@section('extra_css')
    <style>
        .pricing-header {
            background: linear-gradient(135deg, var(--primary-blue), #152c6e);
            color: white;
            padding: 6rem 0 4rem;
            text-align: center;
        }
        .pricing-card {
            background: white;
            border: 1px solid rgba(0,0,0,0.05);
            border-radius: 1.5rem;
            padding: 3rem 2rem;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        .pricing-card.featured {
            border: 2px solid var(--accent-orange);
            transform: scale(1.05);
            z-index: 2;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.05);
        }
        .pricing-card.featured:hover {
            transform: scale(1.05) translateY(-10px);
        }
        .featured-badge {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--accent-orange);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 2rem;
            font-weight: 700;
            font-size: 0.85rem;
        }
        .price-tag {
            font-size: 3rem;
            font-weight: 800;
            color: var(--primary-blue);
            margin: 1.5rem 0;
        }
        .price-tag span {
            font-size: 1rem;
            color: var(--muted-text);
            font-weight: 500;
        }
        .feature-list {
            list-style: none;
            padding: 0;
            margin: 2rem 0;
            flex-grow: 1;
        }
        .feature-list li {
            padding: 0.75rem 0;
            color: var(--muted-text);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .feature-list li i {
            color: #10B981; /* Success Green */
        }
        .feature-list li.disabled {
            color: #CBD5E1;
            text-decoration: line-through;
        }
        .feature-list li.disabled i {
            color: #CBD5E1;
        }
    </style>
@endsection

@section('content')
    <div class="pricing-header">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Simple, Transparent Pricing</h1>
            <p class="lead text-white-50 mx-auto" style="max-width: 600px;">Choose the plan that fits your preparation needs. Invest in your future today.</p>
        </div>
    </div>

    <div class="container py-5 mt-n5">
        <div class="row g-4 align-items-stretch justify-content-center">
            
            @forelse($plans as $plan)
            <div class="col-lg-4 col-md-6">
                <div class="pricing-card {{ $plan->is_popular ? 'featured' : '' }}">
                    @if($plan->is_popular)
                        <div class="featured-badge">MOST POPULAR</div>
                    @endif
                    <h5 class="fw-bold text-muted text-uppercase small">{{ $plan->name }}</h5>
                    <h3 class="fw-bold mb-0">Plan</h3>
                    <div class="price-tag">Rs. {{ number_format($plan->price) }}<span>/{{ $plan->duration }}</span></div>
                    <p class="text-muted small">Comprehensive features for your preparation.</p>
                    
                    <ul class="feature-list">
                        @foreach(explode("\n", $plan->features) as $feature)
                            @if(trim($feature))
                                <li><i class="bi bi-check-circle-fill"></i> {{ trim($feature) }}</li>
                            @endif
                        @endforeach
                    </ul>
                    
                    <a href="{{ route('register') }}" class="btn {{ $plan->is_popular ? 'btn-primary-custom shadow' : 'btn-outline-primary' }} rounded-pill py-3 fw-bold">
                        {{ $plan->is_popular ? 'Get Started Now' : 'Join Now' }}
                    </a>
                </div>
            </div>
            @empty
            <!-- Fallback Static Plans if none in DB -->
            <!-- Free Plan -->
            <div class="col-lg-4 col-md-6">
                <div class="pricing-card">
                    <h5 class="fw-bold text-muted text-uppercase small">Aspirant</h5>
                    <h3 class="fw-bold mb-0">Free</h3>
                    <div class="price-tag">Rs. 0<span>/mo</span></div>
                    <p class="text-muted small">Perfect for beginners exploring the platform.</p>
                    
                    <ul class="feature-list">
                        <li><i class="bi bi-check-circle-fill"></i> Access to basic study notes</li>
                        <li><i class="bi bi-check-circle-fill"></i> 2 Mock tests per month</li>
                        <li><i class="bi bi-check-circle-fill"></i> Daily current affairs</li>
                        <li class="disabled"><i class="bi bi-x-circle-fill"></i> Full Question Bank</li>
                        <li class="disabled"><i class="bi bi-x-circle-fill"></i> Offline PDF Downloads</li>
                        <li class="disabled"><i class="bi bi-x-circle-fill"></i> Performance Analytics</li>
                    </ul>
                    
                    <a href="{{ route('register') }}" class="btn btn-outline-primary rounded-pill py-3 fw-bold">Get Started</a>
                </div>
            </div>

            <!-- Pro Plan -->
            <div class="col-lg-4 col-md-6">
                <div class="pricing-card featured">
                    <div class="featured-badge">MOST POPULAR</div>
                    <h5 class="fw-bold text-primary-blue text-uppercase small">Smart Prep</h5>
                    <h3 class="fw-bold mb-0">Pro</h3>
                    <div class="price-tag">Rs. 999<span>/mo</span></div>
                    <p class="text-muted small">Everything you need to master your exams.</p>
                    
                    <ul class="feature-list">
                        <li><i class="bi bi-check-circle-fill"></i> Unlimited Study Notes</li>
                        <li><i class="bi bi-check-circle-fill"></i> 50+ Mock Tests</li>
                        <li><i class="bi bi-check-circle-fill"></i> Full Question Bank (10 Years)</li>
                        <li><i class="bi bi-check-circle-fill"></i> PDF Downloads</li>
                        <li><i class="bi bi-check-circle-fill"></i> Bilingual Support</li>
                        <li><i class="bi bi-check-circle-fill"></i> Basic Analytics</li>
                    </ul>
                    
                    <a href="{{ route('register') }}" class="btn btn-primary-custom rounded-pill py-3 fw-bold shadow">Unlock Pro Access</a>
                </div>
            </div>
            @endforelse

        </div>

        <div class="mt-5 text-center">
            <p class="text-muted">Questions about our plans? <a href="#" class="text-primary-blue fw-bold">Contact our support team</a></p>
        </div>
    </div>
@endsection
