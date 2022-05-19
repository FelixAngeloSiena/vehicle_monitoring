<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Illuminate\Support\Carbon;

class ReservationController extends Controller
{
    public function vehicle_reservation(){
        return view('content.admin.reservation');
    }

    public function vehicle_cancel_reservation(){
        return view('content.reservation.cancel_reservation');
    }

    public function vehicle_approve_reservation(){
        return view('content.reservation.approve_reservation');
    }

    public function vehicle_completed_reservation(){
        return view('content.reservation.completed_reservation');
    }


    public function get_all_reservation(){
        try{
            $reservationRecords = Reservation::join('users', 'reservations.user_id', 'users.id')
            ->join('vehicles', 'reservations.vehicle_id', 'vehicles.id')
            ->where('reservations.reservation_status', '=', 'pending')
            ->select('users.name AS requestor_name',
            'vehicles.vehicle_type',
            'vehicles.plate_no',
            'reservations.id AS reservationId',
            'reservations.reservation_date',
            'reservations.created_at AS createdAt'
            );
            return  DataTables::of($reservationRecords)
            ->addIndexColumn()

            ->addColumn('_driver_name',function($row){
                $drivername = Reservation::join('vehicles', 'reservations.vehicle_id', 'vehicles.id')
                ->join('drivers', 'vehicles.driver_id', 'drivers.id')
                ->join('users', 'drivers.user_id', 'users.id')
                ->select('users.name')
                ->first();
                return '<td> '.$drivername->name.'</td>';
            })
            
            ->addColumn('status',function($row){
                $statusBadge = '<td><span class="badge bg-danger"><i class="fas fa-clock"></i> Pending for Approve</span></td>';
                if($row->reservation_status == 'approve')  $statusBadge = '<td><span class="badge bg-success"> <i class="fas fa-thumbs-up"></i> Request Acknowledge </span></td>';
                return  $statusBadge; 
              })
            ->addColumn('actions',function($row){
                $managerActions = '';
                Auth::user()->role == 'manager' ? $managerActions = 
                '<td>
                    <button type="button" class="btn btn-danger" onclick="cancel_reservation('.$row->reservationId.')"><i class="fas fa-ban"></i> Cancel </button>
                    <button type="button" class="btn btn-success" onclick="approve_reservation('.$row->reservationId.')"><i class="fas fa-check"></i> Approve </button>
                </td>' 
                : $managerActions = '<td ><p style="font-weight:bold" class="mb-0">No further action needed on your End</p></td>';
                return   $managerActions;
            })
            ->rawColumns(['actions','status', '_driver_name'])
            ->make(true);
        }catch(\Throwable $error){
            info($error->getMessage());
        }
   
    }

    public function cancel_reservation($id){
        try{
            $cancel_reservation = Reservation::find( $id );
            $cancel_reservation->delete();
            return [
                'status' => 'SUCCESS',
                'message' => 'Cancel Reservation Successfully',
            ];

        }catch(\Throwable $error){
            return [
                'status' => 'ERROR',
                'message' => $error->getMessage(),
            ];
        }
    }

    public function approve_reservation($id){
        try{
            Reservation::find($id) 
            ->update([
                'reservation_status' => 'approve'
            ]);
            return [
                'status' => 'SUCCESS',
                'message' => 'Cancel Reservation Successfully',
            ];

        }catch(\Throwable $error){
            return [
                'status' => 'ERROR',
                'message' => $error->getMessage(),
            ];
        }
    }


    public function get_cancel_reservation(){
        try{
            $cancel_reservation = Reservation::join('users', 'reservations.user_id', 'users.id')
            ->join('vehicles', 'reservations.vehicle_id', 'vehicles.id')
            ->onlyTrashed();
            return  DataTables::of($cancel_reservation)
            ->addIndexColumn()
            ->addColumn('_driver_name',function($row){
                $drivername = Reservation::join('vehicles', 'reservations.vehicle_id', 'vehicles.id')
                ->join('drivers', 'vehicles.driver_id', 'drivers.id')
                ->join('users', 'drivers.user_id', 'users.id')
                ->select('users.name')
                ->first();
                return '<td> '.$drivername->name.'</td>';
            })
            
            ->addColumn('_status',function($row){
                return '<td><span class="badge bg-danger"> Cancel Reservation </span></td>';
            })
            
            ->addColumn('_created_at',function($row){
                return '<td>'.Carbon::parse($row->created_at)->format('M d, Y').'</td>';
            })
            
            ->rawColumns(['_driver_name', '_status', '_created_at'])
            ->make(true);
        }catch(\Throwable $error){
            return $error->getMessage();
        }
    }

    public function get_approve_reservation(){
        try{
            $approve_reservation = Reservation::join('users', 'reservations.user_id', 'users.id')
            ->join('vehicles', 'reservations.vehicle_id', 'vehicles.id')
            ->join('drivers', 'drivers.id', 'vehicles.driver_id')
            ->select(['users.*', 'vehicles.*', 'reservations.*', 'drivers.user_id as driverID'])
            ->where('reservations.reservation_status', '=', 'approve');
            return  DataTables::of($approve_reservation)
            ->addIndexColumn()
            ->addColumn('_driver_name',function($row){
     
                $drivername = User::where('id', $row->driverID)->first();

                return '<td>'.$drivername->name.'</td>';
            })
            
            ->addColumn('_status',function($row){
                return '<td><span class="badge bg-success"> Approve Reservation </span></td>';
            })
            
            ->addColumn('_created_at',function($row){
                return '<td>'.Carbon::parse($row->created_at)->format('M d, Y').'</td>';
            })
            
            ->rawColumns(['_driver_name', '_status', '_created_at'])
            ->make(true);
        }catch(\Throwable $error){
            return $error->getMessage();
        }
    }

    public function get_completed_reservation(){
        try{
            $approve_reservation = Reservation::join('users', 'reservations.user_id', 'users.id')
            ->join('vehicles', 'reservations.vehicle_id', 'vehicles.id')
            ->join('drivers', 'drivers.id', 'vehicles.driver_id')
            ->select(['users.*', 'vehicles.*', 'reservations.*', 'drivers.user_id as driverID'])
            ->where('reservations.reservation_status', '=', 'approve')
            ->whereRaw('STR_TO_DATE(reservations.reservation_date, "%Y-%m-%d") < "'.Carbon::now()->format('Y-m-d').'"');
            return  DataTables::of($approve_reservation)
            ->addIndexColumn()
            ->addColumn('_driver_name',function($row){
                $drivername = User::where('id', $row->driverID)->first();
                return '<td>'.$drivername->name.'</td>';
            })
            ->addColumn('_status',function($row){
                return '<td><span class="badge bg-success"> Completed </span></td>';
            })
            
            ->addColumn('_created_at',function($row){
                return '<td>'.Carbon::parse($row->created_at)->format('M d, Y').'</td>';
            })
            ->rawColumns(['_driver_name', '_status', '_created_at'])
            ->make(true);
        }catch(\Throwable $error){
            return $error->getMessage();
        }
    }
}
