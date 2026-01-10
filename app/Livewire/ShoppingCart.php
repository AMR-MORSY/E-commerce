<?php

namespace App\Livewire;

use Spatie\Image\Size;
use App\Models\Product;
use Livewire\Component;
use App\Models\CartItem;
use App\Models\ProductSize;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class ShoppingCart extends Component
{
    // public $total;
    public function removeItem($cartItemId)
    {
        if (!auth()->check()) {
            session()->forget('cart.' . $cartItemId);
            session()->flash('message', 'Item removed from cart!');
            return redirect()->route('cart');

           
        }
        CartItem::where('id', $cartItemId)
            ->where('user_id', auth()->id())
            ->delete();

        session()->flash('message', 'Item removed from cart!');
        return redirect()->route('cart');
    }

    public function updateQuantity($cartItemId, $quantity)
    {

        if ($quantity < 1) {
            return;
        }

        if (!auth()->check()) {
            $cart = session()->get('cart', []);

            if (isset($cart[$cartItemId])) {
                $cart[$cartItemId]['quantity'] = $quantity;
                session()->put('cart', $cart);
                session()->flash('message', 'Cart updated!');
                $this->dispatch('cart-updated');
            }

            return;
        }

        CartItem::where('id', $cartItemId)
            ->where('user_id', auth()->id())
            ->update(['quantity' => $quantity]);

        session()->flash('message', 'Cart updated!');
        $this->dispatch('cart-updated');
    }

    /**
     * get the final price including discounts and size price adjustment
     */
    protected function getProductFinalPrice($productId,$sizeId)
    {
        $product=Product::find($productId);
        $size=ProductSize::find($sizeId);

        return $product->getFinalPrice($size->price_adjustment);///////product model method
        
    }

    public function getTotalProperty()
    {

        if (!auth()->check()) {
            $cartItems = session()->get('cart', []);
          
            return  array_reduce( $cartItems, function($carry, $item) {
                return $carry + ($item['quantity'] * $this->getProductFinalPrice($item['product']['id'],$item['product_size_id']) );
            }, 0);
        }

        /** @var \App\Models\User $user */
        $user = auth()->user();
        return $user->cartItems()
            ->with('product')
            ->get()
            ->sum(function ($item) {
                return $item->quantity * $this->getProductFinalPrice($item->product->id,$item->product_size_id) ;
            });
    }

    public function render()
    {
        if (!auth()->check()) {
            $cartItems = session()->get('cart', []);

            return view('livewire.shopping-cart', [
                'cartItems' => $cartItems,
            ]);
        }
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $cartItems = $user->cartItems()
            ->with('product.category')
            ->get();

        return view('livewire.shopping-cart', [
            'cartItems' => $cartItems,
        ]);
    }
}
