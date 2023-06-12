<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'menu_id', 'user_id', 'parent_menu'
    ];
    public function menu(){
        return $this->hasOne(Menu::class, 'id', 'menu_id');
    }
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
