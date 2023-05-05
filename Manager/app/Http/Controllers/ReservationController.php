<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    //
    public function index(){
        return view('reservation-manage');
    }
    public function reservationTable(Request $request){
        return view('reservation-table');
    }

    public function reservationEdit($id){
        return view('reservation-edit');
    }
}
