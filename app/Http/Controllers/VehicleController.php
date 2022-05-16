<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Company;
use App\Models\Driver;
use App\Models\Department;
use App\Models\TemporaryFile;
use App\Models\Tire;
use App\Models\Battery;
use App\Models\Insurance;
use App\Models\OdoMeter;
use App\Models\Pms;
use App\Models\RequestMaintenance;
use App\Models\VehicleRegistration;
use DB;
use Illuminate\Support\Carbon;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\Facades\DataTables;


class VehicleController extends Controller
{

  //RETURN VEHICLE DETAILS
  public function vehicles(){
      $companies = Company::select('id', 'company_name')->get();

      $vehicles = DB::table('vehicles')
      ->leftJoin('drivers', 'vehicles.driver_id', '=' ,'drivers.id')
      ->leftJoin('users', 'drivers.user_id', '=', 'users.id')
      ->leftJoin('departments', 'vehicles.department_id', '=', 'departments.id')
      ->leftJoin('companies', 'departments.company_id', '=', 'companies.id')
      ->select('vehicles.*','departments.department_name','departments.company_id', 'companies.company_name','users.name')
      ->get();

      $drivers = DB::table('drivers')
      ->leftJoin('vehicles', 'vehicles.driver_id', '=', 'drivers.id')
      ->leftJoin('users', 'drivers.user_id', '=', 'users.id')
      ->select('drivers.*', 'vehicles.driver_id','users.name')
      ->whereNull('vehicles.driver_id')
      ->get();

      return view('content.admin.vehicle', compact('companies', 'vehicles', 'drivers'));
  }

  //RETURN DEPARTMENT OF SPECIFIC VEHICLE
  public function vehicles_company_id($id){
      $departments = Department::select('id', 'department_name')
      ->where('company_id', '=' , $id)
      ->get();
      return $departments;       
  }   

  //UPLOAD IMAGE OF VEHICLE
  public function upload(Request $request) {
    if($request->hasFile('file')) {
        $file = $request->file;
        $extension = $file->extension();
        $filename = \uniqid() . '-' . now()->timestamp.'.'.$extension;
        $folder = \uniqid() . '-' . now()->timestamp;
        $file->storeAs('uploads/tmp/'. $folder, $filename);

        TemporaryFile::create([
            'folder'=>$folder,
            'filename'=>$filename
        ]);
      return $folder;
      }
      return '';
  }

  //REVERT OR DELETE UPLOADED IMAGE OF THE VEHICLE
  public function revert(Request $request) {
    try {
        $fileId = request()->getContent();
        Storage::deleteDirectory('uploads/tmp/'.$fileId);
        TemporaryFile::where('folder', $fileId)->delete();
        return '';
      } catch (\Throwable $th) {
        return 'error';
    }
  }

  //CREATE NEW VEHICLE 
  public function create_vehicle(Request $request){
    $vehicleBatteryPurchase =  $request->vehicleTirePurchase;
    $vehicleTirePurchase =  $request->vehicleBatteryPurchase;

    $dateofTireChange = date("Y-m-d", strtotime($vehicleTirePurchase. " + 3 year"));
    $dateofBatteryChange = date("Y-m-d", strtotime($vehicleBatteryPurchase. " + 3 year"));
        
    
    $dateOfLastPM = $request->vehicleLastPMS;
    $dateOfPM = date('Y-m-d', strtotime($dateOfLastPM. ' + 6 months'));


    $dateOfRegistration = $request->vehicleRegDate;
    $regExpirationDate = date("Y-m-d", strtotime($dateOfRegistration. " + 1 year"));


    $temp = TemporaryFile::where('folder', $request->file)->first();
    $uuid = Uuid::uuid4();
    $filename = $temp->filename;
    $newfilename = $uuid.'-'.$filename;

    Storage::move('uploads/tmp/'.$request->file.'/'.$filename, 'images/image_file/'.$newfilename);
    Storage::deleteDirectory('uploads/tmp/'.$request->file);
    $temp->delete();

    try{
        $vehicle =  Vehicle::create([
          'department_id' =>$request->vehicle_department,
          'driver_id' => Null,
          'vehicle_type' => $request->vehicleType,
          'vehicle_year_model' => $request->vehicleModel,
          'plate_no' => $request->vehiclePlate,
          'mv_file_no' => $request->vehicleMV,
          'motor_no' => $request->vehicleMotor,
          'chasis_no' => $request->vehicleChasis,
          'image_path' => $newfilename,
        ]);
        Tire::create([
            'vehicle_id' => $vehicle->id,
            'front_left_tire' => $request->vehicleTire,
            'front_right_tire' => $request->vehicleTire,
            'rear_left_tire' => $request->vehicleTire,
            'rear_right_tire' => $request->vehicleTire,
            'date_changed' => $vehicleTirePurchase,
            'date_next_change' => $dateofTireChange,
        ]);
        Battery::create([
            'vehicle_id' => $vehicle->id,
            'brand_name'=>$request->vehicleBattery,
            'date_changed' => $vehicleBatteryPurchase,
            'date_next_change' => $dateofBatteryChange,
        ]);
        OdoMeter::create([
            'vehicle_id' => $vehicle->id,
            'current_odo'=>$request->vehicleOdo,
        ]);
        Pms::create([
            'vehicle_id' => $vehicle->id,
            'kilometer_odo' => $request->vehicleOdo,
            'date_of_PM' => $dateOfLastPM,
            'date_of_next_pms' => $dateOfPM,
        ]);
        VehicleRegistration::create([
            'vehicle_id' => $vehicle->id,
            'date_registration' => $request->vehicleRegDate,
            'date_expired' => $regExpirationDate
        ]);
        Insurance::create([
          'vehicle_id' => $vehicle->id,
          'date_insurance_applied' => $request->insuranceApplied,
          'date_insurance_expired' => $request->insuranceExpired
      ]);
    }catch(\Throwable $e){
      return $e;
    }
  }

