<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CooperativeBranchController;
use App\Http\Controllers\CooperativeCenterController;
use App\Http\Controllers\GroupModulController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\ModulCooperativeController;
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

Route::group([
    'prefix' => 'web-profile'
], function () {
    Route::resource('modul', ModulController::class);
    Route::resource('group-modul', GroupModulController::class);
    Route::resource('pusat-koperasi', CooperativeCenterController::class);
    Route::resource('cabang-koperasi', CooperativeBranchController::class);
    Route::resource('modul-koperasi', ModulCooperativeController::class);
});


Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth');
    Route::post('generate-otp-code', [AuthController::class, 'generateOtp']);
    Route::post('verification-email', [AuthController::class, 'verification']);
    Route::post('update-password', [AuthController::class, 'updatePassword'])->middleware('auth');
});
