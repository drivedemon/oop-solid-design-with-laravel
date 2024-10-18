<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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

Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('check-credential', [LoginController::class, 'checkCredential'])->name('check_credential');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::resource('dashboard', DashboardController::class)->only(['index']);
    Route::resource('documents', DocumentController::class)->only(['index']);

    Route::prefix('users')->group(function () {
        Route::get('profile', [UserController::class, 'profile'])->name('users.profile');
        Route::put('profile/{user}', [UserController::class, 'update'])->name('users.update');
    });
});
