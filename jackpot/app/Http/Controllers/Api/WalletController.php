<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Vault\VaultInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Validator;
use App\Repositories\User\UserInterface;
use App\Repositories\Credit\CreditInterface;
use App\Helpers\Eticket\Wallet;
use App\Helpers\Eticket\Major;
use App\Helpers\Game\RewardGame;
use Mail;
use App\Mail\MailBuy;

class WalletController extends Controller
{
    protected $URep;
    protected $CreditRep;
    protected $vaultRepository;

    public function __construct(UserInterface $userRepository, CreditInterface $creditIF, VaultInterface $vaultRepository)
    {
        $this->URep = $userRepository;
        $this->CreditRep = $creditIF;
        $this->wallet = Major::wallet;
        $this->vaultRepository = $vaultRepository;
    }


    public function testView()
    {
        $n = 5;
        $wallet_root = new Wallet('x8om8Y4LaH6Xhn0B', 'hlgUnSBjBYdYQXr8GSfCPvVbcdsjfkdj');
        // 0: ok
        // 1: fail
        // 2: ok
        // 3: ok
        // 4: fail
        // 5: ok
        // 6: fail
        // 7: ok
        // 8: ok
        // 9: fail
        $result_tranfer = $wallet_root->Withdraw('ETI', '368732056', '148996097', round($n, 8), 'Test withdraw');
        $result_tranfer = json_decode($result_tranfer, true);
        dd($result_tranfer);
    }

    /* Deposit money from main wallet to jackpot */
    public function Deposit(Request $request)
    {
        try {
            $param = $request->all();

            $param['RefId'] = (string)$param['refId'];
            $param['UserSsoId'] = $param['userSsoId'];
            $param['Hash'] = $param['hash'];
            $param['Amount'] = $param['amount'];
            $param['Currency'] = $param['currency'];
            $param['Sign'] = $param['sign'];
            $param['FromAddress'] = $param['fromAddress'];
            $param['ToAddress'] = $param['toAddress'];
            $param['Nonce'] = isset($param['nonce']) ? $param['nonce'] : "";
            $param['Time'] = isset($param['time']) ? $param['time'] : "";
            $data_user = $this->check_input($param);
            if ($data_user['status'] === "Error") {
//              old log =>  Log::error(["Deposit", 'validate error', $param, $data_user, $request->ip()]);
                Log::channel('wallet')->error('wallet:deposit:error', [
                    'param' => $param,
                    'data_user' => $data_user,
                    'ip' => $request->ip()
                ]);
                return response()->json($data_user);
            }
            $data_user = $data_user['data'];
//        return response()->json($data_user);
//        dd($data_user->id);
            //save data deposit and add credit for user
            $result_deposit = $this->CreditRep->deposit_credit($param, $data_user->id);
            if (!$result_deposit) {
//               old log => Log::error(["Deposit", 'unexpected error', $param, $result_deposit, $request->ip()]);
                Log::channel('wallet')->error('wallet:deposit:error', [
                    'param' => $param,
                    'data_user' => $data_user,
                    'ip' => $request->ip(),
                    'msg' => 'unexcepted error while deposit credit'
                ]);
                return response()->json(['status' => "Error", 'ex' => ['unexpected error'], "data" => []]);
            }
// old log =>            Log::info(["Deposit", "success", $result_deposit, $request->ip()]);
            Log::channel('wallet')->info('wallet:deposit:success', [
                'param' => $param,
                'data_user' => $data_user,
                'ip' => $request->ip()
            ]);
            return response()->json(['status' => "Success", 'ex' => [], "data" => ["success"]]);
        } catch (\Exception $exception) {
//           old log => Log::error(["Deposit", "unexpected error", $exception->getMessage(), $request->ip()]);
            Log::channel('wallet')->error('wallet:deposit:error:code', [
                'param' => $request->all(),
                'ip' => $request->ip(),
                'exception_msg' => $exception->getMessage()
            ]);
            return response()->json(['status' => "Error", 'ex' => ['unexpected error'], "data" => [$exception->getMessage()]]);
        }

    }

