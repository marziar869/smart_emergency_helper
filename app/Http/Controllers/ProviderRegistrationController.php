<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ProviderProfile;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProviderRegistrationController extends Controller
{
    public function create()
    {
        return view('register.provider');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30', 'unique:users,phone'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'area' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string'],
            'experience' => ['required', 'integer', 'min:0', 'max:60'],
        ]);


        $serviceCategory = ServiceCategory::where(
            'name',
            $validated['category']
        )
        ->where('is_active', true)
        ->first();


        if (!$serviceCategory) {

            return back()
                ->withInput()
                ->withErrors([
                    'category' => 'Selected service category is not available.',
                ]);
        }



        $user = DB::transaction(function () use ($validated, $serviceCategory) {


            // Create Provider User

            $user = User::create([
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
                'role' => 'provider',
                'is_active' => true,
            ]);



            // Create Provider Profile

            ProviderProfile::create([

                'user_id' => $user->id,


                'service_category_id' => $serviceCategory->id,


                'area' => $validated['area'],

                'address' => $validated['address'],


                'experience_years' => $validated['experience'],


                'rating' => 0,

                'total_reviews' => 0,


                'phone_verified' => false,

                'phone_verified_at' => null,


                'approval_status' => 'pending',

                'approved_at' => null,


                'is_active' => true,


                'is_available' => false,

            ]);



            return $user;

        });



        // Login newly created provider

        Auth::login($user);


        $request->session()->regenerate();



        return redirect()

            ->route('provider.verification')

            ->with(

                'success',

                'Account created successfully. Please complete your verification.'

            );
    }
}