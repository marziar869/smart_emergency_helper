@extends('layouts.app')

@section('title', 'Admin Operations Panel')

@section('content')

<style>
/* =========================================================
   ADMIN DASHBOARD STYLES
   ========================================================= */

.admin-dashboard {
    background-color: #f8fafc;
    min-height: 100vh;
    padding: 16px 0 28px;
}
.admin-container {
    max-width: 1060px;
    margin: 0 auto;
    padding: 0 16px;
}

/* Header */
.admin-header-card {
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
.admin-eyebrow {
    font-size: 9.5px;
    font-weight: 800;
    color: #dc2626;
    letter-spacing: 0.8px;
    margin-bottom: 2px;
}
.admin-header-card h1 {
    font-size: 18px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}
.admin-header-card p {
    font-size: 11.5px;
    color: #64748b;
    margin-top: 2px;
}
.admin-header-actions {
    display: flex;
    align-items: center;
    gap: 8px;
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
.btn-nav-logout {
    background: #fee2e2;
    border: 1px solid #fca5a5;
    color: #b91c1c;
    font-size: 11px;
    font-weight: 700;
    padding: 6px 12px;
    border-radius: 4px;
    cursor: pointer;
}

/* KPI Cards */
.admin-kpi-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    margin-bottom: 14px;
}
.admin-kpi-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 12px 14px;
}
.admin-kpi-card span {
    font-size: 9.5px;
    font-weight: 800;
    color: #64748b;
    display: block;
    text-transform: uppercase;
}
.admin-kpi-card strong {
    font-size: 20px;
    font-weight: 900;
    color: #0f172a;
    display: block;
    margin: 2px 0;
}
.admin-kpi-card small {
    font-size: 10px;
    color: #059669;
    font-weight: 600;
}

/* Panels */
.admin-panel {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 16px;
    margin-bottom: 14px;
}
.panel-header-flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 8px;
    margin-bottom: 12px;
}
.admin-panel-title {
    font-size: 13px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}
.badge-count {
    font-size: 9.5px;
    font-weight: 800;
    background: #fee2e2;
    color: #991b1b;
    padding: 2px 6px;
    border-radius: 3px;
}

