<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Shop;
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
}
