<?php

namespace App\Http\Middleware;

use Closure;

use Route;

use App\Helper\Api;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    private $api;
    public function __construct(Api $api){
        $this->api = $api;
    }
    public function handle($request, Closure $next)
    {
        $params = $request->query();
        if(isset($params['token'])){
            $result = $this->api->getMyProfile($params['token']);
            if($result['status'] == true){
                session(['user_data' => [
                    'token' => $params['token'],
                    'group_id' => $result['data'][0]['group_id'],
                    'Id' => $result['data'][0]['Id']
                ],  'profile' => $result['data'][0]]);
            }else{  
               return redirect()->route('user.get.login', ['is_expired' => 1]);
            }
        }
        if(!session()->has('user_data') || !session()->has('profile')){ 
            return redirect()->route('user.get.login');
        }
        return $next($request);

        
    }
}
