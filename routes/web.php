<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AddOnsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ShippingFeeController;
use App\Http\Controllers\Admin\UserProfileController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\GetIpAddressController;
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

// Frontend
Route::get('/ipaddress', [GetIpAddressController::class, 'index']);
Route::get('/', [FrontendController::class, 'index']);
Route::get('/view-product/{id}', [FrontendController::class, 'view_product']);
Route::post('/add-to-cart',  [CartController::class, 'addCart']);
Route::post('/delete-cart-item',  [CartController::class, 'delete_cart']);
Route::get('/load-cart-data',  [CartController::class, 'cart_count']);

Route::get('/shop', [FrontendController::class, 'view_all_products']);


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {

    // cart management
    Route::get('/cart', [CartController::class, 'cart']);
    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::post('/place-order', [CheckoutController::class, 'place_order']);
    Route::get('/my-order', [UserController::class, 'my_order']);
    Route::get('/view-order/{id}', [UserController::class, 'view_order']);
});


Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/orders-chart', [DashboardController::class, 'orderChart'])->name('admin.orders');

    // Report PDF
    Route::get('/admin/generate-report', [DashboardController::class, 'generatePdf'])->name('admin.pdf');

    // Profile
    Route::get('profile', [UserProfileController::class, 'profile']);

    // product management
    Route::get('/admin/product-list', [ProductController::class, 'index']);
    Route::get('/admin/add-product', [ProductController::class, 'show']);
    Route::post('/admin/store-product', [ProductController::class, 'store']);
    Route::get('/admin/edit-product/{id}', [ProductController::class, 'edit']);
    Route::put('/admin/update-product/{id}', [ProductController::class, 'update']);
    Route::get('/admin/delete-product/{id}', [ProductController::class, 'destroy']);

    // orders management
    Route::get('/admin/orders-list', [OrderController::class, 'index']);
    Route::get('/admin/view-order/{id}', [OrderController::class, 'view_order']);
    Route::put('/admin/update-order/{id}', [OrderController::class, 'update_order']);
    Route::get('/admin/order-history', [OrderController::class, 'order_history']);
    Route::get('/admin/delete-order/{id}', [OrderController::class, 'delete_order']);

    // addOns management
    Route::get('/admin/sinker-list', [AddOnsController::class, 'index']);
    Route::get('/admin/add-sinker', [AddOnsController::class, 'show']);
    Route::post('/admin/store-sinker', [AddOnsController::class, 'store']);
    Route::get('/admin/edit-sinker/{id}', [AddOnsController::class, 'edit']);
    Route::put('/admin/update-sinker/{id}', [AddOnsController::class, 'update']);
    Route::get('/admin/delete-sinker/{id}', [AddOnsController::class, 'destroy']);

    // Bottle Size management
    Route::get('/admin/bottle-size', [SizeController::class, 'index']);
    Route::get('/admin/add-bottle-size', [SizeController::class, 'show']);
    Route::post('/admin/store', [SizeController::class, 'store']);
    Route::get('/admin/edit-bottle-size/{id}', [SizeController::class, 'edit']);
    Route::put('/admin/update-bottle-size/{id}', [SizeController::class, 'update']);
    Route::get('/admin/delete-bottle-size/{id}', [SizeController::class, 'destroy']);

    // Shipping Fee
    Route::get('/admin/shipping-fee', [ShippingFeeController::class, 'index']);
    Route::get('/admin/add-shipping-fee', [ShippingFeeController::class, 'show']);
    Route::post('/admin/store-shipping-fee', [ShippingFeeController::class, 'store']);
    Route::get('/admin/edit-shipping-fee/{id}', [ShippingFeeController::class, 'edit']);
    Route::put('/admin/update-shipping-fee/{id}', [ShippingFeeController::class, 'update']);
    Route::get('/admin/delete-shipping-fee/{id}', [ShippingFeeController::class, 'destroy']);
});
