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
             MAIN GRID
        ========================================== -->

        <div class="customer-main-grid">


            <!-- =================================================
                 LEFT SIDE
            ================================================== -->

            <aside class="customer-left-panel">


                <!-- NEW REQUEST -->

<section class="customer-section">

    <h2>NEW REQUEST</h2>

    {{-- SUCCESS MESSAGE --}}
    @if (session('success'))
        <div style="
            margin-bottom:15px;
            padding:12px;
            border:1px solid #1f9d55;
            background:#e8fff1;
            color:#146c3e;
        ">
            {{ session('success') }}
        </div>
    @endif

    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())
        <div style="
            margin-bottom:15px;
            padding:12px;
            border:1px solid #dc3545;
            background:#ffeaea;
            color:#a71d2a;
        ">
            <ul style="margin:0; padding-left:20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form
        method="POST"
        action="{{ route('customer.emergency.store') }}"
        id="customerEmergencyForm"
    >

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

                <option value="Dhanmondi" @selected(old('area') === 'Dhanmondi')>
                    Dhanmondi
                </option>

                <option value="Mirpur" @selected(old('area') === 'Mirpur')>
                    Mirpur
                </option>

                <option value="Uttara" @selected(old('area') === 'Uttara')>
                    Uttara
                </option>

                <option value="Gulshan" @selected(old('area') === 'Gulshan')>
                    Gulshan
                </option>

                <option value="Mohammadpur" @selected(old('area') === 'Mohammadpur')>
                    Mohammadpur
                </option>

                <option value="Banani" @selected(old('area') === 'Banani')>
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
                value="{{ old('address') }}"
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
                placeholder="Brief description of the situation"
                required
            >{{ old('description') }}</textarea>

        </div>


        <!-- DISPATCH -->

        <button
            type="submit"
            id="dispatchNowBtn"
            class="customer-dispatch-btn"
        >
            DISPATCH NOW
        </button>

    </form>

</section>

                <!-- =============================================
                     EMERGENCY CONTACTS
                ============================================== -->

                <section class="customer-section emergency-contact-section">

                    <div class="customer-section-heading">

                        <h2>
                            EMERGENCY CONTACTS
                        </h2>

                        <span>
                            EMAIL ON CRITICAL
                        </span>

                    </div>


                    <div class="emergency-contact-card">

                        <div>

                            <strong>
                                Nusrat Jahan
                            </strong>

                            <span>
                                Spouse · nusrat.jahan@mail.com
                            </span>

                        </div>


                        <button
                            type="button"
                            class="notify-toggle active"
                        >
                            NOTIFY ON
                        </button>

                    </div>



                    <div class="emergency-contact-card">

                        <div>

                            <strong>
                                Dr. Farzana Akter
                            </strong>

                            <span>
                                Family Doctor · farzana.akter@clinic.bd
                            </span>

                        </div>


                        <button
                            type="button"
                            class="notify-toggle"
                        >
                            NOTIFY OFF
                        </button>

                    </div>


                    <p class="critical-email-note">
                        CRITICAL PRIORITY REQUESTS AUTO-EMAIL ENABLED CONTACTS
                    </p>

                </section>



                <!-- =============================================
                     RECOMMENDED
                ============================================== -->

                <section class="customer-section recommended-section">

                    <div class="customer-section-heading">

                        <h2>
                            RECOMMENDED
                        </h2>

                        <span>
                            RULE-BASED RANKING
                        </span>

                    </div>


                    <p class="ranking-rule">
                        DISTANCE 40% · AVAILABILITY 25% · RATING 20% · EXPERIENCE 15%
                    </p>



                    <!-- PROVIDER 1 -->

                    <div class="recommended-provider best">

                        <div class="recommended-provider-top">

                            <strong>
                                01 Rapid Care Ambulance
                            </strong>

                            <span class="best-match">
                                BEST MATCH
                            </span>

                            <b>
                                91
                            </b>

                        </div>


                        <span class="verified-tag">
                            VERIFIED
                        </span>


                        <p class="provider-service-type">
                            AMBULANCE / CRITICAL CARE
                        </p>


                        <div class="provider-score-bar">

                            <div style="width:91%"></div>

                        </div>


                        <div class="recommended-provider-meta">

                            <span>1.2 km</span>
                            <span>★ 4.9</span>
                            <span>11y exp</span>

                            <strong class="provider-available">
                                Available
                            </strong>

                        </div>


                        <p class="broadcast-note">
                            BROADCAST ESCALATES TO NEXT PROVIDER ON DECLINE
                        </p>

                    </div>



                    <!-- PROVIDER 2 -->

                    <div class="recommended-provider">

                        <div class="recommended-provider-top">

                            <strong>
                                02 Dhaka Emergency Ambulance
                            </strong>

                            <b>
                                84
                            </b>

                        </div>


                        <span class="verified-tag">
                            VERIFIED
                        </span>

                        <p class="provider-service-type">
                            AMBULANCE / TRANSPORT
                        </p>


                        <div class="provider-score-bar">

                            <div style="width:84%"></div>

                        </div>


                        <div class="recommended-provider-meta">

                            <span>3.4 km</span>
                            <span>★ 4.7</span>
                            <span>8y exp</span>

                            <strong class="provider-available">
                                Available
                            </strong>

                        </div>

                    </div>



                    <!-- PROVIDER 3 -->

                    <div class="recommended-provider">

                        <div class="recommended-provider-top">

                            <strong>
                                03 City Rescue Ambulance
                            </strong>

                            <b>
                                78
                            </b>

                        </div>


                        <span class="verified-tag">
                            VERIFIED
                        </span>

                        <p class="provider-service-type">
                            AMBULANCE / TRANSPORT
                        </p>


                        <div class="provider-score-bar">

                            <div style="width:78%"></div>

                        </div>


                        <div class="recommended-provider-meta">

                            <span>5.1 km</span>
                            <span>★ 4.6</span>
                            <span>6y exp</span>

                            <strong class="provider-busy">
                                Busy
                            </strong>

                        </div>

                    </div>

                </section>

            </aside>



            <!-- =================================================
                 RIGHT SIDE
            ================================================== -->

            <main class="customer-right-panel">


               <!-- =============================================
     ACTIVE REQUEST