  //UPDATE VEHICLE DETAILS 
  public function vehicle_update_details(Request $request){
    Vehicle::find($request->vehicleId)
    ->update([
      'vehicle_type' => $request->vehicleType,
      'vehicle_year_model' => $request->updateYearModel,
      'plate_no' => $request->updatePlateNumber,
      'mv_file_no' => $request->updateMVFile,
      'motor_no' => $request->updateMotor,
      'chasis_no' => $request->updateChasis,

    ]);
  }

  //ASSIGNED DRIVER TO VEHICLE
  public function assigned_vehicle_driver(Request $request){
    Vehicle::find($request->vehicle_id)
    ->update([
      'driver_id' => $request->driver_id
    ]);
  }

  //SET VEHICLE DETAILS IN ASSIGN DRIVER MODAL
  public function show_assign_driver($id){
    $vehicleDetails = Vehicle::select('vehicle_type', 'plate_no', 'id')
    ->where('id', $id)
    ->get();
    return  $vehicleDetails; 
  }

  //CHANGE DRIVER TO VEHICLE
  public function change_vehicle_driver(Request $request){
    Vehicle::find($request->vehicle_id)
    ->update([
      'driver_id' => $request->driver_id
    ]);
  }

  //SET VEHICLE DETAILS IN CHANGE DRIVER MODAL
  public function show_change_driver($id){
    $vehicleDetails = Vehicle::select('vehicle_type', 'plate_no', 'id')
    ->where('id',$id)
    ->get();
    return  $vehicleDetails; 
  }

  //RETURN VEHICLE DETAILS  
  public function vehicle_details($id){
      try{
        $vehicles = DB::table('vehicles')
        ->leftJoin('drivers', 'vehicles.driver_id', '=', 'drivers.id')
        ->leftJoin('users', 'drivers.user_id', '=', 'users.id')
        ->join('odo_meters','vehicles.id', '=', 'odo_meters.vehicle_id')
        ->join('vehicle_registrations', 'vehicles.id', '=' ,'vehicle_registrations.vehicle_id')
        ->join('batteries', 'vehicles.id', '=' ,'batteries.vehicle_id')
        ->join('tires', 'vehicles.id', '=' ,'tires.vehicle_id')
        ->join('pms', 'vehicles.id', '=' ,'pms.vehicle_id')
        ->where('vehicles.id',$id)
        ->orderBy('odo_meters.created_at', 'DESC')
        ->orderBy('vehicle_registrations.created_at', 'DESC')
        ->limit(1)
        ->select(
            'vehicles.*',
            'odo_meters.current_odo',
            'vehicle_registrations.date_registration',
            'vehicle_registrations.date_expired',
            'batteries.brand_name',
            'batteries.date_changed AS battery_changed',
            'batteries.date_next_change AS battery_next_change',
            'tires.front_left_tire',
            'tires.front_right_tire',
            'tires.rear_left_tire',
            'tires.rear_right_tire',
            'tires.date_changed AS tire_changed',
            'tires.date_next_change AS tire_next_change',
            'pms.kilometer_odo',
            'pms.date_of_pm',
            'users.name',
            )
        ->get();
      }catch(\Throwable $err){
        return $err;
      }

      return view('content.vehicle.vehicle_details',compact('vehicles','id'));
  }

