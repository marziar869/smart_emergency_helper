<?php

namespace App\Http\Controllers;

use App\Models\EmergencyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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


        // Generate unique reference
        do {

            $reference = 'REQ-' . random_int(100000,999999);

        } while(
            EmergencyRequest::where('reference',$reference)->exists()
        );


        // Automatic Arrival PIN generate
        $arrivalPin = random_int(1000,9999);


        $emergencyRequest = EmergencyRequest::create([

            'reference' => $reference,

            'customer_id' => auth()->id(),

            'service_category_id' =>
                $validated['service_category_id'],

            'priority' =>
                $validated['priority'],

            'area' =>
                $validated['area'],

            'address' =>
                $validated['address'],

            'description' =>
                $validated['description'],


            // provider initially empty
            'assigned_provider_id' => null,


            // first state
            'status' => 'pending',


            // auto generated
            'arrival_pin' => $arrivalPin,

        ]);



        return redirect()
->route('customer.dashboard')
->with(
    'success',
    'Emergency request created successfully.'
);
    }
}