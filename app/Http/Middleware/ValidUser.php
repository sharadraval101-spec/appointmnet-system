<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            // If the user is not authenticated, redirect to the login page
            // return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
             return redirect()->route('login')->with('error', 'Must Need To Login');
        }
        if (auth()->user()->role !== 'user') {
            // If the user does not have the required role, redirect to a different page
            return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
        }
        // If the user is authenticated, proceed with the request
        return $next($request);

    }
}
