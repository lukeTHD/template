<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LotteryRost extends Model
{
    //
    protected $table = 'lotteries_rost';

    protected $guarded = [];

    public function lottery()
    {
        return $this->belongsTo(Lottery::class, 'lottery_id');
    }
}
