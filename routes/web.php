<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardSettingController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\DashboardTransactionController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [App\Http\Controllers\CategoryController::class, 'detail'])->name('categories-detail');

Route::get('/details/{id}', [App\Http\Controllers\DetailController::class, 'index'])->name('detail');
Route::post('/details/{id}', [App\Http\Controllers\DetailController::class, 'add'])->name('detail-add');

Route::post('/checkout/callback', [App\Http\Controllers\CheckoutController::class, 'callback'])->name('midtrans-callback');

Route::get('/success', [App\Http\Controllers\CartController::class, 'success'])->name('success');

Route::get('/register/success', [App\Http\Controllers\Auth\RegisterController::class, 'success'])->name('register-success');

Route::group(['middleware' => ['auth']], function(){
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
    Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class, 'delete'])->name('cart-delete');
    
    Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/products',
    [DashboardProductController::class, 'index'])->name('dashboard-product');
    Route::get('/dashboard/products/create', [DashboardProductController::class, 'create'])->name('dashboard-product-create');
    Route::post('/dashboard/products}', [DashboardProductController::class, 'store'])->name('dashboard-product-store');
    Route::get('/dashboard/products/{id}', [DashboardProductController::class, 'details'])->name('dashboard-product-details');
    Route::post('/dashboard/products/{id}', [DashboardProductController::class, 'update'])->name('dashboard-product-update');

    Route::post('/dashboard/products/gallery/upload', [DashboardProductController::class, 'uploadGallery'])->name('dashboard-product-gallery-upload');
    Route::get('/dashboard/products/gallery/delete/{id}', [DashboardProductController::class, 'deleteGallery'])->name('dashboard-product-gallery-delete');

    Route::get('/dashboard/transactions', [DashboardTransactionController::class, 'index'])->name('dashboard-transaction');
    Route::get('/dashboard/transactions/{id}', [DashboardTransactionController::class, 'details'])->name('dashboard-transaction-details');
    Route::post('/dashboard/transactions/{id}', [DashboardTransactionController::class, 'update'])->name('dashboard-transaction-update');

    Route::get('/dashboard/settings', [DashboardSettingController::class, 'store'])->name('dashboard-settings-store');
    Route::get('/dashboard/account', [DashboardSettingController::class, 'account'])->name('dashboard-settings-account');
    Route::post('/dashboard/account/{redirect}', [DashboardSettingController::class, 'update'])->name('dashboard-settings-redirect');
});

Route::prefix('admin')
// ->namespace('Admin')
->middleware(['auth', 'admin'])
->group(function() {
Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard-admin');
    Route::resource('category', CategoryController::class);
    Route::resource('user', UserController::class);
    Route::resource('product', ProductController::class);
    Route::resource('product-gallery', ProductGalleryController::class);
});

//Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
//    Route::name('dashboard.')->prefix('dashboard')->group(function () {
//        Route::get('/', [DashboardController::class, 'index'])->name('index');

//        Route::middleware(['admin'])->group(function () {
//            Route::resource('category', ProductCategoryController::class);
//        });
//    });
//});

Auth::routes();

// Route::get('/debug-sentry', function () {
//     throw new Exception('My first Sentry error!');
// });