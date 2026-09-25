@extends('layouts.app')

@section('title', 'Provider Dashboard')

@section('content')

<style>
/* =========================================================
   PROVIDER DASHBOARD STYLES 
   ========================================================= */

.provider-dashboard-page {
    background-color: #f1f5f9;
    min-height: 100vh;
    padding: 16px 0 24px;
}
.provider-dashboard-container {
    max-width: 1060px;
    margin: 0 auto;
    padding: 0 16px;
}

/* Header */
.provider-dashboard-header {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 12px 18px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 14px;
}
.provider-eyebrow {
    font-size: 9.5px;
    font-weight: 800;
    color: #dc2626;
    letter-spacing: 0.8px;
    margin-bottom: 2px;
}
.provider-dashboard-header h1 {
    font-size: 17px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
    line-height: 1.2;
}
.provider-subtitle {
    font-size: 11.5px;
    color: #64748b;
    margin-top: 2px;
}
.provider-header-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}
.provider-id-badge {
    background: #fef3c7;
    color: #92400e;
    font-weight: 800;
    font-size: 10px;
    padding: 4px 8px;
    border-radius: 4px;
    border: 1px solid #fde68a;
}
.btn-nav-link {
    background: #f8fafc;
    border: 1px solid #cbd5e1;
    color: #334155;
    font-size: 11px;
    font-weight: 700;
    padding: 5px 10px;
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
.btn-nav-logout {
    background: #fee2e2;
    border: 1px solid #fca5a5;
    color: #b91c1c;
    font-size: 11px;
    font-weight: 700;
    padding: 5px 10px;
    border-radius: 4px;
    cursor: pointer;
}
.btn-nav-logout:hover {
    background: #fecaca;
}

/* Availability Status Switcher Bar */
.provider-status-bar {
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
.status-bar-title {
    font-size: 11.5px;
    font-weight: 800;
    color: #0f172a;
    display: flex;
    align-items: center;
    gap: 6px;
}
.status-toggle-group {
    display: flex;
    gap: 6px;
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
    transition: all 0.15s;
}
.btn-status-available {
    background: #f0fdf4;
    border-color: #86efac;
    color: #166534;
}
.btn-status-available.active {
    background: #16a34a;
    color: #ffffff;
    border-color: #15803d;
    box-shadow: 0 2px 4px rgba(22, 163, 74, 0.3);
}
.btn-status-busy {
    background: #fffbeb;
    border-color: #fde68a;
    color: #92400e;
}
.btn-status-busy.active {
    background: #d97706;
    color: #ffffff;
    border-color: #b45309;
    box-shadow: 0 2px 4px rgba(217, 119, 6, 0.3);
}
.btn-status-offline {
    background: #f1f5f9;
    border-color: #cbd5e1;
    color: #475569;
}
.btn-status-offline.active {
    background: #475569;
    color: #ffffff;
    border-color: #334155;
    box-shadow: 0 2px 4px rgba(71, 85, 105, 0.3);
}

/* Alerts */
.provider-alert {
    padding: 8px 12px;
    border-radius: 4px;
    font-size: 11.5px;
    font-weight: 600;
    margin-bottom: 12px;
}
.provider-alert-success {
    background: #dcfce7;
    border: 1px solid #86efac;
    color: #166534;
}
.provider-alert-danger {
    background: #fee2e2;
    border: 1px solid #fca5a5;
    color: #991b1b;
}

/* Main Grid */
.provider-main-grid {
    display: grid;
    grid-template-columns: 360px 1fr;
    gap: 14px;
}

/* Panel Cards */
.provider-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 16px;
}
.provider-card-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 8px;
    margin-bottom: 12px;
}
.provider-card-head h2 {
    font-size: 13px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 6px;
}
.badge-count-red {
    background: #fee2e2;
    color: #991b1b;
    font-size: 9.5px;
    font-weight: 800;
    padding: 2px 6px;
    border-radius: 3px;
}

