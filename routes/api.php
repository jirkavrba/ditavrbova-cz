<?php

use App\Http\Controllers\ApiController;
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

Route::get('/categories', [ApiController::class, 'categories'])->name('api.categories');
Route::get('/category/{category}/{page?}', [ApiController::class, 'category'])
    ->where('page', '\d+')
    ->name('api.category');

Route::get('/type/{type}/{page?}', [ApiController::class, 'type'])
    ->where('page', '\d+')
    ->name('api.type');

Route::get('/products/{page?}', [ApiController::class, 'products'])
    ->where('page', '\d+')
    ->name('api.products');

Route::get('/product/{product}', [ApiController::class, 'product'])->name('api.product');

