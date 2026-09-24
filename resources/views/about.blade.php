@extends('layouts.app')

@section('title', 'About — Smart Emergency Helper')

@section('content')

<style>
/* =========================================================
   ABOUT PAGE STYLES (EMBEDDED IN BLADE)
   ========================================================= */

.about-page {
    background-color: #f8fafc;
    min-height: 100vh;
    padding: 20px 0 32px;
}
.about-container {
    max-width: 980px;
    margin: 0 auto;
    padding: 0 16px;
}

.about-header-box {
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
.about-eyebrow {
    font-size: 9.5px;
    font-weight: 800;
    color: #dc2626;
    letter-spacing: 0.8px;
    margin-bottom: 2px;
}
.about-header-box h1 {
    font-size: 18px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}
.about-subtitle {
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

.about-grid-2col {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 16px;
}
.about-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 16px;
}
.about-card h2 {
    font-size: 13px;
    font-weight: 800;
    color: #0f172a;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 8px;
    margin-bottom: 10px;
}
.about-list-clean {
    list-style: none;
    padding: 0;
    margin: 0;
}
.about-list-clean li {
    font-size: 11.5px;
    color: #475569;
    padding: 5px 0;
    border-bottom: 1px solid #f8fafc;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* 5 Steps */
.about-steps-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 8px;
    margin-top: 10px;
}
.about-step-node {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    padding: 10px 8px;
    text-align: center;
}
.about-step-node strong {
    font-size: 11px;
    color: #0f172a;
    display: block;
    margin-top: 4px;
}

@media (max-width: 768px) {
    .about-grid-2col,
    .about-steps-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="about-page">
    <div class="about-container">

        <!-- HEADER -->
        <div class="about-header-box">
            <div>
                <div class="about-eyebrow">ABOUT THE PLATFORM</div>
                <h1>SMART EMERGENCY HELPER</h1>
                <p class="about-subtitle">Coordinating verified emergency responders across Dhaka with priority dispatch.</p>
            </div>
            <div>
                <a href="{{ route('home') }}" class="btn-nav-link">Home</a>
            </div>
        </div>

        <!-- 2 COLUMNS: PROBLEM & OBJECTIVES -->
        <div class="about-grid-2col">
            <div class="about-card">
                <h2>PROBLEM STATEMENT</h2>
                <ul class="about-list-clean">
                    <li>• Emergency response delays via phone directories and social groups.</li>
                    <li>• Zero real-time visibility into provider availability in Dhaka.</li>
                    <li>• Risk of unverified or fraudulent service personnel.</li>
                    <li>• Absence of verified completion confirmation.</li>
                </ul>
            </div>

            <div class="about-card">
                <h2>PLATFORM OBJECTIVES</h2>
                <ul class="about-list-clean">
                    <li>✓ Automated proximity &amp; rating based intelligent dispatch.</li>
                    <li>✓ Two-Way Arrival &amp; Completion PIN security.</li>
                    <li>✓ Phone OTP and Admin profile verification standard.</li>
                    <li>✓ Dedicated Client, Provider, and Admin dashboards.</li>
                </ul>
            </div>
        </div>

        <!-- 5 LIFECYCLE STEPS -->
        <div class="about-card">
            <h2>5-STEP DISPATCH LIFECYCLE</h2>
            <div class="about-steps-grid">
                <div class="about-step-node">
                    <span style="font-size:10px; font-weight:900; color:#dc2626;">01</span>
                    <strong>Pending</strong>
                    <small style="color:#64748b; font-size:9.5px; display:block;">Dispatch Sent</small>
                </div>
                <div class="about-step-node">
                    <span style="font-size:10px; font-weight:900; color:#dc2626;">02</span>
                    <strong>Accepted</strong>
                    <small style="color:#64748b; font-size:9.5px; display:block;">Helper Assigned</small>
                </div>
                <div class="about-step-node">
                    <span style="font-size:10px; font-weight:900; color:#dc2626;">03</span>
                    <strong>On The Way</strong>
                    <small style="color:#64748b; font-size:9.5px; display:block;">Travel to Site</small>
                </div>
                <div class="about-step-node">
                    <span style="font-size:10px; font-weight:900; color:#dc2626;">04</span>
                    <strong>Arrival PIN</strong>
                    <small style="color:#64748b; font-size:9.5px; display:block;">Arrival Check</small>
                </div>
                <div class="about-step-node">
                    <span style="font-size:10px; font-weight:900; color:#dc2626;">05</span>
                    <strong>Completion PIN</strong>
                    <small style="color:#64748b; font-size:9.5px; display:block;">Job Done & Cash</small>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection