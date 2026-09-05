document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       CONTACT PAGE TOPIC SELECTOR
    ===================================================== */

    const topicButtons =
        document.querySelectorAll('.contact-topic-btn');

    const topicInput =
        document.getElementById('contactTopic');


    if (topicButtons.length > 0 && topicInput) {

        topicButtons.forEach(function (button) {

            button.addEventListener('click', function () {

                topicButtons.forEach(function (btn) {

                    btn.classList.remove('active');

                });


                this.classList.add('active');


                topicInput.value =
                    this.dataset.topic;

            });

        });

    }

});

    document.addEventListener('DOMContentLoaded', function () {

    const roleButtons =
        document.querySelectorAll('.seh-role-btn');

    const roleInput =
        document.getElementById('sehLoginRole');


    if (roleButtons.length > 0 && roleInput) {

        roleButtons.forEach(function (button) {

            button.addEventListener('click', function () {

                roleButtons.forEach(function (btn) {

                    btn.classList.remove('active');

                });


                this.classList.add('active');


                roleInput.value =
                    this.dataset.role;

            });

        });

    }

});
document.addEventListener('DOMContentLoaded', function () {


    /* =====================================================
       SIGN IN ROLE SELECTOR
    ===================================================== */

    const roleButtons =
        document.querySelectorAll('.seh-role-btn');

    const roleInput =
        document.getElementById('sehLoginRole');


    if (roleButtons.length && roleInput) {

        roleButtons.forEach(function (button) {

            button.addEventListener('click', function () {

                roleButtons.forEach(function (btn) {

                    btn.classList.remove('active');

                });


                this.classList.add('active');


                roleInput.value =
                    this.dataset.role;

            });

        });

    }



    /* =====================================================
       REQUEST SERVICE GROUP SELECTOR
    ===================================================== */

    const serviceGroupButtons =
        document.querySelectorAll('.seh-service-group-btn');


    if (serviceGroupButtons.length) {

        serviceGroupButtons.forEach(function (button) {

            button.addEventListener('click', function () {

                serviceGroupButtons.forEach(function (btn) {

                    btn.classList.remove('active');

                });


                this.classList.add('active');

            });

        });

    }



    /* =====================================================
       PRIORITY SELECTOR
    ===================================================== */

    const priorityButtons =
        document.querySelectorAll('.seh-priority-btn');

    const priorityInput =
        document.getElementById('sehPriorityValue');


    if (priorityButtons.length && priorityInput) {

        priorityButtons.forEach(function (button) {

            button.addEventListener('click', function () {

                priorityButtons.forEach(function (btn) {

                    btn.classList.remove('active');

                });


                this.classList.add('active');


                priorityInput.value =
                    this.dataset.priority;

            });

        });

    }


});
document.addEventListener('DOMContentLoaded', function () {


    /* =====================================================
       CUSTOMER CATEGORY
    ===================================================== */

    const customerCategoryButtons =
        document.querySelectorAll('.customer-category-btn');


    customerCategoryButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            customerCategoryButtons.forEach(function (btn) {

                btn.classList.remove('active');

            });


            this.classList.add('active');

        });

    });



    /* =====================================================
       CUSTOMER PRIORITY
    ===================================================== */

    const customerPriorityButtons =
        document.querySelectorAll('.customer-priority-btn');


    customerPriorityButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            customerPriorityButtons.forEach(function (btn) {

                btn.classList.remove('active');

            });


            this.classList.add('active');

        });

    });


});
document.addEventListener('DOMContentLoaded', function () {


    /* =====================================================
       PROVIDER AVAILABILITY
    ===================================================== */

    const availabilityButtons =
        document.querySelectorAll('.provider-availability-btn');

    const availabilityBadge =
        document.querySelector('.provider-current-availability');


    availabilityButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            availabilityButtons.forEach(function (btn) {

                btn.classList.remove('active');

            });


            this.classList.add('active');


            if (availabilityBadge) {

                const availability =
                    this.dataset.availability;


                if (availability === 'available') {

                    availabilityBadge.innerHTML =
                        '<span class="availability-dot"></span> AVAILABLE';

                }


                if (availability === 'busy') {

                    availabilityBadge.innerHTML =
                        '<span class="availability-dot"></span> BUSY';

                }


                if (availability === 'offline') {

                    availabilityBadge.innerHTML =
                        '<span class="availability-dot"></span> OFFLINE';

                }

            }

        });

    });



    /* =====================================================
       JOB STATUS
    ===================================================== */

    const providerStatusButtons =
        document.querySelectorAll('.provider-job-status-btn');

    const providerStatusInput =
        document.getElementById('providerJobStatus');


    providerStatusButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            providerStatusButtons.forEach(function (btn) {

                btn.classList.remove('active');

            });


            this.classList.add('active');


            if (providerStatusInput) {

                providerStatusInput.value =
                    this.dataset.status;

            }

        });

    });



    /* =====================================================
       STATUS SUBMIT DEMO
    ===================================================== */

    const providerStatusSubmit =
        document.getElementById('providerStatusSubmit');

    const providerStatusMessage =
        document.getElementById('providerStatusMessage');


    if (
        providerStatusSubmit &&
        providerStatusMessage
    ) {

        providerStatusSubmit.addEventListener(
            'click',
            function () {

                const selectedStatus =
                    providerStatusInput
                        ? providerStatusInput.value
                        : 'updated';


                providerStatusMessage.textContent =
                    'Status updated to: ' +
                    selectedStatus
                        .replaceAll('-', ' ')
                        .toUpperCase();


                providerStatusMessage.classList.add('show');

            }
        );

    }



    /* =====================================================
       AFTER PHOTO DEMO
    ===================================================== */

    const providerAfterPhoto =
        document.getElementById('providerAfterPhoto');

    const providerAfterStatus =
        document.getElementById('providerAfterStatus');


    if (
        providerAfterPhoto &&
        providerAfterStatus
    ) {

        providerAfterPhoto.addEventListener(
            'change',
            function () {

                if (this.files.length > 0) {

                    providerAfterStatus.textContent =
                        'AFTER PHOTO SELECTED';

                }

            }
        );

    }



    /* =====================================================
       ACCEPT / DECLINE DEMO
    ===================================================== */

    document
        .querySelectorAll('.provider-accept-btn')
        .forEach(function (button) {

            button.addEventListener('click', function () {

                this.textContent = 'ACCEPTED';

                this.disabled = true;

            });

        });


    document
        .querySelectorAll('.provider-decline-btn')
        .forEach(function (button) {

            button.addEventListener('click', function () {

                const card =
                    this.closest('.provider-alert-card');


                if (card) {

                    card.style.display = 'none';

                }

            });

        });


});
document.addEventListener('DOMContentLoaded', function () {

    const adminActionButtons =
        document.querySelectorAll('.admin-demo-action');

    const adminActionMessage =
        document.getElementById('adminActionMessage');


    adminActionButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            const message =
                this.dataset.message || 'Action completed.';


            if (adminActionMessage) {

                adminActionMessage.textContent = message;

                adminActionMessage.classList.add('show');

            }

        });

    });

});
/* =====================================================
   PROVIDER VERIFICATION OTP
===================================================== */

