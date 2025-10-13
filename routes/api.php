<?php

use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CommonController;
use App\Http\Controllers\Api\ContactUsMessageController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\CustomerCardController;
use App\Http\Controllers\Api\CustomerRequestController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SettingController;
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

//api home
Route::get('home', [HomeController::class, 'api']);
//web home
Route::get('web', [HomeController::class, 'web']);

// social media
Route::get('social-media-list', [SocialMediaController::class, 'index']);
// common
Route::get('term-and-condition', [CommonController::class, 'termAndCondition']);
Route::get('privacy-policy', [CommonController::class, 'privacyPolicy']);
Route::get('faqs', [CommonController::class, 'faqs']);
Route::get('currency-list', [CommonController::class, 'currency']);
Route::get('country-list', [CommonController::class, 'country']);
Route::get('about-us', [CommonController::class, 'aboutUs']);

// tour
Route::get('tour-category-list', [TourController::class, 'tourCategory']);
Route::get('tour-list', [TourController::class, 'tourList']);
Route::get('tour-by-slug/{slug}', [TourController::class, 'tourBySlug']);

//activity
Route::get('activity-list', [ActivityController::class, 'activityList']);
Route::get('activity-by-slug/{slug}', [ActivityController::class, 'activityBySlug']);

//coupon
Route::post('apply-coupon', [CouponController::class, 'applyCoupon']);

// blogs
Route::get('blog-category-list', [BlogController::class, 'blogCategoryList']);
Route::get('blog-list', [BlogController::class, 'blogList']);
Route::get('blog-by-slug/{slug}', [BlogController::class, 'blogBySlug']);

//service
Route::get('service-list', [ServiceController::class, 'serviceList']);
Route::get('service-by-slug/{slug}', [ServiceController::class, 'serviceBySlug']);

//sub service
Route::get('sub-service-list', [ServiceController::class, 'subServiceList']);
Route::get('sub-service-by-slug/{slug}', [ServiceController::class, 'subServiceBySlug']);

// customer request
Route::post('save-customer-request', [CustomerRequestController::class, 'store']);

// contact us message
Route::post('save-contact-us', [ContactUsMessageController::class, 'store']);

// gallery
Route::get('gallery-list', [GalleryController::class, 'index']);
// testimonial
Route::get('testimonial-list', [TestimonialController::class, 'list']);

Route::get('setting', [SettingController::class, 'index']);

Route::group(['middleware' => ['auth:api']], function () {

    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('update-profile', [AuthController::class, 'updateProfile']);
    Route::post('change-password', [AuthController::class, 'changePassword']);
    Route::post('delete-account', [AuthController::class, 'deleteAccount']);

    // save tour review
    Route::post('save-tour-review', [TourController::class, 'storeReiew']);
    // save activity review
    Route::post('save-activity-review', [ActivityController::class, 'storeReiew']);

    // wishlist
    Route::get('wishlist-list', [WishlistController::class, 'index']);
    Route::post('save-wishlist', [WishlistController::class, 'store']);
    Route::post('delete-wishlist', [WishlistController::class, 'destroy']);

    // cart
    Route::get('cart-list', [CartController::class, 'index']);
    Route::post('save-cart', [CartController::class, 'store']);
    Route::post('delete-cart/{id}', [CartController::class, 'destroy']);

    //booking
    Route::get('booking-list', [BookingController::class, 'index']);
    Route::post('save-booking', [BookingController::class, 'store']);

    //customer card
    Route::get('customer-card-list', [CustomerCardController::class, 'index']);
    Route::post('save-customer-card', [CustomerCardController::class, 'store']);

    //order
    Route::get('order-list', [OrderController::class, 'index']);
    Route::post('save-order', [OrderController::class, 'store']);
    Route::get('order-detail/{id}', [OrderController::class, 'getOrderDetail']);
});
