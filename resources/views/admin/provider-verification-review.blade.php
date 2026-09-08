@extends('layouts.app')

@section('content')

<div class="provider-review-page">
    <div class="provider-review-container">

        <!-- HEADER -->
        <div class="provider-review-header">
            <div>
                <p class="provider-review-eyebrow">ADMIN CONTROL</p>
                <h1>PROVIDER VERIFICATION REVIEW</h1>
                <p class="provider-review-subtitle">
                    {{ $provider->user->name ?? 'Provider' }}
                    · PRV-{{ 1000 + $provider->id }}
                    · {{ $provider->serviceCategory->name ?? 'Category' }}
                    · Area: {{ $provider->area }}
                </p>
                <a href="{{ route('admin.dashboard') }}" class="provider-back-link">
                    ← BACK TO DASHBOARD
                </a>
            </div>

            <div id="providerReviewStatus" class="provider-review-status status-under-review">
                {{ strtoupper($provider->approval_status) }}
            </div>
        </div>

        <!-- DETAILS GRID -->
        <div class="provider-review-grid">
            <section class="provider-review-card">
                <h3>PHONE OWNERSHIP</h3>
                <p class="provider-phone">
                    Phone: <strong>{{ $provider->user->phone ?? 'N/A' }}</strong>
                </p>
                <span class="provider-verified-text">
                    {{ $provider->phone_verified ? 'OTP VERIFIED' : 'UNVERIFIED' }}
                </span>
            </section>

            <section class="provider-review-card">
                <h3>REGISTRATION</h3>
                <p class="provider-registration-date">
                    Created: <strong>{{ $provider->created_at ? $provider->created_at->format('d M Y') : 'N/A' }}</strong>
                </p>
            </section>

            <section class="provider-review-card" style="grid-column: span 2;">
                <h3>APPLICATION DETAILS</h3>
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; margin-top: 15px;">
                    <div>
                        <span>SERVICE CATEGORY</span><br>
                        <strong>{{ $provider->serviceCategory->name ?? 'N/A' }}</strong>
                    </div>
                    <div>
                        <span>EXPERIENCE</span><br>
                        <strong>{{ $provider->experience_years }} Years</strong>
                    </div>
                    <div>
                        <span>SERVICE AREA</span><br>
                        <strong>{{ $provider->area }}</strong>
                    </div>
                    <div>
                        <span>EMAIL</span><br>
                        <strong>{{ $provider->user->email ?? 'N/A' }}</strong>
                    </div>
                </div>
            </section>
        </div>

        <!-- ACTION BUTTONS -->
        <div class="provider-review-actions" style="margin-top: 30px; display: flex; gap: 15px;">
            <form action="{{ route('admin.provider.approve', $provider->id) }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="provider-action-btn approve-provider-btn" style="background: #16a34a; color: #fff; border: none; padding: 12px 24px; font-weight: 700; cursor: pointer;">
                    APPROVE PROVIDER
                </button>
            </form>

            <form action="{{ route('admin.provider.reject', $provider->id) }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="provider-action-btn reject-provider-btn" style="background: #dc2626; color: #fff; border: none; padding: 12px 24px; font-weight: 700; cursor: pointer;">
                    REJECT PROVIDER
                </button>
            </form>
        </div>

        <p class="provider-review-footer-note" style="margin-top: 20px;">
            Only providers marked Approved receive Verified Provider status and become eligible to receive service requests.
        </p>

    </div>
</div>

@endsection