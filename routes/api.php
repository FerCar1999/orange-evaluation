<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FindProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::middleware('api')->group(function () {
    //Rutas con autenticacion
    Route::prefix('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
    });
    
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::get('products/find/{key}', [ProductController::class, 'findByKey']);
});

Route::post('login', [AuthController::class, 'login']);
Route::post('recovery-password', [UserController::class, 'recoveryPassword']);
Route::get('check-recovery/{token}', [UserController::class, 'checkRecovery']);
