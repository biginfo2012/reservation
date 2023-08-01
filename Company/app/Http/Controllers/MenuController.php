<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuUser;
use App\Models\Shop;
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
        $shop_code = Shop::where('user_id', $user_id)->first()->shop_code;

        $superMenuIds = MenuUser::where('user_id', 1)->pluck('menu_id');
        $superMenu = Menu::with('user')->whereIn('id', $superMenuIds)->get();
        foreach ($superMenu as $item){
            $userMenu = MenuUser::where('user_id', $user_id)->where('parent_menu', $item->id)->first();
            if(!isset($userMenu)){
                $menu_id = Menu::create(['menu_code' => $item->menu_code, 'menu_name' => $item->menu_name, 'description' => $item->description,
                    'order' => $item->order, 'price' => $item->price, 'require_time' => $item->require_time, 'display' => $item->display,
                    'note' => $item->note, 'over' => $item->over, 'ask' => $item->ask, 'deleted_at' => $item->deleted_at])->id;
                MenuUser::create(['menu_id' => $menu_id, 'user_id' => $user_id, 'parent_menu' => $item->id]);
            }
        }
        if(isset($keyword)){
            $data = Menu::with('user')->whereNull('deleted_at')->where(function ($query) use ($keyword){
                $query->where('menu_name', 'like', '%' . $keyword . '%')->orWhere('description', 'like', '%' . $keyword . '%');
            })->whereHas('user', function ($query) use ($user_id){
                $query->where('user_id', $user_id);
            })->orderBy('order')->get();
        }
        else{
            $data = Menu::with('user')->whereHas('user', function ($query) use ($user_id){
                $query->where('user_id', $user_id);
            })->whereNull('deleted_at')->orderBy('order')->get();
        }
        return view('menu-table', compact('data', 'shop_code'));
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
    public function menuChangeOrder(Request $request){
        $id_first = $request->id_first;
        $id_second = $request->id_second;
        $order_first = Menu::find($id_first)->order;
        $order_second = Menu::find($id_second)->order;
        Menu::find($id_first)->update(['order' => $order_second]);
        Menu::find($id_second)->update(['order' => $order_first]);
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
