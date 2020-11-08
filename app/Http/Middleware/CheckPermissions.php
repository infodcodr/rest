<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermissions
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
        if(!auth()->user()->hasRole('Super Admin') && !auth()->user()->hasRole('Admin'))
        {
            return response()->json('No Permission','505');
        }
        return $next($request);
    }
}
