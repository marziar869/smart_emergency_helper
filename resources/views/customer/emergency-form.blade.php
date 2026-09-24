@extends('layouts.app')

@section('title', 'Request Emergency Assistance — Smart Emergency Helper')

@section('content')

<style>
/* =========================================================
   EMERGENCY FORM STYLES (EMBEDDED IN BLADE)
   ========================================================= */

.emergency-form-page {
    background-color: #f8fafc;
    min-height: 100vh;
    padding: 24px 0 40px;
}
.emergency-form-container {
    max-width: 980px;
    margin: 0 auto;
    padding: 0 16px;
}

/* Header */
.emergency-header-box {
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
.emergency-eyebrow {
    font-size: 9.5px;
    font-weight: 800;
    color: #dc2626;
    letter-spacing: 0.8px;
    margin-bottom: 2px;
}
.emergency-header-box h1 {
    font-size: 18px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}
.emergency-subtitle {
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

/* Grid */
.emergency-form-grid {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 16px;
}

/* Main Form Card */
.emergency-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 20px;
}
.form-field-row {
    margin-bottom: 14px;
}
.form-field-row label {
    display: block;
    font-size: 10px;
    font-weight: 800;
    color: #475569;
    margin-bottom: 4px;
    letter-spacing: 0.3px;
    text-transform: uppercase;
}
.form-field-row select,
.form-field-row input,
.form-field-row textarea {
    width: 100%;
    padding: 7px 10px;
    font-size: 12px;
    border: 1px solid #cbd5e1;
    border-radius: 4px;
    background: #ffffff;
    color: #0f172a;
    box-sizing: border-box;
}
.form-field-row select:focus,
.form-field-row input:focus,
.form-field-row textarea:focus {
    outline: none;
    border-color: #dc2626;
}

.category-toggle-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 6px;
}
.cat-btn {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    padding: 7px 4px;
    font-size: 10.5px;
    font-weight: 800;
    color: #475569;
    border-radius: 4px;
    cursor: pointer;
    text-align: center;
}
.cat-btn.active {
    background: #0f172a;
    color: #ffffff;
    border-color: #0f172a;
}

