<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\OffreController;
use App\Http\Controllers\Dashboard\ProductController as DashboardProductController;
use App\Http\Controllers\Dashboard\ServiceController as DashboardServiceController;

use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ServiceOrderController;


use App\Http\Controllers\ServiceOrderController as FrontServiceOrderController;


use App\Http\Controllers\AdminAuthController;
use App\Http\Middleware\AdminAuth;

use App\Http\Controllers\LanguageController;






$hiddenAdminUrl = "0502-admin-house-multi-services";


Route::get("/{$hiddenAdminUrl}", [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post("/{$hiddenAdminUrl}", [AdminAuthController::class, 'login'])->name('admin.login.submit');


Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


Route::middleware([AdminAuth::class])->prefix('dashboard')->name('dashboard.')->group(function () {
    
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::resource('categories', CategoryController::class);
    Route::resource('offres', OffreController::class);
    Route::resource('products', DashboardProductController::class);
    Route::resource('services', DashboardServiceController::class);

    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/pending', [OrderController::class, 'pending'])->name('orders.pending');
    Route::get('orders/validated', [OrderController::class, 'validated'])->name('orders.validated');
    Route::post('orders/{order}/validate', [OrderController::class,'validateOrder'])->name('orders.validate');
    Route::delete('orders/{order}', [OrderController::class,'destroy'])->name('orders.destroy');

    Route::get('service_orders', [ServiceOrderController::class,'index'])->name('service_orders.index');
    Route::get('service_orders/pending', [ServiceOrderController::class,'pending'])->name('service_orders.pending');
    Route::get('service_orders/validated', [ServiceOrderController::class,'validated'])->name('service_orders.validated');
    Route::post('service_orders/{serviceOr}/validate', [ServiceOrderController::class,'validateOrder'])->name('service_orders.validate');
    Route::delete('service_orders/{serviceOr}', [ServiceOrderController::class,'destroy'])->name('service_orders.destroy');
});




Route::get('lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

Route::middleware([\App\Http\Middleware\LocaleMiddleware::class])->group(function() {
    Route::get('/',[AccueilController::class,'index'])->name('accuel');
Route::get('/produits',[ProductController::class,'index'])->name('products.index');
Route::get('/services',[ServiceController::class,'index'])->name('services.index');
Route::get('/produits/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');

// Show contact form
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'show'])->name('contact.show');

// Handle form submission
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');


Route::post('/service/request/{service}', [FrontServiceOrderController::class, 'store'])->name('service.request');
Route::get('/service/request/{service}', [FrontServiceOrderController::class, 'create'])
    ->name('service.request.form');
// Envoi du formulaire (création de la demande)
Route::post('/service/request/{service}', [FrontServiceOrderController::class, 'store'])
    ->name('service.request');




Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

    

// Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/produits/{id}', [CartController::class, 'store'])->name('cart.store');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/clear', function() {
    session()->forget('cart');
    return '🧹 Cart cleared!';
});



Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update/{id}',[CartController::class,'update'])->name('cart.update');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');


Route::match(['get','post'], '/checkout/direct/{product}', [CheckoutController::class, 'direct'])->name('checkout.direct');
});











