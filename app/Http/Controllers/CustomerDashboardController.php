<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmergencyRequest;
use App\Models\ServiceCategory;

class CustomerDashboardController extends Controller
{

    public function index()
    {

        $activeRequest = EmergencyRequest::where(
            'customer_id',
            auth()->id()
        )
        ->whereNotIn('status',[
            'completed',
            'cancelled'
        ])
        ->latest()
        ->first();


        $requests = EmergencyRequest::where(
            'customer_id',
            auth()->id()
        )
        ->latest()
        ->get();
        $current = 0;

if($activeRequest){

    $flow = [
        'pending',
        'accepted',
        'on_the_way',
        'arrived',
        'working',
        'completed'
    ];


    $current = array_search(
        $activeRequest->status,
        $flow
    );

}


        return view( 
    'customer.dashboard',
    [
        'activeRequest'=>$activeRequest,
        'requests'=>$requests,
        'serviceCategories'=>ServiceCategory::all(),
        'current'=>$current
    ]
);

    }


    public function advance($id)
    {

        $request = EmergencyRequest::findOrFail($id);


        $flow = [
                    'pending',
                    'searching_provider',
                    'provider_assigned',
                    'provider_on_way',
                    'arrived',
                    'working',
                    'completion_pending',
                    'completed'
                    ];


        $current = array_search(
            $request->status,
            $flow
        );


        if($current < count($flow)-1)
        {
            $request->status =
            $flow[$current+1];

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