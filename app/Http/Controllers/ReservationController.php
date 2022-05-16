<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ReservationController extends Controller
{
    public function vehicle_reservation(){
        return view('content.admin.reservation');
    }
    public function get_all_reservation(){
        try{
            $reservationRecords = Reservation::join('vehicles', 'reservations.vehicle_id', 'vehicles.id')
            ->join('drivers','vehicles.driver_id','drivers.id')
            ->join('users', 'drivers.user_id', 'users.id')
            ->select('users.name AS driver_name',
            'vehicles.vehicle_type',
            'vehicles.plate_no',
            'reservations.id AS reservationId',
            'reservations.reservation_date',
            'reservations.created_at AS createdAt'
            );
            return  DataTables::of($reservationRecords)
            ->addIndexColumn()
            ->addColumn('status',function($row){
                $statusBadge = '<td><span class="badge bg-danger"><i class="fas fa-clock"></i> Pending for Approve</span></td>';
                if($row->reservation_status == 'approve')  $statusBadge = '<td><span class="badge bg-success"> <i class="fas fa-thumbs-up"></i> Request Acknowledge </span></td>';
                return  $statusBadge; 
              })
            ->addColumn('actions',function($row){
             return '<td><button type="button" class="btn btn-danger" onclick="cancel_reservation('.$row->reservationId.')"><i class="fas fa-ban"></i> Cancel reservation</button></td>';
               
            })
            ->rawColumns(['actions','status'])
            ->make(true);
        }catch(\Throwable $error){
            info($error->getMessage());
        }
   
    }


}
