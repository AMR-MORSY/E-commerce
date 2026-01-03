<?php

namespace App\Models;

use App\Models\ProductColor;
use Spatie\MediaLibrary\HasMedia;
use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'base_price',
        // 'compare_price',
        'sku',
        // 'quantity',
        // 'image',
        // 'images',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'compare_price' => 'decimal:2',
        'quantity' => 'integer',
        'images' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

   
   
  

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
        return '$' . number_format($this->price, 2);
    }

    public function getTotalStockAttribute(): int
    {
        return $this->colors->sum(function ($color) {
            return $color->sizes->sum('quantity');
        });
    }

    public function colors(): HasMany
    {
        return $this->hasMany(ProductColor::class);
    }


    public function registerMediaCollections(): void
    {
       
            $this->addMediaCollection('main_image')
            ->useDisk('s3')
            ->storeConversionsOnDisk('s3')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->maxFilesize(5 * 1024 * 1024) // 5MB limit
            ->useFallbackUrl('/images/product-placeholder.jpg') // Fallback for missing images
            ->useFallbackPath(public_path('/images/product-placeholder.jpg'));
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
        ->addMediaConversion('thumb')
        ->width(150)
        ->height(150) // Add height for consistent aspect ratio
        ->fit('crop', 150, 150) // Better control over cropping
        ->format('webp')
        ->quality(80)
        ->nonQueued(); // Keep this for immediate availability

    $this
        ->addMediaConversion('medium')
        ->width(400)
        ->height(400)
        ->fit('contain', 400, 400) // Maintains aspect ratio
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
}
