<?php

namespace App\Http\Controllers;

use App\Models\EmergencyRequest;
use Illuminate\Http\Request;

class EmergencyRequestController extends Controller
{
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
        ]);

        return redirect()
            ->route('customer.dashboard')
            ->with(
                'success',
                'Request ' . $emergencyRequest->reference . ' created successfully.'
            );
    }
}