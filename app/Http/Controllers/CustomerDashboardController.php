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

        $current = array_search(
            $activeRequest->status,
            $flow
        );

        if($current === false){
            $current = 0;
        }

    }



    return view(
        'customer.dashboard',
        [
            'activeRequest'=>$activeRequest,
            'requests'=>$requests,
            'serviceCategories'=>ServiceCategory::all(),
            'current'=>$current,
            'flow'=>$flow
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