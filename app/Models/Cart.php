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
}
