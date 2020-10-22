<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    protected $table = 'user_setting';

    protected $fillable = [
        'uid',
        'setting_code',
        'value'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'uid');
    }

    public function setting()
    {
        return $this->belongsTo(Setting::class, 'setting_code', 'code');
    }
}
