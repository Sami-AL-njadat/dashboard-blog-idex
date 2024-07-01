<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Flasher\Laravel\Facade\Flasher;

class CheckSessionExpiration
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // Check if session has expired
            $sessionLifetime = config('session.lifetime') * 60; // Lifetime in seconds
            $lastActivityTime = $request->session()->get('last_activity_time', time());

            if (time() - $lastActivityTime > $sessionLifetime) {
                Auth::logout(); // Log out the user
                $request->session()->invalidate(); // Invalidate the session
                return redirect('/login')->with('info', 'Your session has expired. Please log in again.');
            }

             $request->session()->put('last_activity_time', time());
        }

        return $next($request);
    }
}