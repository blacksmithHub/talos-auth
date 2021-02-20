<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomerController;

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
Route::post('bind', [CustomerController::class, 'bind']);
Route::post('unbind', [CustomerController::class, 'unbind']);
Route::post('verify', [CustomerController::class, 'verify']);
Route::post('me', [CustomerController::class, 'me']);
