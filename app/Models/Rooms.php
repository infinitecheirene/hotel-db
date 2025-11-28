<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rooms extends Model
{
    protected $table = 'rooms';
    protected $primaryKey = 'id';
    protected $fillable = [
        'room_name',
        'type',
        'price',
        'description',
        'amenities',
        'image_url',
        'available',
        'max_guests',
        'size',
        'location'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
