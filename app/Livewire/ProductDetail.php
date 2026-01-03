<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class ProductDetail extends Component
{
    public $product;
    public $quantity = 1;

    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with('category')
            ->firstOrFail();
    }

    public function incrementQuantity()
    {
        if ($this->quantity < $this->product->quantity) {
            $this->quantity++;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if ($this->quantity > $this->product->quantity) {
            session()->flash('error', 'Insufficient stock available!');
            return;
        }
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $cartItem = $user->cartItems()->where('product_id', $this->product->id)->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $this->quantity;
            if ($newQuantity > $this->product->quantity) {
                session()->flash('error', 'Cannot add more items. Stock limit reached!');
                return;
            }
            $cartItem->update(['quantity' => $newQuantity]);
            session()->flash('message', 'Product quantity updated in cart!');
        } else {
            $user->cartItems()->create([
                'product_id' => $this->product->id,
                'quantity' => $this->quantity,
            ]);
            session()->flash('message', 'Product added to cart!');
        }

        $this->dispatch('cart-updated');
    }

    public function render()
    {
        return view('livewire.product-detail');
    }
}
