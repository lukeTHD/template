<?php

namespace App\Http\Middleware;

use Closure;

class AuthClient
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
        session(['route_client_request_login' => $request->getPathInfo()]);
        if (session()->has('is_auth_client')&&session('is_auth_client')) {
            if(session()->has('language')) {
                app()->setLocale(session('language'));
            }
            return $next($request);
        }
        return redirect()->route("client.home.index");
    }
}
