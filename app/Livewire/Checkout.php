<?php

namespace App\Livewire;

use App\Events\OrderPlaced;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Models\CartItem;
use App\Traits\HasIdempotency;
use Livewire\Attributes\Layout;

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
    public $shipping_country = 'US';
    public $notes;

    protected $rules = [
        'shipping_name' => 'required|string|max:255',
        'shipping_email' => 'required|email|max:255',
        'shipping_phone' => 'nullable|string|max:20',
        'shipping_address' => 'required|string|max:500',
        'shipping_city' => 'required|string|max:255',
        'shipping_state' => 'nullable|string|max:255',
        'shipping_postal_code' => 'required|string|max:20',
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
        }
    }

    public function placeOrder()
    {
        $this->validate();

        // Handle authenticated users
        if (auth()->check()) {


            /** @var \App\Models\User $user */
            $user = auth()->user();

            $cartItems = $user->cartItems()->with('product')->get();

            if ($cartItems->isEmpty()) {
                session()->flash('error', 'Your cart is empty!');
                return;
            }

            // Check stock availability
            foreach ($cartItems as $cartItem) {
                $product = Product::where('id', $cartItem->product->id)->first();

                if (!$product) {
                    session()->flash('error', "Product not found!");
                    return;
                }
                if ($cartItem->quantity > $cartItem->product->quantity) {
                    session()->flash('error', "Insufficient stock for {$cartItem->product->name}!");
                    return;
                }
            }
            $result = $this->withIdempotency('place_order', function () use ($user, $cartItems) {
                $subtotal = $cartItems->sum(function ($item) {
                    return $item->quantity * $item->product->price;
                });

                $tax = $subtotal * 0.10; // 10% tax
                $shipping = 10.00; // Fixed shipping
                $total = $subtotal + $tax + $shipping;

                $order = Order::create([
                    'user_id' => auth()->id(),
                    'subtotal' => $subtotal,
                    'tax' => $tax,
                    'shipping' => $shipping,
                    'total' => $total,
                    'status' => 'pending',
                    'payment_status' => 'pending',
                    'shipping_name' => $this->shipping_name,
                    'shipping_email' => $this->shipping_email,
                    'shipping_phone' => $this->shipping_phone,
                    'shipping_address' => $this->shipping_address,
                    'shipping_city' => $this->shipping_city,
                    'shipping_state' => $this->shipping_state,
                    'shipping_postal_code' => $this->shipping_postal_code,
                    'shipping_country' => $this->shipping_country,
                    'notes' => $this->notes,
                ]);

                foreach ($cartItems as $cartItem) {
                    $order->items()->create([
                        'product_id' => $cartItem->product_id,
                        'product_name' => $cartItem->product->name,
                        'price' => $cartItem->product->price,
                        'quantity' => $cartItem->quantity,
                        'total' => $cartItem->quantity * $cartItem->product->price,
                    ]);

                    // Update product quantity
                    $cartItem->product->decrement('quantity', $cartItem->quantity);
                }

                // Clear cart
                $user->cartItems()->delete();
                event(new OrderPlaced($order,auth()->email));

                return [
                    'success' => true,
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                ];
            });

            $this->resetIdempotencyKey();




            session()->flash('success', 'Order placed successfully!');
            return redirect()->route('order.success', $result['order_id']);
        }




        // Handle unauthenticated users (session cart)

        $sessionCart = session()->get('cart', []);

        if (empty($sessionCart)) {
            session()->flash('error', 'Your cart is empty!');
            return;
        }

        // Reload products from database to ensure we have fresh data
        $productIds = collect($sessionCart)->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        // Check stock availability
        foreach ($sessionCart as $cartItem) {
            $product = $products->get($cartItem['product_id']);

            if (!$product) {
                session()->flash('error', "Product not found!");
                return;
            }

            if ($cartItem['quantity'] > $product->quantity) {
                session()->flash('error', "Insufficient stock for {$product->name}!");
                return;
            }
        }

        $result = $this->withIdempotency('place_order', function () use ($sessionCart, $products) {
            $subtotal = collect($sessionCart)->sum(function ($item) use ($products) {
                $product = $products->get($item['product_id']);
                return $item['quantity'] * $product->price;
            });



            $tax = $subtotal * 0.10; // 10% tax
            $shipping = 10.00; // Fixed shipping
            $total = $subtotal + $tax + $shipping;

            $order = Order::create([
                'user_id' => null,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'shipping' => $shipping,
                'total' => $total,
                'status' => 'pending',
                'payment_status' => 'pending',
                'shipping_name' => $this->shipping_name,
                'shipping_email' => $this->shipping_email,
                'shipping_phone' => $this->shipping_phone,
                'shipping_address' => $this->shipping_address,
                'shipping_city' => $this->shipping_city,
                'shipping_state' => $this->shipping_state,
                'shipping_postal_code' => $this->shipping_postal_code,
                'shipping_country' => $this->shipping_country,
                'notes' => $this->notes,
            ]);

            foreach ($sessionCart as $cartItem) {
                $product = $products->get($cartItem['product_id']);
                $order->items()->create([
                    'product_id' => $cartItem['product_id'],
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $cartItem['quantity'],
                    'total' => $cartItem['quantity'] * $product->price,
                ]);

                // Update product quantity
                $product->decrement('quantity', $cartItem['quantity']);
            }

            // Clear session cart
            session()->forget('cart');
        

            event(new OrderPlaced($order,$this->shipping_email));

         

            return [
                'success' => true,
                'order_id' => $order->id,
                'order_number' => $order->order_number,
            ];
        });







        $this->resetIdempotencyKey();

        session()->flash('success', 'Order placed successfully!');
        return redirect()->route('order.success', $result['order_id']);
    }

    public function getSubtotalProperty()
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

    public function getTaxProperty()
    {
        return $this->subtotal * 0.10;
    }

    public function getShippingProperty()
    {
        return 10.00;
    }

    public function getTotalProperty()
    {
        return $this->subtotal + $this->tax + $this->shipping;
    }

    public function render()
    {
        if (!auth()->check()) {
            $cartItems = session()->get('cart', []);

            return view('livewire.checkout', [
                'cartItems' => $cartItems,
            ]);
        }
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $cartItems = $user->cartItems()
            ->with('product')
            ->get();

        return view('livewire.checkout', [
            'cartItems' => $cartItems,
        ]);
    }
}
