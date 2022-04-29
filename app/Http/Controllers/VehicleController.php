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
use App\Models\OdoMeter;
use App\Models\Pms;
use App\Models\VehicleRegistration;
use DB;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\Facades\DataTables;


class VehicleController extends Controller
{
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

        public function vehicles_company_id($id){
        $departments = Department::select('id', 'department_name')
        ->where('company_id', '=' , $id)
        ->get();
        return $departments;       
        }   


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


      public function create(Request $request){
            $dateOfLastPM = $request->vehicleLastPMS;
            $dateOfPM = date('Y-m-d', strtotime($dateOfLastPM. ' + 6 months'));

            $dateOfRegistration = $request->vehicleRegDate;
            $regExpirationDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($dateOfRegistration)) . " + 1 year"));
 

            $temp = TemporaryFile::where('folder', $request->file)->first();
            $uuid = Uuid::uuid4();
            $filename = $temp->filename;
            $newfilename = $uuid.'-'.$filename;

            Storage::move('uploads/tmp/'.$request->file.'/'.$filename, 'images/image_file/'.$newfilename);
            Storage::deleteDirectory('uploads/tmp/'.$request->file);
            $temp->delete();

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
                  'date_replace' => $request->vehicleTirePurchase,
              ]);
              Battery::create([
                  'vehicle_id' => $vehicle->id,
                  'brand_name'=>$request->vehicleBattery,
                  'date_replace'=>$request->vehicleBatteryPurchase,
              ]);
              OdoMeter::create([
                  'vehicle_id' => $vehicle->id,
                  'current_odo'=>$request->vehicleOdo,
              ]);
              Pms::create([
                  'vehicle_id' => $vehicle->id,
                  'kilometer_odo' => $request->vehicleOdo,
                  'date_of_PM' => $dateOfPM,
              ]);
              VehicleRegistration::create([
                  'vehicle_id' => $vehicle->id,
                  'date_registration' => $request->vehicleRegDate,
                  'date_expired' => $regExpirationDate
              ]);
      }
      
      public function update(Request $request){
        Vehicle::find($request->vehicle_id)
        ->update([
          'driver_id' => $request->driver_id
        ]);
      }


      public function change(Request $request){
        Vehicle::find($request->vehicle_id)
        ->update([
          'driver_id' => $request->driver_id
        ]);
      }

      public function view($id){
        $vehicle = DB::table('vehicles')
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
            'batteries.date_replace AS battery_replaced',
            'tires.front_left_tire',
            'tires.front_right_tire',
            'tires.rear_left_tire',
            'tires.rear_right_tire',
            'tires.date_replace AS tire_replaced',
            'pms.kilometer_odo',
            'pms.date_of_pm',
            'users.name',
           )
        ->get();
        return $vehicle;
      }

      public function getImageFile($filename) {
        $path = storage_path('app/images/image_file/' . $filename);
        return response()->file($path); 
    }

      public function odo_logs($id){
        $OdoLogs =OdoMeter::select('current_odo', 'created_at')
        ->where('vehicle_id', '=', $id)
        ->orderBy('created_at', 'DESC')
        ->get();
        return response()->json($OdoLogs);
      }

      public function tire_logs($id){
        $tireLogs =Tire::select('front_left_tire', 'front_right_tire','rear_left_tire', 'rear_right_tire','date_replace')
        ->where('vehicle_id', '=', $id)
        ->orderBy('date_replace', 'DESC')
        ->get();
        return response()->json($tireLogs);
      }

      public function registration_logs($id){
        $registrationLogs =VehicleRegistration::select('date_registration','date_expired')
        ->where('vehicle_id', '=', $id)
        ->orderBy('created_at', 'DESC')
        ->get();
        return response()->json($registrationLogs);
      }

      public function battery_logs($id){
        $batteryLogs =Battery::select('brand_name','date_replace')
        ->where('vehicle_id', '=', $id)
        ->orderBy('created_at', 'DESC')
        ->get();
        return response()->json($batteryLogs);
      }


      public function pms_logs($id){
        $pmsLogs =Pms::select('kilometer_odo','date_of_pm')
        ->where('vehicle_id', '=', $id)
        ->orderBy('date_of_pm', 'DESC')
        ->get();
        return $pmsLogs;
        return response()->json($pmsLogs);
      }

}
