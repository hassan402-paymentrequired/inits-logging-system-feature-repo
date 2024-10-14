<?php

use App\Http\Controllers\Web\Admin\AdminController;
use App\Http\Controllers\Web\Oauth\OauthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Auth\AuthenticationsController;
use App\Http\Controllers\Web\Visitors\VisitorsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['prefix' => 'v1'], function () {
    Route::get('/login', [AuthenticationsController::class, 'login'])->name('login-form');
    // Route::get('/visitors', function () {
    //     return view('visitors.index');
    // })->name('visitors');
    Route::get('/visitors', [AdminController::class, 'getAllTheVisitorForTheMonth'])->name('visitors');
    
    Route::get('/staffs',  [AdminController::class, 'getAllTheStaffForTheMonth'])->name('staffs');
    
    Route::get('/notifications', function () {
        return view('notifications.index');
    })->name('notifications');
    
    Route::get('/analytics', function () {
        return view('analytics.index');
    })->name('analytics');
    
    Route::get('/geofencing', function () {
        return view('geofencing.index');
    })->name('geofencing');
    Route::post('/login', [AuthenticationsController::class, 'authenticateUser'])->name('login');
    Route::get('/google/auth/callback', [OauthController::class, 'handleCallback']);
});

Route::middleware(['auth', 'admin'])->prefix('v1')->group(function () {
    Route::get("/dashboard", [AdminController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/create', [VisitorsController::class, 'store'])->name('add-visitors');
});

 
Route::get('/auth/redirect',[OauthController::class, 'redirectToGoogleAuth'] );
 
Route::post("/logout", [AuthenticationsController::class, 'logout']);
