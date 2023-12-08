<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SalesDetailController;
use App\Http\Controllers\UserController;
use App\Models\SalesDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(["prefix"=> "v1", "middleware"=> ["auth:api"]], function () {
    Route::apiResource('user', UserController::class);
    Route::apiResource('product', ProductController::class);
    Route::apiResource('sale', SaleController::class)->except('show');
    Route::apiResource('sales/detail', SalesDetailController::class);
});

Route::post('login', [UserController::class, 'login']);
