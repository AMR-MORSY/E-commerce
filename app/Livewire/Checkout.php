<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Models\CartItem;
use App\Events\OrderPlaced;
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

    public $shipping_name;
    public $shipping_email;
    public $shipping_phone;
    public $shipping_address;
    public $shipping_city;
    public $shipping_state;
    public $shipping_postal_code;
    public $shipping_country = 'EGP';
    public $notes;
    public $coupon;

    public $cartItems;
    public $cart;

    public Order $order;

    public ShippingRule $shippingRule;



    protected $rules = [
        'shipping_name' => 'required|string|max:255',
        'shipping_email' => 'required|email|max:255',
        'shipping_phone' => 'required|string|max:20',
        'shipping_address' => 'required|string|max:500',
        'shipping_city' => 'required|string|max:255',
        'shipping_state' => 'nullable|string|max:255',
        'shipping_postal_code' => 'nullable|string|max:20',
        'shipping_country' => 'required|string|max:255',
        'notes' => 'nullable|string|max:1000',
    ];

    public function mount()
    {
        if (auth()->check()) {
            /** @var \App\Models\User $user */
            $user = auth()->user();
            $this->shipping_name = $user->name;
            $this->shipping_email = $user->email;
            $this->shipping_phone = $user->contact->phone ?? null;
            $this->shipping_address = $user->contact->address ?? null;
            $this->shipping_city = $user->contact->city ?? null;
            $this->shipping_state = $user->contact->province ?? null;
            $this->shipping_country = $user->contact->country ?? 'EGP';
            $this->shipping_postal_code = $use->Contact->postal_code ?? null;
        }
        // Initialize ShippingRule
        $this->shippingRule = ShippingRule::first() ?? new ShippingRule();

        // Initialize Order
        $this->order = new Order();

        $this->loadCart();
    }

    protected function customerData($validated): array
    {
        $user['name'] = $validated['shipping_name'];
        $user['email'] = $validated['shipping_email'];
        $user['phone'] = $validated['shipping_phone'];
        $user['city'] = $validated['shipping_city'];
        $user['country'] = $validated['shipping_country'];
        $user['address'] = $validated['shipping_address'];
        $user['state'] = $validated['shipping_state'];
        $user['postal_code'] = $validated['shipping_postal_code'];


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
            if ($cartItem->quantity > $cartItem->productSize->quantity) {
                session()->flash('error', "Insufficient stock for {$cartItem->product->name} with size {$cartItem->productSize->size}!");
                return back();
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
