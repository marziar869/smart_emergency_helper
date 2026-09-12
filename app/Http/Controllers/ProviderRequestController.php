<?php

namespace App\Http\Controllers;

use App\Models\EmergencyRequest;
use Illuminate\Http\Request;

class ProviderRequestController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Provider Received Requests
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        if (auth()->user()->role !== 'provider') {
            abort(403);
        }

        $requests = EmergencyRequest::where('status', 'pending')
            ->whereNull('assigned_provider_id')
            ->get();

        return view('provider.requests', compact('requests'));
    }

    /*
    |--------------------------------------------------------------------------
    | Provider Accept Request
    |--------------------------------------------------------------------------
    */
    public function accept($id)
    {
        if (auth()->user()->role !== 'provider') {
            abort(403);
        }

        $request = EmergencyRequest::find($id);

        if (!$request) {
            return back()->with('error', 'Request not found.');
        }

        $request->assigned_provider_id = auth()->id();
        $request->status = 'accepted';
        $request->accepted_at = now();
        if (empty($request->arrival_pin)) {
            $request->arrival_pin = sprintf('%04d', rand(1000, 9999));
        }
        if (empty($request->completion_pin)) {
            $request->completion_pin = sprintf('%04d', rand(1000, 9999));
        }
        $request->save();

        return back()->with('success', "Emergency request accepted! Arrival PIN: {$request->arrival_pin}, Completion PIN: {$request->completion_pin}");
    }

    /*
    |--------------------------------------------------------------------------
    | Provider Reject Request
    |--------------------------------------------------------------------------
    */
    public function reject($id)
    {
        if (auth()->user()->role !== 'provider') {
            abort(403);
        }

        $request = EmergencyRequest::findOrFail($id);

        if ($request->assigned_provider_id == auth()->id()) {
            $request->assigned_provider_id = null;
            $request->status = 'pending';
        } else {
            $request->status = 'rejected';
        }
        $request->save();

        return back()->with('success', 'Request declined.');
    }

    /*
    |--------------------------------------------------------------------------
    | Update Service Status (Job Progress & PIN Verification)
    |--------------------------------------------------------------------------
    */
    public function updateStatus(Request $request, $id)
    {
        if (auth()->user()->role !== 'provider') {
            abort(403);
        }

        $validated = $request->validate([
            'status' => [
                'required',
                'string',
                'in:accepted,provider_assigned,provider_on_way,arrived,working,completed,cancelled'
            ],
            'pin' => ['nullable', 'string']
        ]);

        $serviceRequest = EmergencyRequest::findOrFail($id);

        // Arrival PIN verification
        if ($validated['status'] === 'arrived' && $serviceRequest->arrival_pin) {
            if (empty($validated['pin']) || trim($validated['pin']) !== $serviceRequest->arrival_pin) {
                return back()->with('error', "Invalid Arrival PIN entered! Correct PIN is required from customer.");
            }
        }

        // Completion PIN verification
        if ($validated['status'] === 'completed' && $serviceRequest->completion_pin) {
            if (empty($validated['pin']) || trim($validated['pin']) !== $serviceRequest->completion_pin) {
                return back()->with('error', "Invalid Completion PIN entered! Correct PIN is required from customer.");
            }
        }

        $data = ['status' => $validated['status']];

        if ($validated['status'] === 'arrived' && !$serviceRequest->arrived_at) {
            $data['arrived_at'] = now();
        } elseif ($validated['status'] === 'working' && !$serviceRequest->work_started_at) {
            $data['work_started_at'] = now();
        } elseif ($validated['status'] === 'completed' && !$serviceRequest->completed_at) {
            $data['completed_at'] = now();
        }

        $serviceRequest->update($data);

        $statusLabel = strtoupper(str_replace('_', ' ', $validated['status']));
        return back()->with('success', "Job status updated to {$statusLabel}.");
    }

    /*
    |--------------------------------------------------------------------------
    | Update Provider Availability (Available / Busy / Offline)
    |--------------------------------------------------------------------------
    */
    public function updateAvailability(Request $request)
    {
        if (auth()->user()->role !== 'provider') {
            abort(403);
        }

        $validated = $request->validate([
            'availability' => ['required', 'string', 'in:available,busy,offline']
        ]);

        $user = auth()->user();
        if ($user->providerProfile) {
            $isAvailable = ($validated['availability'] === 'available');
            $user->providerProfile->update([
                'is_available' => $isAvailable
            ]);
        }

        return back()->with('success', 'Availability status updated to ' . strtoupper($validated['availability']));
    }

    /*
    |--------------------------------------------------------------------------
    | Upload Site Assessment Photo (Before / After Photo)
    |--------------------------------------------------------------------------
    */
    public function uploadPhoto(Request $request, $id)
    {
        if (auth()->user()->role !== 'provider') {
            abort(403);
        }

        $validated = $request->validate([
            'photo_type' => ['required', 'in:before,after'],
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ]);

        $emergencyRequest = EmergencyRequest::findOrFail($id);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('job_photos', 'public');
            $column = $validated['photo_type'] . '_photo';
            $emergencyRequest->update([$column => $path]);
        }

        return back()->with('success', ucfirst($validated['photo_type']) . ' service photo uploaded successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | API: Fetch Pending Alerts JSON (Real-time polling)
    |--------------------------------------------------------------------------
    */
    public function pendingAlertsApi()
    {
        if (auth()->user()->role !== 'provider') {
            return response()->json(['count' => 0, 'requests' => []], 403);
        }

        $providerProfile = auth()->user()->providerProfile;

        $requests = EmergencyRequest::where('status', 'pending')
            ->where(function($query) use ($providerProfile) {
                $query->whereNull('assigned_provider_id');
                if ($providerProfile && $providerProfile->service_category_id) {
                    $query->orWhere('service_category_id', $providerProfile->service_category_id);
                }
            })
            ->latest()
            ->get();

        return response()->json([
            'count' => $requests->count(),
            'requests' => $requests
        ]);
    }
}