.priority-toggle-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 6px;
}
.p-btn {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    padding: 6px 2px;
    font-size: 10px;
    font-weight: 800;
    color: #475569;
    border-radius: 4px;
    cursor: pointer;
    text-align: center;
}
.p-btn.active.p-crit { background: #dc2626; color: #ffffff; border-color: #dc2626; }
.p-btn.active.p-high { background: #d97706; color: #ffffff; border-color: #d97706; }
.p-btn.active.p-med  { background: #0284c7; color: #ffffff; border-color: #0284c7; }
.p-btn.active.p-norm { background: #475569; color: #ffffff; border-color: #475569; }

.two-col-fields {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

.btn-emergency-submit {
    width: 100%;
    background: #dc2626;
    color: #ffffff;
    border: none;
    padding: 10px 14px;
    font-size: 12.5px;
    font-weight: 800;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 8px;
    transition: background 0.15s;
}
.btn-emergency-submit:hover {
    background: #b91c1c;
}

/* Sidebar */
.sidebar-panel {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 16px;
    margin-bottom: 14px;
}
.sidebar-panel h3 {
    font-size: 11px;
    font-weight: 800;
    color: #0f172a;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 6px;
    margin-bottom: 10px;
    letter-spacing: 0.5px;
}
.step-item-sm {
    display: flex;
    gap: 8px;
    align-items: center;
    font-size: 11px;
    color: #334155;
    margin-bottom: 8px;
}
.step-num-sm {
    font-size: 9px;
    font-weight: 900;
    color: #dc2626;
    background: #fee2e2;
    padding: 2px 5px;
    border-radius: 3px;
}

@media (max-width: 768px) {
    .emergency-form-grid,
    .two-col-fields {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="emergency-form-page">
    <div class="emergency-form-container">

        <!-- HEADER -->
        <div class="emergency-header-box">
            <div>
                <div class="emergency-eyebrow">CUSTOMER CONSOLE · RAPID DISPATCH</div>
                <h1>REQUEST EMERGENCY ASSISTANCE</h1>
                <p class="emergency-subtitle">System will identify the nearest verified responder in Dhaka.</p>
            </div>
            <div>
                <a href="{{ route('home') }}" class="btn-nav-link">Home</a>
            </div>
        </div>

        <div class="emergency-form-grid">
            <!-- MAIN FORM CARD -->
            <div class="emergency-card">
                <form method="POST" action="{{ route('emergency.form.submit') }}">
                    @csrf
                    <input type="hidden" name="service_group" id="serviceGroupInput" value="Emergency">
                    <input type="hidden" name="priority" id="priorityInput" value="Critical">

                    <!-- SERVICE GROUP -->
                    <div class="form-field-row">
                        <label>Service Group</label>
                        <div class="category-toggle-grid">
                            <button type="button" class="cat-btn active" data-group="Emergency">EMERGENCY</button>
                            <button type="button" class="cat-btn" data-group="Technical">TECHNICAL</button>
                            <button type="button" class="cat-btn" data-group="Home">HOME</button>
                        </div>
                    </div>

                    <!-- SERVICE TYPE -->
                    <div class="form-field-row">
                        <label for="serviceType">Service Type</label>
                        <select name="service_type" id="serviceType" required>
                            <option value="Ambulance">Ambulance</option>
                            <option value="Blood Donor">Blood Donor</option>
                            <option value="Home Nurse">Home Nurse</option>
                        </select>
                    </div>

                    <!-- PRIORITY -->
                    <div class="form-field-row">
                        <label>Priority Level</label>
                        <div class="priority-toggle-grid">
                            <button type="button" class="p-btn p-crit active" data-priority="Critical">CRITICAL</button>
                            <button type="button" class="p-btn p-high" data-priority="High">HIGH</button>
                            <button type="button" class="p-btn p-med" data-priority="Medium">MEDIUM</button>
                            <button type="button" class="p-btn p-norm" data-priority="Normal">NORMAL</button>
                        </div>
                    </div>

                    <!-- AREA & ADDRESS -->
                    <div class="two-col-fields">
                        <div class="form-field-row">
                            <label for="emergencyArea">Dhaka Area</label>
                            <select name="area" id="emergencyArea" required>
                                <option value="Dhanmondi">Dhanmondi</option>
                                <option value="Mirpur">Mirpur</option>
                                <option value="Uttara">Uttara</option>
                                <option value="Banani">Banani</option>
                                <option value="Mohammadpur">Mohammadpur</option>
                                <option value="Gulshan">Gulshan</option>
                            </select>
                        </div>

                        <div class="form-field-row">
                            <label for="detailedAddress">Detailed Address</label>
                            <input type="text" id="detailedAddress" name="address" placeholder="e.g. Road 8A, House 42" required>
                        </div>
                    </div>

                    <!-- DESCRIPTION -->
                    <div class="form-field-row">
                        <label for="problemDescription">Description</label>
                        <textarea id="problemDescription" name="description" rows="3" placeholder="Briefly describe what happened..." required></textarea>
                    </div>

                    <button type="submit" class="btn-emergency-submit">
                        CREATE REQUEST &amp; DISPATCH &rarr;
                    </button>
                </form>
            </div>

            <!-- SIDEBAR -->
            <aside>
                <div class="sidebar-panel">
                    <h3>5 DISPATCH STEPS</h3>
                    <div class="step-item-sm"><span class="step-num-sm">01</span> <span>Pending Request</span></div>
                    <div class="step-item-sm"><span class="step-num-sm">02</span> <span>Accepted by Responder</span></div>
                    <div class="step-item-sm"><span class="step-num-sm">03</span> <span>On The Way to Site</span></div>
                    <div class="step-item-sm"><span class="step-num-sm">04</span> <span>Arrival PIN Verification</span></div>
                    <div class="step-item-sm"><span class="step-num-sm">05</span> <span>Completion PIN & Cash Fee</span></div>
                </div>

                <div class="sidebar-panel">
                    <h3>SERVICE SAFETY</h3>
                    <div style="font-size:11px; color:#475569; display:flex; flex-direction:column; gap:6px;">
                        <div>✓ 4-Digit Arrival PIN</div>
                        <div>✓ 4-Digit Completion PIN</div>
                        <div>✓ Fixed BDT Cash Fee</div>
                    </div>
                </div>
            </aside>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const groupBtns = document.querySelectorAll('.cat-btn');
    const groupInput = document.getElementById('serviceGroupInput');
    const serviceSelect = document.getElementById('serviceType');
    const priorityBtns = document.querySelectorAll('.p-btn');
    const priorityInput = document.getElementById('priorityInput');

    const serviceMap = {
        'Emergency': ['Ambulance', 'Blood Donor', 'Home Nurse'],
        'Technical': ['Electrician', 'Plumber', 'AC Technician'],
        'Home': ['Cleaner', 'Carpenter']
    };

    groupBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            groupBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const grp = this.dataset.group;
            groupInput.value = grp;

            serviceSelect.innerHTML = '';
            (serviceMap[grp] || []).forEach(svc => {
                const opt = document.createElement('option');
                opt.value = svc;
                opt.textContent = svc;
                serviceSelect.appendChild(opt);
            });
        });
    });

    priorityBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            priorityBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            priorityInput.value = this.dataset.priority;
        });
    });
});
</script>

@endsection