<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class Credit extends Model
{
    //
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'uid');
    }

    public function credit_activities()
    {
        return $this->hasMany(CreditActivity::class, 'credit_id');
    }

    public static function updateCredit($uid, $value, $type, $reason, $note)
    {
        DB::beginTransaction();
        try {
            $instance = Credit::where('uid', $uid);
            if ($instance->exists()) {
                $credit = $instance->first();
                $money = null;
                $old_value = (float)$credit->value;
                if ($type === 'plus') {
                    $money = $old_value + (float)$value;
                }
                if ($money) {
                    $instance->update([
                        'value' => $money,
                        'updated_at' => now()
                    ]);

                    CreditActivity::create([
                        'credit_id' => $credit->id,
                        'uid' => $uid,
                        'value' => (float)$value,
                        'type' => $type,
                        'reason' => $reason,
                        'note' => $note
                    ]);
                }
            }
            DB::commit();
            return $credit;
        } catch (\Exception $ex) {
            DB::rollback();
            throw new $ex;
        }
    }
}
