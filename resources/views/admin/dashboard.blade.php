@extends('layouts.app')

@section('content')

<div class="admin-dashboard">

    <div class="admin-container">


        <!-- =====================================================
             HERO
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
                    Real-time network oversight
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
                <span>TOTAL USERS</span>
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
             ROW 1
             TOP SERVICE CATEGORIES + PRIORITY MIX
        ====================================================== -->

        <section class="admin-two-column">


            <!-- TOP SERVICE CATEGORIES -->

            <article class="admin-panel">

                <h2 class="admin-panel-title">
                    TOP SERVICE CATEGORIES
                </h2>


                <div class="admin-service-chart">


                    <div class="service-row">

                        <span>Ambulance</span>

                        <div
                            class="service-track service-tooltip"
                            data-label="Ambulance"
                            data-value="412"
                        >
                            <div class="service-fill" style="width:92%"></div>
                        </div>

                    </div>


                    <div class="service-row">

                        <span>Electrician</span>

                        <div
                            class="service-track service-tooltip"
                            data-label="Electrician"
                            data-value="338"
                        >
                            <div class="service-fill" style="width:76%"></div>
                        </div>

                    </div>


                    <div class="service-row">

                        <span>Plumber</span>

                        <div
                            class="service-track service-tooltip"
                            data-label="Plumber"
                            data-value="302"
                        >
                            <div class="service-fill" style="width:68%"></div>
                        </div>

                    </div>


                    <div class="service-row">

                        <span>AC Technician</span>

                        <div
                            class="service-track service-tooltip"
                            data-label="AC Technician"
                            data-value="251"
                        >
                            <div class="service-fill" style="width:56%"></div>
                        </div>

                    </div>


                    <div class="service-row">

                        <span>Blood Donor</span>

                        <div
                            class="service-track service-tooltip"
                            data-label="Blood Donor"
                            data-value="191"
                        >
                            <div class="service-fill" style="width:43%"></div>
                        </div>

                    </div>


                    <div class="service-row">

                        <span>Locksmith</span>

                        <div
                            class="service-track service-tooltip"
                            data-label="Locksmith"
                            data-value="148"
                        >
                            <div class="service-fill" style="width:33%"></div>
                        </div>

                    </div>


                    <div class="service-row">

                        <span>Home Nurse</span>

                        <div
                            class="service-track service-tooltip"
                            data-label="Home Nurse"
                            data-value="110"
                        >
                            <div class="service-fill" style="width:24%"></div>
                        </div>

                    </div>



                    <div class="chart-axis">

                        <span>0</span>
                        <span>50</span>
                        <span>100</span>
                        <span>150</span>
                        <span>200</span>
                        <span>250</span>
                        <span>300</span>
                        <span>350</span>
                        <span>400</span>
                        <span>450</span>

                    </div>


                </div>

            </article>



            <!-- PRIORITY MIX -->

            <article class="admin-panel">

                <h2 class="admin-panel-title">
                    PRIORITY MIX
                </h2>


                <div
                    class="priority-donut"
                    data-critical="48"
                    data-high="72"
                    data-medium="126"
                    data-normal="155"
                ></div>


                <div class="priority-legend">

                    <span>
                        <i class="legend-critical"></i>
                        Critical
                    </span>

                    <span>
                        <i class="legend-high"></i>
                        High
                    </span>

                    <span>
                        <i class="legend-medium"></i>
                        Medium
                    </span>

                    <span>
                        <i class="legend-normal"></i>
                        Normal
                    </span>

                </div>

            </article>

        </section>



        <!-- =====================================================
             ROW 2
             REQUEST VOLUME + DHAKA AREA
        ====================================================== -->

        <section class="admin-two-column">


            <!-- REQUEST VOLUME -->

            <article class="admin-panel">

                <h2 class="admin-panel-title">
                    REQUEST VOLUME — LAST 14 DAYS
                </h2>


                <div class="request-chart">

                    <svg
                        viewBox="0 0 600 230"
                        preserveAspectRatio="none"
                        class="request-svg"
                    >

                        <defs>

                            <linearGradient
                                id="requestFill"
                                x1="0"
                                y1="0"
                                x2="0"
                                y2="1"
                            >

                                <stop
                                    offset="0%"
                                    stop-color="#2d86ec"
                                    stop-opacity=".30"
                                />

                                <stop
                                    offset="100%"
                                    stop-color="#2d86ec"
                                    stop-opacity=".04"
                                />

                            </linearGradient>

                        </defs>


                        <path
                            d="
                                M 0 200
                                L 45 175
                                L 90 190
                                L 135 135
                                L 180 100
                                L 225 150
                                L 270 125
                                L 315 85
                                L 360 60
                                L 405 110
                                L 450 55
                                L 495 25
                                L 540 45
                                L 600 5
                                L 600 230
                                L 0 230
                                Z
                            "
                            fill="url(#requestFill)"
                        />


                        <path
                            d="
                                M 0 200
                                L 45 175
                                L 90 190
                                L 135 135
                                L 180 100
                                L 225 150
                                L 270 125
                                L 315 85
                                L 360 60
                                L 405 110
                                L 450 55
                                L 495 25
                                L 540 45
                                L 600 5
                            "
                            fill="none"
                            stroke="#2d86ec"
                            stroke-width="3"
                        />

                    </svg>



                    <div class="request-days">

                        <span>D1</span>
                        <span>D2</span>
                        <span>D3</span>
                        <span>D4</span>
                        <span>D5</span>
                        <span>D6</span>
                        <span>D7</span>
                        <span>D8</span>
                        <span>D9</span>
                        <span>D10</span>
                        <span>D11</span>
                        <span>D12</span>
                        <span>D13</span>
                        <span>D14</span>

                    </div>

                </div>

            </article>



            <!-- REQUESTS BY DHAKA AREA -->

            <article class="admin-panel">

                <h2 class="admin-panel-title">
                    REQUESTS BY DHAKA AREA
                </h2>


                <div class="area-stats">


                    <div class="area-row">

                        <div class="area-meta">
                            <strong>Dhanmondi</strong>
                            <span>42</span>
                        </div>

                        <div class="area-track">
                            <div style="width:100%"></div>
                        </div>

                    </div>



                    <div class="area-row">

                        <div class="area-meta">
                            <strong>Mirpur</strong>
                            <span>37</span>
                        </div>

                        <div class="area-track">
                            <div style="width:88%"></div>
                        </div>

                    </div>



                    <div class="area-row">

                        <div class="area-meta">
                            <strong>Uttara</strong>
                            <span>31</span>
                        </div>

                        <div class="area-track">
                            <div style="width:74%"></div>
                        </div>

                    </div>



                    <div class="area-row">

                        <div class="area-meta">
                            <strong>Gulshan</strong>
                            <span>28</span>
                        </div>

                        <div class="area-track">
                            <div style="width:67%"></div>
                        </div>

                    </div>



                    <div class="area-row">

                        <div class="area-meta">
                            <strong>Mohammadpur</strong>
                            <span>25</span>
                        </div>

                        <div class="area-track">
                            <div style="width:60%"></div>
                        </div>

                    </div>



                    <div class="area-row">

                        <div class="area-meta">
                            <strong>Banani</strong>
                            <span>19</span>
                        </div>

                        <div class="area-track">
                            <div style="width:46%"></div>
                        </div>

                    </div>


                </div>

            </article>

        </section>



        <!-- =====================================================
             ROW 3
             VERIFICATION QUEUE + COMPLAINTS
        ====================================================== -->

        <section class="admin-two-column">


            <!-- VERIFICATION QUEUE -->

            <article class="admin-panel">

                <h2 class="admin-panel-title">
                    VERIFICATION QUEUE
                </h2>


                <div class="verify-list">
                    @forelse($providerApplications as $app)
                        <div class="verify-row">
                            <div>
                                <strong>{{ $app->user->name ?? 'Provider' }}</strong>
                                <p>
                                    {{ $app->serviceCategory->name ?? 'Category' }} · {{ $app->area }} · {{ $app->experience_years }} Years · {{ $app->phone_verified ? 'Phone Verified' : 'Unverified' }} · Pending Admin Review
                                </p>
                                <small>PRV-{{ 1000 + $app->id }}</small>
                            </div>
                            <a href="{{ route('admin.provider.verification.review', $app->id) }}" class="admin-light-btn">
                                REVIEW
                            </a>
                        </div>
                    @empty
                        <p style="padding: 15px; color: #888;">No pending provider verification applications at this time.</p>
                    @endforelse
                </div>

            </article>



            <!-- COMPLAINTS -->

