<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\IssuerController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\AttendantController;
use App\Http\Controllers\ComissionController;
use App\Http\Controllers\SettingsController;
  
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);
    
Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('auth')->group(function (){
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
    });

    Route::prefix('agenda')->group(function (){
        Route::get('all/{issuerId}', [AgendaController::class, 'index']);
        Route::post('store/{issuerId}', [AgendaController::class, 'store']);
        Route::get('show/{id}', [AgendaController::class, 'show']);
        Route::put('update/{id}', [AgendaController::class, 'update']);
        Route::delete('destroy/{id}', [AgendaController::class, 'destroy']);
    });

    Route::prefix('attendant')->group(function (){
        Route::get('all/{issuerId}', [AuthController::class, 'index']);
        Route::post('store/{issuerId}', [AuthController::class, 'store']);
        Route::get('show/{id}', [AuthController::class, 'show']);
        Route::put('update/{id}', [AuthController::class, 'update']);
        Route::delete('destroy/{id}', [AuthController::class, 'destroy']);
    });

    Route::prefix('client')->group(function (){
        Route::get('all/{issuerId}', [ClientController::class, 'index']);
        Route::post('store/{issuerId}', [ClientController::class, 'store']);
        Route::get('show/{id}', [ClientController::class, 'show']);
        Route::put('update/{id}', [ClientController::class, 'update']);
        Route::delete('destroy/{id}', [ClientController::class, 'destroy']);
    });

    Route::prefix('comission')->group(function (){
        Route::get('all/{issuerId}', [ComissionController::class, 'index']);
        Route::post('store/{issuerId}', [ComissionController::class, 'store']);
        Route::get('show/{id}', [ComissionController::class, 'show']);
        Route::put('update/{id}', [ComissionController::class, 'update']);
        Route::delete('destroy/{id}', [ComissionController::class, 'destroy']);
    });

    Route::prefix('issuer')->group(function (){
        Route::get('all', [IssuerController::class, 'index']);
        Route::post('store', [IssuerController::class, 'store']);
        Route::get('show/{id}', [IssuerController::class, 'show']);
        Route::put('update/{id}', [IssuerController::class, 'update']);
        Route::delete('destroy/{id}', [IssuerController::class, 'destroy']);
    });

    Route::prefix('products')->group(function (){
        Route::get('all/{issuerId}', [ProductsController::class, 'index']);
        Route::post('store/{issuerId}', [ProductsController::class, 'store']);
        Route::get('show/{id}', [ProductsController::class, 'show']);
        Route::put('update/{id}', [ProductsController::class, 'update']);
        Route::delete('destroy/{id}', [ProductsController::class, 'destroy']);
    });

    Route::prefix('services')->group(function (){
        Route::get('all/{issuerId}', [ServicesController::class, 'index']);
        Route::post('store/{issuerId}', [ServicesController::class, 'store']);
        Route::get('show/{id}', [ServicesController::class, 'show']);
        Route::put('update/{id}', [ServicesController::class, 'update']);
        Route::delete('destroy/{id}', [ServicesController::class, 'destroy']);
    });

    Route::prefix('settings')->group(function (){
        Route::get('all/{issuerId}', [SettingsController::class, 'index']);
        Route::post('store/{issuerId}', [SettingsController::class, 'store']);
        Route::get('show/{id}', [SettingsController::class, 'show']);
        Route::put('update/{id}', [SettingsController::class, 'update']);
        Route::delete('destroy/{id}', [SettingsController::class, 'destroy']);
    });
});
