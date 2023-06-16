<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\NotificationUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //
    public function index(){
        return view('noti-manage');
    }
    public function notiTable(Request $request){
        $notifications = Notification::where('status', 2)->orderBy('created_at', 'desc')->get();
        $data = array();
        foreach ($notifications as $item){
            $tmp['id'] = $item->id;
            $tmp['title'] = $item->title;
            $tmp['content'] = $item->content;
            $tmp['publish_time'] = $item->publish_time;
            $nu = NotificationUser::where('user_id', Auth::user()->id)->where('notification_id', $item->id)->first();
            $tmp['status'] = empty($nu) ? 0 : 1;
            array_push($data, $tmp);
        }
        return view('noti-table', compact('data'));
    }
    public function notiRead(Request $request){
        $id = $request->id;
        NotificationUser::create(['user_id' => Auth::user()->id, 'notification_id' => $id]);
        return response()->json(['status' => true]);
    }
}
