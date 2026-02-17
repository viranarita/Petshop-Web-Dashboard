<?php

namespace App\Models;

use App\Models\Booking;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
