<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Menu;
use App\Models\Reservation;
use App\Models\ReservationMenu;
use App\Models\Shop;
use App\Models\ShopRestTime;
use App\Models\ShopSetting;
use App\Models\ShopTempRest;
use App\Models\User;
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
        })->whereNull('deleted_at')->where('display', 1)->orderBy('order')->get();
        $first_week_divide = false;
        $first_week_month = date('Y') . '年' . date('n') . '月';
        $first_week_divide_month = date('Y') . '年' . date('n') . '月';
        $first_week_divide_span = 7;
        if(date('Y-m') != date('Y-m', strtotime('+6 days'))){
            $first_week_divide = true;
            $first_week_divide_span = $first_week_divide_span - date('j', strtotime('+6 days'));
            $first_week_divide_month = date('Y', strtotime('+6 days')) . '年' . date('n', strtotime('+6 days')) . '月';
        }
        $first_week_days = [
            date('j') . '日', date('j', strtotime('+1 day')) . '日', date('j', strtotime('+2 day')) . '日',
            date('j', strtotime('+3 day')) . '日', date('j', strtotime('+4 day')) . '日',
            date('j', strtotime('+5 day')) . '日', date('j', strtotime('+6 day')) . '日',
        ];

        $second_week_month = date('Y', strtotime('+7 days')) . '年' . date('n', strtotime('+7 days')) . '月';
        $second_week_divide_month = date('Y', strtotime('+7 days')) . '年' . date('n', strtotime('+7 days')) . '月';
        $second_week_divide = false;
        $second_week_divide_span = 7;
        if(date('Y-m', strtotime('+7 days')) != date('Y-m', strtotime('+13 days'))){
            $second_week_divide = true;
            $second_week_divide_span = $second_week_divide_span - date('j', strtotime('+13 days'));
            $second_week_divide_month = date('Y', strtotime('+13 days')) . '年' . date('n', strtotime('+13 days')) . '月';
        }
        $second_week_days = [
            date('j', strtotime('+7 day')) . '日', date('j', strtotime('+8 day')) . '日', date('j', strtotime('+9 day')) . '日',
            date('j', strtotime('+10 day')) . '日', date('j', strtotime('+11 day')) . '日', date('j', strtotime('+12 day')) . '日',
            date('j', strtotime('+13 day')) . '日',
        ];
        $weekday = date('w');
        if($weekday == 0){
            $weekday = 6;
        }
        else{
            $weekday = $weekday - 1;
        }
        $weeks = ['月', '火', '水', '木', '金', '土', '日'];
        $weekdays = [];
        for($i = 0; $i < 7; $i++){
            $index = $weekday + $i;
            if($index > 6){
                $index = $index - 7;
            }
            $wd = $weeks[$index];
            array_push($weekdays, $wd);
        }
        $time_array = [];
        $start_time = 0;
        $end_time = 1440;
        $reservation_unit = 30;
        $rest_day = [];
        $accept_people = 1;
        if(!empty($shop_setting)){
            $start_time = $shop_setting->start_time;
            $end_time = $shop_setting->end_time;
            $reservation_unit = $shop_setting->reservation_unit;
            if(!empty($shop_setting->rest_day)){
                $rest_day = explode(',', $shop_setting->rest_day);
            }
            $accept_people = $shop_setting->accept_people;
        }
        $time = $start_time;
        while($time < $end_time){
            $hour_str = $time/60 < 10 ? "0" . (int)($time/60) : (int)($time/60);
            $min_str = $time%60 < 10 ? "0" . $time%60 : $time%60;
            $time_str = $hour_str . ":" . $min_str;
            array_push($time_array, $time_str);
            $time += $reservation_unit;
        }
        $first_week_arr = [];
        $second_week_arr = [];
        $first_cnt_arr = [];
        $second_cnt_arr = [];
        for($i = 0, $iMax = count($time_array); $i < $iMax; $i++) {
            $tmp1 = [];
            $tmp2 = [];
            for ($j = 0; $j < 7; $j++) {
                $strtotime1 = $j . " days";
                $i2 = $j + 7;
                $strtotime2 = $i2 . " days";
                $date1 = date('Y-m-d', strtotime($strtotime1));
                $date2 = date('Y-m-d', strtotime($strtotime2));
                $reservation1 = Reservation::with('menu')->whereNull('deleted_at')->where('shop_id', $shop->id)
                    ->where('reservation_time', '>=', $date1 . " 00:00:00")->where('reservation_time', '<=', $date1 . " 23:59:59")
                    ->get();
                $reservation2 = Reservation::with('menu')->whereNull('deleted_at')->where('shop_id', $shop->id)
                    ->where('reservation_time', '>=', $date2 . " 00:00:00")->where('reservation_time', '<=', $date2 . " 23:59:59")
                    ->get();
                $cnt1 = 0;
                $cnt2 = 0;
                foreach ($reservation1 as $item){
                    $reservation_time = $item->reservation_time;
                    $require_time = 0;
                    foreach ($item['menu'] as $reservation_menu){
                        $require_time += $reservation_menu['menu']['require_time'];
                    }
                    $s_time = date('H:i', strtotime($reservation_time));
                    $s_arr = explode(":", $s_time);
                    $s_int = (int)($s_arr[0]) * 60 + $s_arr[1];
                    $e_int = $s_int + $require_time;
                    $time_arr = explode(":", $time_array[$i]);
                    $time_int = (int)($time_arr[0]) * 60 + $time_arr[1];
                    if($time_int == $s_int){
                        $cnt1++;
                    }
                    else if($time_int > $s_int && $time_int < $e_int){
                        $cnt1++;
                    }
                }
                array_push($tmp1, $cnt1);
                foreach ($reservation2 as $item){
                    $reservation_time = $item->reservation_time;
                    $require_time = 0;
                    foreach ($item['menu'] as $reservation_menu){
                        $require_time += $reservation_menu['menu']['require_time'];
                    }
                    $s_time = date('H:i', strtotime($reservation_time));
                    $s_arr = explode(":", $s_time);
                    $s_int = (int)($s_arr[0]) * 60 + $s_arr[1];
                    $e_int = $s_int + $require_time;
                    $time_arr = explode(":", $time_array[$i]);
                    $time_int = (int)($time_arr[0]) * 60 + $time_arr[1];
                    if($time_int == $s_int){
                        $cnt2++;
                    }
                    else if($time_int > $s_int && $time_int < $e_int){
                        $cnt2++;
                    }
                }
                array_push($tmp2, $cnt2);
            }
            array_push($first_cnt_arr, $tmp1);
            array_push($second_cnt_arr, $tmp2);
        }
        for($i = 0, $iMax = count($time_array); $i < $iMax; $i++){
            $tmp1 = [];
            $tmp2 = [];
            for($j = 0; $j < 7; $j++){
                $index = $weekday + $j;
                if($index > 6){
                    $index = $index - 7;
                }
                if(in_array($index, $rest_day)){
                    array_push($tmp1, 0);
                    array_push($tmp2, 0);
                }
                else{
                    $strtotime1 = $j . " days";
                    $i2 = $j + 7;
                    $strtotime2 = $i2 . " days";
                    $date1 = date('Y-m-d', strtotime($strtotime1));
                    $date2 = date('Y-m-d', strtotime($strtotime2));
                    $shop_temp1 = ShopTempRest::where('shop_id', $shop->id)->where('temp_rest', $date1)->first();
                    $shop_temp2 = ShopTempRest::where('shop_id', $shop->id)->where('temp_rest', $date2)->first();
                    $shop_rest1 = ShopRestTime::where('shop_id', $shop->id)->where('rest_time', $date1 . " " . $time_array[$i] . ":00")->first();
                    $shop_rest2 = ShopRestTime::where('shop_id', $shop->id)->where('rest_time', $date2 . " " . $time_array[$i] . ":00")->first();
                    if($j == 0){
                        $h3 = date("G", strtotime("+3 hours"));
                        $h = (int)substr($time_array[$i], 0, 2);
                        if($h < $h3){
                            array_push($tmp1, 0);
                        }
                        else{
                            if(isset($shop_temp1) && !empty($shop_temp1)){
                                array_push($tmp1, 0);
                            }
                            else if(isset($shop_rest1) && !empty($shop_rest1)){
                                array_push($tmp1, 0);
                            }
                            else if($first_cnt_arr[$i][$j] >= $accept_people){
                                array_push($tmp1, 0);
                            }
                            else{
                                array_push($tmp1, 1);
                            }
                        }
                    }
                    else{
                        if(isset($shop_temp1) && !empty($shop_temp1)){
                            array_push($tmp1, 0);
                        }
                        else if(isset($shop_rest1) && !empty($shop_rest1)){
                            array_push($tmp1, 0);
                        }
                        else if($first_cnt_arr[$i][$j] >= $accept_people){
                            array_push($tmp1, 0);
                        }
                        else{
                            array_push($tmp1, 1);
                        }
                    }

                    if(isset($shop_temp2) && !empty($shop_temp2)){
                        array_push($tmp2, 0);
                    }
                    else if(isset($shop_rest2) && !empty($shop_rest2)){
                        array_push($tmp2, 0);
                    }
                    else if($second_cnt_arr[$i][$j] >= $accept_people){
                        array_push($tmp2, 0);
                    }
                    else{
                        array_push($tmp2, 1);
                    }
                }
            }
            array_push($first_week_arr, $tmp1);
            array_push($second_week_arr, $tmp2);
        }
        $data['first_week_divide'] = $first_week_divide;
        $data['first_week_month'] = $first_week_month;
        $data['first_week_divide_month'] = $first_week_divide_month;
        $data['first_week_divide_span'] = $first_week_divide_span;
        $data['first_week_days'] = $first_week_days;
        $data['second_week_divide'] = $second_week_divide;
        $data['second_week_month'] = $second_week_month;
        $data['second_week_divide_month'] = $second_week_divide_month;
        $data['second_week_divide_span'] = $second_week_divide_span;
        $data['second_week_days'] = $second_week_days;
        $data['weekdays'] = $weekdays;
        $data['time_array'] = $time_array;
        $data['first_week_arr'] = $first_week_arr;
        $data['second_week_arr'] = $second_week_arr;
        $data['reservation_unit'] = $reservation_unit;
        return view('reservation', compact('shop', 'shop_setting', 'menus', 'data'));
    }
    public function reservationAdd(Request $request){
        $shop_id = $request->shop_id;
        $shop_code = Shop::find($shop_id)->shop_code;
        $today = date('Y-m-d');
        $reservation_date = date('Y-m-d', strtotime($request->reservation_time));
        $reservation = Reservation::where('shop_id', $shop_id)->where('reservation_time', '>=', $reservation_date . " 00:00:00")->where('reservation_time', '<=', $reservation_date . " 23:59:59")
            ->orderBy('created_at', 'DESC')->first();
        $number = 0;
        if(isset($reservation) && !empty($reservation)){
            $r_code = $reservation->reservation_code;
            $n = (int)substr($r_code, -3);
            $number = $n + 1;
        }
        $num = $number < 10 ? "00" . $number : ($number < 100 ? "0" > $number : $number);
        $reservation_code = date('YmdHi', strtotime($request->reservation_time)) . $shop_code . $num;
        $reservation_time = date('Y-m-d H:i:s', strtotime($request->reservation_time));
        $client = Client::where('last_name', $request->last_name)->where('first_name', $request->first_name)->where('sei', $request->sei)->where('mei', $request->mei)
            ->where('phone', $request->phone)->where('email', $request->email)->where('gender', $request->gender)->first();
        if(isset($client) && !empty($client)){
            $client_id = $client->id;
            Client::find($client_id)->update(['is_first' => $request->is_first]);
        }
        else{
            $client_data = [
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'sei' => $request->sei,
                'mei' => $request->mei,
                'phone' => $request->phone,
                'email' => $request->email,
                'gender' => $request->gender,
                'is_first' => $request->is_first
            ];
            $client = Client::create($client_data);
            $client_id = $client->id;
        }
        $data = [
            'reservation_code' => $reservation_code,
            'shop_id' => $shop_id,
            'client_id' => $client_id,
            'reservation_time' => $reservation_time,
            'note' => $request->note
        ];
        $new_reservation = Reservation::create($data);
        $r_id = $new_reservation->id;
        $menu_arr = explode(",", $request->menu_ids);
        $menu_str = "";
        $menu_price = 0;
        for($i = 0, $iMax = count($menu_arr); $i < $iMax; $i++){
            if(isset($menu_arr[$i]) && !empty($menu_arr[$i])){
                $rm_data = [
                    'reservation_id' => $r_id,
                    'menu_id' => $menu_arr[$i]
                ];
                ReservationMenu::create($rm_data);
                $menu = Menu::find($menu_arr[$i]);
                $menu_str .= $menu->menu_name . ",";
                $menu_price += $menu->price;
            }
        }
        $shop = Shop::find($shop_id);
        $weeks = ['月', '火', '水', '木', '金', '土', '日'];
        $w_index = date('w', strtotime($request->reservation_time));
        $weekday = $weeks[$w_index];
        $reservation_time_str = date('Y年m月d日', strtotime($request->reservation_time)) . "(" . $weekday . ") " . date("H:i", strtotime($request->reservation_time));
        $cancel_time = date('Y年m月d日H:i', strtotime($request->reservation_time . ' -2 hours'));
        $details = [
            'shop_name' => $shop->shop_name,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'reservation_code' => $reservation_code,
            'reservation_time' => $reservation_time_str,
            'price' => $request->price_str,
            'menu' => $request->menu_names,
            'shop_address' => $shop->address_1,
            'shop_phone' => $shop->phone,
            'note' => $request->note,
            'shop_id' => $shop_id,
            'cancel_time' => $cancel_time,
            'client_phone' => $request->phone,
            'client_email' => $request->email
        ];
        $user = User::find($shop->user_id);
        $manager = User::where('role', 0)->first();
        sendReservationCompleteClientEmail($details, $request->email);
        if(!isset($request->delete_id) || empty($request->delete_id)){
            sendReservationCompleteShopEmail($details, $user->email);
            sendReservationCompleteManagerEmail($details, $manager->email);
        }
        else{
            $reservation_id1 = $request->delete_id;
            $reservation1 = Reservation::with('menu')->find($reservation_id1);
            Reservation::find($reservation_id1)->update(['deleted_at' => date('Y-m-d H:i:s')]);
            $client1 = Client::find($reservation1->client_id);
            $shop1 = Shop::find($reservation1->shop_id);
            $shop_user1 = User::find($shop1->user_id);
            $weeks1 = ['月', '火', '水', '木', '金', '土', '日'];
            $w_index1 = date('w', strtotime($reservation1->reservation_time));
            $weekday1 = $weeks1[$w_index1];
            $reservation_time_str1 = date('Y年m月d日', strtotime($reservation1->reservation_time)) . "(" . $weekday1 . ") " . date("H:i", strtotime($reservation1->reservation_time));
            $menu1 = $reservation1->menu;
            $menu_name1 = "";
            $menu_price1 = 0;
            $menu_price_over1 = false;
            $menu_price_ask1 = false;
            foreach ($menu1 as $index => $item){
                if($index != count($menu1) - 1){
                    $menu_name1 .= $item->menu->menu_name . ",";
                }
                else{
                    $menu_name1 .= $item->menu->menu_name;
                }
                $menu_price1 += $item->menu->price;
                if($item->menu->over){
                    $menu_price_over1 = true;
                }
                if($item->menu->ask){
                    $menu_price_ask1 = true;
                }
            }
            $menu_price1 = $menu_price_ask1 ? __('ask') : ($menu_price_over1 ? __('symbol-en') . number_format($menu_price1) . "~" : __('symbol-en') . number_format($menu_price1));

            $details = [
                'shop_name' => $shop->shop_name,
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'reservation_code' => $reservation_code,
                'reservation_time' => $reservation_time_str,
                'price' => $request->price_str,
                'menu' => $request->menu_names,
                'shop_address' => $shop->address_1,
                'shop_phone' => $shop->phone,
                'note' => $request->note,
                'shop_id' => $shop_id,
                'cancel_time' => $cancel_time,
                'client_phone' => $request->phone,
                'client_email' => $request->email,

                'shop_name1' => $shop1->shop_name,
                'last_name1' => $client1->last_name,
                'first_name1' => $client1->first_name,
                'reservation_code1' => $reservation1->reservation_code,
                'reservation_time1' => $reservation_time_str1,
                'price1' => $menu_price1,
                'menu1' => $menu_name1,
                'shop_address1' => $shop1->address_1,
                'shop_phone1' => $shop1->phone,
                'note1' => $reservation1->note,
                'shop_id1' => $reservation1->shop_id,
                'client_phone1' => $client1->phone,
                'client_email1' => $client1->email
            ];
            sendReservationChangeShopEmail($details, $shop_user1->email);
            sendReservationChangeManagerEmail($details, $manager->email);
        }
        return response()->json(['status' => true, 'reservation_code' => $reservation_code]);
    }
    public function reservationCancel($code){
        $reservation = Reservation::with('menu')->where('reservation_code', $code)->first();
        if(!isset($reservation) || empty($reservation) || $reservation->deleted_at != null){
            return view('reservation-no');
        }
        $weeks = ['月', '火', '水', '木', '金', '土', '日'];
        $w_index = date('w', strtotime($reservation->reservation_time));
        $weekday = $weeks[$w_index];
        $reservation_time_str = date('Y年m月d日', strtotime($reservation->reservation_time)) . "(" . $weekday . ") " . date("H:i", strtotime($reservation->reservation_time));
        $menu = $reservation->menu;
        $menu_name = "";
        $menu_price = 0;
        $menu_time = 0;
        $menu_price_over = false;
        $menu_price_ask = false;
        foreach ($menu as $index => $item){
            if($index != count($menu) - 1){
                $menu_name .= $item->menu->menu_name . ",";
            }
            else{
                $menu_name .= $item->menu->menu_name;
            }
            $menu_time += $item->menu->require_time;
            $menu_price += $item->menu->price;
            if($item->menu->over){
                $menu_price_over = true;
            }
            if($item->menu->ask){
                $menu_price_ask = true;
            }
        }
        $menu_price = $menu_price_ask ? __('ask') : ($menu_price_over ? __('symbol-en') . number_format($menu_price) . "~" : __('symbol-en') . number_format($menu_price));
        $data = [
            'menus' => $menu_name,
            'time' => $menu_time,
            'price' => $menu_price,
            'visit' => $reservation_time_str
        ];
        $client = Client::find($reservation->client_id);
        $shop_id = $reservation->shop_id;
        $shop = Shop::where('id', $shop_id)->first();
        $shop_setting = ShopSetting::where('shop_id', $shop_id)->first();
        return view('reservation-cancel', compact('reservation','data', 'shop', 'shop_setting', 'client'));
    }
    public function reservationCancelPost(Request $request){
        $reservation_id = $request->reservation_id;
        Reservation::find($reservation_id)->update(['deleted_at' => date('Y-m-d H:i:s')]);
        return response()->json(['status' => true]);
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
        sendReservationCancelClientEmail($details, $client->email);
        sendReservationCancelShopEmail($details, $shop_user->email);
        sendReservationCancelManagerEmail($details, $manager->email);
        return response()->json(['status' => true]);
    }
}
