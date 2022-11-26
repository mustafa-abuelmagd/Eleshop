<?php

//use App\Http\Controllers\OrdersEstimatedDateController;
use App\Http\Controllers\{SupplierController,
    MenuItemsController,
    SupplierItemsController,
    OrdersController,
    OrdersEstimatedDateController
};
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

Route::resource('Suppliers', SupplierController::class);
Route::resource('MenuItems', MenuItemsController::class);
Route::resource('SupplierItems', SupplierItemsController::class);
Route::resource('Orders', OrdersController::class);
Route::resource('OrdersEstimatedDates/{id}', OrdersEstimatedDateController::class);
Route::resource('Orders/{id}/OrdersEstimatedDates', OrdersEstimatedDateController::class);