/* Pending Alerts List */
.pending-alert-item {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    padding: 12px;
    margin-bottom: 10px;
}
.pending-alert-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 6px;
}
.priority-pill {
    font-size: 9px;
    font-weight: 800;
    padding: 2px 6px;
    border-radius: 3px;
    text-transform: uppercase;
}
.priority-pill-critical { background: #fee2e2; color: #991b1b; }
.priority-pill-high { background: #fef3c7; color: #92400e; }
.priority-pill-medium { background: #e0f2fe; color: #075985; }
.priority-pill-normal { background: #f1f5f9; color: #334155; }

.pending-service-title {
    font-size: 12.5px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 4px;
}
.pending-meta {
    font-size: 11px;
    color: #475569;
    margin-bottom: 4px;
}
.pending-desc {
    font-size: 11px;
    color: #64748b;
    margin-bottom: 10px;
    line-height: 1.35;
}
.pending-actions-row {
    display: flex;
    gap: 6px;
}
.btn-accept-job {
    flex: 1;
    background: #059669;
    color: #ffffff;
    font-size: 10.5px;
    font-weight: 800;
    border: none;
    padding: 6px 10px;
    border-radius: 3px;
    cursor: pointer;
}
.btn-accept-job:hover { background: #047857; }
.btn-decline-job {
    background: #f1f5f9;
    border: 1px solid #cbd5e1;
    color: #475569;
    font-size: 10.5px;
    font-weight: 700;
    padding: 6px 10px;
    border-radius: 3px;
    cursor: pointer;
}

/* Active Mission Tracker (Right) */
.active-mission-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 16px;
}
.mission-head {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 10px;
    margin-bottom: 12px;
}
.mission-title {
    font-size: 16px;
    font-weight: 800;
    color: #0f172a;
    margin: 4px 0 2px;
}
.mission-subinfo {
    font-size: 11.5px;
    color: #64748b;
}

/* 5-Step Stepper */
.stepper-container {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 10px 8px;
    margin-bottom: 14px;
}
.stepper-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 6px;
}
.step-node {
    text-align: center;
    padding: 6px 4px;
    border-radius: 4px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    font-size: 9.5px;
    font-weight: 800;
    color: #94a3b8;
}
.step-node.active-step {
    background: #dc2626;
    color: #ffffff;
    border-color: #dc2626;
    box-shadow: 0 2px 4px rgba(220, 38, 38, 0.25);
}
.step-node.completed-step {
    background: #dcfce7;
    color: #166534;
    border-color: #86efac;
}
.step-node-num {
    display: block;
    font-size: 8.5px;
    opacity: 0.8;
}

/* Workflow Actions Bar */
.workflow-toolbar {
    background: #f1f5f9;
    border-radius: 4px;
    padding: 10px 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 12px;
}
.btn-workflow-action {
    background: #0f172a;
    color: #ffffff;
    font-size: 11px;
    font-weight: 800;
    border: none;
    padding: 6px 12px;
    border-radius: 4px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.btn-workflow-action.green {
    background: #059669;
}
.btn-workflow-action:hover {
    opacity: 0.9;
}

/* Details 2-Col Box */
.details-2col-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-bottom: 12px;
}
.detail-box-sm {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    padding: 8px 10px;
}
.detail-box-sm label {
    font-size: 9px;
    font-weight: 800;
    color: #64748b;
    display: block;
    text-transform: uppercase;
}
.detail-box-sm strong {
    font-size: 11.5px;
    color: #0f172a;
    display: block;
    margin: 2px 0;
}
.detail-box-sm p {
    font-size: 11px;
    color: #475569;
    margin: 0;
}

/* PIN Verification & Payment Summary */
.pins-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 12px;
    margin-bottom: 12px;
}
.pins-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
    padding-bottom: 6px;
    border-bottom: 1px solid #f1f5f9;
}
.pins-card-header h3 {
    font-size: 12px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}
.pin-row-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}
.pin-item-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    padding: 10px;
}
.pin-item-box.verified {
    background: #f0fdf4;
    border-color: #86efac;
}
.pin-item-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 6px;
}
.pin-item-head span {
    font-size: 10.5px;
    font-weight: 800;
    color: #0f172a;
}
.badge-pin-v {
    font-size: 8.5px;
    font-weight: 800;
    padding: 2px 5px;
    border-radius: 3px;
}
.badge-pin-v.success { background: #dcfce7; color: #166534; }
.badge-pin-v.pending { background: #fee2e2; color: #991b1b; }

.pin-verify-form {
    display: flex;
    gap: 6px;
    margin-top: 8px;
}
.pin-verify-input {
    width: 90px;
    padding: 5px 8px;
    font-size: 11.5px;
    font-weight: 800;
    border: 1px solid #cbd5e1;
    border-radius: 4px;
    text-align: center;
    background: #ffffff;
    color: #0f172a;
}
.pin-verify-input:focus {
    outline: none;
    border-color: #dc2626;
}
.btn-pin-submit {
    background: #dc2626;
    color: #ffffff;
    font-size: 10px;
    font-weight: 800;
    border: none;
    padding: 5px 10px;
    border-radius: 4px;
    cursor: pointer;
    flex: 1;
}
.btn-pin-submit:hover {
    background: #b91c1c;
}
.btn-pin-submit.green {
    background: #059669;
}
.btn-pin-submit.green:hover {
    background: #047857;
}

/* History Section */
.history-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 16px;
    margin-top: 14px;
}
.history-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 8px;
    margin-bottom: 10px;
}
.history-card-header h2 {
    font-size: 13px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}
