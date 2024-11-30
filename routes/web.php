<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\pageController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\QueueSettingController;
use App\Http\Controllers\AuthController;
use App\Models\QueueNumber;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Staff

Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');

Route::get('/staff/home', [StaffController::class, 'home'])->name('staff.home');

Route::get('/schedule', [StaffController::class, 'schedule'])->name('schedule');

Route::get('/history', [StaffController::class, 'history'])->name('history');

Route::get('/report', [StaffController::class, 'report'])->name('report');

Route::get('/contact', [StaffController::class, 'contact'])->name('contact');

Route::post('/postContact', [StaffController::class, 'postContact'])->name('postContact');

Route::get('/transfer', [StaffController::class, 'transfer'])->name('transfer');

Route::get('fullcalender', [FullCalenderController::class, 'index'])->name('calendar');

Route::post('fullcalenderAjax', [FullCalenderController::class, 'ajax']);

// Customer

// Route::get('/customerHome', [pageController::class, 'home'])->name('customerHome');

Route::get('/customerHistory', [pageController::class, 'history'])->name('customerHistory');

Route::get('/customerAbout', [pageController::class, 'about'])->name('customerAbout');

Route::get('/getNumber', function () {
    return view('Customer.getNumber');
});

// Admin 

Route::get('/admin/home', [AdminController::class, 'adminHome'])->name('admin.adminHome');

Route::get('/adminMailbox', function () {
    return view('Admin.adminMailbox');
})->name('adminMailbox');

Route::get('/adminReport', function () {
    return view('Admin.Report.adminReport');
})->name('adminReport');

Route::get('/adminReportDetail', function () {
    return view('Admin.Report.adminReportDetail');
})->name('adminReportDetail');

// Route::get('/adminSettingDepartment', function(){
//     return view('Admin.Setting.settingDepartment');
// })->name('adminSetDepartment');

// Route::get('/adminSettingStaff', function(){
//     return view('Admin.Setting.settingStaff');
// })->name('adminSetStaff');

// Route::get('/updateStaffInfo', function(){
//     return view('Admin.Setting.updateStaffInfo');
// })->name('updateStaffInfo');

// Route::get('/adminSettingQueue', function () {
//     return view('Admin.Setting.settingQueue');
// })->name('adminSetQueue');

/* Manage Department */
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/adminSettingDepartment', [AdminController::class, 'index'])->name('adminSetDepartment');

Route::post('/addNewCounter', [AdminController::class, 'store'])->name('addNewCounter');

Route::delete('/deleteCounter/{id}', [AdminController::class, 'deleteCounter'])->name('deleteCounter');
Route::delete('/deleteDepartment/{id}', [AdminController::class, 'deleteDepartment'])->name('deleteDepartment');

/* Manage Staff */
Route::get('/addStaff', [AdminController::class, 'privateInfo'])->name('adminAddStaff');

Route::post('/addedSuccessful', [AdminController::class, 'addStaff'])->name('addStaff');

Route::get('/adminSettingStaff', [AdminController::class, 'displayStaffInfo'])->name('adminSetStaff');

Route::get('/editStaff/{staffID}', [AdminController::class, 'editStaff'])->name('updateStaffInfo');

Route::post('/updateStaff/{staffID}', [AdminController::class, 'updateStaff'])->name('updateStaff');

/* Queue Setting Page */

Route::middleware(['check.queue.hours'])->group(function () {
    Route::get('/adminSettingQueue', [QueueSettingController::class, 'show'])->name('adminSetQueue');
    Route::post('/updatedQueueSetting', [QueueSettingController::class, 'update'])->name('updateQueueSettings');
    // Other queue-related routes
});

/* Customer Page */

Route::get('/customerHome', [customerController::class, 'displayDepartment'])->name('customerHome');

Route::get('/joinQueue/{deparment}', [customerController::class, 'joinQueue'])->name('joinQueue');

// Route::get('/queueStatus/{queue_number}', [customerController::class, 'getQueueStatus'])->name('queue.status');

Route::get('/login', [AuthController::class, 'loginPage'])->name('login.page');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'registerPage'])->name('auth.registerPage');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::middleware(['web'])->group(function () {
    // Other routes...
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
// Protected Routes
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/adminHome', function () {
        return view('admin.adminHome');
    })->name('adminHome');
});

// Staff Routes
Route::middleware(['auth', 'is_staff'])->group(function () {
    Route::get('/home', function () {
        return view('staff.home');
    })->name('home');
});
