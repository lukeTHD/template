<?php

namespace App\Repositories\Credit;

interface CreditInterface
{
    public function getStatistic();

    public function getBalanceById($id, $currency);

    public function check_RefId_deposit($Deposit);

    public function deposit_credit($dataDeposit, $user_id);

    public function myCommission();
}
