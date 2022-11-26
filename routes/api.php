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

Route::resource('Suppliers', SupplierController::class)->only(['index' , 'store', 'show']);
Route::resource('MenuItems', MenuItemsController::class)->only(['index' , 'store', 'show']);
Route::resource('SupplierItems', SupplierItemsController::class)->only(['index' , 'store', 'update' , 'show']);
Route::resource('Orders', OrdersController::class)->only(['index' , 'store', 'update' , 'show']);
Route::resource('OrdersEstimatedDates/{id}', OrdersEstimatedDateController::class)->only(['index' , 'store', 'update']);
Route::resource('Orders/{id}/OrdersEstimatedDates', OrdersEstimatedDateController::class)->only(['index' , 'store', 'update']);
