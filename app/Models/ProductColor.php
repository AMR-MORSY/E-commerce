<?php

namespace App\Models;

use App\Models\ProductSize;
use App\Traits\HasProductImages;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductColor extends Model implements HasMedia
{
    use InteractsWithMedia, HasProductImages;

    protected $fillable = [
        'product_id',
        'name',
        'hex_code',
        'quantity', // For bags (variable_color type)
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function sizes(): HasMany
    {
        return $this->hasMany(ProductSize::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('color_images')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->useDisk('s3')
            ->storeConversionsOnDisk('s3')
            // ->maxFilesize(5 * 1024 * 1024) // 5MB limit
            ->useFallbackUrl('/images/color-placeholder.jpg');
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
        ->quality(85); // Slightly higher quality for main product view
     

    $this
        ->addMediaConversion('large')
        ->width(800)
        ->height(800)
        ->format('webp')
        ->quality(85);
       

    $this
        ->addMediaConversion('zoom')
        ->width(1200)
        ->height(1200)
        ->format('webp')
        ->quality(95) ;// Higher quality for zoom
       
    }

    /**
     * Get total quantity based on product type
     */
    public function getTotalQuantityAttribute(): int
    {
        // For bags (variable_color), return color quantity
        if ($this->product->hasColorsOnly()) {
            return $this->quantity ?? 0;
        }

        // For clothing (variable_color_size), sum all sizes
        return $this->sizes->sum('quantity');
    }

    /**
     * Check if color is in stock
     */
    public function inStock(): bool
    {
        return $this->total_quantity > 0;
    }
}