    // Received money from another platform
    public function Crate(Request $request)
    {

        try {
            $param = $request->all();

            $param['RefId'] = (string)$param['refId'];
            $param['UserSsoId'] = $param['userSsoId'];
            $param['Hash'] = $param['hash'];
            $param['Amount'] = $param['amount'];
            $param['Currency'] = $param['currency'];
            $param['Sign'] = $param['sign'];
            $param['FromAddress'] = $param['fromAddress'];
            $param['ToAddress'] = $param['toAddress'];
            $param['Nonce'] = isset($param['nonce']) ? $param['nonce'] : "";
            $param['Time'] = isset($param['time']) ? $param['time'] : "";
            $data_user = $this->check_input($param);
            if ($data_user['status'] === "Error") {
                Log::channel('wallet')->error('wallet:crate:error', [
                    'param' => $param,
                    'data_user' => $data_user,
                    'ip' => $request->ip()
                ]);
                return response()->json($data_user);
            }
            $data_user = $data_user['data'];
//        return response()->json($data_user);
//        dd($data_user->id);
            //save data deposit and add credit for user
            $result_deposit = $this->vaultRepository->addAmountToJackpotCrate($param['Amount'], $param);
            if (!$result_deposit) {
                Log::channel('wallet')->error('wallet:crate:error', [
                    'param' => $param,
                    'data_user' => $data_user,
                    'ip' => $request->ip(),
                    'msg' => 'unexcepted error while add amount to jackpot crate'
                ]);
                return response()->json(['status' => "Error", 'ex' => ['unexpected error'], "data" => []]);
            }
            Log::channel('wallet')->info('wallet:crate:success', [
                'param' => $param,
                'data_user' => $data_user,
                'ip' => $request->ip()
            ]);
            return response()->json(['status' => "Success", 'ex' => [], "data" => ["success"]]);
        } catch (\Exception $exception) {
            Log::channel('wallet')->error('wallet:crate:error:code', [
                'param' => $request->all(),
                'ip' => $request->ip(),
                'exception_msg' => $exception->getMessage()
            ]);
            return response()->json(['status' => "Error", 'ex' => ['unexpected error'], "data" => [$exception->getMessage()]]);
        }

    }

    private function check_input($param)
    {
        $condition = [
            "RefId" => "required",
            "UserSsoId" => "required",
            "Currency" => "required",
            "Hash" => "required",
            "FromAddress" => "required",
            "ToAddress" => "required",
            "Amount" => "required|numeric",
//            "Nonce" => "required",
//            "Time" => "required",
            "Sign" => "required",
        ];


        $validator = Validator::make($param, $condition);
        if ($validator->fails()) {
            return (array(
                'status' => "Error",
                'ex' => $validator->getMessageBag()->toArray(),
                "data" => []
            ));
        }

        // Check valid from address

        //check exist UserSsoId
        $check_sso_id = $this->URep->check_sso_id($param['UserSsoId']);
        if (!$check_sso_id) {
            return (array(
                'status' => "Error",
                'ex' => ["UserSsoId" => "Not found!"],
                "data" => []
            ));
        }
        //check exist RefId
        $check_refId = $this->CreditRep->check_RefId_deposit($param['RefId']);
        if (isset($check_refId) && !empty($check_refId)) {
            return ([
                'status' => "Error",
                "ex" => ["This deposit has previously been made"],
                "data" => []
            ]);
        }
        return ['status' => true, "ex" => [""], "data" => $check_sso_id];

    }


    public function test(Request $request)
    {
        $a = 10;
        $b = 20;
        $c = 21;
        $d = 49;
        $total = 7121.12111;
        $value_a = format_number_money($total * $a / 100);
        $value_b = format_number_money($total * $b / 100);
        $value_c = format_number_money($total * $c / 100);
        $value_d = format_number_money($total - ($value_a + $value_b + $value_c));
//        $value_d = format_number_money($total * $d / 100);
        dd($value_a, $value_b, $value_c, $value_d, ($value_a + $value_b + $value_c + $value_d));
        $dataMail = [
            "display_name" => "sjdfklds",
            "status" => "success",
            "total_price" => 1000,
            "game_name" => "5x36",
            "price" => "1",
            "amount" => 1,
            "ROTATE_TIME" => "sadas",
            "GAME_CODE" => 'asdas',
            "TOTAL_VAULT" => "asdasd"
        ];
        Mail::to("thanhaideveloper@gmail.com")->send(new MailBuy($dataMail));
        echo now();
        die;
//        return true;
        $wallet = new Wallet(env("KEY_API_ROOT_PRIMARY"), env("KEY_API_ROOT_SECRET"));
        $result = $wallet->Withdraw(
            "ETI",
            "",
            "479719875",
            1000,
            "test withdraw to MR.Hai"
        );
        dd($result, $request->ip(), $request->ips());
    }

    public function testRewardGame(RewardGame $rewardGame)
    {
        $rewardGame->init("5x36", "5", ['402461137']);
        $result = $rewardGame->run();
        var_dump($result);
        $money_winner = $rewardGame->getMoneyWinner();
        echo $money_winner;
        die;
    }
}
