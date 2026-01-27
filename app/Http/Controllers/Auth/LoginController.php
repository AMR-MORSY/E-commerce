<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request, CartService $cartService)
    {
        $validated=$request->validate(['email'=>'required|email|exists:users,email','password'=>'required']);
        if (Auth::attempt($validated, $request->input('remember'))) {
            $request->session()->regenerate();

            $cart = $cartService->getCart();


            // Redirect to the page route where login component is embedded
           return redirect()->intended('/');

           
        }
        return back()->withErrors(['email'=>'Unknown Credentials'])->onlyInput('email');
    }
}
