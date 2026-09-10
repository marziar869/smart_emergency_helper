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

    $request = EmergencyRequest::findOrFail($id);


$request->update([

'status'=>'accepted',

'accepted_at'=>now(),

'arrival_pin'=>random_int(1000,9999)

]);


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