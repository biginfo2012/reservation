<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    //
    public function index(){
        return view('menu-manage');
    }
    public function menuTable(Request $request){
        $keyword = $request->keyword;
        $user_id = Auth::user()->id;
        if(isset($keyword)){
            $data = Menu::with('user')->whereNull('deleted_at')->where(function ($query) use ($keyword){
                $query->where('menu_name', 'like', '%' . $keyword . '%')->orWhere('description', 'like', '%' . $keyword . '%');
            })->whereHas('user', function ($query) use ($user_id){
                $query->where('user_id', $user_id);
            })->orderBy('order')->get();
        }
        else{
            $data = Menu::with('user')->whereNull('deleted_at')->whereHas('user', function ($query) use ($user_id){
                $query->where('user_id', $user_id);
            })->orderBy('order')->get();
        }
        return view('menu-table', compact('data'));
    }
    public function menuCreateCode(){
        $ex = true;
        $code = 0;
        while($ex){
            $code = rand(1000, 9999);
            $c_user = Menu::where('menu_code', $code)->first();
            if(!isset($c_user)) {
                $ex = false;
            }
        }
        return response()->json(['code' => $code]);
    }
    public function menuChangeDisplay(Request $request){
        Menu::find($request->id)->update(['display' => $request->display]);
        return response()->json(['status' => true]);
    }
    public function menuSave(Request $request){
        $id = $request->id;
        if(!isset($id)){
            $data = [
                'menu_code' => $request->menu_code,
                'menu_name' => $request->menu_name,
                'description' => $request->description,
                'price' => $request->price,
                'require_time' => $request->require_time,
                'display' => $request->display,
                'note' => $request->note,
                'over' => isset($request->over) ? 1 : 0,
                'ask' => isset($request->ask) ? 1 : 0
            ];
            $menu_id = Menu::create($data)->id;
            Menu::find($menu_id)->update(['order' => $menu_id]);
            MenuUser::create(['menu_id' => $menu_id,  'user_id' => Auth::user()->id]);
        }
        else{
            $data = [
                'menu_name' => $request->menu_name,
                'description' => $request->description,
                'price' => $request->price,
                'require_time' => $request->require_time,
                'display' => $request->display,
                'note' => $request->note,
                'over' => isset($request->over) ? 1 : 0,
                'ask' => isset($request->ask) ? 1 : 0
            ];
            Menu::find($id)->update($data);
        }
        return response()->json(['status' => true]);
    }
    public function menuDelete(Request $request){
        $id = $request->id;
        Menu::find($id)->update(['deleted_at' => date('Y-m-d H:i:s')]);
        return response()->json(['status' => true]);
    }
}
