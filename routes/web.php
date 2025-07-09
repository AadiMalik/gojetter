<?php

use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TermAndConditionController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {

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
        Route::get('destroy/{id}', [TermAndConditionController::class,'destroy']);
        Route::get('status/{id}', [TermAndConditionController::class, 'status']);
    });
});
