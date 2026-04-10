<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/admin');
        }
        return view('admin.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Check if user exists and is admin
        $user = User::where('email', $credentials['email'])->first();

        if ($user && $user->isAdmin() && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return redirect('/admin')->with('success', 'Welcome back, Admin!');
        }

        // Check if user exists but is not admin
        if ($user && !$user->isAdmin()) {
            return back()->withInput($request->only('email'))->with('error', 'You do not have permission to access the admin panel.');
        }

        // Invalid credentials
        return back()->withInput($request->only('email'))->with('error', 'Invalid email or password.');
    }

    /**
     * Handle logout
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
