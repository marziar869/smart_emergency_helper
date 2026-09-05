@extends('layouts.app')


@section('content')


<section class="services-hero">

    <div class="services-container">

        <div class="section-label">
            9 SERVICES · 3 GROUPS
        </div>


        <h1>
            Service catalogue
        </h1>


        <p>
            Each vertical carries a default priority tier and target response
            window. Admin can enable, disable or extend the catalogue from the
            admin dashboard.
        </p>

    </div>

</section>




<section class="services-list">

<div class="services-container">



<!-- ================= EMERGENCY ================= -->

<div class="service-category">


    <div class="category-header">

        <span class="dot red"></span>

        <h3>EMERGENCY</h3>

        <small>3 SERVICES</small>

    </div>



    <div class="service-grid">



        <div class="service-card red-border">

            <h2>
                Ambulance
            </h2>

            <p>
                Critical care transport with hospital hand-off
            </p>


            <div class="service-meta">

                <span>
                    ETA 15–30 MIN
                </span>

                <b class="critical">
                    CRITICAL
                </b>

            </div>

        </div>




        <div class="service-card red-border">

            <h2>
                Blood Donor
            </h2>

            <p>
                Group-matched donor assistance
            </p>


            <div class="service-meta">

                <span>
                    ETA 20–40 MIN
                </span>

                <b class="critical">
                    CRITICAL
                </b>

            </div>

        </div>




        <div class="service-card red-border">

            <h2>
                Home Nurse
            </h2>

            <p>
                In-residence medical supervision
            </p>


            <div class="service-meta">

                <span>
                    ETA 30–60 MIN
                </span>

                <b class="medium">
                    MEDIUM
                </b>

            </div>

        </div>


    </div>


</div>







<!-- ================= TECHNICAL ================= -->

<div class="service-category">


    <div class="category-header">

        <span class="dot blue"></span>

        <h3>
            TECHNICAL
        </h3>

        <small>
            4 SERVICES
        </small>

    </div>



    <div class="service-grid">



        <div class="service-card blue-border">

            <h2>
                Electrician
            </h2>

            <p>
                Short circuits, wiring, distribution boards
            </p>


            <div class="service-meta">

                <span>
                    ETA 15–30 MIN
                </span>

                <b class="high">
                    HIGH
                </b>

            </div>

        </div>





        <div class="service-card blue-border">

            <h2>
                Plumber
            </h2>

            <p>
                Pipe leaks, mains failure, drainage
            </p>


            <div class="service-meta">

                <span>
                    ETA 20–35 MIN
                </span>

                <b class="high">
                    HIGH
                </b>

            </div>

        </div>





        <div class="service-card blue-border">

            <h2>
                AC Technician
            </h2>

            <p>
                HVAC failure, gas refill, compressor
            </p>


            <div class="service-meta">

                <span>
                    ETA 30–60 MIN
                </span>

                <b class="medium">
                    MEDIUM
                </b>

            </div>

        </div>





        <div class="service-card blue-border">

            <h2>
                Locksmith
            </h2>

            <p>
                Lockouts, key cutting, lock replacement
            </p>


            <div class="service-meta">

                <span>
                    ETA 15–30 MIN
                </span>

                <b class="medium">
                    MEDIUM
                </b>

            </div>

        </div>



    </div>


</div>







<!-- ================= HOME ================= -->


<div class="service-category">


    <div class="category-header">

        <span class="dot black"></span>

        <h3>
            HOME
        </h3>

        <small>
            2 SERVICES
        </small>

    </div>




    <div class="service-grid">



        <div class="service-card black-border">

            <h2>
                Cleaner
            </h2>

            <p>
                Deep clean and post-incident cleanup
            </p>


            <div class="service-meta">

                <span>
                    ETA SAME DAY
                </span>

                <b class="normal">
                    NORMAL
                </b>

            </div>

        </div>






        <div class="service-card black-border">

            <h2>
                Carpenter
            </h2>

            <p>
                Door, furniture and fitting repair
            </p>


            <div class="service-meta">

                <span>
                    ETA SAME DAY
                </span>

                <b class="normal">
                    NORMAL
                </b>

            </div>

        </div>



    </div>


</div>




</div>

</section>







<section class="services-action">

<div class="services-container">


<a href="#" class="btn-primary">
    REQUEST A SERVICE
</a>


<a href="#" class="btn-secondary">
    BROWSE PROVIDERS
</a>



</div>

</section>




@endsection