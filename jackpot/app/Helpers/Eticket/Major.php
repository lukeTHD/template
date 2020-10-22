<?php


namespace App\Helpers\Eticket;

use Illuminate\Support\Facades\Log;

class Major implements MajorInterface
{
    const wallet = [
        "ROOT" => [
            "ETI" => "0x1ee59e86f7ba5f05d32068656fa74f7d8e286a35",
            "EPO" => "0xeed2bc51f567f7c6543223dd6a5db274b72b3231",
            "EUSDT" => "0xcb66973a7f6725b41774623039841c882b380fc0",
            "SSOID" => "368732056"
        ],
        "TOP" => [
            "ETI" => "0xb788e95dc7218483626a656f01288f511eb234f4",
            "EPO" => "0x85936e3717d4c8a65eae09224062fcfebf580a3d",
            "EUSDT" => "0x156b718a5d4a509501e7f93b5c9a0d614b412479",
            "SSOID" => "412570888"
        ]
    ];
    const config_award = [
        "ETI" => 20,
        "EPO" => 30,
        "EUSDT" => 50
    ];

    /**
     * @param float $amount
     * @param string $currency
     * @param string $description
     * @return bool
     * @example  wallet_buy_ticket(1000,"ETI","mua vé")
     * @description buy tranfer $amount root -> top ETI ->
     */
    public static function wallet_buy_ticket(float $amount, string $currency, string $description)
    {
//        echo env("KEY_API_ROOT_PRIMARY");die;
        try {
            $wallet_root = new Wallet(env("KEY_API_ROOT_PRIMARY"), env("KEY_API_ROOT_SECRET"));
            /** @var TYPE_NAME $wallet_root */
            $result_tranfer = $wallet_root->Withdraw($currency, self::wallet['ROOT']["SSOID"], self::wallet['TOP']["SSOID"], $amount, $description);
            // A
            $result_tranfer = json_decode($result_tranfer, true);
            if ($result_tranfer['status'] == config("constants.api_status_from_elegend.error")) {
                Log::channel('wallet')->error('wallet:buy_ticket:error', [
                    'amount' => $amount,
                    'from' => self::wallet['ROOT']["SSOID"],
                    'to' => self::wallet['TOP']["SSOID"],
                    'currency' => $currency,
                    'description' => $description,
                    'result_transfer' => $result_tranfer
                ]);
// old log          =>      Log::error(json_encode(["wallet_buy_ticket", $amount, $currency, $description, $result_tranfer]));
                return false;
            }
            Log::channel('wallet')->info('wallet:buy_ticket:success', [
                'amount' => $amount,
                'from' => self::wallet['ROOT']["SSOID"],
                'to' => self::wallet['TOP']["SSOID"],
                'currency' => $currency,
                'description' => $description,
                'result_transfer' => $result_tranfer
            ]);
//          old log =>   Log::info(json_encode(["wallet_buy_ticket", $amount, $currency, $description, $result_tranfer]));
            return true;
        } catch (\Exception $exception) {
            Log::channel('wallet')->error('wallet:buy_ticket:error:code', [
                'amount' => $amount,
                'from' => self::wallet['ROOT']["SSOID"],
                'to' => self::wallet['TOP']["SSOID"],
                'currency' => $currency,
                'description' => $description,
                'result_transfer' => $result_tranfer,
                'exception_msg' => $exception->getMessage()
            ]);
//          old log =>  Log::error(json_encode(["wallet_buy_ticket", $amount, $currency, $description, $exception->getMessage()]));
            return false;
        }
    }

    /**
     * @param string $to_wallet ssoID of user
     * @param string $currency
     * @param float $amount
     * @param string $description
     * @return bool
     * @description tranfer $amount root -> user
     */
    public static function wallet_withdraw_user(string $to_wallet, string $currency, float $amount, string $description)
    {
        try {
            $wallet_root = new Wallet(env("KEY_API_ROOT_PRIMARY"), env("KEY_API_ROOT_SECRET"));
            $result_tranfer = $wallet_root->Withdraw($currency, self::wallet['ROOT']["SSOID"], $to_wallet, $amount, $description);
// old log =>           Log::info(json_encode(["function" => "wallet_withdraw_user", $to_wallet, $currency, $amount, $description, $result_tranfer]));
            $result_tranfer = json_decode($result_tranfer, true);
            if ($result_tranfer['status'] == config("constants.api_status_from_elegend.error")) {
                Log::channel('wallet')->error('wallet:withdraw:error', [
                    'amount' => $amount,
                    'from' => self::wallet['ROOT']["SSOID"],
                    'to' => $to_wallet,
                    'currency' => $currency,
                    'description' => $description,
                    'result_transfer' => $result_tranfer
                ]);
                return false;
            }
            Log::channel('wallet')->info('wallet:withdraw:success', [
                'amount' => $amount,
                'from' => self::wallet['ROOT']["SSOID"],
                'to' => $to_wallet,
                'currency' => $currency,
                'description' => $description,
                'result_transfer' => $result_tranfer
            ]);
            return true;
        } catch (\Exception $exception) {
            Log::channel('wallet')->info('wallet:withdraw:error:code', [
                'amount' => $amount,
                'from' => self::wallet['ROOT']["SSOID"],
                'to' => $to_wallet,
                'currency' => $currency,
                'description' => $description,
                'result_transfer' => $result_tranfer,
                'exception_msg' => $exception->getMessage()
            ]);
//         old log =>   Log::error(json_encode(["function" => "wallet_withdraw_user", $to_wallet, $currency, $amount, $description, "exception" => $exception->getMessage()]));
            return false;
        }
    }

