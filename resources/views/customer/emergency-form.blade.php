@extends('layouts.app')

@section('content')

<style>
    .emergency-form-page {
        background: #f5f1e8;
        padding: 64px 0 80px;
        min-height: 700px;
    }

    .emergency-form-container {
        width: min(1240px, calc(100% - 48px));
        margin: 0 auto;
    }

    /* =========================
       PAGE HEADER
    ========================= */

    .emergency-form-eyebrow {
        margin-bottom: 15px;
        font-family: monospace;
        font-size: 10px;
        letter-spacing: 2px;
        color: #6b6b6b;
    }

    .emergency-form-title {
        margin: 0;
        font-size: 48px;
        line-height: 1;
        font-weight: 900;
        letter-spacing: -2px;
        color: #171717;
    }

    .emergency-form-subtitle {
        max-width: 720px;
        margin-top: 18px;
        margin-bottom: 0;
        font-size: 18px;
        line-height: 1.55;
        color: #666;
    }

    /* =========================
       MAIN GRID
    ========================= */

    .emergency-form-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 320px;
        gap: 24px;
        margin-top: 42px;
        align-items: start;
    }

    /* =========================
       FORM CARD
    ========================= */

    .emergency-request-card {
        background: #fff;
        border: 1px solid #d9d9d9;
        padding: 32px;
    }

    .emergency-field {
        margin-bottom: 30px;
    }

    .emergency-label {
        display: block;
        margin-bottom: 11px;
        font-family: monospace;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.3px;
        color: #4c4c4c;
    }

    /* SERVICE GROUP */

    .emergency-service-groups {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
    }

    .emergency-group-btn {
        height: 42px;
        border: 1px solid #d9d9d9;
        background: #fff;
        color: #222;
        cursor: pointer;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .7px;
        transition: .15s ease;
    }

    .emergency-group-btn.active {
        background: #171717;
        border-color: #171717;
        color: #fff;
    }

    /* INPUT */

    .emergency-request-card select,
    .emergency-request-card input,
    .emergency-request-card textarea {
        width: 100%;
        border: 1px solid #d5d0c5;
        background: #f5f1e8;
        color: #171717;
        outline: none;
        font-family: inherit;
        font-size: 14px;
    }

    .emergency-request-card select,
    .emergency-request-card input {
        height: 46px;
        padding: 0 16px;
    }

    .emergency-request-card textarea {
        min-height: 125px;
        padding: 15px;
        resize: vertical;
    }

    .emergency-request-card input::placeholder,
    .emergency-request-card textarea::placeholder {
        color: #999;
    }

    .emergency-request-card select:focus,
    .emergency-request-card input:focus,
    .emergency-request-card textarea:focus {
        border-color: #171717;
    }

    /* PRIORITY */

    .emergency-priorities {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 8px;
    }

    .emergency-priority-btn {
        height: 42px;
        border: 1px solid #ddd;
        background: #fff;
        color: #222;
        cursor: pointer;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: .6px;
    }

    .emergency-priority-btn.active {
        background: #ed1c24;
        border-color: #ed1c24;
        color: #fff;
    }

    .emergency-priority-note {
        margin-top: 10px;
        font-family: monospace;
        font-size: 10px;
        letter-spacing: 1px;
        color: #ed1c24;
    }

    /* TWO COLUMNS */

    .emergency-two-fields {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    /* CREATE BUTTON */

    .emergency-create-btn {
        width: 100%;
        height: 49px;
        border: 0;
        background: #ed1c24;
        color: #fff;
        cursor: pointer;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: .4px;
        transition: .15s ease;
    }

    .emergency-create-btn:hover {
        background: #d31820;
    }

    /* VALIDATION */

    .emergency-form-error {
        display: none;
        margin-bottom: 18px;
        padding: 13px 15px;
        border-left: 3px solid #ed1c24;
        background: #fff2f2;
        color: #b5161c;
        font-size: 13px;
        line-height: 1.5;
    }

    .emergency-form-success {
        display: none;
        margin-bottom: 18px;
        padding: 15px;
        border-left: 3px solid #171717;
        background: #f3f3f3;
        color: #171717;
        font-size: 13px;
        line-height: 1.5;
    }

    /* =========================
       SIDEBAR
    ========================= */

    .emergency-sidebar-card {
        margin-bottom: 24px;
        padding: 25px;
        border: 1px solid #dadada;
        background: #fff;
    }

    .emergency-sidebar-title {
        margin-bottom: 22px;
        font-family: monospace;
        font-size: 10px;
        letter-spacing: 1.8px;
        color: #777;
    }

    /* DISPATCH */

    .emergency-dispatch-row {
        display: grid;
        grid-template-columns: 24px 1fr;
        gap: 0;
        margin-bottom: 17px;
    }

    .emergency-dispatch-row:last-child {
        margin-bottom: 0;
    }

    .emergency-dispatch-number {
        font-family: monospace;
        font-size: 10px;
        color: #888;
    }

    .emergency-dispatch-text {
        font-size: 14px;
        font-weight: 800;
        line-height: 1.25;
        color: #222;
    }

    /* CURRENT SELECTION */

    .emergency-selection-row {
        min-height: 47px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        border-bottom: 1px solid #ddd;
    }

    .emergency-selection-row:last-child {
        border-bottom: 0;
    }

    .emergency-selection-label {
        font-family: monospace;
        font-size: 10px;
        letter-spacing: 1px;
        color: #777;
    }

    .emergency-selection-value {
        font-size: 14px;
        font-weight: 800;
        text-align: right;
        color: #222;
    }

    .emergency-selection-priority {
        padding: 7px 10px;
        background: #ed1c24;
        color: #fff;
        font-size: 11px;
    }

    /* SAFETY */

    .emergency-safety-item {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 12px;
        font-size: 14px;
        font-weight: 800;
    }

    .emergency-safety-item:last-child {
        margin-bottom: 0;
    }

    .emergency-safety-dot {
        width: 6px;
        height: 6px;
        background: #ed1c24;
        flex-shrink: 0;
    }

    /* DEMO */

    .emergency-demo-card {
        border-left: 1px solid #1684ff;
    }

    .emergency-demo-card strong {
        display: block;
        margin-bottom: 7px;
        font-size: 12px;
        letter-spacing: .5px;
    }

    .emergency-demo-card p {
        margin: 0;
        color: #777;
        font-size: 14px;
        line-height: 1.5;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 950px) {

        .emergency-form-grid {
            grid-template-columns: 1fr;
        }

        .emergency-sidebar {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .emergency-sidebar-card {
            margin-bottom: 0;
        }
    }

    @media (max-width: 700px) {

        .emergency-form-page {
            padding: 40px 0 60px;
        }

        .emergency-form-container {
            width: min(100% - 30px, 1240px);
        }

        .emergency-form-title {
            font-size: 34px;
            letter-spacing: -1px;
        }

        .emergency-form-subtitle {
            font-size: 16px;
        }

        .emergency-request-card {
            padding: 20px;
        }

        .emergency-service-groups {
            grid-template-columns: 1fr;
        }

        .emergency-priorities {
            grid-template-columns: 1fr 1fr;
        }

        .emergency-two-fields {
            grid-template-columns: 1fr;
        }

        .emergency-sidebar {
            grid-template-columns: 1fr;
        }
    }
</style>


<section class="emergency-form-page">

    <div class="emergency-form-container">

        {{-- PAGE HEADING --}}

        <div class="emergency-form-eyebrow">
            CUSTOMER CONSOLE · EMERGENCY DISPATCH
        </div>

        <h1 class="emergency-form-title">
            REQUEST EMERGENCY ASSISTANCE
        </h1>

        <p class="emergency-form-subtitle">
            Tell us what happened. The system will identify the most suitable
            verified and available provider.
        </p>


        <div class="emergency-form-grid">

            {{-- =========================
                 LEFT SIDE FORM
            ========================= --}}

            <div class="emergency-request-card">

                <form
    id="emergencyForm"
    method="POST"
    action="{{ route('emergency.form.submit') }}"
>

    @csrf

                    {{-- hidden values --}}

                    <input
                        type="hidden"
                        name="service_group"
                        id="serviceGroupInput"
                        value="Emergency"
                    >

                    <input
                        type="hidden"
                        name="priority"
                        id="priorityInput"
                        value="Critical"
                    >


                    {{-- SERVICE GROUP --}}

                    <div class="emergency-field">

                        <label class="emergency-label">
                            SERVICE GROUP
                        </label>

                        <div class="emergency-service-groups">

                            <button
                                type="button"
                                class="emergency-group-btn active"
                                data-group="Emergency"
                            >
                                EMERGENCY
                            </button>

                            <button
                                type="button"
                                class="emergency-group-btn"
                                data-group="Technical"
                            >
                                TECHNICAL
                            </button>

                            <button
                                type="button"
                                class="emergency-group-btn"
                                data-group="Home"
                            >
                                HOME
                            </button>

                        </div>

                    </div>


                    {{-- SERVICE TYPE --}}

                    <div class="emergency-field">

                        <label
                            class="emergency-label"
                            for="serviceType"
                        >
                            SERVICE TYPE
                        </label>

                        <select
                            name="service_type"
                            id="serviceType"
                        >
                            <option value="Ambulance">
                                Ambulance
                            </option>

                            <option value="Blood Donor">
                                Blood Donor
                            </option>

                            <option value="Home Nurse">
                                Home Nurse
                            </option>
                        </select>

                    </div>


                    {{-- PRIORITY --}}

                    <div class="emergency-field">

                        <label class="emergency-label">
                            PRIORITY
                        </label>

                        <div class="emergency-priorities">

                            <button
                                type="button"
                                class="emergency-priority-btn active"
                                data-priority="Critical"
                            >
                                CRITICAL
                            </button>

                            <button
                                type="button"
                                class="emergency-priority-btn"
                                data-priority="High"
                            >
                                HIGH
                            </button>

                            <button
                                type="button"
                                class="emergency-priority-btn"
                                data-priority="Medium"
                            >
                                MEDIUM
                            </button>

                            <button
                                type="button"
                                class="emergency-priority-btn"
                                data-priority="Normal"
                            >
                                NORMAL
                            </button>

                        </div>

                        <div
                            class="emergency-priority-note"
                            id="priorityNote"
                        >
                            CRITICAL REQUESTS ARE DISPATCHED FIRST AND BROADCAST FASTER.
                        </div>

                    </div>


                    {{-- AREA + ADDRESS --}}

                    <div class="emergency-two-fields">

                        <div class="emergency-field">

                            <label
                                class="emergency-label"
                                for="emergencyArea"
                            >
                                DHAKA AREA
                            </label>

                            <select
                                name="area"
                                id="emergencyArea"
                            >

                                <option value="Dhanmondi">
                                    Dhanmondi
                                </option>

                                <option value="Mirpur">
                                    Mirpur
                                </option>

                                <option value="Uttara">
                                    Uttara
                                </option>

                                <option value="Banani">
                                    Banani
                                </option>

                                <option value="Mohammadpur">
                                    Mohammadpur
                                </option>

                                <option value="Gulshan">
                                    Gulshan
                                </option>

                                <option value="Badda">
                                    Badda
                                </option>

                                <option value="Bashundhara">
                                    Bashundhara
                                </option>

                                <option value="Farmgate">
                                    Farmgate
                                </option>

                                <option value="Motijheel">
                                    Motijheel
                                </option>

                            </select>

                        </div>


                        <div class="emergency-field">

                            <label
                                class="emergency-label"
                                for="detailedAddress"
                            >
                                DETAILED ADDRESS
                            </label>

                            <input
                                type="text"
                                id="detailedAddress"
                                name="address"
                                placeholder="e.g. Road 8A, House 42"
                            >

                        </div>

                    </div>


                    {{-- DESCRIPTION --}}

                    <div class="emergency-field">

                        <label
                            class="emergency-label"
                            for="problemDescription"
                        >
                            DESCRIPTION
                        </label>

                        <textarea
                            id="problemDescription"
                            name="description"
                            placeholder="Briefly describe what happened..."
                        ></textarea>

                    </div>


                    {{-- ERROR --}}

                    <div
                        class="emergency-form-error"
                        id="emergencyFormError"
                    ></div>


                    {{-- SUCCESS --}}

                    <div
                        class="emergency-form-success"
                        id="emergencyFormSuccess"
                    ></div>


                    {{-- CREATE REQUEST --}}

                    <button
                        type="submit"
                        class="emergency-create-btn"
                    >
                        CREATE REQUEST
                    </button>

                </form>

            </div>



            {{-- =========================
                 RIGHT SIDE
            ========================= --}}

            <aside class="emergency-sidebar">


                {{-- HOW DISPATCH WORKS --}}

                <div class="emergency-sidebar-card">

                    <div class="emergency-sidebar-title">
                        HOW DISPATCH WORKS
                    </div>


                    <div class="emergency-dispatch-row">

                        <span class="emergency-dispatch-number">
                            01
                        </span>

                        <span class="emergency-dispatch-text">
                            Request Created
                        </span>

                    </div>


                    <div class="emergency-dispatch-row">

                        <span class="emergency-dispatch-number">
                            02
                        </span>

                        <span class="emergency-dispatch-text">
                            Eligible Providers Filtered
                        </span>

                    </div>


                    <div class="emergency-dispatch-row">

                        <span class="emergency-dispatch-number">
                            03
                        </span>

                        <span class="emergency-dispatch-text">
                            Recommendation Score Calculated
                        </span>

                    </div>


                    <div class="emergency-dispatch-row">

                        <span class="emergency-dispatch-number">
                            04
                        </span>

                        <span class="emergency-dispatch-text">
                            Best Provider Contacted
                        </span>

                    </div>


                    <div class="emergency-dispatch-row">

                        <span class="emergency-dispatch-number">
                            05
                        </span>

                        <span class="emergency-dispatch-text">
                            Automatic Broadcast if Declined/Expired
                        </span>

                    </div>

                </div>


                {{-- CURRENT SELECTION --}}

                <div class="emergency-sidebar-card">

                    <div class="emergency-sidebar-title">
                        CURRENT SELECTION
                    </div>


                    <div class="emergency-selection-row">

                        <span class="emergency-selection-label">
                            GROUP
                        </span>

                        <strong
                            class="emergency-selection-value"
                            id="currentGroup"
                        >
                            Emergency
                        </strong>

                    </div>


                    <div class="emergency-selection-row">

                        <span class="emergency-selection-label">
                            SERVICE
                        </span>

                        <strong
                            class="emergency-selection-value"
                            id="currentService"
                        >
                            Ambulance
                        </strong>

                    </div>


                    <div class="emergency-selection-row">

                        <span class="emergency-selection-label">
                            PRIORITY
                        </span>

                        <strong
                            class="emergency-selection-value emergency-selection-priority"
                            id="currentPriority"
                        >
                            CRITICAL
                        </strong>

                    </div>


                    <div class="emergency-selection-row">

                        <span class="emergency-selection-label">
                            AREA
                        </span>

                        <strong
                            class="emergency-selection-value"
                            id="currentArea"
                        >
                            Dhanmondi
                        </strong>

                    </div>

                </div>


                {{-- SERVICE SAFETY --}}

                <div class="emergency-sidebar-card">

                    <div class="emergency-sidebar-title">
                        SERVICE SAFETY
                    </div>


                    <div class="emergency-safety-item">
                        <span class="emergency-safety-dot"></span>
                        Arrival PIN
                    </div>

                    <div class="emergency-safety-item">
                        <span class="emergency-safety-dot"></span>
                        Before Photo
                    </div>

                    <div class="emergency-safety-item">
                        <span class="emergency-safety-dot"></span>
                        After Photo
                    </div>

                    <div class="emergency-safety-item">
                        <span class="emergency-safety-dot"></span>
                        Completion PIN
                    </div>

                </div>


                {{-- DEMONSTRATION --}}

                <div
                    class="emergency-sidebar-card emergency-demo-card"
                >

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


<script>
document.addEventListener('DOMContentLoaded', function () {

    /*
    ===================================
    SERVICE DATA
    ===================================
    */

    const serviceData = {

        Emergency: [
            'Ambulance',
            'Blood Donor',
            'Home Nurse'
        ],

        Technical: [
            'Electrician',
            'Plumber',
            'AC Technician',
            'Locksmith'
        ],

        Home: [
            'Cleaner',
            'Carpenter'
        ]

    };


    /*
    ===================================
    SERVICE GROUP
    ===================================
    */

    const groupButtons =
        document.querySelectorAll(
            '.emergency-group-btn'
        );

    const serviceSelect =
        document.getElementById(
            'serviceType'
        );

    const groupInput =
        document.getElementById(
            'serviceGroupInput'
        );

    const currentGroup =
        document.getElementById(
            'currentGroup'
        );

    const currentService =
        document.getElementById(
            'currentService'
        );


    groupButtons.forEach(function (button) {

        button.addEventListener(
            'click',
            function () {

                groupButtons.forEach(
                    function (btn) {

                        btn.classList.remove(
                            'active'
                        );

                    }
                );


                this.classList.add(
                    'active'
                );


                const selectedGroup =
                    this.dataset.group;


                groupInput.value =
                    selectedGroup;


                currentGroup.textContent =
                    selectedGroup;


                serviceSelect.innerHTML =
                    '';


                serviceData[selectedGroup]
                    .forEach(function (service) {

                        const option =
                            document.createElement(
                                'option'
                            );

                        option.value =
                            service;

                        option.textContent =
                            service;

                        serviceSelect.appendChild(
                            option
                        );

                    });


                currentService.textContent =
                    serviceData[selectedGroup][0];

            }
        );

    });


    /*
    ===================================
    SERVICE SELECT
    ===================================
    */

    serviceSelect.addEventListener(
        'change',
        function () {

            currentService.textContent =
                this.value;

        }
    );


    /*
    ===================================
    PRIORITY
    ===================================
    */

    const priorityButtons =
        document.querySelectorAll(
            '.emergency-priority-btn'
        );

    const priorityInput =
        document.getElementById(
            'priorityInput'
        );

    const currentPriority =
        document.getElementById(
            'currentPriority'
        );

    const priorityNote =
        document.getElementById(
            'priorityNote'
        );


    priorityButtons.forEach(
        function (button) {

            button.addEventListener(
                'click',
                function () {

                    priorityButtons.forEach(
                        function (btn) {

                            btn.classList.remove(
                                'active'
                            );

                        }
                    );


                    this.classList.add(
                        'active'
                    );


                    const selectedPriority =
                        this.dataset.priority;


                    priorityInput.value =
                        selectedPriority;


                    currentPriority.textContent =
                        selectedPriority.toUpperCase();


                    if (
                        selectedPriority ===
                        'Critical'
                    ) {

                        priorityNote.textContent =
                            'CRITICAL REQUESTS ARE DISPATCHED FIRST AND BROADCAST FASTER.';

                    }

                    else if (
                        selectedPriority ===
                        'High'
                    ) {

                        priorityNote.textContent =
                            'HIGH PRIORITY REQUESTS RECEIVE FASTER DISPATCH.';

                    }

                    else if (
                        selectedPriority ===
                        'Medium'
                    ) {

                        priorityNote.textContent =
                            'MEDIUM PRIORITY REQUESTS FOLLOW STANDARD DISPATCH.';

                    }

                    else {

                        priorityNote.textContent =
                            'NORMAL REQUESTS ARE PROCESSED BASED ON PROVIDER AVAILABILITY.';

                    }

                }
            );

        }
    );


    /*
    ===================================
    AREA
    ===================================
    */

    const areaSelect =
        document.getElementById(
            'emergencyArea'
        );

    const currentArea =
        document.getElementById(
            'currentArea'
        );


    areaSelect.addEventListener(
        'change',
        function () {

            currentArea.textContent =
                this.value;

        }
    );


    /*
    ===================================
    FORM
    ===================================
    */

    const emergencyForm =
        document.getElementById(
            'emergencyForm'
        );

    const errorBox =
        document.getElementById(
            'emergencyFormError'
        );

    const successBox =
        document.getElementById(
            'emergencyFormSuccess'
        );


    emergencyForm.addEventListener(
        'submit',
        function (event) {
            
/*FORM VALIDATION*/

const emergencyForm =
    document.getElementById(
        'emergencyForm'
    );

const errorBox =
    document.getElementById(
        'emergencyFormError'
    );


emergencyForm.addEventListener(
    'submit',
    function (event) {

        errorBox.style.display =
            'none';


        const address =
            document
                .getElementById(
                    'detailedAddress'
                )
                .value
                .trim();


        const description =
            document
                .getElementById(
                    'problemDescription'
                )
                .value
                .trim();


        if (!address) {

            event.preventDefault();

            errorBox.textContent =
                'Please enter your detailed address.';

            errorBox.style.display =
                'block';

            return;
        }


        if (!description) {

            event.preventDefault();

            errorBox.textContent =
                'Please describe what happened.';

            errorBox.style.display =
                'block';

            return;
        }

    }
);

            if (!description) {

                errorBox.textContent =
                    'Please describe what happened.';

                errorBox.style.display =
                    'block';

                return;

            }


            const requestReference =
                'REQ-' +
                Date.now()
                    .toString()
                    .slice(-6);


            successBox.innerHTML =
                '<strong>Request Created</strong><br>' +
                'Reference: ' +
                requestReference +
                '<br>' +
                currentService.textContent +
                ' · ' +
                currentPriority.textContent +
                ' · ' +
                currentArea.textContent;


            successBox.style.display =
                'block';

        }
    );

});
</script>

@endsection