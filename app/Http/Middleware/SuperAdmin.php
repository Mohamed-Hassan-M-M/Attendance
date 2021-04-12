<?php

namespace App\Http\Middleware;

use Closure;

class SuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->hasRole('Super Admin')) {
            //return redirect()->route('entity.dashboard', ['entity_id' => auth()->user()->entity_id]);
            return redirect()->route('admin.home',auth()->user()->entity_id);// for test
        }
        return $next($request);
    }
}
