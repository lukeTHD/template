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

    public function showLogin(Request $request){

        if(session()->has('user_data') && session()->has('profile') && session()->has('f_code')){ 
            $result  = $this->api->getMyProfile(session('user_data')['token'] , session('f_code'));
            if($result['status'] == true){
                session([
                        'user_data' => [
                            'token' => session('user_data')['token'],
                            'group_id' => isset($result['data'][0]['group_id']) ? $result['data'][0]['group_id'] : '',
                            'Id' => isset($result['data'][0]['Id']) ? $result['data'][0]['Id'] : '' ],
                        'profile' => isset($result['data'][0]) ? $result['data'][0] : []
                        ]);
                return redirect()->route('user.get.showDashboard');
            }else if($result['code'] == 707){
                return redirect()->route('user.get.login')->with("errorMessage707", $result['msg'])->withInput($request->input());
            }else{
                return redirect()->route('user.get.login')->with("errorMessage", $result['code'])->withInput($request->input());
            };
           
        }
        return view('user.login');
    }
   
    public function checkLogin(Request $request){
        $param = $request->all();
        // $token = isset($param['token']) ? $param['token'] : '' ;
        // $fcode = isset($param['fcode']) ? $param['fcode'] : '' ;
        //Begin::Tài khoản demo
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhTWFpbiI6eyJJZCI6NjgsInJvbGUiOm51bGwsImdyb3VwX2lkIjo0LCJmaXJlYmFzZV90b2tlbiI6IiJ9LCJpYXQiOjE2MDUxNDYwMzR9.o1a2ro9j23qdajOFJUQ3sMGsmWAlwfrgSeuTl4iC1ww';
        $fcode = 2 ;
        //End::Tài khoản demo
        session(['f_code' => $fcode ]);
        $result  = $this->api->getMyProfile($token , $fcode);
        if($result['status'] == true){
            session([
                    'user_data' => [
                        'token' => $token,
                        'group_id' => isset($result['data'][0]['group_id']) ? $result['data'][0]['group_id'] : '',
                        'Id' => isset($result['data'][0]['Id']) ? $result['data'][0]['Id'] : '' ],
                    'profile' => isset($result['data'][0]) ? $result['data'][0] : []
                    ]);
            return redirect()->route('user.get.showDashboard');
        }else if($result['code'] == 707){
            return redirect()->route('user.get.login')->with("errorMessage707", $result['msg'])->withInput($request->input());
        }else{
            return redirect()->route('user.get.login')->with("errorMessage", $result['code'])->withInput($request->input());
        };
    }

    public function login(Request $request){

        $param = $request->all();
        $arrRules = [
            'username' => 'required',
            'password' => 'required'
        ];
        $validation = Validator::make($request->all(), $arrRules);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput($request->input());
        }
        $dataToLogin = [
            "mod" => "login",
            "username" => $param['username'],
            "password" => md5($param['password'])
        ];
        $result = $this->api->login($dataToLogin);
        if($result['status'] == true){
            session(['user_data' => isset($result['data'][0]) ? $result['data'][0] : [] ]);
            $result  = $this->api->getMyProfile();
            if($result['status'] == true){
                session(['profile' => isset($result['data'][0]) ? $result['data'][0] : []]);
            }
            return redirect()->route('user.get.showDashboard');
        }else if($result['code'] == 707){
            return redirect()->route('user.get.login')->with("errorMessage707", $result['msg'])->withInput($request->input());
        }else{
            return redirect()->route('user.get.login')->with("errorMessage", $result['code'])->withInput($request->input());
        }
    }

    public function showDashboard(){
        $page_title = 'Dashboard';
        $page_description = 'Template Website';
        return view('pages.dashboard', compact('page_title', 'page_description'));
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