<?php

use App\Http\Controllers\Auth\LoginController;
use App\Models\Order;
use App\Models\Product;
use App\Livewire\Checkout;
use Illuminate\Support\Str;
use App\Livewire\Auth\Login;
use App\Livewire\UserOrders;
use Illuminate\Http\Request;
use App\Livewire\ProductList;
use App\Services\CartService;
use App\Livewire\ShoppingCart;
use App\Livewire\AdminProducts;
use App\Livewire\Auth\Register;
use App\Livewire\ProductDetail;
use App\Livewire\UserDashboard;
use App\Livewire\Admin\ProductForm;
use App\Livewire\Admin\CategoryForm;
use App\Livewire\Admin\ProductIndex;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Admin\CategoryIndex;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\DiscountManager;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;


Route::pattern('categoryPath', '^(?!admin|cart|checkout|login|register|logout|my-account|order).*');
Route::get('/', [HomeController::class, 'index'])->name('home');


// Cart and checkout routes - BEFORE wildcards
Route::get('/cart', ShoppingCart::class)->name('cart');
Route::get('/checkout', Checkout::class)->name('checkout');
// Route::get('/order/success/{order}', function (Order $order) {
//     return view('order-success', compact('order'));
// })->name('order.success');

// Authentication routes
Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');
Route::post('/login',[LoginController::class,'login'] )->middleware('guest')->name('submit_login');
Route::get('/register', Register::class)->middleware('guest')->name('register');

// User routes - BEFORE wildcards



Route::middleware(['auth'])->name('user.')->group(function () {
    Route::get('/my-account', UserDashboard::class)->name('account');
    Route::get('/my-account/dashboard', UserDashboard::class)->name('dashboard');
    Route::get('/my-account/orders', UserOrders::class)->name('orders');
});


Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/products', ProductIndex::class)->name('products.index');
    Route::get('/products/create', ProductForm::class)->name('products.create');
    Route::get('/products/{productId}/edit', ProductForm::class)->name('products.edit');
    Route::get('products/discountManager', DiscountManager::class)->name('products.discount.manager');

    // Category routes
    Route::get('/categories', CategoryIndex::class)->name('categories.index');
    Route::get('/categories/create', CategoryForm::class)->name('categories.create');
    Route::get('/categories/{categoryId}/edit', CategoryForm::class)->name('categories.edit');
});




Route::post('/logout', function (Request $request) {

    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout');



Route::get('/item/{categoryPath}/{product:slug}', [ProductController::class, 'show'])
    ->where('categoryPath', '.*') ////////this dot astrict mean the categoryPath could include "/" ex. "bags/baby-bags" will replace the variable categoryPath
    ->name('product.show');


Route::get('/order/success/{order:order_number}', function (Order $order) {
    return view('order-success', compact('order'));
})->name('order.success');

// Category pages - handles nested structure
Route::get('/{categoryPath}', [CategoryController::class, 'show'])
    ->where('categoryPath', '.*')
    ->name('category.show');
