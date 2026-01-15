<?php

namespace App\Http\Middleware;

use Closure;

class BursarMiddleware
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
        if(auth()->check() && auth()->user()->account_type == 'bursar')
        {
            return $next($request);
        }

        return redirect()->route('login')->with('danger', 'Please sign in to continue');
    }
}
