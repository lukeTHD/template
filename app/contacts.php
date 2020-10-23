<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class contacts extends Model
{
    protected $table = 'contacts';
    protected $fillable = [
        'id',
        'fromId',
        'toId',
        'content',
        'status',
        'link',
        'type',
    ];
    public $timestamps = true;
}
