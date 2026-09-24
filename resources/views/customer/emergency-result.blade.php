@extends('layouts.app')

@section('title', 'Emergency Dispatch Result — Smart Emergency Helper')

@section('content')

<style>
/* =========================================================
   EMERGENCY RESULT STYLES (EMBEDDED IN BLADE)
   ========================================================= */

.dispatch-result-page {
    background-color: #f8fafc;
    min-height: 100vh;
    padding: 24px 0 40px;
}
.dispatch-result-container {
    max-width: 980px;
    margin: 0 auto;
    padding: 0 16px;
}

.dispatch-header-box {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 16px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 16px;
}
.dispatch-eyebrow {
    font-size: 9.5px;
    font-weight: 800;
    color: #dc2626;
    letter-spacing: 0.8px;
    margin-bottom: 2px;
}
.dispatch-header-box h1 {
    font-size: 18px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
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

.dispatch-result-grid {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 16px;
}

.result-main-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 20px;
}
.result-ref-title {
    font-size: 20px;
    font-weight: 900;
    color: #0f172a;
    margin-bottom: 6px;
}
.result-desc {
    font-size: 12px;
    color: #475569;
    line-height: 1.45;
    margin-bottom: 16px;
}

.assigned-provider-box {
    background: #f0fdf4;
    border: 1px solid #86efac;
    border-radius: 6px;
    padding: 14px 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}
.assigned-provider-box strong {
    font-size: 14px;
    color: #166534;
    display: block;
}
.badge-assigned {
    background: #16a34a;
    color: #ffffff;
    font-size: 10px;
    font-weight: 800;
    padding: 4px 8px;
    border-radius: 3px;
}

.attempt-row-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    padding: 8px 12px;
    margin-bottom: 6px;
    font-size: 11.5px;
}
.badge-att-status {
    font-size: 9px;
    font-weight: 800;
    padding: 2px 6px;
    border-radius: 3px;
}
.badge-att-status.accepted { background: #dcfce7; color: #166534; }
.badge-att-status.declined { background: #fee2e2; color: #991b1b; }
.badge-att-status.expired  { background: #fef3c7; color: #92400e; }

.result-actions-row {
    display: flex;
    gap: 8px;
    margin-top: 20px;
}
.btn-action-main {
    background: #dc2626;
    color: #ffffff;
    padding: 8px 14px;
    font-size: 11.5px;
    font-weight: 800;
    border-radius: 4px;
    text-decoration: none;
}
.btn-action-main:hover { background: #b91c1c; color: #ffffff; text-decoration: none; }

.sidebar-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 16px;
    margin-bottom: 14px;
}
.sidebar-card h3 {
    font-size: 11px;
    font-weight: 800;
    color: #0f172a;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 6px;
    margin-bottom: 10px;
}
.summary-row {
    display: flex;
    justify-content: space-between;
    font-size: 11px;
    padding: 4px 0;
    border-bottom: 1px solid #f8fafc;
}
.summary-row span { color: #64748b; }
.summary-row strong { color: #0f172a; }

@media (max-width: 768px) {
    .dispatch-result-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="dispatch-result-page">
    <div class="dispatch-result-container">

        <!-- HEADER -->
        <div class="dispatch-header-box">
            <div>
                <div class="dispatch-eyebrow">DISPATCH RESULT · DEMO BROADCAST</div>
                <h1>EMERGENCY REQUEST DISPATCHED</h1>
            </div>
            <div>
                <a href="{{ route('home') }}" class="btn-nav-link">Home</a>
            </div>
        </div>

        <div class="dispatch-result-grid">
            <!-- MAIN CARD -->
            <div class="result-main-card">
                <h2 class="result-ref-title">Request 1 : {{ $emergency['service'] }} ({{ $emergency['group'] }})</h2>
                <p class="result-desc">
                    Priority: <strong>{{ $emergency['priority'] }}</strong> · Location: <strong>{{ $emergency['area'] }}</strong>, {{ $emergency['address'] }}.
                    The dispatch engine has ranked and assigned the most suitable nearby verified provider.
                </p>

                <!-- ASSIGNED PROVIDER -->
                <div class="assigned-provider-box">
                    <div>
                        <small style="font-size:9.5px; font-weight:800; color:#166534; display:block;">ASSIGNED VERIFIED PROVIDER</small>
                        <strong>{{ $emergency['assigned_provider'] }}</strong>
                    </div>
                    <span class="badge-assigned">✓ ASSIGNED</span>
                </div>

                <!-- ATTEMPTS -->
                <h3 style="font-size:11.5px; font-weight:800; color:#0f172a; margin:14px 0 8px;">DISPATCH ATTEMPTS HISTORY</h3>
                @foreach($emergency['attempts'] as $index => $attempt)
                    <div class="attempt-row-item">
                        <span><strong>#0{{ $index + 1 }}</strong> {{ $attempt['provider'] }}</span>
                        @if($attempt['status'] === 'DECLINED')
                            <span class="badge-att-status declined">DECLINED</span>
                        @elseif($attempt['status'] === 'EXPIRED')
                            <span class="badge-att-status expired">EXPIRED</span>
                        @else
                            <span class="badge-att-status accepted">ACCEPTED</span>
                        @endif
                    </div>
                @endforeach

                <div class="result-actions-row">
                    <a href="{{ route('customer.dashboard') }}" class="btn-action-main">
                        OPEN CUSTOMER DASHBOARD →
                    </a>
                    <a href="{{ route('emergency.form') }}" class="btn-nav-link">
                        Create Another Request
                    </a>
                </div>
            </div>

            <!-- SIDEBAR -->
            <aside>
                <div class="sidebar-card">
                    <h3>REQUEST SUMMARY</h3>
                    <div class="summary-row"><span>Group</span><strong>{{ $emergency['group'] }}</strong></div>
                    <div class="summary-row"><span>Service</span><strong>{{ $emergency['service'] }}</strong></div>
                    <div class="summary-row"><span>Priority</span><strong>{{ $emergency['priority'] }}</strong></div>
                    <div class="summary-row"><span>Area</span><strong>{{ $emergency['area'] }}</strong></div>
                </div>

                <div class="sidebar-card">
                    <h3>5 DISPATCH STEPS</h3>
                    <div style="font-size:11px; color:#475569; display:flex; flex-direction:column; gap:6px;">
                        <div>1. Pending</div>
                        <div>2. Accepted</div>
                        <div>3. On The Way</div>
                        <div>4. Arrival PIN</div>
                        <div>5. Completion PIN</div>
                    </div>
                </div>
            </aside>
        </div>

    </div>
</div>

@endsection