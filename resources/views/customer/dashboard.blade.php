@extends('layouts.app')

@section('title', 'Customer Dashboard — Smart Emergency Helper')

@section('content')

<style>
/* =========================================================
   CUSTOMER DASHBOARD STYLES (EMBEDDED IN BLADE)
   ========================================================= */

.customer-dashboard-page {
    background-color: #f1f5f9;
    min-height: 100vh;
    padding: 16px 0 24px;
}
.customer-dashboard-container {
    max-width: 1060px;
    margin: 0 auto;
    padding: 0 16px;
}

/* Header & Nav */
.customer-dashboard-header {
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
.customer-eyebrow {
    font-size: 9.5px;
    font-weight: 800;
    color: #dc2626;
    letter-spacing: 0.8px;
    margin-bottom: 2px;
}
.customer-dashboard-header h1 {
    font-size: 17px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
    line-height: 1.2;
}
.customer-subtitle {
    font-size: 11.5px;
    color: #64748b;
    margin-top: 2px;
}
.customer-header-actions {
    display: flex;
    align-items: center;
    gap: 8px;
}
.customer-id-badge {
    background: #e0f2fe;
    color: #0369a1;
    font-weight: 800;
    font-size: 10px;
    padding: 4px 8px;
    border-radius: 4px;
    border: 1px solid #bae6fd;
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

/* Alerts */
.customer-alert {
    padding: 8px 12px;
    border-radius: 4px;
    font-size: 11.5px;
    font-weight: 600;
    margin-bottom: 12px;
}
.customer-alert-success {
    background: #dcfce7;
    border: 1px solid #86efac;
    color: #166534;
}
.customer-alert-danger {
    background: #fee2e2;
    border: 1px solid #fca5a5;
    color: #991b1b;
}

/* Main Grid */
.customer-main-grid {
    display: grid;
    grid-template-columns: 360px 1fr;
    gap: 14px;
}

/* Left Form Card */
.customer-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 16px;
}
.customer-card-title {
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
.customer-form-group {
    margin-bottom: 10px;
}
.customer-form-group label {
    display: block;
    font-size: 10px;
    font-weight: 800;
    color: #475569;
    margin-bottom: 4px;
    letter-spacing: 0.3px;
}
.customer-form-control,
.customer-form-group select,
.customer-form-group input,
.customer-form-group textarea {
    width: 100%;
    padding: 6px 10px;
    font-size: 12px;
    border: 1px solid #cbd5e1;
    border-radius: 4px;
    background: #ffffff;
    color: #0f172a;
    box-sizing: border-box;
}
.customer-form-control:focus,
.customer-form-group select:focus,
.customer-form-group input:focus,
.customer-form-group textarea:focus {
    outline: none;
    border-color: #dc2626;
}
.category-btn-group {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 4px;
}
.cat-btn {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    padding: 6px 4px;
    font-size: 10px;
    font-weight: 800;
    color: #475569;
    border-radius: 4px;
    cursor: pointer;
    text-align: center;
}
.cat-btn.active {
    background: #dc2626;
    color: #ffffff;
    border-color: #dc2626;
}
.priority-btn-group {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 4px;
}
.p-btn {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    padding: 5px 2px;
    font-size: 9.5px;
    font-weight: 800;
    color: #475569;
    border-radius: 3px;
    cursor: pointer;
    text-align: center;
}
.p-btn.active.p-crit { background: #fee2e2; border-color: #dc2626; color: #991b1b; }
.p-btn.active.p-high { background: #fef3c7; border-color: #f59e0b; color: #92400e; }
.p-btn.active.p-med  { background: #e0f2fe; border-color: #0284c7; color: #075985; }
.p-btn.active.p-norm { background: #f1f5f9; border-color: #64748b; color: #334155; }

.btn-dispatch-submit {
    width: 100%;
    background: #dc2626;
    color: #ffffff;
    border: none;
    padding: 9px 12px;
    font-size: 12px;
    font-weight: 800;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 6px;
    transition: background 0.15s;
}
.btn-dispatch-submit:hover {
    background: #b91c1c;
}

/* Right Panel: Active Request */
.active-tracker-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 16px;
    margin-bottom: 14px;
}
.tracker-head {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 10px;
    margin-bottom: 12px;
}
.tracker-req-title {
    font-size: 16px;
    font-weight: 800;
    color: #0f172a;
    display: flex;
    align-items: center;
    gap: 8px;
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

.tracker-meta-text {
    font-size: 11.5px;
    color: #64748b;
    margin-top: 3px;
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
    position: relative;
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

/* Stepper Status Toolbar */
.stepper-toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #f1f5f9;
    padding: 8px 12px;
    border-radius: 4px;
    margin-bottom: 12px;
}
.status-pill-active {
    font-size: 11.5px;
    font-weight: 800;
    color: #dc2626;
}
.btn-stepper-sm {
    font-size: 10px;
    font-weight: 700;
    padding: 4px 8px;
    border-radius: 3px;
    cursor: pointer;
    border: 1px solid transparent;
}
.btn-reset-sm {
    background: #f8fafc;
    border-color: #cbd5e1;
    color: #475569;
}
.btn-advance-sm {
    background: #0f172a;
    color: #ffffff;
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

/* PIN Verification Section */
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

.pin-display-row {
    display: flex;
    align-items: center;
    gap: 6px;
    margin: 6px 0;
}
.pin-code-text {
    font-size: 14px;
    font-weight: 800;
    letter-spacing: 2px;
    color: #0f172a;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    padding: 3px 8px;
    border-radius: 3px;
}
.pin-toggle-btn {
    background: #0f172a;
    color: #ffffff;
    font-size: 9px;
    font-weight: 700;
    border: none;
    padding: 4px 6px;
    border-radius: 3px;
    cursor: pointer;
}
.pin-verify-form {
    display: flex;
    gap: 4px;
    margin-top: 6px;
}
.pin-verify-input {
    width: 70px;
    padding: 3px 6px;
    font-size: 11px;
    font-weight: 700;
    border: 1px solid #cbd5e1;
    border-radius: 3px;
    text-align: center;
}
.btn-pin-submit {
    background: #dc2626;
    color: #ffffff;
    font-size: 9.5px;
    font-weight: 700;
    border: none;
    padding: 3px 8px;
    border-radius: 3px;
    cursor: pointer;
}
.btn-pin-submit.green {
    background: #059669;
}

/* Cash Payment Bar */
.cash-payment-bar {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    padding: 8px 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}
.pay-amount-text {
    font-size: 13px;
    font-weight: 800;
    color: #059669;
}

/* Rating Card */
.rating-action-card {
    background: #fffbeb;
    border: 1px solid #fde68a;
    border-radius: 6px;
    padding: 12px;
    margin-top: 10px;
}
.rating-action-card h3 {
    font-size: 12.5px;
    font-weight: 800;
    color: #92400e;
    margin: 0 0 4px;
}
.star-icons-group {
    display: flex;
    gap: 4px;
    font-size: 18px;
    color: #f59e0b;
    cursor: pointer;
    margin: 6px 0;
}
.btn-rate-submit {
    background: #d97706;
    color: #ffffff;
    font-size: 11px;
    font-weight: 700;
    border: none;
    padding: 6px 12px;
    border-radius: 3px;
    cursor: pointer;
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

@media (max-width: 800px) {
    .customer-main-grid {
        grid-template-columns: 1fr;
    }
    .stepper-grid,
    .pin-row-grid,
    .details-2col-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="customer-dashboard-page">
    <div class="customer-dashboard-container">

        <!-- HEADER -->
        <div class="customer-dashboard-header">
            <div>
                <div class="customer-eyebrow">CLIENT PORTAL · EMERGENCY DISPATCH</div>
                <h1>CUSTOMER DASHBOARD</h1>
                <p class="customer-subtitle">Welcome, <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->phone ?? 'Dhaka, Bangladesh' }})</p>
            </div>

            <div class="customer-header-actions">
                <span class="customer-id-badge">ID: {{ sprintf('%02d', auth()->user()->id) }}</span>
                <a href="{{ route('home') }}" class="btn-nav-link">Home</a>
                <a href="{{ route('customer.profile') }}" class="btn-nav-link">Profile</a>
                <form method="POST" action="{{ route('demo.logout') }}" style="display:inline; margin:0;">
                    @csrf
                    <button type="submit" class="btn-nav-logout">LOGOUT</button>
                </form>
            </div>
        </div>

        {{-- FLASH MESSAGES --}}
        @if(session('success'))
            <div class="customer-alert customer-alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="customer-alert customer-alert-danger">
                ⚠ {{ session('error') }}
            </div>
        @endif

        <!-- MAIN GRID (LEFT: DISPATCH FORM, RIGHT: TRACKER) -->
        <div class="customer-main-grid">

            <!-- LEFT PANEL: NEW REQUEST DISPATCH FORM -->
            <div class="customer-card">
                <div class="customer-card-title">
                    NEW EMERGENCY REQUEST
                </div>

                <form method="POST" action="{{ route('customer.emergency.store') }}">
                    @csrf

                    <!-- CATEGORY -->
                    <div class="customer-form-group">
                        <label>SERVICE GROUP</label>
                        <div class="category-btn-group">
                            <button type="button" class="cat-btn active" data-category="Emergency">EMERGENCY</button>
                            <button type="button" class="cat-btn" data-category="Technical">TECHNICAL</button>
                            <button type="button" class="cat-btn" data-category="Home">HOME</button>
                        </div>
                    </div>

                    <!-- SERVICE TYPE -->
                    <div class="customer-form-group">
                        <label for="customerServiceType">SERVICE REQUIRED</label>
                        <select id="customerServiceType" name="service_category_id" required>
                            @foreach($serviceCategories as $service)
                                <option value="{{ $service->id }}" data-category="{{ $service->group_name }}" @selected(old('service_category_id') == $service->id)>
                                    {{ $service->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- PRIORITY LEVEL -->
                    <div class="customer-form-group">
                        <label>PRIORITY LEVEL</label>
                        <input type="hidden" name="priority" id="customerPriority" value="{{ old('priority', 'Critical') }}">
                        <div class="priority-btn-group">
                            @php $curP = old('priority', 'Critical'); @endphp
                            <button type="button" class="p-btn p-crit {{ $curP === 'Critical' ? 'active' : '' }}" data-priority="Critical">CRITICAL</button>
                            <button type="button" class="p-btn p-high {{ $curP === 'High' ? 'active' : '' }}" data-priority="High">HIGH</button>
                            <button type="button" class="p-btn p-med {{ $curP === 'Medium' ? 'active' : '' }}" data-priority="Medium">MEDIUM</button>
                            <button type="button" class="p-btn p-norm {{ $curP === 'Normal' ? 'active' : '' }}" data-priority="Normal">NORMAL</button>
                        </div>
                    </div>

                    <!-- DHAKA AREA -->
                    <div class="customer-form-group">
                        <label for="customerArea">DHAKA AREA</label>
                        <select id="customerArea" name="area" required>
                            <option value="Dhanmondi" @selected(old('area', auth()->user()->area) === 'Dhanmondi')>Dhanmondi</option>
                            <option value="Mirpur" @selected(old('area', auth()->user()->area) === 'Mirpur')>Mirpur</option>
                            <option value="Uttara" @selected(old('area', auth()->user()->area) === 'Uttara')>Uttara</option>
                            <option value="Gulshan" @selected(old('area', auth()->user()->area) === 'Gulshan')>Gulshan</option>
                            <option value="Mohammadpur" @selected(old('area', auth()->user()->area) === 'Mohammadpur')>Mohammadpur</option>
                            <option value="Banani" @selected(old('area', auth()->user()->area) === 'Banani')>Banani</option>
                        </select>
                    </div>

                    <!-- DETAILED ADDRESS -->
                    <div class="customer-form-group">
                        <label for="customerAddress">DETAILED ADDRESS</label>
                        <input id="customerAddress" name="address" type="text" value="{{ old('address', auth()->user()->address) }}" placeholder="e.g. House 14, Road 8, Dhanmondi" required>
                    </div>

                    <!-- DESCRIPTION -->
                    <div class="customer-form-group">
                        <label for="customerDescription">EMERGENCY DESCRIPTION</label>
                        <textarea id="customerDescription" name="description" rows="2" placeholder="Brief details of your emergency..." required>{{ old('description') }}</textarea>
                    </div>

                    <button type="submit" class="btn-dispatch-submit">
                        DISPATCH REQUEST NOW →
                    </button>
                </form>
            </div>

            <!-- RIGHT PANEL: ACTIVE REQUEST TRACKER -->
            <div>
                @if($activeRequest)
                    <div class="active-tracker-card">
                        <div class="tracker-head">
                            <div>
                                <div style="display:flex; align-items:center; gap:6px; margin-bottom:4px;">
                                    <span class="priority-pill priority-pill-{{ strtolower($activeRequest->priority) }}">
                                        {{ strtoupper($activeRequest->priority) }}
                                    </span>
                                </div>
                                <h2 class="tracker-req-title">
                                    Request 1 : {{ $activeRequest->serviceCategory->name ?? 'Emergency Service' }}
                                </h2>
                                <p class="tracker-meta-text">
                                    Provider:
                                    @if($activeRequest->assignedProvider)
                                        <strong style="color:#059669;">{{ $activeRequest->assignedProvider->name }}</strong> ({{ $activeRequest->assignedProvider->phone ?? 'Available' }})
                                    @else
                                        <em>Broadcasting to nearest responders in {{ $activeRequest->area }}...</em>
                                    @endif
                                </p>
                            </div>
                            <div style="text-align:right;">
                                <strong style="font-size:12px; color:#0f172a;">{{ $activeRequest->created_at->format('h:i A') }}</strong>
                                <small style="display:block; color:#64748b; font-size:9.5px;">ACTIVE SINCE</small>
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

                        <!-- CURRENT STATUS & SIMULATION CONTROLS -->
                        <div class="stepper-toolbar">
                            <div>
                                <small style="display:block; font-size:9px; color:#64748b; font-weight:700;">CURRENT LIFECYCLE PHASE</small>
                                <span class="status-pill-active">{{ ucwords(str_replace('_', ' ', $activeRequest->status)) }}</span>
                            </div>
                            <div style="display:flex; gap:6px;">
                                <form method="POST" action="{{ route('customer.request.reset', $activeRequest->id) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-stepper-sm btn-reset-sm">RESET</button>
                                </form>
                                <form method="POST" action="{{ route('customer.request.advance', $activeRequest->id) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-stepper-sm btn-advance-sm">ADVANCE STEP →</button>
                                </form>
                            </div>
                        </div>

                        <!-- 2-COL DETAILS -->
                        <div class="details-2col-grid">
                            <div class="detail-box-sm">
                                <label>Assigned Provider</label>
                                <strong>{{ $activeRequest->assignedProvider->name ?? 'Awaiting Provider Acceptance' }}</strong>
                                <p>{{ $activeRequest->assignedProvider->phone ?? 'Provider contact will appear once accepted' }}</p>
                            </div>
                            <div class="detail-box-sm">
                                <label>Emergency Location</label>
                                <strong>{{ $activeRequest->area }}, Dhaka</strong>
                                <p>{{ $activeRequest->address }}</p>
                            </div>
                        </div>

                        <!-- TWO-WAY VERIFICATION PINS -->
                        <div class="pins-card" style="background:#ffffff; border:2px solid #e2e8f0; border-radius:8px; padding:16px; margin-bottom:14px;">
                            <div class="pins-card-header" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; padding-bottom:8px; border-bottom:1px solid #f1f5f9;">
                                <h3 style="font-size:13px; font-weight:900; color:#0f172a; margin:0; display:flex; align-items:center; gap:6px;">
                                    TWO-WAY DISPATCH SECURITY PINS
                                </h3>
                                <span class="badge-pin-v success" style="padding:3px 8px; font-size:10px;">CLIENT &amp; PROVIDER VERIFIED</span>
                            </div>

                            <div class="pin-row-grid">
                                <!-- 1. ARRIVAL PIN (CUSTOMER GIVES TO PROVIDER) -->
                                <div class="pin-item-box {{ $activeRequest->arrival_pin_verified_at ? 'verified' : '' }}" style="background:{{ $activeRequest->arrival_pin_verified_at ? '#f0fdf4' : '#ffffff' }}; border:2px solid {{ $activeRequest->arrival_pin_verified_at ? '#86efac' : '#e2e8f0' }}; border-radius:6px; padding:14px;">
                                    <div class="pin-item-head" style="margin-bottom:8px;">
                                        <span style="font-size:12px; font-weight:900; color:#0f172a;">1. YOUR ARRIVAL PIN</span>
                                        <span class="badge-pin-v {{ $activeRequest->arrival_pin_verified_at ? 'success' : 'pending' }}">
                                            {{ $activeRequest->arrival_pin_verified_at ? '✓ VERIFIED' : 'GIVE TO PROVIDER' }}
                                        </span>
                                    </div>
                                    <div class="pin-display-row" style="display:flex; align-items:center; gap:6px; margin:6px 0;">
                                        <div id="arrivalPinCode" class="pin-code-text" style="font-size:16px; font-weight:900; letter-spacing:3px; padding:6px 12px; border:2px solid #dc2626; border-radius:4px; background:#fff5f5; color:#dc2626;">{{ $activeRequest->arrival_pin }}</div>
                                        <button type="button" id="arrivalToggleBtn" onclick="toggleCustomerPin('arrival')" class="pin-toggle-btn" style="padding:6px 10px; font-weight:800; font-size:10px; background:#0f172a; color:#ffffff; border-radius:4px; cursor:pointer; border:none;">HIDE PIN</button>
                                    </div>
                                    <p style="color:#475569; font-size:11px; margin:6px 0 0; line-height:1.4;">
                                        @if(!$activeRequest->arrival_pin_verified_at)
                                            Tell this 4-digit PIN to the provider when they arrive at your location. The provider will type it in their app to verify arrival.
                                        @else
                                            <strong style="color:#166534;">✓ Provider verified arrival at {{ $activeRequest->arrival_pin_verified_at->format('h:i A') }}</strong>
                                        @endif
                                    </p>
                                </div>

                                <!-- 2. COMPLETION PIN (CUSTOMER GIVES TO PROVIDER AS PROOF OF WORK) -->
                                <div class="pin-item-box {{ $activeRequest->completion_pin_verified_at ? 'verified' : '' }}" style="background:{{ $activeRequest->completion_pin_verified_at ? '#f0fdf4' : '#ffffff' }}; border:2px solid {{ $activeRequest->completion_pin_verified_at ? '#86efac' : '#e2e8f0' }}; border-radius:6px; padding:14px;">
                                    <div class="pin-item-head" style="margin-bottom:8px;">
                                        <span style="font-size:12px; font-weight:900; color:#0f172a;">2. YOUR COMPLETION PIN</span>
                                        <span class="badge-pin-v {{ $activeRequest->completion_pin_verified_at ? 'success' : 'pending' }}">
                                            {{ $activeRequest->completion_pin_verified_at ? '✓ COMPLETED' : 'GIVE UPON FINISH' }}
                                        </span>
                                    </div>
                                    <div class="pin-display-row" style="display:flex; align-items:center; gap:6px; margin:6px 0;">
                                        <div id="completionPinCode" class="pin-code-text" style="font-size:16px; font-weight:900; letter-spacing:3px; padding:6px 12px; border:2px solid #059669; border-radius:4px; background:#f0fdf4; color:#059669;">{{ $activeRequest->completion_pin }}</div>
                                        <button type="button" id="completionToggleBtn" onclick="toggleCustomerPin('completion')" class="pin-toggle-btn" style="padding:6px 10px; font-weight:800; font-size:10px; background:#0f172a; color:#ffffff; border-radius:4px; cursor:pointer; border:none;">HIDE PIN</button>
                                    </div>
                                    <p style="color:#475569; font-size:11px; margin:6px 0 0; line-height:1.4;">
                                        @if(!$activeRequest->completion_pin_verified_at)
                                            Give this 4-digit Completion PIN to the provider <strong>ONLY when the job is done</strong> and pay cash <strong>৳ {{ number_format($activeRequest->amount ?? 500, 2) }} BDT</strong>. The provider types it to prove the work is completed.
                                        @else
                                            <strong style="color:#166534;">✓ Work completed &amp; cash ৳ {{ number_format($activeRequest->amount ?? 500, 2) }} paid at {{ $activeRequest->completion_pin_verified_at->format('h:i A') }}</strong>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- CASH PAYMENT BAR -->
                        <div class="cash-payment-bar">
                            <div>
                                <small style="display:block; font-size:9.5px; color:#64748b; font-weight:700;">PAYMENT (CASH ON SERVICE)</small>
                                <span class="pay-amount-text">৳ {{ number_format($activeRequest->amount ?? 500, 2) }} BDT</span>
                            </div>
                            <div>
                                @if($activeRequest->payment_status === 'paid')
                                    <span class="badge-pin-v success">✓ CASH PAID &amp; RECEIVED</span>
                                @else
                                    <span class="badge-pin-v pending">⏳ CASH DUE UPON COMPLETION</span>
                                @endif
                            </div>
                        </div>

                        <!-- RATING & REVIEW CARD -->
                        @if(in_array($activeRequest->status, ['completed', 'rating_review']))
                            <div class="rating-action-card">
                                <h3>★ Service Completed · Rate Your Experience</h3>
                                <p style="font-size:11px; color:#78350f; margin:0 0 6px;">Submit rating to close Request 1:</p>
                                <form method="POST" action="{{ route('customer.request.rate', $activeRequest->id) }}">
                                    @csrf
                                    <input type="hidden" name="rating" id="ratingScoreInput" value="5">
                                    <div class="star-icons-group" id="starIconsRow">
                                        <span onclick="pickRating(1)">★</span>
                                        <span onclick="pickRating(2)">★</span>
                                        <span onclick="pickRating(3)">★</span>
                                        <span onclick="pickRating(4)">★</span>
                                        <span onclick="pickRating(5)">★</span>
                                        <small id="ratingLabel" style="font-size:11px; font-weight:700; color:#92400e; margin-left:6px;">5 / 5 Stars</small>
                                    </div>
                                    <div style="margin: 6px 0;">
                                        <input type="text" name="comment" placeholder="Optional comments (e.g. Prompt ambulance arrived on time)" class="customer-form-control">
                                    </div>
                                    <button type="submit" class="btn-rate-submit">✓ SUBMIT REVIEW &amp; CLOSE</button>
                                </form>
                            </div>
                        @endif

                    </div>
                @else
                    <div class="active-tracker-card" style="text-align:center; padding: 40px 20px;">
                        <h3 style="font-size:14px; font-weight:800; color:#0f172a; margin:10px 0 4px;">NO ACTIVE REQUEST</h3>
                        <p style="font-size:11.5px; color:#64748b;">Fill out the form on the left to dispatch an emergency helper near you.</p>
                    </div>
                @endif
            </div>

        </div>

        <!-- CUSTOMER SERVICE HISTORY -->
        <div class="history-card">
            <div class="history-card-header">
                <h2>Service &amp; Payment History</h2>
                <span style="font-size:10.5px; font-weight:800; color:#64748b;">{{ count($completedRequests ?? []) }} RECORD(S)</span>
            </div>

            @if(isset($completedRequests) && count($completedRequests) > 0)
                <div style="overflow-x:auto;">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>REQUEST</th>
                                <th>SERVICE</th>
                                <th>PROVIDER</th>
                                <th>AREA</th>
                                <th>FEE</th>
                                <th>PAYMENT</th>
                                <th>COMPLETED AT</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($completedRequests as $index => $cReq)
                                <tr>
                                    <td><strong>Request {{ $index + 1 }}</strong></td>
                                    <td>{{ $cReq->serviceCategory->name ?? 'Emergency Service' }}</td>
                                    <td>
                                        <strong style="color:#059669;">{{ $cReq->assignedProvider->name ?? 'Verified Provider' }}</strong>
                                    </td>
                                    <td>{{ $cReq->area }}</td>
                                    <td><strong>৳ {{ number_format($cReq->amount ?? 500, 2) }}</strong></td>
                                    <td><span class="badge-pin-v success">Cash Paid</span></td>
                                    <td style="color:#64748b; font-size:10px;">{{ $cReq->completed_at ? $cReq->completed_at->format('d M, h:i A') : $cReq->created_at->format('d M, h:i A') }}</td>
                                    <td><span class="badge-pin-v success">✓ COMPLETED</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p style="font-size:11.5px; color:#64748b; margin:0;">No previous completed requests found.</p>
            @endif
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const catBtns = document.querySelectorAll('.cat-btn');
    const serviceSelect = document.getElementById('customerServiceType');
    const priorityBtns = document.querySelectorAll('.p-btn');
    const priorityInput = document.getElementById('customerPriority');

    if (serviceSelect) {
        const allServices = Array.from(serviceSelect.options).map(opt => ({
            value: opt.value,
            text: opt.textContent.trim(),
            category: opt.dataset.category
        }));

        function filterServices(cat) {
            serviceSelect.innerHTML = '';
            const filtered = allServices.filter(s =>
                s.category && s.category.toLowerCase() === cat.toLowerCase()
            );
            filtered.forEach(s => {
                const opt = document.createElement('option');
                opt.value = s.value;
                opt.textContent = s.text;
                opt.dataset.category = s.category;
                serviceSelect.appendChild(opt);
            });
        }

        catBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                catBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                filterServices(this.dataset.category);
            });
        });

        filterServices('Emergency');
    }

    if (priorityBtns.length && priorityInput) {
        priorityBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                priorityBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                priorityInput.value = this.dataset.priority;
            });
        });
    }
});

