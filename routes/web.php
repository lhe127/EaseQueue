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


Route::get('/history', [StaffController::class, 'history'])->name('history');


// Customer

Route::get('/customerHome', [pageController::class, 'home'])->name('customerHome');

Route::get('/customerHistory', [pageController::class, 'history'])->name('customerHistory');

Route::get('/customerAbout', [pageController::class, 'about'])->name('customerAbout');
