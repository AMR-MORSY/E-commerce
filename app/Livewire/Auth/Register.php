<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Routing\Route;


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

    public function register(Request $request,CartService $cartService)
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
    
        if($request->isMethod('post'))
        {
            return $this->redirect(route('home'));

        }
        elseif (Route::currentRouteName()) {
            return $this->redirectRoute(Route::currentRouteName(),Route::current()->parameters());
        }

        return $this->redirect(route('home'));
    }
    public function render()
    {
        return view('livewire.auth.register');
    }
}
