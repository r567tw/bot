<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class DeveloperMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = null)
    {
        if (!auth()->user()->is_developer){
            return abort(403);
        }
        return $next($request);
    }
}
