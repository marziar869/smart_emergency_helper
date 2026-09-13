<nav class="main-navbar">


    <div class="navbar-container">



        <!-- LOGO -->

        <div class="brand-logo">

            SMART EMERGENCY HELPER

        </div>





        <!-- MENU -->

        <div class="nav-menu">


            <a href="/">
                HOME
            </a>


            <a href="/services">
                SERVICES
            </a>


            <a href="/providers">
                PROVIDERS
            </a>


            <a href="/about">
                ABOUT
            </a>


            <a href="/contact">
                CONTACT
            </a>



        </div>







        <!-- RIGHT BUTTON -->

        <div class="nav-actions">
            @auth
                @php
                    $role = auth()->user()->role;
                    $dashRoute = match($role) {
                        'provider' => route('provider.dashboard'),
                        'admin' => route('admin.dashboard'),
                        default => route('customer.dashboard'),
                    };
                @endphp
                <a href="{{ $dashRoute }}" class="nav-login">
                    DASHBOARD
                </a>
                <form method="POST" action="{{ route('demo.logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="nav-emergency" style="border: none; cursor: pointer; background: #e11d48;">
                        LOGOUT
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-login">
                    SIGN IN
                </a>
                <a href="{{ route('request.emergency') }}" class="nav-emergency">
                    REQUEST EMERGENCY
                </a>
            @endauth
        </div>




    </div>


</nav>