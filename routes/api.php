<?php

use App\Http\Controllers\Api\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'signup']);
Route::post('login', [AuthController::class, 'login']);
Route::post('verify-email-otp', [AuthController::class, 'verifyEmailOtp']);
Route::post('resend-email-otp', [AuthController::class, 'resendEmailOtp'])->middleware('throttle:3,1');
Route::post('forget-password', [AuthController::class, 'forgetPassword'])->middleware('throttle:3,1');
Route::group(['middleware' => ['auth:api']], function () {

    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('change-password', [AuthController::class, 'changePassword']);
});
