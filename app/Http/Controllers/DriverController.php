<?php

namespace App\Http\Controllers;
use App\Models\Vehicle;
use App\Models\TemporaryFile;
use App\Models\Company;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;


class DriverController extends Controller
{

    public function driver_dashboard(){
        return view('content.drivers.schedule_dashboard');
    }


    public function driver_schedule_logs(){
        return view('content.drivers.schedule_logs');
    }

    public function driver_profile(){
        $driverInfos = DB::table('drivers')
        ->leftJoin('users','drivers.user_id', '=', 'users.id')
        ->where('drivers.user_id', '=',  Auth::user()->id)
        ->get();
        return view('content.drivers.driver_profile',compact('driverInfos'));
    }

    
    public function getImageFile($filename) {
        $path = storage_path('app/images/image_file/' . $filename);
        return response()->file($path); 
    }


    public function vehicle_driver(){
        $vehicles = Vehicle::select('id', 'vehicle_type')->get();
        $companies = Company::select('id', 'company_name')->get();
        $drivers = DB::table('drivers')
        ->leftJoin('vehicles', 'vehicles.driver_id', '=', 'drivers.id')
        ->leftJoin('users','drivers.user_id', '=' , 'users.id')
        ->selectRaw("CASE WHEN vehicles.driver_id IS NULL THEN 'available' ELSE 'assigned' END AS status, vehicles.*, drivers.*, users.name")
        ->get();
        return view('content.admin.driver', compact('vehicles', 'drivers', 'companies'));
    }


    public function create_driver(Request $request){

        $temp_profile_image = TemporaryFile::where('folder', $request->driver_profile)->first();
        $uuid = Uuid::uuid4();
        $filename = $temp_profile_image->filename;
        $new_profile_image = $uuid.'-'.$filename;

        Storage::move('uploads/tmp/'.$request->driver_profile.'/'.$filename, 'images/image_file/'.$new_profile_image);
        Storage::deleteDirectory('uploads/tmp/'.$request->driver_profile);
        $temp_profile_image->delete();


        $temp_license = TemporaryFile::where('folder', $request->driver_license)->first();
        $uuid = Uuid::uuid4();
        $filename = $temp_license->filename;
        $new_license_image = $uuid.'-'.$filename;

        Storage::move('uploads/tmp/'.$request->driver_license.'/'.$filename, 'images/image_file/'.$new_license_image);
        Storage::deleteDirectory('uploads/tmp/'.$request->driver_license);
        $temp_license->delete();

        $driver_Id =  User::create([
            'name'=>$request->driver_name,
            'email'=>$request->driver_username,
            'password' => bcrypt($request->driver_password),
            'role'=>'driver',
        ]);

         Driver::create([
            'user_id' => $driver_Id->id,
            'id_no' => $request->driver_id,
            'profile_image_path' => $new_profile_image,
            'license_image_path' => $new_license_image,
            'license_type' => $request->license_type,
            'license_reg_date' => $request->license_reg_date,
            'license_exp_date' => $request->license_exp_date,
            'restriction' => $request->license_restriction,
        ]);
        
    }

    
    public function upload_profile(Request $request) {
        if($request->hasFile('driver_profile')) {
            $file = $request->driver_profile;
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

      
      public function revert_profile(Request $request) {
        try {
            $fileId = request()->getContent();
            Storage::deleteDirectory('uploads/tmp/'.$fileId);
            TemporaryFile::where('folder', $fileId)->delete();
            return '';
         } catch (\Throwable $th) {
            return $th->getMessage();
        }
      }


      public function upload_license(Request $request) {
        if($request->hasFile('driver_license')) {
            $file = $request->driver_license;
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

      
      public function revert_license(Request $request) {
        try {
            $fileId = $request()->getContent();
            return $fileId;
            Storage::deleteDirectory('uploads/tmp/'.$fileId);
            TemporaryFile::where('folder', $fileId)->delete();
            return '';
         } catch (\Throwable $th) {
            return 'error';
        }
      }


}
