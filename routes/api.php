<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthMeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RefreshController;
use App\Http\Controllers\Auth\VerifyController;
use App\Http\Controllers\Estate\SearchEstateController;
use App\Http\Controllers\Estate\SearchEstatePriceController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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

    Route::get('price', SearchEstatePriceController::class)->name('price');

    Route::prefix('auth')->group(function() {
        Route::post('login', LoginController::class)->name('login');
        Route::post('register', RegisterController::class)->name('verification.verify');
        Route::get('email/verify/{id}',[VerifyController::class,'verify'])->name('verification.verify')->middleware('signed');
        Route::get('email/resend',[VerifyController::class,'resend'])->name('verification.resend');

        Route::middleware('jwt.auth')->group(function() {
            Route::post('logout', LogoutController::class)->name('logout');
            Route::post('refresh', RefreshController::class)->name('refresh');
            Route::get('me', AuthMeController::class)->name('me');
        });
    });

    Route::prefix('estates')->middleware('auth:api')->group(function() {
        Route::get('/', );
    });
});

// api_test
Route::middleware('auth:api')->group(function() {
    Route::get('/users', function (Request $request) {
        $users = User::all()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ];
        });

        return response()->json([
            'users' => $users
        ]);
    });
});

