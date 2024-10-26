<?php

use App\Http\Controllers\pageController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

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



// Customer

Route::get('/customerHome', [pageController::class, 'home'])->name('customerHome');

Route::get('/customerHistory', [pageController::class, 'history'])->name('customerHistory');

Route::get('/customerAbout', [pageController::class, 'about'])->name('customerAbout');

Route::get('/getNumber', function(){
    return view('Customer.getNumber');
});

// Admin 

Route::get('/adminHome', function(){
    return view('Admin.adminHome');
});

Route::get('/adminMailbox', function(){
    return view('Admin.adminMailbox');
});