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

Route::get('/test', function (Request $request) {
    return $request->ip();
});

Route::post('/', [device::class, 'index']);
Route::post('/getroom', [device::class, 'getroom']);
Route::get('/getroom', [device::class, 'geterror']);
Route::post('/registerdev', [device::class, 'registerdev']);
Route::get('/registerdev', [device::class, 'geterror']);
Route::post('/access_room', [device::class, 'access_room']);
Route::get('/access_room', [device::class, 'geterror']);
Route::post('/remarks/{id}', [device::class, 'remarks'])->name('withremarks');
Route::get('/remarks/{id}', [device::class, 'geterror']);
Route::post('/counter/{id}', [device::class, 'counter'])->name('withcounter');
Route::get('/counter/{id}', [device::class, 'geterror']);
Route::post('/capture',[device::class,'checkCapture'])->name('checkCapture');
Route::get('/capture', [device::class, 'geterror']);
Route::post('/capture/{id}', [device::class, 'capture'])->name('withcapture');
Route::get('/capture/{id}', [device::class, 'geterror']);

// absence
Route::get('/datetime', [AbsenceController::class, 'datetime']);
Route::post('/absensirfidcam', [AbsenceController::class, 'absensi']);
Route::get('/absensirfidcam', [device::class, 'geterror']);
Route::post('/getmoderfidcam ', [AbsenceController::class, 'getmode']);
Route::get('/getmoderfidcam', [device::class, 'geterror']);
Route::post('/addcardrfidcam ', [AbsenceController::class, 'addcardrfidcam']);
Route::get('/addcardrfidcam', [device::class, 'geterror']);
