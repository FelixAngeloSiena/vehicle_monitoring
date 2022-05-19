<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ApproverController extends Controller
{
    // RETURN VIEW OF ALL REQUEST RESERVATION OF APPROVER
    public function approver_reservation(){
        return view('content.approver.approver_dashboard');
    }

    //RETURN VIEW OF ALL APPROVE RESERVATION OF APPROVER
    public function approver_approve_reservation(){
        return view('content.approver.approver_approve_reservation');
    }

    //RETURN VIEW OF ALL CANCEL RESERVATION OF APPROVER
    public function approver_cancel_reservation(){
        return view('content.approver.approver_cancel_reservation');  
    }

    //INITIAL ALL REQUEST RESERVATION TO THE DATATABLE
    public function get_approver_request_reservation(){

        try{
            $reservationRecords = Reservation::join('users', 'reservations.user_id', 'users.id')
            ->join('vehicles', 'reservations.vehicle_id', 'vehicles.id')
            ->join('departments', 'vehicles.department_id', 'departments.id')
            ->join('companies', 'departments.company_id', 'companies.id')
    
            ->select('users.name AS requestor_name',
                'users.company_id',
                'vehicles.vehicle_type',
                'vehicles.plate_no',
                'reservations.id AS reservationId',
                'reservations.reservation_date',
                'reservations.created_at AS createdAt',
                'companies.company_name',
                'companies.id AS company_id'
            )
            ->where('reservations.reservation_status', '=', 'pending')
            ->where('companies.id', Auth::user()->company_id);
            
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
                    Auth::user()->role == 'approver' ? $managerActions = 
                    '<td>
                        <button type="button" class="btn btn-danger" onclick="cancel_reservation('.$row->reservationId.')"><i class="fas fa-ban"></i> Cancel </button>
                        <button type="button" class="btn btn-success" onclick="approve_reservation('.$row->reservationId.')"><i class="fas fa-check"></i> Approve </button>
                    </td>' 
                    : $managerActions = '<td ><p style="font-weight:bold" class="mb-0">No further action needed on your End</p></td>';
                    return   $managerActions;
                })
                ->rawColumns(['actions','status', '_driver_name'])
                ->make(true);
        }catch(\Throwable $err){
            info($err->getMessage());
        }
    }

    //INITIAL ALL APPROVE RESERVATION TO THE DATATABLE
    public function get_approver_approve_reservation(){
        try{
            $reservationRecords = Reservation::join('users', 'reservations.user_id', 'users.id')
            ->join('vehicles', 'reservations.vehicle_id', 'vehicles.id')
            ->join('departments', 'vehicles.department_id', 'departments.id')
            ->join('companies', 'departments.company_id', 'companies.id')
    
            ->select('users.name AS requestor_name',
                'users.company_id',
                'vehicles.vehicle_type',
                'vehicles.plate_no',
                'reservations.id AS reservationId',
                'reservations.reservation_date',
                'reservations.created_at AS createdAt',
                'companies.company_name',
                'companies.id AS company_id',
                'reservations.reservation_status AS status'
            )
            ->where('reservations.reservation_status', '=', 'approve')
            ->where('companies.id', Auth::user()->company_id);
            
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
                    if($row->status == 'approve')  $statusBadge = '<td><span class="badge bg-success"> <i class="fas fa-thumbs-up"></i> Request Approve </span></td>';
                    return  $statusBadge; 
                  })

                ->rawColumns(['status', '_driver_name'])
                ->make(true);
            }catch(\Throwable $err){
                info($err->getMessage());
        }
    }

    //INITIAL ALL CANCEL RESERVATION TO THE DATATABLE
    public function get_approver_cancel_reservation(){
        try{
            $reservationRecords = Reservation::join('users', 'reservations.user_id', 'users.id')
            ->join('vehicles', 'reservations.vehicle_id', 'vehicles.id')
            ->join('departments', 'vehicles.department_id', 'departments.id')
            ->join('companies', 'departments.company_id', 'companies.id')
    
            ->select('users.name AS requestor_name',
                'users.company_id',
                'vehicles.vehicle_type',
                'vehicles.plate_no',
                'reservations.id AS reservationId',
                'reservations.reservation_date',
                'reservations.created_at AS createdAt',
                'companies.company_name',
                'companies.id AS company_id',
                'reservations.reservation_status AS status'
            )
           ->onlyTrashed()
            ->where('companies.id', Auth::user()->company_id);
            
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
                    return  '<td><span class="badge bg-danger"><i class="fas fa-clock"></i> Cancel Reservation</span></td>'; 
                  })
                ->rawColumns(['status', '_driver_name'])
                ->make(true);
            }catch(\Throwable $err){
                info($err->getMessage());
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
                'message' => 'Approve Reservation Successfully',
            ];

        }catch(\Throwable $error){
            return [
                'status' => 'ERROR',
                'message' => $error->getMessage(),
            ];
        }
    }

}
