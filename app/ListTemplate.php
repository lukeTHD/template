<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListTemplate extends Model
{
    use SoftDeletes;

    protected $table = 'list_template';

    protected $fillable = [
        'id',
        'name',
        'avatar',
        'price',
        'status',
        'code'
    ];

    public $timestamps = false;
}
