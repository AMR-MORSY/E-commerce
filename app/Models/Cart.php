<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $fillable = ['user_id', 'cart_token',];

  
    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
     /**
     * Generate unique cart token
     */
    public static function generateCartToken(): string
    {
        do {
            $token = bin2hex(random_bytes(32)); // 64 character token
        } while (self::where('cart_token', $token)->exists());

        return $token;
    }

    /**
     * Get total discount
     */
    public function getTotalDiscount(): float
    {
        return $this->Items()
        ->with('product')
        ->get()
        ->sum(function ($item) {
          
            return $item->quantity * $item->discount_amount ;///// already calculated in cartItem model and returned as attribute
        });
       
    }

    /**
     * Check if cart has free shipping product
     */
    public function hasFreeShippingProduct(): bool
    {
        return $this->items->contains(function ($item) {
            return $item->product->free_shipping;
        });
    }

     /**
     * Get cart subtotal
     */
    public function getSubtotal(): float
    {
        return $this->items->sum(function ($item) {
            return $item->final_price * $item->quantity;
        });
    }

}
