<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class CartIcon extends Component
{
    public $cartItemsCount = 0;
    public $subtotal;


    public function mount()
    {
        $this->returnCartItemsCount();
    }

    #[On('cart-updated')]

    public function cartUpdated()
    {
        $this->returnCartItemsCount();
    }

    public function returnCartItemsCount(): void
    {
        $cartToken = Cookie::get('cart_token');
        if (Auth::check()) {
            $user = Auth::user();
            $userCart = Cart::where('user_id', $user->id)->first();
            if ($userCart) {
                $cartItems = $userCart->items();
                $this->subtotal = $cartItems->getSubtotal();
                $this->cartItemsCount = $cartItems->count();
            }
        }
        elseif ($cartToken) {
            // Find guest cart by token
            $guestCart = Cart::where('cart_token', $cartToken)
                ->whereNull('user_id')
                ->first();
            if ($guestCart) {
                $cartItems = $guestCart->items();
                $this->cartItemsCount = $cartItems->count();
                $this->subtotal=$guestCart->getSubtotal();
            }
        }

      return;
    }
    public function render()
    {

        return view('livewire.cart-icon');
    }
}
