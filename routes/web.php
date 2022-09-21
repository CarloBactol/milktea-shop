<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Frontend
Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index']);
Route::get('/view-product/{id}', [App\Http\Controllers\Frontend\FrontendController::class, 'view_product']);
Route::post('/add-to-cart',  [App\Http\Controllers\Frontend\CartController::class, 'addCart']);
Route::post('/delete-cart-item',  [App\Http\Controllers\Frontend\CartController::class, 'delete_cart']);
Route::get('/load-cart-data',  [App\Http\Controllers\Frontend\CartController::class, 'cart_count']);

Route::get('/shop', [App\Http\Controllers\Frontend\FrontendController::class, 'view_all_products']);


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {

    // cart management
    Route::get('/cart', [App\Http\Controllers\Frontend\CartController::class, 'cart']);
    Route::get('/checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index']);
    Route::post('/place-order', [App\Http\Controllers\Frontend\CheckoutController::class, 'place_order']);
    Route::get('/my-order', [App\Http\Controllers\Frontend\UserController::class, 'my_order']);
    Route::get('/view-order/{id}', [App\Http\Controllers\Frontend\UserController::class, 'view_order']);
});


Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('profile', [App\Http\Controllers\Admin\UserProfileController::class, 'profile']);

    // product management
    Route::get('/admin/product-list', [App\Http\Controllers\Admin\ProductController::class, 'index']);
    Route::get('/admin/add-product', [App\Http\Controllers\Admin\ProductController::class, 'show']);
    Route::post('/admin/store-product', [App\Http\Controllers\Admin\ProductController::class, 'store']);
    Route::get('/admin/edit-product/{id}', [App\Http\Controllers\Admin\ProductController::class, 'edit']);
    Route::put('/admin/update-product/{id}', [App\Http\Controllers\Admin\ProductController::class, 'update']);
    Route::get('/admin/delete-product/{id}', [App\Http\Controllers\Admin\ProductController::class, 'destroy']);

    // orders management
    Route::get('/admin/orders-list', [App\Http\Controllers\Admin\OrderController::class, 'index']);
    Route::get('/admin/view-order/{id}', [App\Http\Controllers\Admin\OrderController::class, 'view_order']);
    Route::put('/admin/update-order/{id}', [App\Http\Controllers\Admin\OrderController::class, 'update_order']);
    Route::get('/admin/order-history', [App\Http\Controllers\Admin\OrderController::class, 'order_history']);
    Route::get('/admin/delete-order/{id}', [App\Http\Controllers\Admin\OrderController::class, 'delete_order']);

    // addOns management
    Route::get('/admin/sinker-list', [App\Http\Controllers\Admin\AddOnsController::class, 'index']);
    Route::get('/admin/add-sinker', [App\Http\Controllers\Admin\AddOnsController::class, 'show']);
    Route::post('/admin/store-sinker', [App\Http\Controllers\Admin\AddOnsController::class, 'store']);
    Route::get('/admin/edit-sinker/{id}', [App\Http\Controllers\Admin\AddOnsController::class, 'edit']);
    Route::put('/admin/update-sinker/{id}', [App\Http\Controllers\Admin\AddOnsController::class, 'update']);
    Route::get('/admin/delete-sinker/{id}', [App\Http\Controllers\Admin\AddOnsController::class, 'destroy']);

    // Bottle Size management
    Route::get('/admin/bottle-size', [App\Http\Controllers\Admin\SizeController::class, 'index']);
    Route::get('/admin/add-bottle-size', [App\Http\Controllers\Admin\SizeController::class, 'show']);
    Route::post('/admin/store', [App\Http\Controllers\Admin\SizeController::class, 'store']);
    Route::get('/admin/edit-bottle-size/{id}', [App\Http\Controllers\Admin\SizeController::class, 'edit']);
    Route::put('/admin/update-bottle-size/{id}', [App\Http\Controllers\Admin\SizeController::class, 'update']);
    Route::get('/admin/delete-bottle-size/{id}', [App\Http\Controllers\Admin\SizeController::class, 'destroy']);

    // Shipping Fee
    Route::get('/admin/shipping-fee', [App\Http\Controllers\Admin\ShippingFeeController::class, 'index']);
    Route::get('/admin/add-shipping-fee', [App\Http\Controllers\Admin\ShippingFeeController::class, 'show']);
    Route::post('/admin/store-shipping-fee', [App\Http\Controllers\Admin\ShippingFeeController::class, 'store']);
    Route::get('/admin/edit-shipping-fee/{id}', [App\Http\Controllers\Admin\ShippingFeeController::class, 'edit']);
    Route::put('/admin/update-shipping-fee/{id}', [App\Http\Controllers\Admin\ShippingFeeController::class, 'update']);
    Route::get('/admin/delete-shipping-fee/{id}', [App\Http\Controllers\Admin\ShippingFeeController::class, 'destroy']);
});
