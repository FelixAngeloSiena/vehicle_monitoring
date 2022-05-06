<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AuditController extends Controller
{
    public function audit_dashboard(){
      

        return view('content.audit.audit_dashboard');
    }

    public function get_all_vehicles(){
        $department = Department::where('company_id',  Auth::user()->company_id)->select('id')->get()->pluck('id')->toArray();
        $vehicle = Vehicle::
        leftJoin('odo_meters','vehicles.id', '=', 'odo_meters.vehicle_id')
        ->whereIn('vehicles.department_id',  $department)
        ->select(
                'vehicles.id AS vehicle_id',
                'vehicles.vehicle_type', 
                'vehicles.vehicle_year_model',
                'vehicles.plate_no', 
                'vehicles.mv_file_no',
                'vehicles.motor_no',
                'vehicles.chasis_no',
                'odo_meters.current_odo'
            );
            return  DataTables::of($vehicle)
            ->addIndexColumn()
            ->addColumn('actions',function($row){
                return '<td><a href="#" type="button" class="btn btn-primary" onclick="updateOdo('.$row->vehicle_id.')">Update Odo</a></td>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
    
}
