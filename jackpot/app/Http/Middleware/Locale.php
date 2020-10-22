<?php

namespace App\Http\Middleware;

use Closure;

class Locale
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
        $uid = 0;
        if (session()->has('token') && check_token(session('token'))) $uid = auth()->user()->id;
        $locale = setting('site_language', $uid)->value;
        app()->setLocale($locale);
        return $next($request);
    }
}
