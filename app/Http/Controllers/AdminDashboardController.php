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

        $activeJobsCount = EmergencyRequest::whereIn('status', ['accepted', 'provider_assigned', 'provider_on_way', 'arrived', 'working'])->count();
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

        $users = User::latest()->get();

        $serviceCategories = ServiceCategory::orderBy('group_name')->orderBy('name')->get();

        $recentRequests = EmergencyRequest::with(['customer', 'assignedProvider', 'serviceCategory'])
            ->latest()
            ->take(15)
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
            'users',
            'serviceCategories',
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
            ->with('success', 'Provider application approved.');
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

    /**
     * Toggle User Account Status (Suspend / Reinstate)
     */
    public function toggleUserStatus($id)
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('login');
        }

        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();

        $statusText = $user->is_active ? 'reinstated' : 'suspended';
        return redirect()->route('admin.dashboard')->with('success', "User '{$user->name}' has been {$statusText}.");
    }

    /**
     * Toggle Service Category Enabled/Disabled
     */
    public function toggleCategoryStatus($id)
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('login');
        }

        $category = ServiceCategory::findOrFail($id);
        $category->is_active = !$category->is_active;
        $category->save();

        $statusText = $category->is_active ? 'enabled' : 'disabled';
        return redirect()->route('admin.dashboard')->with('success', "Service category '{$category->name}' has been {$statusText}.");
    }

    /**
     * Create New Service Category
     */
    public function storeCategory(Request $request)
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:service_categories,name'],
            'group_name' => ['required', 'string', 'in:Emergency,Technical,Home'],
        ]);

        ServiceCategory::create([
            'name' => $validated['name'],
            'group_name' => $validated['group_name'],
            'is_active' => true,
        ]);

        return redirect()->route('admin.dashboard')->with('success', "New category '{$validated['name']}' added successfully.");
    }
}
