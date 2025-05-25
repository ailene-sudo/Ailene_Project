<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class SessionUserAccountMW
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if username exists in session
        if (!session()->has('username')) {
            // Redirect to login with an error message
            return redirect()->route('login')
                ->with('error', 'Please log in to access this page');
        }
        
        // Check if session has expired (30 minutes of inactivity)
        if (session()->has('last_activity')) {
            $lastActivity = Carbon::parse(session('last_activity'));
            $now = Carbon::now();
            
            // If more than 30 minutes have passed since last activity
            if ($lastActivity->diffInMinutes($now) > 30) {
                // Clear the session
                session()->forget(['username', 'last_activity']);
                
                // Redirect to login with a session timeout message
                return redirect()->route('login')
                    ->with('error', 'Your session has expired due to inactivity. Please log in again.');
            }
        }
        
        // Update last activity timestamp
        session(['last_activity' => Carbon::now()]);
        
        return $next($request);
    }
}