============================================== -->

@if($activeRequest)

<section class="active-request-card">

    <div class="active-request-header">

        <div>

            <span class="critical-tag">
                {{ strtoupper($activeRequest->priority) }}
            </span>

            <h2>
                {{ $activeRequest->reference }}:
                {{ $activeRequest->serviceCategory->name ?? 'Emergency Service' }} Dispatch
            </h2>

            <p>
                @if($activeRequest->assignedProvider)

                    Provider: {{ $activeRequest->assignedProvider->name }}
                    · {{ $activeRequest->area }}, Dhaka

                @else

                    Searching for provider
                    · {{ $activeRequest->area }}, Dhaka

                @endif
            </p>

        </div>


        <div class="active-request-time">

            <strong>
                {{ $activeRequest->created_at->format('H:i:s') }}
            </strong>

            <span>
                ACTIVE SINCE
            </span>

        </div>

    </div>


    <!-- REQUEST PROGRESS -->

    <div class="request-progress">

        <div class="request-step active">
            <i></i>
            <span>PENDING</span>
        </div>

        <div class="request-step">
            <i></i>
            <span>ACCEPTED</span>
        </div>

        <div class="request-step">
            <i></i>
            <span>ON THE WAY</span>
        </div>

        <div class="request-step">
            <i></i>
            <span>ARRIVAL PIN REQUIRED</span>
        </div>

        <div class="request-step">
            <i></i>
            <span>ARRIVED</span>
        </div>

        <div class="request-step">
            <i></i>
            <span>BEFORE PHOTO</span>
        </div>

        <div class="request-step">
            <i></i>
            <span>WORKING</span>
        </div>

        <div class="request-step">
            <i></i>
            <span>AFTER PHOTO</span>
        </div>

        <div class="request-step">
            <i></i>
            <span>COMPLETION PIN REQUIRED</span>
        </div>

        <div class="request-step">
            <i></i>
            <span>COMPLETED</span>
        </div>

        <div class="request-step">
            <i></i>
            <span>RATING/REVIEW</span>
        </div>

    </div>


    <div class="customer-request-scroll">
        <div></div>
    </div>


    <div class="request-status-bottom">

        <div>

            <span>
                CURRENT STATUS
            </span>

            <strong id="customerCurrentStatus">
                {{ strtoupper(str_replace('_', ' ', $activeRequest->status)) }}
            </strong>

        </div>

    </div>

</section>


<!-- =============================================
     PROVIDER / LOCATION
============================================== -->

