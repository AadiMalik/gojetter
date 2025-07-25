<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommonController;
use App\Http\Controllers\Api\ContactUsMessageController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\SocialMediaController;
use App\Http\Controllers\Api\TourController;
use App\Http\Controllers\Api\WishlistController;
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
// social media
Route::get('social-media-list', [SocialMediaController::class, 'index']);
// common
Route::get('term-and-condition', [CommonController::class, 'termAndCondition']);
Route::get('privacy-policy', [CommonController::class, 'privacyPolicy']);
Route::get('faqs', [CommonController::class, 'faqs']);
Route::get('currency-list', [CommonController::class, 'currency']);
Route::get('country-list', [CommonController::class, 'country']);

// tour
Route::get('tour-category-list', [TourController::class, 'tourCategory']);
Route::get('tour-list', [TourController::class, 'tourList']);
Route::get('tour-by-slug/{slug}', [TourController::class, 'tourBySlug']);

//coupon
Route::post('apply-coupon', [CouponController::class, 'applyCoupon']);

// contact us message

Route::post('save-contact-us', [ContactUsMessageController::class, 'store']);

// gallery
Route::get('gallery-list', [GalleryController::class, 'index']);

Route::group(['middleware' => ['auth:api']], function () {

    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('update-profile', [AuthController::class, 'updateProfile']);
    Route::post('change-password', [AuthController::class, 'changePassword']);
    Route::post('delete-account', [AuthController::class, 'deleteAccount']);

    // save tour review
    Route::post('save-tour-review', [TourController::class, 'storeReiew']);

    // wishlist
    Route::get('wishlist-list', [WishlistController::class, 'index']);
    Route::post('save-wishlist', [WishlistController::class, 'store']);
    Route::post('delete-wishlist/{id}', [WishlistController::class, 'destroy']);
});
