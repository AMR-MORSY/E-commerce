<?php

namespace App\Support;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
    public function getPath(Media $media): string
    {
        // For main_image collection -> product/{id}/
        // For color_images collection -> product/colors/{id}/
        
        if ($media->collection_name === 'main_image') {
            return "product/{$media->id}/";
        }
        
        if ($media->collection_name === 'color_images') {
            return "product/colors/{$media->id}/";
        }
        
        return "{$media->id}/";
    }

    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media) . 'conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media) . 'responsive/';
    }
}