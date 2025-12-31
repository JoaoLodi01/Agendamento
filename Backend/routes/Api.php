<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\IssuerController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ComissionController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\PlansController;

Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('email/send', [AuthController::class, 'sendEmail']);

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::apiResource('licenses', LicenseController::class);
    Route::apiResource('plans', PlansController::class);
});

Route::middleware(['auth:sanctum', 'license.valid'])->group(function () {

    Route::prefix('agenda')->group(function () {
        Route::get('/', [AgendaController::class, 'index']);
        Route::get('/hours', [AgendaController::class, 'hours']);
        Route::post('/client', [AgendaController::class, 'storeClient']);
        Route::post('/manual', [AgendaController::class, 'storeManual']);
        Route::get('/{id}', [AgendaController::class, 'show']);
        Route::put('/{id}', [AgendaController::class, 'update']);
        Route::delete('/{id}', [AgendaController::class, 'destroy']);
    });

    Route::apiResource('clients', ClientController::class);
    Route::apiResource('services', ServicesController::class);
    Route::apiResource('products', ProductsController::class);
    Route::apiResource('categories', CategoriesController::class);
    Route::apiResource('attendants', AuthController::class);
    Route::apiResource('comissions', ComissionController::class);
    Route::apiResource('settings', SettingsController::class);
    Route::apiResource('issuer', IssuerController::class);
});