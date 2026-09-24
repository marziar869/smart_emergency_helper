<?php

namespace App\Http\Controllers;

use App\Models\EmergencyRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmergencyRequestController extends Controller
{
    /**
     * Store new emergency request
     */
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->role !== 'customer') {
            abort(403, 'Customer access only.');
        }

        $validated = $request->validate([
            'service_category_id' => [
                'required',
                'integer',
                'exists:service_categories,id'
            ],
            'priority' => [
                'required',
                'in:Critical,High,Medium,Normal'
            ],
            'area' => [
                'required',
                'string',
                'max:255'
            ],
            'address' => [
                'required',
                'string',
                'max:255'
            ],
            'description' => [
                'required',
                'string',
                'max:2000'
            ],
        ]);

        do {
            $reference = 'REQ-' . random_int(100000, 999999);
        } while (
            EmergencyRequest::where('reference', $reference)->exists()
        );

        $emergencyRequest = EmergencyRequest::create([
            'reference' => $reference,
            'customer_id' => auth()->id(),
            'service_category_id' => $validated['service_category_id'],
            'priority' => $validated['priority'],
            'area' => $validated['area'],
            'address' => $validated['address'],
            'description' => $validated['description'],
            'assigned_provider_id' => null,
            'status' => 'pending',
            'arrival_pin' => (string) random_int(1000, 9999),
            'completion_pin' => (string) random_int(1000, 9999),
            'amount' => 500.00,
            'payment_method' => 'Cash',
            'payment_status' => 'pending',
            'is_rated' => false,
        ]);

        return redirect()
            ->route('customer.dashboard')
            ->with(
                'success',
                'Request ' . $emergencyRequest->reference . ' created successfully! Waiting for an emergency helper to accept.'
            );
    }

    /**
     * Advance state through the 5-step lifecycle (Simulation / Workflow)
     */
    public function advance($id)
    {
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

        // If transitioning to accepted and no provider assigned, assign a demo provider if available
        if ($nextStatus === 'accepted' && !$emergencyRequest->assigned_provider_id) {
            $provider = User::where('role', 'provider')->first();
            if ($provider) {
                $emergencyRequest->assigned_provider_id = $provider->id;
                $emergencyRequest->accepted_at = now();
            }
        }

        if ($nextStatus === 'on_the_way') {
            $emergencyRequest->on_the_way_at = now();
        }

        if ($nextStatus === 'arrival_pin') {
            $emergencyRequest->arrived_at = now();
        }

        if ($nextStatus === 'completion_pin') {
            $emergencyRequest->arrival_pin_verified_at = now();
            $emergencyRequest->work_started_at = now();
        }

        if ($nextStatus === 'completed') {
            $emergencyRequest->completed_at = now();
            $emergencyRequest->completion_pin_verified_at = now();
            $emergencyRequest->payment_status = 'paid';
            $emergencyRequest->paid_at = now();
        }

        $emergencyRequest->status = $nextStatus;
        $emergencyRequest->save();

        return back()->with('success', 'Request state advanced to: ' . strtoupper(str_replace('_', ' ', $nextStatus)));
    }

    /**
     * Reset step back to pending
     */
    public function reset($id)
    {
        $emergencyRequest = EmergencyRequest::findOrFail($id);
        $emergencyRequest->status = 'pending';
        $emergencyRequest->arrival_pin_verified_at = null;
        $emergencyRequest->completion_pin_verified_at = null;
        $emergencyRequest->payment_status = 'pending';
        $emergencyRequest->paid_at = null;
        $emergencyRequest->save();

        return back()->with('success', 'Request step reset to PENDING.');
    }

    /**
     * Verify PIN (Arrival or Completion)
     */
    public function verifyPin(Request $request, $id)
    {
        $emergencyRequest = EmergencyRequest::findOrFail($id);

        $type = $request->input('type');
        $enteredPin = trim($request->input('pin'));

        if ($type === 'arrival') {
            if ($enteredPin !== $emergencyRequest->arrival_pin) {
                return back()->with('error', 'Invalid Arrival PIN entered. Please check your PIN.');
            }
            $emergencyRequest->arrival_pin_verified_at = now();
            $emergencyRequest->arrived_at = now();
            $emergencyRequest->status = 'completion_pin';
            $emergencyRequest->save();

            return back()->with('success', 'Arrival PIN verified successfully! Next step: Completion PIN.');
        }

        if ($type === 'completion') {
            if ($enteredPin !== $emergencyRequest->completion_pin) {
                return back()->with('error', 'Invalid Completion PIN entered. Please check your PIN.');
            }
            $emergencyRequest->completion_pin_verified_at = now();
            $emergencyRequest->completed_at = now();
            $emergencyRequest->payment_status = 'paid';
            $emergencyRequest->paid_at = now();
            $emergencyRequest->status = 'completed';
            $emergencyRequest->save();

            return back()->with('success', 'Completion PIN verified! Job completed and payment recorded.');
        }

        return back()->with('error', 'Unknown PIN verification type.');
    }

    /**
     * Upload before or after evidence photo
     */
    public function uploadPhoto(Request $request, $id)
    {
        $emergencyRequest = EmergencyRequest::findOrFail($id);

        $request->validate([
            'photo' => 'required|image|max:5120',
            'photo_type' => 'required|in:before,after',
        ]);

        $photoPath = $request->file('photo')->store('requests', 'public');
        $type = $request->input('photo_type');

        if ($type === 'before') {
            $emergencyRequest->before_photo = $photoPath;
            $emergencyRequest->before_photo_path = $photoPath;
            $emergencyRequest->before_photo_uploaded_at = now();
            $emergencyRequest->status = 'working';
            $emergencyRequest->work_started_at = now();
            $emergencyRequest->save();

            return back()->with('success', 'Before photo uploaded successfully! Status updated to WORKING.');
        }

        if ($type === 'after') {
            $emergencyRequest->after_photo = $photoPath;
            $emergencyRequest->after_photo_path = $photoPath;
            $emergencyRequest->after_photo_uploaded_at = now();
            $emergencyRequest->status = 'completion_pin_required';
            $emergencyRequest->save();

            return back()->with('success', 'After photo uploaded successfully! Next: verify completion PIN.');
        }

        return back();
    }

    /**
     * Rate and close completed request
     */
    public function rate(Request $request, $id)
    {
        $emergencyRequest = EmergencyRequest::findOrFail($id);

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $emergencyRequest->rating = (int) $request->input('rating');
        $emergencyRequest->rating_comment = $request->input('comment');
        $emergencyRequest->is_rated = true;
        $emergencyRequest->status = 'completed';
        if (!$emergencyRequest->completed_at) {
            $emergencyRequest->completed_at = now();
        }
        $emergencyRequest->save();

        return redirect()->route('customer.dashboard')->with('success', 'Thank you! Rating & review submitted successfully. Task is now fully closed.');
    }
}