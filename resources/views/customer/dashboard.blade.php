@extends('layouts.app')

@section('content')

<div class="customer-dashboard-page">

    <div class="customer-dashboard-container">

        <!-- =========================================
             DASHBOARD HEADER
        ========================================== -->
        <div class="customer-dashboard-header">

            <div>
                <p class="customer-eyebrow">
                    CLIENT PORTAL
                </p>

                <h1>
                    CUSTOMER DASHBOARD
                </h1>

               <strong>{{ auth()->user()->name }}</strong>
            </div>

            <div class="customer-id-box">
                <span>
                    CUSTOMER ID: SEH-{{ str_pad(auth()->user()->id, 4, '0', STR_PAD_LEFT) }}-C
                </span>

                <a href="{{ route('customer.profile') }}"> VIEW PROFILE</a>
            </div>

        </div>

        <!-- =========================================
             MAIN GRID (LEFT: NEW REQUEST | RIGHT: ACTIVE REQUEST)
        ========================================== -->
    <div class="customer-main-grid">

        <div class="customer-left-panel">

            <section class="customer-section">

                <h2>NEW REQUEST</h2>

        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))
            <div style="margin-bottom:15px; padding:12px; border:1px solid #1f9d55; background:#e8fff1; color:#146c3e; border-radius: 8px; font-weight: 600;">
                ✓ {{ session('success') }}
            </div>
        @endif

        {{-- VALIDATION ERRORS --}}
        @if ($errors->any())
            <div style="margin-bottom:15px; padding:12px; border:1px solid #dc3545; background:#ffeaea; color:#a71d2a; border-radius: 8px;">
                <ul style="margin:0; padding-left:20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <form method="POST" action="{{ route('customer.emergency.store') }}">
        @csrf

        <!-- CATEGORY -->
        <div class="customer-form-group">
            <label>CATEGORY</label>
            <div class="customer-category-buttons">
                <button
                    type="button"
                    class="customer-category-btn active"
                    data-category="Emergency"
                >
                    EMERGENCY
                </button>

                <button
                    type="button"
                    class="customer-category-btn"
                    data-category="Technical"
                >
                    TECHNICAL
                </button>

                <button
                    type="button"
                    class="customer-category-btn"
                    data-category="Home"
                >
                    HOME
                </button>
            </div>
        </div>

        <!-- SERVICE TYPE -->
        <div class="customer-form-group">
            <label for="customerServiceType">
                SERVICE TYPE
            </label>

            <select
                id="customerServiceType"
                name="service_category_id"
                required
            >
                @foreach($serviceCategories as $service)
                    <option
                        value="{{ $service->id }}"
                        data-category="{{ $service->group_name }}"
                        @selected(old('service_category_id') == $service->id)
                    >
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- PRIORITY -->
        <div class="customer-form-group">
            <label>PRIORITY LEVEL</label>

            <input
                type="hidden"
                name="priority"
                id="customerPriority"
                value="{{ old('priority', 'Critical') }}"
            >

            <div class="customer-priority-grid">
                <button
                    type="button"
                    class="customer-priority-btn critical active"
                    data-priority="Critical"
                >
                    CRITICAL
                </button>

                <button
                    type="button"
                    class="customer-priority-btn"
                    data-priority="High"
                >
                    HIGH
                </button>

                <button
                    type="button"
                    class="customer-priority-btn"
                    data-priority="Medium"
                >
                    MEDIUM
                </button>

                <button
                    type="button"
                    class="customer-priority-btn"
                    data-priority="Normal"
                >
                    NORMAL
                </button>
            </div>
        </div>

        <!-- DHAKA AREA -->
        <div class="customer-form-group">
            <label for="customerArea">
                DHAKA AREA
            </label>

            <select
                id="customerArea"
                name="area"
                required
            >
                <option value="Dhanmondi" @selected(old('area', auth()->user()->area) === 'Dhanmondi')>
                    Dhanmondi
                </option>
                <option value="Mirpur" @selected(old('area', auth()->user()->area) === 'Mirpur')>
                    Mirpur
                </option>
                <option value="Uttara" @selected(old('area', auth()->user()->area) === 'Uttara')>
                    Uttara
                </option>
                <option value="Gulshan" @selected(old('area', auth()->user()->area) === 'Gulshan')>
                    Gulshan
                </option>
                <option value="Mohammadpur" @selected(old('area', auth()->user()->area) === 'Mohammadpur')>
                    Mohammadpur
                </option>
                <option value="Banani" @selected(old('area', auth()->user()->area) === 'Banani')>
                    Banani
                </option>
            </select>
        </div>

        <!-- ADDRESS -->
        <div class="customer-form-group">
            <label for="customerAddress">
                DETAILED ADDRESS
            </label>

            <input
                id="customerAddress"
                name="address"
                type="text"
                value="{{ old('address', auth()->user()->address) }}"
                placeholder="e.g. Road 8A, House 42"
                required
            >
        </div>

        <!-- DESCRIPTION -->
        <div class="customer-form-group">
            <label for="customerDescription">
                DESCRIPTION
            </label>

            <textarea
                id="customerDescription"
                name="description"
                placeholder="Brief description of the emergency situation"
                required
            >{{ old('description') }}</textarea>
        </div>

        <!-- DISPATCH -->
        <button type="submit" class="dispatch-btn">
            DISPATCH NOW
        </button>

    </form>
    </section>
    </div>

    <!-- RIGHT PANEL: ACTIVE REQUEST TRACKER -->
    <div class="active-request-time">
    @if($activeRequest)
    <div class="active-request-card">

    <div class="active-card-top">
        <div class="request-header">
            <span class="priority-badge">
                {{ strtoupper($activeRequest->priority) }}
            </span>

            <h2>
                #{{ $activeRequest->reference ?? ('REQ-'.$activeRequest->id) }} :
                {{ $activeRequest->serviceCategory->name ?? 'Emergency Service' }}
            </h2>

            <p>
                Provider:
                @if($activeRequest->assignedProvider)
                    <strong>{{ $activeRequest->assignedProvider->name }}</strong> ({{ $activeRequest->assignedProvider->phone ?? 'Contact available' }})
                @else
                    <em>Waiting for Provider assignment...</em>
                @endif
                • {{ $activeRequest->area }}, Dhaka
            </p>
        </div>
    </div>

    <div class="active-time">
        <strong>
            {{ $activeRequest->created_at->format('h:i A') }}
        </strong>
        <span>
            ACTIVE SINCE
        </span>
    </div>

    <div class="card-body">

        <!-- PIN DISPLAY BOX -->
        @if($activeRequest->arrival_pin || $activeRequest->completion_pin)
        <div style="display: flex; gap: 12px; margin-bottom: 20px; flex-wrap: wrap; background: #f8fafc; padding: 12px; border-radius: 10px; border: 1px solid #e2e8f0;">
            @if($activeRequest->arrival_pin)
                <div style="background: #eff6ff; border: 1px solid #bfdbfe; padding: 8px 14px; border-radius: 8px; font-size: 13px; font-weight: 800; color: #1e40af;">
                    🔑 Arrival PIN: <span style="font-family: monospace; font-size: 16px; letter-spacing: 2px; color: #1d4ed8;">{{ $activeRequest->arrival_pin }}</span>
                </div>
            @endif
            @if($activeRequest->completion_pin)
                <div style="background: #ecfdf5; border: 1px solid #a7f3d0; padding: 8px 14px; border-radius: 8px; font-size: 13px; font-weight: 800; color: #065f46;">
                    🏁 Completion PIN: <span style="font-family: monospace; font-size: 16px; letter-spacing: 2px; color: #059669;">{{ $activeRequest->completion_pin }}</span>
                </div>
            @endif
        </div>
        @endif

        <!-- REQUEST PROGRESS STEPPER -->
        <div class="request-progress-wrapper">
            <div class="request-progress">
                <div class="request-step {{ $current >= 0 ? 'active':'' }}">
                    <i></i>
                    <span>PENDING</span>
                </div>

                <div class="request-step {{ $current >= 1 ? 'active':'' }}">
                    <i></i>
                    <span>ACCEPTED</span>
                </div>

                <div class="request-step {{ $current >= 2 ? 'active':'' }}">
                    <i></i>
                    <span>ON THE WAY</span>
                </div>

                <div class="request-step {{ $current >= 3 ? 'active':'' }}">
                    <i></i>
                    <span>ARRIVED</span>
                </div>

                <div class="request-step {{ $current >= 4 ? 'active':'' }}">
                    <i></i>
                    <span>WORKING</span>
                </div>

                <div class="request-step {{ $current >= 5 ? 'active':'' }}">
                    <i></i>
                    <span>COMPLETED</span>
                </div>
            </div>

            <div class="request-status-bottom">
                <div class="current-status">
                    <span>CURRENT STATUS</span>
                    <strong id="customerCurrentStatus">
                        {{ strtoupper(str_replace('_', ' ', $activeRequest->status)) }}
                    </strong>
                </div>

                <div class="status-actions">
                    <form method="POST" action="{{ route('customer.request.reset', $activeRequest->id) }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="reset-btn">
                            RESET STEP
                        </button>
                    </form>

                    <form method="POST" action="{{ route('customer.request.advance', $activeRequest->id) }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="advance-btn">
                            ADVANCE STATE
                        </button>
                    </form>
                </div>
            </div>

            <!-- PROVIDER & LOCATION DETAILS -->
            <div class="customer-info-grid" style="margin-top: 20px;">
                <section class="customer-info-card">
                    <span>PROVIDER CONTACT</span>
                    @if($activeRequest->assignedProvider)
                        <strong>{{ $activeRequest->assignedProvider->name }}</strong>
                        <p>{{ $activeRequest->assignedProvider->phone ?? 'Phone unavailable' }}</p>
                    @else
                        <strong>Waiting for Provider</strong>
                        <p>Broadcasting to nearby verified emergency helpers...</p>
                    @endif
                </section>

                <section class="customer-info-card">
                    <span>LOCATION DETAILS</span>
                    <strong>{{ $activeRequest->area }}, Dhaka</strong>
                    <p>{{ $activeRequest->address }}</p>
                </section>
            </div>
        </div>
    </div>
    </div>
    @else
        <div class="active-request-card" style="text-align: center; padding: 48px 24px; background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 14px rgba(0,0,0,0.03);">
            <div style="font-size: 42px; margin-bottom: 12px;">📋</div>
            <h3 style="font-size: 18px; font-weight: 800; color: #0f172a; margin-bottom: 8px;">NO ACTIVE EMERGENCY REQUEST</h3>
            <p style="font-size: 13px; color: #64748b; margin: 0; line-height: 1.5;">Fill out the <strong>NEW REQUEST</strong> form on the left to dispatch an emergency helper near your area.</p>
        </div>
    @endif
    </div>
    </div>

    <!-- =========================================
         REQUEST HISTORY TABLE
    ========================================== -->
    <div style="margin-top: 36px; background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; padding: 24px; box-shadow: 0 4px 14px rgba(0,0,0,0.02);">
        <h3 style="font-size: 16px; font-weight: 900; color: #0f172a; margin-bottom: 16px; letter-spacing: -0.3px;">
            📜 MY REQUEST HISTORY
        </h3>

        @if($requests->count() > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                    <thead>
                        <tr style="border-bottom: 2px solid #f1f5f9; text-align: left; color: #64748b; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
                            <th style="padding: 10px 12px;">Reference</th>
                            <th style="padding: 10px 12px;">Service</th>
                            <th style="padding: 10px 12px;">Area</th>
                            <th style="padding: 10px 12px;">Priority</th>
                            <th style="padding: 10px 12px;">Provider</th>
                            <th style="padding: 10px 12px;">Date</th>
                            <th style="padding: 10px 12px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $req)
                        <tr style="border-bottom: 1px solid #f1f5f9; color: #334155;">
                            <td style="padding: 12px; font-weight: 800; color: #0f172a;">#{{ $req->reference ?? ('REQ-'.$req->id) }}</td>
                            <td style="padding: 12px; font-weight: 700;">{{ $req->serviceCategory->name ?? 'Emergency' }}</td>
                            <td style="padding: 12px;">{{ $req->area }}</td>
                            <td style="padding: 12px;">
                                <span style="font-size: 10px; font-weight: 900; padding: 3px 8px; border-radius: 4px; color: #fff; background: {{ strtolower($req->priority) === 'critical' ? '#ef4444' : (strtolower($req->priority) === 'high' ? '#f59e0b' : '#3b82f6') }};">
                                    {{ strtoupper($req->priority) }}
                                </span>
                            </td>
                            <td style="padding: 12px; font-weight: 600;">{{ $req->assignedProvider->name ?? 'Waiting...' }}</td>
                            <td style="padding: 12px; color: #64748b;">{{ $req->created_at->format('d M Y, h:i A') }}</td>
                            <td style="padding: 12px;">
                                <span style="font-size: 11px; font-weight: 800; text-transform: uppercase; padding: 4px 10px; border-radius: 20px; background: {{ $req->status === 'completed' ? '#d1fae5; color: #047857;' : ($req->status === 'accepted' || $req->status === 'working' ? '#dbeafe; color: #1d4ed8;' : '#fef3c7; color: #d97706;') }}">
                                    {{ str_replace('_', ' ', $req->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p style="font-size: 13px; color: #94a3b8; margin: 0;">No previous request history available.</p>
        @endif
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const categoryButtons = document.querySelectorAll('.customer-category-btn');
    const serviceSelect = document.getElementById('customerServiceType');
    const priorityButtons = document.querySelectorAll('.customer-priority-btn');
    const priorityInput = document.getElementById('customerPriority');

    // Save all service options from database
    const allServices = Array.from(serviceSelect.options).map(option => ({
        value: option.value,
        text: option.textContent.trim(),
        category: option.dataset.category
    }));

    // CATEGORY -> SERVICE FILTER
    function showServices(category) {
        serviceSelect.innerHTML = '';
        const filteredServices = allServices.filter(service =>
            service.category.toLowerCase() === category.toLowerCase()
        );

        filteredServices.forEach(service => {
            const option = document.createElement('option');
            option.value = service.value;
            option.textContent = service.text;
            option.dataset.category = service.category;
            serviceSelect.appendChild(option);
        });
    }

    categoryButtons.forEach(button => {
        button.addEventListener('click', function () {
            categoryButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            const category = this.dataset.category;
            showServices(category);
        });
    });

    // Default category filter
    showServices('Emergency');

    // PRIORITY BUTTONS
    priorityButtons.forEach(button => {
        button.addEventListener('click', function () {
            priorityButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            priorityInput.value = this.dataset.priority;
        });
    });
});
</script>

@endsection