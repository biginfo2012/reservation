<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Menu;
use App\Models\Reservation;
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
    public function index(){
        $shop = Shop::where('user_id', Auth::user()->id)->first();
        $shop_setting = ShopSetting::where('shop_id', $shop->id)->first();
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

        $second_week_divide = false;
        $second_week_month = date('Y', strtotime('+7 days')) . '年' . date('n', strtotime('+7 days')) . '月';
        $second_week_divide_month = date('Y', strtotime('+7 days')) . '年' . date('n', strtotime('+7 days')) . '月';
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

        $third_week_divide = false;
        $third_week_month = date('Y', strtotime('+14 days')) . '年' . date('n', strtotime('+14 days')) . '月';
        $third_week_divide_month = date('Y', strtotime('+14 days')) . '年' . date('n', strtotime('+14 days')) . '月';
        $third_week_divide_span = 7;
        if(date('Y-m', strtotime('+14 days')) != date('Y-m', strtotime('+20 days'))){
            $third_week_divide = true;
            $third_week_divide_span = $third_week_divide_span - date('j', strtotime('+20 days'));
            $third_week_divide_month = date('Y', strtotime('+20 days')) . '年' . date('n', strtotime('+20 days')) . '月';
        }
        $third_week_days = [
            date('j', strtotime('+14 day')) . '日', date('j', strtotime('+15 day')) . '日', date('j', strtotime('+16 day')) . '日',
            date('j', strtotime('+17 day')) . '日', date('j', strtotime('+18 day')) . '日', date('j', strtotime('+19 day')) . '日',
            date('j', strtotime('+20 day')) . '日',
        ];

        $four_week_divide = false;
        $four_week_month = date('Y', strtotime('+21 days')) . '年' . date('n', strtotime('+21 days')) . '月';
        $four_week_divide_month = date('Y', strtotime('+21 days')) . '年' . date('n', strtotime('+21 days')) . '月';
        $four_week_divide_span = 7;
        if(date('Y-m', strtotime('+21 days')) != date('Y-m', strtotime('+27 days'))){
            $four_week_divide = true;
            $four_week_divide_span = $four_week_divide_span - date('j', strtotime('+27 days'));
            $four_week_divide_month = date('Y', strtotime('+27 days')) . '年' . date('n', strtotime('+27 days')) . '月';
        }
        $four_week_days = [
            date('j', strtotime('+21 day')) . '日', date('j', strtotime('+22 day')) . '日', date('j', strtotime('+23 day')) . '日',
            date('j', strtotime('+24 day')) . '日', date('j', strtotime('+25 day')) . '日', date('j', strtotime('+26 day')) . '日',
            date('j', strtotime('+27 day')) . '日',
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
        $third_week_arr = [];
        $four_week_arr = [];
        $first_cnt_arr = [];
        $second_cnt_arr = [];
        $third_cnt_arr = [];
        $four_cnt_arr = [];
        for($i = 0, $iMax = count($time_array); $i < $iMax; $i++) {
            $tmp1 = [];
            $tmp2 = [];
            $tmp3 = [];
            $tmp4 = [];
            for ($j = 0; $j < 7; $j++) {
                $strtotime1 = $j . " days";
                $i2 = $j + 7;
                $strtotime2 = $i2 . " days";
                $i3 = $j + 14;
                $strtotime3 = $i3 . " days";
                $i4 = $j + 21;
                $strtotime4 = $i4 . " days";
                $date1 = date('Y-m-d', strtotime($strtotime1));
                $date2 = date('Y-m-d', strtotime($strtotime2));
                $date3 = date('Y-m-d', strtotime($strtotime3));
                $date4 = date('Y-m-d', strtotime($strtotime4));
                $reservation1 = Reservation::with('menu')->whereNull('deleted_at')->where('shop_id', $shop->id)
                    ->where('reservation_time', '>=', $date1 . " 00:00:00")->where('reservation_time', '<=', $date1 . " 23:59:59")
                    ->get();
                $reservation2 = Reservation::with('menu')->whereNull('deleted_at')->where('shop_id', $shop->id)
                    ->where('reservation_time', '>=', $date2 . " 00:00:00")->where('reservation_time', '<=', $date2 . " 23:59:59")
                    ->get();
                $reservation3 = Reservation::with('menu')->whereNull('deleted_at')->where('shop_id', $shop->id)
                    ->where('reservation_time', '>=', $date3 . " 00:00:00")->where('reservation_time', '<=', $date3 . " 23:59:59")
                    ->get();
                $reservation4 = Reservation::with('menu')->whereNull('deleted_at')->where('shop_id', $shop->id)
                    ->where('reservation_time', '>=', $date4 . " 00:00:00")->where('reservation_time', '<=', $date4 . " 23:59:59")
                    ->get();
                $cnt1 = 0;
                $cnt2 = 0;
                $cnt3 = 0;
                $cnt4 = 0;
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
                foreach ($reservation3 as $item){
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
                        $cnt3++;
                    }
                    else if($time_int > $s_int && $time_int < $e_int){
                        $cnt3++;
                    }
                }
                array_push($tmp3, $cnt3);
                foreach ($reservation4 as $item){
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
                        $cnt4++;
                    }
                    else if($time_int > $s_int && $time_int < $e_int){
                        $cnt4++;
                    }
                }
                array_push($tmp4, $cnt4);
            }
            array_push($first_cnt_arr, $tmp1);
            array_push($second_cnt_arr, $tmp2);
            array_push($third_cnt_arr, $tmp3);
            array_push($four_cnt_arr, $tmp4);
        }
        for($i = 0, $iMax = count($time_array); $i < $iMax; $i++){
            $tmp1 = [];
            $tmp2 = [];
            $tmp3 = [];
            $tmp4 = [];
            for($j = 0; $j < 7; $j++){
                $index = $weekday + $j;
                if($index > 6){
                    $index = $index - 7;
                }
                if(in_array($index, $rest_day)){
                    array_push($tmp1, 0);
                    array_push($tmp2, 0);
                    array_push($tmp3, 0);
                    array_push($tmp4, 0);
                }
                else{
                    $strtotime1 = $j . " days";
                    $i2 = $j + 7;
                    $strtotime2 = $i2 . " days";
                    $i3 = $j + 14;
                    $strtotime3 = $i3 . " days";
                    $i4 = $j + 21;
                    $strtotime4 = $i4 . " days";
                    $date1 = date('Y-m-d', strtotime($strtotime1));
                    $date2 = date('Y-m-d', strtotime($strtotime2));
                    $date3 = date('Y-m-d', strtotime($strtotime3));
                    $date4 = date('Y-m-d', strtotime($strtotime4));
                    $shop_temp1 = ShopTempRest::where('shop_id', $shop->id)->where('temp_rest', $date1)->first();
                    $shop_temp2 = ShopTempRest::where('shop_id', $shop->id)->where('temp_rest', $date2)->first();
                    $shop_temp3 = ShopTempRest::where('shop_id', $shop->id)->where('temp_rest', $date3)->first();
                    $shop_temp4 = ShopTempRest::where('shop_id', $shop->id)->where('temp_rest', $date4)->first();
                    $shop_rest1 = ShopRestTime::where('shop_id', $shop->id)->where('rest_time', $date1 . " " . $time_array[$i] . ":00")->first();
                    $shop_rest2 = ShopRestTime::where('shop_id', $shop->id)->where('rest_time', $date2 . " " . $time_array[$i] . ":00")->first();
                    $shop_rest3 = ShopRestTime::where('shop_id', $shop->id)->where('rest_time', $date3 . " " . $time_array[$i] . ":00")->first();
                    $shop_rest4 = ShopRestTime::where('shop_id', $shop->id)->where('rest_time', $date4 . " " . $time_array[$i] . ":00")->first();
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
                                array_push($tmp1, 2);
                            }
                            else if($first_cnt_arr[$i][$j] > 0){
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
                            array_push($tmp1, 2);
                        }
                        else if($first_cnt_arr[$i][$j] > 0){
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
                        array_push($tmp2, 2);
                    }
                    else if($second_cnt_arr[$i][$j] > 0){
                        array_push($tmp2, 0);
                    }
                    else{
                        array_push($tmp2, 1);
                    }

                    if(isset($shop_temp3) && !empty($shop_temp3)){
                        array_push($tmp3, 0);
                    }
                    else if(isset($shop_rest3) && !empty($shop_rest3)){
                        array_push($tmp3, 2);
                    }
                    else if($third_cnt_arr[$i][$j] > 0){
                        array_push($tmp3, 0);
                    }
                    else{
                        array_push($tmp3, 1);
                    }

                    if(isset($shop_temp4) && !empty($shop_temp4)){
                        array_push($tmp4, 0);
                    }
                    else if(isset($shop_rest4) && !empty($shop_rest4)){
                        array_push($tmp4, 2);
                    }
                    else if($four_cnt_arr[$i][$j] > 0){
                        array_push($tmp4, 0);
                    }
                    else{
                        array_push($tmp4, 1);
                    }
                }
            }
            array_push($first_week_arr, $tmp1);
            array_push($second_week_arr, $tmp2);
            array_push($third_week_arr, $tmp3);
            array_push($four_week_arr, $tmp4);
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
        $data['third_week_divide'] = $third_week_divide;
        $data['third_week_month'] = $third_week_month;
        $data['third_week_divide_month'] = $third_week_divide_month;
        $data['third_week_divide_span'] = $third_week_divide_span;
        $data['third_week_days'] = $third_week_days;
        $data['four_week_divide'] = $four_week_divide;
        $data['four_week_month'] = $four_week_month;
        $data['four_week_divide_month'] = $four_week_divide_month;
        $data['four_week_divide_span'] = $four_week_divide_span;
        $data['four_week_days'] = $four_week_days;
        $data['weekdays'] = $weekdays;
        $data['time_array'] = $time_array;
        $data['first_week_arr'] = $first_week_arr;
        $data['second_week_arr'] = $second_week_arr;
        $data['third_week_arr'] = $third_week_arr;
        $data['four_week_arr'] = $four_week_arr;
        $data['reservation_unit'] = $reservation_unit;
        return view('reservation-manage', compact('data'));
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

    public function reservationRestTime(Request $request){
        $shop_id = Shop::where('user_id', Auth::user()->id)->first()->id;
        $rest_time_arr = explode(',', $request->rest_time);
        ShopRestTime::where('shop_id', $shop_id)->delete();
        for($i = 0, $iMax = count($rest_time_arr); $i < $iMax; $i++){
            $rest_time = date('Y-m-d H:i:s', strtotime($rest_time_arr[$i]));
            ShopRestTime::create(['shop_id' => $shop_id, 'rest_time' => $rest_time]);
        }

        return response()->json(['status' => true]);
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
        sendReservationCancelClientEmail($details, $client->email);
        sendReservationCancelShopEmail($details, $shop_user->email);
        sendReservationCancelManagerEmail($details, $manager->email);
        return response()->json(['status' => true]);
    }
}
