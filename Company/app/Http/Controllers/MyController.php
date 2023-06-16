<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MyController extends Controller
{
    //
    public function index(){
        $user = Auth::user();
        $shop_code = Shop::where('user_id', $user->id)->first()->shop_code;
        return view('my-page', compact('user', 'shop_code'));
    }
    public function changePassword(Request $request){
        if(Hash::check($request->current_password, Auth::user()->password)){
            User::find(Auth::user()->id)->update(['password' => Hash::make($request->new_password)]);
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => 'password_wrong']);
    }

}
