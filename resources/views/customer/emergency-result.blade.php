@extends('layouts.app')

@section('content')

<style>
    .dispatch-result-page {
        background: #f5f1e8;
        padding: 64px 0 80px;
        min-height: 700px;
    }

    .dispatch-result-container {
        width: min(1240px, calc(100% - 48px));
        margin: 0 auto;
    }

    .dispatch-result-eyebrow {
        margin-bottom: 15px;
        font-family: monospace;
        font-size: 10px;
        letter-spacing: 2px;
        color: #666;
    }

    .dispatch-result-title {
        margin: 0;
        font-size: 48px;
        line-height: 1;
        font-weight: 900;
        letter-spacing: -2px;
        color: #171717;
    }

    .dispatch-result-subtitle {
        max-width: 720px;
        margin-top: 18px;
        font-size: 18px;
        line-height: 1.55;
        color: #666;
    }

    .dispatch-result-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 320px;
        gap: 24px;
        margin-top: 42px;
        align-items: start;
    }

    .result-main-card {
        background: #fff;
        border: 1px solid #d9d9d9;
        padding: 32px;
    }

    .result-created-label {
        font-family: monospace;
        font-size: 10px;
        letter-spacing: 1.8px;
        color: #777;
        margin-bottom: 12px;
    }

    .result-reference {
        margin: 0 0 12px;
        font-size: 30px;
        font-weight: 900;
        letter-spacing: -1px;
    }

    .result-description {
        max-width: 780px;
        margin: 0;
        color: #555;
        font-size: 14px;
        line-height: 1.45;
    }

    .dispatch-box {
        margin-top: 32px;
        padding: 24px;
        border: 1px solid #ddd;
    }

    .dispatch-box-label {
        margin-bottom: 12px;
        font-family: monospace;
        font-size: 10px;
        letter-spacing: 1.8px;
        color: #777;
    }

    .dispatch-box h2 {
        margin: 0 0 22px;
        font-size: 21px;
        font-weight: 900;
    }

    .dispatch-progress {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 24px;
    }

    .dispatch-progress-item {
        padding: 11px 14px;
        background: #171717;
        color: #fff;
        font-family: monospace;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .4px;
    }

    .dispatch-arrow {
        font-size: 13px;
        color: #555;
    }

    .assigned-provider {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 20px 16px;
        margin-bottom: 26px;
        background: #f5f1e8;
        border: 1px solid #d8d3c8;
    }

    .assigned-provider-label {
        margin-bottom: 5px;
        font-family: monospace;
        font-size: 10px;
        letter-spacing: 1.5px;
        color: #777;
    }

    .assigned-provider-name {
        font-size: 18px;
        font-weight: 900;
    }

    .assigned-badge {
        flex-shrink: 0;
        padding: 9px 14px;
        background: #249c50;
        color: #fff;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: .5px;
    }

    .attempts-heading {
        margin-bottom: 13px;
        font-family: monospace;
        font-size: 10px;
        letter-spacing: 1.8px;
        color: #777;
    }

    .attempt-row {
        display: flex;
        align-items: center;
        gap: 10px;
        min-height: 51px;
        margin-bottom: 8px;
        padding: 10px 16px;
        border: 1px solid #d8d3c8;
        background: #f5f1e8;
    }

    .attempt-number {
        font-family: monospace;
        font-size: 10px;
        color: #777;
    }

    .attempt-provider {
        flex: 1;
        font-size: 14px;
        font-weight: 900;
    }

    .attempt-status {
        padding: 7px 11px;
        color: #fff;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: .5px;
    }

    .status-declined {
        background: #ed1c24;
    }

    .status-expired {
        background: #f0831e;
        color: #111;
    }

    .status-accepted {
        background: #249c50;
    }

    .attempt-message {
        font-family: monospace;
        font-size: 9px;
        letter-spacing: 1.2px;
        color: #777;
    }

    .result-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 24px;
    }

    .result-btn-outline,
    .result-btn-dark {
        min-height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 20px;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: .6px;
        text-decoration: none;
    }

    .result-btn-outline {
        border: 1px solid #171717;
        color: #171717;
        background: #fff;
    }

    .result-btn-dark {
        border: 1px solid #171717;
        color: #fff;
        background: #171717;
    }

    /* RIGHT SIDEBAR */

    .result-sidebar-card {
        margin-bottom: 24px;
        padding: 25px;
        background: #fff;
        border: 1px solid #dadada;
    }

    .result-sidebar-title {
        margin-bottom: 21px;
        font-family: monospace;
        font-size: 10px;
        letter-spacing: 1.8px;
        color: #777;
    }

    .result-dispatch-row {
        display: grid;
        grid-template-columns: 24px 1fr;
        margin-bottom: 17px;
    }

    .result-dispatch-row:last-child {
        margin-bottom: 0;
    }

    .result-dispatch-number {
        font-family: monospace;
        font-size: 10px;
        color: #888;
    }

    .result-dispatch-text {
        font-size: 14px;
        font-weight: 800;
        line-height: 1.25;
    }

    .result-selection-row {
        min-height: 47px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        border-bottom: 1px solid #ddd;
    }

    .result-selection-row:last-child {
        border-bottom: 0;
    }

    .result-selection-label {
        font-family: monospace;
        font-size: 10px;
        letter-spacing: 1px;
        color: #777;
    }

    .result-selection-value {
        font-size: 14px;
        font-weight: 900;
        text-align: right;
    }

    .result-priority-badge {
        padding: 7px 10px;
        color: #fff;
        background: #3289e8;
        font-size: 10px;
    }

    .result-priority-badge.priority-critical {
        background: #ed1c24;
    }

    .result-priority-badge.priority-high {
        background: #f0831e;
        color: #111;
    }

    .result-priority-badge.priority-medium {
        background: #d2a900;
        color: #111;
    }

    .result-safety-item {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 12px;
        font-size: 14px;
        font-weight: 800;
    }

    .result-safety-item:last-child {
        margin-bottom: 0;
    }

    .result-safety-dot {
        width: 6px;
        height: 6px;
        background: #ed1c24;
    }

    .result-demo-card {
        border-left: 1px solid #1684ff;
    }

    .result-demo-card strong {
        display: block;
        margin-bottom: 7px;
        font-size: 12px;
    }

    .result-demo-card p {
        margin: 0;
        color: #777;
        font-size: 14px;
        line-height: 1.5;
    }

    @media (max-width: 950px) {
        .dispatch-result-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .dispatch-result-page {
            padding: 40px 0 60px;
        }

        .dispatch-result-container {
            width: calc(100% - 30px);
        }

        .dispatch-result-title {
            font-size: 34px;
            letter-spacing: -1px;
        }

        .result-main-card {
            padding: 20px;
        }

        .assigned-provider,
        .attempt-row {
            align-items: flex-start;
            flex-direction: column;
        }

        .attempt-provider {
            width: 100%;
        }
    }
