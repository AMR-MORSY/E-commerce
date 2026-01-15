<?php

namespace App\Services;

use App\Models\Cart;
use Spatie\Image\Size;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\ProductSize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;


class CartService
{
    /**
     * Get or create cart for current user/session
     */
    public function getCart(): Cart
    {
        if (Auth::check()) {
            // Logged in user
            $cart = Cart::where('user_id', Auth::id())->first();

            if (!$cart) {
                // Check if guest cart exists with cookie token
                $cartToken = Cookie::get('cart_token');

                if ($cartToken) {
                    $guestCart = Cart::where('cart_token', $cartToken)
                        ->whereNull('user_id')
                        ->first();

                    if ($guestCart) {
                        // Convert guest cart to user cart
                        $guestCart->update([
                            'user_id' => Auth::id(),
                           
                        ]);
                        return $guestCart;
                    }
                }

                // Create new user cart
                $cart = Cart::create([
                    'user_id' => Auth::id(),
                ]);
            }

            return $cart;
        }

        // Guest cart based on cookie token
        $cartToken = Cookie::get('cart_token');

        if ($cartToken) {
            $cart = Cart::where('cart_token', $cartToken)
                ->whereNull('user_id')
                ->first();

            if ($cart) {
                return $cart;
            }
        }

        // Create new guest cart with token
        $newToken = Cart::generateCartToken();

        $cart = Cart::create([
            
            'cart_token' => $newToken,
        ]);

        // Store token in cookie (90 days)
        Cookie::queue('cart_token', $newToken, 60 * 24 * 90);

        return $cart;
    }


    /**
     * Merge guest cart into user cart after login
     * This should be called from a login event listener
     */
    public function mergeGuestCartOnLogin(int $userId): void
    {
        $cartToken = Cookie::get('cart_token');

        if (!$cartToken) {
            return;
        }

        // Find guest cart by token
        $guestCart = Cart::where('cart_token', $cartToken)
            ->whereNull('user_id')
            ->first();

        if (!$guestCart) {
            return;
        }

        // Find user cart
        $userCart = Cart::where('user_id', $userId)->first();

        // If no user cart, convert guest cart
        if (!$userCart) {
            $guestCart->update([
                'user_id' => $userId,
                'session_id' => null,
            ]);

            // Clear the guest cart token
            Cookie::queue(Cookie::forget('cart_token'));
            return;
        }

        // Merge items
        foreach ($guestCart->items as $item) {
            $existingItem = $userCart->items()
                ->where('product_id', $item->product_id)
                ->where('product_color_id', $item->product_color_id)
                ->where('product_size_id', $item->product_size_id)
                ->first();

            if ($existingItem) {
                $existingItem->increment('quantity', $item->quantity);
            } else {
                $item->update(['cart_id' => $userCart->id]);
            }
        }

        $guestCart->delete();

        // Clear the guest cart token
        Cookie::queue(Cookie::forget('cart_token'));
    }


    /**
     * Add item to cart
     */
    public function addItem(
        Product $product,
        int $colorId,
        int $sizeId,
        int $quantity = 1
    ): CartItem {
        $cart = $this->getCart();
        // Check if item already exists
        $existingItem = $cart->items()
            ->where('product_id', $product->id)
            ->where('product_color_id', $colorId)
            ->where('product_size_id', $sizeId)
            ->first();

        if ($existingItem) {
            $existingItem->increment('quantity', $quantity);
            return $existingItem->fresh();
        }
        // Create new cart item
        $sizeAdjustmentPrice = ProductSize::find($sizeId)->price_adjustment;
        return $cart->items()->create([
            'product_id' => $product->id,
            'product_color_id' => $colorId,
            'product_size_id' => $sizeId,
            'quantity' => $quantity,
            'price' => $product->getFinalPrice($sizeAdjustmentPrice),
        ]);
    }

    /**
     * Update cart item quantity
     */
    public function updateQuantity(int $cartItemId, int $quantity): void
    {
        $cart = $this->getCart();
        $item = $cart->items()->findOrFail($cartItemId);

        if ($quantity <= 0) {
            $item->delete();
            return;
        }

        $item->update(['quantity' => $quantity]);
    }

    /**
     * Remove item from cart
     */
    public function removeItem(int $cartItemId): void
    {
        $cart = $this->getCart();
        $cart->items()->where('id', $cartItemId)->delete();
    }

    /**
     * Clear entire cart
     */
    public function clearCart(): void
    {
        $cart = $this->getCart();
        $cart->items()->delete();
    }


    /**
     * Get cart summary
     */
    public function getSummary(): array
    {
        $cart = $this->getCart();

        return [
            'items' => $cart->items()->with(['product', 'productColor', 'productSize'])->get(),
            'subtotal' => $cart->getSubtotal(),
            'discount' => $cart->getTotalDiscount(),
            'shipping' => $cart->getShippingCost(),
            'total' => $cart->getTotal(),
            'items_count' => $cart->getTotalItems(),
            'has_free_shipping' => $cart->hasFreeShippingProduct(),
        ];
    }
}
