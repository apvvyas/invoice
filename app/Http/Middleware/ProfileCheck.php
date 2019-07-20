<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ProfileCheck
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
        $user = Auth::user();
        $clear = false;

        if($user->hasCompleteProfile())
            $clear = true;

        if($clear)
            return $next($request);

        return redirect()->route('user.profile')->with('step','2');
    }
}
