<?php

namespace App\Http\Controllers;

use App\Models\ProviderProfile;
use App\Models\EmergencyRequest;


class ProviderRecommendationController extends Controller
{


public function recommend($requestId)
{

    $emergency = EmergencyRequest::findOrFail($requestId);


    $providers = ProviderProfile::with('user')
        ->where(
            'service_category_id',
            $emergency->service_category_id
        )

        ->where(
            'area',
            $emergency->area
        )

        ->where(
            'phone_verified',
            1
        )

        ->where(
            'approval_status',
            'approved'
        )

        ->where(
            'is_active',
            1
        )

        ->where(
            'is_available',
            1
        )

        ->get();



    $recommended=[];



    foreach($providers as $provider)
    {


        // Area match
        $areaScore = 40;



        // Availability
        $availabilityScore = 25;



        // Rating (5 star scale)
        $ratingScore =
        ($provider->rating / 5) * 20;



        // Experience max 10 years
        $experienceScore =
        min($provider->experience_years,10)
        /10 *15;



        $totalScore =
        $areaScore +
        $availabilityScore +
        $ratingScore +
        $experienceScore;



        $recommended[]=[

            "provider_id"=>$provider->id,

            "name"=>$provider->user->name,

            "area"=>$provider->area,

            "rating"=>$provider->rating,

            "experience"=>$provider->experience_years,

            "score"=>round($totalScore)

        ];


    }



    $recommended =
    collect($recommended)
    ->sortByDesc('score')
    ->values();



    return response()->json([

        "request_id"=>$requestId,

        "providers"=>$recommended

    ]);


}



}