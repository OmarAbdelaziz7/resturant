<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Please log in first.');
        }

        // Check if user is not admin (i.e., regular user)
        if (Auth::user()->isAdmin()) {
            Auth::logout();
            return redirect('/login')->with('error', 'Administrators must use the admin login.');
        }

        return $next($request);
    }
}