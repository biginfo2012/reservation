<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function index(){
        $shops = Shop::whereNull('deleted_at')->get()->all();
        return view('client-manage', compact('shops'));
    }
    public function clientTable(Request $request){
        $date = $request->date;
        $shop_id = $request->shop_id;
        $keyword = $request->keyword;
        if(isset($date)){
            if(isset($shop_id)){
                if(isset($keyword)){
                    $data = Client::with('reservation')
                        ->where(function ($query) use ($keyword) {
                            $query->where('last_name', 'like', '%' . $keyword . '%')->orWhere('first_name', 'like', '%' . $keyword . '%')->orWhere('email', 'like', '%' . $keyword . '%')
                                ->orWhere('phone', 'like', '%' . $keyword . '%');
                        })->get();
                }
                else{
                    $data = Client::with('shop', 'client', 'menu')->whereNull('deleted_at')->where('shop_id', $shop_id)
                        ->where('reservation_time', '>=', $date . " 00:00:00")->where('reservation_time', '<=', $date . " 23:59:59")
                        ->get();
                }
            }
            else{
                if(isset($keyword)){
                    $data = Client::with('shop', 'client', 'menu')->whereNull('deleted_at')
                        ->where('reservation_time', '>=', $date . " 00:00:00")->where('reservation_time', '<=', $date . " 23:59:59")
                        ->whereHas('client', function ($query) use ($keyword) {
                            $query->where('last_name', 'like', '%' . $keyword . '%')->orWhere('first_name', 'like', '%' . $keyword . '%')->orWhere('email', 'like', '%' . $keyword . '%')
                                ->orWhere('phone', 'like', '%' . $keyword . '%');
                        })->get();
                }
                else{
                    $data = Client::with('shop', 'client', 'menu')->whereNull('deleted_at')
                        ->where('reservation_time', '>=', $date . " 00:00:00")->where('reservation_time', '<=', $date . " 23:59:59")
                        ->get();
                }
            }
        }
        else{
            if(isset($shop_id)){
                if(isset($keyword)){
                    $data = Client::with('shop', 'client', 'menu')->whereNull('deleted_at')->where('shop_id', $shop_id)
                        ->whereHas('client', function ($query) use ($keyword) {
                            $query->where('last_name', 'like', '%' . $keyword . '%')->orWhere('first_name', 'like', '%' . $keyword . '%')->orWhere('email', 'like', '%' . $keyword . '%')
                                ->orWhere('phone', 'like', '%' . $keyword . '%');
                        })->get();
                }
                else{
                    $data = Client::with('shop', 'client', 'menu')->whereNull('deleted_at')->where('shop_id', $shop_id)->get();
                }
            }
            else{
                if(isset($keyword)){
                    $data = Client::with('shop', 'client', 'menu')->whereNull('deleted_at')
                        ->whereHas('client', function ($query) use ($keyword) {
                            $query->where('last_name', 'like', '%' . $keyword . '%')->orWhere('first_name', 'like', '%' . $keyword . '%')->orWhere('email', 'like', '%' . $keyword . '%')
                                ->orWhere('phone', 'like', '%' . $keyword . '%');
                        })->get();
                }
                else{
                    $data = Client::with('shop', 'client', 'menu')->whereNull('deleted_at')->get();
                }
            }
        }
        return view('client-table');
    }

    public function clientEdit($id){
        $data = Client::find($id);
        $date = date('Y-m-d H:i:s');
        $reservations = Reservation::with('shop')->where('client_id', $id)->where('reservation_time', '<=',  $date)->orderBy('reservation_time', 'desc')->get();
        return view('client-edit', compact('data', 'reservations'));
    }
}
