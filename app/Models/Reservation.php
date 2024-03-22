<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'shops_id',
        'reservation_datetime',
        'number_of_guests',
    ];

    public function shop()
    {
        return $this->belongsToMany(Shops::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

}