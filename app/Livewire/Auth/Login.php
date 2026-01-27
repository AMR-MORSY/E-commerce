<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Login extends Component
{

    public $email;
    public $password;
    public $remember;
    public $credentialErrorMessage = '';

    public $currentPageRoute;
    public $currentPageRouteParams; ////////current page route and parameters if the route has parameters will be used to direct the user to same route after Login 

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',

    ];

    public function login(Request $request, CartService $cartService)
    {


        $this->credentialErrorMessage = '';
        $credentials = $this->validate();

        if (Auth::attempt($credentials, $this->remember)) {
            $request->session()->regenerate();

            $cart = $cartService->getCart();


            // Redirect to the page route where login component is embedded
            if ($this->currentPageRoute) {
                return $this->redirectRoute($this->currentPageRoute,$this->currentPageRouteParams);
            }

            return $this->redirect(route('home'));
        }
        $this->credentialErrorMessage = 'The provided credentials do not match our records.';
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
