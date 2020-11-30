<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuth
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
        $user = session()->get('profile');
        $fCode = session()->get('f_code');
        if($user['Id'] != $fCode){
            abort(401);
        }
        return $next($request);
    }
}
