<?php

namespace App\Models;

use App\Models\Coupon;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use App\Models\ShippingRule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'shipping_city',
        'shipping_state',
        'shipping_country',
        'shipping_postal_code',
        'subtotal',
        'discount_amount',
        'shipping_cost',
        'tax',
        'total',
        'shipping_rule_id',
        'has_free_shipping_product',
        'coupon_id',
        'coupon_code',
        'status',
        'payment_status',
        'payment_method',
        'notes',
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'shipping' => 'decimal:2',
    ];

   /**
     * Generate unique order number
     */
    public static function generateOrderNumber(): string
    {
        do {
            $number = 'ORD-' . strtoupper(uniqid());
        } while (self::where('order_number', $number)->exists());

        return $number;
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shippingRule(): BelongsTo
    {
        return $this->belongsTo(ShippingRule::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

      /**
     * Create order from cart
     */
    public static function createFromCart(Cart $cart, array $customerData, ?Coupon $coupon = null): self
    {
        $subtotal = $cart->getSubtotal();
        $hasFreeShippingProduct = $cart->hasFreeShippingProduct();
        
        // Calculate shipping
        $shippingCost = ShippingRule::getShippingCostForOrder($subtotal, $hasFreeShippingProduct);
        $shippingRule = ShippingRule::where('is_active', true)
            ->where(function ($query) use ($subtotal) {
                $query->whereNull('min_order_amount')
                    ->orWhere('min_order_amount', '<=', $subtotal);
            })
            ->orderBy('priority', 'desc')
            ->first();

        // Calculate discount
        $discountAmount = 0;
        if ($coupon && $coupon->canApplyToOrder($subtotal)) {
            $discountAmount = $coupon->calculateDiscount($subtotal);
            if ($coupon->type === 'free_shipping') {
                $shippingCost = 0;
            }
        }

        // Calculate total
        $total = $subtotal - $discountAmount + $shippingCost;

        // Create order
        $order = self::create([
            'user_id' => $cart->user_id,
            'order_number' => self::generateOrderNumber(),
            'customer_name' => $customerData['name'],
            'customer_email' => $customerData['email'],
            'customer_phone' => $customerData['phone'],
            'shipping_address' => $customerData['address'],
            'shipping_city' => $customerData['city'],
            'shipping_state' => $customerData['state'] ?? null,
            'shipping_country' => $customerData['country'],
            'shipping_postal_code' => $customerData['postal_code'],
            'subtotal' => $subtotal,
            'discount_amount' => $discountAmount,
            'shipping_cost' => $shippingCost,
            'tax' => 0,
            'total' => $total,
            'shipping_rule_id' => $shippingRule?->id,
            'has_free_shipping_product' => $hasFreeShippingProduct,
            'coupon_id' => $coupon?->id,
            'coupon_code' => $coupon?->code,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        // Create order items from cart
        foreach ($cart->items as $cartItem) {
            $order->items()->create([
                'product_id' => $cartItem->product_id,
                'product_color_id' => $cartItem->product_color_id,
                'product_size_id' => $cartItem->product_size_id,
                'product_name' => $cartItem->product->name,
                'product_sku' => $cartItem->product->sku,
                'color_name' => $cartItem->productColor->name,
                'size_name' => $cartItem->productSize->size,
                'base_price' => $cartItem->base_price,
                'discount_amount' => $cartItem->discount_amount,
                'final_price' => $cartItem->final_price,
                'quantity' => $cartItem->quantity,
                'total' => $cartItem->line_total,
            ]);

            // Decrement stock
            $cartItem->productSize->decrement('quantity', $cartItem->quantity);
        }

        // Increment coupon usage
        if ($coupon) {
            $coupon->incrementUsage();
        }

        // Clear cart
        $cart->items()->delete();

        return $order;
    }

}
