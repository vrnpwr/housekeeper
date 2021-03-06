<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class HostMiddleware
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
        if(!Auth::user() == null){       
        if(!is_null(Auth::user()->type) && Auth::user()->type == 'host' || !is_null(Auth::user()->type) && Auth::user()->type == 'SuperAdmin'){
            return $next($request);
        }
    }else{
        abort(403);
            // return redirect('/');
        }
            
        
    }
}
