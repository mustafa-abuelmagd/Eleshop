<?php

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::resource('Suppliers', \App\Http\Controllers\SupplierController::class);
Route::resource('MenuItems', \App\Http\Controllers\MenuItemsController::class);
Route::resource('SupplierItems', \App\Http\Controllers\SupplierItemsController::class);
Route::resource('Orders', \App\Http\Controllers\OrdersController::class);
Route::resource('OrdersEstimatedDate/{id}', \App\Http\Controllers\OrdersEstimatedDateController::class);