/* Verification List */
.verify-list-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
}
.verify-row {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    padding: 10px 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.verify-info strong {
    font-size: 12px;
    color: #0f172a;
    display: block;
}
.verify-info p {
    font-size: 11px;
    color: #64748b;
    margin: 2px 0;
}
.verify-info small {
    font-size: 9.5px;
    color: #0284c7;
    font-weight: 700;
}
.admin-light-btn {
    background: #dc2626;
    color: #ffffff;
    font-size: 10px;
    font-weight: 800;
    padding: 5px 10px;
    border-radius: 3px;
    text-decoration: none;
}
.admin-light-btn:hover {
    background: #b91c1c;
    color: #ffffff;
    text-decoration: none;
}

/* Tables */
.admin-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 11px;
}
.admin-table th {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    padding: 6px 8px;
    text-align: left;
    font-size: 9.5px;
    font-weight: 800;
    color: #475569;
}
.admin-table td {
    padding: 7px 8px;
    border-bottom: 1px solid #f1f5f9;
    color: #334155;
}
.role-chip {
    font-size: 9px;
    font-weight: 800;
    padding: 2px 6px;
    border-radius: 3px;
}
.role-customer { background: #e0f2fe; color: #0369a1; }
.role-provider { background: #fef3c7; color: #92400e; }
.role-admin { background: #fee2e2; color: #991b1b; }

.status-badge-active { color: #166534; font-weight: 800; font-size: 9.5px; }
.status-badge-suspended { color: #991b1b; font-weight: 800; font-size: 9.5px; }

.admin-outline-btn {
    font-size: 9.5px;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 3px;
    cursor: pointer;
    border: 1px solid #cbd5e1;
    background: #ffffff;
}
.btn-suspend { color: #dc2626; border-color: #fca5a5; }
.btn-reinstate { color: #16a34a; border-color: #86efac; }

</style>

<div class="admin-dashboard">
    <div class="admin-container">

        <!-- HEADER -->
        <div class="admin-header-card">
            <div>
                <h1>ADMINISTRATOR CONTROL PANEL</h1>
            </div>
            <div class="admin-header-actions">
                <a href="{{ route('home') }}" class="btn-nav-link">Home</a>
                <form method="POST" action="{{ route('demo.logout') }}" style="display:inline; margin:0;">
                    @csrf
                    <button type="submit" class="btn-nav-logout">LOGOUT</button>
                </form>
            </div>
        </div>

        {{-- FLASH ALERTS --}}
        @if(session('success'))
            <div style="background:#dcfce7; border:1px solid #86efac; color:#166534; padding:8px 12px; border-radius:4px; margin-bottom:12px; font-size:11.5px; font-weight:700;">
                 {{ session('success') }}
            </div>
        @endif

        <!-- KPI STATS -->
        <section class="admin-kpi-grid">
            <div class="admin-kpi-card">
                <span>Total Users</span>
                <strong>{{ $totalUsers ?? 0 }}</strong>
                <small>{{ $totalCustomers ?? 0 }} Customers</small>
            </div>
            <div class="admin-kpi-card">
                <span>Total Providers</span>
                <strong>{{ $totalProviders ?? 0 }}</strong>
                <small>{{ $onlineProviders ?? 0 }} Responders</small>
            </div>
            <div class="admin-kpi-card">
                <span>Completed Jobs</span>
                <strong>{{ $completedRequests ?? 0 }}</strong>
                <small>Rate 100%</small>
            </div>
            <div class="admin-kpi-card">
                <span>Pending Verifications</span>
                <strong>{{ $pendingVerifications ?? count($verificationQueue ?? []) }}</strong>
                <small>Review Queue</small>
            </div>
        </section>

        <!-- VERIFICATION QUEUE (FULL WIDTH) -->
        <article class="admin-panel">
            <div class="panel-header-flex">
                <h2 class="admin-panel-title">PROVIDER VERIFICATION QUEUE</h2>
                <span class="badge-count">{{ count($verificationQueue ?? []) }} PENDING</span>
            </div>

            <div class="verify-list-grid">
                @forelse($verificationQueue as $vq)
                    <div class="verify-row">
                        <div class="verify-info">
                            <strong>{{ $vq->user?->name ?? 'Provider' }}</strong>
                            <p>{{ $vq->serviceCategory?->name ?? 'General' }} · {{ $vq->area ?? 'Dhaka' }} · {{ $vq->experience_years ?? 0 }} Yrs</p>
                            <small>ID: {{ sprintf('%02d', $vq->id) }}</small>
                        </div>
                        <a href="{{ route('admin.provider.verification.review', sprintf('%02d', $vq->id)) }}" class="admin-light-btn">
                            REVIEW 
                        </a>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align:center; padding:20px; color:#64748b;">
                        <p style="font-size:11px; margin-top:4px;">All provider verification requests are reviewed.</p>
                    </div>
                @endforelse
            </div>
        </article>

        <!-- MANAGE USERS -->
        <section class="admin-panel">
            <div class="panel-header-flex">
                <h2 class="admin-panel-title">MANAGE REGISTERED USERS</h2>
            </div>

            <div style="overflow-x:auto;">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>ROLE</th>
                            <th>EMAIL</th>
                            <th>PHONE</th>
                            <th>AREA</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usersList as $u)
                            <tr>
                                <td><strong>{{ sprintf('%02d', $u->id) }}</strong></td>
                                <td><strong>{{ $u->name }}</strong></td>
                                <td><span class="role-chip role-{{ $u->role }}">{{ strtoupper($u->role) }}</span></td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->phone ?: 'N/A' }}</td>
                                <td>{{ $u->area ?: 'Dhaka' }}</td>
                                <td>
                                    @if($u->is_active)
                                        <span class="status-badge-active">ACTIVE</span>
                                    @else
                                        <span class="status-badge-suspended">SUSPENDED</span>
                                    @endif
                                </td>
                                <td>
                                    @if($u->role !== 'admin')
                                        <form method="POST" action="{{ route('admin.user.toggle', $u->id) }}" style="display:inline; margin:0;">
                                            @csrf
                                            <button type="submit" class="admin-outline-btn {{ $u->is_active ? 'btn-suspend' : 'btn-reinstate' }}">
                                                {{ $u->is_active ? 'SUSPEND' : 'REINSTATE' }}
                                            </button>
                                        </form>
                                    @else
                                        <small style="color:#888;">ADMIN</small>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="text-align:center; color:#888;">No users registered yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <!-- RECENT EMERGENCY REQUESTS & WORK COMPLETION PROOFS -->
        <section class="admin-panel">
            <div class="panel-header-flex">
                <h2 class="admin-panel-title">RECENT EMERGENCY MISSIONS &amp; WORK COMPLETION PROOFS</h2>
            </div>

            <div style="overflow-x:auto;">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>REQUEST</th>
                            <th>CUSTOMER</th>
                            <th>PROVIDER</th>
                            <th>SERVICE / AREA</th>
                            <th>ARRIVAL PIN</th>
                            <th>COMPLETION PIN</th>
                            <th>STATUS</th>
                            <th>DATE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentRequests as $index => $req)
                            <tr>
                                <td><strong>Request {{ $index + 1 }}</strong></td>
                                <td>
                                    <strong>{{ $req->customer?->name ?? ($req->user?->name ?? 'Customer') }}</strong>
                                    <small style="display:block; color:#64748b;">{{ $req->customer?->phone ?? ($req->user?->phone ?? '') }}</small>
                                </td>
                                <td>
                                    @if($req->assignedProvider || $req->provider)
                                        <strong>{{ $req->assignedProvider?->name ?? $req->provider?->name }}</strong>
                                        <small style="display:block; color:#059669;">ID: {{ sprintf('%02d', $req->assignedProvider?->id ?? $req->provider?->id) }}</small>
                                    @else
                                        <span style="color:#94a3b8;">Awaiting Provider</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $req->serviceCategory?->name ?? 'Emergency Service' }}</strong>
                                    <small style="display:block; color:#64748b;">{{ $req->area }}, Dhaka</small>
                                </td>
                                <td>
                                    @if($req->arrival_pin_verified_at)
                                        <span style="font-size:9.5px; font-weight:800; color:#166534; background:#dcfce7; padding:2px 6px; border-radius:3px; display:inline-block;">
                                            Verified (PIN: {{ $req->arrival_pin }})
                                        </span>
                                        <small style="display:block; color:#64748b; font-size:9px;">{{ $req->arrival_pin_verified_at->format('h:i A') }}</small>
                                    @else
                                        <span style="font-size:9.5px; font-weight:700; color:#92400e; background:#fef3c7; padding:2px 6px; border-radius:3px;">
                                           PIN: {{ $req->arrival_pin }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($req->completion_pin_verified_at)
                                        <span style="font-size:9.5px; font-weight:800; color:#166534; background:#dcfce7; padding:2px 6px; border-radius:3px; display:inline-block;">
                                             Work Done (PIN: {{ $req->completion_pin }})
                                        </span>
                                        <small style="display:block; color:#059669; font-weight:800; font-size:9px;">৳ {{ number_format($req->amount ?? 500, 2) }} Cash Paid</small>
                                    @else
                                        <span style="font-size:9.5px; font-weight:700; color:#92400e; background:#fef3c7; padding:2px 6px; border-radius:3px;">
                                             Pending (PIN: {{ $req->completion_pin }})
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span style="font-size:9px; font-weight:800; padding:2px 6px; border-radius:3px; background:{{ $req->status === 'completed' ? '#dcfce7' : '#fee2e2' }}; color:{{ $req->status === 'completed' ? '#166534' : '#991b1b' }};">
                                        {{ strtoupper(str_replace('_', ' ', $req->status)) }}
                                    </span>
                                </td>
                                <td>{{ $req->created_at ? $req->created_at->format('M d, H:i') : 'Recently' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="text-align:center; color:#888; padding:15px;">No emergency requests logged yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

    </div>
</div>

@endsection