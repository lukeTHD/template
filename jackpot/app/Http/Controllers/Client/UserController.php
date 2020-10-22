<?php

namespace App\Http\Controllers\Client;

use App\Commission;
use App\CreditActivity;
use App\Helpers\Eticket\Major;
use App\Http\Controllers\Controller;
use App\Repositories\Commission\CommissionInterface;
use App\Repositories\FAQ\FAQInterface;
use App\Repositories\Request\RequestInterface;
use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;
use Validator;
use App\Repositories\Credit\CreditInterface;

class UserController extends Controller
{
    private $URep;
    private $CreditRep;
    private $commissionRepository;
    private $faqRepository;
    protected $requestRepository;
    protected $major;

    protected $ex = [
        "368732056" => "368732056",
        "412570888" => "412570888"
    ];

    public function __construct(UserInterface $user, CreditInterface $credit, CommissionInterface $commissionRepository, FAQInterface $faqRepository, RequestInterface $requestRepository, Major $major)
    {
        $this->URep = $user;
        $this->CreditRep = $credit;
        $this->commissionRepository = $commissionRepository;
        $this->faqRepository = $faqRepository;
        $this->requestRepository = $requestRepository;
        $this->major = $major;
    }

    public function getLogin()
    {
        //        dd($this->URep->find(1));
        return view("client.user.login");
    }

    public function postLogin(Request $request)
    {
        $token = get_token_from_api($request);
        if (isset($token['access_token'])) {
            $user = get_user_by_token_from_api($token);
            if (isset($this->ex[$user['user_id']])) {
                $return['client_redirect_uri'] = route('client.dashboard.index');
                return response()->json($return);
            }
            if (isset($user['user_id'])) {
                if ($auth = app(\App\Repositories\User\UserInterface::class)->login($user, $token)) {
                    $return = [
                        'user' => $user,
                        'token' => $token
                    ];

                    $redirect_uri = url()->to("/") . "/" . session("route_client_request_login");

//                    $return['client_redirect_uri'] = str_contains($redirect_uri,'logout') ? route('client.dashboard.index') : $redirect_uri;
                    $return['client_redirect_uri'] = route('client.dashboard.index');

                    $request->session()->put('is_auth_client', true);
                    $request->session()->put('data_client', $auth);
                    $request->session()->put('language', $auth->language);
                    // dd($return);
                    return response()->json($return);
                }
            }
        }

        return response()->json(false);
    }

    public function callback()
    {
        if (session()->has('is_auth_client') &&
            session('is_auth_client') && session()->has('data_client') && session('data_client')) {
            return redirect()->route('client.dashboard.index');
        }
        return view('client.user.callback');
    }

    public function logout()
    {
        session()->forget('is_auth_client');
        session()->forget('data_client');
        session()->forget('language');
        return redirect('https://id.elegend.io/Account/LogOff');
    }

    public function withdraw(Request $request)
    {
        return view("client.user.withdraw");
    }

    public function withdrawPost(Request $request)
    {
        $param = $request->all();

        $condition = [
            "amount" => "required|numeric|min:1",
            "currency" => "required|in:ETI,EUSDT,EPO"
        ];

        //check balance
        $validator = Validator::make($param, $condition);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        }

        $param['amount'] = $param['amount'];

        //check balance
        $checkBalance = $this->CreditRep->getBalanceByIdWithCurrency(session("data_client")['id'], $request->currency);
        if (!$checkBalance || $checkBalance->value < $param['amount']) {
            return response()->json(false);
        }

        $resultCreateRequest = $this->CreditRep->addRequestWithdraw(session("data_client")['id'], session("data_client")['uid'], $param['amount'], $request->currency);

        if (!$resultCreateRequest) {
            return response()->json(false);
        }

        if (setting('withdraw_request_method')->value === 'auto') {
            if (env('APP_ENV') === 'production') {
                $resutl_withdraw = $this->major->wallet_withdraw_user($resultCreateRequest->sso_id,
                    $resultCreateRequest->currency, $resultCreateRequest->amount,
                    $resultCreateRequest->sso_id . ' withdraw amount: ' . $resultCreateRequest->amount);
            } else {
                $resutl_withdraw = true;
            }

            if (!$resutl_withdraw) {
                return response()->json(false);
            }
            $data_credit = [
                "uid" => $resultCreateRequest->uid,
                "currency" => $resultCreateRequest->currency,
                "amount" => $resultCreateRequest->amount,
                'is_auto' => 1
            ];
            $result_update = $this->requestRepository->updateStatus($resultCreateRequest->id, config('constants.request.status.success'), $data_credit);
            if (!$result_update) {
                return response()->json(false);
            }
        }

        return response()->json(true);
    }

    public function myRequest(Request $request)
    {
        $color = [
            config("constants.request.status.pending") => [
                "color" => "color: #ffb822 !important;",
                "border" => "border-left: 3px solid #ffb822;"
            ],
            config("constants.request.status.success") => [
                "color" => "color: #0abb87 !important;",
                "border" => "border-left: 3px solid #0abb87;"
            ],
            config("constants.request.status.fail") => [
                "color" => "color: #fd397a !important;",
                "border" => "border-left: 3px solid #fd397a;"
            ]

        ];
        $data['my_request'] = $this->CreditRep->myRequestWithdraw($request);
        $data['history'] = CreditActivity::where('uid', auth_client()['id'])->where('note', 'like', '%deposit success%')
            ->orWhere('note', 'like', '%Withdraw request%')->with('credit')->orderBy('id', 'DESC')->paginate(10);
        $data['color'] = $color;
//        dd($data['my_request'] );
        return view("client.user.my-request", $data);
    }

    public function myCommission(Request $request)
    {
//        dd($this->commissionRepository->myCommissions());
        $data['my_commissions'] = $this->commissionRepository->myCommissions();
        return view("client.user.my-commissions", $data);
    }

    public function setSession(Request $request, $id = 7)
    {
        $request->session()->put('is_auth_client', true);
        $request->session()->put('data_client', $this->URep->find($id));

        return redirect()->route('client.home.index');
    }

    public function updateLanguage(Request $request)
    {
        if ($request->ajax()) {
            $update = update_setting("site_language", $request->language, auth_client()['id']);
            if ($update != false) {
                session(['language' => $request->language]);
                return response()->json(true);
            }
            return response()->json(true);
//            return
        }
    }

    public function getBalance(Request $request)
    {

        $request->validate([
            'currency' => 'required|in:ETI,EPO,EUSDT'
        ]);

        $response = numberFormat($this->CreditRep->getBalanceById(auth_client()['id'], $request->currency)->value);

        if ($request->has('to_number') && $request->to_number === 'true') {
            $response = filter_var($response, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        }

        return response()->json($response);
    }

    public function faq()
    {
        $data['faq'] = $this->faqRepository->listFAQ();
        return view("client.user.faq", $data);
    }
}