document.addEventListener("DOMContentLoaded", function(){


    const otpInputs = document.querySelectorAll(".otp-boxes input");


    /* =====================
       OTP AUTO MOVE
    ===================== */

    otpInputs.forEach((input,index)=>{


        input.addEventListener("input", function(){


            this.value = this.value.replace(/[^0-9]/g,'');


            if(this.value.length === 1 && index < otpInputs.length - 1){

                otpInputs[index + 1].focus();

            }


        });



        input.addEventListener("keydown", function(e){


            if(e.key === "Backspace" && this.value === "" && index > 0){

                otpInputs[index - 1].focus();

            }


        });


    });




    /* =====================
          TIMER
    ===================== */


    let time = 97;


    const timer = document.getElementById("timer");

    const expiredBox = document.getElementById("otpExpired");



    if(timer){


        const countdown = setInterval(function(){


            let minutes = Math.floor(time / 60);

            let seconds = time % 60;



            timer.textContent = 
            String(minutes).padStart(2,'0')
            +
            ":"
            +
            String(seconds).padStart(2,'0');



            time--;



            if(time < 0){


                clearInterval(countdown);


                timer.textContent="00:00";


                if(expiredBox){

                    expiredBox.style.display="block";

                }


            }



        },1000);



    }





    /* =====================
          VERIFY BUTTON
    ===================== */


    const verifyBtn = document.getElementById("verifyOtpBtn");


    if(verifyBtn){


        verifyBtn.addEventListener("click",function(){


            let otp="";


            otpInputs.forEach(function(input){

                otp += input.value;

            });



            if(otp.length === 6){

                alert("Phone OTP Verified Successfully");

            }

            else{

                alert("Please enter 6 digit OTP");

            }



        });



    }



});
/* =====================================================
   ADMIN DASHBOARD INTERACTIONS
===================================================== */

