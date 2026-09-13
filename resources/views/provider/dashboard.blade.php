@extends('layouts.app')

@section('title', 'Provider Dashboard — Smart Emergency Helper')

@section('content')

<style>
/* =========================================================
   PREMIUM PROVIDER DASHBOARD STYLES
   ========================================================= */
.provider-dashboard-page {
    background: #F7F4ED;
    padding: 30px 0 60px;
    min-height: calc(100vh - 90px);
}

.provider-dashboard-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 30px;
}

/* Flash Alerts */
.custom-alert {
    padding: 14px 20px;
    border-radius: 12px;
    margin-bottom: 24px;
    font-weight: 600;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}
.custom-alert-success {
    background: #ecfdf5;
    border: 1px solid #10b981;
    color: #065f46;
}
.custom-alert-danger {
    background: #fef2f2;
    border: 1px solid #ef4444;
    color: #991b1b;
}

/* Header Section */
.provider-header-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 28px 32px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    margin-bottom: 24px;
}

.provider-header-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 12px;
}

.provider-title-group h1 {
    font-size: 26px;
    font-weight: 900;
    letter-spacing: -0.5px;
    color: #0f172a;
    margin: 0 0 6px 0;
    display: flex;
    align-items: center;
    gap: 12px;
}

.status-badge-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.status-badge-available {
    background: #d1fae5;
    color: #047857;
    border: 1px solid #6ee7b7;
}
.status-badge-offline {
    background: #fee2e2;
    color: #b91c1c;
    border: 1px solid #fca5a5;
}
.pulse-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
}
.pulse-green {
    background: #10b981;
    box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
    animation: pulseGreen 2s infinite;
}
.pulse-red {
    background: #ef4444;
}

@keyframes pulseGreen {
    0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
    70% { transform: scale(1); box-shadow: 0 0 0 8px rgba(16, 185, 129, 0); }
    100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
}

.provider-nav-links {
    display: flex;
    gap: 16px;
}
.provider-nav-links a {
    font-size: 13px;
    font-weight: 700;
    color: #475569;
    text-decoration: none;
    padding: 8px 16px;
    border-radius: 8px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    transition: all 0.2s ease;
}
.provider-nav-links a:hover {
    background: #0f172a;
    color: #ffffff;
    border-color: #0f172a;
}

.provider-status-controls {
    display: flex;
    gap: 8px;
    background: #f1f5f9;
    padding: 6px;
    border-radius: 12px;
    width: fit-content;
}

.status-toggle-btn {
    border: none;
    background: transparent;
    padding: 10px 22px;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 0.8px;
    border-radius: 8px;
    color: #64748b;
    cursor: pointer;
    transition: all 0.25s ease;
}

.status-toggle-btn.active-available {
    background: #059669;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
}

.status-toggle-btn.active-busy {
    background: #d97706;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(217, 119, 6, 0.3);
}

.status-toggle-btn.active-offline {
    background: #475569;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(71, 85, 105, 0.3);
}

/* Grid Layout */
.dashboard-grid-4 {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 28px;
}

