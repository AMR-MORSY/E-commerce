<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductColor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'product_color_id',
        'product_size_id',
        'price'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2'
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function productColor(): BelongsTo
    {
        return $this->belongsTo(ProductColor::class);
    }

    public function productSize(): BelongsTo
    {
        return $this->belongsTo(ProductSize::class);
    }

    /**
     * Get base price (with size adjustment)
     */
    public function getBasePriceAttribute(): float
    {
        return $this->product->base_price + ($this->productSize->price_adjustment ?? 0);
    }

      /**
     * Get final price after discount
     */
    public function getFinalPriceAttribute(): float
    {
        return $this->product->getFinalPrice($this->productSize->price_adjustment ?? 0);
    }

    /**
     * Get discount amount
     */
    public function getDiscountAmountAttribute(): float
    {
        return $this->base_price - $this->final_price;
    }

    
    /**
     * Get line total
     */
    public function getLineTotalAttribute(): float
    {
        return $this->final_price * $this->quantity;
    }
}