document.addEventListener("DOMContentLoaded", function () {

    /* =========================================
       1. TOP SERVICE CATEGORY TOOLTIP
    ========================================= */

    const serviceBars = document.querySelectorAll(".service-tooltip");

    serviceBars.forEach((bar) => {

        bar.addEventListener("mouseenter", function () {

            const tooltip = document.createElement("div");

            tooltip.className = "admin-tooltip";

            tooltip.textContent =
                `${this.dataset.label} = ${this.dataset.value}`;

            document.body.appendChild(tooltip);

            this._tooltip = tooltip;

        });


        bar.addEventListener("mousemove", function (e) {

            if (!this._tooltip) return;

            this._tooltip.style.left =
                (e.pageX + 12) + "px";

            this._tooltip.style.top =
                (e.pageY + 12) + "px";

        });


        bar.addEventListener("mouseleave", function () {

            if (this._tooltip) {

                this._tooltip.remove();

                this._tooltip = null;

            }

        });

    });



    /* =========================================
       2. PRIORITY MIX TOOLTIP
    ========================================= */

    const donut = document.querySelector(".priority-donut");

    if (donut) {

        donut.addEventListener("mousemove", function (e) {

            const rect = donut.getBoundingClientRect();

            const centerX =
                rect.left + rect.width / 2;

            const centerY =
                rect.top + rect.height / 2;


            const dx =
                e.clientX - centerX;

            const dy =
                e.clientY - centerY;


            let angle =
                Math.atan2(dy, dx) * 180 / Math.PI;


            angle += 90;


            if (angle < 0) {
                angle += 360;
            }


            let label = "";

            let value = "";


            if (angle < 45) {

                label = "Critical";

                value = donut.dataset.critical;

            }

            else if (angle < 118) {

                label = "High";

                value = donut.dataset.high;

            }

            else if (angle < 219) {

                label = "Medium";

                value = donut.dataset.medium;

            }

            else {

                label = "Normal";

                value = donut.dataset.normal;

            }


            let tooltip =
                donut._tooltip;


            if (!tooltip) {

                tooltip =
                    document.createElement("div");

                tooltip.className =
                    "admin-tooltip";

                document.body.appendChild(tooltip);

                donut._tooltip =
                    tooltip;

            }


            tooltip.textContent =
                `${label} = ${value}`;


            tooltip.style.left =
                (e.pageX + 12) + "px";

            tooltip.style.top =
                (e.pageY + 12) + "px";

        });


        donut.addEventListener("mouseleave", function () {

            if (donut._tooltip) {

                donut._tooltip.remove();

                donut._tooltip = null;

            }

        });

    }



    /* =========================================
       3. COMPLAINT DETAILS
    ========================================= */

    const complaintItems =
        document.querySelectorAll(".complaint-item");

    const complaintDetails =
        document.getElementById("complaintDetails");


    complaintItems.forEach((item) => {

        item.addEventListener("click", function () {

            complaintItems.forEach((box) => {

                box.classList.remove("selected");

            });


            this.classList.add("selected");


            if (!complaintDetails) return;


            complaintDetails.innerHTML = `

                <div class="complaint-detail-card">

                    <span class="complaint-detail-status">

                        ${this.dataset.status}

                    </span>


                    <h3>

                        #${this.dataset.complaintId}

                    </h3>


                    <p>

                        <strong>Customer:</strong>

                        ${this.dataset.customer}

                    </p>


                    <p>

                        <strong>Provider:</strong>

                        ${this.dataset.provider}

                    </p>


                    <p>

                        <strong>Issue:</strong>

                        ${this.dataset.reason}

                    </p>


                    <p>

                        <strong>Service:</strong>

                        ${this.dataset.service}

                    </p>


                    <p>

                        <strong>Amount:</strong>

                        ${this.dataset.amount}

                    </p>

                </div>

            `;

        });

    });



    /* =========================================
       4. MANAGE USERS
    ========================================= */

    const userButtons =
        document.querySelectorAll(".user-action-btn");


    userButtons.forEach((button) => {

        button.addEventListener("click", function () {

            const row =
                this.closest(".manage-user-row");


            if (!row) return;


            let status =
                row.querySelector(
                    ".user-active, .user-pending, .user-suspended"
                );


            const currentAction =
                this.dataset.action;


            if (currentAction === "suspend") {

                this.dataset.action =
                    "reinstate";

                this.textContent =
                    "REINSTATE";


                if (status) {

                    status.className =
                        "user-suspended";

                    status.textContent =
                        "SUSPENDED";

                }

            }

            else {

                this.dataset.action =
                    "suspend";

                this.textContent =
                    "SUSPEND";


                if (status) {

                    status.className =
                        "user-active";

                    status.textContent =
                        "ACTIVE";

                }

            }

        });

    });



    /* =========================================
       5. SERVICE CATEGORY ENABLE / DISABLE
    ========================================= */

    const categoryCards =
        document.querySelectorAll(".category-toggle");


    categoryCards.forEach((card) => {

        card.addEventListener("click", function () {

            const enabled =
                this.dataset.enabled === "true";


            const text =
                this.querySelector("span");


            if (enabled) {

                this.dataset.enabled =
                    "false";


                this.classList.add(
                    "disabled-category"
                );


                if (text) {

                    text.textContent =
                        text.textContent.replace(
                            "Enabled",
                            "Disabled"
                        );

                }

            }

            else {

                this.dataset.enabled =
                    "true";


                this.classList.remove(
                    "disabled-category"
                );


                if (text) {

                    text.textContent =
                        text.textContent.replace(
                            "Disabled",
                            "Enabled"
                        );

                }

            }

        });

    });

});
/* =====================================================
   ADMIN COMPLAINT ACTION BUTTONS
===================================================== */

