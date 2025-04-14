<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TechnicianMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and is a technician
        if (Auth::user()->role === 'technician') {
            return $next($request);
        }

        // If not technician, redirect to home with error message
        return redirect()->route('admin.dashboard')
            ->with('error', 'Access denied. Technician privileges required.');
    }
}
