<?php

namespace App\Helpers\Eticket;

use Carbon\Carbon;

class Wallet
{
    private $base_ul = "https://wallet-api.elegend.io";
    private $key_primary = "";
    private $key_secret = "";

    public function __construct($key_primary, $key_secret)
    {
        $this->key_primary = $key_primary;
        $this->key_secret = $key_secret;
    }

    protected $header = [];

    function getKey($path, $METHOD)
    {
        $TIMESTAMP = Carbon::now()->timestamp;
//        echo $TIMESTAMP . $METHOD . $path;die;
        $hash = hash_hmac("sha256", $TIMESTAMP . $METHOD . $path, $this->key_secret);
        $header = [
            "Content-Type" => "application/json",
            "WAL-ACCESS-KEY" => $this->key_primary,
            "WAL-ACCESS-SIGN" => strtolower($hash),
            "WAL-ACCESS-TIMESTAMP" => (string)$TIMESTAMP];
        $this->header = $header;
    }

    public function getListAccount()
    {
        $path = "/api/v1/public/accounts";
        $method = "GET";
        $this->getKey($path, $method);
//        return $this->header;
        $result = Call::connect($this->base_ul . $path, $method, $this->header, []);
        if (is_object(json_decode($result))) {
            return json_decode($result);
        }
        return ($result);
    }

    public function Withdraw($currency, $wallet_from, $wallet_to, $amount, $description)
    {
        $path = "/api/v1/public/wallet/withdraw";
        $method = "POST";
        $dataSend = [
            "currency" => $currency,
            "to" => $wallet_to,
            "description" => $description,
            "amount" => (string) $amount
        ];
        $this->getKey($path, $method);
        return Call::connect($this->base_ul . $path, $method, $this->header, $dataSend);

    }
}
