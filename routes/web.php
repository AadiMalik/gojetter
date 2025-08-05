<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ContactUsMessageController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\CustomerRequestController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PolicyController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\SubServiceController;
use App\Http\Controllers\Admin\TermAndConditionController;
use App\Http\Controllers\Admin\TourCategoryController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\TourImageController;
use App\Http\Controllers\Admin\TourReviewController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();


Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard/filter', [HomeController::class, 'filterDashboard'])->name('dashboard.filter');

    //permissions
    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/', [PermissionController::class, 'index']);
        Route::post('data', [PermissionController::class, 'getData'])->name('permission.data');
        Route::post('store', [PermissionController::class, 'store']);
        Route::get('edit/{id}', [PermissionController::class, 'edit']);
        Route::get('/js/permission.js', function () {
            $path = resource_path('views/permissions/js/permission.js');
            if (file_exists($path)) {
                return Response::file($path, [
                    'Content-Type' => 'application/javascript',
                ]);
            }
            abort(404);
        });
    });

    //roles
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index']);
        Route::post('data', [RoleController::class, 'getData'])->name('role.data');
        Route::get('create', [RoleController::class, 'create']);
        Route::post('store', [RoleController::class, 'store']);
        Route::get('edit/{id}', [RoleController::class, 'edit']);
        Route::post('update', [RoleController::class, 'update']);
    });

    //users
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('data', [UserController::class, 'getData'])->name('user.data');
        Route::get('create', [UserController::class, 'create']);
        Route::post('store', [UserController::class, 'store']);
        Route::get('edit/{id}', [UserController::class, 'edit']);
        Route::post('update', [UserController::class, 'update']);
        // Route::get('destroy/{id}', [UserController::class,'destroy']);
        Route::get('status/{id}', [UserController::class, 'status']);
    });

    //currency
    Route::group(['prefix' => 'currency'], function () {
        Route::get('/', [CurrencyController::class, 'index']);
        Route::post('data', [CurrencyController::class, 'getData'])->name('currency.data');
        Route::get('create', [CurrencyController::class, 'create']);
        Route::post('store', [CurrencyController::class, 'store']);
        Route::get('edit/{id}', [CurrencyController::class, 'edit']);
        Route::post('update', [CurrencyController::class, 'update']);
        Route::get('destroy/{id}', [CurrencyController::class, 'destroy']);
        Route::get('default/{id}', [CurrencyController::class, 'default']);
        Route::get('/js/currency.js', function () {
            $path = resource_path('views/currency/js/currency.js');
            if (file_exists($path)) {
                return Response::file($path, [
                    'Content-Type' => 'application/javascript',
                ]);
            }
            abort(404);
        });
    });

    //tours
    Route::group(['prefix' => 'tours'], function () {
        Route::get('/', [TourController::class, 'index']);
        Route::post('data', [TourController::class, 'getData'])->name('tour.data');
        Route::get('create', [TourController::class, 'create']);
        Route::post('store', [TourController::class, 'store']);
        Route::get('edit/{id}', [TourController::class, 'edit']);
        Route::get('view/{id}', [TourController::class, 'view']);
        Route::get('destroy/{id}', [TourController::class, 'destroy']);
        Route::get('status/{id}', [TourController::class, 'status']);
    });

    Route::group(['prefix' => 'tour-additional'], function () {
        Route::get('/{id}', [TourController::class, 'additional']);
        Route::post('tour-image', [TourImageController::class, 'getData'])->name('tour-image');
        Route::post('tour-image-store', [TourImageController::class, 'store']);
        Route::get('tour-image-destroy/{id}', [TourImageController::class, 'destroy']);
    });

    //faqs
    Route::group(['prefix' => 'faqs'], function () {
        Route::get('/', [FaqController::class, 'index']);
        Route::post('data', [FaqController::class, 'getData'])->name('faq.data');
        Route::get('create', [FaqController::class, 'create']);
        Route::post('store', [FaqController::class, 'store']);
        Route::get('edit/{id}', [FaqController::class, 'edit']);
        Route::get('destroy/{id}', [FaqController::class, 'destroy']);
        Route::get('status/{id}', [FaqController::class, 'status']);
    });

    //term & condition
    Route::group(['prefix' => 'terms'], function () {
        Route::get('/', [TermAndConditionController::class, 'index']);
        Route::post('data', [TermAndConditionController::class, 'getData'])->name('term.data');
        Route::post('store', [TermAndConditionController::class, 'store']);
        Route::get('edit/{id}', [TermAndConditionController::class, 'edit']);
        Route::post('update', [TermAndConditionController::class, 'update']);
    });

    //policy
    Route::group(['prefix' => 'policy'], function () {
        Route::get('/', [PolicyController::class, 'index']);
        Route::post('data', [PolicyController::class, 'getData'])->name('policy.data');
        Route::post('store', [PolicyController::class, 'store']);
        Route::get('edit/{id}', [PolicyController::class, 'edit']);
        Route::post('update', [PolicyController::class, 'update']);
    });

    //social media
    Route::group(['prefix' => 'social-media'], function () {
        Route::get('/', [SocialMediaController::class, 'index']);
        Route::post('data', [SocialMediaController::class, 'getData'])->name('social-media.data');
        Route::get('create', [SocialMediaController::class, 'create']);
        Route::post('store', [SocialMediaController::class, 'store']);
        Route::get('edit/{id}', [SocialMediaController::class, 'edit']);
        Route::get('view/{id}', [SocialMediaController::class, 'view']);
        Route::get('destroy/{id}', [SocialMediaController::class, 'destroy']);
        Route::get('status/{id}', [SocialMediaController::class, 'status']);
    });

    //about us
    Route::group(['prefix' => 'about-us'], function () {
        Route::get('/', [AboutUsController::class, 'index']);
        Route::post('data', [AboutUsController::class, 'getData'])->name('about-us.data');
        Route::post('store', [AboutUsController::class, 'store']);
        Route::get('edit/{id}', [AboutUsController::class, 'edit']);
        Route::post('update', [AboutUsController::class, 'update']);
    });

    //contact us message
    Route::group(['prefix' => 'contact-us-message'], function () {
        Route::get('/', [ContactUsMessageController::class, 'index']);
        Route::get('show/{id}', [ContactUsMessageController::class, 'show']);
        Route::post('reply', [ContactUsMessageController::class, 'reply']);
        Route::post('mark-read/{id}', [ContactUsMessageController::class, 'markAsRead']);
        Route::get('destroy/{id}', [ContactUsMessageController::class, 'destroy']);
    });

    //tour category
    Route::group(['prefix' => 'tour-category'], function () {
        Route::get('/', [TourCategoryController::class, 'index']);
        Route::post('data', [TourCategoryController::class, 'getData'])->name('tour-category.data');
        Route::get('create', [TourCategoryController::class, 'create']);
        Route::post('store', [TourCategoryController::class, 'store']);
        Route::get('edit/{id}', [TourCategoryController::class, 'edit']);
        Route::get('destroy/{id}', [TourCategoryController::class, 'destroy']);
        Route::get('status/{id}', [TourCategoryController::class, 'status']);
    });

    //country
    Route::group(['prefix' => 'country'], function () {
        Route::get('/', [CountryController::class, 'index']);
        Route::post('data', [CountryController::class, 'getData'])->name('country.data');
        Route::get('create', [CountryController::class, 'create']);
        Route::post('store', [CountryController::class, 'store']);
        Route::get('edit/{id}', [CountryController::class, 'edit']);
        Route::post('update', [CountryController::class, 'update']);
        Route::get('destroy/{id}', [CountryController::class, 'destroy']);
        Route::get('status/{id}', [CountryController::class, 'status']);
        Route::get('/js/country.js', function () {
            $path = resource_path('views/country/js/country.js');
            if (file_exists($path)) {
                return Response::file($path, [
                    'Content-Type' => 'application/javascript',
                ]);
            }
            abort(404);
        });
    });

    //tour image
    Route::group(['prefix' => 'tour-image'], function () {
        Route::get('/{id}', [TourImageController::class, 'index']);
        Route::post('data', [TourImageController::class, 'getData'])->name('tour-image.data');
        Route::post('store', [TourImageController::class, 'store']);
        Route::get('destroy/{id}', [TourImageController::class, 'destroy']);
    });

    //tour review
    Route::group(['prefix' => 'tour-review'], function () {
        Route::get('/', [TourReviewController::class, 'index']);
        Route::post('data', [TourReviewController::class, 'getData'])->name('tour-review.data');
        Route::get('destroy/{id}', [TourReviewController::class, 'destroy']);
        Route::get('status/{id}', [TourReviewController::class, 'status']);
    });

    //tour image
    Route::group(['prefix' => 'gallery'], function () {
        Route::get('/', [GalleryController::class, 'index']);
        Route::post('data', [GalleryController::class, 'getData'])->name('gallery.data');
        Route::post('store', [GalleryController::class, 'store']);
        Route::get('destroy/{id}', [GalleryController::class, 'destroy']);
    });

    //coupon
    Route::group(['prefix' => 'coupon'], function () {
        Route::get('/', [CouponController::class, 'index']);
        Route::post('data', [CouponController::class, 'getData'])->name('coupon.data');
        Route::get('create', [CouponController::class, 'create']);
        Route::post('store', [CouponController::class, 'store']);
        Route::get('edit/{id}', [CouponController::class, 'edit']);
        Route::get('destroy/{id}', [CouponController::class, 'destroy']);
        Route::get('status/{id}', [CouponController::class, 'status']);
    });

    //booking
    Route::group(['prefix' => 'booking'], function () {
        Route::get('/', [BookingController::class, 'index']);
        Route::post('data', [BookingController::class, 'getData'])->name('booking.data');
        Route::get('view/{id}', [BookingController::class, 'view']);
        Route::get('destroy/{id}', [BookingController::class, 'destroy']);
        Route::post('status', [BookingController::class, 'status']);
    });

    //blog category
    Route::group(['prefix' => 'blog-category'], function () {
        Route::get('/', [BlogCategoryController::class, 'index']);
        Route::post('data', [BlogCategoryController::class, 'getData'])->name('blog-category.data');
        Route::get('create', [BlogCategoryController::class, 'create']);
        Route::post('store', [BlogCategoryController::class, 'store']);
        Route::get('edit/{id}', [BlogCategoryController::class, 'edit']);
        Route::post('update', [BlogCategoryController::class, 'update']);
        Route::get('destroy/{id}', [BlogCategoryController::class, 'destroy']);
        Route::get('status/{id}', [BlogCategoryController::class, 'status']);
        Route::get('/js/blog_category.js', function () {
            $path = resource_path('views/blog_category/js/blog_category.js');
            if (file_exists($path)) {
                return Response::file($path, [
                    'Content-Type' => 'application/javascript',
                ]);
            }
            abort(404);
        });
    });

    //blogs
    Route::group(['prefix' => 'blogs'], function () {
        Route::get('/', [BlogController::class, 'index']);
        Route::post('data', [BlogController::class, 'getData'])->name('blogs.data');
        Route::get('create', [BlogController::class, 'create']);
        Route::post('store', [BlogController::class, 'store']);
        Route::get('edit/{id}', [BlogController::class, 'edit']);
        Route::get('view/{id}', [BlogController::class, 'view']);
        Route::get('destroy/{id}', [BlogController::class, 'destroy']);
        Route::get('status/{id}', [BlogController::class, 'status']);
    });

    //service
    Route::group(['prefix' => 'services'], function () {
        Route::get('/', [ServiceController::class, 'index']);
        Route::post('data', [ServiceController::class, 'getData'])->name('services.data');
        Route::get('create', [ServiceController::class, 'create']);
        Route::post('store', [ServiceController::class, 'store']);
        Route::get('edit/{id}', [ServiceController::class, 'edit']);
        Route::get('view/{id}', [ServiceController::class, 'view']);
        Route::get('destroy/{id}', [ServiceController::class, 'destroy']);
        Route::get('status/{id}', [ServiceController::class, 'status']);
    });

    //sub service
    Route::group(['prefix' => 'sub-services'], function () {
        Route::get('/', [SubServiceController::class, 'index']);
        Route::post('data', [SubServiceController::class, 'getData'])->name('sub-services.data');
        Route::get('create', [SubServiceController::class, 'create']);
        Route::post('store', [SubServiceController::class, 'store']);
        Route::get('edit/{id}', [SubServiceController::class, 'edit']);
        Route::get('view/{id}', [SubServiceController::class, 'view']);
        Route::get('destroy/{id}', [SubServiceController::class, 'destroy']);
        Route::get('status/{id}', [SubServiceController::class, 'status']);
    });

    //customer request
    Route::group(['prefix' => 'customer-requests'], function () {
        Route::get('/', [CustomerRequestController::class, 'index']);
        Route::post('data', [CustomerRequestController::class, 'getData'])->name('customer-requests.data');
        Route::get('view/{id}', [CustomerRequestController::class, 'view']);
        Route::get('destroy/{id}', [CustomerRequestController::class, 'destroy']);
    });
});
