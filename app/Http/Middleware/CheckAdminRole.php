<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminRole
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
        if (session()->has('loggedUser')) {
                if(session('loggedUser')->rola_id==1) {
                return $next($request);
            }
        }
        
        return redirect('/roleError');
        //

    }
}
