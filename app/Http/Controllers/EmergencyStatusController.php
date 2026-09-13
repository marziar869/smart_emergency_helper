<?php

namespace App\Http\Controllers;

use App\Models\EmergencyRequest;

class EmergencyStatusController extends Controller
{


public function advance($id)
{

$request = EmergencyRequest::findOrFail($id);



$flow = [
    'pending',
    'accepted',
    'on_the_way',
    'arrived',
    'working',
    'completed'
];



$current = array_search(
    $request->status,
    $flow
);



if($current !== false &&
$current < count($flow)-1)
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


$request->status='pending';


$request->save();


return back();

}


}