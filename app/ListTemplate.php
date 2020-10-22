<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListTemplate extends Model
{
    protected $table = 'list_template';

    protected $fillable = [
        'id',
        'name',
        'avatar',
        'code'
    ];

    public $timestamps = false;
}
