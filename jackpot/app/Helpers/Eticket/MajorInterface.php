<?php


namespace App\Helpers\Eticket;


interface MajorInterface
{
    public static function wallet_buy_ticket(float $price, string $currency, string $description);

    public static function wallet_withdraw_user(string $to_wallet, string $currency, float $amount, string $description);
}
