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
        if (Auth::guard('admin')->check()) {
            return redirect('admin/dashboard');
        }

        if (Auth::guard('user')->check()) {
            return redirect('user/events');
        }

        if (Auth::guard('sysad')->check()) {
            return redirect('sysad/dashboard');
        }

        if (Auth::guard('affiliatedstore')->check()) {
            return redirect('affiliatedstore/search');
        }
        return $next($request);
    }
}
