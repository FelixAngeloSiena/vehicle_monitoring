<?php

namespace App\Http\Controllers;

use App\Models\PoRequest;
use App\Models\RequestMaintenance;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use DB;

class PurchasingController extends Controller
{
    public function dashboard(){
        return view('content.purchasing.purchasing_dashboard');
    }

    public function request_purchasing_order(){
        return view('content.purchasing.purchasing_request_po');

    }
    
    public function completed_purchasing_order(){
        return view('content.purchasing.purchasing_completed_po');

    }

    public function fetch_all_request_po(){
        $requestForPo =  DB::table('request_maintenances')
        ->join('vehicles', 'request_maintenances.vehicle_id', '=', 'vehicles.id')
        ->where('request_maintenances.status', 'pending')
        ->select(
            'request_maintenances.created_at AS request_date',
            'request_maintenances.id AS request_id',
            'request_maintenances.request_type AS request_type', 
            'request_maintenances.status AS status',
            'request_maintenances.front_left_tire',
            'request_maintenances.front_right_tire',
            'request_maintenances.rear_left_tire', 
            'request_maintenances.rear_right_tire',
            'vehicles.vehicle_type AS vehicle_type',
            'vehicles.plate_no AS plate_no'
        );


        return  DataTables::of($requestForPo)
        ->addIndexColumn()
        ->addColumn('actions',function($row){

            $btnCreatePo = '<td><button class="btn btn-primary mx-2" onclick=createPo('.$row->request_id.')><i class="fas fa-edit"></i> Edit PO</button></td>';
            $btnSubmitPo = '';     

            $requestForPo = DB::table('po_requests')
            ->where('po_requests.request_maintenance_id', $row->request_id)
            ->get();

            if($row->request_type != 'tire'){
                count($requestForPo ) > 0  && $row->status == 'pending' ?
                    $btnSubmitPo = '<td><button class="btn btn-success" onclick=submitPo('.$row->request_id.')><i class="fas fa-check-double"></i> Submit PO</button></td>' : '';
            }else{
                $count = 0;
                $row->front_left_tire == 'isChecked' ? $count++ : '';
                $row->front_right_tire == 'isChecked' ? $count++ : '';
                $row->rear_left_tire == 'isChecked' ? $count++ : '';
                $row->rear_right_tire == 'isChecked' ? $count++ : '';
                count( $requestForPo) >= $count && $row->status == 'pending' ?  $btnSubmitPo = '<td><button class="btn btn-success" onclick=submitPo('.$row->request_id.')><i class="fas fa-check-double"></i> Submit PO</button></td>' : '';
            }
            $buttons = $btnCreatePo. $btnSubmitPo;
        return $buttons;
        })
        ->addColumn('status',function($row){
            $statusBadge = '<td><span class="badge bg-danger">Pending for PO Number</span></td>';
            if($row->status == 'ready')  $statusBadge = '<td><span class="badge bg-warning"> ready for acknowledgement</span></td>';
            return  $statusBadge; 
        })
        
        ->rawColumns(['actions','status'])
        ->make(true);
    }
		
    public function fetch_request_details($id){
        $requestDetails = DB::table('request_maintenances')
        ->join('vehicles', 'request_maintenances.vehicle_id', '=', 'vehicles.id')
        ->where('request_maintenances.id', $id)
        ->select('request_maintenances.*', 'vehicles.vehicle_type', 'vehicles.plate_no')
        ->first();
        $poDetails = DB::table('po_requests')->where('request_maintenance_id', '=', $id)
        ->get();
        return ['details' => $requestDetails, 'po' => $poDetails, 'po_counts'=> count($poDetails)];
    }

    public function create_request_po(Request $request){

        try{
            $loopCounts = count($request->po_number);
            for($x = 0; $x < $loopCounts; $x++) {
                info($request);
                $tirePos = $request->tire_position[$x];
                if($request->po_id[$x] == 'NULL'){
                    if($request->po_number[$x]){
                        PoRequest::upsert([
                            'id'=> NULL,
                            'request_maintenance_id' => $request->request_id,
                            'po_number' => $request->po_number[$x] ,
                            'supplier_name' => $request->supplier[$x] ,
                            'date_sent' => $request->date_sent[$x],
                            'remarks' => $request->remarks[$x]  ,
                            'tire_position' => $tirePos,
                       ],['id']);
                    }
                }
                else{
                    PoRequest::upsert([
                        'id'=> $request->po_id[$x],
                        'request_maintenance_id' => $request->request_id,
                        'po_number' => $request->po_number[$x] ,
                        'supplier_name' => $request->supplier[$x] ,
                        'date_sent' => $request->date_sent[$x],
                        'remarks' => $request->remarks[$x]  ,
                        'tire_position' => $tirePos,
                   ],['id']);  
                }
            }
            return [
                'status' => 'SUCCESS',
                'message' => 'P.O Created Successfully',
            ];
        }catch(\Throwable $error){
          
            return [
                'status' => 'ERROR',
                'message' => $error->getMessage(),
            ];
        } 
    }

    public function submit_request_po($id){
        try{
            RequestMaintenance::where('id', $id)
            ->update([
                'status' => 'ready',
            ]);
            return [
                'status' => 'SUCCESS',
                'message' => 'P.O Created Successfully',
            ];
        }catch(\Throwable $error){
            info( $error->getMessage());
            return [
                'status' => 'ERROR',
                'message' => $error->getMessage(),
            ];
        }
     
    }

		public function fetch_request_completed(){
	
			try{
				$completedRequest = DB::table('request_maintenances')
				->join('vehicles', 'request_maintenances.vehicle_id', 'vehicles.id')
				->select(
					'request_maintenances.id',
					'request_maintenances.status',
					'request_maintenances.created_at AS request_date',
					'request_maintenances.request_type',
					'vehicles.vehicle_type',
					'vehicles.plate_no'
				)
				->where('request_maintenances.status', '!=', 'pending');
				return  DataTables::of($completedRequest)
				->addIndexColumn()
				->addColumn('status',function($row){
						$statusBadge = '<td><span class="badge bg-success"> Completed acknowledge </span></td>';

						if($row->status == 'ready')  $statusBadge = '<td><span class="badge bg-warning"> ready for acknowledge</span></td>';
						return  $statusBadge; 

				})
				
				->rawColumns(['status'])
				->make(true);
			}catch(\Throwable $error){
					info($error->getMessage());
			}

	}



		
}
