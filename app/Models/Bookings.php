<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'room_name',
        'check_in',
        'check_out',
        'guest_no',
        'night_no',
        'special_requests',
        'total_amount',
        'status'
    ];
}
