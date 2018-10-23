<?php

namespace App\Http\Middleware;

use Closure;

class CheckResultInSession
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
        if (session()->has('showResult')) {
            session()->forget('showResult');
                return $next($request);

        }

        return redirect('/error');
    }
}
