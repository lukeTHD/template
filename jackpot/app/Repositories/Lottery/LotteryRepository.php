<?php

namespace App\Repositories\Lottery;

use App\Lottery;
use App\Repositories\RepositoriesAbstract;
use Carbon\Carbon;

class LotteryRepository extends RepositoriesAbstract implements LotteryInterface
{
    public function create(array $attributes)
    {
        $lottery = new $this->model($attributes);

        $lottery->save();

        return $lottery;
    }

    public function check_divided_game_in_date($date)
    {
        $begin = Carbon::parse($date)->startOfDay()->toDateTimeString();
        $end = Carbon::parse($date)->endOfDay()->toDateTimeString();
        return $this->model->whereBetween("created_at", [$begin, $end])->orderBy('id','DESC')->first();
    }

    public function lotteryHistory()
    {
        if (session()->has('is_auth_client') && session('is_auth_client')) {
            return $this->model->orderBy('id', 'DESC')->with(['tickets' => function ($query) {
                return $query->with('prize');
            }])->paginate(config('constants.pagination.lottery'));
        }
        return null;
    }
}
