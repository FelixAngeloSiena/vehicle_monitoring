<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RequestorController extends Controller
{
    public function requestor_dashboard(){
        return view('content.requestor.requestor_dashboard');
    }

    public function get_available_vehicle(Request $request){
        $availbleVehicle = DB::table('vehicles')
        ->leftJoin('reservations', 'vehicles.id','=', 'reservations.vehicle_id')
        ->where('reservations.reservation_date', '<>', $request->date)
        ->orWhereNull('reservations.reservation_date')
        ->select('vehicles.vehicle_type','vehicles.plate_no','vehicles.id')
        ->get();
        return $availbleVehicle; 
    }


    public function get_vehicle_driver(Request $request){
        $vehicle_driver = DB::table('vehicles')
        ->join('drivers','vehicles.driver_id', '=', 'drivers.id')
        ->join('users','drivers.user_id', '=', 'users.id')
        ->whereNotNull('vehicles.driver_id')
        ->select('users.name','drivers.id_no','drivers.license_type','drivers.restriction')
        ->get();
        return $vehicle_driver;
    }
}
