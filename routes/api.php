<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\FrontSpinnerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('voucher', FrontSpinnerController::class);
Route::get('voucher/{userid}', 'FrontSpinnerController@show');
Route::get('/updatevoucher/{userid}', [FrontSpinnerController::class, 'updatevoucher']);
Route::get('/jenisvoucher', [FrontSpinnerController::class, 'jenisvoucher']);


Route::get('/getdata/{website}/{jenis_event}', [ApiController::class, 'getdata']);