@media (max-width: 1024px) {
    .dashboard-grid-4 {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (max-width: 640px) {
    .dashboard-grid-4 {
        grid-template-columns: 1fr;
    }
}

.stat-card-premium {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 22px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 4px 14px rgba(0,0,0,0.02);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.stat-card-premium:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 24px rgba(0,0,0,0.06);
}

.stat-card-info .stat-label {
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #64748b;
    margin-bottom: 6px;
}

.stat-card-info .stat-number {
    font-size: 30px;
    font-weight: 900;
    line-height: 1;
    color: #0f172a;
}

.stat-icon-wrapper {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.icon-green { background: #d1fae5; color: #059669; }
.icon-blue { background: #dbeafe; color: #2563eb; }
.icon-amber { background: #fef3c7; color: #d97706; }
.icon-purple { background: #f3e8ff; color: #7c3aed; }

/* Main Dashboard Two-Column Layout */
.dashboard-main-layout {
    display: grid;
    grid-template-columns: 340px 1fr;
    gap: 28px;
    align-items: start;
}

@media (max-width: 992px) {
    .dashboard-main-layout {
        grid-template-columns: 1fr;
    }
}

/* Left Column: Pending Feed */
.alerts-feed-column {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 18px;
    padding: 24px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.03);
}

.alerts-feed-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    padding-bottom: 14px;
    border-bottom: 2px solid #f1f5f9;
}

.alerts-feed-header h2 {
    font-size: 15px;
    font-weight: 900;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    color: #0f172a;
    margin: 0;
}

.alert-card-item {
    background: #fff8f8;
    border: 1.5px solid #fecaca;
    border-radius: 14px;
    padding: 18px;
    margin-bottom: 16px;
    transition: all 0.2s ease;
}
.alert-card-item:hover {
    border-color: #ef4444;
    box-shadow: 0 6px 16px rgba(239, 68, 68, 0.12);
}

.alert-item-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}
.alert-ref {
    font-size: 13px;
    font-weight: 800;
    color: #1e293b;
}
.priority-tag {
    font-size: 10px;
    font-weight: 900;
    padding: 3px 8px;
    border-radius: 6px;
    letter-spacing: 0.5px;
}
.tag-critical { background: #ef4444; color: #ffffff; }
.tag-high { background: #f59e0b; color: #ffffff; }
.tag-normal { background: #3b82f6; color: #ffffff; }

.alert-desc {
    font-size: 13px;
    font-weight: 600;
    color: #334155;
    line-height: 1.4;
    margin-bottom: 12px;
}
.alert-location {
    font-size: 12px;
    font-weight: 600;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 4px;
    margin-bottom: 14px;
}

.alert-btn-group {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}
.btn-accept-alert {
    background: #e11d48;
    color: #ffffff;
    border: none;
    padding: 10px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 800;
    cursor: pointer;
    width: 100%;
    transition: background 0.2s ease;
}
.btn-accept-alert:hover { background: #be123c; }

.btn-decline-alert {
    background: #ffffff;
    color: #64748b;
    border: 1px solid #cbd5e1;
    padding: 10px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 800;
    cursor: pointer;
    width: 100%;
    transition: all 0.2s ease;
}
.btn-decline-alert:hover { background: #f1f5f9; color: #0f172a; }

/* Right Column: Active Job Card */
.active-job-panel {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 18px;
    padding: 28px 32px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.03);
}

.active-job-header-box {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 20px;
    padding-bottom: 22px;
    border-bottom: 2px solid #f1f5f9;
    margin-bottom: 24px;
}

.active-job-title h2 {
    font-size: 22px;
    font-weight: 900;
    color: #0f172a;
    margin: 0 0 8px 0;
    letter-spacing: -0.3px;
}

.customer-detail-meta {
    font-size: 14px;
    color: #475569;
    line-height: 1.6;
}

.active-job-badges-group {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
.badge-service-cat {
    background: #eff6ff;
    color: #1d4ed8;
    border: 1px solid #bfdbfe;
    font-weight: 800;
    font-size: 12px;
    padding: 6px 14px;
    border-radius: 20px;
}
.badge-phase-tag {
    background: #0f172a;
    color: #ffffff;
    font-weight: 800;
    font-size: 12px;
    padding: 6px 14px;
    border-radius: 20px;
}

/* Stepper Progress Track */
.job-stepper-track {
    display: flex;
    justify-content: space-between;
    position: relative;
    margin: 28px 0 36px 0;
    background: #f8fafc;
    padding: 16px;
    border-radius: 14px;
    border: 1px solid #e2e8f0;
    gap: 8px;
    overflow-x: auto;
}

.step-node {
    flex: 1;
    text-align: center;
    padding: 10px 8px;
    font-size: 11px;
    font-weight: 800;
    color: #94a3b8;
    border-radius: 8px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    letter-spacing: 0.5px;
    white-space: nowrap;
    transition: all 0.3s ease;
}

.step-node.completed-step {
    background: #d1fae5;
    color: #047857;
    border-color: #a7f3d0;
}

.step-node.active-step {
    background: #2563eb;
    color: #ffffff;
    border-color: #2563eb;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
}

/* Site & Incident Grid */
.job-inner-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-bottom: 30px;
}
@media (max-width: 768px) {
    .job-inner-grid { grid-template-columns: 1fr; }
}

.inner-sub-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 20px;
}
.inner-sub-card h3 {
    font-size: 15px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 16px;
    padding-bottom: 8px;
    border-bottom: 1px solid #cbd5e1;
}

.photo-boxes-wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}

.upload-box-style {
    background: #ffffff;
    border: 2px dashed #cbd5e1;
    border-radius: 12px;
    padding: 16px 12px;
    text-align: center;
    cursor: pointer;
    transition: border-color 0.2s ease;
}
.upload-box-style:hover {
    border-color: #2563eb;
}

/* Action Box */
.action-box-banner {
    background: #0f172a;
    color: #ffffff;
    border-radius: 16px;
    padding: 28px;
    text-align: center;
    box-shadow: 0 8px 24px rgba(15, 23, 42, 0.15);
}
.action-box-banner h4 {
    font-size: 13px;
    font-weight: 800;
    letter-spacing: 1.5px;
    color: #94a3b8;
    margin-bottom: 16px;
    text-transform: uppercase;
}

.btn-primary-action {
    background: #e11d48;
    color: #ffffff;
    border: none;
    padding: 16px 36px;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 900;
    letter-spacing: 0.5px;
    cursor: pointer;
    width: 100%;
    max-width: 480px;
    box-shadow: 0 6px 18px rgba(225, 29, 72, 0.35);
    transition: all 0.25s ease;
}
.btn-primary-action:hover {
    background: #be123c;
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(225, 29, 72, 0.45);
}

.pin-input-field {
    background: #ffffff;
    border: 2px solid #38bdf8;
    border-radius: 10px;
    padding: 12px 18px;
    font-size: 20px;
    font-weight: 900;
    text-align: center;
    letter-spacing: 6px;
    color: #0f172a;
    width: 240px;
    margin: 0 auto 16px auto;
    display: block;
}

.protocol-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.protocol-list li {
    font-size: 13px;
    font-weight: 600;
    color: #64748b;
    padding: 10px 12px;
    border-radius: 8px;
    margin-bottom: 8px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    gap: 10px;
}
.protocol-list li.complete {
    background: #ecfdf5;
    color: #047857;
    border-color: #a7f3d0;
    font-weight: 700;
}
.protocol-list li.complete::before {
    content: "✓";
    font-weight: 900;
}
.protocol-list li:not(.complete)::before {
    content: "○";
    color: #94a3b8;
}
</style>

<section class="provider-dashboard-page">

<div class="provider-dashboard-container">

{{-- Flash Messages --}}
@if(session('success'))
    <div class="custom-alert custom-alert-success">
        <i class="bi bi-check-circle-fill fs-5"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if(session('error'))
    <div class="custom-alert custom-alert-danger">
        <i class="bi bi-exclamation-triangle-fill fs-5"></i>
        <span>{{ session('error') }}</span>
    </div>
@endif

{{-- ===========================
 HEADER CARD
=========================== --}}

<div class="provider-header-card">

<div class="provider-header-top">

<div class="provider-title-group">
    <h1>
        <span>PROVIDER FEED</span>
        @php
            $isAvailable = $providerProfile->is_available ?? true;
        @endphp
        <span class="status-badge-pill {{ $isAvailable ? 'status-badge-available' : 'status-badge-offline' }}">
            <span class="pulse-dot {{ $isAvailable ? 'pulse-green' : 'pulse-red' }}"></span>
            {{ $isAvailable ? 'Available' : 'Offline / Busy' }}
        </span>
    </h1>
    <p style="font-size: 13px; color: #64748b; margin: 0;">
        Only Available + Verified + Active providers receive new emergency requests.
    </p>
</div>

<div class="provider-nav-links">
    <a href="{{ route('provider.profile') }}">
        <i class="bi bi-person-badge me-1"></i> Profile & Trust
    </a>
    <a href="{{ route('provider.verification') }}">
        <i class="bi bi-shield-check me-1"></i> Verification
    </a>
</div>

</div>

<div class="provider-status-controls mt-3">

<form method="POST" action="{{ route('provider.availability.update') }}" style="display:inline;">
    @csrf
    <input type="hidden" name="availability" value="available">
    <button type="submit" class="status-toggle-btn {{ $isAvailable ? 'active-available' : '' }}">
        AVAILABLE
    </button>
</form>






<form method="POST" action="{{ route('provider.availability.update') }}" style="display:inline;">
    @csrf
    <input type="hidden" name="availability" value="busy">
    <button type="submit" class="status-toggle-btn {{ !$isAvailable ? 'active-busy' : '' }}">
        BUSY
    </button>
</form>

<form method="POST" action="{{ route('provider.availability.update') }}" style="display:inline;">
    @csrf
    <input type="hidden" name="availability" value="offline">
    <button type="submit" class="status-toggle-btn">
        OFFLINE
    </button>
</form>

</div>

</div>

{{-- ===========================
 STATS SUMMARY CARDS (GRID-4)
=========================== --}}

<div class="dashboard-grid-4">

<div class="stat-card-premium">
    <div class="stat-card-info">
        <div class="stat-label">Completed Today</div>
        <div class="stat-number" style="color: #059669;">{{ $stats['completed_today'] ?? 0 }}</div>
    </div>
    <div class="stat-icon-wrapper icon-green">
        <i class="bi bi-check2-circle"></i>
    </div>
</div>

<div class="stat-card-premium">
    <div class="stat-card-info">
        <div class="stat-label">Total Completed</div>
        <div class="stat-number" style="color: #2563eb;">{{ $stats['total_completed'] ?? 0 }}</div>
    </div>
    <div class="stat-icon-wrapper icon-blue">
        <i class="bi bi-trophy"></i>
    </div>
</div>

<div class="stat-card-premium">
    <div class="stat-card-info">
        <div class="stat-label">Pending Alerts</div>
        <div class="stat-number" id="pendingCountBadge" style="color: #d97706;">{{ $stats['pending_count'] ?? 0 }}</div>
    </div>
    <div class="stat-icon-wrapper icon-amber">
        <i class="bi bi-bell-fill"></i>
    </div>
</div>

<div class="stat-card-premium">
    <div class="stat-card-info">
        <div class="stat-label">Provider Rating</div>
        <div class="stat-number" style="color: #7c3aed;">★ {{ number_format($stats['rating'] ?? 4.9, 1) }}</div>
    </div>
    <div class="stat-icon-wrapper icon-purple">
        <i class="bi bi-star-fill"></i>
    </div>
</div>

</div>

{{-- ===========================
 MAIN TWO-COLUMN LAYOUT
=========================== --}}

<div class="dashboard-main-layout">

{{-- LEFT COLUMN: PENDING ALERTS FEED --}}
<div class="alerts-feed-column">

<div class="alerts-feed-header">
    <h2>
        <i class="bi bi-broadcast me-2 text-danger"></i> Live Alerts
    </h2>
    <span class="badge bg-danger rounded-pill" style="font-size: 11px;">LIVE</span>
</div>

@forelse($requests as $request)

<div class="alert-card-item">

<div class="alert-item-header">
    <span class="alert-ref">#{{ $request->reference }}</span>
    <span class="priority-tag {{ strtolower($request->priority) === 'critical' ? 'tag-critical' : (strtolower($request->priority) === 'high' ? 'tag-high' : 'tag-normal') }}">
        {{ strtoupper($request->priority) }}
    </span>
</div>

<div class="alert-desc">
    {{ $request->description }}
</div>

<div class="alert-location">
    <i class="bi bi-geo-alt-fill text-danger"></i>
    <span>{{ $request->area }}</span>
</div>

<div class="alert-btn-group">
    <form method="POST" action="{{ route('provider.request.accept', $request->id) }}">
        @csrf
        <button type="submit" class="btn-accept-alert">
            ACCEPT
        </button>
    </form>
    <form method="POST" action="{{ route('provider.request.reject', $request->id) }}">
        @csrf
        <button type="submit" class="btn-decline-alert">
            DECLINE
        </button>
    </form>
</div>

</div>

@empty

<div style="text-align: center; padding: 30px 10px; color: #94a3b8;">
    <i class="bi bi-inbox fs-2 mb-2 d-block"></i>
    <p style="font-size: 13px; font-weight: 600; margin: 0;">No pending alerts at the moment.</p>
</div>

@endforelse

<p style="font-size: 11px; color: #94a3b8; line-height: 1.4; margin-top: 16px;">
    Declined or expired requests automatically move to the next eligible provider.
</p>

</div>

{{-- RIGHT COLUMN: ACTIVE JOB COMMAND CENTER --}}
<div class="active-job-panel">

<div class="active-job-header-box">

<div>

@if($activeJob)

<h2>ACTIVE JOB: {{ $activeJob->reference }}</h2>
<div class="customer-detail-meta">
    <div><strong>Customer:</strong> {{ $activeJob->customer->name ?? 'Emergency Customer' }} ({{ $activeJob->customer->phone ?? 'N/A' }})</div>
    <div><strong>Address:</strong> {{ $activeJob->address }}, {{ $activeJob->area }}</div>
    <div><strong>Issue:</strong> {{ $activeJob->description }}</div>
</div>

<div style="display: flex; gap: 12px; margin-top: 12px; flex-wrap: wrap;">
    <span style="background: #f1f5f9; border: 1px solid #cbd5e1; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 700; color: #334155;">
        🔑 Arrival PIN: <strong style="color: #2563eb;">{{ $activeJob->arrival_pin ?? '8492' }}</strong>
    </span>
    <span style="background: #f1f5f9; border: 1px solid #cbd5e1; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 700; color: #334155;">
        🏁 Completion PIN: <strong style="color: #059669;">{{ $activeJob->completion_pin ?? '1920' }}</strong>
    </span>
</div>

<div style="display: flex; gap: 10px; margin-top: 14px; flex-wrap: wrap;">
    @if(!empty($activeJob->customer->phone))
        <a href="tel:{{ $activeJob->customer->phone }}" style="background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 800; text-decoration: none;">
            📞 Call Customer
        </a>
    @endif
    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($activeJob->address . ', ' . $activeJob->area) }}" target="_blank" style="background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 800; text-decoration: none;">
        📍 Open Navigation (Google Maps)
    </a>
</div>

@else

<h2>NO ACTIVE JOB</h2>
<p style="color: #64748b; font-size: 14px; margin: 0;">Accept a pending alert from the live feed to start an emergency response job.</p>

@endif

</div>

<div class="active-job-badges-group">

<span class="badge-service-cat">
    @if($activeJob)
        {{ $activeJob->serviceCategory->name ?? 'SERVICE' }}
    @else
        NO SERVICE
    @endif
</span>

<span class="badge-phase-tag">
    PHASE:
    @if($activeJob)
        {{ strtoupper(str_replace('_', ' ', $activeJob->status)) }}
    @else
        -
    @endif
</span>

</div>

</div>

{{-- STEPPER PROGRESS TRACK --}}

@php
    $currentStatus = $activeJob->status ?? '';
@endphp

<div class="job-stepper-track">

<div class="step-node {{ in_array($currentStatus, ['accepted', 'provider_assigned', 'provider_on_way', 'arrived', 'working', 'completed']) ? ($currentStatus === 'accepted' || $currentStatus === 'provider_assigned' ? 'active-step' : 'completed-step') : '' }}">
    1. ACCEPTED
</div>

<div class="step-node {{ in_array($currentStatus, ['provider_on_way', 'arrived', 'working', 'completed']) ? ($currentStatus === 'provider_on_way' ? 'active-step' : 'completed-step') : '' }}">
    2. ON THE WAY
</div>

<div class="step-node {{ in_array($currentStatus, ['arrived', 'working', 'completed']) ? ($currentStatus === 'arrived' ? 'active-step' : 'completed-step') : '' }}">
    3. ARRIVED
</div>

<div class="step-node {{ in_array($currentStatus, ['working', 'completed']) ? ($currentStatus === 'working' ? 'active-step' : 'completed-step') : '' }}">
    4. WORKING
</div>

<div class="step-node {{ $currentStatus === 'completed' ? 'active-step' : '' }}">
    5. COMPLETED
</div>

</div>

{{-- INNER GRID: SITE ASSESSMENT & INCIDENT PROTOCOL --}}

<div class="job-inner-grid">

{{-- Site Assessment Photo Box --}}
<div class="inner-sub-card">
    <h3>Site Assessment</h3>

    @if($activeJob)

    <div class="photo-boxes-wrapper">

        <div class="upload-box-style">
            @if($activeJob->before_photo)
                <img src="{{ asset('storage/' . $activeJob->before_photo) }}" alt="Before Service" style="width: 100%; height: 95px; object-fit: cover; border-radius: 8px;">
                <div style="font-size: 11px; font-weight: 800; color: #059669; margin-top: 6px;">✓ Before Photo</div>
            @else
                <form method="POST" action="{{ route('provider.request.upload_photo', $activeJob->id) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="photo_type" value="before">
                    <label for="beforePhotoInput" style="cursor: pointer;">
                        <i class="bi bi-camera-fill fs-3 text-secondary d-block mb-1"></i>
                        <span style="font-size: 11px; font-weight: 800; color: #475569;">BEFORE PHOTO</span>
                    </label>
                    <input type="file" id="beforePhotoInput" name="photo" accept="image/*" onchange="this.form.submit()" hidden>
                </form>
                <div style="font-size: 10px; color: #94a3b8; margin-top: 4px;">Pending Upload</div>
            @endif
        </div>

        <div class="upload-box-style">
            @if($activeJob->after_photo)
                <img src="{{ asset('storage/' . $activeJob->after_photo) }}" alt="After Service" style="width: 100%; height: 95px; object-fit: cover; border-radius: 8px;">
                <div style="font-size: 11px; font-weight: 800; color: #059669; margin-top: 6px;">✓ After Photo</div>
            @else
                <form method="POST" action="{{ route('provider.request.upload_photo', $activeJob->id) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="photo_type" value="after">
                    <label for="afterPhotoInput" style="cursor: pointer;">
                        <i class="bi bi-camera-fill fs-3 text-secondary d-block mb-1"></i>
                        <span style="font-size: 11px; font-weight: 800; color: #475569;">AFTER PHOTO</span>
                    </label>
                    <input type="file" id="afterPhotoInput" name="photo" accept="image/*" onchange="this.form.submit()" hidden>
                </form>
                <div style="font-size: 10px; color: #94a3b8; margin-top: 4px;">Pending Upload</div>
            @endif
        </div>

    </div>

    @else
        <p style="font-size: 12px; color: #94a3b8; margin: 0; text-align: center;">No active job for site photos.</p>
    @endif
</div>

{{-- Incident Protocol Box --}}
<div class="inner-sub-card">
    <h3>Incident Protocol</h3>

    @php
        $categoryName = strtolower($activeJob->serviceCategory->name ?? '');
    @endphp

    <ul class="protocol-list">
    @if(str_contains($categoryName, 'ambulance'))
        <li class="{{ in_array($currentStatus, ['accepted', 'provider_assigned', 'provider_on_way', 'arrived', 'working', 'completed']) ? 'complete' : '' }}">
            Establish perimeter & contact customer
        </li>
        <li class="{{ in_array($currentStatus, ['provider_on_way', 'arrived', 'working', 'completed']) ? 'complete' : '' }}">
            Navigate to location & check vitals
        </li>
        <li class="{{ in_array($currentStatus, ['arrived', 'working', 'completed']) ? 'complete' : '' }}">
            Provide emergency stabilization
        </li>
        <li class="{{ $currentStatus === 'completed' ? 'complete' : '' }}">
            Transport & signal hospital ready
        </li>
    @elseif(str_contains($categoryName, 'electrician'))
        <li class="{{ in_array($currentStatus, ['accepted', 'provider_assigned', 'provider_on_way', 'arrived', 'working', 'completed']) ? 'complete' : '' }}">
            Establish perimeter & cut main power
        </li>
        <li class="{{ in_array($currentStatus, ['provider_on_way', 'arrived', 'working', 'completed']) ? 'complete' : '' }}">
            Diagnose short circuit & fault
        </li>
        <li class="{{ in_array($currentStatus, ['arrived', 'working', 'completed']) ? 'complete' : '' }}">
            Repair wiring & replace blown parts
        </li>
        <li class="{{ $currentStatus === 'completed' ? 'complete' : '' }}">
            Restore power safely & verify load
        </li>
    @else
        <li class="{{ in_array($currentStatus, ['accepted', 'provider_assigned', 'provider_on_way', 'arrived', 'working', 'completed']) ? 'complete' : '' }}">
            Establish contact & confirm location
        </li>
        <li class="{{ in_array($currentStatus, ['provider_on_way', 'arrived', 'working', 'completed']) ? 'complete' : '' }}">
            Navigate to target emergency site
        </li>
        <li class="{{ in_array($currentStatus, ['arrived', 'working', 'completed']) ? 'complete' : '' }}">
            Assess situation & execute service
        </li>
        <li class="{{ $currentStatus === 'completed' ? 'complete' : '' }}">
            Verify resolution & mark completed
        </li>
    @endif
    </ul>
</div>

</div>

{{-- NEXT ACTION TRIGGER BANNER --}}

<div class="action-box-banner">

<h4>NEXT REQUIRED ACTION</h4>

@if(!$activeJob)

    <button type="button" style="background: #475569; color: #94a3b8; border: none; padding: 14px 28px; border-radius: 10px; font-weight: 800; cursor: not-allowed;" disabled>
        NO ACTIVE JOB AVAILABLE
    </button>

@elseif(in_array($currentStatus, ['accepted', 'provider_assigned']))

    <form method="POST" action="{{ route('provider.request.status', $activeJob->id) }}">
        @csrf
        <input type="hidden" name="status" value="provider_on_way">
        <button type="submit" class="btn-primary-action">
            START DRIVING — MARK ON THE WAY →
        </button>
    </form>

@elseif($currentStatus === 'provider_on_way')

    <form method="POST" action="{{ route('provider.request.status', $activeJob->id) }}">
        @csrf
        <input type="hidden" name="status" value="arrived">
        <div style="margin-bottom: 16px;">
            <label style="font-size: 12px; font-weight: 700; color: #cbd5e1; display: block; margin-bottom: 8px;">
                🔑 Enter Customer's Arrival PIN (Demo PIN: {{ $activeJob->arrival_pin }})
            </label>
            <input type="text" name="pin" class="pin-input-field" placeholder="{{ $activeJob->arrival_pin }}" required maxlength="6">
        </div>
        <button type="submit" class="btn-primary-action">
            VERIFY ARRIVAL PIN & MARK ARRIVED →
        </button>
    </form>

@elseif($currentStatus === 'arrived')

    <form method="POST" action="{{ route('provider.request.status', $activeJob->id) }}">
        @csrf
        <input type="hidden" name="status" value="working">
        <button type="submit" class="btn-primary-action">
            START EMERGENCY SERVICE — MARK WORKING →
        </button>
    </form>

@elseif($currentStatus === 'working')

    <form method="POST" action="{{ route('provider.request.status', $activeJob->id) }}">
        @csrf
        <input type="hidden" name="status" value="completed">
        <div style="margin-bottom: 16px;">
            <label style="font-size: 12px; font-weight: 700; color: #cbd5e1; display: block; margin-bottom: 8px;">
                🏁 Enter Customer's Completion PIN (Demo PIN: {{ $activeJob->completion_pin }})
            </label>
            <input type="text" name="pin" class="pin-input-field" style="border-color: #10b981;" placeholder="{{ $activeJob->completion_pin }}" required maxlength="6">
        </div>
        <button type="submit" class="btn-primary-action" style="background: #059669; box-shadow: 0 6px 18px rgba(5, 150, 105, 0.35);">
            VERIFY COMPLETION PIN & COMPLETE SERVICE ✓
        </button>
    </form>

@elseif($currentStatus === 'completed')

    <button type="button" class="btn-primary-action" style="background: #059669; box-shadow: none; cursor: default;" disabled>
        ✓ JOB COMPLETED SUCCESSFULLY
    </button>

@endif

</div>

</div>

</div>

</div>

</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    let lastCount = {{ $requests->count() }};
    const apiUrl = "{{ route('provider.api.pending_alerts') }}";

    function checkPendingAlerts() {
        fetch(apiUrl)
            .then(res => res.json())
            .then(data => {
                const countElem = document.getElementById('pendingCountBadge');
                if (countElem) {
                    countElem.textContent = data.count;
                }
                if (data.count > lastCount) {
                    lastCount = data.count;
                    try {
                        const audio = new Audio('https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3');
                        audio.play();
                    } catch(e) {}
                    window.location.reload();
                } else {
                    lastCount = data.count;
                }
            })
            .catch(err => console.log('Polling error:', err));
    }

    setInterval(checkPendingAlerts, 8000);
});
</script>

@endsection