  //RETURN IMAGE PATH
  public function getImageFile($filename) {
    $path = storage_path('app/images/image_file/' . $filename);
    return response()->file($path); 
  }


  //RETURN ODO LOGS OF VEHICLE
  public function odo_logs($id){
      $OdoLogs =OdoMeter::select('current_odo', 'created_at')
        ->where('vehicle_id', $id)
        ->orderBy('created_at', 'DESC');
      return  DataTables::of($OdoLogs)
      ->addIndexColumn()
        ->addColumn('created_at',function($row){
        return '<td>'.$row->created_at->format('d M Y').'</td>';
      })
      ->rawColumns(['created_at'])
      ->make(true);
  }

  //RETURN TIRE LOGS OF VEHICLE
  public function tire_logs($id){
      $tireLogs =Tire::select('front_left_tire', 'front_right_tire','rear_left_tire', 'rear_right_tire','date_changed', 'date_next_change')
        ->where('vehicle_id', $id)
        ->orderBy('date_changed', 'DESC');
      return  DataTables::of($tireLogs)
        ->addIndexColumn()
        ->addColumn('_date_changed',function($row){
        return '<td>'.Carbon::parse($row->date_changed)->format('d M Y').'</td>';
      })
        ->addColumn('_date_next_change',function($row){
        return '<td>'.Carbon::parse($row->date_next_change)->format('d M Y').'</td>';
      })
        ->rawColumns(['_date_changed', '_date_next_change'])
        ->make(true);
  }

  //RETURN REGISTRATION LOGS OF THE VEHICLE
  public function registration_logs($id){
    $registrationLogs = VehicleRegistration::select('date_registration','date_expired')
    ->where('vehicle_id', $id)
    ->orderBy('created_at', 'DESC');
    return  DataTables::of($registrationLogs)
    ->addIndexColumn()
      ->addColumn('_date_registration',function($row){
      return '<td>'.Carbon::parse($row->date_registration)->format('d M Y').'</td>';
    })
    ->addIndexColumn()
      ->addColumn('_date_expired',function($row){
      return '<td>'.Carbon::parse($row->date_expired)->format('d M Y').'</td>';
    })
    ->rawColumns(['_date_registration','_date_expired'])
    ->make(true);

  }

  //RETURN BATTERY LOGS OF THE VEHICLE
  public function battery_logs($id){
    $batteryLogs =Battery::select('brand_name','date_changed','date_next_change')
    ->where('vehicle_id', '=', $id)
    ->orderBy('created_at', 'DESC');

    return  DataTables::of($batteryLogs)
    ->addIndexColumn()
      ->addColumn('_date_changed',function($row){
      return '<td>'.Carbon::parse($row->date_changed)->format('d M Y').'</td>';
    })
    ->addIndexColumn()
      ->addColumn('_date_next_change',function($row){
      return '<td>'.Carbon::parse($row->date_next_change)->format('d M Y').'</td>';
    })
    ->rawColumns(['_date_changed','_date_next_change'])
    ->make(true);
  }

  //RETURN INSURANCE LOGS OF THE VEHICLE
  public function insurance_logs($id){
    $insuranceLogs = Insurance::select('date_insurance_applied','date_insurance_expired')
    ->where('vehicle_id', $id)
    ->orderBy('created_at', 'DESC');
    return  DataTables::of($insuranceLogs)
    ->addIndexColumn()
      ->addColumn('_date_insurance_applied',function($row){
      return '<td>'.Carbon::parse($row->date_insurance_applied)->format('d M Y').'</td>';
    })
    ->addIndexColumn()
      ->addColumn('_date_insurance_expired',function($row){
      return '<td>'.Carbon::parse($row->date_insurance_expired)->format('d M Y').'</td>';
    })
    ->rawColumns(['_date_insurance_applied','_date_insurance_expired'])
    ->make(true);
  }

