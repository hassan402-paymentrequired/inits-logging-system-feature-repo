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
    Route::get('/staffs',  [AdminController::class, 'getAllTheStaffForTheMonth'])->name('staffs');
    Route::post('/login', [AuthenticationsController::class, 'authenticateUser'])->name('login');
    Route::get('/google/auth/callback', [OauthController::class, 'handleCallback']);
});

Route::middleware(['auth', 'admin'])->prefix('v1')->group(function () {
    Route::get("/dashboard", [AdminController::class, 'index'])->name('dashboard');
    Route::post('/visitors/create', [VisitorsController::class, 'store'])->name('add-visitors');
    // Route::post('/dashboard/create', [VisitorsController::class, 'store'])->name('add-visitors');
    Route::get('/admin/visitors/update/{visitor}', [VisitorsController::class, 'edit'])->name('update-visitor-form'); 
    Route::patch('/admin/visitors/update/{visitor}', [VisitorsController::class, 'update'])->name('update-visitor-data');
    Route::patch('/admin/visitors/check-out/{visitor}', [VisitorsController::class, 'checkOut'])->name('check-visitor-out');
    Route::get('/visitors', [AdminController::class, 'getAllTheVisitorForTheMonth'])->name('visitors');
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('notifications');
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
        Route::get('/geofencing', [AdminController::class, 'geofence'])->name('geofencing');
});
Route::get('/auth/redirect',[OauthController::class, 'redirectToGoogleAuth'] );
Route::post("/logout", [AuthenticationsController::class, 'logout']);
