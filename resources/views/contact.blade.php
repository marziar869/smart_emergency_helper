@extends('layouts.app')

@section('title', 'Contact Dispatch — Smart Emergency Helper')

@section('content')

<style>
/* =========================================================
   CONTACT PAGE STYLES
   ========================================================= */

.contact-page {
    background-color: #f8fafc;
    min-height: 100vh;
    padding: 24px 0 40px;
}
.contact-container {
    max-width: 960px;
    margin: 0 auto;
    padding: 0 16px;
}

.contact-header-box {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 18px 22px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 20px;
}
.contact-eyebrow {
    font-size: 9.5px;
    font-weight: 800;
    color: #dc2626;
    letter-spacing: 0.8px;
    margin-bottom: 2px;
}
.contact-header-box h1 {
    font-size: 18px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}
.contact-subtitle {
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
    padding: 6px 14px;
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

.contact-cards-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
    margin-bottom: 20px;
}
.contact-card-box {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 18px;
    transition: all 0.15s ease;
}
.contact-card-box:hover {
    border-color: #cbd5e1;
    box-shadow: 0 4px 12px rgba(0,0,0,0.04);
}
.contact-card-box small {
    font-size: 9.5px;
    font-weight: 800;
    color: #dc2626;
    display: block;
    text-transform: uppercase;
    margin-bottom: 4px;
}
.contact-card-box h3 {
    font-size: 15px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 6px;
}
.contact-card-box p {
    font-size: 11.5px;
    color: #64748b;
    margin: 0;
    line-height: 1.4;
}

.contact-detail-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 22px;
}
.contact-detail-card h2 {
    font-size: 14px;
    font-weight: 800;
    color: #0f172a;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 8px;
    margin-bottom: 16px;
}
.contact-info-list {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}
.contact-info-item {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    padding: 14px;
}
.contact-info-item strong {
    font-size: 12px;
    font-weight: 800;
    color: #0f172a;
    display: block;
    margin-bottom: 4px;
}
.contact-info-item p {
    font-size: 11px;
    color: #64748b;
    margin: 0;
    line-height: 1.45;
}

</style>

<div class="contact-page">
    <div class="contact-container">

        <!-- HEADER -->
        <div class="contact-header-box">
            <div>
                <h1>TALK TO DISPATCH</h1>
                <p class="contact-subtitle">For urgent life-threatening emergencies, dial national 999 or 16263 directly.</p>
            </div>
            <div>
                <a href="{{ route('home') }}" class="btn-nav-link">Home</a>
            </div>
        </div>

        <!-- 3 CARDS -->
        <div class="contact-cards-row">
            <div class="contact-card-box">
                <small>NATIONAL EMERGENCY</small>
                <h3>999 · 16</h3>
                <p>Government emergency lines for immediate police, fire service, and national health support.</p>
            </div>
            <div class="contact-card-box">
                <small>DISPATCH HELPDESK</small>
                <h3>+880 1700-000000</h3>
                <p>Smart Emergency Helper 24/7 central desk for live dispatch and rapid response assistance.</p>
            </div>
            <div class="contact-card-box">
                <small>OPERATIONS EMAIL</small>
                <h3>dispatch@seh.com.bd</h3>
                <p>Provider verification inquiries, technical support, and coordination assistance.</p>
            </div>
        </div>

@endsection