<?php

namespace App\Repositories\Request;

use App\Credit;
use App\Repositories\Credit\CreditInterface;
use App\Repositories\CreditActivity\CreditActivityInterface;
use App\Repositories\RepositoriesAbstract;
use Illuminate\Support\Facades\DB;

class RequestRepository extends RepositoriesAbstract implements RequestInterface
{
    public function updateStatus($id, $status, array $data_credit)
    {
        DB::beginTransaction();
        try {
            $last_credit = app(CreditInterface::class)->getBalanceByIdWithCurrency($data_credit['uid'], $data_credit['currency']);
            if ($last_credit->value < $data_credit['amount']) {
//                echo 1;
                DB::rollBack();
                return false;
            }
            $this->model->where('id', $id)->update([
                'status' => $status,
                'is_auto' => isset($data_credit['is_auto']) && $data_credit['is_auto'] === 1 ? 1 : 0
            ]);
            //add new credit
            $idCredit = app(CreditInterface::class)->getModel()->create([
                "uid" => $data_credit['uid'],
                "value" => format_number_money($last_credit->value - $data_credit['amount']),
                "currency" => $data_credit['currency']
            ])->id;
            //add activity
            app(CreditActivityInterface::class)->getModel()->create([
                "uid" => $data_credit['uid'],
                "credit_id" => $idCredit,
                "value" => $data_credit['amount'],
                "old_value" => $last_credit->value,
                "type" => config("constants.credit.type.minus"),
                "reason" => "Withdraw request:{$id}",
                "note" => "Withdraw request:{$id}"
            ]);
            DB::commit();
            return true;
        } catch (\Exception $exception) {

            DB::rollBack();
            return false;
        }
    }
}

