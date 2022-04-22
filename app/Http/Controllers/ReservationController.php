<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function vehicle_reservation(){
        return view('content.admin.reservation');
    }
}
