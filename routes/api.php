<?php

use App\Http\Controllers\Api\AbsenceController;
use App\Http\Controllers\Api\device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/', [device::class, 'index']);
Route::post('/getroom', [device::class, 'getroom']);
Route::post('/registerdev', [device::class, 'registerdev']);
Route::post('/access_room', [device::class, 'access_room']);
Route::post('/remarks/{id}', [device::class, 'remarks'])->name('withremarks');
Route::post('/counter/{id}', [device::class, 'counter'])->name('withcounter');

// absence
Route::get('/datetime', [AbsenceController::class, 'datetime']);
Route::post('/absensirfidcam', [AbsenceController::class, 'absensi']);
Route::post('/getmoderfidcam ', [AbsenceController::class, 'getmode']);
// Route::post('/datetime', [AbsenceController::class, 'datetime']);
