<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{

    public function admin_dashboard(){

        $vehiclesCount = Vehicle::count();
        $reservationsCount = Reservation::where('reservation_date', now()->format('Y-m-d'))->count();
        
    
    
        return view('content.admin.admin_dashboard',compact( 'vehiclesCount', 'reservationsCount'));
    }


    public function get_all_reservationToday(){
        try{
            $allReservationTodays = Reservation::
            leftJoin('vehicles', 'reservations.vehicle_id', 'vehicles.id')
            ->join('drivers','vehicles.driver_id','drivers.id')
            ->join('users', 'drivers.user_id', 'users.id')
            ->select('users.name AS driver_name',
            'vehicles.vehicle_type',
            'vehicles.plate_no',
            'reservations.reservation_date',
            'reservations.created_at AS createdAt',
            )
            ->where('reservations.reservation_status', '=', 'approve')
            ->where('reservation_date', now()->format('Y-m-d'))
         
           ->get();
            info($allReservationTodays);
            return  DataTables::of($allReservationTodays)
            ->make(true);
        }catch(\Throwable $error){
            info($error->getMessage());
        }
 
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
