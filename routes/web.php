<?php

use App\Models\Order;
use App\Models\Product;
use App\Livewire\Checkout;
use Illuminate\Support\Str;
use App\Livewire\Auth\Login;
use Illuminate\Http\Request;
use App\Livewire\ProductList;
use App\Services\CartService;
use App\Livewire\ShoppingCart;
use App\Livewire\AdminProducts;
use App\Livewire\ProductDetail;
use App\Livewire\Admin\ProductForm;
use App\Livewire\Admin\ProductIndex;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\DiscountManager;
use App\Livewire\Auth\Register;
use App\Livewire\UserDashboard;
use App\Livewire\UserOrders;

Route::get('/', ProductList::class)->name('home');
Route::get('/product/{slug}', ProductDetail::class)->name('product.detail');
Route::get('/cart', ShoppingCart::class)->name('cart');
Route::get('/checkout', Checkout::class)->name('checkout');
Route::get('/order/success/{order}', function (Order $order) {
    return view('order-success', compact('order'));
})->name('order.success');

// Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
//     Route::get('/products', AdminProducts::class)->name('products');
// });
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/products', ProductIndex::class)->name('products.index');
    Route::get('/products/create', ProductForm::class)->name('products.create');
    Route::get('/products/{productId}/edit', ProductForm::class)->name('products.edit');
    Route::get('products/discountManager',DiscountManager::class)->name('products.discount.manager');
});

Route::middleware(['auth'])->name('user.')->group(function(){
    Route::get('/my-account', UserDashboard::class)->name('dashboard');
    Route::get('/my-account/orders',UserOrders::class)->name('orders');

});

// Authentication routes
Route::get('/login', Login::class)->middleware('guest')->name('login');

// Route::post('/login', function (Request $request, CartService $cartService)  {

  
//     $credentials = $request->validate([
//         'email' => 'required|email',
//         'password' => 'required',
//     ]);

//     if (Auth::attempt($credentials, $request->boolean('remember'))) {
//         $request->session()->regenerate();

//         $cart=$cartService->getCart();

       

//         return redirect()->intended(route('home'));
//     }
//     session()->flash('credential-error', 'The provided credentials do not match our records.');

//     return back()->withErrors([
//         'email' => 'The provided credentials do not match our records.',
//     ])->onlyInput('email');
// });

Route::post('/logout', function (Request $request) {
   
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout');

Route::get('/register', Register::class)->middleware('guest')->name('register');

Route::post('/register', function (Request $request, CartService $cartService) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = \App\Models\User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
    ]);

    Auth::login($user);

    // // Merge session cart into user cart after registration/login
    // $sessionCart = $request->session()->get('cart', []);

    // if (!empty($sessionCart)) {
    //     foreach ($sessionCart as $item) {
    //         $product = Product::find($item['product_id']);
    //         if (!$product) {
    //             continue;
    //         }

    //         $cartItem = $user->cartItems()
    //             ->where('product_id', $item['product_id'])
    //             ->first();

    //         $quantityToAdd = (int) ($item['quantity'] ?? 1);

    //         if ($cartItem) {
    //             $cartItem->increment('quantity', $quantityToAdd);
    //         } else {
    //             $user->cartItems()->create([
    //                 'product_id' => $item['product_id'],
    //                 'quantity' => $quantityToAdd,
    //             ]);
    //         }
    //     }

    //     $request->session()->forget('cart');
    // }

    $cart=$cartService->getCart();

    return redirect()->route('home');
});

// // routes/web.php (or routes/api.php)
// Route::get('/test-sku', function () {
//     \Log::info('=== TEST SKU GENERATION START ===');
    
//     // Create a test product directly
//     $category = \App\Models\Category::first();
    
//     $product = new \App\Models\Product([
//         'name' => 'Test Product',
//         'description' => 'Test',
//         'slug' => Str::slug('Test Product'),
//         'base_price' => 100,
//         'category_id' => $category->id,
//         'is_active' => true,
//     ]);
    
//     \Log::info('Before save - SKU: ' . ($product->sku ?? 'NULL'));
//     $product->save();
//     \Log::info('After save - SKU: ' . $product->sku);
    
//     return response()->json([
//         'product' => $product->only(['id', 'name', 'sku']),
//         'category' => $category->only(['id', 'name', 'code']),
//     ]);
// });