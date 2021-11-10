<?php

use App\Http\Livewire\Attendance\LeaveAndAbsen;
use App\Http\Livewire\Attendance\Overtime;
use App\Http\Livewire\Attendance\WorkingTime;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Device\Attendance;
use App\Http\Livewire\Device\Doorlock;
use App\Http\Livewire\Device\Location;
use App\Http\Livewire\Master\Departement;
use App\Http\Livewire\Master\Employees;
use App\Http\Livewire\Master\Subdepartement;
use App\Http\Livewire\Payroll\MonthLists;
use App\Http\Livewire\Payroll\Monthly;
use App\Http\Livewire\Payroll\Weekly;
use App\Http\Livewire\Payroll\WeeklyLists;
use App\Http\Livewire\Report\DeviceHistory;
use App\Http\Livewire\Superadmin\ManagementUsers;
use App\Http\Controllers\FileDownloadController;
use App\Http\Livewire\Component\Select2;
use App\Http\Livewire\Device\Priset;
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

Route::get('/', Dashboard::class)->name('dashboard');

Route::get('testing', function () {
    return view('welcome');
});
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    // master Route
    Route::get('management-users', ManagementUsers::class)->name('management users');

    Route::prefix('m')->group(function () {
        Route::get('departement', Departement::class)->name('master.departement');
        Route::get('departement/subdepartement', Subdepartement::class)->name('master.subdepartement');
        Route::get('employees', Employees::class)->name('master.employees');
    });
    // Device Route
    Route::prefix('device')->group(function () {
        Route::get('location', Location::class)->name('device.location');
        Route::get('attendance', Attendance::class)->name('device.attendance');
        Route::get('doorlock', Doorlock::class)->name('device.doorlock');
        Route::get('remarks', Priset::class)->name('device.remark');
    });
    // Attendance Route
    Route::prefix('ma')->group(function () {
        Route::get('working-time', WorkingTime::class)->name('atd.working');
        Route::get('overtime', Overtime::class)->name('atd.overtime');
        Route::get('leave-absence', LeaveAndAbsen::class)->name('atd.absence');
    });
    // Payroll Route
    Route::prefix('payroll')->group(function () {
        Route::get('weekly', Weekly::class)->name('payroll.weekly');
        Route::get('weekly/{weekly}', WeeklyLists::class)->name('payroll.weekly.list');
        Route::get('monthly', Monthly::class)->name('payroll.monthly');
        Route::get('monthly/{month}', MonthLists::class);
    });

    Route::prefix('report')->group(function () {
        Route::get('device-history', DeviceHistory::class)->name('report.device');
        Route::get('payment-history', function () {})->name('report.payment');
    });

    Route::prefix('files/downloads')->group(function () {
        Route::post('weekly-payroll/excel', [FileDownloadController::class,'downloadWeeklyPaymentEXCEL'])->name('weeklyExcelDownload');
        Route::post('weekly-payroll/csv', [FileDownloadController::class,'downloadWeeklyPaymentCSV'])->name('weeklyCSVDownload');
        // Route::post('weekly-payroll/pdf', [FileDownloadController::class,'downloadWeeklyPaymentPDF'])->name('weeklyPDFDownload');
    });
});
