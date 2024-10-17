<?php

use App\Http\Controllers\Web\Admin\AdminController;
use App\Http\Controllers\Web\Oauth\OauthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Auth\AuthenticationsController;
use App\Http\Controllers\Web\Staffs\StaffController;
use App\Http\Controllers\Web\Visitors\VisitorsController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
 // Make sure to import your Staff model




Route::group(['prefix' => 'v1'], function () {
    Route::get('/login', [AuthenticationsController::class, 'login'])->name('login-form');
    Route::get('/',  [StaffController::class, 'create'])->name('staffs.login.page');
    Route::post('/staff-login',  [StaffController::class, 'login'])->name('staffs.login');
    Route::post('/login', [AuthenticationsController::class, 'authenticateUser'])->name('login')->middleware('guest');
    Route::get('/google/auth/callback', [OauthController::class, 'handleCallback']);
});

Route::middleware(['auth:web', 'admin'])->prefix('v1')->group(function () {
    Route::get("/admin/dashboard", [AdminController::class, 'index'])->name('dashboard');
    Route::get('/staffs',  [AdminController::class, 'getAllStaffsHistory'])->name('staffs');
    Route::post('/visitors/create', [VisitorsController::class, 'store'])->name('add-visitors');
    Route::get('/admin/visitors/update/{visitor}', [VisitorsController::class, 'edit'])->name('update-visitor-form');
    Route::patch('/admin/visitors/update/{visitor}', [VisitorsController::class, 'update'])->name('update-visitor-data');
    Route::patch('/admin/visitors/check-out/{visitor}', [VisitorsController::class, 'checkOut'])->name('check-visitor-out');
    Route::get('/admin/staffs/update/{staff}', [StaffController::class, 'edit'])->name('update-staff-form');
    Route::patch('/admin/staffs/update/{staff}', [StaffController::class, 'update'])->name('update-staff-data');
    Route::get('/visitors', [AdminController::class, 'getAllTheVisitorForTheMonth'])->name('visitors');
    Route::post('/admin/staff', [StaffController::class, 'store']);
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('notifications');
    Route::post('/add-staff', [AdminController::class, 'createNewStaff'])->name('create.new.staff');
    Route::get('/geofencing', [AdminController::class, 'geofence'])->name('geofencing');
    Route::post("/logout", [AuthenticationsController::class, 'logout']);
    Route::post('/points', [AdminController::class, 'geofence'])->name('mark.view');
    Route::post('/points', [AdminController::class, 'storeGeofence'])->name('mark.geofence');
});

Route::middleware(['web'])->prefix('v1')->group(function(){
    Route::get('/staff/dashboard', [StaffController::class, 'index'])->name('staff.dashboard');
    Route::get('/check-in-history', [StaffController::class, 'getStaffCheckInHistory'])->name('staff.history');
    Route::get('/current', [StaffController::class, 'getStaffCurrentVisitors'])->name('staff.current.visitors.for.the.day');
    Route::get('/visitors-history', [StaffController::class, 'getStaffVisitorsHistory'])->name('staff.visitors.history');

    Route::post("/staff-logout", [AuthenticationsController::class, 'logout']);
    // Route::get('/q', function () {
    //     $name = env("APP_URL")."/user/check-in";
    //         $qr =  QrCode::format('png')->size(300)->generate($name);
    //         return view('info')->with('code' , $qr);
    // }); //TODO: don't touch this

});


Route::get('/auth/redirect', [OauthController::class, 'redirectToGoogleAuth']);
