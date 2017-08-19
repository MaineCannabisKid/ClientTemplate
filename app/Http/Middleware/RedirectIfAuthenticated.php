<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // Switch on Guard to figure out if admin guard is being accessed
        switch($guard) {

          // If guard being access is admin
          case 'admin':
            // Check if the user is logged in as admin
            if(Auth::guard($guard)->check()) {
              // If they are redirect to admin dashboard
              return redirect()->route('admin.dashboard');
            }
            break;

          // If the guard isn't admin
          default:
            // Check if the user is logged in as user
            if (Auth::guard($guard)->check()) {
                // If so redirect to the user dashboard
                return redirect('/home');
            }
            break;
        }

        // If not logged in at all just continue on
        return $next($request);
    }
}
