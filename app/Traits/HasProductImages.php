<?php

namespace App\Traits;

trait HasProductImages
{
    /**
     * Get main product image URL by conversion
     * 
     * @param string $conversion 'thumb'|'medium'|'large'|'zoom'
     * @return string
     */
    public function getMainImageUrl(string $conversion = 'medium'): string
    {
        if (!$this->hasMedia('main_image')) {
            return asset('images/product-placeholder.jpg');
        }

        return $this->getFirstMediaUrl('main_image', $conversion);
    }

    /**
     * Get color image URL by conversion
     * 
     * @param string $conversion 'thumb'|'medium'|'large'|'zoom'
     * @return string
     */
    public function getColorImageUrl(string $conversion = 'medium'): string
    {
        if (!$this->hasMedia('color_images')) {
            return asset('images/color-placeholder.jpg');
        }

        return $this->getFirstMediaUrl('color_images', $conversion);
    }

    /**
     * Get all color images
     * 
     * @param string $conversion 'thumb'|'medium'|'large'|'zoom'
     * @return array
     */
    public function getColorImagesUrls(string $conversion = 'medium'): array
    {
        return $this->getMedia('color_images')
            ->map(fn($media) => $media->getUrl($conversion))
            ->toArray();
    }
}