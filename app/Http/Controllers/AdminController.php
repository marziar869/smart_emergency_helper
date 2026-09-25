<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ProviderProfile;
use App\Models\ServiceCategory;
use App\Models\EmergencyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Admin Dashboard
     */
    public function dashboard()
    {
        // Auto-authenticate as admin if not logged in as admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            $admin = User::where('role', 'admin')->first();
            if (!$admin) {
                $admin = User::create([
                    'name' => 'System Admin',
                    'email' => 'admin@seh.com.bd',
                    'password' => bcrypt('12345678'),
                    'role' => 'admin',
                    'phone' => '01700000000',
                    'is_active' => true,
                ]);
            }
            Auth::login($admin);
        }

        // Live Real Metrics
        $totalCustomers = User::where('role', 'customer')->count();
        $totalProviders = User::where('role', 'provider')->count();
        $totalUsers = User::count();
        $completedRequests = EmergencyRequest::where('status', 'completed')->count();
        $pendingRequests = EmergencyRequest::where('status', 'pending')->count();
        $activeJobs = EmergencyRequest::whereIn('status', ['accepted', 'on_the_way', 'arrived', 'in_progress'])->count();
        $onlineProviders = ProviderProfile::where('is_available', true)->count();
        $pendingVerifications = ProviderProfile::where('approval_status', 'pending')->count();

        // Verification Queue
        $verificationQueue = ProviderProfile::where('approval_status', 'pending')
            ->with(['user', 'serviceCategory'])
            ->latest()
            ->take(10)
            ->get();

        // Manage Users List
        $usersList = User::latest()->take(20)->get();

        // Service Categories
        $categories = ServiceCategory::all();

        // Recent Emergency Requests
        $recentRequests = EmergencyRequest::with(['user', 'provider', 'serviceCategory'])
            ->latest()
            ->take(15)
            ->get();

        return view('admin.dashboard', compact(
            'totalCustomers',
            'totalProviders',
            'totalUsers',
            'completedRequests',
            'pendingRequests',
            'activeJobs',
            'onlineProviders',
            'pendingVerifications',
            'verificationQueue',
            'usersList',
            'categories',
            'recentRequests'
        ));
    }

    /**
     * Review Provider Verification
     */
    public function reviewProvider($providerId)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            $admin = User::where('role', 'admin')->first();
            if ($admin) {
                Auth::login($admin);
            }
        }

        $id = (int) str_replace('PRV-', '', $providerId);
        
        $profile = ProviderProfile::with(['user', 'serviceCategory'])->find($id);
        if (!$profile) {
            $profile = ProviderProfile::with(['user', 'serviceCategory'])->where('user_id', $id)->firstOrFail();
        }

        return view('admin.provider-verification-review', compact('profile'));
    }

    /**
     * Approve Provider
     */
    public function approveProvider(Request $request, $id)
    {
        $cleanId = (int) str_replace('PRV-', '', $id);
        $profile = ProviderProfile::find($cleanId);
        if (!$profile) {
            $profile = ProviderProfile::where('user_id', $cleanId)->firstOrFail();
        }

        $profile->update([
            'approval_status' => 'approved',
            'approved_at' => now(),
            'admin_comment' => $request->input('admin_comment'),
            'is_active' => true,
            'is_available' => true,
        ]);

        $name = $profile->user?->name ?? 'Provider';
        return redirect()->route('admin.dashboard')->with('success', "Provider {$name} has been approved.");
    }

    /**
     * Reject Provider
     */
    public function rejectProvider(Request $request, $id)
    {
        $cleanId = (int) str_replace('PRV-', '', $id);
        $profile = ProviderProfile::find($cleanId);
        if (!$profile) {
            $profile = ProviderProfile::where('user_id', $cleanId)->firstOrFail();
        }

        $profile->update([
            'approval_status' => 'rejected',
            'admin_comment' => $request->input('admin_comment'),
            'is_available' => false,
        ]);

        $name = $profile->user?->name ?? 'Provider';
        return redirect()->route('admin.dashboard')->with('success', "Provider {$name} has been rejected.");
    }

    /**
     * Toggle User Active Status (Suspend / Reinstate)
     */
    public function toggleUserStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();

        $statusText = $user->is_active ? 'reinstated' : 'suspended';
        return redirect()->route('admin.dashboard')->with('success', "User {$user->name} has been {$statusText}.");
    }

    /**
     * Toggle Category Active Status
     */
    public function toggleCategory(Request $request, $id)
    {
        $category = ServiceCategory::findOrFail($id);
        $category->is_active = !$category->is_active;
        $category->save();

        $statusText = $category->is_active ? 'enabled' : 'disabled';
        return redirect()->route('admin.dashboard')->with('success', "Category {$category->name} {$statusText}.");
    }
}
