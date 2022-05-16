<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Department;
use App\Models\Reservation;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class RequestorController extends Controller
{
    public function requestor_dashboard(){
        $scheduleTodays = DB::table('reservations')
        ->join('vehicles', 'reservations.vehicle_id', 'vehicles.id')
        ->join('drivers','vehicles.driver_id','drivers.id')
        ->join('users', 'drivers.user_id', 'users.id')
        ->where('reservations.user_id', Auth::user()->id)
        ->where('reservation_date', now()->format('Y-m-d'))
        ->select('reservations.reservation_date', 'vehicles.vehicle_type','vehicles.plate_no', 'drivers.id_no','users.name')
        ->get();
        $companies = Company::select('company_name', 'id')->get();
        return view('content.requestor.requestor_dashboard', compact('scheduleTodays','companies'));
    }

    public function get_available_vehicle(Request $request){
        $department = Department::where('company_id',  $request->company_id)->select('id')->get()->pluck('id')->toArray();
        $availbleVehicle = Vehicle::
        leftJoin('reservations', 'vehicles.id','=', 'reservations.vehicle_id')
        ->whereRaw('(reservations.reservation_date <> "'.Carbon::parse($request->date_reserve)->format('Y-m-d').'" OR reservations.reservation_date IS NULL)')
        ->whereIn('vehicles.department_id',  $department)
        ->whereNotNull('vehicles.driver_id')
        ->select('vehicles.vehicle_type','vehicles.plate_no','vehicles.id')
        ->get();
        return $availbleVehicle; 
        
    }


    public function get_vehicle_driver(Request $request){
        $vehicle_driver = DB::table('vehicles')
        ->join('drivers','vehicles.driver_id', '=', 'drivers.id')
        ->join('users','drivers.user_id', '=', 'users.id')
        ->whereNotNull('vehicles.driver_id')
        ->where('vehicles.id', '=', $request->id)
        ->select('users.name','drivers.id_no','drivers.license_type','drivers.restriction', 'users.id AS userID', 'vehicles.id AS vehicleID')
        ->get();
        return $vehicle_driver;
    }


    public function create_reservation(Request $request){
        Reservation::create([
           'vehicle_id' => $request->vehicleId,
           'user_id' => Auth::user()->id,
           'reservation_date'=> $request->date_reservation,
           'reservation_status' => 'pending'
        ]);
    }
}
