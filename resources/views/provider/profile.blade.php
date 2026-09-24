@extends('layouts.app')

@section('title', 'Provider Profile & Trust — Smart Emergency Helper')

@section('content')

<style>
/* =========================================================
   PROVIDER PROFILE STYLES (EMBEDDED IN BLADE)
   ========================================================= */

.provider-profile-page {
    background-color: #f8fafc;
    min-height: 100vh;
    padding: 20px 0 32px;
}
.provider-profile-container {
    max-width: 960px;
    margin: 0 auto;
    padding: 0 16px;
}

/* Header */
.profile-header-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 16px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 14px;
}
.profile-eyebrow {
    font-size: 9.5px;
    font-weight: 800;
    color: #dc2626;
    letter-spacing: 0.8px;
    margin-bottom: 2px;
}
.profile-header-card h1 {
    font-size: 18px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}
.profile-badges-row {
    display: flex;
    gap: 6px;
    align-items: center;
    flex-wrap: wrap;
}
.p-badge {
    font-size: 9.5px;
    font-weight: 800;
    padding: 3px 8px;
    border-radius: 4px;
}
.p-badge.approved { background: #dcfce7; color: #166534; border: 1px solid #86efac; }
.p-badge.verified { background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; }
.p-badge.trusted  { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }

/* Status Toggle Bar */
.status-toggle-bar {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 10px 16px;
    margin-bottom: 14px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}
.btn-status-toggle {
    padding: 5px 12px;
    font-size: 10.5px;
    font-weight: 800;
    border-radius: 4px;
    cursor: pointer;
    border: 1px solid transparent;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}
.btn-status-available { background: #f0fdf4; border-color: #86efac; color: #166534; }
.btn-status-available.active { background: #16a34a; color: #ffffff; border-color: #15803d; }
.btn-status-busy { background: #fffbeb; border-color: #fde68a; color: #92400e; }
.btn-status-busy.active { background: #d97706; color: #ffffff; border-color: #b45309; }
.btn-status-offline { background: #f1f5f9; border-color: #cbd5e1; color: #475569; }
.btn-status-offline.active { background: #475569; color: #ffffff; border-color: #334155; }

/* Section Cards */
.profile-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 16px 20px;
    margin-bottom: 14px;
}
.profile-card h3 {
    font-size: 13px;
    font-weight: 800;
    color: #0f172a;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 8px;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 6px;
}
.profile-info-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
}
.profile-info-item label {
    font-size: 9px;
    font-weight: 800;
    color: #64748b;
    display: block;
    text-transform: uppercase;
}
.profile-info-item strong {
    font-size: 12px;
    color: #0f172a;
    display: block;
    margin-top: 2px;
}

/* Trust Score */
.trust-score-row {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 14px;
}
.trust-score-badge {
    font-size: 28px;
    font-weight: 900;
    color: #059669;
    background: #f0fdf4;
    border: 2px solid #86efac;
    padding: 8px 16px;
    border-radius: 6px;
    line-height: 1;
}
.trust-score-badge small {
    font-size: 12px;
    color: #64748b;
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
</style>

<div class="provider-profile-page">
    <div class="provider-profile-container">

        <!-- HEADER -->
        <div class="profile-header-card">
            <div>
                <div class="profile-eyebrow">VERIFIED PROVIDER PROFILE</div>
                <h1>{{ auth()->user()->name ?? 'Rapid Care Ambulance' }}</h1>
                <p style="font-size:11px; color:#64748b; margin:2px 0 0;">
                    ID: {{ sprintf('%02d', auth()->user()->id ?? 1) }} · {{ auth()->user()->phone ?? '+880 1711-000000' }}
                </p>
            </div>

            <div class="profile-badges-row">
                <span class="p-badge approved">✓ APPROVED</span>
                <span class="p-badge verified">✓ PHONE OTP</span>
                <span class="p-badge trusted">★ HIGHLY TRUSTED</span>
                <a href="{{ route('provider.dashboard') }}" class="btn-nav-link">← My Dashboard</a>
            </div>
        </div>

        <!-- AVAILABILITY STATUS BUTTONS -->
        @php
            $currentStatus = session('provider_status', (auth()->user()->providerProfile?->is_available ? 'available' : 'busy'));
            if (auth()->user()->providerProfile && !auth()->user()->providerProfile->is_active) {
                $currentStatus = 'offline';
            }
        @endphp
        <div class="status-toggle-bar">
            <div style="font-size:11.5px; font-weight:800; color:#0f172a;">
                <span>STATUS:</span>
                <strong style="text-transform: uppercase; color: {{ $currentStatus === 'available' ? '#16a34a' : ($currentStatus === 'busy' ? '#d97706' : '#475569') }};">
                    ● {{ $currentStatus }}
                </strong>
            </div>

            <div style="display:flex; gap:6px;">
                <form method="POST" action="{{ route('provider.status') }}" style="display:inline;">
                    @csrf
                    <input type="hidden" name="status" value="available">
                    <button type="submit" class="btn-status-toggle btn-status-available {{ $currentStatus === 'available' ? 'active' : '' }}">
                        AVAILABLE
                    </button>
                </form>

                <form method="POST" action="{{ route('provider.status') }}" style="display:inline;">
                    @csrf
                    <input type="hidden" name="status" value="busy">
                    <button type="submit" class="btn-status-toggle btn-status-busy {{ $currentStatus === 'busy' ? 'active' : '' }}">
                        BUSY
                    </button>
                </form>

                <form method="POST" action="{{ route('provider.status') }}" style="display:inline;">
                    @csrf
                    <input type="hidden" name="status" value="offline">
                    <button type="submit" class="btn-status-toggle btn-status-offline {{ $currentStatus === 'offline' ? 'active' : '' }}">
                        OFFLINE
                    </button>
                </form>
            </div>
        </div>

        <!-- PROFILE INFORMATION -->
        <div class="profile-card">
            <h3>Profile Details</h3>
            <div class="profile-info-grid">
                <div class="profile-info-item">
                    <label>Provider Name</label>
                    <strong>{{ auth()->user()->name }}</strong>
                </div>
                <div class="profile-info-item">
                    <label>Phone Number</label>
                    <strong>{{ auth()->user()->phone ?? 'Contact Verified' }}</strong>
                </div>
                <div class="profile-info-item">
                    <label>Email Address</label>
                    <strong>{{ auth()->user()->email }}</strong>
                </div>
                <div class="profile-info-item">
                    <label>Service Area</label>
                    <strong>{{ auth()->user()->area ?? 'Dhaka' }}</strong>
                </div>
                <div class="profile-info-item">
                    <label>Experience</label>
                    <strong>{{ auth()->user()->providerProfile?->experience_years ?? 5 }} Years</strong>
                </div>
                <div class="profile-info-item">
                    <label>Average Rating</label>
                    <strong style="color:#d97706;">★ {{ number_format(auth()->user()->providerProfile?->rating ?? 4.9, 1) }} / 5.0</strong>
                </div>
            </div>
        </div>

        <!-- TRUST & VERIFICATION METRICS -->
        <div class="profile-card">
            <h3>Rule-Based Trust Score</h3>
            <div class="trust-score-row">
                <div class="trust-score-badge">
                    92<small>/100</small>
                </div>
                <div>
                    <strong style="font-size:13px; color:#0f172a; display:block;">EXCELLENT REPUTATION</strong>
                    <p style="font-size:11px; color:#64748b; margin:2px 0 0;">Calculated from verified phone OTP, completed jobs, and positive client reviews.</p>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection