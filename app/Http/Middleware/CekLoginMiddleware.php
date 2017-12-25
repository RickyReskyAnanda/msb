<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CekLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role)
    {
        if (!auth()->guest()) {
            if(Auth::user()->level == $role || $role == 'all')
                return $next($request);

        }
        if($role == 'RKPD')
            return redirect('rkpd');
        else
            return redirect('musrenbang');
    }
}
