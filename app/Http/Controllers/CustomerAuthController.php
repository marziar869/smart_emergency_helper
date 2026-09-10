<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{

    public function register(Request $request)
    {

        $validated = $request->validate([

            'full_name' => [
                'required',
                'string',
                'max:255'
            ],

            'phone' => [
                'required',
                'string',
                'max:30',
                'unique:users,phone'
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email'
            ],

            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed'
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

            'emergency_email' => [
                'nullable',
                'email',
                'max:255'
            ],

        ]);


        $user = User::create([

            'name' => $validated['full_name'],

            'phone' => $validated['phone'],

            'email' => $validated['email'],

            'password' => Hash::make(
                $validated['password']
            ),

            'role' => 'customer',

            'area' => $validated['area'],

            'address' => $validated['address'],

            'emergency_email' =>
                $validated['emergency_email'] ?? null,

            'is_active' => true,

        ]);



        Auth::login($user);


        $request->session()->regenerate();



        return redirect()

            ->route('customer.dashboard')

            ->with(
                'success',
                'Customer account created successfully.'
            );

    }





    public function login(Request $request)
    {


        $validated = $request->validate([


            'email' => [
                'required',
                'email'
            ],


            'password' => [
                'required'
            ],


            'role' => [
                'required',
                'in:customer,provider,admin'
            ],


        ]);




        $credentials = [

            'email' => $validated['email'],

            'password' => $validated['password'],

            'is_active' => true,

        ];




        if(!Auth::attempt($credentials)){


            return back()

                ->withInput()

                ->withErrors([

                    'email' =>
                    'Invalid email or password.'

                ]);

        }





        $request->session()->regenerate();



        $user = Auth::user();





        // Role checking

        if($user->role !== $validated['role']){


            Auth::logout();


            return back()

                ->withErrors([

                    'email' =>
                    'Wrong account type selected.'

                ]);

        }





        if($user->role === 'customer'){


            return redirect()

                ->route('customer.dashboard');

        }





        if($user->role === 'provider'){


            return redirect()

                ->route('provider.dashboard');

        }




        if($user->role === 'admin'){


            return redirect()

                ->route('admin.dashboard');

        }



        Auth::logout();


        return redirect()

            ->route('login');


    }






    public function logout(Request $request)
    {


        Auth::logout();


        $request->session()->invalidate();


        $request->session()->regenerateToken();



        return redirect()

            ->route('home');


    }


}