</style>


<section class="dispatch-result-page">

    <div class="dispatch-result-container">

        <div class="dispatch-result-eyebrow">
            CUSTOMER CONSOLE · EMERGENCY DISPATCH
        </div>

        <h1 class="dispatch-result-title">
            REQUEST EMERGENCY ASSISTANCE
        </h1>

        <p class="dispatch-result-subtitle">
            Tell us what happened. The system will identify the most suitable
            verified and available provider.
        </p>


        <div class="dispatch-result-grid">

            {{-- LEFT SIDE --}}
            <main class="result-main-card">

                <div class="result-created-label">
                    REQUEST CREATED · DEMONSTRATION ONLY
                </div>

                <h2 class="result-reference">
                    {{ $emergency['reference'] }}
                </h2>

                <p class="result-description">

                    {{ $emergency['priority'] }} priority ·
                    {{ $emergency['service'] }}
                    ({{ $emergency['group'] }}) ·
                    {{ $emergency['area'] }},
                    {{ $emergency['address'] }}.

                    The dispatch engine is ranking eligible verified
                    providers near your location.

                    <br>

                    No backend is connected — this is a frontend demonstration state.

                </p>


                <section class="dispatch-box">

                    <div class="dispatch-box-label">
                        EMERGENCY BROADCAST · DISPATCH ATTEMPTS
                    </div>

                    <h2>
                        PROVIDER ASSIGNED
                    </h2>


                    <div class="dispatch-progress">

                        <span class="dispatch-progress-item">
                            REQUEST CREATED
                        </span>

                        <span class="dispatch-arrow">
                            →
                        </span>

                        <span class="dispatch-progress-item">
                            ELIGIBLE PROVIDERS FILTERED
                        </span>

                        <span class="dispatch-arrow">
                            →
                        </span>

                        <span class="dispatch-progress-item">
                            SCORES CALCULATED
                        </span>

                        <span class="dispatch-arrow">
                            →
                        </span>

                        <span class="dispatch-progress-item">
                            BEST PROVIDER OFFERED REQUEST
                        </span>

                    </div>


                    <div class="assigned-provider">

                        <div>

                            <div class="assigned-provider-label">
                                ASSIGNED PROVIDER
                            </div>

                            <div class="assigned-provider-name">
                                {{ $emergency['assigned_provider'] }}
                            </div>

                        </div>

                        <span class="assigned-badge">
                            PROVIDER ASSIGNED
                        </span>

                    </div>


                    <div class="attempts-heading">
                        DISPATCH ATTEMPTS HISTORY
                    </div>


                    @foreach($emergency['attempts'] as $index => $attempt)

                        <div class="attempt-row">

                            <span class="attempt-number">
                                0{{ $index + 1 }}
                            </span>

                            <span class="attempt-provider">
                                {{ $attempt['provider'] }}
                            </span>


                            @if($attempt['status'] === 'DECLINED')

                                <span class="attempt-status status-declined">
                                    DECLINED
                                </span>

                                <span class="attempt-message">
                                    OFFER SENT TO NEXT PROVIDER
                                </span>


                            @elseif($attempt['status'] === 'EXPIRED')

                                <span class="attempt-status status-expired">
                                    EXPIRED (TIMEOUT)
                                </span>

                                <span class="attempt-message">
                                    OFFER SENT TO NEXT PROVIDER
                                </span>


                            @else

                                <span class="attempt-status status-accepted">
                                    ACCEPTED
                                </span>

                                <span class="attempt-message">
                                    PROVIDER ASSIGNED
                                </span>

                            @endif

                        </div>

                    @endforeach


                </section>


                <div class="result-actions">

                    <a
                        href="{{ route('emergency.form') }}"
                        class="result-btn-outline"
                    >
                        CREATE ANOTHER REQUEST
                    </a>

                    <a
                        href="{{ route('customer.dashboard') }}"
                        class="result-btn-dark"
                    >
                        OPEN CUSTOMER TERMINAL
                    </a>

                </div>

            </main>



            {{-- RIGHT SIDE --}}
            <aside>

                <div class="result-sidebar-card">

                    <div class="result-sidebar-title">
                        HOW DISPATCH WORKS
                    </div>

                    <div class="result-dispatch-row">
                        <span class="result-dispatch-number">01</span>
                        <span class="result-dispatch-text">
                            Request Created
                        </span>
                    </div>

                    <div class="result-dispatch-row">
                        <span class="result-dispatch-number">02</span>
                        <span class="result-dispatch-text">
                            Eligible Providers Filtered
                        </span>
                    </div>

                    <div class="result-dispatch-row">
                        <span class="result-dispatch-number">03</span>
                        <span class="result-dispatch-text">
                            Recommendation Score Calculated
                        </span>
                    </div>

                    <div class="result-dispatch-row">
                        <span class="result-dispatch-number">04</span>
                        <span class="result-dispatch-text">
                            Best Provider Contacted
                        </span>
                    </div>

                    <div class="result-dispatch-row">
                        <span class="result-dispatch-number">05</span>
                        <span class="result-dispatch-text">
                            Automatic Broadcast if Declined/Expired
                        </span>
                    </div>

                </div>


                <div class="result-sidebar-card">

                    <div class="result-sidebar-title">
                        CURRENT SELECTION
                    </div>

                    <div class="result-selection-row">
                        <span class="result-selection-label">
                            GROUP
                        </span>

                        <strong class="result-selection-value">
                            {{ $emergency['group'] }}
                        </strong>
                    </div>

                    <div class="result-selection-row">
                        <span class="result-selection-label">
                            SERVICE
                        </span>

                        <strong class="result-selection-value">
                            {{ $emergency['service'] }}
                        </strong>
                    </div>

                    <div class="result-selection-row">
                        <span class="result-selection-label">
                            PRIORITY
                        </span>

                        <strong
                            class="
                                result-selection-value
                                result-priority-badge
                                priority-{{ strtolower($emergency['priority']) }}
                            "
                        >
                            {{ strtoupper($emergency['priority']) }}
                        </strong>
                    </div>

                    <div class="result-selection-row">
                        <span class="result-selection-label">
                            AREA
                        </span>

                        <strong class="result-selection-value">
                            {{ $emergency['area'] }}
                        </strong>
                    </div>

                </div>


                <div class="result-sidebar-card">

                    <div class="result-sidebar-title">
                        SERVICE SAFETY
                    </div>

                    <div class="result-safety-item">
                        <span class="result-safety-dot"></span>
                        Arrival PIN
                    </div>

                    <div class="result-safety-item">
                        <span class="result-safety-dot"></span>
                        Before Photo
                    </div>

                    <div class="result-safety-item">
                        <span class="result-safety-dot"></span>
                        After Photo
                    </div>

                    <div class="result-safety-item">
                        <span class="result-safety-dot"></span>
                        Completion PIN
                    </div>

                </div>


                <div class="result-sidebar-card result-demo-card">

                    <strong>
                        DEMONSTRATION ONLY
                    </strong>

                    <p>
                        No backend is connected. Submitting creates a local
                        request reference so you can preview the dispatch flow.
                    </p>

                </div>

            </aside>

        </div>

    </div>

</section>

@endsection