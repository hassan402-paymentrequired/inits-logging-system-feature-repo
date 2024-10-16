<?php

use App\Http\Controllers\Api\Staffs\StaffsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthenticationsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::group(['prefix' => 'v1'], function () {
     Route::post('/login', [AuthenticationsController::class, "staffLogin"]);
});

Route::middleware(['api'])->prefix('v1')->group(function (){
     Route::get('/visitors', [StaffsController::class, 'getStaffVisitors'])->name('staff-visitors');
     Route::get('/history', [StaffsController::class, 'getStaffCheckInHistory'])->name('staff-check-in-history');
     Route::get('/current-visitor', [StaffsController::class, 'getTotalCurrentGuest'])->name('staff-current-visitors');
     Route::get('/user', [AuthenticationsController::class, 'getLoggedInUser'])->name('get-logged-in-user');
     Route::post('/logout', [AuthenticationsController::class, "logout"])->name('logout');

});


