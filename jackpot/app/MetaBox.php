<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetaBox extends Model
{
    use SoftDeletes;
    //
    protected $table = 'meta_box';
    protected $guarded = [];
}
