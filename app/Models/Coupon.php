<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'minimum_order',
        'usage_limit',
        'usage_count',
        'starts_at',
        'expires_at',
        'is_active',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'minimum_order' => 'decimal:2',
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

     /**
     * Check if coupon is valid
     */
    public function isValid(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        $now = now();

        if ($this->starts_at && $now->lt($this->starts_at)) {
            return false;
        }

        if ($this->expires_at && $now->gt($this->expires_at)) {
            return false;
        }

        if ($this->usage_limit && $this->usage_count >= $this->usage_limit) {
            return false;
        }

        return true;
    }

     /**
     * Check if coupon can be applied to order
     */
    public function canApplyToOrder(float $orderTotal): bool
    {
        if (!$this->isValid()) {
            return false;
        }

        if ($this->minimum_order && $orderTotal < $this->minimum_order) {
            return false;
        }

        return true;
    }

    /**
     * Calculate discount amount
     */
    public function calculateDiscount(float $amount): float
    {
        if ($this->type === 'percentage') {
            return ($amount * $this->value) / 100;
        }

        if ($this->type === 'fixed') {
            return min($this->value, $amount);
        }

        return 0;
    }

    /**
     * Increment usage count
     */
    public function incrementUsage(): void
    {
        $this->increment('usage_count');
    }
}
