<style>
/* =========================================================
   HOMEPAGE NAVBAR STYLES (EMBEDDED IN BLADE)
   ========================================================= */
.main-navbar {
    background: #ffffff;
    border-bottom: 2px solid #e2e8f0;
    padding: 10px 0;
    position: sticky;
    top: 0;
    z-index: 1000;
}
.navbar-container {
    max-width: 1040px;
    margin: 0 auto;
    padding: 0 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
}
.brand-logo {
    font-size: 15px;
    font-weight: 900;
    color: #dc2626;
    letter-spacing: 0.5px;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 6px;
}
.brand-logo:hover {
    color: #b91c1c;
    text-decoration: none;
}
.nav-menu {
    display: flex;
    gap: 16px;
    list-style: none;
    margin: 0;
    padding: 0;
}
.nav-menu a {
    color: #334155;
    font-size: 11px;
    font-weight: 700;
    text-decoration: none;
    letter-spacing: 0.3px;
    transition: color 0.15s;
}
.nav-menu a:hover {
    color: #dc2626;
    text-decoration: none;
}
.nav-actions {
    display: flex;
    align-items: center;
    gap: 10px;
}
.nav-login {
    font-size: 11px;
    font-weight: 700;
    color: #0f172a;
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 4px;
    background: #f8fafc;
    border: 1px solid #cbd5e1;
}
.nav-login:hover {
    background: #e2e8f0;
    text-decoration: none;
}
.nav-emergency {
    background: #dc2626;
    color: #ffffff;
    font-size: 11px;
    font-weight: 800;
    padding: 6px 12px;
    border-radius: 4px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    border: none;
}
.nav-emergency:hover {
    background: #b91c1c;
    color: #ffffff;
    text-decoration: none;
}
@media (max-width: 640px) {
    .navbar-container {
        flex-direction: column;
        align-items: flex-start;
    }
    .nav-menu {
        flex-wrap: wrap;
        gap: 10px;
    }
}
</style>

<nav class="main-navbar">
    <div class="navbar-container">
        <!-- BRAND LOGO -->
        <a href="{{ route('home') }}" class="brand-logo">
            SMART EMERGENCY HELPER
        </a>

        <!-- MENU -->
        <div class="nav-menu">
            <a href="{{ route('home') }}">HOME</a>
            <a href="{{ route('services') }}">SERVICES</a>
            <a href="{{ route('providers') }}">PROVIDERS</a>
            <a href="{{ route('about') }}">ABOUT</a>
            <a href="{{ route('contact') }}">CONTACT</a>
        </div>

        <!-- AUTH ACTIONS -->
        <div class="nav-actions">
            @auth
                @if(auth()->user()->role === 'provider')
                    <a href="{{ route('provider.dashboard') }}" class="nav-login">DASHBOARD</a>
                @elseif(auth()->user()->role === 'customer')
                    <a href="{{ route('customer.dashboard') }}" class="nav-login">DASHBOARD</a>
                @else
                    <a href="{{ route('admin.dashboard') }}" class="nav-login">DASHBOARD</a>
                @endif

                <form method="POST" action="{{ route('demo.logout') }}" style="display:inline; margin:0;">
                    @csrf
                    <button type="submit" class="nav-emergency" style="cursor:pointer;">
                        LOGOUT
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-login">SIGN IN</a>
                <a href="{{ route('emergency.form') }}" class="nav-emergency">
                    REQUEST EMERGENCY
                </a>
            @endauth
        </div>
    </div>
</nav>