<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming reques.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and is an admin
        if (Auth::user()->role === 'admin') {
            return $next($request);
        }

        // If not admin, redirect to home with error message
        return redirect()->route('technician.dashboard')
            ->with('error', 'Access denied. Admin privileges required.');
    }
}
