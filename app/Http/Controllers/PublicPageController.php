<?php

namespace App\Http\Controllers;

use App\Models\ProviderProfile;
use App\Models\ServiceCategory;
use App\Models\EmergencyRequest;
use App\Models\User;
use Illuminate\Http\Request;

class PublicPageController extends Controller
{
    /**
     * Home Page
     */
    public function home()
    {
        $totalRequests = EmergencyRequest::count();
        $totalProviders = ProviderProfile::where('approval_status', 'approved')
            ->where('phone_verified', true)
            ->count();
        $activeCategories = ServiceCategory::where('is_active', true)->count();

        $serviceCategories = ServiceCategory::where('is_active', true)
            ->get()
            ->groupBy('group_name');

        $featuredProviders = ProviderProfile::with(['user', 'serviceCategory'])
            ->where('approval_status', 'approved')
            ->where('is_active', true)
            ->orderByDesc('rating')
            ->take(6)
            ->get();

        return view('home', compact(
            'totalRequests',
            'totalProviders',
            'activeCategories',
            'serviceCategories',
            'featuredProviders'
        ));
    }

    /**
     * Services Page
     */
    public function services()
    {
        $serviceCategories = ServiceCategory::where('is_active', true)
            ->withCount(['providerProfiles' => function ($query) {
                $query->where('approval_status', 'approved')->where('is_active', true);
            }])
            ->get()
            ->groupBy('group_name');

        return view('services', compact('serviceCategories'));
    }

    /**
     * Providers Directory Page
     */
    public function providers(Request $request)
    {
        $query = ProviderProfile::with(['user', 'serviceCategory'])
            ->where('approval_status', 'approved')
            ->where('is_active', true);

        // Filter by Group
        if ($request->filled('group')) {
            $query->whereHas('serviceCategory', function ($q) use ($request) {
                $q->where('group_name', $request->group);
            });
        }

        // Filter by Category ID or Name
        if ($request->filled('category')) {
            $query->whereHas('serviceCategory', function ($q) use ($request) {
                $q->where('name', $request->category)
                  ->orWhere('id', $request->category);
            });
        }

        // Filter by Verified Only (Default true)
        if ($request->boolean('verified_only', true)) {
            $query->where('phone_verified', true);
        }

        // Filter by Available Only
        if ($request->boolean('available_only')) {
            $query->where('is_available', true);
        }

        // Search by Area or Provider Name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('area', 'ILIKE', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'ILIKE', "%{$search}%");
                  });
            });
        }

        $providers = $query->orderByDesc('rating')->get();
        $categories = ServiceCategory::where('is_active', true)->get();

        return view('providers', compact('providers', 'categories'));
    }

    /**
     * Single Provider Details Page
     */
    public function providerDetails($id)
    {
        $provider = ProviderProfile::with(['user', 'serviceCategory'])
            ->where('id', $id)
            ->orWhere('user_id', $id)
            ->firstOrFail();

        $completedJobsCount = EmergencyRequest::where('assigned_provider_id', $provider->user_id)
            ->where('status', 'completed')
            ->count();

        return view('provider-details', compact('provider', 'completedJobsCount'));
    }
}
