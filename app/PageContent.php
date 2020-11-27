<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageContent extends Model
{
    use SoftDeletes;

    protected $table = 'page_contents';

    protected $fillable = [
        'id',
        'id_user',
        'id_page',
        'name',
        'status',
        'content',
        'list_product',
        'list_section'
    ];

    public $timestamps = true;
}
