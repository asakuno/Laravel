<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/', function (Request $request) {
    return response()->json(['message' => 'The API is operational.']);
});

Route::middleware('api')->group(function() {
    Route::get('/test', function () {
        return response()->json(['message' => 'API test route']);
    });

    Route::prefix('auth')->name('auth.')->group(function() {
        Route::post('login', LoginController::class)->name('login');
        Route::post('register', RegisterController::class)->name('register');
    });
});
