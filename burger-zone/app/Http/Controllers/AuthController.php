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
     * Show the public login form
     */
    public function showUserLogin()
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        if (Auth::check()) {
            return redirect()->route('account.orders');
        }

        return view('userInterface.auth.login');
    }

    /**
     * Handle public user login
     */
    public function userLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', $credentials['email'])->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {
            if ($user->isAdmin()) {
                return back()->withInput($request->only('email'))->with('error', 'Please use the admin login page for administrators.');
            }

            Auth::login($user, $request->filled('remember'));
            return redirect(route('account.orders'))->with('success', 'Welcome back!');
        }

        return back()->withInput($request->only('email'))->with('error', 'Invalid email or password.');
    }

    /**
     * Show the public registration form
     */
    public function showRegister()
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        if (Auth::check()) {
            return redirect()->route('account.orders');
        }

        return view('userInterface.auth.register');
    }

    /**
     * Handle user registration
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'user',
            'theme' => 'light',
        ]);

        Auth::login($user);

        return redirect()->route('account.orders')->with('success', 'Your account is ready.');
    }

    /**
     * Handle public user logout
     */
    public function userLogout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