<article class="admin-panel complaint-panel">

    <h2 class="admin-panel-title">
        COMPLAINTS
    </h2>


    <div class="complaint-list">


        <!-- CP-114 -->

        <div
            class="complaint-item"
            data-complaint-id="CP-114"
            data-status="OPEN"
        >

            <span class="complaint-state state-open">
                OPEN
            </span>

            <strong>
                #CP-114
            </strong>

            <h4>
                Sadia Rahman vs
                <b>VoltFix Electricals</b>
            </h4>

            <p>
                Arrived 40m late
            </p>

            <small>
                Service TK-9018 · ৳1,200
            </small>


            <div class="complaint-actions">

                <button
                    type="button"
                    class="complaint-review-btn"
                >
                    REVIEW
                </button>

                <button
                    type="button"
                    class="complaint-resolve-btn"
                >
                    RESOLVE
                </button>

                <button
                    type="button"
                    class="complaint-escalate-btn"
                >
                    ESCALATE
                </button>

                <button
                    type="button"
                    class="danger-btn complaint-suspend-btn"
                >
                    SUSPEND PROVIDER
                </button>

            </div>

        </div>



        <!-- CP-113 -->

        <div
            class="complaint-item"
            data-complaint-id="CP-113"
            data-status="REVIEWING"
        >

            <span class="complaint-state state-review">
                REVIEWING
            </span>

            <strong>
                #CP-113
            </strong>

            <h4>
                Tanvir Ahmed vs
                <b>Dhaka Emergency Ambulance</b>
            </h4>

            <p>
                Billing dispute
            </p>

            <small>
                Service ER-2409 · ৳3,500
            </small>


            <div class="complaint-actions">

                <button
                    type="button"
                    class="complaint-review-btn"
                >
                    REVIEW
                </button>

                <button
                    type="button"
                    class="complaint-resolve-btn"
                >
                    RESOLVE
                </button>

                <button
                    type="button"
                    class="complaint-escalate-btn"
                >
                    ESCALATE
                </button>

                <button
                    type="button"
                    class="danger-btn complaint-suspend-btn"
                >
                    SUSPEND PROVIDER
                </button>

            </div>

        </div>



        <!-- CP-112 -->

        <div
            class="complaint-item"
            data-complaint-id="CP-112"
            data-status="ESCALATED"
        >

            <span class="complaint-state state-escalated">
                ESCALATED
            </span>

            <strong>
                #CP-112
            </strong>

            <h4>
                Mehedi Hasan vs
                <b>CoolAir Service Point</b>
            </h4>

            <p>
                Incomplete repair, technician left early
            </p>

            <small>
                Service TK-8991 · ৳2,800
            </small>


            <div class="complaint-actions">

                <button
                    type="button"
                    class="complaint-review-btn"
                >
                    REVIEW
                </button>

                <button
                    type="button"
                    class="complaint-resolve-btn"
                >
                    RESOLVE
                </button>

                <button
                    type="button"
                    class="complaint-escalate-btn"
                >
                    ESCALATE
                </button>

                <button
                    type="button"
                    class="danger-btn complaint-suspend-btn"
                >
                    SUSPEND PROVIDER
                </button>

            </div>

        </div>



        <!-- CP-111 -->

        <div
            class="complaint-item"
            data-complaint-id="CP-111"
            data-status="RESOLVED"
        >

            <span class="complaint-state state-resolved">
                RESOLVED
            </span>

            <strong>
                #CP-111
            </strong>

            <h4>
                Nusrat Jahan vs
                <b>AquaLine Plumbing</b>
            </h4>

            <p>
                Resolved after refund
            </p>

            <small>
                Service TK-8877 · ৳900
            </small>


            <div class="complaint-actions">

                <button
                    type="button"
                    class="complaint-review-btn"
                >
                    REVIEW
                </button>

                <button
                    type="button"
                    class="complaint-resolve-btn"
                >
                    RESOLVE
                </button>

                <button
                    type="button"
                    class="complaint-escalate-btn"
                >
                    ESCALATE
                </button>

                <button
                    type="button"
                    class="danger-btn complaint-suspend-btn"
                >
                    SUSPEND PROVIDER
                </button>

            </div>

        </div>


    </div>

