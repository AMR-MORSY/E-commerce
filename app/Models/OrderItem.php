<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'product_color_id',
        'product_size_id',
        'product_name',
        'product_sku',
        'color_name',
        'size_name',
        'base_price',
        'discount_amount',
        'final_price',
        'quantity',
        'total',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'final_price' => 'decimal:2',
        'quantity' => 'integer',
        'total' => 'decimal:2',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
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
}
