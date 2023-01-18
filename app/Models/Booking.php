<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customers_id');
    }
    public function tikets()
    {
        return $this->belongsTo(Tiket::class);
    }
    public function checkins()
    {
        return $this->hasOne(CheckIn::class, 'bookings_id');
    }
}