</article>

        </section>



        <!-- =====================================================
             ROW 4
             MANAGE USERS + SERVICE CATEGORIES
        ====================================================== -->

        <section class="admin-two-column">


            <!-- MANAGE USERS -->

            <article class="admin-panel">

                <h2 class="admin-panel-title">
                    MANAGE USERS
                </h2>



                <div class="manage-user-row">

                    <div class="manage-user-info">

                        <strong>
                            Md. Arif Hossain
                        </strong>

                        <span>
                            arif.hossain@seh.com.bd · Customer
                        </span>

                    </div>


                    <span class="user-active">
                        ACTIVE
                    </span>


                    <button
                        class="admin-outline-btn user-action-btn"
                        data-action="suspend"
                        data-user="Md. Arif Hossain"
                    >
                        SUSPEND
                    </button>

                </div>



                <div class="manage-user-row">

                    <div class="manage-user-info">

                        <strong>
                            Saiful Islam
                        </strong>

                        <span>
                            saiful.islam@seh.com.bd · Provider
                        </span>

                    </div>


                    <span class="user-active">
                        ACTIVE
                    </span>


                    <button
                        class="admin-outline-btn user-action-btn"
                        data-action="suspend"
                        data-user="Saiful Islam"
                    >
                        SUSPEND
                    </button>

                </div>



                <div class="manage-user-row">

                    <div class="manage-user-info">

                        <strong>
                            Nusrat Jahan
                        </strong>

                        <span>
                            nusrat.jahan@seh.com.bd · Provider
                        </span>

                    </div>


                    <span class="user-pending">
                        PENDING
                    </span>


                    <button
                        class="admin-outline-btn user-action-btn"
                        data-action="suspend"
                        data-user="Nusrat Jahan"
                    >
                        SUSPEND
                    </button>

                </div>



                <div class="manage-user-row">

                    <div class="manage-user-info">

                        <strong>
                            Farzana Akter
                        </strong>

                        <span>
                            farzana.akter@seh.com.bd · Customer
                        </span>

                    </div>


                    <span class="user-suspended">
                        SUSPENDED
                    </span>


                    <button
                        class="admin-outline-btn user-action-btn"
                        data-action="reinstate"
                        data-user="Farzana Akter"
                    >
                        REINSTATE
                    </button>

                </div>



                <p class="manage-note">

                    Suspended providers are not eligible for dispatch
                    and will not receive new service requests.

                </p>

            </article>



            <!-- SERVICE CATEGORIES -->

            <article class="admin-panel">

                <h2 class="admin-panel-title">
                    SERVICE CATEGORIES
                </h2>


                <div class="service-category-grid">


                    <div
                        class="service-category-card category-toggle"
                        data-enabled="true"
                    >
                        <strong>AMBULANCE</strong>
                        <span>Emergency · Enabled</span>
                    </div>


                    <div
                        class="service-category-card category-toggle"
                        data-enabled="true"
                    >
                        <strong>BLOOD DONOR</strong>
                        <span>Emergency · Enabled</span>
                    </div>


                    <div
                        class="service-category-card category-toggle"
                        data-enabled="true"
                    >
                        <strong>HOME NURSE</strong>
                        <span>Emergency · Enabled</span>
                    </div>


                    <div
                        class="service-category-card category-toggle"
                        data-enabled="true"
                    >
                        <strong>ELECTRICIAN</strong>
                        <span>Technical · Enabled</span>
                    </div>


                    <div
                        class="service-category-card category-toggle"
                        data-enabled="true"
                    >
                        <strong>PLUMBER</strong>
                        <span>Technical · Enabled</span>
                    </div>


                    <div
                        class="service-category-card category-toggle"
                        data-enabled="true"
                    >
                        <strong>AC TECHNICIAN</strong>
                        <span>Technical · Enabled</span>
                    </div>


                    <div
                        class="service-category-card category-toggle disabled-category"
                        data-enabled="false"
                    >
                        <strong>LOCKSMITH</strong>
                        <span>Technical · Disabled</span>
                    </div>


                    <div
                        class="service-category-card category-toggle"
                        data-enabled="true"
                    >
                        <strong>CLEANER</strong>
                        <span>Home · Enabled</span>
                    </div>


                    <div
                        class="service-category-card category-toggle"
                        data-enabled="true"
                    >
                        <strong>CARPENTER</strong>
                        <span>Home · Enabled</span>
                    </div>


                </div>



                <div class="category-add-row">

                    <input
                        type="text"
                        placeholder="New category"
                    >

                    <select>

                        <option>
                            Emergency
                        </option>

                        <option>
                            Technical
                        </option>

                        <option>
                            Home
                        </option>

                    </select>


                    <button class="admin-light-btn">
                        ADD
                    </button>

                </div>

            </article>

        </section>



        <!-- =====================================================
             RECENT REQUESTS FULL WIDTH
        ====================================================== -->

        <section class="admin-panel recent-requests-panel">


            <div class="recent-heading">

                <h2 class="admin-panel-title">
                    RECENT REQUESTS
                </h2>

                <span>
                    PER-ROW PDF EXPORT
                </span>

            </div>



            <div class="recent-table-wrap">


                <table class="recent-table">


                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>CUSTOMER</th>
                            <th>PROVIDER</th>
                            <th>SERVICE</th>
                            <th>PRIORITY</th>
                            <th>STATUS</th>
                            <th>REPORT</th>

                        </tr>

                    </thead>


                    <tbody>


                        <tr>

                            <td>ER-2451</td>

                            <td>
                                Md. Arif Hossain
                            </td>

                            <td>
                                Rapid Care Ambulance
                            </td>

                            <td>
                                Ambulance
                            </td>

                            <td>
                                <span class="priority-badge critical-badge">
                                    CRITICAL
                                </span>
                            </td>

                            <td>
                                On the Way
                            </td>

                            <td>
                                PDF
                            </td>

                        </tr>



                        <tr>

                            <td>
                                TK-9024
                            </td>

                            <td>
                                Mehedi Hasan
                            </td>

                            <td>
                                CoolAir Service Point
                            </td>

                            <td>
                                AC Technician
                            </td>

                            <td>
                                <span class="priority-badge high-badge">
                                    HIGH
                                </span>
                            </td>

                            <td>
                                Working
                            </td>

                            <td>
                                PDF
                            </td>

                        </tr>



                        <tr>

                            <td>
                                ER-2460
                            </td>

                            <td>
                                Sadia Rahman
                            </td>

                            <td>
                                —
                            </td>

                            <td>
                                Ambulance
                            </td>

                            <td>
                                <span class="priority-badge critical-badge">
                                    CRITICAL
                                </span>
                            </td>

                            <td>
                                Pending
                            </td>

                            <td>
                                PDF
                            </td>

                        </tr>



                        <tr>

                            <td>
                                TK-9018
                            </td>

                            <td>
                                Farzana Akter
                            </td>

                            <td>
                                VoltFix Electricals
                            </td>

                            <td>
                                Electrician
                            </td>

                            <td>
                                <span class="priority-badge medium-badge">
                                    MEDIUM
                                </span>
                            </td>

                            <td>
                                Completed
                            </td>

                            <td>
                                PDF
                            </td>

                        </tr>


                    </tbody>

                </table>

            </div>

        </section>


    </div>

</div>

@endsection