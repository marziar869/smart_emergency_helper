@extends('layouts.app')

@section('content')

<div class="admin-dashboard">

    <div class="admin-container">

        {{-- FLASH ALERTS --}}
        @if(session('success'))
            <div style="background: #d1fae5; border: 1px solid #10b981; color: #065f46; padding: 14px 20px; border-radius: 12px; margin-bottom: 24px; font-weight: 700; font-size: 0.95rem;">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background: #fee2e2; border: 1px solid #ef4444; color: #991b1b; padding: 14px 20px; border-radius: 12px; margin-bottom: 24px; font-weight: 700; font-size: 0.95rem;">
                ⚠️ {{ session('error') }}
            </div>
        @endif

        <!-- =====================================================
             HERO & LIVE STATS
        ====================================================== -->
        <section class="admin-hero">
            <div class="admin-hero-copy">
                <div class="admin-eyebrow">
                    ADMINISTRATOR
                </div>
                <h1>
                    GLOBAL OPS CONTROL
                </h1>
                <p>
                    Real-time network oversight & system operations
                </p>
            </div>

            <div class="admin-live-stats">
                <div class="admin-live-stat">
                    <strong>{{ $activeJobsCount ?? 0 }}</strong>
                    <span>ACTIVE JOBS</span>
                </div>

                <div class="admin-live-stat">
                    <strong>{{ $providersOnlineCount ?? 0 }}</strong>
                    <span>PROVIDERS ONLINE</span>
                </div>

                <div class="admin-live-stat">
                    <strong>{{ $completed30DCount ?? 0 }}</strong>
                    <span>COMPLETED (30D)</span>
                </div>

                <div class="admin-live-stat">
                    <strong>{{ $pendingVerifyCount ?? 0 }}</strong>
                    <span>PENDING VERIFY</span>
                </div>
            </div>
        </section>

        <!-- =====================================================
             KPI CARDS
        ====================================================== -->
        <section class="admin-kpi-grid">
            <article class="admin-kpi-card">
                <span>TOTAL CUSTOMERS</span>
                <strong>{{ $totalUsersCount ?? 0 }}</strong>
                <small>REALTIME</small>
            </article>

            <article class="admin-kpi-card">
                <span>TOTAL PROVIDERS</span>
                <strong>{{ $totalProvidersCount ?? 0 }}</strong>
                <small>REALTIME</small>
            </article>

            <article class="admin-kpi-card">
                <span>COMPLETED REQUESTS</span>
                <strong>{{ $completedRequestsCount ?? 0 }}</strong>
                <small>REALTIME</small>
            </article>

            <article class="admin-kpi-card">
                <span>PENDING REQUESTS</span>
                <strong>{{ $pendingRequestsCount ?? 0 }}</strong>
                <small>REALTIME</small>
            </article>
        </section>

        <!-- =====================================================
             PROVIDER VERIFICATION QUEUE
        ====================================================== -->
        <section class="admin-panel" style="margin-bottom: 30px;">
            <h2 class="admin-panel-title">
                🛡️ PROVIDER VERIFICATION QUEUE
            </h2>

            <div class="verify-list">
                @forelse($providerApplications as $app)
                    <div class="verify-row" style="display: flex; justify-content: space-between; align-items: center; padding: 16px; border-bottom: 1px solid #334155; gap: 16px; flex-wrap: wrap;">
                        <div>
                            <strong style="font-size: 16px; color: #f8fafc;">{{ $app->user->name ?? 'Provider' }}</strong>
                            <p style="margin: 4px 0; font-size: 13px; color: #94a3b8;">
                                <strong>Category:</strong> {{ $app->serviceCategory->name ?? 'Category' }} · 
                                <strong>Area:</strong> {{ $app->area }} · 
                                <strong>Experience:</strong> {{ $app->experience_years }} Years · 
                                <strong>Phone:</strong> {{ $app->phone_verified ? 'Verified' : 'Unverified' }}
                            </p>
                            <small style="color: #64748b; font-weight: 700;">REG ID: PRV-{{ 1000 + $app->id }} ({{ $app->user->email ?? 'N/A' }})</small>
                        </div>
                        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                            <a href="{{ route('admin.provider.verification.review', $app->id) }}" class="admin-light-btn" style="padding: 8px 16px; border-radius: 8px; font-weight: 800; font-size: 12px; text-decoration: none;">
                                REVIEW
                            </a>
                            <form method="POST" action="{{ route('admin.provider.approve', $app->id) }}" style="display:inline;">
                                @csrf
                                <button type="submit" style="background: #059669; color: #fff; border: none; padding: 8px 16px; border-radius: 8px; font-weight: 800; font-size: 12px; cursor: pointer;">
                                    APPROVE
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.provider.reject', $app->id) }}" style="display:inline;">
                                @csrf
                                <button type="submit" style="background: #dc2626; color: #fff; border: none; padding: 8px 16px; border-radius: 8px; font-weight: 800; font-size: 12px; cursor: pointer;">
                                    REJECT
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p style="padding: 20px; color: #94a3b8; font-size: 13px; margin: 0; text-align: center;">No pending provider applications requiring verification.</p>
                @endforelse
            </div>
        </section>

        <!-- =====================================================
             MANAGE USERS & SERVICE CATEGORIES
        ====================================================== -->
        <section class="admin-two-column">

            <!-- MANAGE USERS -->
            <article class="admin-panel">
                <h2 class="admin-panel-title">
                    👥 MANAGE USER ACCOUNTS
                </h2>

                <div style="max-height: 400px; overflow-y: auto;">
                    @forelse($users as $usr)
                        <div class="manage-user-row" style="display: grid; grid-template-columns: 1fr 100px 100px; align-items: center; gap: 12px; padding: 12px 4px; border-bottom: 1px solid #334155;">
                            <div class="manage-user-info" style="min-width: 0;">
                                <strong style="color: #f8fafc; font-size: 14px; display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $usr->name }}</strong>
                                <span style="display: block; font-size: 12px; color: #94a3b8; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $usr->email }} · <strong style="color: #38bdf8; text-transform: uppercase;">{{ $usr->role }}</strong>
                                </span>
                            </div>

                            <div style="text-align: center;">
                                <span class="{{ $usr->is_active ? 'user-active' : 'user-suspended' }}" style="display: inline-block; font-size: 11px; font-weight: 800; padding: 4px 10px; border-radius: 6px; {{ $usr->is_active ? 'background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3);' : 'background: rgba(239, 68, 68, 0.15); color: #fca5a5; border: 1px solid rgba(239, 68, 68, 0.3);' }}">
                                    {{ $usr->is_active ? 'ACTIVE' : 'SUSPENDED' }}
                                </span>
                            </div>

                            <div style="text-align: right;">
                                @if($usr->id !== auth()->id())
                                    <form method="POST" action="{{ route('admin.user.toggle_status', $usr->id) }}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="admin-outline-btn user-action-btn" style="padding: 6px 14px; font-size: 11px; font-weight: 800; border-radius: 6px; cursor: pointer;">
                                            {{ $usr->is_active ? 'SUSPEND' : 'REINSTATE' }}
                                        </button>
                                    </form>
                                @else
                                    <span style="font-size: 11px; color: #64748b; font-weight: 700; padding-right: 8px;">YOU</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p style="color: #94a3b8; font-size: 13px;">No registered users found.</p>
                    @endforelse
                </div>

                <p class="manage-note" style="margin-top: 14px; font-size: 11px; color: #64748b;">
                    Suspended users/providers cannot log in or perform actions on the platform.
                </p>
            </article>

            <!-- SERVICE CATEGORIES MANAGEMENT -->
            <article class="admin-panel">
                <h2 class="admin-panel-title">
                    ⚙️ SERVICE CATEGORIES MANAGEMENT
                </h2>

                <div class="service-category-grid" style="max-height: 320px; overflow-y: auto;">
                    @foreach($serviceCategories as $cat)
                        <div class="service-category-card {{ $cat->is_active ? '' : 'disabled-category' }}" style="display: flex; justify-content: space-between; align-items: center; padding: 12px; border-radius: 10px; background: #1e293b; margin-bottom: 10px; border: 1px solid #334155;">
                            <div>
                                <strong style="display: block; color: #f8fafc; font-size: 13px; text-transform: uppercase;">{{ $cat->name }}</strong>
                                <span style="font-size: 11px; color: #94a3b8;">Group: {{ $cat->group_name }} · {{ $cat->is_active ? 'Enabled' : 'Disabled' }}</span>
                            </div>
                            <form method="POST" action="{{ route('admin.category.toggle', $cat->id) }}" style="display:inline;">
                                @csrf
                                <button type="submit" style="background: {{ $cat->is_active ? '#475569' : '#059669' }}; color: #ffffff; border: none; padding: 6px 12px; border-radius: 6px; font-size: 11px; font-weight: 800; cursor: pointer;">
                                    {{ $cat->is_active ? 'DISABLE' : 'ENABLE' }}
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <!-- ADD NEW CATEGORY FORM -->
                <form method="POST" action="{{ route('admin.category.store') }}" class="category-add-row" style="margin-top: 16px; display: flex; gap: 8px;">
                    @csrf
                    <input type="text" name="name" placeholder="New category name" required style="flex: 1; padding: 8px 12px; border-radius: 8px; border: 1px solid #334155; background: #0f172a; color: #fff; font-size: 12px;">
                    <select name="group_name" required style="padding: 8px 12px; border-radius: 8px; border: 1px solid #334155; background: #0f172a; color: #fff; font-size: 12px;">
                        <option value="Emergency">Emergency</option>
                        <option value="Technical">Technical</option>
                        <option value="Home">Home</option>
                    </select>
                    <button type="submit" class="admin-light-btn" style="padding: 8px 16px; border-radius: 8px; font-weight: 800; font-size: 12px; cursor: pointer;">
                        ADD CATEGORY
                    </button>
                </form>
            </article>

        </section>

        <!-- =====================================================
             RECENT EMERGENCY REQUESTS LOG
        ====================================================== -->
        <section class="admin-panel recent-requests-panel" style="margin-top: 30px;">
            <div class="recent-heading">
                <h2 class="admin-panel-title">
                    📋 REAL-TIME EMERGENCY REQUEST LOG
                </h2>
                <span style="font-size: 12px; color: #94a3b8; font-weight: 700;">
                    LIVE SYSTEM FEED
                </span>
            </div>

            <div class="recent-table-wrap">
                <table class="recent-table" style="width: 100%; border-collapse: collapse; font-size: 13px;">
                    <thead>
                        <tr style="border-bottom: 2px solid #334155; text-align: left; color: #94a3b8; font-size: 11px; font-weight: 800; text-transform: uppercase;">
                            <th style="padding: 12px;">REF / ID</th>
                            <th style="padding: 12px;">CUSTOMER</th>
                            <th style="padding: 12px;">PROVIDER</th>
                            <th style="padding: 12px;">SERVICE</th>
                            <th style="padding: 12px;">AREA</th>
                            <th style="padding: 12px;">PRIORITY</th>
                            <th style="padding: 12px;">DATE</th>
                            <th style="padding: 12px;">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentRequests as $req)
                            <tr style="border-bottom: 1px solid #1e293b; color: #e2e8f0;">
                                <td style="padding: 12px; font-weight: 800; color: #38bdf8;">#{{ $req->reference ?? ('REQ-'.$req->id) }}</td>
                                <td style="padding: 12px; font-weight: 700;">
                                    {{ $req->customer->name ?? 'Guest' }}
                                    <small style="display: block; color: #64748b;">{{ $req->customer->phone ?? '' }}</small>
                                </td>
                                <td style="padding: 12px;">
                                    @if($req->assignedProvider)
                                        <strong style="color: #10b981;">{{ $req->assignedProvider->name }}</strong>
                                    @else
                                        <span style="color: #f59e0b;">Waiting...</span>
                                    @endif
                                </td>
                                <td style="padding: 12px; font-weight: 700;">{{ $req->serviceCategory->name ?? 'Emergency' }}</td>
                                <td style="padding: 12px;">{{ $req->area }}</td>
                                <td style="padding: 12px;">
                                    <span style="font-size: 10px; font-weight: 900; padding: 3px 8px; border-radius: 4px; color: #fff; background: {{ strtolower($req->priority) === 'critical' ? '#ef4444' : (strtolower($req->priority) === 'high' ? '#f59e0b' : '#3b82f6') }};">
                                        {{ strtoupper($req->priority) }}
                                    </span>
                                </td>
                                <td style="padding: 12px; color: #94a3b8;">{{ $req->created_at->format('d M, h:i A') }}</td>
                                <td style="padding: 12px;">
                                    <span style="font-size: 11px; font-weight: 800; text-transform: uppercase; padding: 4px 10px; border-radius: 20px; background: {{ $req->status === 'completed' ? '#065f46; color: #6ee7b7;' : ($req->status === 'accepted' || $req->status === 'working' ? '#1e40af; color: #93c5fd;' : '#78350f; color: #fde68a;') }}">
                                        {{ str_replace('_', ' ', $req->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="padding: 20px; text-align: center; color: #94a3b8;">No emergency requests logged yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

    </div>

</div>

@endsection