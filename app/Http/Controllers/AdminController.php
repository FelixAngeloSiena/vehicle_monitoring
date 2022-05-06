<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;

class AdminController extends Controller
{

    public function admin_dashboard(){

        $vehiclesCount = Vehicle::count();
        $reservationsCount = Reservation::where('reservation_date', now()->format('Y-m-d'))->count();
        
        $allReservationTodays = Reservation::where('reservation_date', now()->format('Y-m-d'))
        ->join('vehicles', 'reservations.vehicle_id', 'vehicles.id')
        ->join('drivers','vehicles.driver_id','drivers.id')
        ->join('users', 'drivers.user_id', 'users.id')
        ->get();
        return view('content.admin.admin_dashboard',compact('allReservationTodays', 'vehiclesCount', 'reservationsCount'));
    }

    public function user_accounts(){
        $users = User::select('name', 'email','role')
        ->get();
        return view('content.admin.user_accounts',compact('users'));
    }

    public function create_users(Request $request){
        User::create([
            'name'=>$request->create_user_name,
            'email'=>$request->create_user_email,
            'password' => bcrypt($request->create_user_password),
            'role'=>$request->create_user_role,
        ]);
        
    }
}
