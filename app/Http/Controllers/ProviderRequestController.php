<?php

namespace App\Http\Controllers;

use App\Models\EmergencyRequest;
use Illuminate\Http\Request;

class ProviderRequestController extends Controller
{
    /**
     * Provider Received Requests Feed
     */
    public function index()
    {
        if (!auth()->check() || auth()->user()->role !== 'provider') {
            abort(403, 'Provider access only.');
        }

        $requests = EmergencyRequest::where('status', 'pending')
            ->whereNull('assigned_provider_id')
            ->latest()
            ->get();

        return view('provider.requests', compact('requests'));
    }

    /**
     * Provider Accept Request
     */
    public function accept($id)
    {
        if (!auth()->check() || auth()->user()->role !== 'provider') {
            abort(403, 'Provider access only.');
        }

        $emergencyRequest = EmergencyRequest::findOrFail($id);

        if ($emergencyRequest->assigned_provider_id && $emergencyRequest->assigned_provider_id !== auth()->id()) {
            return back()->with('error', 'This request has already been accepted by another provider.');
        }

        $emergencyRequest->assigned_provider_id = auth()->id();
        $emergencyRequest->status = 'accepted';
        $emergencyRequest->accepted_at = now();
        $emergencyRequest->save();

        return redirect()
            ->route('provider.dashboard')
            ->with('success', 'Request #' . $emergencyRequest->reference . ' accepted successfully! You are now assigned to this emergency mission.');
    }

    /**
     * Provider Reject / Decline Request
     */
    public function reject($id)
    {
        if (!auth()->check() || auth()->user()->role !== 'provider') {
            abort(403, 'Provider access only.');
        }

        $emergencyRequest = EmergencyRequest::findOrFail($id);

        // If this provider was assigned, unassign so others can take it
        if ($emergencyRequest->assigned_provider_id === auth()->id()) {
            $emergencyRequest->assigned_provider_id = null;
            $emergencyRequest->status = 'pending';
            $emergencyRequest->save();
        }

        return back()->with('success', 'Request declined.');
    }

    /**
     * Update Service Status
     */
    public function updateStatus(Request $request, $id)
    {
        if (!auth()->check() || auth()->user()->role !== 'provider') {
            abort(403, 'Provider access only.');
        }

        $validated = $request->validate([
            'status' => [
                'required',
                'in:accepted,on_the_way,arrived,working,completed'
            ]
        ]);

        $serviceRequest = EmergencyRequest::findOrFail($id);

        $updates = ['status' => $validated['status']];

        if ($validated['status'] === 'on_the_way') {
            $updates['on_the_way_at'] = now();
        } elseif ($validated['status'] === 'arrived') {
            $updates['arrived_at'] = now();
            $updates['arrival_pin_verified_at'] = now();
        } elseif ($validated['status'] === 'working') {
            $updates['work_started_at'] = now();
        } elseif ($validated['status'] === 'completed') {
            $updates['completed_at'] = now();
            $updates['completion_pin_verified_at'] = now();
            $updates['payment_status'] = 'paid';
            $updates['paid_at'] = now();
        }

        $serviceRequest->update($updates);

        return back()->with('success', 'Status updated to ' . strtoupper(str_replace('_', ' ', $validated['status'])) . '.');
    }

    /**
     * Update Provider Availability (Available, Busy, Offline)
     */
    public function updateAvailability(Request $request)
    {
        if (!auth()->check() || auth()->user()->role !== 'provider') {
            abort(403, 'Provider access only.');
        }

        $status = $request->input('status', 'available'); // 'available', 'busy', 'offline'
        $providerProfile = auth()->user()->providerProfile;

        if ($providerProfile) {
            $isAvailable = ($status === 'available');
            $isActive = ($status !== 'offline');
            $providerProfile->update([
                'is_available' => $isAvailable,
                'is_active' => $isActive,
            ]);
        }

        session(['provider_status' => $status]);

        return back()->with('success', 'Your status is now: ' . strtoupper($status));
    }

    /**
     * Provider Advance Step (5-step lifecycle)
     */
    public function advance($id)
    {
        if (!auth()->check() || auth()->user()->role !== 'provider') {
            abort(403, 'Provider access only.');
        }

        $emergencyRequest = EmergencyRequest::findOrFail($id);

        $steps = [
            0 => 'pending',
            1 => 'accepted',
            2 => 'on_the_way',
            3 => 'arrival_pin',
            4 => 'completion_pin',
            5 => 'completed',
        ];

        $currentIdx = $emergencyRequest->current_step;
        $nextIdx = min($currentIdx + 1, 5);
        $nextStatus = $steps[$nextIdx];

        if ($nextStatus === 'on_the_way') {
            $emergencyRequest->on_the_way_at = now();
        } elseif ($nextStatus === 'arrival_pin') {
            $emergencyRequest->arrived_at = now();
        } elseif ($nextStatus === 'completion_pin') {
            $emergencyRequest->arrival_pin_verified_at = now();
            $emergencyRequest->work_started_at = now();
        } elseif ($nextStatus === 'completed') {
            $emergencyRequest->completed_at = now();
            $emergencyRequest->completion_pin_verified_at = now();
            $emergencyRequest->payment_status = 'paid';
            $emergencyRequest->paid_at = now();
        }

        $emergencyRequest->status = $nextStatus;
        $emergencyRequest->save();

        return back()->with('success', 'Job step advanced to: ' . strtoupper(str_replace('_', ' ', $nextStatus)));
    }
}