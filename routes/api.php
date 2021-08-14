<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Api_OrderItemController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('orderitems')->group(function () {
    // http://127.0.0.1:8000/api/orderitems/1                   => Insert
    // http://127.0.0.1:8000/api/orderitems/1/delete/23         => Delete
    // http://127.0.0.1:8000/api/orderitems/search/{nama}       => search
    // http://127.0.0.1:8000/api/orderitems/update/1            => Update

    Route::get('/{user}', [Api_OrderItemController::class, 'index']);
    Route::post('/{order}', [Api_OrderItemController::class, 'store']);
    Route::patch('/update/{id}', [Api_OrderItemController::class, 'update']);
    Route::delete('/{order_id}/delete/{id}', [Api_OrderItemController::class, 'destroy']);
    Route::get('/search/{nama}', [Api_OrderItemController::class, 'search']);
});
