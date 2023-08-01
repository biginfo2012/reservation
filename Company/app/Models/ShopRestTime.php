<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopRestTime extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_id', 'rest_time'
    ];
}
