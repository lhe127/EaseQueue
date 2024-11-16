<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\pageController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FullCalenderController;
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
    return view('welcome');
});

// Staff

Route::get('/home', [StaffController::class, 'home'])->name('home');

Route::get('/schedule', [StaffController::class, 'schedule'])->name('schedule');

Route::get('/history', [StaffController::class, 'history'])->name('history');

Route::get('/report', [StaffController::class, 'report'])->name('report');

Route::get('/contact', [StaffController::class, 'contact'])->name('contact');

Route::post('/postContact', [StaffController::class, 'postContact'])->name('postContact');

Route::get('/transfer', [StaffController::class, 'transfer'])->name('transfer');

Route::get('fullcalender', [FullCalenderController::class, 'index'])->name('calendar');

Route::post('fullcalenderAjax', [FullCalenderController::class, 'ajax']);
// Customer

Route::get('/customerHome', [pageController::class, 'home'])->name('customerHome');

Route::get('/customerHistory', [pageController::class, 'history'])->name('customerHistory');

Route::get('/customerAbout', [pageController::class, 'about'])->name('customerAbout');

Route::get('/getNumber', function(){
    return view('Customer.getNumber');
});

// Admin 

Route::get('/adminHome', [AdminController::class, 'adminHome'])->name('adminHome');


Route::get('/adminMailbox', function(){
    return view('Admin.adminMailbox');
})->name('adminMailbox');

Route::get('/adminReport', function(){
    return view('Admin.Report.adminReport');
})->name('adminReport');

Route::get('/adminReportDetail', function(){
    return view('Admin.Report.adminReportDetail');
})->name('adminReportDetail');

// Route::get('/adminSettingDepartment', function(){
//     return view('Admin.Setting.settingDepartment');
// })->name('adminSetDepartment');

// Route::get('/adminSettingStaff', function(){
//     return view('Admin.Setting.settingStaff');
// })->name('adminSetStaff');

Route::get('/updateStaffInfo', function(){
    return view('Admin.Setting.updateStaffInfo');
})->name('updateStaffInfo');

Route::get('/adminSettingQueue', function(){
    return view('Admin.Setting.settingQueue');
})->name('adminSetQueue');

//Department Management function
Route::get('/adminSettingDepartment', [AdminController::class, 'index'])->name('adminSetDepartment');

Route::post('/addNewCounter', [AdminController::class, 'store'])->name('addNewCounter');

Route::delete('/deleteCounter/{id}', [AdminController::class, 'deleteCounter'])->name('deleteCounter');
Route::delete('/deleteDepartment/{id}', [AdminController::class, 'deleteDepartment'])->name('deleteDepartment');

//Staff Management function
Route::get('/addStaff', [AdminController::class, 'privateInfo'])->name('adminAddStaff');

Route::post('/addedSuccessful', [AdminController::class, 'addStaff'])->name('addStaff');

Route::get('/adminSettingStaff', [AdminController::class, 'displayStaffInfo'])->name('adminSetStaff');

