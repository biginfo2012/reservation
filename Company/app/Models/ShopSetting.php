<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_id', 'image_url', 'start_time', 'end_time', 'reservation_unit', 'rest_day', 'accept_people'
    ];
}
