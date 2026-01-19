<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class Register extends Component
{
    public $email;
    public $first_name;
    public $last_name;
    public $password;
    public $password_confirmation;


    protected function rules()
    {
        return   [
            'first_name' => 'required|string|max:40',
            'last_name' => 'required|string|max:40',
            'email' => 'required|lowercase|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::min(9)->letters()->numbers()->mixedCase()],
           

        ];
    }

    public function register(CartService $cartService)
    {
        $validated = $this->validate();

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
        ]);
    
        Auth::login($user);
    
       
    
        $cart=$cartService->getCart();
    
        return redirect()->back();
    }
    public function render()
    {
        return view('livewire.auth.register');
    }
}
