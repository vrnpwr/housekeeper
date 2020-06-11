<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CleanerMiddleware
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
        if(Auth::check() && Auth::user()->type == 'cleaner' || Auth::check() && Auth::user()->type == 'SuperAdmin')
        return $next($request);
        abort(403);
        // return redirect('/');
    }
}
