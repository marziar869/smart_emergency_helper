@extends('layouts.app')

@section('content')

<section class="services-hero">
    <div class="services-container">
        <div class="section-label">
            LIVE CATALOGUE · DYNAMIC CATEGORIES
        </div>
        <h1>Service catalogue</h1>
        <p>
            Each vertical carries a default priority tier and target response window. Managed dynamically from the admin dashboard.
        </p>
    </div>
</section>

<section class="services-list">
    <div class="services-container">

    @foreach($serviceCategories as $groupName => $categories)
        <div class="service-category">
            <div class="category-header">
                <span class="dot {{ strtolower($groupName) == 'emergency' ? 'red' : (strtolower($groupName) == 'technical' ? 'blue' : 'black') }}"></span>
                <h3>{{ strtoupper($groupName) }}</h3>
                <small>{{ count($categories) }} SERVICES</small>
            </div>

            <div class="service-grid">
                @foreach($categories as $category)
                    <div class="service-card {{ strtolower($groupName) == 'emergency' ? 'red-border' : (strtolower($groupName) == 'technical' ? 'blue-border' : 'black-border') }}">
                        <h2>{{ $category->name }}</h2>
                        <p>
                            Verified {{ $category->name }} providers for immediate response. {{ $category->provider_profiles_count ?? 0 }} active providers ready.
                        </p>

                        <div class="service-meta">
                            <span>ETA 15–30 MIN</span>
                            <b class="{{ strtolower($groupName) == 'emergency' ? 'critical' : (strtolower($groupName) == 'technical' ? 'high' : 'normal') }}">
                                {{ strtolower($groupName) == 'emergency' ? 'CRITICAL' : (strtolower($groupName) == 'technical' ? 'HIGH' : 'NORMAL') }}
                            </b>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    </div>
</section>

<section class="services-action">
    <div class="services-container">
        <a href="{{ route('emergency.form') }}" class="btn-primary">
            REQUEST A SERVICE
        </a>

        <a href="{{ route('providers') }}" class="btn-secondary">
            BROWSE PROVIDERS
        </a>
    </div>
</section>

@endsection