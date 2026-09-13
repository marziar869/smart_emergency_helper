<?php

namespace App\Http\Controllers;

use App\Models\EmergencyRequest;
use App\Models\ServiceCategory;
use App\Models\ProviderProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmergencyRequestController extends Controller
{
    /**
     * Display Emergency Request Form
     */
    public function create()
    {
        $serviceCategories = ServiceCategory::where('is_active', true)->get();
        return view('customer.emergency-form', compact('serviceCategories'));
    }

    /**
     * Handle Emergency Form Submission & Smart Provider Matching
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_group' => ['nullable', 'string'],
            'service_type' => ['nullable', 'string'],
            'service_category_id' => ['nullable', 'integer', 'exists:service_categories,id'],
            'priority' => ['required', 'in:Critical,High,Medium,Normal'],
            'area' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
        ]);

        // Resolve ServiceCategory
        $serviceCategory = null;
        if (!empty($validated['service_category_id'])) {
            $serviceCategory = ServiceCategory::find($validated['service_category_id']);
        } elseif (!empty($validated['service_type'])) {
            $serviceCategory = ServiceCategory::where('name', $validated['service_type'])->first();
        }

        if (!$serviceCategory) {
            $serviceCategory = ServiceCategory::first();
        }

        // Resolve Customer User
        $customerId = null;
        if (Auth::check()) {
            $customerId = Auth::id();
        } else {
            // Find or create default customer user
            $customer = User::where('role', 'customer')->first();
            if (!$customer) {
                $customer = User::create([
                    'name' => 'Emergency Guest',
                    'email' => 'guest_' . time() . '@seh.com.bd',
                    'phone' => '+880170000' . rand(1000, 9999),
                    'password' => bcrypt('password'),
                    'role' => 'customer',
                    'area' => $validated['area'],
                    'address' => $validated['address'],
                    'is_active' => true,
                ]);
            }
            $customerId = $customer->id;
        }

        // Unique Reference
        do {
            $reference = 'REQ-' . random_int(100000, 999999);
        } while (EmergencyRequest::where('reference', $reference)->exists());

        // Recommendation Engine: Find best matching provider
        $matchingProviders = ProviderProfile::with('user')
            ->where('service_category_id', $serviceCategory->id)
            ->where('phone_verified', true)
            ->where('approval_status', 'approved')
            ->where('is_active', true)
            ->get();

        $scoredProviders = [];
        foreach ($matchingProviders as $provider) {
            $areaScore = (strcasecmp($provider->area, $validated['area']) === 0) ? 40 : 20;
            $availabilityScore = $provider->is_available ? 25 : 5;
            $ratingScore = ($provider->rating / 5) * 20;
            $experienceScore = min($provider->experience_years, 10) / 10 * 15;
            $totalScore = round($areaScore + $availabilityScore + $ratingScore + $experienceScore);

            $scoredProviders[] = [
                'provider' => $provider,
                'score' => $totalScore,
            ];
        }

        usort($scoredProviders, fn($a, $b) => $b['score'] <=> $a['score']);

        $assignedProviderId = null;
        $assignedProviderName = 'Broadcasting to nearby providers...';
        $attempts = [];

        if (!empty($scoredProviders)) {
            // Simulate dispatch sequence for UI demonstration
            if (count($scoredProviders) > 1) {
                $attempts[] = [
                    'provider' => $scoredProviders[1]['provider']->user->name ?? 'Nearby Provider 1',
                    'status' => 'DECLINED',
                ];
            }

            $bestProvider = $scoredProviders[0]['provider'];
            $assignedProviderId = $bestProvider->user_id;
            $assignedProviderName = $bestProvider->user->name ?? 'Verified Provider';

            $attempts[] = [
                'provider' => $assignedProviderName,
                'status' => 'ACCEPTED',
            ];
        } else {
            $attempts[] = [
                'provider' => 'No active local provider',
                'status' => 'EXPIRED',
            ];
        }

        // Save EmergencyRequest to Database
        $emergencyRequest = EmergencyRequest::create([

            'reference' => $reference,
            'customer_id' => $customerId,
            'service_category_id' => $serviceCategory->id,
            'priority' => $validated['priority'],
            'area' => $validated['area'],
            'address' => $validated['address'],
            'description' => $validated['description'],
            'assigned_provider_id' => $assignedProviderId,
            'status' => $assignedProviderId ? 'accepted' : 'pending',
        ]);

        $sessionData = [
            'id' => $emergencyRequest->id,
            'reference' => $emergencyRequest->reference,
            'group' => $serviceCategory->group_name,
            'service' => $serviceCategory->name,
            'priority' => $emergencyRequest->priority,
            'area' => $emergencyRequest->area,
            'address' => $emergencyRequest->address,
            'description' => $emergencyRequest->description,
            'assigned_provider' => $assignedProviderName,
            'attempts' => $attempts,
        ];

        session(['demo_emergency_request' => $sessionData]);

        return redirect()->route('emergency.result');
    }

    /**
     * Show Dispatch Result Page
     */
    public function showResult()
    {
        $emergency = session('demo_emergency_request');

        if (!$emergency) {
            return redirect()->route('emergency.form');
        }

        return view('customer.emergency-result', compact('emergency'));
    }
}