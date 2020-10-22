<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session()->has('token') && check_token(session('token'))) {
            return $next($request);
        }
        return redirect()->route('admin.auth.login');
    }
}
