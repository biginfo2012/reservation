<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function index(){
        return view('noti-manage');
    }
    public function notiTable(Request $request){
        $status = $request->status;
        $publish_date = $request->publish_date;
        if(isset($status)){
            if(isset($publish_date)){
                $data = Notification::where('status', $status)->where('publish_time', '>=', $publish_date . " 00:00:00")->where('publish_time', '<=', $publish_date . " 23:59:59")
                    ->orderBy('created_at', 'DESC')->get();
            }
            else{
                $data = Notification::where('status', $status)->orderBy('created_at', 'DESC')->get();
            }
        }
        else{
            if(isset($publish_date)){
                $data = Notification::where('publish_time', '>=', $publish_date . " 00:00:00")->where('publish_time', '<=', $publish_date . " 23:59:59")
                    ->orderBy('created_at', 'DESC')->get();
            }
            else{
                $data = Notification::all();
            }
        }
        return view('noti-table', compact('data'));
    }
    public function notiSave(Request $request){
        $id = $request->id;
        if($request->status == 2){
            $publish_time = date('Y-m-d H:i') . ":00";
        }
        else if($request->status == 1){
            $publish_time = $request->publish_time;
        }
        else{
            $publish_time = null;
        }
        if(!isset($id)){
            $data = [
                'title' => $request->title,
                'status' => $request->status,
                'publish_time' => $publish_time,
                'content' => $request->note
            ];
            Notification::create($data);
        }
        else{
            $data = [
                'title' => $request->title,
                'status' => $request->status,
                'publish_time' => $request->publish_time,
                'content' => $request->note
            ];
            Notification::find($id)->update($data);
        }
        return response()->json(['status' => true]);
    }
    public function notiDelete(Request $request){
        $id = $request->id;
        Notification::find($id)->delete();
        return response()->json(['status' => true]);
    }
}
