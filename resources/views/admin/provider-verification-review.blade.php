@extends('layouts.app')

@section('title', 'Provider Verification Review — Admin Panel')

@section('content')

<style>
/* =========================================================
   ADMIN PROVIDER REVIEW STYLES (EMBEDDED IN BLADE)
   ========================================================= */

.provider-review-page {
    background-color: #f8fafc;
    min-height: 100vh;
    padding: 20px 0 32px;
}
.provider-review-container {
    max-width: 960px;
    margin: 0 auto;
    padding: 0 16px;
}

.provider-review-header {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 14px 18px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 14px;
}
.provider-review-eyebrow {
    font-size: 9.5px;
    font-weight: 800;
    color: #dc2626;
    letter-spacing: 0.8px;
    margin-bottom: 2px;
}
.provider-review-header h1 {
    font-size: 18px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}
.provider-review-subtitle {
    font-size: 11.5px;
    color: #64748b;
    margin-top: 2px;
}
.provider-back-link {
    font-size: 11px;
    font-weight: 700;
    color: #dc2626;
    text-decoration: none;
    margin-top: 4px;
    display: inline-block;
}

.provider-review-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 14px;
}
.provider-review-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 16px;
}
.provider-review-card h3 {
    font-size: 12px;
    font-weight: 800;
    color: #0f172a;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 6px;
    margin-bottom: 10px;
}

.provider-info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}
.provider-info-grid div span {
    font-size: 9px;
    font-weight: 800;
    color: #64748b;
    display: block;
}
.provider-info-grid div strong {
    font-size: 11.5px;
    color: #0f172a;
    display: block;
    margin-top: 2px;
}

.provider-check-row {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 11.5px;
    color: #334155;
    margin-bottom: 8px;
    cursor: pointer;
}

.provider-note-card textarea {
    width: 100%;
    min-height: 70px;
    padding: 8px 10px;
    font-size: 12px;
    border: 1px solid #cbd5e1;
    border-radius: 4px;
    box-sizing: border-box;
}

.provider-review-actions {
    display: flex;
    gap: 10px;
    margin-top: 16px;
}
.provider-action-btn {
    padding: 8px 16px;
    font-size: 11.5px;
    font-weight: 800;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.approve-provider-btn { background: #059669; color: #ffffff; }
.approve-provider-btn:hover { background: #047857; }
.reject-provider-btn  { background: #dc2626; color: #ffffff; }
.reject-provider-btn:hover  { background: #b91c1c; }

@media (max-width: 768px) {
    .provider-review-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="provider-review-page">
    <div class="provider-review-container">

        <!-- HEADER -->
        <div class="provider-review-header">
            <div>
                <p class="provider-review-eyebrow">ADMIN CONTROL · VERIFICATION QUEUE</p>
                <h1>PROVIDER VERIFICATION REVIEW</h1>
                <p class="provider-review-subtitle">
                    {{ $provider['name'] }} · ID: {{ sprintf('%02d', is_numeric($provider['id'] ?? 1) ? ($provider['id'] ?? 1) : 1) }} · {{ $provider['category'] }}
                </p>
                <a href="{{ route('admin.dashboard') }}" class="provider-back-link">
                    ← Back to Admin Panel
                </a>
            </div>

            <div style="font-size:11px; font-weight:800; background:#fef3c7; color:#92400e; padding:6px 12px; border-radius:4px; border:1px solid #fde68a;">
                ● {{ strtoupper($provider['status'] ?? 'UNDER REVIEW') }}
            </div>
        </div>

        <!-- ROW 1 -->
        <div class="provider-review-grid">
            <section class="provider-review-card">
                <h3>PHONE VERIFICATION</h3>
                <p style="font-size:12px; margin-bottom:8px;">Phone: <strong>{{ $provider['phone'] }}</strong></p>
                @if(!empty($provider['phone_verified']))
                    <span style="color:#166534; background:#dcfce7; border:1px solid #86efac; padding:3px 8px; border-radius:3px; font-size:10px; font-weight:800;">
                        PHONE OTP VERIFIED
                    </span>
                @else
                    <span style="color:#92400e; background:#fef3c7; border:1px solid #fde68a; padding:3px 8px; border-radius:3px; font-size:10px; font-weight:800;">
                        OTP PENDING
                    </span>
                @endif
            </section>

            <section class="provider-review-card">
                <h3>REGISTRATION DETAILS</h3>
                <p style="font-size:12px; margin-bottom:4px;">Submitted: <strong>{{ $provider['created'] ?? 'Recently' }}</strong></p>
                <p style="font-size:11px; color:#64748b;">Verification consists of phone ownership (OTP) and administrator profile vetting.</p>
            </section>
        </div>

        <!-- ROW 2 -->
        <div class="provider-review-grid">
            <section class="provider-review-card">
                <h3>ADMIN REVIEW CHECKLIST</h3>
                <label class="provider-check-row">
                    <input type="checkbox" {{ !empty($provider['phone_verified']) ? 'checked' : '' }}>
                    <span>Phone OTP successfully verified</span>
                </label>
                <label class="provider-check-row">
                    <input type="checkbox" checked>
                    <span>Provider profile information is acceptable</span>
                </label>
                <label class="provider-check-row">
                    <input type="checkbox" checked>
                    <span>Service category matches technical capability</span>
                </label>
            </section>

            <section class="provider-review-card">
                <h3>PROVIDER PROFILE DETAILS</h3>
                <div class="provider-info-grid">
                    <div><span>NAME</span><strong>{{ $provider['name'] }}</strong></div>
                    <div><span>PHONE</span><strong>{{ $provider['phone'] }}</strong></div>
                    <div><span>EMAIL</span><strong>{{ $provider['email'] }}</strong></div>
                    <div><span>CATEGORY</span><strong>{{ $provider['category'] }}</strong></div>
                    <div><span>EXPERIENCE</span><strong>{{ $provider['experience'] }}</strong></div>
                    <div><span>AREA</span><strong>{{ $provider['area'] }}</strong></div>
                </div>
            </section>
        </div>

        <!-- NOTE -->
        <section class="provider-review-card provider-note-card" style="margin-bottom:14px;">
            <h3>ADMIN INTERNAL NOTES</h3>
            <textarea placeholder="Add internal verification notes or instructions for provider..."></textarea>
        </section>

        <!-- ACTION BUTTONS -->
        <div class="provider-review-actions">
            <form method="POST" action="{{ route('admin.provider.approve', $provider['id'] ?? 1) }}" style="display:inline; margin:0;">
                @csrf
                <button type="submit" class="provider-action-btn approve-provider-btn">
                    APPROVE PROVIDER
                </button>
            </form>

            <form method="POST" action="{{ route('admin.provider.reject', $provider['id'] ?? 1) }}" style="display:inline; margin:0;">
                @csrf
                <button type="submit" class="provider-action-btn reject-provider-btn">
                    REJECT PROVIDER
                </button>
            </form>
        </div>

    </div>
</div>

@endsection