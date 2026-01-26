<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured/new products server-side
        $featuredProducts = Product::with(['category','media','colors.sizes', 'colors.media'])->where('is_active', true)
            ->where('is_featured', true)        
            ->limit(8)
            ->get();
        
        // $newProducts = Product::where('is_active', true)
        //     ->latest()
        //     ->with(['category', 'media'])
        //     ->limit(8)
        //     ->get();
        
        // // Get main categories
        // $mainCategories = Category::whereNull('parent_id')
        //     ->with('children')
        //     ->get();
        
        // return view('home', compact('featuredProducts', 'newProducts', 'mainCategories'));
        return view('home', compact('featuredProducts'));
    }
}
