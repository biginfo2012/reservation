<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    //
    public function index(){
        return view('reservation-manage');
    }
    public function reservationTable(Request $request){
        $date = $request->date;
        $shop_id = Shop::where('user_id', Auth::user()->id)->first()->id;
        $keyword = $request->keyword;
        if(isset($date)){
            if(isset($shop_id)){
                if(isset($keyword)){
                    $data = Reservation::with('shop', 'client', 'menu')->whereNull('deleted_at')->where('shop_id', $shop_id)
                        ->where('reservation_time', '>=', $date . " 00:00:00")->where('reservation_time', '<=', $date . " 23:59:59")
                        ->whereHas('client', function ($query) use ($keyword) {
                            $query->where('last_name', 'like', '%' . $keyword . '%')->orWhere('first_name', 'like', '%' . $keyword . '%')->orWhere('email', 'like', '%' . $keyword . '%')
                                ->orWhere('phone', 'like', '%' . $keyword . '%');
                        })->orderBy('created_at', 'desc')->get();
                }
                else{
                    $data = Reservation::with('shop', 'client', 'menu')->whereNull('deleted_at')->where('shop_id', $shop_id)
                        ->where('reservation_time', '>=', $date . " 00:00:00")->where('reservation_time', '<=', $date . " 23:59:59")
                        ->orderBy('created_at', 'desc')->get();
                }
            }
        }
        else{
            if(isset($shop_id)){
                if(isset($keyword)){
                    $data = Reservation::with('shop', 'client', 'menu')->whereNull('deleted_at')->where('shop_id', $shop_id)
                        ->whereHas('client', function ($query) use ($keyword) {
                            $query->where('last_name', 'like', '%' . $keyword . '%')->orWhere('first_name', 'like', '%' . $keyword . '%')->orWhere('email', 'like', '%' . $keyword . '%')
                                ->orWhere('phone', 'like', '%' . $keyword . '%');
                        })->orderBy('created_at', 'desc')->get();
                }
                else{
                    $data = Reservation::with('shop', 'client', 'menu')->whereNull('deleted_at')->where('shop_id', $shop_id)->orderBy('created_at', 'desc')->get();
                }
            }
        }
        return view('reservation-table', compact('data'));
    }

    public function reservationEdit($id){
        $data = Reservation::with('shop', 'client', 'menu')->find($id);
        return view('reservation-edit', compact('data'));
    }
    public function reservationGet(Request $request){
        $id = $request->id;
        $data = Reservation::with('shop', 'client', 'menu')->find($id);
        return response()->json(['status' => true, 'data' => $data]);
    }
    public function reservationCancelMail(Request $request){
        $reservation_id = $request->reservation_id;
        $reservation = Reservation::with('menu')->find($reservation_id);
        Reservation::find($reservation_id)->update(['deleted_at' => date('Y-m-d H:i:s')]);
        $client = Client::find($reservation->client_id);
        $shop = Shop::find($reservation->shop_id);
        $shop_user = User::find($shop->user_id);
        $manager = User::where('role', 0)->first();
        $weeks = ['月', '火', '水', '木', '金', '土', '日'];
        $w_index = date('w', strtotime($reservation->reservation_time));
        $weekday = $weeks[$w_index];
        $reservation_time_str = date('Y年m月d日', strtotime($reservation->reservation_time)) . "(" . $weekday . ") " . date("H:i", strtotime($reservation->reservation_time));
        $menu = $reservation->menu;
        $menu_name = "";
        $menu_price = 0;
        $menu_price_over = false;
        $menu_price_ask = false;
        foreach ($menu as $index => $item){
            if($index != count($menu) - 1){
                $menu_name .= $item->menu->menu_name . ",";
            }
            else{
                $menu_name .= $item->menu->menu_name;
            }
            $menu_price += $item->menu->price;
            if($item->menu->over){
                $menu_price_over = true;
            }
            if($item->menu->ask){
                $menu_price_ask = true;
            }
        }
        $menu_price = $menu_price_ask ? __('ask') : ($menu_price_over ? __('symbol-en') . number_format($menu_price) . "~" : __('symbol-en') . number_format($menu_price));

        $details = [
            'shop_name' => $shop->shop_name,
            'last_name' => $client->last_name,
            'first_name' => $client->first_name,
            'reservation_code' => $reservation->reservation_code,
            'reservation_time' => $reservation_time_str,
            'price' => $menu_price,
            'menu' => $menu_name,
            'shop_address' => $shop->address_1,
            'shop_phone' => $shop->phone,
            'note' => $reservation->note,
            'shop_id' => $reservation->shop_id,
            'client_phone' => $client->phone,
            'client_email' => $client->email
        ];
//        sendReservationCancelClientEmail($details, $client->email);
//        sendReservationCancelShopEmail($details, $shop_user->email);
//        sendReservationCancelManagerEmail($details, $manager->email);
        return response()->json(['status' => true]);
    }
}
