<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\ShopSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    //
    public function index($id){
        $shop = Shop::where('shop_code', $id)->first();
        $shop_setting = ShopSetting::where('shop_id', $shop->id)->first();
        $user_id = $shop->user_id;
        $menus = Menu::with('user')->whereHas('user', function ($query) use ($user_id){
            $query->where('user_id', $user_id);
        })->whereNull('deleted_at')->orderBy('order')->get();
        return view('reservation', compact('shop', 'shop_setting', 'menus'));
    }
}
