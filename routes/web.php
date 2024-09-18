<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\CustomerCategoryController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LupaPasswordController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SmartphoneController;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('/', [LoginController::class, 'homePage'])->name('home')->middleware(['auth', 'verified']);
Route::get('/start', [LoginController::class, 'homePage'])->name('customer.home')->middleware(['auth', 'verified']);
Route::get('/home', [App\Http\Controllers\LoginController::class, 'homePage'])->name('home.customer')->middleware(['auth', 'verified']);

// Route untuk customer login
//rute customer
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');

// Route::middleware(['auth', 'customer'])->group(function () {
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rute untuk memproses pendaftaran
Route::get('/register', [DaftarController::class, 'formDaftar'])->name('daftar');
Route::post('/register', [DaftarController::class, 'daftar']);

// Customer Routes
Route::get('/products', [ProductController::class, 'showProductsForCustomer'])->name('products.customer');
Route::get('/products/filter', [ProductController::class, 'filterProducts'])->name('products.filter');
Route::get('/api/phone-details/{slug}', [ProductController::class, 'getPhoneDetails'])->name('products.phone-details');

Route::get('/forgot-password', [LupaPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [LupaPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [LupaPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [LupaPasswordController::class, 'reset'])->name('password.update');

// Route::middleware(['auth'])->group(function () {
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
// });

Route::get('/customer-categories', [CustomerCategoryController::class, 'index'])->name('customer-categories.index');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/get-cities', [CartController::class, 'getCitiesByProvince']);

// });

// Route login admin
//rute admin
Route::get('admin/login', [LoginController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('admin/login', [LoginController::class, 'adminLogin'])->name('admin.login.post');
Route::post('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// Route::middleware(['auth', 'admin'])->group(function () {

Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('/products-admin', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/search', [ProductController::class, 'search'])->name('search');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/top-selling', [HomeController::class, 'topSelling'])->name('top-selling');


Route::get('/admin/couriers', [CourierController::class, 'index'])->name('admin.couriers.index');
Route::put('/admin/couriers/{courier}', [CourierController::class, 'update'])->name('admin.couriers.update');
Route::get('/admin/couriers/sync', [CourierController::class, 'fetchCouriersFromAPI'])->name('admin.couriers.sync');

// Admin melihat pesanan
Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
// Admin konfirmasi pesanan
Route::post('/admin/orders/{order}/confirm', [AdminOrderController::class, 'confirm'])->name('admin.orders.confirm');
Route::get('/admin/orders/{order}/invoice', [AdminOrderController::class, 'generateInvoice'])->name('admin.orders.invoice');
Route::get('/admin/orders/{id}/detail', [AdminOrderController::class, 'show'])->name('orders.adminShow');
Route::patch('/admin/orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.update-status');


// User membuat pesanan
Route::post('/checkout/store', [OrderController::class, 'store'])->name('checkout.store');
Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::post('/shipping-cost', [OrderController::class, 'calculateShipping'])->name('shipping-cost');
Route::patch('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.update-status');





// });

Route::get('products/detail-products/{id}', [ProductController::class, 'detailProductsCustomer'])->name('products.detail');




// Rute untuk menampilkan halaman checkout
// Route::get('/get-cities/{province_id}', [CheckoutController::class, 'getCities'])->name('checkout.getCities');
// Route::post('/checkout/process', [CheckoutController::class, 'processOrder'])->name('checkout.process');
// Route::get('/origin-cities', [CheckoutController::class, 'getOriginCities']);
// Route::post('/ro/cek-ongkir', [\App\Http\Controllers\CheckoutController::class, 'cekOngkir']);

Route::get('/phones', [SmartphoneController::class, 'index']);
Route::get('/phones/brands', [SmartphoneController::class, 'brands']);
Route::get('/phones/brands/{brandSlug}', [SmartphoneController::class, 'brandPhones']);
Route::get('/phones/{slug}', [SmartphoneController::class, 'show']);
Route::get('/phones/search', [SmartphoneController::class, 'search']);






















// Route::get('/order-items', [OrderItemController::class, 'index'])->name('order-items.index');
// Route::get('/order-items/create', [OrderItemController::class, 'create'])->name('order-items.create');
// Route::post('/order-items', [OrderItemController::class, 'store'])->name('order-items.store');
// Route::get('/order-items/{orderItem}', [OrderItemController::class, 'show'])->name('order-items.show');
// Route::get('/order-items/{orderItem}/edit', [OrderItemController::class, 'edit'])->name('order-items.edit');
// Route::put('/order-items/{orderItem}', [OrderItemController::class, 'update'])->name('order-items.update');
// Route::delete('/order-items/{orderItem}', [OrderItemController::class, 'destroy'])->name('order-items.destroy');


// Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
// Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
// Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
// Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');
// Route::get('/payments/{payment}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
// Route::put('/payments/{payment}', [PaymentController::class, 'update'])->name('payments.update');
// Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
