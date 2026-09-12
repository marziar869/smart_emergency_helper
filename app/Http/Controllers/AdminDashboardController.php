<?php

namespace App\Http\Controllers;

use App\Models\ProviderProfile;
use App\Models\EmergencyRequest;
use App\Models\User;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    private function checkAdmin()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return true;
        }

        if (session('demo_logged_in') && session('demo_role') === 'admin') {
            return true;
        }

        return false;
    }

    /**
     * Admin Dashboard
     */
    public function index()
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('login');
        }

        $activeJobsCount = EmergencyRequest::whereIn('status', ['accepted', 'working'])->count();
        $providersOnlineCount = ProviderProfile::where('is_available', true)->where('approval_status', 'approved')->count();
        $completed30DCount = EmergencyRequest::where('status', 'completed')->where('created_at', '>=', now()->subDays(30))->count();
        $pendingVerifyCount = ProviderProfile::where('approval_status', 'pending')->count();

        $totalUsersCount = User::where('role', 'customer')->count();
        $totalProvidersCount = ProviderProfile::count();
        $completedRequestsCount = EmergencyRequest::where('status', 'completed')->count();
        $pendingRequestsCount = EmergencyRequest::where('status', 'pending')->count();

        $providerApplications = ProviderProfile::with(['user', 'serviceCategory'])
            ->where('approval_status', 'pending')
            ->latest()
            ->get();

        $recentRequests = EmergencyRequest::with(['customer', 'assignedProvider', 'serviceCategory'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'activeJobsCount',
            'providersOnlineCount',
            'completed30DCount',
            'pendingVerifyCount',
            'totalUsersCount',
            'totalProvidersCount',
            'completedRequestsCount',
            'pendingRequestsCount',
            'providerApplications',
            'recentRequests'
        ));
    }

    /**
     * Review Pending Provider Verification
     */
    public function reviewVerification($id)
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('login');
        }

        $provider = ProviderProfile::with(['user', 'serviceCategory'])
            ->where('id', $id)
            ->orWhere('user_id', $id)
            ->firstOrFail();

        return view('admin.provider-verification-review', compact('provider'));
    }

    /**
     * Approve Provider Application
     */
    public function approveVerification($id)
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('login');
        }

        $provider = ProviderProfile::where('id', $id)
            ->orWhere('user_id', $id)
            ->firstOrFail();

        $provider->update([
            'approval_status' => 'approved',
            'approved_at' => now(),
            'is_active' => true,
            'is_available' => true,
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Provider ' . ($provider->user->name ?? '') . ' application has been approved.');
    }

    /**
     * Reject Provider Application
     */
    public function rejectVerification($id)
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('login');
        }

        $provider = ProviderProfile::where('id', $id)
            ->orWhere('user_id', $id)
            ->firstOrFail();

        $provider->update([
            'approval_status' => 'rejected',
            'is_active' => false,
            'is_available' => false,
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Provider application rejected.');
    }
}
