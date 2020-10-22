<?php

namespace App\Repositories\User;

use App\Repositories\RepositoriesAbstract;
use App\Repositories\User\UserInterface;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends RepositoriesAbstract implements UserInterface
{

    protected $creditModel;
    protected $gameConfigModel;
    protected $gameModel;
    protected $ticketModel;

//    protected $

    public function __construct(Model $model, Model $creditModel, Model $gameConfigModel, Model $gameModel, Model $ticketModel)
    {
        parent::__construct($model);
        $this->creditModel = $creditModel;
        $this->gameConfigModel = $gameConfigModel;
        $this->gameModel = $gameModel;
        $this->ticketModel = $ticketModel;
    }

    public function getStatistic()
    {
        return $this->model->with(['credits' => function ($query) {
            $query->where('currency', config('constants.currency.usdt'))->orderBy('id', 'desc')->first();
        }])->get();
    }

    public function login($user, $token)
    {
        $user_id = 0;
        $instance = $this->model->where('uid', $user['user_id']);
        if ($instance->exists()) {
            $user = $instance->update([
                'email' => $user['email'],
                'name' => $user['name'],
                'token' => json_encode($token),
                'user_info' => json_encode($user),
                'is_agency' => is_agency($token['access_token']) ? 1 : 0
            ]);

            $user_id = $instance->first()->id;
        } else {
            $user = $this->create([
                'uid' => $user['user_id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'token' => json_encode($token),
                'group_id' => 3,
                'user_info' => json_encode($user),
                'is_agency' => is_agency($token['access_token']) ? 1 : 0
            ]);
            $user_id = $user->id;

            // Create credit for the user

            $this->creditModel->create([
                'uid' => $user_id,
                'value' => 0,
                'currency' => config('constants.currency.usdt')
            ]);

            $this->creditModel->create([
                'uid' => $user_id,
                'value' => 0,
                'currency' => config('constants.currency.epoint')
            ]);

            $this->creditModel->create([
                'uid' => $user_id,
                'value' => 0,
                'currency' => config('constants.currency.eticket')
            ]);

        }
        if (exists($user_id)) return $this->model->where('id', $user_id)->get()->map(function ($value) {
            $value['language'] = setting('site_language', $value['id'])->value;
            return $value;
        })->first();
        else return false;
    }

    public function check_sso_id($sso_id)
    {
//        return $this->model->where("user_info", "like", '%,"user_id":"' . $sso_id . '",%')->first();
        return $this->model->where("uid", $sso_id)->first();
    }

    public function get($id)
    {
        $user = $this->model->with(['credits' => function ($query) {
            $query->with('credit_activities');
        }, 'group'])->findOrFail($id);
        $user['user_info'] = json_decode($user['user_info'], true);
        return $user;
    }

    public function get_list_affiliator_of_user($arrUser = [])
    {
        if (count($arrUser) < 1) {
            return null;
        }
        return $this->model->select("user_info", "uid")->whereIn("uid", $arrUser)->get();
    }

    public function myCredit($uid, $currency)
    {
        if (isset(config('constants.currency')[$currency])) {
            return $this->creditModel->where(['uid' => $uid, 'currency' => config('constants.currency')[$currency]])->orderBy('id', 'DESC')->first();
        }
        return null;
    }

    public function topWinners()
    {
        $games_config = $this->gameModel->with(['games_config' => function ($query) {
            $query->where('type', 'before')->with(['tickets' => function ($query) {
                $query->where('status', 'success')->orderBy('prize_value', 'DESC')->with('user');
            }]);
        }])->first()->games_config;

        return $games_config->map(function ($value) {
            $data['name'] = $value['title'];
            $data['users'] = $value['tickets']->sortByDesc('prize_value')->map(function ($value) {
                $data['user_id'] = $value['user']['uid'];
                $data['name'] = $value['user']['name'];
                $data['money'] = $value['prize_value'];
                return $data;
            })->toArray();
            return $data;
        })->take(3)->toArray();
    }

    public function createSsoUser($sso_id)
    {
        if (!$this->getModel()->where('uid', $sso_id)->exists()) {
            $user = $this->create([
                'uid' => $sso_id,
                'group_id' => 3
            ]);

            $user_id = $user->id;

            // Create credit for the user

            $this->creditModel->create([
                'uid' => $user_id,
                'value' => 0,
                'currency' => config('constants.currency.usdt')
            ]);

            $this->creditModel->create([
                'uid' => $user_id,
                'value' => 0,
                'currency' => config('constants.currency.epoint')
            ]);

            $this->creditModel->create([
                'uid' => $user_id,
                'value' => 0,
                'currency' => config('constants.currency.eticket')
            ]);

            return $user;
        }

        return null;
    }

    public function getSsoIdById($id)
    {
        return $this->model->select('uid')->where('id', $id)->first()->uid;
    }

    public function getIdBySsoId($sso_id)
    {
        return $this->model->select('id')->where('uid', $sso_id)->first()->id;
    }

    public function getUsersByParentId($sso_id)
    {
        return $this->model->where("user_info", "like", '%,"parent_id":"' . $sso_id . '",%')->get();
    }
}
