<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helper\Api;
use Validator;
use Lang;
use View;

class UserController extends Controller
{
    //
    private $api;
    public function __construct(Api $api){
        $this->api = $api;
    }
   
    public function checkLogin(Request $request){
        $result     = $this->api->getMyProfile();
            if($result['status'] == true){
                session(['profile' => $result['data'][0]]);
            }
        
    }

    public function logout(){
        session()->forget(['profile', 'user_data']);
        return redirect()->route('user.get.login');
    }

    public function setLang($locale){
       session(['locale' => $locale]);
       return redirect()->back();
    }

    
}
