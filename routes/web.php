<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\VehicleController;  


// ----------------------------------------------------------------------------
// Admin Routes Group
// ----------------------------------------------------------------------------               



Route::middleware('auth')->group(function(){
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', 'admin_dashboard')->name('admin_dashboard');
    });
});



Route::middleware('auth')->group(function(){
    Route::controller(DriverController::class)->group(function () {
        Route::get('/vehicle-driver', 'vehicle_driver')->name('vehicle.driver');
        Route::get('/company/{id}', 'vehicle_company');
        Route::get('/vehicle/{id}', 'vehicle_plate_number');
        Route::post('/create-driver', 'create_driver')->name('create.driver');
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


