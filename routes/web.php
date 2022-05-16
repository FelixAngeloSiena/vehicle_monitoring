<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\PurchasingController;
use App\Http\Controllers\VehicleController;  
use App\Http\Controllers\RequestorController; 


// ----------------------------------------------------------------------------
// ADMIN ROUTE GROUD
// ----------------------------------------------------------------------------               



Route::middleware('auth')->group(function(){
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', 'admin_dashboard')->name('admin_dashboard');

        Route::get('/dashboard/fetch/reservation', 'get_all_reservationToday')->name('dashboard.fetch.reservation');
    
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


// ----------------------------------------------------------------------------
//   RESERVATION ROUTE GROUP
// ---------------------------------------------------------------------------- 
Route::middleware('auth')->group(function(){
    Route::controller(ReservationController::class)->group(function () {
        Route::get('/vehicles/reservation', 'vehicle_reservation')->name('vehicle.view.reservation');
        Route::get('/fetch/reservation', 'get_all_reservation')->name('vehicle.fetch.reservation');
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
    Route::get('/details/{id}', 'vehicle_details')->name('vehicle.details');
    Route::post('/vehicle/update/details', 'vehicle_update_details')->name('vehicle.update.details');
    Route::get('/retrieve-imagefile/{imageFile}', 'getImageFile')->name('image.vehicle.details');

    //ASSIGN DRIVER
    Route::post('/assigned/driver', 'assigned_vehicle_driver')->name('assigned.vehicle.driver');
    Route::get('/assign/driver/{id}', 'show_assign_driver')->name('vehicle.driver.assigned');

    //CHANGE DRIVER
    Route::post('/change/driver', 'change_vehicle_driver')->name('change.vehicle.driver');
    Route::get('/change/driver/{id}', 'show_change_driver')->name('vehicle.driver.changed');

    //REGARDING LOGS RECORD
    Route::get('/odo/logs/{id}', 'odo_logs')->name('vehicle.odo.logs');
    Route::get('/tire/logs/{id}', 'tire_logs')->name('vehicle.tire.logs');
    Route::get('/registration/logs/{id}', 'registration_logs')->name('vehicle.registration.logs');
    Route::get('/battery/logs/{id}', 'battery_logs')->name('vehicle.battery.logs');
    Route::get('/insurance/logs/{id}', 'insurance_logs')->name('vehicle.insurance.logs');
    Route::get('/pms/logs/{id}', 'pms_logs')->name('vehicle.pms.logs');

    //REGARDING REQUEST MAINTENANCE 
    Route::get('/request/maintenance', 'request_maintenance')->name('vehicle.maintenance');
    Route::post('/create/request/maintenance', 'create_request_maintenance')->name('vehicle.create.maintenance');
    Route::get('/request/maintenance/record', 'request_maintenance_record')->name('vehicle.create.maintenance.record');
    Route::get('/request/maintenance/details/{id}', 'request_maintenance_details')->name('vehicle.details.maintenance');

    Route::post('/acknowledge/request', 'acknowledge_request')->name('vehicle.acknowledge.request');


    
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
// AUDIT ROUTE GROUP
// ----------------------------------------------------------------------------

Route::controller(AuditController::class)->prefix('audit')->group(function () {
    Route::get('/dashboard', 'audit_dashboard')->name('audit.dashboard');
    Route::get('/vehicles', 'get_all_vehicles')->name('audit.vehicles');
    Route::post('/update/odometer', 'update_odometer')->name('audit.update.odometer');
  
});


// ----------------------------------------------------------------------------
// PURCHASING ROUTE GROUP
// ----------------------------------------------------------------------------

Route::controller(PurchasingController::class)->prefix('purchasing')->group(function () {
    Route::get('/dashboard', 'dashboard')->name('purchasing.dashboard');
    Route::get('/request/purchasing/order', 'request_purchasing_order')->name('purchasing.request.po');
    Route::get('/completed/purchasing/order', 'completed_purchasing_order')->name('purchasing.completed.po');

    Route::get('/fetch/request', 'fetch_all_request_po')->name('purchasing.get.request.po');
    Route::get('/fetch/request/details/{id}', 'fetch_request_details')->name('purchasing.request.details');
    Route::post('/create/request/po', 'create_request_po')->name('purchasing.create.request.po');
    Route::get('/submit/request/po/{id}', 'submit_request_po')->name('purchasing.submit.request.po');

    Route::get('/fetch/request/completed', 'fetch_request_completed')->name('purchasing.request.completed');

  
});



