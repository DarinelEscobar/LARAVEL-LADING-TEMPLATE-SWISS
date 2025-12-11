<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Livewire\UsersManager;
use App\Livewire\ProductsManager;
use App\Http\Controllers\Dev\SwaggerAutoAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [DashBoardController::class, 'home'])->name('home');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('forget-password', [AuthController::class, 'showForgetPasswordForm'])->name('forget.password');
Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset.password');

// Route::get('codigo',function (){
//     return view('welcome');
// });

Route::middleware(['auth','status'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->middleware('role:1')->name('dashboard');
    Route::post('logout',[AuthController::class, 'logout'])->name('logout');

    Route::middleware(['role:1'])->group(function () {
        // Route::resource('users','Admin\AdminController')->except(['destroy', 'update','store']);
        Route::get('users', UsersManager::class)->name('users.index');
        Route::get('products', ProductsManager::class)->name('products.index');

        Route::resource('products', ProductController::class)->except(['index']);
        Route::resource('users', UserController::class)->except(['index']);
    });
});

Route::middleware('web')->post('dev/api-docs/auto-auth', SwaggerAutoAuthController::class)
    ->name('dev.api-docs.auto-auth');
