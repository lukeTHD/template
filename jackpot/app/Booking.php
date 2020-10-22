<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $table = 'booking';
    protected $guarded = [];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'booking_id');
    }
}
