<?php

use App\Http\Controllers\Api\AuthenticatedUserController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\UserApiController;
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

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'status', 'role:1']) // Standardized Middleware
    ->group(function () {
        Route::get('/user', AuthenticatedUserController::class)->name('api.profile.show');

        Route::apiResource('users', UserApiController::class)->names('api.users');
        Route::apiResource('products', ProductApiController::class)->names('api.products');
    });
