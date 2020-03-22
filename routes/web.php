<?php

use App\Http\Controllers\AdditionalProductImageController;
use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ApplicationController::class, 'index'])->name('application');

Route::group([
        'middleware' => [
            RedirectIfAuthenticated::class,
            ThrottleRequests::class
        ],
        'prefix' => '/administrace'
    ], function () {
    Route::get('/login', [AuthenticationController::class, 'gate'])->name('authentication.gate');
    Route::post('/login', [AuthenticationController::class, 'login'])->name('authentication.login');
});

Route::group(['middleware' => Authenticate::class, 'prefix' => '/administrace'], function () {
    Route::get('/', [AdministrationController::class, 'index'])->name('administration.index');

    Route::resource('types', ProductTypeController::class)->except('show');
    Route::resource('categories', ProductCategoryController::class)->except('show');
    Route::resource('images', ProductImageController::class)->only('index', 'create', 'store', 'destroy');
    Route::resource('products', ProductController::class);

    Route::get('/products/{product}/additional-images', [AdditionalProductImageController::class, 'create'])->name('additional-images.create');
    Route::post('/products/{product}/additional-images', [AdditionalProductImageController::class, 'store'])->name('additional-images.store');

    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('authentication.logout');
});
