<?php

namespace App\Http\Middleware;

use Closure;

class RedirectDashboard
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
        if (session()->has('is_auth_client') && session('is_auth_client')) {
            return redirect()->route("client.dashboard.index");
        }
        return redirect()->route("client.user.get-login");
    }
}
