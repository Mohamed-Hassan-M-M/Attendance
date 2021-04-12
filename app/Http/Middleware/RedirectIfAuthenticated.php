<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
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
        if (auth()->check()) {
            if(auth()->user()->hasRole('Super Admin')){
                return redirect()->route('superAdmin.home');
            }
            elseif(auth()->user()->hasRole('Admin')){
                return redirect()->route('admin.home',auth()->user()->entity_id);
            }
        }

        return $next($request);
    }
}
