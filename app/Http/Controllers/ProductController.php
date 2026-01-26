<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($categoryPath,Product $product)
    {
        // Verify product belongs to this category path
        if ($product->category->full_path !== $categoryPath) {
            // Redirect to correct URL (handles category changes)
            return redirect()->route('product.show', [
                'categoryPath' => $product->category->full_path,
                'product' => $product->slug
            ], 301);
        }



        $selectedColor = $this->getSelectedColor($product);
        $selectedSize=null;

        if($selectedColor)
        {
            $selectedSize=$selectedColor->sizes()->where('quantity','>','0')->first();

        }

        $currentImages=$this->getCurrentImages($selectedColor,$product);


        
        return view('products.show', compact('product','selectedColor','selectedSize','currentImages'));

    }

    private function getCurrentImages($selectedColor,$product)
    {
        if (!$selectedColor) {
            // Fallback to main product image
            return collect([$product->hasMedia('main_image')
                ? $product->getFirstMedia('main_image')
                : null])->filter();
        }

        // Get all images for selected color
        $images = $selectedColor->getMedia('color_images');

        // If no color images, fallback to main product image
        if ($images->isEmpty() && $product->hasMedia('main_image')) {
            $images = collect([$product->getFirstMedia('main_image')]);
        }

        return $images;
    }

    private function getSelectedColor($product):object|null
    {
        if ($product->hasColorsOnly() || $product->hasColorsAndSizes()) {
            if ($product->colors->isNotEmpty()) {
               return $product->colors->first();
            }
        }
        return null;
    }
}
