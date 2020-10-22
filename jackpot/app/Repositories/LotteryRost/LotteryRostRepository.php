<?php

namespace App\Repositories\LotteryRost;

use App\Lottery;
use App\Repositories\RepositoriesAbstract;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LotteryRostRepository extends RepositoriesAbstract implements LotteryRostInterface
{
    public function rost($lottery_id, $game, $numbers)
    {
        DB::beginTransaction();
        try {
            $time_lottery = Carbon::createFromFormat('H:i:s', $game->roll_time);
            $time_appear = Carbon::createFromFormat('H:i:s', $game->appear_time);
            $second_diff = $time_appear->diffInSeconds($time_lottery);
            $second_to_add = $second_diff / count($numbers);
            $stt = 1;

            $lotteriesRost = collect($numbers)->map(function ($value) use ($lottery_id, &$time_lottery, $second_to_add, &$stt) {
                $data['lottery_id'] = $lottery_id;
                $data['value'] = $value;
                $data['appear_time'] = $time_lottery->addSeconds($second_to_add)->format("H:i:s");
                $data['created_at'] = now();
                $data['sort'] = $stt++;
                return $data;
            })->toArray();

            $this->model->insert($lotteriesRost);
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollback();
            throw new $ex;
        }
    }
}
