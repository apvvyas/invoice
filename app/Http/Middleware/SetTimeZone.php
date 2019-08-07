<?php

namespace App\Http\Middleware;

use Closure;

class SetTimeZone
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
       /* $timezone = session('timezone');
        if(!empty($timezone))
            date_default_timezone_set($timezone);*/
        return $next($request);
    }
}
