<?php

namespace App\Http\Middleware;

use Closure;

class IpRequestPaymentEticket
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
//        dd($request->server('HTTP_REFERER'));
        // echo 2;die;
        if (! in_array($request->ip(), \Config::get('constants.white_list'))) {
            \Log::error('IP address is not whitelisted', ['ip address', $request->ip()]);
            return abort(500);
         }

        return $next($request);
    }
}
