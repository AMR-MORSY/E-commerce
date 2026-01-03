<?php

namespace App\Livewire;

use App\Models\CartItem;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class ShoppingCart extends Component
{
    public function removeItem($cartItemId)
    {
        if (!auth()->check()) {
            session()->forget('cart.' . $cartItemId);
            session()->flash('message', 'Item removed from cart!');
            $this->dispatch('cart-updated');
            return;
        }
        CartItem::where('id', $cartItemId)
            ->where('user_id', auth()->id())
            ->delete();

        session()->flash('message', 'Item removed from cart!');
        $this->dispatch('cart-updated');
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

    public function getTotalProperty()
    {
       
        if (!auth()->check()) {
            $cartItems = collect(session()->get('cart', []));

            return $cartItems->sum(function ($item) {
                return $item['quantity'] * $item['product']['price'];
            });
        }

        /** @var \App\Models\User $user */
        $user = auth()->user();
        return $user->cartItems()
            ->with('product')
            ->get()
            ->sum(function ($item) {
                return $item->quantity * $item->product->price;
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
