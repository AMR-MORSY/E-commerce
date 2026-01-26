<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($categoryPath)
    {
        // Find category by full path
        $category = Category::where('full_path', $categoryPath)->firstOrFail();
        
        // Get products in this category and subcategories
        $categoryIds = $this->getCategoryAndDescendantIds($category);
        
        $products = Product::whereIn('category_id', $categoryIds)
            ->with(['category','media','colors.sizes', 'colors.media'])
            ->where('is_active',true)
            ->paginate(24);
        
        return view('categories.show', compact('category', 'products'));
    }
    
    private function getCategoryAndDescendantIds($category)
    {
        $ids = collect([$category->id]);
        
        foreach ($category->children as $child) {
            $ids = $ids->merge($this->getCategoryAndDescendantIds($child));
        }
        
        return $ids;
    }
}
