<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lottery extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function lottery_activities()
    {
        return $this->hasMany(LotteryActivity::class, 'lottery_id');
    }

    public function lotteries_rost()
    {
        return $this->hasMany(LotteryRost::class, 'lottery_id');
    }

    public function getNumbersAttribute($value)
    {
        return json_decode($value, true);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'lottery_id');
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class, 'lottery_id');
    }
}
