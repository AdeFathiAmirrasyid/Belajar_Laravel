<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EcommerceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderItemsController;

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


// Route::get('/', function () {
//     return view('home');
// });
// Route::get('/home', function () {
//     return view('home');
// });
// Route::get('/product', function () {
//     return view('product');
// });
// Route::get('/category', function () {
//     return view('category');
// });
// Route::get('/cart', function () {
//     return view('cart');
// });
// Route::get('/checkout', function () {
//     return view('checkout');
// });
// Route::get('/contact', function () {
//     return view('contact');
// });
Auth::routes();
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::view('/', 'admin_template.pages.auth.login');
Route::get(uri: '/', action: [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);


Route::middleware(['auth', 'verified', 'is_admin'])->group(function () {
    Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('/user', [DashboardController::class, 'users']);
        Route::get('/product', [DashboardController::class, 'product']);

        Route::prefix('product')->group(function () {
            Route::get('/insert', [ProductController::class, 'insert']);
            Route::post('', [ProductController::class, 'insertAction']);
            Route::get('/{product}/edit', [ProductController::class, 'edit']);
            Route::patch('/{product}', [ProductController::class, 'update']);
            Route::delete('/{product}', [ProductController::class, 'destroy']);
            Route::get('{search}', [ProductController::class, 'search']);

        });

        Route::prefix('user')->group(function () {
            Route::get('/user', [UserController::class, 'insert']);
            Route::get('/{user}/edit', [UserController::class, 'edit']);
            Route::patch('/{user}', [UserController::class, 'update']);
            Route::post('/', [UserController::class, 'insertAction']);
            Route::delete('/{user}', [UserController::class, 'destroy']);
        });

        Route::prefix('order')->group(function () {
            Route::get('/', [OrderController::class, 'index']);
            Route::get('/insert_order', [OrderController::class, 'insert']);
            Route::post('/', [OrderController::class, 'insertAction']);
            Route::get('/{order}/edit_order', [OrderController::class, 'edit_order']);
            Route::patch('/{id}/edit_order', [OrderController::class, 'update']);
            Route::delete('/{id}', [OrderController::class, 'destroy']);
        });

        Route::prefix('orderitems')->group(function () {
            Route::get('/{user}', [OrderItemsController::class, 'item_orders']);
            Route::post('/{order}', [OrderItemsController::class, 'item_order_action']);
            Route::get('/{id}/edit_orderitems', [OrderItemsController::class, 'edit_orderItems']);
            Route::patch('/{order}', [OrderItemsController::class, 'update_orderItems']);
            Route::delete('/{order_id}', [OrderItemsController::class, 'destroyOrderItems']);
        });
    });
});
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'dashboard']);
    Route::get('/user', [DashboardController::class, 'users']);
    Route::get('/product', [DashboardController::class, 'product']);

    Route::prefix('order')->group(function () {
        Route::get('/', [OrderController::class, 'index']);
    });
    Route::prefix('orderitems')->group(function () {
        Route::get('/{user}', [OrderItemsController::class, 'item_orders']);
        Route::post('/{order}', [OrderItemsController::class, 'item_order_action']);
    });
});

Route::get('/home', [EcommerceController::class, 'home']);
Route::get('/product', [EcommerceController::class, 'product']);
Route::get('/category', [EcommerceController::class, 'category']);
Route::get('/cart', [EcommerceController::class, 'cart']);
Route::get('/checkout', [EcommerceController::class, 'checkout']);
Route::get('/contact', [EcommerceController::class, 'contact']);
