<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Config;
use Session;

class Locale
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
      $raw_locale = Session::get('locale');
      $locale = $raw_locale !== null ? $raw_locale : 'vi' ;
        App::setLocale($locale);
        return $next($request);
    }
}