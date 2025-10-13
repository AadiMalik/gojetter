<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\ActivityDateController;
use App\Http\Controllers\Admin\ActivityExclusionController;
use App\Http\Controllers\Admin\ActivityExpectationController;
use App\Http\Controllers\Admin\ActivityImageController;
use App\Http\Controllers\Admin\ActivityInclusionController;
use App\Http\Controllers\Admin\ActivityNotSuitableController;
use App\Http\Controllers\Admin\ActivityPolicyController;
use App\Http\Controllers\Admin\ActivityReviewController;
use App\Http\Controllers\Admin\ActivitySupportController;
use App\Http\Controllers\Admin\ActivityTimeSlotController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ContactUsMessageController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\CustomerRequestController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PolicyController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\SubServiceController;
use App\Http\Controllers\Admin\TermAndConditionController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TourCategoryController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\TourDateController;
use App\Http\Controllers\Admin\TourDownloadController;
use App\Http\Controllers\Admin\TourExclusionController;
use App\Http\Controllers\Admin\TourFaqController;
use App\Http\Controllers\Admin\TourImageController;
use App\Http\Controllers\Admin\TourInclusionController;
use App\Http\Controllers\Admin\TourItineraryController;
use App\Http\Controllers\Admin\TourReviewController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
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
    //tour image
    Route::group(['prefix' => 'tour-image'], function () {
        Route::get('/{id}', [TourImageController::class, 'index']);
        Route::post('data', [TourImageController::class, 'getData'])->name('tour-image.data');
        Route::post('store', [TourImageController::class, 'store']);
        Route::get('destroy/{id}', [TourImageController::class, 'destroy']);
    });
    //tour date
    Route::group(['prefix' => 'tour-date'], function () {
        Route::get('/{id}', [TourDateController::class, 'index']);
        Route::post('data', [TourDateController::class, 'getData'])->name('tour-date.data');
        Route::post('store', [TourDateController::class, 'store']);
        Route::get('destroy/{id}', [TourDateController::class, 'destroy']);
    });
    //tour itinerary
    Route::group(['prefix' => 'tour-itinerary'], function () {
        Route::get('/{id}', [TourItineraryController::class, 'index']);
        Route::post('data', [TourItineraryController::class, 'getData'])->name('tour-itinerary.data');
        Route::post('store', [TourItineraryController::class, 'store']);
        Route::get('destroy/{id}', [TourItineraryController::class, 'destroy']);
    });
    //tour inclusion
    Route::group(['prefix' => 'tour-inclusion'], function () {
        Route::get('/{id}', [TourInclusionController::class, 'index']);
        Route::post('data', [TourInclusionController::class, 'getData'])->name('tour-inclusion.data');
        Route::post('store', [TourInclusionController::class, 'store']);
        Route::get('destroy/{id}', [TourInclusionController::class, 'destroy']);
    });
    //tour exclusion
    Route::group(['prefix' => 'tour-exclusion'], function () {
        Route::get('/{id}', [TourExclusionController::class, 'index']);
        Route::post('data', [TourExclusionController::class, 'getData'])->name('tour-exclusion.data');
        Route::post('store', [TourExclusionController::class, 'store']);
        Route::get('destroy/{id}', [TourExclusionController::class, 'destroy']);
    });
    //tour faq
    Route::group(['prefix' => 'tour-faq'], function () {
        Route::get('/{id}', [TourFaqController::class, 'index']);
        Route::post('data', [TourFaqController::class, 'getData'])->name('tour-faq.data');
        Route::post('store', [TourFaqController::class, 'store']);
        Route::get('destroy/{id}', [TourFaqController::class, 'destroy']);
    });
    //tour download
    Route::group(['prefix' => 'tour-download'], function () {
        Route::get('/{id}', [TourDownloadController::class, 'index']);
        Route::post('data', [TourDownloadController::class, 'getData'])->name('tour-download.data');
        Route::post('store', [TourDownloadController::class, 'store']);
        Route::get('destroy/{id}', [TourDownloadController::class, 'destroy']);
    });

    // Route::group(['prefix' => 'tour-additional'], function () {
    //     Route::get('/{id}', [TourController::class, 'additional']);
    //     Route::post('tour-image', [TourImageController::class, 'getData'])->name('tour-image');
    //     Route::post('tour-image-store', [TourImageController::class, 'store']);
    //     Route::get('tour-image-destroy/{id}', [TourImageController::class, 'destroy']);
    //     // tour dates
    //     Route::post('tour-date-slot', [TourController::class, 'tourDate'])->name('tour-date-slot');
    //     Route::post('tour-date-slot-store', [TourController::class, 'tourDateStore']);
    //     Route::get('tour-date-slot-destroy/{id}', [TourController::class, 'tourDateDestroy']);

    //     // tour itinerary
    //     Route::post('tour-itinerary', [TourController::class, 'tourItinerary'])->name('tour-itinerary');
    //     Route::post('tour-itinerary-store', [TourController::class, 'tourItineraryStore']);
    //     Route::get('tour-itinerary-destroy/{id}', [TourController::class, 'tourItineraryDestroy']);
    // });

    //activities
    Route::group(['prefix' => 'activity'], function () {
        Route::get('/', [ActivityController::class, 'index']);
        Route::post('data', [ActivityController::class, 'getData'])->name('activity.data');
        Route::get('create', [ActivityController::class, 'create']);
        Route::post('store', [ActivityController::class, 'store']);
        Route::get('edit/{id}', [ActivityController::class, 'edit']);
        Route::get('view/{id}', [ActivityController::class, 'view']);
        Route::get('destroy/{id}', [ActivityController::class, 'destroy']);
        Route::get('status/{id}', [ActivityController::class, 'status']);
    });
    //activity image
    Route::group(['prefix' => 'activity-image'], function () {
        Route::get('/{id}', [ActivityImageController::class, 'index']);
        Route::post('data', [ActivityImageController::class, 'getData'])->name('activity-image.data');
        Route::post('store', [ActivityImageController::class, 'store']);
        Route::get('destroy/{id}', [ActivityImageController::class, 'destroy']);
    });
    //activity inclusion
    Route::group(['prefix' => 'activity-inclusion'], function () {
        Route::get('/{id}', [ActivityInclusionController::class, 'index']);
        Route::post('data', [ActivityInclusionController::class, 'getData'])->name('activity-inclusion.data');
        Route::post('store', [ActivityInclusionController::class, 'store']);
        Route::get('destroy/{id}', [ActivityInclusionController::class, 'destroy']);
    });
    //activity exclusion
    Route::group(['prefix' => 'activity-exclusion'], function () {
        Route::get('/{id}', [ActivityExclusionController::class, 'index']);
        Route::post('data', [ActivityExclusionController::class, 'getData'])->name('activity-exclusion.data');
        Route::post('store', [ActivityExclusionController::class, 'store']);
        Route::get('destroy/{id}', [ActivityExclusionController::class, 'destroy']);
    });
    //activity expectation
    Route::group(['prefix' => 'activity-expectation'], function () {
        Route::get('/{id}', [ActivityExpectationController::class, 'index']);
        Route::post('data', [ActivityExpectationController::class, 'getData'])->name('activity-expectation.data');
        Route::post('store', [ActivityExpectationController::class, 'store']);
        Route::get('destroy/{id}', [ActivityExpectationController::class, 'destroy']);
    });
    //activity policy
    Route::group(['prefix' => 'activity-policy'], function () {
        Route::get('/{id}', [ActivityPolicyController::class, 'index']);
        Route::post('data', [ActivityPolicyController::class, 'getData'])->name('activity-policy.data');
        Route::post('store', [ActivityPolicyController::class, 'store']);
        Route::get('destroy/{id}', [ActivityPolicyController::class, 'destroy']);
    });
    //activity support
    Route::group(['prefix' => 'activity-support'], function () {
        Route::get('/{id}', [ActivitySupportController::class, 'index']);
        Route::post('data', [ActivitySupportController::class, 'getData'])->name('activity-support.data');
        Route::post('store', [ActivitySupportController::class, 'store']);
        Route::get('destroy/{id}', [ActivitySupportController::class, 'destroy']);
    });
    //activity date
    Route::group(['prefix' => 'activity-date'], function () {
        Route::get('/{id}', [ActivityDateController::class, 'index']);
        Route::post('data', [ActivityDateController::class, 'getData'])->name('activity-date.data');
        Route::post('store', [ActivityDateController::class, 'store']);
        Route::get('destroy/{id}', [ActivityDateController::class, 'destroy']);
    });
    //activity time slot
    Route::group(['prefix' => 'activity-time-slot'], function () {
        Route::get('/{date_id}', [ActivityTimeSlotController::class, 'index']);
        Route::post('data', [ActivityTimeSlotController::class, 'getData'])->name('activity-time-slot.data');
        Route::post('store', [ActivityTimeSlotController::class, 'store']);
        Route::get('destroy/{id}', [ActivityTimeSlotController::class, 'destroy']);
    });
    //activity review
    Route::group(['prefix' => 'activity-review'], function () {
        Route::get('/', [ActivityReviewController::class, 'index']);
        Route::post('data', [ActivityReviewController::class, 'getData'])->name('activity-review.data');
        Route::get('destroy/{id}', [ActivityReviewController::class, 'destroy']);
        Route::get('status/{id}', [ActivityReviewController::class, 'status']);
    });

    //activity not suitable
    Route::group(['prefix' => 'activity-not-suitable'], function () {
        Route::get('/{id}', [ActivityNotSuitableController::class, 'index']);
        Route::post('data', [ActivityNotSuitableController::class, 'getData'])->name('activity-not-suitable.data');
        Route::post('store', [ActivityNotSuitableController::class, 'store']);
        Route::get('destroy/{id}', [ActivityNotSuitableController::class, 'destroy']);
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

    //testimonial
    Route::group(['prefix' => 'testimonial'], function () {
        Route::get('/', [TestimonialController::class, 'index']);
        Route::post('data', [TestimonialController::class, 'getData'])->name('testimonial.data');
        Route::get('create', [TestimonialController::class, 'create']);
        Route::post('store', [TestimonialController::class, 'store']);
        Route::get('edit/{id}', [TestimonialController::class, 'edit']);
        Route::get('destroy/{id}', [TestimonialController::class, 'destroy']);
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

    //city
    Route::group(['prefix' => 'city'], function () {
        Route::get('/', [CityController::class, 'index']);
        Route::post('data', [CityController::class, 'getData'])->name('city.data');
        Route::get('create', [CityController::class, 'create']);
        Route::post('store', [CityController::class, 'store']);
        Route::get('edit/{id}', [CityController::class, 'edit']);
        Route::post('update', [CityController::class, 'update']);
        Route::get('destroy/{id}', [CityController::class, 'destroy']);
        Route::get('status/{id}', [CityController::class, 'status']);
        Route::get('by-country-id/{country_id}', [CityController::class, 'cityByCountryId']);
        Route::get('/js/city.js', function () {
            $path = resource_path('views/city/js/city.js');
            if (file_exists($path)) {
                return Response::file($path, [
                    'Content-Type' => 'application/javascript',
                ]);
            }
            abort(404);
        });
    });

    //destination
    Route::group(['prefix' => 'destination'], function () {
        Route::get('/', [DestinationController::class, 'index']);
        Route::post('data', [DestinationController::class, 'getData'])->name('destination.data');
        Route::get('create', [DestinationController::class, 'create']);
        Route::post('store', [DestinationController::class, 'store']);
        Route::get('edit/{id}', [DestinationController::class, 'edit']);
        Route::post('update', [DestinationController::class, 'update']);
        Route::get('destroy/{id}', [DestinationController::class, 'destroy']);
        Route::get('status/{id}', [DestinationController::class, 'status']);
        Route::get('/js/destination.js', function () {
            $path = resource_path('views/destination/js/destination.js');
            if (file_exists($path)) {
                return Response::file($path, [
                    'Content-Type' => 'application/javascript',
                ]);
            }
            abort(404);
        });
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

    //order
    Route::group(['prefix' => 'order'], function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::post('data', [OrderController::class, 'getData'])->name('order.data');
        Route::get('view/{id}', [OrderController::class, 'view']);
        Route::get('destroy/{id}', [OrderController::class, 'destroy']);
        Route::post('status', [OrderController::class, 'status']);
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

    //reports
    Route::group(['prefix' => 'reports'], function () {
        //customer report
        Route::get('customer-report', [ReportController::class, 'customerReport']);
        Route::get('get-customer-report', [ReportController::class, 'getCustomerReport']);
        Route::get('get-preview-customert-report', [ReportController::class, 'getPreviewCustomerReport'])->name('report.get-preview-customer-report');
        // booking report
        Route::get('booking-report', [ReportController::class, 'bookingReport']);
        Route::get('get-booking-report', [ReportController::class, 'getBookingReport']);
        Route::get('get-preview-booking-report', [ReportController::class, 'getPreviewBookingReport'])->name('report.get-preview-booking-report');

        // booking detail report
        Route::get('booking-detail-report', [ReportController::class, 'bookingDetailReport']);
        Route::get('get-booking-detail-report', [ReportController::class, 'getBookingDetailReport']);
        Route::get('get-preview-booking-detail-report', [ReportController::class, 'getPreviewBookingDetailReport'])->name('report.get-preview-booking-detail-report');

        // order report
        Route::get('order-report', [ReportController::class, 'orderReport']);
        Route::get('get-order-report', [ReportController::class, 'getOrderReport']);
        Route::get('get-preview-order-report', [ReportController::class, 'getPreviewOrderReport'])->name('report.get-preview-order-report');

        // order detail report
        Route::get('order-detail-report', [ReportController::class, 'orderDetailReport']);
        Route::get('get-order-detail-report', [ReportController::class, 'getOrderDetailReport']);
        Route::get('get-preview-order-detail-report', [ReportController::class, 'getPreviewOrderDetailReport'])->name('report.get-preview-order-detail-report');
    });

    //setting
    Route::group(['prefix' => 'setting'], function () {
        Route::get('/', [SettingController::class, 'create']);
        Route::post('store', [SettingController::class, 'store']);
    });
});
