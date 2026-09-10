<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmergencyRequest;

class CustomerRequestController extends Controller
{

    public function show($id)
    {

        if(!auth()->check()){
            return redirect()->route('login');
        }


        if(auth()->user()->role !== 'customer'){
            abort(403,'Customer access only.');
        }


       $emergencyRequest = EmergencyRequest::where('id',$id)
    ->where('customer_id',auth()->id())
    ->firstOrFail();


return view(
    'customer.request-terminal',
    [
        'emergency'=>$emergencyRequest
    ]
);
    }

}