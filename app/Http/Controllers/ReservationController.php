<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function vehicle_reservation(){
        $reservationRecords = Reservation::join('vehicles', 'reservations.vehicle_id', 'vehicles.id')
        ->join('drivers','vehicles.driver_id','drivers.id')
        ->join('users', 'drivers.user_id', 'users.id')
        ->get();
        return view('content.admin.reservation',compact('reservationRecords'));
    }
}
