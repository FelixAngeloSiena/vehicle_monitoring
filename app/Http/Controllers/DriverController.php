<?php

namespace App\Http\Controllers;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\Company;
use App\Models\Department;
use DB;

use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function vehicle_driver(){
        $vehicles = Vehicle::select('id', 'vehicle_type')->get();
        $companies = Company::select('id', 'company_name')->get();
        $drivers = DB::table('drivers')
        ->leftJoin('vehicles', 'vehicles.driver_id', '=', 'drivers.id')
        ->selectRaw("CASE WHEN vehicles.driver_id IS NULL THEN 'available' ELSE 'assigned' END AS status, vehicles.*, drivers.*")
        ->get();
        return view('content.admin.driver', compact('vehicles', 'drivers', 'companies'));
    }


    public function create_driver(Request $request){
         Driver::create([
            'driver_name' =>$request->driver_info[0]['driverName'],
            'driver_address' => $request->driver_info[0]['driverAddress'],
            'driver_contact' => $request->driver_info[0]['driverContact'],
        ]);
        
    }
}
