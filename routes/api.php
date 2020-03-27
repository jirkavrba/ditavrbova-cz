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

Route::get('/products', [ApiController::class, 'products'])->name('api.products');
Route::get('/categories', [ApiController::class, 'categories'])->name('api.categories');

Route::get('/product/{product}', [ApiController::class, 'product'])->name('api.product');
Route::get('/category/{category}', [ApiController::class, 'category'])->name('api.category');
Route::get('/type/{type}', [ApiController::class, 'type'])->name('api.type');

