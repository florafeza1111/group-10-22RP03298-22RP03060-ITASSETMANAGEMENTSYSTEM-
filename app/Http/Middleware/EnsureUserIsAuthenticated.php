<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAuthenticated
{
    /**
     * The URIs that should be excluded from authentication checking.
     *
     * @var array
     */
    protected $except = [
        '/',
        'login',
        '/login',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip authentication for excluded paths
        foreach ($this->except as $path) {
            if ($request->is($path)) {
                return $next($request);
            }
        }

        // If user is not authenticated, redirect to login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // User is authenticated, proceed
        return $next($request);
    }
}
