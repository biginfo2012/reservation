<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\ShopSetting;
use App\Models\ShopTempRest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ShopController extends Controller
{
    //
    public function index(){
        return view('shop-manage');
    }
    public function shopCreateCode(){
        $ex = true;
        $code = 0;
        while($ex){
            $code = rand(100000, 999999);
            $c_user = Shop::where('shop_code', $code)->first();
            if(!isset($c_user)) {
                $ex = false;
            }
        }
        return response()->json(['code' => $code]);
    }
    public function shopTable(Request $request){
        $keyword = $request->keyword;
        if(isset($keyword)){
            $data = Shop::with('user')->whereNull('deleted_at')->where(function ($query) use ($keyword) {
                $query->where('shop_name', 'like', '%' . $keyword . '%')->orWhere('phone', 'like', '%' . $keyword . '%')
                    ->orWhere(function ($query) use ($keyword) {
                        $query->whereHas('user', function ($query) use ($keyword){
                            return $query->where('email', 'like', '%' . $keyword . '%');
                        });
                    });
            })->get();
        }
        else{
            $data = Shop::with('user')->whereNull('deleted_at')->get();
        }
        return view('shop-table', compact('data'));
    }
    public function shopSave(Request $request){
        $id = $request->id;
        if(isset($id)){
            $user_id = Shop::find($id)->user_id;
            if(isset($request->password)){
                User::find($user_id)->update([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'name' => $request->shop_name
                ]);
            }
            else{
                User::find($user_id)->update([
                    'email' => $request->email,
                    'name' => $request->shop_name
                ]);
            }
            $data = [
                'shop_name' => $request->shop_name,
                'post_code' => $request->post_code,
                'address_1' => $request->address_1,
                'address_2' => $request->address_2,
                'phone' => $request->phone,
                'represent' => $request->represent,
                'represent_phone' => $request->represent_phone,
                'note' => $request->note,
            ];
            Shop::find($id)->update($data);
        }
        else{
            $user_id = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'name' => $request->shop_name,
                'role' => 1
            ])->id;
            $data = [
                'user_id' => $user_id,
                'shop_code' => $request->shop_code,
                'shop_name' => $request->shop_name,
                'post_code' => $request->post_code,
                'address_1' => $request->address_1,
                'address_2' => $request->address_2,
                'phone' => $request->phone,
                'represent' => $request->represent,
                'represent_phone' => $request->represent_phone,
                'note' => $request->note,
            ];
            Shop::create($data);
        }
        return response()->json(['status' => true]);
    }
    public function shopDelete(Request $request){
        $id = $request->id;
        $user_id = Shop::find($id)->user_id;
        Shop::find($id)->update(['deleted_at' => date('Y-m-d H:i:s')]);
        User::find($user_id)->update(['deleted_at' => date('Y-m-d H:i:s')]);
        return response()->json(['status' => true]);
    }

    public function shopSetting(){
        $user_id = Auth::user()->id;
        $shop = Shop::where('user_id', $user_id)->first();
        $email = Auth::user()->email;
        $shop_setting = ShopSetting::where('shop_id', $shop->id)->first();
        $shop_temp_this_month = ShopTempRest::where('shop_id', $shop->id)->where('temp_rest', '>=', date('Y-m-01'))->where('temp_rest', '<=', date('Y-m-t', strtotime(date('Y-m-d'))))->get();
        $shop_temp_all = ShopTempRest::where('shop_id', $shop->id)->get();
        $weekdays = ['月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日', '日曜日'];
        $shop_rest_day = "";
        if(!empty($shop_setting) && isset($shop_setting->rest_day)){
            $shop_rest_day = $weekdays[$shop_setting->rest_day];
        }
        return view('shop-setting', compact('shop', 'email', 'shop_setting', 'shop_temp_this_month', 'shop_temp_all', 'shop_rest_day'));
    }

    public function changeSetting(Request $request){
        $start_time = $request->start_time_hour * 60 + $request->start_time_min;
        $end_time = $request->end_time_hour * 60 + $request->end_time_min;
        $reservation_unit = $request->reservation_unit;
        $rest_day = $request->rest_day;
        $accept_people = $request->accept_people;
        $shop_setting = ShopSetting::where('shop_id', $request->id)->first();
        if(isset($shop_setting)){
            $data = [
                'start_time' => $start_time,
                'end_time' => $end_time,
                'reservation_unit' => $reservation_unit,
                'rest_day' => $rest_day,
                'accept_people' => $accept_people
            ];
            ShopSetting::where('shop_id', $request->id)->update($data);
        }
        else{
            $data = [
                'shop_id' => $request->id,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'reservation_unit' => $reservation_unit,
                'rest_day' => $rest_day,
                'accept_people' => $accept_people
            ];
            ShopSetting::create($data);
        }
        if (!empty($request->temp_rest_day)){
            $tmp_arr = explode(',', $request->temp_rest_day);
            ShopTempRest::where('shop_id', $request->id)->delete();
            for($i = 0; $i < count($tmp_arr); $i++){
                $tmp_day = date('Y-m') . '-' . $tmp_arr[$i];
                ShopTempRest::create(['shop_id' => $request->id, 'temp_rest' => $tmp_day]);
            }
        }
        return response()->json(['status' => true]);
    }

    public function shopImage(Request $request){
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('image'), $imageName);
        $shop_setting = ShopSetting::where('shop_id', $request->id)->first();
        if(isset($shop_setting)){
            ShopSetting::where('shop_id', $request->id)->update(['image_url' => $imageName]);
        }
        else{
            ShopSetting::create(['shop_id' => $request->id, 'image_url' => $imageName]);
        }
        return response()->json(['status' => true]);
    }
}
