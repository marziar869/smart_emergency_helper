@extends('layouts.app')

@section('content')

<section class="providers-hero">
    <div class="services-container">
        <div class="section-label">
            DIRECTORY · RANKED BY RECOMMENDATION SCORE
        </div>
        <h1>Provider directory</h1>
        <p>The same scoring engine that powers automatic dispatch, exposed as a browsable list.</p>
    </div>
</section>

<section class="providers-list">
    <div class="services-container">
        <div class="provider-filter">
            <a href="{{ route('providers') }}" class="btn {{ !request('group') ? 'active' : '' }}">ALL</a>
            <a href="{{ route('providers', ['group' => 'Emergency']) }}" class="btn {{ request('group') == 'Emergency' ? 'active' : '' }}">EMERGENCY</a>
            <a href="{{ route('providers', ['group' => 'Technical']) }}" class="btn {{ request('group') == 'Technical' ? 'active' : '' }}">TECHNICAL</a>
            <a href="{{ route('providers', ['group' => 'Home']) }}" class="btn {{ request('group') == 'Home' ? 'active' : '' }}">HOME</a>

            <span>{{ count($providers) }} MATCHES</span>
        </div>

        @forelse($providers as $provider)
            <div class="provider-card {{ $loop->first ? 'recommended' : '' }}">
                <div class="provider-score">
                    <h1>{{ min(99, 70 + ($provider->rating * 5) + min($provider->experience_years, 10)) }}</h1>
                    <span>SCORE</span>
                </div>

                <div class="provider-details">
                    <div class="provider-title">
                        <h2>{{ $provider->user->name ?? 'Verified Provider' }}</h2>

                        @if($provider->phone_verified)
                            <span class="verified-badge">VERIFIED PROVIDER</span>
                        @endif

                        @if($loop->first)
                            <span class="recommended-badge">RECOMMENDED</span>
                        @endif
                    </div>

                    <p>
                        {{ $provider->serviceCategory->name ?? 'Service' }} · {{ $provider->area }}
                    </p>

                    <div class="provider-info">
                        <span>★ {{ number_format($provider->rating, 1) }}</span>
                        <span>{{ $provider->total_reviews }} JOBS</span>
                        <span>{{ $provider->experience_years }} YRS EXP</span>
                        <span>HIGHLY TRUSTED</span>
                        <span>PRV-{{ 1000 + $provider->id }}</span>
                    </div>
                </div>

                <div class="provider-buttons">
                    <button class="{{ $provider->is_available ? 'available' : 'unavailable' }}">
                        {{ $provider->is_available ? 'AVAILABLE' : 'OFFLINE' }}
                    </button>

                    <a href="{{ route('providers.show', $provider->id) }}" class="view-btn" style="text-decoration:none; display:inline-block; text-align:center;">
                        VIEW PROVIDER
                    </a>

                    <a href="{{ route('emergency.form') }}" class="request-btn" style="text-decoration:none; display:inline-block; text-align:center;">
                        REQUEST SERVICE
                    </a>
                </div>
            </div>
        @empty
            <div class="no-providers" style="padding: 40px; text-align: center; background: #111; border-radius: 8px; margin-top: 20px;">
                <h3>No providers found matching your filter criteria.</h3>
            </div>
        @endforelse
    </div>
</section>

@endsection