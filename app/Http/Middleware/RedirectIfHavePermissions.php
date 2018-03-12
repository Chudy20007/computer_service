<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class RedirectIfHavePermissions
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
        if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isSupervisor()))
        {
            return $next($request);
            
        }
        
        return response(view('user.access_denied'));
    }
}
