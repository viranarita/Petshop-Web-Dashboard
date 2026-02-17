<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
