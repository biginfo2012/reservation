<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'menu_code', 'menu_name', 'description', 'order', 'price', 'require_time', 'display', 'deleted_at', 'note', 'over', 'ask'
    ];
    public function user(){
        return $this->hasOne(MenuUser::class, 'menu_id', 'id');
    }
}