  //RETURN PMS LOG OF THE VEHICLE
  public function pms_logs($id){
    $pmsLogs =Pms::select('kilometer_odo','date_of_pm','date_of_next_pms')
    ->where('vehicle_id', '=', $id)
    ->orderBy('date_of_pm', 'DESC');
    return  DataTables::of($pmsLogs)
    ->addIndexColumn()
      ->addColumn('_date_of_pm',function($row){
      return '<td>'.Carbon::parse($row->date_of_pm)->format('d M Y').'</td>';
    })
    ->addIndexColumn()
      ->addColumn('_date_of_next_pms',function($row){
      return '<td>'.Carbon::parse($row->date_of_next_pms)->format('d M Y').'</td>';
    })
    ->rawColumns(['_date_of_pm','_date_of_next_pms'])
    ->make(true);
  }

  //RETURN VIEW REQUEST MAINTENANCE OF VEHICLE
  public function request_maintenance(){
    $vehicles = Vehicle::select('id', 'vehicle_type','plate_no')
    ->get();
    return view('content.vehicle.vehicle_request_maintenance',compact('vehicles'));
  }

  //SET ALL MAINTENANCE REQUEST TO THE DATATABLE
  public function request_maintenance_record(){
    $requestMaintenance = RequestMaintenance:: select(
        'vehicle_id',
        'id',
        'request_type', 
        'description',
        'status' , 
        'created_at',
    );
    return  DataTables::of($requestMaintenance)
      ->addIndexColumn()
      ->addColumn('actions',function($row){
          return'<td><a href="#" type="button" class="btn btn-primary" id="btn-acknowledge" onclick="requestDetails('.$row->id.')"> <i class="fas fa-file-signature"></i> Acknowledge</a></td>';
      })
      ->addColumn('status',function($row){

        $statusBadge = '<td><span class="badge bg-danger"><i class="fas fa-clock"></i> Pending for PO Number</span></td>';
        if($row->status == 'ready')  $statusBadge = '<td><span class="badge bg-warning"><i class="fas fa-check-double"></i> Ready for Acknowledge</span></td>';
        if($row->status == 'completed')  $statusBadge = '<td><span class="badge bg-success"> <i class="fas fa-thumbs-up"></i> Request Acknowledge </span></td>';
        return  $statusBadge; 
      })
        ->addColumn('created_at',function($row){
        return '<td>'.$row->created_at->format('Y-m-d').'</td>';
      })
    ->rawColumns(['actions','status', 'created_at'])
    ->make(true);
  }

  //CREATE MANUAL REQUEST MAINTENANCE
  public function create_request_maintenance(Request $request){
    try{
      RequestMaintenance::create([
        'vehicle_id' => $request->vehicleId,
        'status' => 'pending',
        'request_type' => $request->request_type,
        'description' => $request->description,  
        'front_left_tire' => $request->frontLeftTire,    
        'front_right_tire' => $request->frontRightTire,    
        'rear_left_tire' => $request->rearLeftTire,    
        'rear_right_tire' => $request->rearRightTire,    
      ]);
      } catch (\Throwable $th) {
        return 'error';
    }
  }

   //SET REQUEST MAINTENANCE DETAILS 
    public function request_maintenance_details($id){
        $requestDetails = DB::table('request_maintenances')
        ->join('vehicles', 'request_maintenances.vehicle_id', 'vehicles.id')
        ->where('request_maintenances.id', $id)
        ->first();

        $poDetails = DB::table('request_maintenances')
        ->join('po_requests', 'request_maintenances.id', 'po_requests.request_maintenance_id')
        ->where('request_maintenances.id', $id)
        ->get();

        return ['request_details' => $requestDetails, 'po_details' =>  $poDetails, 'po_counts'=> count($poDetails) ];
    }

    public function acknowledge_request(Request $request){
      info($request);
      try{
        DB::table('request_maintenances')
        ->where('id', $request->requestId)
        ->update([
          'status' => 'completed'
        ]);

        if($request->requestType == 'battery')
          Battery::create([
            'vehicle_id' => $request->requestVehicleId,
            'brand_name' => $request->requestSupplier,
            'date_changed' => $request->dateChange,
            'date_next_change' => date("Y-m-d", strtotime($request->dateChange. " + 3 year"))
        ]);

        return [
            'status' => 'SUCCESS',
            'message' => 'Acknowledge Request Successfully',
        ];

      }catch(\Throwable $error){
        return [
          'status' => 'ERROR',
          'message' => $error->getMessage(),
        ];
      } 
    }
}