document.addEventListener("DOMContentLoaded", function () {

    const complaintItems = document.querySelectorAll(".complaint-item");


    complaintItems.forEach((item) => {

        const status = item.querySelector(".complaint-state");

        const reviewBtn = item.querySelector(".complaint-review-btn");
        const resolveBtn = item.querySelector(".complaint-resolve-btn");
        const escalateBtn = item.querySelector(".complaint-escalate-btn");
        const suspendBtn = item.querySelector(".complaint-suspend-btn");


        /* ==========================
           REVIEW
        ========================== */

        if (reviewBtn) {

            reviewBtn.addEventListener("click", function (e) {

                e.stopPropagation();

                setComplaintStatus(
                    status,
                    "REVIEWING",
                    "state-review"
                );

            });

        }


        /* ==========================
           RESOLVE
        ========================== */

        if (resolveBtn) {

            resolveBtn.addEventListener("click", function (e) {

                e.stopPropagation();

                setComplaintStatus(
                    status,
                    "RESOLVED",
                    "state-resolved"
                );

            });

        }


        /* ==========================
           ESCALATE
        ========================== */

        if (escalateBtn) {

            escalateBtn.addEventListener("click", function (e) {

                e.stopPropagation();

                setComplaintStatus(
                    status,
                    "ESCALATED",
                    "state-escalated"
                );

            });

        }


        /* ==========================
           SUSPEND PROVIDER
        ========================== */

        if (suspendBtn) {

            suspendBtn.addEventListener("click", function (e) {

                e.stopPropagation();

                setComplaintStatus(
                    status,
                    "SUSPENDED",
                    "state-suspended"
                );

            });

        }

    });



    /* =================================================
       CHANGE STATUS
    ================================================= */

    function setComplaintStatus(statusElement, text, newClass) {

        if (!statusElement) {
            return;
        }


        statusElement.classList.remove(
            "state-open",
            "state-review",
            "state-resolved",
            "state-escalated",
            "state-suspended"
        );


        statusElement.classList.add(newClass);

        statusElement.textContent = text;

    }

});
/* =====================================================
   PROVIDER VERIFICATION REVIEW
===================================================== */

