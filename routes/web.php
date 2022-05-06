<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\VehicleController;  
use App\Http\Controllers\RequestorController; 


// ----------------------------------------------------------------------------
// ADMIN ROUTE GROUD
// ----------------------------------------------------------------------------               



Route::middleware('auth')->group(function(){
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', 'admin_dashboard')->name('admin_dashboard');
    });
});


// ----------------------------------------------------------------------------
// DRIVER ROUTE GROUP
// ---------------------------------------------------------------------------- 

Route::middleware('auth')->group(function(){
    Route::controller(DriverController::class)->group(function () {
        Route::get('/vehicle-driver', 'vehicle_driver')->name('vehicle.driver');
        Route::get('/company/{id}', 'vehicle_company');
        Route::get('/vehicle/{id}', 'vehicle_plate_number');
        Route::post('/create-driver', 'create_driver')->name('create.driver');
        Route::post('/driver/upload-profile', 'upload_profile')->name('upload.profile');
        Route::delete('/driver/revert-profile', 'revert_profile')->name('revert.profile');
        Route::post('/driver/upload-license', 'upload_license')->name('upload.license');
        Route::delete('/driver/revert-license', 'revert_license')->name('revert.license');
        Route::get('/driver-dashboard', 'driver_dashboard')->name('driver.dashboard');
        Route::get('/driver-schedule-logs', 'driver_schedule_logs')->name('driver.schedule.logs');
        Route::get('/driver-profile', 'driver_profile')->name('driver.profile');
        Route::get('/driver-retrieve-profile/{imageFile}', 'getImageFile')->name('image.profile.details');
    });
});


// ----------------------------------------------------------------------------
// REQUESTOR ROUTE GROUP
// ---------------------------------------------------------------------------- 

Route::middleware('auth')->group(function(){
    Route::controller(RequestorController::class)->group(function () {
        Route::get('/requestor-dashboard', 'requestor_dashboard')->name('requestor.dashboard');
        Route::get('/requestor-request-logs', 'requestor_request_logs')->name('requestor.request.logs');
        Route::post('/get-available-vehicle', 'get_available_vehicle')->name('available.vehicle');
        Route::post('/get-vehicle-driver', 'get_vehicle_driver')->name('vehicle.driver.info');

        Route::post('/requestor/create/reservation', 'create_reservation')->name('create.reservation');
        
    });
});



Route::middleware('auth')->group(function(){
    Route::controller(ReservationController::class)->group(function () {
        Route::get('/vehicles-reservation', 'vehicle_reservation')->name('vehicle.reservation');
    });
});


// ----------------------------------------------------------------------------
//  VEHICLE ROUTE GROUP
// ----------------------------------------------------------------------------

Route::middleware('auth')->group(function(){
    Route::controller(VehicleController::class)->prefix('vehicle')->group(function () {
        Route::get('/', 'vehicles')->name('vehicles');
        Route::get('/company/{id}', 'vehicles_company_id');
        Route::post('/upload-image', 'upload')->name('upload.image');
        Route::delete('/revert-image', 'revert')->name('revert.image');
        Route::post('/create', 'create_vehicle')->name('create.vehicle');
        Route::post('/update-driver', 'update_vehicle_driver')->name('update.vehicle.driver');
        Route::post('/change-driver', 'change_vehicle_driver')->name('change.vehicle.driver');


        Route::get('/details/{id}', 'vehicle_details')->name('vehicle.details');
        Route::get('/assign-driver/{id}', 'show_assign_driver')->name('vehicle.driver.assigned');
        Route::post('/vehicle/update/details', 'vehicle_update_details')->name('vehicle.update.details');

      
        Route::get('/retrieve-imagefile/{imageFile}', 'getImageFile')->name('image.vehicle.details');
        Route::get('/odo-logs/{id}', 'odo_logs')->name('vehicle.odoLogs');
        Route::get('/tire-logs/{id}', 'tire_logs')->name('vehicle.tireLogs');
        Route::get('/registration-logs/{id}', 'registration_logs')->name('vehicle.registrationLogs');
        Route::get('/battery-logs/{id}', 'battery_logs')->name('vehicle.batteryLogs');
        Route::get('/pms-logs/{id}', 'pms_logs')->name('vehicle.pmsLogs');
    });
});


// ----------------------------------------------------------------------------
// USER AUTHENTICATION ROUTE GROUPS
// ----------------------------------------------------------------------------

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'auth_dashboard')->name('auth_dashboard');
    Route::post('/attempt-login', 'attempt_login')->name('attempt.login');
    Route::get('/logout', 'logout')->name('logout.attempt'); 
});


// ----------------------------------------------------------------------------
// USER ACCOUNTS ROUTE GROUP
// ----------------------------------------------------------------------------

Route::controller(AdminController::class)->group(function () {
    Route::get('/user-accounts', 'user_accounts')->name('user.account');
    Route::post('/create-users', 'create_users')->name('create.user');

});


// ----------------------------------------------------------------------------
// Audit ROUTE GROUP
// ----------------------------------------------------------------------------

Route::controller(AuditController::class)->prefix('audit')->group(function () {
    Route::get('/dashboard', 'audit_dashboard')->name('audit.dashboard');
    Route::get('/vehicles', 'get_all_vehicles')->name('audit.vehicles');
  
});




