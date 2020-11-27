<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
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
        if(!session()->has('user_data') || !session()->has('profile')){
            return redirect()->route('user.get.logout');
        }
        $session = session()->get('profile');
        $group_id = $session['group_id'];
        if($group_id != 2){
            return redirect()->route('user.get.logout');
        }
        return $next($request);
    }
}
