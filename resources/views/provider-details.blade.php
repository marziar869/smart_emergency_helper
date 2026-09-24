@extends('layouts.app')

@section('title', 'Provider Profile — Smart Emergency Helper')

@section('content')

<style>
/* =========================================================
   PROVIDER DETAILS STYLES (EMBEDDED IN BLADE)
   ========================================================= */

.public-provider-profile {
    background-color: #f8fafc;
    min-height: 100vh;
    padding: 20px 0 32px;
}
.public-provider-container {
    max-width: 960px;
    margin: 0 auto;
    padding: 0 16px;
}

.public-provider-hero {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 18px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 14px;
}
.public-provider-eyebrow {
    font-size: 9.5px;
    font-weight: 800;
    color: #dc2626;
    letter-spacing: 0.8px;
    margin-bottom: 2px;
}
.public-provider-hero h1 {
    font-size: 18px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}
.public-provider-description {
    font-size: 11.5px;
    color: #64748b;
    margin-top: 2px;
}

.public-provider-hero-actions {
    display: flex;
    gap: 8px;
}
.btn-nav-link {
    background: #f8fafc;
    border: 1px solid #cbd5e1;
    color: #334155;
    font-size: 11px;
    font-weight: 700;
    padding: 6px 12px;
    border-radius: 4px;
    text-decoration: none;
}
.btn-req-primary {
    background: #dc2626;
    color: #ffffff;
    font-size: 11px;
    font-weight: 800;
    padding: 6px 14px;
    border-radius: 4px;
    text-decoration: none;
}

.public-provider-metrics {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
    margin-bottom: 14px;
}
.public-provider-metric {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 12px;
}
.public-provider-metric span {
    font-size: 9px;
    font-weight: 800;
    color: #64748b;
    display: block;
    text-transform: uppercase;
}
.public-provider-metric strong {
    font-size: 18px;
    font-weight: 900;
    color: #0f172a;
    display: block;
    margin: 2px 0;
}
.public-provider-metric p {
    font-size: 10px;
    color: #64748b;
    margin: 0;
}

.public-provider-section {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 16px;
}
.public-provider-coverage-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
    margin: 12px 0;
}
.public-provider-coverage-grid div span {
    font-size: 9px;
    font-weight: 800;
    color: #64748b;
    display: block;
}
.public-provider-coverage-grid div strong {
    font-size: 12px;
    color: #0f172a;
}

@media (max-width: 768px) {
    .public-provider-metrics,
    .public-provider-coverage-grid {
        grid-template-columns: 1fr 1fr;
    }
}
</style>

<div class="public-provider-profile">
    <div class="public-provider-container">

        <section class="public-provider-hero">
            <div>
                <p class="public-provider-eyebrow">VERIFIED PROVIDER PROFILE</p>
                <h1>{{ strtoupper($provider->user->name ?? 'Rapid Care Ambulance') }}</h1>
                <p class="public-provider-description">
                    Operating in {{ $provider->area ?? 'Dhanmondi' }}, Dhaka with {{ $provider->experience_years ?? 7 }} years of experience.
                </p>
            </div>

            <div class="public-provider-hero-actions">
                <a href="{{ route('emergency.form') }}" class="btn-req-primary">
                    REQUEST SERVICE
                </a>
                <a href="{{ route('providers') }}" class="btn-nav-link">
                    ← DIRECTORY
                </a>
            </div>
        </section>

        <section class="public-provider-metrics">
            <div class="public-provider-metric">
                <span>Recommendation Score</span>
                <strong style="color:#dc2626;">95 / 100</strong>
                <p>Auditable dispatch rank</p>
            </div>
            <div class="public-provider-metric">
                <span>Average Rating</span>
                <strong style="color:#d97706;">★ {{ number_format($provider->rating ?? 4.9, 1) }}</strong>
                <p>Verified client reviews</p>
            </div>
            <div class="public-provider-metric">
                <span>Location Area</span>
                <strong style="color:#0284c7;">{{ $provider->area ?? 'Dhaka' }}</strong>
                <p>Central coverage hub</p>
            </div>
            <div class="public-provider-metric">
                <span>Experience</span>
                <strong>{{ $provider->experience_years ?? 7 }} Years</strong>
                <p>Professional background</p>
            </div>
        </section>

        <div class="public-provider-section">
            <h2 style="font-size:13px; font-weight:800; color:#0f172a; border-bottom:1px solid #f1f5f9; padding-bottom:8px; margin:0 0 10px;">
                SERVICE COVERAGE & DISPATCH DETAILS
            </h2>
            <div class="public-provider-coverage-grid">
                <div><span>PRIMARY CATEGORY</span><strong>{{ $provider->serviceCategory->name ?? 'Ambulance' }}</strong></div>
                <div><span>BASE ZONE</span><strong>{{ $provider->area ?? 'Dhanmondi' }}, Dhaka</strong></div>
                <div><span>PHONE CONTACT</span><strong>{{ $provider->user->phone ?? '+880 1711-004101' }}</strong></div>
                <div><span>STATUS</span><strong style="color:#16a34a;">● AVAILABLE</strong></div>
            </div>
        </div>

    </div>
</div>

@endsection