.history-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 11px;
}
.history-table th {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    padding: 6px 8px;
    text-align: left;
    font-size: 9.5px;
    font-weight: 800;
    color: #475569;
}
.history-table td {
    padding: 7px 8px;
    border-bottom: 1px solid #f1f5f9;
    color: #334155;
}

</style>

<div class="provider-dashboard-page">
    <div class="provider-dashboard-container">

        <!-- HEADER -->
        <div class="provider-dashboard-header">
            <div>
                <div class="provider-eyebrow">PROVIDER DISPATCH PORTAL</div>
                <h1>PROVIDER DASHBOARD</h1>
                <p class="provider-subtitle">Welcome, <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->phone ?? 'Dhaka' }})</p>
            </div>

            <div class="provider-header-actions">
                <span class="provider-id-badge">ID: {{ sprintf('%02d', auth()->user()->id) }}</span>
                <a href="{{ route('home') }}" class="btn-nav-link">Home</a>
                <a href="{{ route('provider.profile') }}" class="btn-nav-link">Profile</a>
                <a href="{{ route('providers') }}" class="btn-nav-link">Directory</a>
                <form method="POST" action="{{ route('demo.logout') }}" style="display:inline; margin:0;">
                    @csrf
                    <button type="submit" class="btn-nav-logout">LOGOUT</button>
                </form>
            </div>
        </div>

        {{-- STATUS SWITCHER: AVAILABLE, BUSY, OFFLINE --}}
        @php
            $currentStatus = session('provider_status', (auth()->user()->providerProfile?->is_available ? 'available' : 'busy'));
            if (auth()->user()->providerProfile && !auth()->user()->providerProfile->is_active) {
                $currentStatus = 'offline';
            }
        @endphp
        <div class="provider-status-bar">
            <div class="status-bar-title">
                <span>MY DISPATCH STATUS:</span>
                <strong style="text-transform: uppercase; color: {{ $currentStatus === 'available' ? '#16a34a' : ($currentStatus === 'busy' ? '#d97706' : '#475569') }};">
                    ● {{ $currentStatus }}
                </strong>
            </div>

            <div class="status-toggle-group">
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

        {{-- FLASH MESSAGES --}}
        @if(session('success'))
            <div class="provider-alert provider-alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="provider-alert provider-alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- MAIN GRID: LEFT (PENDING ALERTS) & RIGHT (ACTIVE MISSION) -->
        <div class="provider-main-grid">

            <!-- LEFT COLUMN: PENDING DISPATCH ALERTS -->
            <div class="provider-card">
                <div class="provider-card-head">
                    <h2>PENDING ALERTS</h2>
                    <span class="badge-count-red">{{ count($requests ?? []) }}</span>
                </div>

                <p style="font-size:11px; color:#64748b; margin-bottom:10px;">Incoming requests matching your category &amp; area:</p>

                @if(isset($requests) && count($requests) > 0)
                    @foreach($requests as $index => $req)
                        <div class="pending-alert-item">
                            <div class="pending-alert-top">
                                <span class="priority-pill priority-pill-{{ strtolower($req->priority) }}">
                                    {{ strtoupper($req->priority) }}
                                </span>
                                <strong style="font-size:11px; color:#0f172a;">Request {{ $index + 1 }}</strong>
                            </div>

                            <div class="pending-service-title">{{ $req->serviceCategory->name ?? 'Emergency Service' }}</div>
                            <div class="pending-meta"><strong>{{ $req->area }}</strong>, {{ $req->address }}</div>
                            <div class="pending-desc">{{ Str::limit($req->description, 80) }}</div>

                            <div class="pending-actions-row">
                                <form method="POST" action="{{ route('provider.request.accept', $req->id) }}" style="flex:1;">
                                    @csrf
                                    <button type="submit" class="btn-accept-job">
                                        ACCEPT MISSION 
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('provider.request.reject', $req->id) }}">
                                    @csrf
                                    <button type="submit" class="btn-decline-job">
                                        DECLINE
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div style="text-align:center; padding:30px 10px; color:#94a3b8;">
                        <p style="font-size:11.5px; color:#64748b; margin-top:6px;">No pending emergency alerts right now.</p>
                        <small style="font-size:10px;">System will broadcast requests when clients dispatch near you.</small>
                    </div>
                @endif
            </div>

            <!-- RIGHT COLUMN: ACTIVE EMERGENCY MISSION TRACKER -->
            <div>
                @if($activeJob)
                    <div class="active-mission-card">
                        <div class="mission-head">
                            <div>
                                <div style="display:flex; align-items:center; gap:6px; margin-bottom:4px;">
                                    <span class="priority-pill priority-pill-{{ strtolower($activeJob->priority) }}">
                                        {{ strtoupper($activeJob->priority) }}
                                    </span>
                                </div>
                                <h2 class="mission-title">
                                    Request 1 : {{ $activeJob->serviceCategory->name ?? 'Emergency Service' }}
                                </h2>
                                <p class="mission-subinfo">
                                    Customer: <strong>{{ $activeJob->customer->name ?? 'Customer' }}</strong> ({{ $activeJob->customer->phone ?? 'Contact available' }}) · {{ $activeJob->area }}, Dhaka
                                </p>
                            </div>
                            <div style="text-align:right;">
                                <strong style="font-size:12px; color:#0f172a;">{{ $activeJob->created_at->format('h:i A') }}</strong>
                                <small style="display:block; color:#64748b; font-size:9.5px;">ACCEPTED AT {{ $activeJob->accepted_at ? $activeJob->accepted_at->format('h:i A') : $activeJob->created_at->format('h:i A') }}</small>
                            </div>
                        </div>

                        <!-- 5 STEPS LIFECYCLE PROGRESS -->
                        <div class="stepper-container">
                            <div class="stepper-grid">
                                @php
                                    $fiveSteps = [
                                        0 => 'PENDING',
                                        1 => 'ACCEPTED',
                                        2 => 'ON THE WAY',
                                        3 => 'ARRIVAL PIN',
                                        4 => 'COMPLETION PIN',
                                    ];
                                @endphp

                                @foreach($fiveSteps as $stepIdx => $stepTitle)
                                    @php
                                        if ($current == $stepIdx) {
                                            $stClass = 'active-step';
                                        } elseif ($current > $stepIdx) {
                                            $stClass = 'completed-step';
                                        } else {
                                            $stClass = '';
                                        }
                                    @endphp
                                    <div class="step-node {{ $stClass }}">
                                        <span class="step-node-num">STEP {{ $stepIdx + 1 }}</span>
                                        {{ $current > $stepIdx ? '✓ ' : '' }}{{ $stepTitle }}
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- WORKFLOW STATUS & ADVANCE CONTROLS -->
                        <div class="workflow-toolbar">
                            <div>
                                <small style="display:block; font-size:9px; color:#64748b; font-weight:700;">CURRENT MISSION PHASE</small>
                                <strong style="font-size:12px; color:#dc2626;">{{ ucwords(str_replace('_', ' ', $activeJob->status)) }}</strong>
                            </div>

                            <div style="display:flex; gap:6px; flex-wrap:wrap;">
                                @if($activeJob->status === 'accepted')
                                    <form method="POST" action="{{ route('provider.request.advance', $activeJob->id) }}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-workflow-action">
                                            START TRAVEL (ON THE WAY) 
                                        </button>
                                    </form>
                                @elseif($activeJob->status === 'on_the_way')
                                    <form method="POST" action="{{ route('provider.request.advance', $activeJob->id) }}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-workflow-action">
                                            MARK ARRIVED AT SITE 
                                        </button>
                                    </form>
                                @elseif(in_array($activeJob->status, ['arrival_pin', 'arrival_pin_required', 'arrived']))
                                    <form method="POST" action="{{ route('provider.request.advance', $activeJob->id) }}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-workflow-action green">
                                            WORK DONE (REQUEST COMPLETION PIN) 
                                        </button>
                                    </form>
                                @elseif(in_array($activeJob->status, ['completion_pin', 'completion_pin_required']))
                                    <form method="POST" action="{{ route('provider.request.advance', $activeJob->id) }}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-workflow-action green">
                                            COMPLETE MISSION (RECEIVE CASH ৳ 500) 
                                        </button>
                                    </form>
                                @elseif($activeJob->status === 'completed')
                                    <span style="font-size:11px; font-weight:800; color:#166534; background:#dcfce7; padding:5px 10px; border-radius:3px;">
                                         MISSION COMPLETED
                                    </span>
                                @endif

                                <form method="POST" action="{{ route('provider.request.advance', $activeJob->id) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-workflow-action" style="background:#334155;">
                                        ADVANCE 
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- 2-COL DETAILS -->
                        <div class="details-2col-grid">
                            <div class="detail-box-sm">
                                <label>Emergency Location</label>
                                <strong>{{ $activeJob->area }}, Dhaka</strong>
                                <p>{{ $activeJob->address }}</p>
                            </div>
                            <div class="detail-box-sm">
                                <label>Problem Description</label>
                                <strong>{{ $activeJob->serviceCategory->name ?? 'Emergency Service' }}</strong>
                                <p>{{ $activeJob->description }}</p>
                            </div>
                        </div>

                        <!-- PINS & PAYMENT SUMMARY -->
                        <div class="pins-card" style="background:#ffffff; border:2px solid #e2e8f0; border-radius:8px; padding:16px; margin-bottom:14px;">
                            <div class="pins-card-header" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; padding-bottom:8px; border-bottom:1px solid #f1f5f9;">
                                <h3 style="font-size:13px; font-weight:900; color:#0f172a; margin:0; display:flex; align-items:center; gap:6px;">
                                    TWO-WAY DISPATCH SECURITY PINS
                                </h3>
                                <span class="badge-pin-v success" style="padding:3px 8px; font-size:10px;">CASH ৳ 500 BDT</span>
                            </div>

                            <div class="pin-row-grid">
                                <!-- ARRIVAL PIN (PROVIDER ENTERS CUSTOMER ARRIVAL PIN) -->
                                <div class="pin-item-box {{ $activeJob->arrival_pin_verified_at ? 'verified' : '' }}" style="background:{{ $activeJob->arrival_pin_verified_at ? '#f0fdf4' : '#ffffff' }}; border:2px solid {{ $activeJob->arrival_pin_verified_at ? '#86efac' : '#e2e8f0' }}; border-radius:6px; padding:14px;">
                                    <div class="pin-item-head" style="margin-bottom:8px;">
                                        <span style="font-size:12px; font-weight:900; color:#0f172a;">1. ARRIVAL PIN VERIFICATION</span>
                                        <span class="badge-pin-v {{ $activeJob->arrival_pin_verified_at ? 'success' : 'pending' }}">
                                            {{ $activeJob->arrival_pin_verified_at ? '✓ ARRIVAL VERIFIED' : 'STEP 4' }}
                                        </span>
                                    </div>
                                    <p style="font-size:11px; color:#475569; margin:0 0 8px; line-height:1.4;">Ask customer for their 4-digit Arrival PIN when you reach the site and type it below:</p>
                                    @if(!$activeJob->arrival_pin_verified_at)
                                        <form method="POST" action="{{ route('provider.request.verify_pin', $activeJob->id) }}" style="display:flex; gap:8px; align-items:center; margin-top:6px;">
                                            @csrf
                                            <input type="hidden" name="type" value="arrival">
                                            <input type="text" name="pin" placeholder="Enter Customer Arrival PIN" required maxlength="6" autocomplete="off" style="flex:1; padding:8px 10px; font-size:13px; font-weight:800; letter-spacing:1px; border:2px solid #cbd5e1; border-radius:4px; text-align:center; background:#f8fafc; color:#0f172a;">
                                            <button type="submit" style="background:#dc2626; color:#ffffff; font-size:11px; font-weight:800; border:none; padding:8px 14px; border-radius:4px; cursor:pointer; white-space:nowrap;">
                                                VERIFY ARRIVAL PIN 
                                            </button>
                                        </form>
                                    @else
                                        <div style="font-size:11.5px; color:#166534; font-weight:800; margin-top:6px; background:#dcfce7; padding:6px 10px; border-radius:4px;">
                                             Verified at {{ $activeJob->arrival_pin_verified_at->format('h:i A') }} (Arrival Confirmed)
                                        </div>
                                    @endif
                                </div>

                                <!-- COMPLETION PIN (PROVIDER ENTERS CUSTOMER COMPLETION PIN AS WORK PROOF) -->
                                <div class="pin-item-box {{ $activeJob->completion_pin_verified_at ? 'verified' : '' }}" style="background:{{ $activeJob->completion_pin_verified_at ? '#f0fdf4' : '#ffffff' }}; border:2px solid {{ $activeJob->completion_pin_verified_at ? '#86efac' : '#e2e8f0' }}; border-radius:6px; padding:14px;">
                                    <div class="pin-item-head" style="margin-bottom:8px;">
                                        <span style="font-size:12px; font-weight:900; color:#0f172a;">2. WORK COMPLETION PROOF &amp; CASH</span>
                                        <span class="badge-pin-v {{ $activeJob->completion_pin_verified_at ? 'success' : 'pending' }}">
                                            {{ $activeJob->payment_status === 'paid' ? ' CASH RECEIVED' : 'STEP 5' }}
                                        </span>
                                    </div>
                                    <p style="font-size:11px; color:#475569; margin:0 0 8px; line-height:1.4;">
                                        When job is done, ask customer for their 4-digit Completion PIN as proof of work and collect cash <strong>৳ {{ number_format($activeJob->amount ?? 500, 2) }} BDT</strong>:
                                    </p>
                                    @if(!$activeJob->completion_pin_verified_at)
                                        <form method="POST" action="{{ route('provider.request.verify_pin', $activeJob->id) }}" style="display:flex; gap:8px; align-items:center; margin-top:6px;">
                                            @csrf
                                            <input type="hidden" name="type" value="completion">
                                            <input type="text" name="pin" placeholder="Enter Customer Completion PIN" required maxlength="6" autocomplete="off" style="flex:1; padding:8px 10px; font-size:13px; font-weight:800; letter-spacing:1px; border:2px solid #cbd5e1; border-radius:4px; text-align:center; background:#f8fafc; color:#0f172a;">
                                            <button type="submit" style="background:#059669; color:#ffffff; font-size:11px; font-weight:800; border:none; padding:8px 14px; border-radius:4px; cursor:pointer; white-space:nowrap;">
                                                CONFIRM WORK DONE &amp; FINISH 
                                            </button>
                                        </form>
                                    @else
                                        <div style="font-size:11.5px; color:#166534; font-weight:800; margin-top:6px; background:#dcfce7; padding:6px 10px; border-radius:4px;">
                                             Work Completed at {{ $activeJob->completion_pin_verified_at->format('h:i A') }} (Cash ৳ {{ number_format($activeJob->amount ?? 500, 2) }} Received)
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                @else
                    <div class="active-mission-card" style="text-align:center; padding: 40px 20px;">
                        <h3 style="font-size:14px; font-weight:800; color:#0f172a; margin:10px 0 4px;">NO ACTIVE MISSION</h3>
                        <p style="font-size:11.5px; color:#64748b;">Accept any pending emergency alert from the left panel to begin dispatch.</p>
                    </div>
                @endif
            </div>

        </div>

        <!-- COMPLETED MISSIONS HISTORY -->
        <div class="history-card">
            <div class="history-card-header">
                <h2>Completed Missions &amp; Cash Earnings History</h2>
                <span style="font-size:10.5px; font-weight:800; color:#64748b;">{{ count($completedJobs ?? []) }} MISSION(S)</span>
            </div>

            @if(isset($completedJobs) && count($completedJobs) > 0)
                <div style="overflow-x:auto;">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>REQUEST</th>
                                <th>SERVICE</th>
                                <th>CUSTOMER</th>
                                <th>AREA</th>
                                <th>CASH EARNING</th>
                                <th>COMPLETED AT</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($completedJobs as $index => $cJob)
                                <tr>
                                    <td><strong>Request {{ $index + 1 }}</strong></td>
                                    <td>{{ $cJob->serviceCategory->name ?? 'Emergency Service' }}</td>
                                    <td>
                                        <strong>{{ $cJob->customer->name ?? 'Customer' }}</strong>
                                        <small style="display:block; color:#64748b;">{{ $cJob->customer->phone ?? '' }}</small>
                                    </td>
                                    <td>{{ $cJob->area }}</td>
                                    <td><strong>৳ {{ number_format($cJob->amount ?? 500, 2) }} BDT</strong></td>
                                    <td style="color:#64748b; font-size:10px;">{{ $cJob->completed_at ? $cJob->completed_at->format('d M, h:i A') : $cJob->created_at->format('d M, h:i A') }}</td>
                                    <td><span class="badge-pin-v success"> COMPLETED</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p style="font-size:11.5px; color:#64748b; margin:0;">No completed missions yet.</p>
            @endif
        </div>

    </div>
</div>

<script>
function toggleProviderPin(type) {
    if (type === 'completion') {
        const code = document.getElementById('providerCompletionPinCode');
        const btn = document.getElementById('providerCompletionToggleBtn');
        const pin = "{{ $activeJob->completion_pin ?? '' }}";
        if (btn && code) {
            if (btn.innerText.includes('SHOW')) {
                code.innerText = pin ? pin : '----';
                btn.innerText = 'HIDE PIN';
            } else {
                code.innerText = '● ● ● ●';
                btn.innerText = 'SHOW PIN';
            }
        }
    }
}
</script>

@endsection