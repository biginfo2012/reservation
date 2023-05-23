<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
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
}
