@extends('layouts.app')

@section('title', 'Customer Profile')

@section('content')

<style>
/* =========================================================
   CUSTOMER PROFILE STYLES
   ========================================================= */

.customer-profile-page {
    background-color: #f8fafc;
    min-height: 100vh;
    padding: 20px 0 32px;
}
.customer-profile-container {
    max-width: 960px;
    margin: 0 auto;
    padding: 0 16px;
}

.customer-profile-header {
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
.customer-profile-eyebrow {
    font-size: 9.5px;
    font-weight: 800;
    color: #dc2626;
    letter-spacing: 0.8px;
    margin-bottom: 2px;
}
.customer-profile-header h1 {
    font-size: 18px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}
.customer-profile-name {
    font-size: 11.5px;
    color: #64748b;
}
.customer-profile-id {
    background: #e0f2fe;
    color: #0369a1;
    font-weight: 800;
    font-size: 10px;
    padding: 4px 8px;
    border-radius: 4px;
    border: 1px solid #bae6fd;
}

.customer-profile-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 14px;
}
.customer-profile-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 16px;
}
.customer-profile-card h2 {
    font-size: 13px;
    font-weight: 800;
    color: #0f172a;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 8px;
    margin-bottom: 12px;
}
.customer-profile-field {
    margin-bottom: 10px;
}
.customer-profile-field label {
    display: block;
    font-size: 9.5px;
    font-weight: 800;
    color: #475569;
    margin-bottom: 4px;
    text-transform: uppercase;
}
.customer-profile-field input,
.customer-profile-field select {
    width: 100%;
    padding: 6px 10px;
    font-size: 12px;
    border: 1px solid #cbd5e1;
    border-radius: 4px;
    background: #f8fafc;
    color: #0f172a;
    box-sizing: border-box;
}

.customer-account-meta {
    display: flex;
    justify-content: space-between;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    padding: 10px 12px;
    margin-top: 12px;
}
.customer-account-meta span {
    display: block;
    font-size: 9px;
    font-weight: 800;
    color: #64748b;
}
.customer-account-active {
    color: #166534;
    font-size: 11.5px;
    font-weight: 800;
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
.customer-profile-actions {
    display: flex;
    justify-content: flex-end;
    gap: 8px;
    margin-top: 14px;
}

</style>

<div class="customer-profile-page">
    <div class="customer-profile-container">

        <!-- HEADER -->
        <div class="customer-profile-header">
            <div>
                <h1>CUSTOMER PROFILE</h1>
                <p class="customer-profile-name">Name: <strong>{{ auth()->user()->name }}</strong></p>
            </div>
            <div style="display:flex; align-items:center; gap:8px;">
                <div class="customer-profile-id">ID: {{ sprintf('%02d', auth()->user()->id) }}</div>
                <a href="{{ route('customer.dashboard') }}" class="btn-nav-link">← My Dashboard</a>
            </div>
        </div>

        <div class="customer-profile-grid">
            <!-- ACCOUNT INFORMATION -->
            <section class="customer-profile-card">
                <h2>ACCOUNT INFORMATION</h2>

                <div class="customer-profile-field">
                    <label for="customerProfileName">FULL NAME</label>
                    <input id="customerProfileName" type="text" value="{{ auth()->user()->name }}" readonly>
                </div>

                <div class="customer-profile-field">
                    <label for="customerProfileEmail">EMAIL</label>
                    <input id="customerProfileEmail" type="email" value="{{ auth()->user()->email }}" readonly>
                </div>

                <div class="customer-profile-field">
                    <label for="customerProfilePhone">PHONE NUMBER</label>
                    <input id="customerProfilePhone" type="text" value="{{ auth()->user()->phone ?? '+880 1711-000000' }}" readonly>
                </div>

                <div class="customer-account-meta">
                    <div>
                        <span>ACCOUNT STATUS</span>
                        <strong class="customer-account-active">{{ auth()->user()->is_active ? 'ACTIVE' : 'INACTIVE' }}</strong>
                    </div>
                    <div>
                        <span>MEMBER SINCE</span>
                        <strong style="color:#0f172a; font-size:11.5px;">{{ auth()->user()->created_at->format('F Y') }}</strong>
                    </div>
                </div>
            </section>

            <!-- LOCATION -->
            <section class="customer-profile-card">
                <h2>PRIMARY LOCATION</h2>

                <div class="customer-profile-field">
                    <label for="customerDefaultAddress">DEFAULT ADDRESS</label>
                    <input id="customerDefaultAddress" type="text" value="{{ auth()->user()->address ?? 'Road 8A, House 42' }}" readonly>
                </div>

                <div class="customer-profile-field">
                    <label for="customerProfileArea">AREA</label>
                    <input id="customerProfileArea" type="text" value="{{ auth()->user()->area ?? 'Dhanmondi, Dhaka' }}" readonly>
                </div>

                <div class="customer-account-meta" style="margin-top:20px;">
                    <div>
                        <span>PRIMARY DISPATCH HUB</span>
                        <strong style="color:#0f172a; font-size:11px;">Dhaka Emergency Central</strong>
                    </div>
                </div>
            </section>
        </div>

        <div class="customer-profile-actions">
            <a href="{{ route('customer.dashboard') }}" class="btn-nav-link" style="background:#dc2626; color:#ffffff; border-color:#dc2626;">
                ← BACK TO CUSTOMER DASHBOARD
            </a>
        </div>

    </div>
</div>

@endsection