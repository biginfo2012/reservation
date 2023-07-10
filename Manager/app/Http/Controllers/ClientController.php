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
                        ->whereHas('reservation', function ($query) use ($shop_id, $date) {
                            $query->where('shop_id', $shop_id)->where('reservation_time', '>=', $date . " 00:00:00")
                                ->where('reservation_time', '<=', $date . " 23:59:59")->whereNull('deleted_at');
                        })->where(function ($query) use ($keyword) {
                            $query->where('last_name', 'like', '%' . $keyword . '%')->orWhere('first_name', 'like', '%' . $keyword . '%')
                                ->orWhere('email', 'like', '%' . $keyword . '%')
                                ->orWhere('phone', 'like', '%' . $keyword . '%');
                        })->orderBy('created_at', 'desc')->get();
                }
                else{
                    $data = Client::with('reservation')
                        ->whereHas('reservation', function ($query) use ($shop_id, $date) {
                            $query->where('shop_id', $shop_id)->where('reservation_time', '>=', $date . " 00:00:00")
                                ->where('reservation_time', '<=', $date . " 23:59:59")->whereNull('deleted_at');
                        })->orderBy('created_at', 'desc')->get();
                }
            }
            else{
                if(isset($keyword)){
                    $data = Client::with('reservation')
                        ->whereHas('reservation', function ($query) use ($date) {
                            $query->where('reservation_time', '>=', $date . " 00:00:00")
                                ->where('reservation_time', '<=', $date . " 23:59:59")->whereNull('deleted_at');
                        })
                        ->where(function ($query) use ($keyword) {
                            $query->where('last_name', 'like', '%' . $keyword . '%')->orWhere('first_name', 'like', '%' . $keyword . '%')
                                ->orWhere('email', 'like', '%' . $keyword . '%')
                                ->orWhere('phone', 'like', '%' . $keyword . '%');
                        })->orderBy('created_at', 'desc')->get();
                }
                else{
                    $data = Client::with('reservation')
                        ->whereHas('reservation', function ($query) use ($date) {
                            $query->where('reservation_time', '>=', $date . " 00:00:00")
                                ->where('reservation_time', '<=', $date . " 23:59:59")->whereNull('deleted_at');
                        })
                        ->orderBy('created_at', 'desc')->get();
                }
            }
        }
        else{
            if(isset($shop_id)){
                if(isset($keyword)){
                    $data = Client::with('reservation')
                        ->whereHas('reservation', function ($query) use ($shop_id) {
                            $query->where('shop_id', $shop_id)->whereNull('deleted_at');
                        })->where(function ($query) use ($keyword) {
                            $query->where('last_name', 'like', '%' . $keyword . '%')->orWhere('first_name', 'like', '%' . $keyword . '%')
                                ->orWhere('email', 'like', '%' . $keyword . '%')
                                ->orWhere('phone', 'like', '%' . $keyword . '%');
                        })->orderBy('created_at', 'desc')->get();
                }
                else{
                    $data = Client::with('reservation')
                        ->whereHas('reservation', function ($query) use ($shop_id) {
                            $query->where('shop_id', $shop_id)->whereNull('deleted_at');
                        })->orderBy('created_at', 'desc')->get();
                }
            }
            else{
                if(isset($keyword)){
                    $data = Client::with('reservation')
                        ->whereHas('reservation', function ($query) {
                            $query->whereNull('deleted_at');
                        })
                        ->where(function ($query) use ($keyword) {
                            $query->where('last_name', 'like', '%' . $keyword . '%')->orWhere('first_name', 'like', '%' . $keyword . '%')
                                ->orWhere('email', 'like', '%' . $keyword . '%')
                                ->orWhere('phone', 'like', '%' . $keyword . '%');
                        })->orderBy('created_at', 'desc')->get();
                }
                else{
                    $data = Client::with('reservation')->whereHas('reservation', function ($query) {
                        $query->whereNull('deleted_at');
                    })->orderBy('created_at', 'desc')->get();
                }
            }
        }
        return view('client-table',  compact('data'));
    }
    public function clientExportCSV(Request $request){
        $date = $request->date;
        $shop_id = $request->shop_id;
        $keyword = $request->keyword;
        if(isset($date)){
            if(isset($shop_id)){
                if(isset($keyword)){
                    $data = Client::with('reservation')
                        ->whereHas('reservation', function ($query) use ($shop_id, $date) {
                            $query->where('shop_id', $shop_id)->where('reservation_time', '>=', $date . " 00:00:00")
                                ->where('reservation_time', '<=', $date . " 23:59:59")->whereNull('deleted_at');
                        })->where(function ($query) use ($keyword) {
                            $query->where('last_name', 'like', '%' . $keyword . '%')->orWhere('first_name', 'like', '%' . $keyword . '%')
                                ->orWhere('email', 'like', '%' . $keyword . '%')
                                ->orWhere('phone', 'like', '%' . $keyword . '%');
                        })->orderBy('created_at', 'desc')->get();
                }
                else{
                    $data = Client::with('reservation')
                        ->whereHas('reservation', function ($query) use ($shop_id, $date) {
                            $query->where('shop_id', $shop_id)->where('reservation_time', '>=', $date . " 00:00:00")
                                ->where('reservation_time', '<=', $date . " 23:59:59")->whereNull('deleted_at');
                        })->orderBy('created_at', 'desc')->get();
                }
            }
            else{
                if(isset($keyword)){
                    $data = Client::with('reservation')
                        ->whereHas('reservation', function ($query) use ($date) {
                            $query->where('reservation_time', '>=', $date . " 00:00:00")
                                ->where('reservation_time', '<=', $date . " 23:59:59")->whereNull('deleted_at');
                        })
                        ->where(function ($query) use ($keyword) {
                            $query->where('last_name', 'like', '%' . $keyword . '%')->orWhere('first_name', 'like', '%' . $keyword . '%')
                                ->orWhere('email', 'like', '%' . $keyword . '%')
                                ->orWhere('phone', 'like', '%' . $keyword . '%');
                        })->orderBy('created_at', 'desc')->get();
                }
                else{
                    $data = Client::with('reservation')
                        ->whereHas('reservation', function ($query) use ($date) {
                            $query->where('reservation_time', '>=', $date . " 00:00:00")
                                ->where('reservation_time', '<=', $date . " 23:59:59")->whereNull('deleted_at');
                        })
                        ->orderBy('created_at', 'desc')->get();
                }
            }
        }
        else{
            if(isset($shop_id)){
                if(isset($keyword)){
                    $data = Client::with('reservation')
                        ->whereHas('reservation', function ($query) use ($shop_id) {
                            $query->where('shop_id', $shop_id)->whereNull('deleted_at');
                        })->where(function ($query) use ($keyword) {
                            $query->where('last_name', 'like', '%' . $keyword . '%')->orWhere('first_name', 'like', '%' . $keyword . '%')
                                ->orWhere('email', 'like', '%' . $keyword . '%')
                                ->orWhere('phone', 'like', '%' . $keyword . '%');
                        })->orderBy('created_at', 'desc')->get();
                }
                else{
                    $data = Client::with('reservation')
                        ->whereHas('reservation', function ($query) use ($shop_id) {
                            $query->where('shop_id', $shop_id)->whereNull('deleted_at');
                        })->orderBy('created_at', 'desc')->get();
                }
            }
            else{
                if(isset($keyword)){
                    $data = Client::with('reservation')->whereHas('reservation', function ($query) {
                        $query->whereNull('deleted_at');
                    })
                        ->where(function ($query) use ($keyword) {
                            $query->where('last_name', 'like', '%' . $keyword . '%')->orWhere('first_name', 'like', '%' . $keyword . '%')
                                ->orWhere('email', 'like', '%' . $keyword . '%')
                                ->orWhere('phone', 'like', '%' . $keyword . '%');
                        })->orderBy('created_at', 'desc')->get();
                }
                else{
                    $data = Client::with('reservation')->whereHas('reservation', function ($query) {
                        $query->whereNull('deleted_at');
                    })->orderBy('created_at', 'desc')->get();
                }
            }
        }
        $fileName = '予約者一覧.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $callback = function() use($data) {
            $file = fopen('php://output', 'w');
            $columns = ['ID', mb_convert_encoding(__('client-name'), "SJIS-win", "UTF-8"),
                mb_convert_encoding(__('sei'), "SJIS-win", "UTF-8"),
                mb_convert_encoding(__('mei'), "SJIS-win", "UTF-8"),
                mb_convert_encoding(__('phone-number'), "SJIS-win", "UTF-8"),
                mb_convert_encoding(__('email'), "SJIS-win", "UTF-8"),
                mb_convert_encoding(__('gender'), "SJIS-win", "UTF-8")];
            fputcsv($file, $columns);

            foreach ($data as $index => $task) {
                $row[] = $index + 1;
                $row[]  = mb_convert_encoding($task['last_name'] . $task['first_name'], "SJIS-win", "UTF-8");
                $row[]  = mb_convert_encoding($task['sei'], "SJIS-win", "UTF-8");
                $row[]  = mb_convert_encoding($task['mei'], "SJIS-win", "UTF-8");
                $row[]  = $task['phone'];
                $row[]  = $task['email'];
                $row[]  = mb_convert_encoding($task['gender'] == 1 ? __('female') : __('male'), "SJIS-win", "UTF-8");
                fputcsv($file, $row);
                $row = [];
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function clientEdit($id){
        $data = Client::find($id);
        $date = date('Y-m-d H:i:s');
        $reservations = Reservation::with('shop')->where('client_id', $id)->where('reservation_time', '<=',  $date)->orderBy('reservation_time', 'desc')->get();
        return view('client-edit', compact('data', 'reservations'));
    }
}
