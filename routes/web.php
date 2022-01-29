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
use App\Http\Livewire\Device\DoorlockManagement;
use App\Http\Livewire\Device\Priset;
use App\Http\Livewire\Master\Golongan;
use App\Http\Livewire\Report\AbsenceReport;
use App\Http\Livewire\Report\DoorlockReport;
use App\Http\Livewire\Superadmin\Permisions;
use App\Http\Livewire\Superadmin\Roles;
use App\Http\Livewire\User\ProfileInformation;
use App\Models\collectAttendance;
use App\Models\memployee;
use Carbon\Carbon;
use Illuminate\Routing\RouteGroup;
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
// Route::get('test', function(){
//     $users = memployee::all();
//     $absence = [];
//     $adaAbsen = [];
//     foreach ($users as $key => $value) {
//         $cekAbsence = collectAttendance::whereDate('created_at','=',Carbon::today())->where('user_id',$value->id)->first();
//         if ($cekAbsence === null) {
//             $absence[] = $value->id;
//         }else{
//             $adaAbsen[] = $cekAbsence;
//         }
//     }
//     dd($absence,$adaAbsen);
// });

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::prefix('admin')->group(function () {
        Route::get('permisions', Permisions::class)->middleware('can:super_admin')->name('admin.permisions');
        Route::get('roles', Roles::class)->middleware('can:super_admin')->name('admin.role');
        Route::get('management-users', ManagementUsers::class)->name('admin.managementusers');
    });
    
    // master Route
    Route::prefix('m')->group(function () {
        Route::get('departement', Departement::class)->middleware('can:departement_show')->name('master.departement');
        Route::get('departement/subdepartement', Subdepartement::class)->middleware('can:subdepartement_show')->name('master.subdepartement');
        Route::get('employees', Employees::class)->middleware('can:pegawai_show')->name('master.employees');
    });
    // Device Route
    Route::prefix('device')->group(function () {
        Route::get('location', Location::class)->middleware('can:location_show')->name('device.location');
        Route::get('attendance', Attendance::class)->middleware('can:attandanceDevice_show')->name('device.attendance');
        Route::get('doorlock', Doorlock::class)->middleware('can:doorlockDevice_show')->name('device.doorlock');
        Route::get('remarks', Priset::class)->middleware('can:remark_show')->name('device.remark');
        Route::get('doorlock-management', DoorlockManagement::class)->middleware('can:schadule_show')->name('device.management');
    });
    // Attendance Route
    Route::prefix('ma')->group(function () {
        Route::get('working-time', WorkingTime::class)->middleware('can:workingTime_show')->name('atd.working');
        Route::get('leave-absence', LeaveAndAbsen::class)->middleware('can:LeaveAndAbsence_show')->name('atd.absence');
    });
    // Payroll Route
    Route::prefix('payroll')->group(function () {
        Route::get('weekly', Weekly::class)->middleware('can:weeklyPayroll_access')->name('payroll.weekly');
        Route::get('weekly/{weekly}', WeeklyLists::class)->middleware('can:weeklyPayroll_access')->name('payroll.weekly.list');
        Route::get('monthly', Monthly::class)->middleware('can:MonthlyPayroll_access')->name('payroll.monthly');
        Route::get('monthly/{month}', MonthLists::class)->middleware('can:MonthlyPayroll_access')->name('payroll.monthly.list');
    });

    Route::prefix('report')->group(function () {
        Route::get('device-history', DeviceHistory::class)->middleware('can:DeviceHistoryReport_access')->name('report.device');
        Route::get('absence', AbsenceReport::class)->middleware('can:AbsenceReport_access')->name('report.absence');
        Route::get('doorlock', DoorlockReport::class)->middleware('can:DoorlockReport_access')->name('report.doorlock');
    });

    Route::prefix('files/downloads')->group(function () {
        Route::post('weekly-payroll/excel', [FileDownloadController::class,'downloadWeeklyPaymentEXCEL'])->middleware('can:weeklyPayroll_access')->name('weeklyExcelDownload');
        Route::post('weekly-payroll/csv', [FileDownloadController::class,'downloadWeeklyPaymentCSV'])->middleware('can:weeklyPayroll_access')->name('weeklyCSVDownload');
        Route::post('monthly-payroll/excel', [FileDownloadController::class,'downloadMonthPaymentEXCEL'])->middleware('can:MonthlyPayroll_access')->name('monthlyExcelDownload');
        Route::post('monthly-payroll/csv', [FileDownloadController::class,'downloadMonthPaymentCSV'])->middleware('can:MonthlyPayroll_access')->name('monthlyCSVDownload');
    });
});
