<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\VehicleController;  
use App\Http\Controllers\RequestorController; 


// ----------------------------------------------------------------------------
// Admin Routes Group
// ----------------------------------------------------------------------------               



Route::middleware('auth')->group(function(){
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', 'admin_dashboard')->name('admin_dashboard');
    });
});


// ----------------------------------------------------------------------------
// Driver Routes Group
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
// Requestor Routes Group
// ---------------------------------------------------------------------------- 

Route::middleware('auth')->group(function(){
    Route::controller(RequestorController::class)->group(function () {
        Route::get('/requestor-dashboard', 'requestor_dashboard')->name('requestor.dashboard');
        Route::get('/requestor-request-logs', 'requestor_request_logs')->name('requestor.request.logs');
        Route::post('/get-available-vehicle', 'get_available_vehicle')->name('available.vehicle');
        Route::post('/get-vehicle-driver', 'get_vehicle_driver')->name('vehicle.driver.info');
    });
});



Route::middleware('auth')->group(function(){
    Route::controller(ReservationController::class)->group(function () {
        Route::get('/vehicles-reservation', 'vehicle_reservation')->name('vehicle.reservation');
    });
});


// ----------------------------------------------------------------------------
//  Vehicle Details Routes Group
// ----------------------------------------------------------------------------

Route::middleware('auth')->group(function(){
    Route::controller(VehicleController::class)->group(function () {
        Route::get('/vehicles', 'vehicles')->name('vehicles');
        Route::get('/vehicle-company/{id}', 'vehicles_company_id');
        Route::post('vehicle/upload-image', 'upload')->name('upload.image');
        Route::delete('vehicle/revert-image', 'revert')->name('revert.image');
        Route::post('/vehicle-create', 'create')->name('create.vehicle');
        Route::post('/vehicle-update', 'update')->name('update.vehicle.driver');
        Route::post('/vehicle-change', 'change')->name('change.vehicle.driver');
        Route::get('/vehicle-details/{id}', 'view')->name('view.vehicle.details');
        Route::get('/vehicle-retrieve-imagefile/{imageFile}', 'getImageFile')->name('image.vehicle.details');
        Route::get('/vehicle-odo-logs/{id}', 'odo_logs')->name('vehicle.odoLogs');
        Route::get('/vehicle-tire-logs/{id}', 'tire_logs')->name('vehicle.tireLogs');
        Route::get('/vehicle-registration-logs/{id}', 'registration_logs')->name('vehicle.registrationLogs');
        Route::get('/vehicle-battery-logs/{id}', 'battery_logs')->name('vehicle.batteryLogs');
        Route::get('/vehicle-pms-logs/{id}', 'pms_logs')->name('vehicle.pmsLogs');
        
    });
});


// ----------------------------------------------------------------------------
//  User Authentication Routes Group
// ----------------------------------------------------------------------------

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'auth_dashboard')->name('auth_dashboard');
    Route::post('/attempt-login', 'attempt_login')->name('attempt.login');
    Route::get('/logout', 'logout')->name('logout.attempt'); 
});

// ----------------------------------------------------------------------------
//  Create User Accounts Routes Group
// ----------------------------------------------------------------------------

Route::controller(AdminController::class)->group(function () {
    Route::get('/user-accounts', 'user_accounts')->name('user.account');
    Route::post('/create-users', 'create_users')->name('create.user');

});


