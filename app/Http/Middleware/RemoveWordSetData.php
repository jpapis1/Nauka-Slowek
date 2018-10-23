<?php

namespace App\Http\Middleware;

use Closure;

class RemoveWordSetData
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
        if (session()->has('wordSetData')) {
            session()->forget('wordSetData');
        }
        if (session()->has('showResult')) {
            session()->forget('showResult');
        }
        return $next($request);
    }
}
