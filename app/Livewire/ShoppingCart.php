<?php

namespace App\Livewire;

use Spatie\Image\Size;
use App\Models\Product;
use Livewire\Component;
use App\Models\CartItem;
use App\Models\ProductSize;
use Livewire\Attributes\On;
use App\Services\CartService;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class ShoppingCart extends Component
{
    public $isDrawer = false;
    public $cartItems;

    public function mount($isDrawer = false)
    {
        $this->isDrawer = $isDrawer;
        $this->loadCart();
    }

    public function loadCart()
    {
        // Your existing cart loading logic
        $cartService = app(CartService::class);
        $cart=$cartService->getCart();
        $this->cartItems=$cart->items()->get();
      
    }
    
    public function removeItem($cartItemId)
    {
        
        CartItem::where('id', $cartItemId)
            ->delete();

        session()->flash('message', 'Item removed from cart!');
        return redirect()->route('cart');
    }

   
    public function updateQuantity($cartItemId, $quantity)
    {

        if ($quantity < 1) {
            return;
        }

       

        CartItem::where('id', $cartItemId)
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

    public function getTotalProperty(CartService $cartService)
    {

      
        $cart=$cartService->getCart();
        return $cart->Items()
            ->with('product')
            ->get()
            ->sum(function ($item) {
                return $item->quantity * $this->getProductFinalPrice($item->product->id,$item->product_size_id) ;
            });
    }

    #[On ('cart-updated')]

    public function cartUpdated()
    {
        $cartService = app(CartService::class);
        $cart=$cartService->getCart();
        $this->cartItems=$cart->items()->get();

    }

    public function render()
    {
       
        // $cartService = app(CartService::class);
        // $cart=$cartService->getCart();
        // $cartItems=$cart->items()->get();

        return view('livewire.shopping-cart');
    }
}
