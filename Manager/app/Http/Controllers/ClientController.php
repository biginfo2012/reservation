<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function index(){
        return view('client-manage');
    }
    public function clientTable(Request $request){
        return view('client-table');
    }

    public function clientEdit($id){
        return view('client-edit');
    }
}
