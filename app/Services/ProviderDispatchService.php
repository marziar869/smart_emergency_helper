<?php

namespace App\Services;

use App\Models\EmergencyRequest;
use App\Models\ProviderProfile;
use App\Models\ProviderRequestAttempt;

class ProviderDispatchService
{
    public function dispatch(EmergencyRequest $emergency): void
    {
        $providers = ProviderProfile::with('user')
            ->where('service_category_id', $emergency->service_category_id)
            ->where('phone_verified', true)
            ->where('approval_status', 'approved')
            ->where('is_active', true)
            ->where('is_available', true)
            ->get();

        foreach ($providers as $profile) {

            // Same-area provider gets full area score.
            $areaScore = strtolower(trim($profile->area))
                === strtolower(trim($emergency->area))
                ? 100
                : 0;

            $availabilityScore = $profile->is_available ? 100 : 0;

            // Rating is assumed to be stored out of 5.
            $ratingScore = min(
                100,
                ((float) $profile->rating / 5) * 100
            );

            // Here we treat 10 years as maximum experience score.
            $experienceScore = min(
                100,
                ((int) $profile->experience_years / 10) * 100
            );

            $recommendationScore =
                ($areaScore * 0.40) +
                ($availabilityScore * 0.25) +
                ($ratingScore * 0.20) +
                ($experienceScore * 0.15);

            ProviderRequestAttempt::create([
                'emergency_request_id' => $emergency->id,
                'provider_id' => $profile->user_id,

                'area_score' => $areaScore,
                'availability_score' => $availabilityScore,
                'rating_score' => $ratingScore,
                'experience_score' => $experienceScore,

                'recommendation_score' => $recommendationScore,

                'status' => 'waiting',
            ]);
        }

        $bestAttempt = ProviderRequestAttempt::where(
                'emergency_request_id',
                $emergency->id
            )
            ->orderByDesc('recommendation_score')
            ->first();

        if ($bestAttempt) {

            $bestAttempt->update([
                'status' => 'offered',
                'expires_at' => now()->addMinutes(2),
            ]);

            $emergency->update([
                'status' => 'provider_offered',
            ]);

        } else {

            $emergency->update([
                'status' => 'no_provider_available',
            ]);
        }
    }
}
