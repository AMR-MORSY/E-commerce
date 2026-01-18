<?php

namespace App\Livewire\Auth;

use App\Services\CartService;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class Login extends Component
{

    public $email;
    public $password;
    public $remember;
    public $credentialErrorMessage='';

    protected $rules=[
        'email' => 'required|email',
        'password' => 'required',

    ];

    public function login(Request $request, CartService $cartService)
    {
      

        $this->credentialErrorMessage='';
        $credentials = $this->validate();
    
        if (Auth::attempt($credentials, $this->remember)) {
            $request->session()->regenerate();
    
            $cart=$cartService->getCart();
    
           
    
            return redirect()->intended(route('home'));
        }
        $this->credentialErrorMessage= 'The provided credentials do not match our records.';


    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
