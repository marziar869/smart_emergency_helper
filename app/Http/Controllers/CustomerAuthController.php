<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30', 'unique:users,phone'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'area' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'emergency_email' => ['nullable', 'email', 'max:255'],
        ]);

        $user = User::create([
            'name' => $validated['full_name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'customer',
            'area' => $validated['area'],
            'address' => $validated['address'],
            'emergency_email' => $validated['emergency_email'] ?? null,
            'is_active' => true,
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()
            ->route('customer.dashboard')
            ->with('success', 'Customer account created successfully.');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'role' => ['required', 'in:customer,provider,admin'],
        ]);

        if (!Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => $validated['role'],
            'is_active' => true,
        ])) {
            return back()
                ->withInput($request->only('email', 'role'))
                ->with('login_error', 'Invalid email, password, or account type.');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'customer') {
            return redirect()->route('customer.dashboard');
        }

        if ($user->role === 'provider') {
            return redirect()->route('provider.dashboard');
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        Auth::logout();

        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}