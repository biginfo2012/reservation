<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'reservation_code', 'shop_id', 'client_id', 'reservation_time', 'note', 'deleted_at'
    ];
    public function shop(){
        return $this->hasOne(Shop::class, 'id', 'shop_id');
    }
    public function client(){
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
    public function menu(){
        return $this->hasMany(ReservationMenu::class, 'reservation_id', 'id')->with('menu');
    }
}
