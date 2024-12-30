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
use App\Http\Controllers\CustomerAuthController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Queue;
use App\Http\Controllers\LiveTableController;


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


Route::get('/customerHistory', [pageController::class, 'history'])->name('customerHistory');

Route::get('/customerAbout', [pageController::class, 'about'])->name('customerAbout');

Route::get('/getNumber', function () {
    return view('Customer.getNumber');
});

/* Queue Setting Page */

Route::middleware(['check.queue.hours'])->group(function () {
    Route::get('/adminSettingQueue', [QueueSettingController::class, 'show'])->name('adminSetQueue');
    Route::post('/updatedQueueSetting', [QueueSettingController::class, 'openTime'])->name('updateQueueSettings');
    // Other queue-related routes
    Route::post('/transferData', [QueueSettingController::class, 'transferData'])->name('adminSettingQueue');
});

Route::get('/joinQueue/{deparment}', [customerController::class, 'joinQueue'])->name('joinQueue');

Route::get('/login', [AuthController::class, 'loginPage'])->name('login.page');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'registerPage'])->name('auth.registerPage');

Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

Route::middleware(['web'])->group(function () {
    // Other routes...
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Protected Routes
// Admin Routes
Route::middleware(['auth:staff', 'is_admin'])->group(function () {
    Route::get('/adminHome', function () {
        return view('admin.adminHome');
    })->name('adminHome');

    Route::get('/fetchItems', [AdminController::class, 'fetchItems']);

    Route::get('/admin/home', [AdminController::class, 'adminHome'])->name('admin.adminHome');

    Route::get('/reportDetail', [AdminController::class, 'adminReportDetail'])->name('Admin.Report.adminReportDetail');

    Route::get('/staffPerformance', [AdminController::class, 'staffPerformance'])->name('Admin.Report.staffPerformance');

    Route::post('/update-status', [AdminController::class, 'updateStatus']);

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

    Route::delete('/staff/{staffID}', [AdminController::class, 'destroy'])->name('deleteStaff');

    Route::post('/updateStaff/{staffID}', [AdminController::class, 'updateStaff'])->name('updateStaff');

    // Admin receive mail
    Route::get('/adminMailbox', [AdminController::class, 'showRequests'])->name('adminMailbox');

    Route::put('/admin/requests/{id}', [AdminController::class, 'updateRequestStatus'])->name('admin.updateRequest');

    // Route::get('/fetchLiveQueue', [AdminController::class, 'fetchLiveQueue']);
});

// Staff Routes
Route::middleware(['auth:staff', 'is_staff'])->group(function () {
    Route::get('/home', function () {
        return view('staff.home');
    })->name('home');

    Route::get('/staff/showRequests', [StaffController::class, 'showRequests'])->name("Staff_ShowRequests");

    Route::post('/call/{id}', [StaffController::class, 'call'])->name("callNumber");

    Route::post('/skip/{id}', [StaffController::class, 'skip'])->name("skipNumber");

    Route::get('/queueNum', [StaffController::class, 'queueNum']);

    Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');

    Route::get('/staff/home', [StaffController::class, 'home'])->name('staff.home');

    Route::get('/schedule', [StaffController::class, 'schedule'])->name('schedule');

    Route::get('/history', [StaffController::class, 'history'])->name('history');

    Route::get('/report', [StaffController::class, 'report'])->name('report');

    Route::get('/contact', [StaffController::class, 'contact'])->name('contact');

    Route::post('/postContact', [StaffController::class, 'postContact'])->name('postContact');

    Route::get('fullcalender', [FullCalenderController::class, 'index'])->name('calendar');

    Route::post('fullcalenderAjax', [FullCalenderController::class, 'ajax']);

    Route::post('/nextNumber', [StaffController::class, 'nextNumber'])->name('nextNumber');

    Route::post('/transfer/{id}', [StaffController::class, 'transfer'])->name('transfer');

    Route::get('/mark-notifications-viewed', [StaffController::class, 'markNotificationsAsViewed']);
});

// Customer Login and Registration
Route::middleware(['restrictTime'])->group(function () {
    Route::get('/customer/login', [CustomerAuthController::class, 'showLoginForm'])->name('customerLogin.page');

    Route::post('/customer/login', [CustomerAuthController::class, 'login'])->name('customerLogin');

    Route::get('/customer/register', [CustomerAuthController::class, 'showRegisterForm'])->name('customerRegister.page');

    Route::post('/customer/register', [CustomerAuthController::class, 'register'])->name('auth.customerRegister');

    Route::post('/customer/logout', function () {
        Auth::guard('customer')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('customerLogin.page');
    })->name('customer.logout');

    Route::middleware(['auth:customer'])->group(function () {
        Route::get('/customerHome', [customerController::class, 'displayDepartment'])->name('customerHome');

        Route::get('/getNumber', [customerController::class, 'getNumber'])->name('getNumber');

        Route::get('/queue/{queueId}', [customerController::class, 'showQueueStatus'])->name('showQueueStatus');

        Route::get('/queue-status/{queueId}/check', [customerController::class, 'checkQueueStatus'])->name('checkQueueStatus');
    });
});

//Monitor
Route::get('/LiveDashboard', [LiveTableController::class, 'LiveDashboard'])->name('monitor.LiveDashboard');

Route::get('/customerLiveTable', [LiveTableController::class, 'showCustomerLiveTable'])->name('customerLiveTable');

Route::get('/fetch-live-queue', [LiveTableController::class, 'fetchLiveQueue'])->name('fetchLiveQueue');

Route::post('/queue/next', [LiveTableController::class, 'moveToNextQueue'])->name('moveToNextQueue');
