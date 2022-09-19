<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HistoryPenjualanController;

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

// Route::group([
//     'middleware' => 'api',
//     'prefix' => 'auth'
// ], function ($router) {
//     Route::post('login', [AuthController::class, 'login']);
//     Route::post('register', [AuthController::class, 'register']);
//     Route::post('logout', [AuthController::class, 'logout']);
//     // Route::post('/refresh', [AuthController::class, 'refresh']);
//     // Route::get('/user-profile', [AuthController::class, 'userProfile']);    
// });

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::middleware('auth:api')->post('logout', [AuthController::class, 'logout']);
Route::middleware('auth:api')->post('kendaraan/tambahDataMotor', [KendaraanController::class, 'tambahDataMotor']);
Route::middleware('auth:api')->post('kendaraan/updateDataMotor', [KendaraanController::class, 'updateDataMotor']);
Route::middleware('auth:api')->post('kendaraan/tambahDataMobil', [KendaraanController::class, 'tambahDataMobil']);
Route::middleware('auth:api')->post('kendaraan/updateDataMobil', [KendaraanController::class, 'updateDataMobil']);
Route::middleware('auth:api')->post('kendaraan/lihatStokAllKendaraan', [KendaraanController::class, 'lihatStokAllKendaraan']);
Route::middleware('auth:api')->post('kendaraan/lihatStokKendaraanByMerek', [KendaraanController::class, 'lihatStokKendaraanByMerek']);
Route::middleware('auth:api')->post('kendaraan/jualKendaraan', [KendaraanController::class, 'jualKendaraan']);
Route::middleware('auth:api')->post('kendaraan/getLaporanPenjualanPerKendaraan', [HistoryPenjualanController::class, 'getLaporanPenjualanPerKendaraan']);
