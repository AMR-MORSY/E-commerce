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


    public function mount()
    {
        $this->returnCartItemsCount();
    }

    #[On('cart-updated')]

    public function cartUpdated()
    {
        $this->returnCartItemsCount();
    }

    public function returnCartItemsCount(): int
    {
        if (Auth::check()) {
            $user = Auth::user();
            $userCart = Cart::where('user_id', $user->id)->first();
            if ($userCart) {
                $cartItems = $userCart->items();
                return $this->cartItemsCount = $cartItems->count();
            }
        }

        $cartToken = Cookie::get('cart_token');

        if ($cartToken) {
            // Find guest cart by token
            $guestCart = Cart::where('cart_token', $cartToken)
                ->whereNull('user_id')
                ->first();
            if ($guestCart)
                $cartItems = $guestCart->items();
            return   $this->cartItemsCount = $cartItems->count();
        }

        return $this->cartItemsCount;
    }
    public function render()
    {

        return view('livewire.cart-icon');
    }
}
