<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingRule extends Model
{
    protected $fillable = [
        'name',
        'min_order_amount',
        'shipping_cost',
        'is_free',
        'is_active',
        'priority',
    ];

    protected $casts = [
        'min_order_amount' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'is_free' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get applicable shipping rule for order
     */
    public static function getShippingCostForOrder(float $orderTotal, bool $hasFreeShippingProduct = false): float
    {
        if ($hasFreeShippingProduct) {
            return 0;
        }

        $rule = self::where('is_active', true)
            ->where(function ($query) use ($orderTotal) {
                $query->whereNull('min_order_amount')
                    ->orWhere('min_order_amount', '<=', $orderTotal);
            })
            ->orderBy('priority', 'desc')
            ->orderBy('min_order_amount', 'desc')
            ->first();

        if (!$rule) {
            return 0;
        }

        return $rule->is_free ? 0 : $rule->shipping_cost;
    }
}
