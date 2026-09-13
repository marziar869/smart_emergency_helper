<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmergencyRequest;

class CustomerRequestStatusController extends Controller
{

    public function reset($id)
    {
        $request = EmergencyRequest::findOrFail($id);

        $request->status = 'pending';
        $request->save();

        return back()->with('success','Request reset to pending');
    }



    public function advance($id)
    {
        $request = EmergencyRequest::findOrFail($id);


        $steps = [
            'pending',
            'accepted',
            'on_the_way',
            'arrival_pin_required',
            'arrived',
            'working',
            'after_photo',
            'completion_pin_required',
            'completed'
        ];


        $current = array_search($request->status,$steps);


        if($current !== false && $current < count($steps)-1)
        {
            $request->status = $steps[$current+1];
            $request->save();
        }


        return back()->with('success','Status advanced');
    }

}