<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ContactUsMessageController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PolicyController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\TermAndConditionController;
use App\Http\Controllers\Admin\TourCategoryController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\UserController;
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
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
        Route::get('destroy/{id}', [TourController::class,'destroy']);
        Route::get('status/{id}', [TourController::class, 'status']);
    });

    //faqs
    Route::group(['prefix' => 'faqs'], function () {
        Route::get('/', [FaqController::class, 'index']);
        Route::post('data', [FaqController::class, 'getData'])->name('faq.data');
        Route::get('create', [FaqController::class, 'create']);
        Route::post('store', [FaqController::class, 'store']);
        Route::get('edit/{id}', [FaqController::class, 'edit']);
        Route::get('destroy/{id}', [FaqController::class,'destroy']);
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
        Route::get('destroy/{id}', [SocialMediaController::class,'destroy']);
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
        Route::get('destroy/{id}', [SocialMediaController::class,'destroy']);
    });

    //tour category
    Route::group(['prefix' => 'tour-category'], function () {
        Route::get('/', [TourCategoryController::class, 'index']);
        Route::post('data', [TourCategoryController::class, 'getData'])->name('tour-category.data');
        Route::get('create', [TourCategoryController::class, 'create']);
        Route::post('store', [TourCategoryController::class, 'store']);
        Route::get('edit/{id}', [TourCategoryController::class, 'edit']);
        Route::get('destroy/{id}', [TourCategoryController::class,'destroy']);
        Route::get('status/{id}', [TourCategoryController::class, 'status']);
    });
});
