<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\City;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Models\CartItem;
use App\Events\OrderPlaced;
use App\Models\Governorate;
use App\Models\ShippingRule;
use App\Services\CartService;
use App\Traits\HasIdempotency;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

#[Layout('components.layouts.app')]
class Checkout extends Component
{

    use HasIdempotency;

    public $first_name;
    public $last_name;
    public $customer_email;
    public $customer_phone;
    public $shipping_address;
    public $shipping_city;
    public $shipping_state;
    public $shipping_postal_code;
    public $shipping_country = 'Egypt';
    public $notes;
    public $coupon;

    public $payment_method = 'COD';

    public $cartItems;
    public $cart;

    public $cities;
    public $states;

    public Order $order;

    public ShippingRule $shippingRule;


    protected function rules()
    {
        return
            [
                'first_name' => 'required|string|max:55',
                'last_name' => 'required|string|max:55',
                'customer_email' => 'required|email|max:255',
                'customer_phone' => ['required', "regex:/^01(0|1|2|5)\d{8}$/"],
                'shipping_address' => 'required|string|max:500',
                'shipping_city' => 'required|exists:governorates,id',
                'shipping_state' => 'required|string|max:100|exists:cities,name_ar',
                'shipping_postal_code' => 'nullable|string|max:20',
                'shipping_country' => 'required|string|max:255',
                'notes' => 'nullable|string|max:1000',
                'payment_method' => 'required|in:COD,VISA'
            ];
    }



    public function mount()
    {
        if (auth()->check()) {
            /** @var \App\Models\User $user */
            $user = auth()->user();
            $this->first_name = $user->first_name;
            $this->last_name = $user->last_name;
            $this->customer_email = $user->email;
            $this->customer_phone = $user->contact->phone ?? null;
            $this->shipping_address = $user->contact->address ?? null;
            $this->shipping_city = $user->contact->city ?? null;
            $this->shipping_state = $user->contact->province ?? null;
            $this->shipping_country = $user->contact->country ?? 'Egypt';
            $this->shipping_postal_code = $use->Contact->postal_code ?? null;
        }
        // Initialize ShippingRule
        $this->shippingRule = ShippingRule::first() ?? new ShippingRule();

        // Initialize Order
        $this->order = new Order();

        $this->cities = Governorate::all();

        $this->shipping_city = 1;

        $this->states = City::where('governorate_id', $this->shipping_city)->get();

        $this->shipping_state = $this->states->first()->name_ar;




        $this->loadCart();
    }

    public function updatedShippingCity()
    {
        $this->states = City::where('governorate_id', $this->shipping_city)->get();
    }

    protected function customerData($validated): array
    {
        $user['first_name'] = $validated['first_name'];
        $user['last_name'] = $validated['last_name'];
        $user['email'] = $validated['customer_email'];
        $user['phone'] = $validated['customer_phone'];
        $user['city'] = City::find($validated['shipping_city'])->name_ar;
        $user['country'] = $validated['shipping_country'];
        $user['address'] = $validated['shipping_address'];
        $user['state'] = $validated['shipping_state'];
        $user['postal_code'] = $validated['shipping_postal_code'];
        $user['payment_method'] = $validated['payment_method'];


        return $user;
    }

    public function placeOrder()
    {
        $validated = $this->validate();




        $customerData = $this->customerData($validated);




        if ($this->cartItems->isEmpty()) {
            session()->flash('error', 'Your cart is empty!');
            return;
        }
        // Check stock availability
        foreach ($this->cartItems as $cartItem) {
            $product = Product::where('id', $cartItem->product->id)->first();

            if (!$product) {
                session()->flash('error', "$product->name.is not available any more!");
                return back();
            }
            if ($cartItem->product->isSimple()) {
                if ($cartItem->quantity > $cartItem->product->simple_quantity) {
                    session()->flash('error', "Insufficient stock for {$cartItem->product->name} !");
                    return back();
                }
            }
            if($cartItem->product->hasColorsOnly()||$cartItem->product->hasColorsAndSizes())
            {
                if ($cartItem->quantity > $cartItem->productColor->total_quantity) {
                    session()->flash('error', "Insufficient stock for {$cartItem->product->name} !");
                    return back();
                }

            }
          
        }
        $result = $this->withIdempotency('place_order', function () use ($customerData) {

            $order = $this->order->createFromCart($this->cart, $customerData, $this->coupon);

            return [
                'success' => true,
                'order_id' => $order->id,
                'order_number' => $order->order_number,
            ];
        });

        $this->resetIdempotencyKey();




        session()->flash('success', 'Order placed successfully!');
        return redirect()->route('order.success', $result['order_number']);
    }

    public function getSubtotalProperty()
    {


        return $this->cartItems->sum(function ($item) {
            return $item->quantity * $item->final_price;
        });
    }

    public function getTaxProperty()
    {
        return $this->subtotal * 0.10;
    }

    public function getShippingProperty()
    {

        return   $this->shippingRule::getShippingCostForOrder($this->subtotal, $this->cart->hasFreeShippingProduct());
    }

    public function getTotalProperty()
    {
        return $this->subtotal + $this->shipping;
    }

    public function loadCart()
    {
        // Your existing cart loading logic
        $cartService = app(CartService::class);
        $this->cart = $cartService->getCart();
        $this->cartItems = $this->cart->items()->with('product')->get();
    }

    public function render()
    {


        return view('livewire.checkout');
    }
}
