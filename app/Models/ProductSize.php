<?php

namespace App\Models;

use App\Models\ProductColor;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $fillable = [
        'product_color_id',
        'size',
        'quantity',
        'price_adjustment',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price_adjustment' => 'decimal:2',
    ];

    public function productColor()
    {
        return $this->belongsTo(ProductColor::class);
    }
}
