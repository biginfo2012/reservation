<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'shop_code', 'shop_name', 'post_code', 'address_1', 'address_2', 'phone', 'represent', 'represent_phone', 'note', 'deleted_at'
    ];
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
