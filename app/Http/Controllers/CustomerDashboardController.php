<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmergencyRequest;
use App\Models\ServiceCategory;

class CustomerDashboardController extends Controller
{

    private $flow = [

        'pending',
        'accepted',
        'on_the_way',
        'arrival_pin_required',
        'arrived',
        'before_photo',
        'working',
        'after_photo',
        'completion_pin_required',
        'completed',
        'rating_review'

    ];


   public function index()
   {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    if (auth()->user()->role !== 'customer') {
        abort(403, 'Customer access only.');
    }

    $flow = [
        'pending',
        'accepted',
        'provider_on_way',
        'arrived',
        'working',
        'completed'
    ];

    $activeRequest = EmergencyRequest::with(['serviceCategory', 'assignedProvider'])
        ->where('customer_id', auth()->id())
        ->whereNotIn('status', ['completed', 'cancelled', 'rejected'])
        ->latest()
        ->first();

    if ($activeRequest) {
        if (empty($activeRequest->arrival_pin) || empty($activeRequest->completion_pin)) {
            $activeRequest->update([
                'arrival_pin' => $activeRequest->arrival_pin ?? sprintf('%04d', rand(1000, 9999)),
                'completion_pin' => $activeRequest->completion_pin ?? sprintf('%04d', rand(1000, 9999)),
            ]);
        }
    }

    $requests = EmergencyRequest::with(['serviceCategory', 'assignedProvider'])
        ->where('customer_id', auth()->id())
        ->latest()
        ->get();

    $current = 0;
    if ($activeRequest) {
        $status = $activeRequest->status;
        if ($status === 'on_the_way') {
            $status = 'provider_on_way';
        }
        $current = array_search($status, $flow);
        if ($current === false) {
            $current = 0;
        }
    }

    return view(
        'customer.dashboard',
        [
            'activeRequest' => $activeRequest,
            'requests' => $requests,
            'serviceCategories' => ServiceCategory::where('is_active', true)->get(),
            'current' => $current,
            'flow' => $flow
        ]
    );
}



    public function advance($id)
    {

       $request = EmergencyRequest::findOrFail($id);


$flow = [
    'pending',
    'accepted',
    'on_the_way',
    'arrival_pin_required',
    'arrived',
    'before_photo',
    'working',
    'after_photo',
    'completion_pin_required',
    'completed',
    'rating_review'
];


    $current = array_search(
        $request->status,
        $flow
    );


    if($current !== false && $current < count($flow)-1)
    {

        $request->status = $flow[$current + 1];

        $request->save();

    }


    return back();

    }




    public function reset($id)
    {

        $request = EmergencyRequest::findOrFail($id);


        $request->status = 'pending';


        $request->save();


        return back();

    }

}