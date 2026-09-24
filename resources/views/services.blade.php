@extends('layouts.app')

@section('title', 'Service Catalogue — Smart Emergency Helper')

@section('content')

<style>
/* =========================================================
   SERVICES CATALOGUE STYLES (EMBEDDED IN BLADE)
   ========================================================= */

.services-page {
    background-color: #f8fafc;
    min-height: 100vh;
    padding: 20px 0 32px;
}
.services-container {
    max-width: 1040px;
    margin: 0 auto;
    padding: 0 16px;
}

.services-header-box {
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
.services-eyebrow {
    font-size: 9.5px;
    font-weight: 800;
    color: #dc2626;
    letter-spacing: 0.8px;
    margin-bottom: 2px;
}
.services-header-box h1 {
    font-size: 18px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}
.services-subtitle {
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

.service-group-section {
    margin-bottom: 20px;
}
.group-header-row {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 10px;
    padding-bottom: 4px;
    border-bottom: 2px solid #e2e8f0;
}
.group-header-row h2 {
    font-size: 13px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}
.group-badge {
    font-size: 9px;
    font-weight: 800;
    padding: 2px 6px;
    border-radius: 3px;
    background: #e2e8f0;
    color: #475569;
}

.services-grid-box {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
}
.service-item-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 14px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.service-item-card:hover {
    border-color: #cbd5e1;
    box-shadow: 0 4px 10px rgba(0,0,0,0.04);
}
.service-card-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}
.service-priority-badge {
    font-size: 9px;
    font-weight: 800;
    padding: 2px 6px;
    border-radius: 3px;
}
.p-crit { background: #fee2e2; color: #991b1b; }
.p-high { background: #fef3c7; color: #92400e; }
.p-med  { background: #e0f2fe; color: #075985; }
.p-norm { background: #f1f5f9; color: #334155; }

.service-item-card h3 {
    font-size: 13.5px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 4px;
}
.service-item-card p {
    font-size: 11.5px;
    color: #64748b;
    margin-bottom: 12px;
    line-height: 1.4;
}

.service-bottom-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #f1f5f9;
    padding-top: 8px;
}
.eta-text {
    font-size: 10px;
    font-weight: 700;
    color: #0284c7;
}
.btn-req-svc {
    font-size: 10.5px;
    font-weight: 800;
    color: #dc2626;
    text-decoration: none;
}
.btn-req-svc:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .services-grid-box {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="services-page">
    <div class="services-container">

        <!-- HEADER -->
        <div class="services-header-box">
            <div>
                <div class="services-eyebrow">8 SERVICES · 3 DISPATCH TIERS</div>
                <h1>SERVICE CATALOGUE</h1>
                <p class="services-subtitle">Every service vertical carries a default response window & SLA.</p>
            </div>
            <div>
                <a href="{{ route('home') }}" class="btn-nav-link">Home</a>
            </div>
        </div>

        <!-- EMERGENCY GROUP (3) -->
        <div class="service-group-section">
            <div class="group-header-row">
                <span style="width:8px; height:8px; border-radius:50%; background:#dc2626; display:inline-block;"></span>
                <h2>EMERGENCY SERVICES</h2>
                <span class="group-badge">3 SERVICES</span>
            </div>

            <div class="services-grid-box">
                <div class="service-item-card">
                    <div>
                        <div class="service-card-head">
                            <span class="service-priority-badge p-crit">CRITICAL</span>
                            <span class="eta-text">8–15 MIN</span>
                        </div>
                        <h3>Ambulance Service</h3>
                        <p>Life support transport to nearest hospital with verified emergency medical staff.</p>
                    </div>
                    <div class="service-bottom-row">
                        <span style="font-size:10px; color:#64748b;">Fixed Fee ৳500</span>
                        <a href="{{ route('emergency.form') }}" class="btn-req-svc">REQUEST →</a>
                    </div>
                </div>

                <div class="service-item-card">
                    <div>
                        <div class="service-card-head">
                            <span class="service-priority-badge p-high">HIGH</span>
                            <span class="eta-text">30–60 MIN</span>
                        </div>
                        <h3>Home Nurse</h3>
                        <p>Post-operative nursing, wound dressing, monitoring, and in-residence care.</p>
                    </div>
                    <div class="service-bottom-row">
                        <span style="font-size:10px; color:#64748b;">Fixed Fee ৳500</span>
                        <a href="{{ route('emergency.form') }}" class="btn-req-svc">REQUEST →</a>
                    </div>
                </div>

                <div class="service-item-card">
                    <div>
                        <div class="service-card-head">
                            <span class="service-priority-badge p-crit">CRITICAL</span>
                            <span class="eta-text">15–40 MIN</span>
                        </div>
                        <h3>Blood Donor</h3>
                        <p>Direct group-matched donor assistance across Dhaka volunteer blood networks.</p>
                    </div>
                    <div class="service-bottom-row">
                        <span style="font-size:10px; color:#64748b;">Verified Match</span>
                        <a href="{{ route('emergency.form') }}" class="btn-req-svc">REQUEST →</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- TECHNICAL GROUP (3) -->
        <div class="service-group-section">
            <div class="group-header-row">
                <span style="width:8px; height:8px; border-radius:50%; background:#0284c7; display:inline-block;"></span>
                <h2>TECHNICAL SERVICES</h2>
                <span class="group-badge">3 SERVICES</span>
            </div>

            <div class="services-grid-box">
                <div class="service-item-card">
                    <div>
                        <div class="service-card-head">
                            <span class="service-priority-badge p-high">HIGH</span>
                            <span class="eta-text">25–45 MIN</span>
                        </div>
                        <h3>Electrician</h3>
                        <p>Short circuits, electrical board faults, wiring issues, and power restoration.</p>
                    </div>
                    <div class="service-bottom-row">
                        <span style="font-size:10px; color:#64748b;">Fixed Fee ৳500</span>
                        <a href="{{ route('emergency.form') }}" class="btn-req-svc">REQUEST →</a>
                    </div>
                </div>

                <div class="service-item-card">
                    <div>
                        <div class="service-card-head">
                            <span class="service-priority-badge p-high">HIGH</span>
                            <span class="eta-text">30–60 MIN</span>
                        </div>
                        <h3>Plumber</h3>
                        <p>Burst pipes, emergency drainage, leaks, and water motor pump troubleshooting.</p>
                    </div>
                    <div class="service-bottom-row">
                        <span style="font-size:10px; color:#64748b;">Fixed Fee ৳500</span>
                        <a href="{{ route('emergency.form') }}" class="btn-req-svc">REQUEST →</a>
                    </div>
                </div>

                <div class="service-item-card">
                    <div>
                        <div class="service-card-head">
                            <span class="service-priority-badge p-med">MEDIUM</span>
                            <span class="eta-text">45–90 MIN</span>
                        </div>
                        <h3>AC Technician</h3>
                        <p>Compressor troubleshooting, gas refill, leak repairs, and HVAC diagnostic service.</p>
                    </div>
                    <div class="service-bottom-row">
                        <span style="font-size:10px; color:#64748b;">Fixed Fee ৳500</span>
                        <a href="{{ route('emergency.form') }}" class="btn-req-svc">REQUEST →</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- HOME GROUP (2) -->
        <div class="service-group-section">
            <div class="group-header-row">
                <span style="width:8px; height:8px; border-radius:50%; background:#475569; display:inline-block;"></span>
                <h2>HOME SERVICES</h2>
                <span class="group-badge">2 SERVICES</span>
            </div>

            <div class="services-grid-box">
                <div class="service-item-card">
                    <div>
                        <div class="service-card-head">
                            <span class="service-priority-badge p-norm">NORMAL</span>
                            <span class="eta-text">SAME DAY</span>
                        </div>
                        <h3>Cleaner</h3>
                        <p>Post-incident sanitization, room deep cleaning, and residential cleanup.</p>
                    </div>
                    <div class="service-bottom-row">
                        <span style="font-size:10px; color:#64748b;">Fixed Fee ৳500</span>
                        <a href="{{ route('emergency.form') }}" class="btn-req-svc">REQUEST →</a>
                    </div>
                </div>

                <div class="service-item-card">
                    <div>
                        <div class="service-card-head">
                            <span class="service-priority-badge p-norm">NORMAL</span>
                            <span class="eta-text">SAME DAY</span>
                        </div>
                        <h3>Carpenter</h3>
                        <p>Door, window, lock fitting, and furniture structure urgent maintenance.</p>
                    </div>
                    <div class="service-bottom-row">
                        <span style="font-size:10px; color:#64748b;">Fixed Fee ৳500</span>
                        <a href="{{ route('emergency.form') }}" class="btn-req-svc">REQUEST →</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection