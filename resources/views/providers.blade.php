@extends('layouts.app')

@section('title', 'Verified Provider Directory — Smart Emergency Helper')

@section('content')

<style>
/* =========================================================
   PROVIDERS DIRECTORY STYLES (EMBEDDED IN BLADE)
   ========================================================= */

.providers-page {
    background-color: #f8fafc;
    min-height: 100vh;
    padding: 20px 0 32px;
}
.providers-container {
    max-width: 1040px;
    margin: 0 auto;
    padding: 0 16px;
}

/* Header & Nav */
.providers-header {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 14px 18px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 16px;
}
.providers-eyebrow {
    font-size: 9.5px;
    font-weight: 800;
    color: #dc2626;
    letter-spacing: 0.8px;
    margin-bottom: 2px;
}
.providers-header h1 {
    font-size: 18px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}
.providers-header p {
    font-size: 11.5px;
    color: #64748b;
    margin-top: 2px;
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
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
.btn-nav-link:hover {
    background: #e2e8f0;
    color: #0f172a;
    text-decoration: none;
}

/* Filter & Availability Bar */
.filter-action-bar {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 12px 16px;
    margin-bottom: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
}
.filter-btn-group {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
}
.filter-tab-btn {
    padding: 6px 12px;
    font-size: 11px;
    font-weight: 700;
    border-radius: 4px;
    text-decoration: none;
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    color: #475569;
    transition: all 0.15s;
}
.filter-tab-btn:hover {
    background: #e2e8f0;
    color: #0f172a;
    text-decoration: none;
}
.filter-tab-btn.active {
    background: #dc2626;
    color: #ffffff;
    border-color: #dc2626;
}

/* Status Filter Buttons (Available, Busy, Offline) */
.status-pill-filter {
    display: flex;
    gap: 6px;
    align-items: center;
}
.status-filter-btn {
    padding: 5px 10px;
    font-size: 10px;
    font-weight: 800;
    border-radius: 4px;
    border: 1px solid transparent;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
.status-filter-btn.available {
    background: #f0fdf4;
    border-color: #86efac;
    color: #166534;
}
.status-filter-btn.busy {
    background: #fffbeb;
    border-color: #fde68a;
    color: #92400e;
}
.status-filter-btn.offline {
    background: #f1f5f9;
    border-color: #cbd5e1;
    color: #475569;
}

/* Provider Cards Grid */
.provider-cards-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 14px;
}
.provider-card-box {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 16px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.15s;
}
.provider-card-box:hover {
    border-color: #cbd5e1;
    box-shadow: 0 4px 10px rgba(0,0,0,0.04);
}
.provider-card-top {
    display: flex;
    gap: 12px;
    margin-bottom: 12px;
}
.provider-avatar-circle {
    width: 44px;
    height: 44px;
    border-radius: 6px;
    background: #0f172a;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 800;
    flex-shrink: 0;
}
.provider-info-area {
    flex: 1;
}
.provider-name-row {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-wrap: wrap;
    margin-bottom: 4px;
}
.provider-name-row h2 {
    font-size: 14px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}
.badge-verified-sm {
    background: #e0f2fe;
    color: #0284c7;
    font-size: 9px;
    font-weight: 800;
    padding: 2px 6px;
    border-radius: 3px;
}
.badge-status-dot {
    font-size: 9px;
    font-weight: 800;
    padding: 2px 6px;
    border-radius: 3px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
.badge-status-dot.available { background: #dcfce7; color: #166534; }
.badge-status-dot.busy { background: #fef3c7; color: #92400e; }
.badge-status-dot.offline { background: #f1f5f9; color: #475569; }

.provider-sub-text {
    font-size: 11px;
    color: #64748b;
    margin: 0;
}

.provider-chips-row {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
    margin: 10px 0;
}
.provider-chip {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    font-size: 10px;
    font-weight: 700;
    color: #475569;
    padding: 3px 8px;
    border-radius: 3px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
.provider-chip.rating {
    color: #b45309;
    background: #fef3c7;
    border-color: #fde68a;
}

.provider-card-footer {
    display: flex;
    gap: 8px;
    border-top: 1px solid #f1f5f9;
    padding-top: 12px;
}
.btn-card-phone {
    flex: 1;
    background: #f8fafc;
    border: 1px solid #cbd5e1;
    color: #334155;
    font-size: 11px;
    font-weight: 700;
    padding: 6px 10px;
    border-radius: 4px;
    text-decoration: none;
    text-align: center;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
}
.btn-card-phone:hover {
    background: #e2e8f0;
    color: #0f172a;
    text-decoration: none;
}
.btn-card-request {
    flex: 1;
    background: #dc2626;
    color: #ffffff;
    font-size: 11px;
    font-weight: 800;
    padding: 6px 10px;
    border-radius: 4px;
    text-decoration: none;
    text-align: center;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
}
.btn-card-request:hover {
    background: #b91c1c;
    color: #ffffff;
    text-decoration: none;
}

@media (max-width: 768px) {
    .provider-cards-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="providers-page">
    <div class="providers-container">

        <!-- HEADER -->
        <div class="providers-header">
            <div>
                <div class="providers-eyebrow">VERIFIED RESPONDERS · DHAKA</div>
                <h1>EMERGENCY PROVIDER DIRECTORY</h1>
                <p>Browse verified ambulance crews, blood donors, electricians, and technicians.</p>
            </div>
            <div>
                <a href="{{ route('home') }}" class="btn-nav-link">Home</a>
                @auth
                    @if(auth()->user()->role === 'provider')
                        <a href="{{ route('provider.dashboard') }}" class="btn-nav-link">My Dashboard</a>
                    @else
                        <a href="{{ route('customer.dashboard') }}" class="btn-nav-link">Dashboard</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn-nav-link">Sign In</a>
                @endauth
            </div>
        </div>

        <!-- FILTER & AVAILABILITY STATUS BAR -->
        <div class="filter-action-bar">
            <!-- Category Tabs -->
            <div class="filter-btn-group">
                <a href="{{ route('providers', ['category' => 'all']) }}" class="filter-tab-btn {{ empty($category) || strtolower($category) === 'all' ? 'active' : '' }}">
                    ALL ({{ count($providers) }})
                </a>
                <a href="{{ route('providers', ['category' => 'Emergency']) }}" class="filter-tab-btn {{ strtolower($category ?? '') === 'emergency' ? 'active' : '' }}">
                    EMERGENCY
                </a>
                <a href="{{ route('providers', ['category' => 'Technical']) }}" class="filter-tab-btn {{ strtolower($category ?? '') === 'technical' ? 'active' : '' }}">
                    TECHNICAL
                </a>
                <a href="{{ route('providers', ['category' => 'Home']) }}" class="filter-tab-btn {{ strtolower($category ?? '') === 'home' ? 'active' : '' }}">
                    HOME
                </a>
            </div>

            <!-- Provider Availability Status Indicators -->
            <div class="status-pill-filter">
                <span class="status-filter-btn available">AVAILABLE</span>
                <span class="status-filter-btn busy">BUSY</span>
                <span class="status-filter-btn offline">OFFLINE</span>
            </div>
        </div>

        <!-- PROVIDERS GRID -->
        <div class="provider-cards-grid">
            @forelse($providers as $p)
                @php
                    $profile = $p->providerProfile;
                    $catName = $profile?->serviceCategory?->name ?? 'Emergency Responder';
                    $groupName = $profile?->serviceCategory?->group_name ?? 'Emergency';
                    $rating = (float)($profile?->rating ?? 0);
                    $ratingDisplay = $rating > 0 ? number_format($rating, 1) : '5.0';
                    $experience = $profile?->experience_years ?? 0;
                    $area = $profile?->area ?? $p->area ?? 'Dhaka';
                    $isAvailable = $profile?->is_available ?? true;
                    $isActive = $profile?->is_active ?? true;
                    
                    if (!$isActive) {
                        $statusBadge = 'offline';
                        $statusText = 'OFFLINE';
                    } elseif ($isAvailable) {
                        $statusBadge = 'available';
                        $statusText = 'AVAILABLE';
                    } else {
                        $statusBadge = 'busy';
                        $statusText = 'BUSY';
                    }
                @endphp

                <div class="provider-card-box">
                    <div>
                        <div class="provider-card-top">
                            <div class="provider-avatar-circle">
                                {{ strtoupper(substr($p->name, 0, 2)) }}
                            </div>
                            <div class="provider-info-area">
                                <div class="provider-name-row">
                                    <h2>{{ $p->name }}</h2>
                                    <span class="badge-verified-sm">VERIFIED</span>
                                    <span class="badge-status-dot {{ $statusBadge }}">
                                        ● {{ $statusText }}
                                    </span>
                                </div>
                                <p class="provider-sub-text">{{ $area }} · {{ $catName }} ({{ $groupName }})</p>
                            </div>
                        </div>

                        <div class="provider-chips-row">
                            <span class="provider-chip rating">{{ $ratingDisplay }} ★</span>
                            <span class="provider-chip">{{ $experience }} YRS EXP</span>
                            <span class="provider-chip">TRUSTED</span>
                        </div>

                        @if(!empty($profile?->address))
                            <p style="font-size:11px; color:#64748b; margin-bottom:8px;">
                                {{ $profile->address }}
                            </p>
                        @endif
                    </div>

                    <div class="provider-card-footer">
                        <a href="tel:{{ $p->phone }}" class="btn-card-phone">
                            {{ $p->phone ?: 'Call Provider' }}
                        </a>
                        <a href="{{ route('emergency.form') }}" class="btn-card-request">
                            REQUEST
                        </a>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align:center; padding: 40px; background:#ffffff; border:1px solid #e2e8f0; border-radius:6px;">
                    <h3 style="font-size:14px; font-weight:800; color:#0f172a; margin:8px 0 4px;">No Providers Found</h3>
                    <p style="font-size:11.5px; color:#64748b;">No registered service providers found matching this category.</p>
                    <a href="{{ route('providers') }}" class="btn-nav-link" style="margin-top:8px;">View All Providers</a>
                </div>
            @endforelse
        </div>

    </div>
</div>

@endsection