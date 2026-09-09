<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PromoController;
use Illuminate\Support\Facades\Route;

// Public Pages
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication & Quick Demo Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/quick-login/{role}', [AuthController::class, 'quickLogin'])->name('quick-login');

// Menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{slug}', [MenuController::class, 'show'])->name('menu.show');
Route::get('/api/product/{id}', [MenuController::class, 'apiDetail'])->name('api.product.detail');

// Outlets
Route::get('/outlets', [OutletController::class, 'index'])->name('outlets.index');

// Promos & Vouchers
Route::get('/promo', [PromoController::class, 'index'])->name('promo.index');
Route::post('/api/promo/validate', [PromoController::class, 'validateCode'])->name('api.promo.validate');

// Cart API (Session-based)
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'getCart'])->name('get');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::post('/update-quantity', [CartController::class, 'updateQuantity'])->name('update-quantity');
    Route::post('/remove', [CartController::class, 'remove'])->name('remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('clear');
    Route::post('/apply-voucher', [CartController::class, 'applyVoucher'])->name('apply-voucher');
    Route::post('/remove-voucher', [CartController::class, 'removeVoucher'])->name('remove-voucher');
});

// Checkout & Order
Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('order.place');
Route::get('/order-success/{order_number}', [OrderController::class, 'success'])->name('order.success');
Route::get('/track-order/{order_number?}', [OrderController::class, 'track'])->name('order.track');

// Static Pages & Inquiries
Route::get('/tentang-kami', [PageController::class, 'about'])->name('about');
Route::get('/kemitraan', [PageController::class, 'kemitraan'])->name('kemitraan');
Route::post('/kemitraan', [PageController::class, 'submitKemitraan'])->name('kemitraan.submit');
Route::get('/karir', [PageController::class, 'karir'])->name('karir');
Route::post('/karir', [PageController::class, 'submitKarir'])->name('karir.submit');

// KASIR & BARISTA PORTAL (Protected for Cashier & Admin)
Route::middleware(['role:kasir,admin'])->prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/', [KasirController::class, 'pos'])->name('pos');
    Route::post('/order', [KasirController::class, 'storePosOrder'])->name('order.store');

    Route::get('/recap', [KasirController::class, 'recap'])->name('recap');
});

// DUITKU PAYMENT CALLBACK (Public POST without CSRF)
Route::post('/api/payment/duitku-callback', [KasirController::class, 'duitkuCallback'])
    ->name('api.duitku.callback')
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

// ADMIN MANAGEMENT PORTAL (Protected for Admin)
Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('products.create');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::get('/products/{product}/edit', [AdminController::class, 'editProduct'])->name('products.edit');
    Route::put('/products/{product}', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{product}', [AdminController::class, 'destroyProduct'])->name('products.destroy');

    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::patch('/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.update-status');

    Route::get('/outlets', [AdminController::class, 'outlets'])->name('outlets');
    Route::patch('/outlets/{outlet}/status', [AdminController::class, 'toggleOutletStatus'])->name('outlets.toggle-status');
});