<div class="customer-info-grid">

    <!-- PROVIDER CONTACT -->

    <section class="customer-info-card">

        <span>
            PROVIDER CONTACT
        </span>

        @if($activeRequest->assignedProvider)

            <strong>
                {{ $activeRequest->assignedProvider->name }}
            </strong>

            <p>
                @if($activeRequest->assignedProvider->phone)
                    {{ $activeRequest->assignedProvider->phone }}
                @else
                    Phone number unavailable
                @endif
            </p>

        @else

            <strong>
                Waiting for Provider
            </strong>

            <p>
                Searching for an available service provider...
            </p>

        @endif

    </section>


    <!-- LOCATION DETAILS -->

    <section class="customer-info-card">

        <span>
            LOCATION DETAILS
        </span>

        <strong>
            {{ $activeRequest->area }}, Dhaka
        </strong>

        <p>
            {{ $activeRequest->address }}
        </p>

    </section>

</div>


@else


<!-- =============================================
     NO ACTIVE REQUEST
============================================== -->

<section class="active-request-card">

    <div style="
        padding: 50px 30px;
        text-align: center;
    ">

        <strong style="
            display:block;
            font-size:20px;
            margin-bottom:10px;
        ">
            NO ACTIVE REQUEST
        </strong>

        <p>
            You currently have no active emergency request.
        </p>

    </div>

</section>


@endif

                <!-- =============================================
                     REQUEST HISTORY
                ============================================== -->

                <section class="request-history-card">


                    <div class="request-history-heading">

                        <h2>
                            REQUEST HISTORY
                        </h2>

                        <span>
                            42 TOTAL
                        </span>

                    </div>


                    <div class="request-history-table-wrap">

                        <table class="request-history-table">

                            <thead>

                                <tr>

                                    <th>ID</th>
                                    <th>SERVICE</th>
                                    <th>DATE</th>
                                    <th>COST</th>
                                    <th>ACTIONS</th>

                                </tr>

                            </thead>


                            <tbody>


                                <tr>

                                    <td>
                                        ER-2447
                                    </td>

                                    <td>

                                        <strong>
                                            Ambulance Service
                                        </strong>

                                        <small>
                                            COMPLETED
                                        </small>

                                    </td>

                                    <td>
                                        Mar 21, 2026
                                    </td>

                                    <td>
                                        ৳1,500
                                    </td>

                                    <td class="history-actions">

                                        <button type="button">
                                            RATE
                                        </button>

                                        <button type="button">
                                            PDF
                                        </button>

                                        <button
                                            type="button"
                                            class="complain-link"
                                        >
                                            COMPLAINT
                                        </button>

                                    </td>

                                </tr>



                                <tr>

                                    <td>
                                        ER-2419
                                    </td>

                                    <td>

                                        <strong>
                                            Home Nurse Visit
                                        </strong>

                                        <small>
                                            COMPLETED
                                        </small>

                                    </td>

                                    <td>
                                        Mar 14, 2026
                                    </td>

                                    <td>
                                        ৳2,500
                                    </td>

                                    <td class="history-actions">

                                        <button type="button">
                                            RATE
                                        </button>

                                        <button type="button">
                                            PDF
                                        </button>

                                        <button
                                            type="button"
                                            class="complain-link"
                                        >
                                            COMPLAINT
                                        </button>

                                    </td>

                                </tr>



                                <tr>

                                    <td>
                                        ER-2402
                                    </td>

                                    <td>

                                        <strong>
                                            Emergency Blood Donor
                                        </strong>

                                        <small>
                                            CANCELLED
                                        </small>

                                    </td>

                                    <td>
                                        Mar 09, 2026
                                    </td>

                                    <td>
                                        ৳2,800
                                    </td>

                                    <td class="history-actions disabled-actions">

                                        <button type="button">
                                            RATE
                                        </button>

                                        <button type="button">
                                            PDF
                                        </button>

                                        <button type="button">
                                            COMPLAINT
                                        </button>

                                    </td>

                                </tr>


                            </tbody>

                        </table>

                    </div>

                </section>


            </main>

        </div>

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


    // ==========================================
    // CATEGORY -> SERVICE FILTER
    // ==========================================

    function showServices(category) {

        serviceSelect.innerHTML = '';

        const filteredServices = allServices.filter(service =>
            service.category === category
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

            categoryButtons.forEach(btn =>
                btn.classList.remove('active')
            );

            this.classList.add('active');

            const category = this.dataset.category;

            showServices(category);

        });

    });


    // Default category
    showServices('Emergency');


    // ==========================================
    // PRIORITY BUTTONS
    // ==========================================

    priorityButtons.forEach(button => {

        button.addEventListener('click', function () {

            priorityButtons.forEach(btn =>
                btn.classList.remove('active')
            );

            this.classList.add('active');

            priorityInput.value = this.dataset.priority;

        });

    });

});
</script>

@endsection