document.addEventListener("DOMContentLoaded", function () {

    const reviewChecks =
        document.querySelectorAll(".provider-review-check");

    const approveBtn =
        document.getElementById("approveProviderBtn");

    const correctionBtn =
        document.getElementById("requestCorrectionBtn");

    const rejectBtn =
        document.getElementById("rejectProviderBtn");

    const statusBox =
        document.getElementById("providerReviewStatus");

    const adminNote =
        document.getElementById("providerAdminNote");


    /* =================================================
       CHECKLIST
       সব checkbox tick হলে APPROVE active হবে
    ================================================= */

    function updateApproveButton() {

        if (!approveBtn || reviewChecks.length === 0) {
            return;
        }


        const allChecked =
            [...reviewChecks].every(
                checkbox => checkbox.checked
            );


        approveBtn.disabled = !allChecked;

    }


    reviewChecks.forEach((checkbox) => {

        checkbox.addEventListener(
            "change",
            updateApproveButton
        );

    });


    updateApproveButton();



    /* =================================================
       APPROVE
    ================================================= */

    if (approveBtn) {

        approveBtn.addEventListener("click", function () {

            if (this.disabled) {
                return;
            }


            if (statusBox) {

                statusBox.className =
                    "provider-review-status status-approved";

                statusBox.textContent =
                    "APPROVED";

            }


            this.textContent =
                "APPROVED";

        });

    }



    /* =================================================
       REQUEST CORRECTION
    ================================================= */

    if (correctionBtn) {

        correctionBtn.addEventListener(
            "click",
            function () {

                if (statusBox) {

                    statusBox.className =
                        "provider-review-status status-correction";

                    statusBox.textContent =
                        "CORRECTION REQUESTED";

                }


                if (
                    adminNote &&
                    adminNote.value.trim() === ""
                ) {

                    adminNote.focus();

                }

            }
        );

    }



    /* =================================================
       REJECT
    ================================================= */

    if (rejectBtn) {

        rejectBtn.addEventListener("click", function () {

            if (statusBox) {

                statusBox.className =
                    "provider-review-status status-rejected";

                statusBox.textContent =
                    "REJECTED";

            }

        });

    }

});
/* =====================================================
   CUSTOMER DASHBOARD
===================================================== */

document.addEventListener("DOMContentLoaded", function () {


    /* CATEGORY */

    const categoryButtons =
        document.querySelectorAll(".customer-category-btn");

    categoryButtons.forEach(button => {

        button.addEventListener("click", function () {

            categoryButtons.forEach(btn => {
                btn.classList.remove("active");
            });

            this.classList.add("active");

        });

    });



    /* PRIORITY */

    const priorityButtons =
        document.querySelectorAll(".customer-priority-btn");

    priorityButtons.forEach(button => {

        button.addEventListener("click", function () {

            priorityButtons.forEach(btn => {
                btn.classList.remove("active");
            });

            this.classList.add("active");

        });

    });



    /* EMERGENCY CONTACT */

    const notifyButtons =
        document.querySelectorAll(".notify-toggle");

    notifyButtons.forEach(button => {

        button.addEventListener("click", function () {

            this.classList.toggle("active");

            if (this.classList.contains("active")) {

                this.textContent = "NOTIFY ON";

            } else {

                this.textContent = "NOTIFY OFF";

            }

        });

    });



    /* =========================================
       REQUEST PROGRESS
    ========================================= */

    const requestSteps =
        document.querySelectorAll(".request-step");

    const advanceBtn =
        document.getElementById("advanceRequestStep");

    const resetBtn =
        document.getElementById("resetRequestStep");

    const currentStatus =
        document.getElementById("customerCurrentStatus");


    const statusNames = [

        "Pending",

        "Accepted",

        "On The Way",

        "Arrival PIN Required",

        "Arrived",

        "Before Photo",

        "Working",

        "After Photo",

        "Completion PIN Required",

        "Completed",

        "Rating / Review"

    ];


    let currentStep = 0;


    function updateRequestProgress() {

        requestSteps.forEach((step, index) => {

            step.classList.toggle(
                "active",
                index <= currentStep
            );

        });


        if (currentStatus) {

            currentStatus.textContent =
                statusNames[currentStep];

        }


        if (resetBtn) {

            resetBtn.disabled =
                currentStep === 0;

        }


        if (advanceBtn) {

            advanceBtn.disabled =
                currentStep >= requestSteps.length - 1;

        }

    }


    if (advanceBtn) {

        advanceBtn.addEventListener("click", function () {

            if (
                currentStep <
                requestSteps.length - 1
            ) {

                currentStep++;

                updateRequestProgress();

            }

        });

    }


    if (resetBtn) {

        resetBtn.addEventListener("click", function () {

            currentStep = 0;

            updateRequestProgress();

        });

    }


    updateRequestProgress();

});
/* =====================================================
   CUSTOMER PROFILE
===================================================== */

