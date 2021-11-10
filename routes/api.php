<?php

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