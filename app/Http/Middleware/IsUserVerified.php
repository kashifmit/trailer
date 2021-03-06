<?php

namespace App\Http\Middleware;

use Closure;

class IsUserVerified
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
        if (!(bool)$request->user()->is_verified || !(bool)$request->user()->is_authorized) {
            return \Redirect::route('not.allowed');
        }
        return $next($request);
    }
}