document.addEventListener("DOMContentLoaded", function () {

    const editBtn =
        document.getElementById("editCustomerProfileBtn");

    const saveBtn =
        document.getElementById("saveCustomerProfileBtn");

    const updateLocationBtn =
        document.getElementById("updateLocationBtn");

    const notificationBtn =
        document.getElementById("criticalNotificationBtn");


    const editableFields = [

        document.getElementById("customerProfileName"),

        document.getElementById("customerProfileEmail"),

        document.getElementById("customerProfilePhone"),

        document.getElementById("customerDefaultAddress"),

        document.getElementById("customerProfileArea"),

        document.getElementById("defaultEmergencyContact")

    ].filter(Boolean);



    /* EDIT PROFILE */

    if (editBtn) {

        editBtn.addEventListener("click", function () {

            editableFields.forEach(field => {
                field.disabled = false;
            });


            if (updateLocationBtn) {
                updateLocationBtn.disabled = false;
            }


            if (notificationBtn) {
                notificationBtn.disabled = false;
            }


            if (saveBtn) {
                saveBtn.disabled = false;
            }


            this.textContent = "EDITING";

        });

    }



    /* SAVE PROFILE */

    if (saveBtn) {

        saveBtn.addEventListener("click", function () {

            editableFields.forEach(field => {
                field.disabled = true;
            });


            if (updateLocationBtn) {
                updateLocationBtn.disabled = true;
            }


            if (notificationBtn) {
                notificationBtn.disabled = true;
            }


            this.disabled = true;


            if (editBtn) {
                editBtn.textContent = "EDIT PROFILE";
            }

        });

    }



    /* CRITICAL CONTACT TOGGLE */

    if (notificationBtn) {

        notificationBtn.addEventListener("click", function () {

            if (this.disabled) {
                return;
            }


            this.classList.toggle("active");


            if (this.classList.contains("active")) {

                this.textContent = "ENABLED";

            } else {

                this.textContent = "DISABLED";

            }

        });

    }



    /* CHANGE PASSWORD */

    const changePasswordBtn =
        document.getElementById("changePasswordBtn");


    if (changePasswordBtn) {

        changePasswordBtn.addEventListener("click", function () {

            const currentPassword =
                document.getElementById("currentPassword");

            const newPassword =
                document.getElementById("newPassword");

            const confirmPassword =
                document.getElementById("confirmNewPassword");


            if (
                !currentPassword.value ||
                !newPassword.value ||
                !confirmPassword.value
            ) {

                alert("Please complete all password fields.");

                return;

            }


            if (
                newPassword.value !==
                confirmPassword.value
            ) {

                alert("New passwords do not match.");

                return;

            }


            alert("Password changed successfully.");

            currentPassword.value = "";
            newPassword.value = "";
            confirmPassword.value = "";

        });

    }

});