<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckIn extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $table = 'check_ins';

    public function bookings()
    {
        return $this->belongsTo(Booking::class);
    }
}