    /**
     * @param float $amount
     * @param string $description
     * @return bool
     * @description tranfer $amount top -> root
     */
    public static function wallet_award_user(float $amount, string $currency, string $description)
    {
        try {
            $wallet_root = new Wallet(env("KEY_API_TOP_PRIMARY"), env("KEY_API_TOP_SECRET"));
            $wallet_root = $wallet_root->Withdraw($currency, self::wallet['TOP']["SSOID"], self::wallet['ROOT']["SSOID"], $amount, $description);
//            dd($wallet_root);
            $wallet_root = json_decode($wallet_root, true);
            if ($wallet_root['status'] == config("constants.api_status_from_elegend.error")) {
                Log::channel('wallet')->error('wallet:award:error',[
                    'amount' => $amount,
                    'from' => self::wallet['TOP']["SSOID"],
                    'to' => self::wallet['ROOT']["SSOID"],
                    'currency' => $currency,
                    'description' => $description,
                    'result_transfer' => $wallet_root
                ]);
                return false;
            }
            Log::channel('wallet')->info('wallet:award:success',[
                'amount' => $amount,
                'from' => self::wallet['TOP']["SSOID"],
                'to' => self::wallet['ROOT']["SSOID"],
                'currency' => $currency,
                'description' => $description,
                'result_transfer' => $wallet_root
            ]);
// old log =>           Log::info(json_encode(["function" => "wallet_award_user", $currency, $amount, $description, $wallet_root]));
            return true;
        } catch (\Exception $exception) {
            Log::channel('wallet')->error('wallet:award:error:code',[
                'amount' => $amount,
                'from' => self::wallet['TOP']["SSOID"],
                'to' => self::wallet['ROOT']["SSOID"],
                'currency' => $currency,
                'description' => $description,
                'result_transfer' => $wallet_root,
                'exception_msg' => $exception->getMessage()
            ]);
            return false;
        }
    }

    public static function tranfer_to_wallet($Name_Key = "ROOT", string $to_wallet, string $currency, float $amount, string $description)
    {
        try {
            $wallet_root = new Wallet(env("KEY_API_" . $Name_Key . "_PRIMARY"), env("KEY_API_" . $Name_Key . "_SECRET"));
            $result_tranfer = $wallet_root->Withdraw($currency, self::wallet[$Name_Key]["SSOID"], $to_wallet, $amount, $description);
            $result_tranfer = json_decode($result_tranfer, true);
            if ($result_tranfer['status'] == config("constants.api_status_from_elegend.error")) {
                Log::channel('wallet')->error('wallet:transfer:error',[
                    'amount' => $amount,
                    'from' => self::wallet[$Name_Key]["SSOID"],
                    'to' => $to_wallet,
                    'currency' => $currency,
                    'description' => $description,
                    'result_transfer' => $result_tranfer
                ]);
                return false;
            }
            Log::channel('wallet')->info('wallet:transfer:success',[
                'amount' => $amount,
                'from' => self::wallet[$Name_Key]["SSOID"],
                'to' => $to_wallet,
                'currency' => $currency,
                'description' => $description,
                'result_transfer' => $result_tranfer
            ]);
            return true;
        } catch (\Exception $exception) {
            Log::channel('wallet')->error('wallet:transfer:error:code',[
                'amount' => $amount,
                'from' => self::wallet[$Name_Key]["SSOID"],
                'to' => $to_wallet,
                'currency' => $currency,
                'description' => $description,
                'result_transfer' => $result_tranfer,
                'exception_msg' => $exception->getMessage()
            ]);
            return false;
        }
    }

    /**
     * @param float $amount
     * @param string $currency
     * @param string $description
     * @return bool
     * @example  wallet_buy_ticket(1000,"ETI","mua vé")
     * @description buy tranfer $amount root -> top ETI ->
     */
    public static function recieved_amount_add_to_jackpot(float $amount, string $currency, string $description)
    {
//        echo env("KEY_API_ROOT_PRIMARY");die;
        try {
            $wallet_root = new Wallet(env("KEY_API_ROOT_PRIMARY"), env("KEY_API_ROOT_SECRET"));
            /** @var TYPE_NAME $wallet_root */
            $result_tranfer = $wallet_root->Withdraw($currency, self::wallet['ROOT']["SSOID"], self::wallet['TOP']["SSOID"], $amount, $description);


            $result_tranfer = json_decode($result_tranfer, true);
            if ($result_tranfer['status'] == config("constants.api_status_from_elegend.error")) {
                Log::error(json_encode(["wallet_buy_ticket", $amount, $currency, $description, $result_tranfer]));
                return false;
            }
            Log::info(json_encode(["wallet_buy_ticket", $amount, $currency, $description, $result_tranfer]));
            return true;
        } catch (\Exception $exception) {
            Log::error(json_encode(["wallet_buy_ticket", $amount, $currency, $description, $exception->getMessage()]));
            return false;
        }
    }
}
