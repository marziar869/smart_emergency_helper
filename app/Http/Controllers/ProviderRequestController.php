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

        if(auth()->user()->role !== 'provider'){
            abort(403);
        }


        $requests = EmergencyRequest::where(
            'status',
            'pending'
        )
        ->whereNull(
            'assigned_provider_id'
        )
        ->get();


        return view(
            'provider.requests',
            compact('requests')
        );

    }




    /*
    |--------------------------------------------------------------------------
    | Provider Accept Request
    |--------------------------------------------------------------------------
    */
 public function accept($id)
{

    $request = EmergencyRequest::find($id);


    if(!$request){
        return "Request not found";
    }


    $request->assigned_provider_id = auth()->id();

    $request->status = 'accepted';

    $request->save();


    return back();

}
    /*
    |--------------------------------------------------------------------------
    | Provider Reject Request
    |--------------------------------------------------------------------------
    */

    public function reject($id)
{

    if(auth()->user()->role !== 'provider'){
        abort(403);
    }


    $request = EmergencyRequest::findOrFail($id);

    dd($request, auth()->id());

    $request->status = 'rejected';

    $request->save();


    return back()->with(
        'success',
        'Request rejected.'
    );

}



    /*
    |--------------------------------------------------------------------------
    | Update Service Status
    |--------------------------------------------------------------------------
    */

    public function updateStatus(
        Request $request,
        $id
    )
    {


        if(auth()->user()->role !== 'provider'){
            abort(403);
        }



        $validated = $request->validate([

            'status'=>[
                'required',
                'in:working,completed'
            ]

        ]);



        $serviceRequest =
        EmergencyRequest::findOrFail($id);



        $serviceRequest->update([

            'status'=>$validated['status']

        ]);



        return back()->with(
            'success',
            'Status updated.'
        );


    }


}