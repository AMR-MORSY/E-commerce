<?php

namespace App\Models;

use App\Models\Coupon;
use App\Models\ProductColor;
use App\Traits\HasProductImages;
use Spatie\MediaLibrary\HasMedia;
use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia, HasProductImages;

    const TYPE_SIMPLE = 'simple';              // Accessories
    const TYPE_VARIABLE_COLOR = 'variable_color';        // Bags
    const TYPE_VARIABLE_COLOR_SIZE = 'variable_color_size'; // Clothing

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'base_price', 
        'sku',
        'simple_quantity',
        'is_active',
        'has_discount',
        'discount_type',
        'discount_value',
        'discount_starts_at',
        'discount_ends_at',
        'free_shipping',
        'is_featured',
        'type'
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'is_active' => 'boolean',
        'has_discount' => 'boolean',
        'discount_value' => 'decimal:2',
        'discount_starts_at' => 'datetime',
        'discount_ends_at' => 'datetime',
        'free_shipping' => 'boolean',
        'is_featured'=>'boolean',
        'simple_quantity' => 'integer',
    ];

     /**
     * Check if product is simple (accessories)
     */
    public function isSimple(): bool
    {
        return $this->type === self::TYPE_SIMPLE;
    }

      /**
     * Check if product has colors only (bags)
     */
    public function hasColorsOnly(): bool
    {
        return $this->type === self::TYPE_VARIABLE_COLOR;
    }

     /**
     * Check if product has colors and sizes (clothing)
     */
    public function hasColorsAndSizes(): bool
    {
        return $this->type === self::TYPE_VARIABLE_COLOR_SIZE;
    }
     /**
     * Get total stock based on product type
     */
    public function getTotalStockAttribute(): int
    {
        if ($this->isSimple()) {
            return $this->simple_quantity ?? 0;
        }

        if ($this->hasColorsOnly()) {
            return $this->colors->sum('quantity');
        }

        if ($this->hasColorsAndSizes()) {
            return $this->colors->sum(function ($color) {
                return $color->sizes->sum('quantity');
            });
        }

        return 0;
    }
   
    // Get full product URL path
    public function getFullUrlPathAttribute()
    {
        return $this->category->full_path . '/' . $this->slug;
    }
  
    public function coupons(): BelongsToMany
    {
        return $this->belongsToMany(Coupon::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'EGP' . number_format($this->base_price, 2);
    }

    // public function getTotalStockAttribute(): int
    // {
    //     return $this->colors->sum(function ($color) {
    //         return $color->sizes->sum('quantity');
    //     });
    // }

    public function colors(): HasMany
    {
        return $this->hasMany(ProductColor::class);
    }


    public function registerMediaCollections(): void
    {
       
            $this->addMediaCollection('main_image')
            ->useDisk('s3')
            ->singleFile()
            ->storeConversionsOnDisk('s3')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
            // ->maxFilesize(5 * 1024 * 1024) // 5MB limit
            ->useFallbackUrl('/images/product-placeholder.jpg') // Fallback for missing images
            ->useFallbackPath(public_path('/images/product-placeholder.jpg'));
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
        ->addMediaConversion('thumb')
        ->width(150)
        ->height(150) // Add height for consistent aspect ratio
        // ->fit('crop', 150, 150) // Better control over cropping
        ->format('webp')
        ->quality(80)
        ->nonQueued(); // Keep this for immediate availability

    $this
        ->addMediaConversion('medium')
        ->width(400)
        ->height(400)
        // ->fit('contain', 400, 400) // Maintains aspect ratio
        ->format('webp')
        ->quality(85) // Slightly higher quality for main product view
        ->performOnCollections('main_image'); // Only run on products collection

    $this
        ->addMediaConversion('large')
        ->width(800)
        ->height(800)
        ->format('webp')
        ->quality(85)
        ->performOnCollections('main_image');

    $this
        ->addMediaConversion('zoom')
        ->width(1200)
        ->height(1200)
        ->format('webp')
        ->quality(95) // Higher quality for zoom
        ->performOnCollections('main_image');
    }


      /**
     * Check if discount is currently active
     */
    public function hasActiveDiscount(): bool
    {
        if (!$this->has_discount || !$this->discount_value) {
            return false;
        }

        $now = now();

        if ($this->discount_starts_at && $now->lt($this->discount_starts_at)) {
            return false;
        }

        if ($this->discount_ends_at && $now->gt($this->discount_ends_at)) {
            return false;
        }

        return true;
    }

    /**
     * get Product Color Size adjustment price
     */

     public function getSizeAdjustmentPrice(int $colorId, int $sizeId):float
     {
         $productColor=$this->colors()->where('id',$colorId)->first();
         $productSize=$productColor->sizes()->where('id',$sizeId)->first();

         return $productSize->price_adjustment;

     }

      /**
     * Get final price after discount
     */
    public function getFinalPrice(float $sizeAdjustment = 0): float
    {
        $price = $this->base_price + $sizeAdjustment;

        if (!$this->hasActiveDiscount()) {
            return $price;
        }

        if ($this->discount_type === 'percentage') {
            return $price - (($price * $this->discount_value) / 100);
        }

        if ($this->discount_type === 'fixed') {
            return max(0, $price - $this->discount_value);
        }

        return $price;
    }

      /**
     * Get discount amount (Saved Money)
     */
    public function getDiscountAmount(float $sizeAdjustment = 0): float
    {
        if (!$this->hasActiveDiscount()) {
            return 0;
        }

        $price = $this->base_price + $sizeAdjustment;
        return $price - $this->getFinalPrice($sizeAdjustment);
    }

      /**
     * Get discount percentage for display
     */
    public function getDiscountPercentage(): int
    {
        if (!$this->hasActiveDiscount()) {
            return 0;
        }

        if ($this->discount_type === 'percentage') {
            return (int) $this->discount_value;
        }

        if ($this->discount_type === 'fixed') {
            return (int) (($this->discount_value / $this->base_price) * 100);
        }

        return 0;
    }

      /**
     * Check if product is in stock
     */
    public function inStock(): bool
    {
        return $this->total_stock > 0;
    }


   



}
