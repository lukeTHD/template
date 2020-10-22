<?php

namespace App\Repositories\Credit;

use App\Repositories\RepositoriesAbstract;
use App\CreditActivity;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Request;

class CreditRepository extends RepositoriesAbstract implements CreditInterface
{

    protected $userModel;

    protected $creditActivityModel;

    public function __construct(Model $model)
    {
        $this->userModel = new User();
        $this->creditActivityModel = new CreditActivity();
        parent::__construct($model);
    }

    public function getStatistic()
    {
        return $this->userModel->whereNotNull('uid')->with(['credits' => function ($query) {
            $query->where([
                'currency' => config('constants.currency.usdt'),
            ])->get();
        }])->get()->filter(function ($value) {
            $last = $value['credits']->last();
            return $last['value'] > 0;
        })->map(function ($value) {
            $last = $value['credits']->last();
            $value['balance'] = $last['value'];
            $value['currency'] = $last['currency'];
            unset($value['credits']);
            return $value;
        })->sortByDesc('balance')->take(10);
    }

    public function getBalanceById($id, $currency = null)
    {
        return $this->model->select("value")->where(['uid' => $id, 'currency' => $currency])->orderBy("id", 'desc')->first();
    }

    public function getBalanceByIdWithCurrency($id, $currency)
    {
        return $this->model->select("value")->where('uid', $id)->where("currency", $currency)
            ->orderBy("id", 'desc')->first();
    }


    public function addRequestWithdraw($uid, $sso_id, $amount, $currency)
    {
        return Request::create([
            "uid" => $uid,
            "amount" => floatval($amount),
            "sso_id" => $sso_id,
            "currency" => $currency,
            "status" => config("constants.request.status.pending"),
            "type" => config("constants.request.type.withdraw"),
//            'created_at' => now('UTC')
        ]);
    }

    public function check_RefId_deposit($Deposit)
    {
        return CreditActivity::where("reason", "like", '%,"RefId":"' . $Deposit . '",%')->orderBy("id", "desc")->first();
    }


    public function add_balance_for_user($amount, $currency, $description, $user_id)
    {
        $old_credit = $this->getBalanceByIdWithCurrency($user_id, $currency);
        $new_credit = isset($old_credit) ? floatval($old_credit->value) + floatval($amount) : floatval($amount);
        $new_credit_ = new $this->model([
            "uid" => $user_id,
            "value" => $new_credit,
            "currency" => $currency
        ]);
        $new_credit_->save();
        CreditActivity::create([
            "credit_id" => $new_credit_->id,
            "uid" => $user_id,
            "value" => floatval($amount),
            "type" => \Config::get('constants.credit')['type']['plus'],
            "reason" => json_encode([$amount, $currency, $description, $user_id]),
            "old_value" => isset($old_credit) ? floatval($old_credit->value) : 0,
            "note" => $description
        ]);
        return true;
    }

    public function deposit_credit($dataDeposit, $user_id)
    {
        try {
            $old_credit = $this->getBalanceByIdWithCurrency($user_id, $dataDeposit['Currency']);
            $new_credit = isset($old_credit) ? floatval($old_credit->value) + floatval($dataDeposit['Amount']) : floatval($dataDeposit['Amount']);
            DB::beginTransaction();
            //add new credit
            $new_credit = new $this->model([
                "uid" => $user_id,
                "value" => $new_credit,
                "currency" => $dataDeposit['Currency']
            ]);
            $new_credit->save();
            //add activity credit

            CreditActivity::create([
                "credit_id" => $new_credit->id,
                "uid" => $user_id,
                "value" => floatval($dataDeposit['Amount']),
                "type" => \Config::get('constants.credit')['type']['plus'],
                "reason" => json_encode([
                    "type" => "deposit",
                    "data" => $dataDeposit
                ]),
                "old_value" => isset($old_credit) ? floatval($old_credit->value) : 0,
                "note" => "deposit success"
            ]);
//            dd($new_credit);
            // database queries here
            DB::commit();
            $flag = true;
        } catch (\PDOException $e) {
//            return $e->getMessage();
            DB::rollBack();
            $flag = false;
        }
        return $flag;
    }

    public function myRequestWithdraw($request)
    {
        return Request::where(['uid' => auth_client()['id']])->orderBy("created_at", "DESC")
            ->paginate(config('constants.pagination.ticket'));
    }

    public function myCommission()
    {
        return $this->creditActivityModel->where('uid', auth_client()['id'])->where('note', 'like', '%divide affilliate user%')->get();
    }
}