function toggleCustomerPin(type) {
    if (type === 'arrival') {
        const code = document.getElementById('arrivalPinCode');
        const btn = document.getElementById('arrivalToggleBtn');
        const pin = "{{ $activeRequest->arrival_pin ?? '' }}";
        if (btn.innerText.includes('SHOW')) {
            code.innerText = pin ? pin : '----';
            btn.innerText = 'HIDE PIN';
        } else {
            code.innerText = '● ● ● ●';
            btn.innerText = 'SHOW PIN';
        }
    } else if (type === 'completion') {
        const code = document.getElementById('completionPinCode');
        const btn = document.getElementById('completionToggleBtn');
        const pin = "{{ $activeRequest->completion_pin ?? '' }}";
        if (btn.innerText.includes('SHOW')) {
            code.innerText = pin ? pin : '----';
            btn.innerText = 'HIDE PIN';
        } else {
            code.innerText = '● ● ● ●';
            btn.innerText = 'SHOW PIN';
        }
    }
}

function pickRating(val) {
    const input = document.getElementById('ratingScoreInput');
    const label = document.getElementById('ratingLabel');
    if (input) input.value = val;
    if (label) label.innerText = val + ' / 5 Stars';
    const stars = document.querySelectorAll('#starIconsRow span');
    stars.forEach((st, idx) => {
        st.style.color = (idx < val) ? '#f59e0b' : '#cbd5e1';
    });
}
</script>

@endsection