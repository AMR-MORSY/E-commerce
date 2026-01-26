<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $categories = [
        //     ['name' => 'Electronics', "code" => 'ELEC', 'description' => 'Latest electronic devices and gadgets'],
        //     ['name' => 'Clothing', "code" => "CLTH", 'description' => 'Fashionable clothing and accessories'],
        //     ['name' => 'Home & Garden', 'code' => 'HOME', 'description' => 'Everything for your home and garden'],
        //     ['name' => 'Sports & Outdoors', "code" => "SPRT", 'description' => 'Sports equipment and outdoor gear'],
        //     ['name' => 'Books', "code" => 'BOOK', 'description' => 'Books and reading materials'],
        //     ['name' => 'Toys & Games', "code" => "TOY", 'description' => 'Fun toys and games for all ages'],
        // ];

        // foreach ($categories as $category) {
        //     Category::create([
        //         'name' => $category['name'],
        //         'slug' => Str::slug($category['name']),
        //         'description' => $category['description'],
        //         "code" => $category['code'],
        //         'is_active' => true,
        //     ]);
        // }

        // Men's Clothing
        $mensClothing = Category::create([
            'name' => "Men's Clothing",
            // 'slug' => 'mens-clothing',
            'parent_id' => null,
            // 'code'=>'MCLTH'
        ]);

        Category::create([
            'name' => "Men's T-Shirts",
            // 'slug' => 'mens-tshirts',
            'parent_id' => $mensClothing->id,
            // 'code'=>'MTSHR'
        ]);

        $mensTshirts = Category::where('slug', 'mens-tshirts')
            ->where('parent_id', $mensClothing->id)
            ->first();

        Category::create([
            'name' => "Men'sShort Sleeve T-Shirts",
            // 'slug' => 'mens-short-sleeve-tshirts',
            'parent_id' => $mensTshirts->id,
            // 'code'=>'MSHSTSH',
        ]);

        Category::create([
            'name' => "Men's Long Sleeve T-Shirts",
            // 'slug' => 'mens-long-sleeve-tshirts',
            'parent_id' => $mensTshirts->id,
            // 'code'=>'MLSTSHR'
        ]);

        Category::create([
            'name' => "Men'sV-Neck T-Shirts",
            // 'slug' => 'mens-v-neck-tshirts',
            'parent_id' => $mensTshirts->id,
            // 'code'=>'VNTSH'
        ]);

        Category::create([
            'name' => "Men's Shirts",
            // 'slug' => 'mens-shirts',
            'parent_id' => $mensClothing->id,
            // 'code'=>'SHRT'
        ]);

        $mensShirts = Category::where('slug', 'mens-shirts')
            ->where('parent_id', $mensClothing->id)
            ->first();

        Category::create([
            'name' => "Men'sDress Shirts",
            // 'slug' => 'mens-dress-shirts',
            'parent_id' => $mensShirts->id,
            // 'code'=>'DRSH'
        ]);

        Category::create([
            'name' => 'Casual Shirts',
            // 'slug' => 'casual-shirts',
            'parent_id' => $mensShirts->id,
            // 'code'=>'CASH'
        ]);

        Category::create([
            'name' => "Men's Pants",
            // 'slug' => 'mens-pants',
            'parent_id' => $mensClothing->id,
            // 'code'=>'MPAN'
        ]);

        $mensPants = Category::where('slug', 'mens-pants')
            ->where('parent_id', $mensClothing->id)
            ->first();

        Category::create([
            'name' => "Men's Jeans",
            // 'slug' => 'mens-jeans',
            'parent_id' => $mensPants->id,
            // 'code'=>'JEN'
        ]);

        Category::create([
            'name' => "Men's Chinos",
            // 'slug' => 'mens-chinos',
            'parent_id' => $mensPants->id,
            // 'code'=>'CHI'
        ]);

        Category::create([
            'name' => "Men's Cargo Pants",
            // 'slug' => 'mens-cargo-pants',
            'parent_id' => $mensPants->id,
            // 'code'=>'CARP'
        ]);

        // Women's Clothing
        $womensClothing = Category::create([
            'name' => "Women's Clothing",
            // 'slug' => 'womens-clothing',
            'parent_id' => null,
            // 'code'=>'WCLTH'
        ]);

        Category::create([
            'name' => "Women's T-Shirts",
            // 'slug' => 'women-tshirts',
            'parent_id' => $womensClothing->id,
            //  'code'=>'WTSHR'
        ]);

        $womensTshirts = Category::where('slug', 'women-tshirts')
            ->where('parent_id', $womensClothing->id)
            ->first();

        Category::create([
            'name' => "Women's Short Sleeve T-Shirts",
            // 'slug' => '"women-short-sleeve-tshirts',
            'parent_id' => $womensTshirts->id,
            // 'code'=>'WSHSTSH'
        ]);

        Category::create([
            'name' =>  "Women's Long Sleeve T-Shirts",
            // 'slug' => 'women-long-sleeve-tshirts',
            'parent_id' => $womensTshirts->id,
            // 'code'=>'WLSTSH'
        ]);

        Category::create([
            'name' => "Women's Crop Tops",
            // 'slug' => 'women-crop-tops',
            'parent_id' => $womensTshirts->id,
            // 'code'=>'CRPTP'
        ]);

        Category::create([
            'name' => 'Dresses',
            // 'slug' => 'dresses',
            'parent_id' => $womensClothing->id,
            // 'code'=>'DRE'
        ]);

        $dresses = Category::where('slug', 'dresses')->first();

        Category::create([
            'name' => 'Casual Dresses',
            // 'slug' => 'casual-dresses',
            'parent_id' => $dresses->id,
            // 'code'=>'CADR'
        ]);

        Category::create([
            'name' => 'Evening Dresses',
            // 'slug' => 'evening-dresses',
            'parent_id' => $dresses->id,
            // 'code'=>'EVNDR'
        ]);

        Category::create([
            'name' => 'Maxi Dresses',
            // 'slug' => 'maxi-dresses',
            'parent_id' => $dresses->id,
            // 'code'=>"MAXDR"
        ]);

        Category::create([
            'name' => 'Skirts',
            // 'slug' => 'skirts',
            'parent_id' => $womensClothing->id,
            // 'code'=>'SKR'
        ]);

        $skirts = Category::where('slug', 'skirts')->first();

        Category::create([
            'name' => 'Mini Skirts',
            // 'slug' => 'mini-skirts',
            'parent_id' => $skirts->id,
            // 'code'=>'MINSKR'
        ]);

        Category::create([
            'name' => 'Midi Skirts',
            // 'slug' => 'midi-skirts',
            'parent_id' => $skirts->id,
            // 'code'=>'MIDSKR'

        ]);

        // ============================================
        // FOOTWEAR CATEGORY TREE
        // ============================================

        // $footwear = Category::create([
        //     'name' => 'Footwear',
        //     'slug' => 'footwear',
        //     'parent_id' => null,
        // ]);

        // // Men's Footwear
        // $mensFootwear = Category::create([
        //     'name' => "Men's Shoes",
        //     'slug' => 'mens-shoes',
        //     'parent_id' => $footwear->id,
        // ]);

        // Category::create([
        //     'name' => 'Sneakers',
        //     'slug' => 'sneakers',
        //     'parent_id' => $mensFootwear->id,
        // ]);

        // $mensSneakers = Category::where('slug', 'sneakers')
        //     ->where('parent_id', $mensFootwear->id)
        //     ->first();

        // Category::create([
        //     'name' => 'Running Shoes',
        //     'slug' => 'running-shoes',
        //     'parent_id' => $mensSneakers->id,
        // ]);

        // Category::create([
        //     'name' => 'Basketball Shoes',
        //     'slug' => 'basketball-shoes',
        //     'parent_id' => $mensSneakers->id,
        // ]);

        // Category::create([
        //     'name' => 'Casual Sneakers',
        //     'slug' => 'casual-sneakers',
        //     'parent_id' => $mensSneakers->id,
        // ]);

        // Category::create([
        //     'name' => 'Formal Shoes',
        //     'slug' => 'formal-shoes',
        //     'parent_id' => $mensFootwear->id,
        // ]);

        // $mensFormal = Category::where('slug', 'formal-shoes')
        //     ->where('parent_id', $mensFootwear->id)
        //     ->first();

        // Category::create([
        //     'name' => 'Oxfords',
        //     'slug' => 'oxfords',
        //     'parent_id' => $mensFormal->id,
        // ]);

        // Category::create([
        //     'name' => 'Loafers',
        //     'slug' => 'loafers',
        //     'parent_id' => $mensFormal->id,
        // ]);

        // Category::create([
        //     'name' => 'Boots',
        //     'slug' => 'boots',
        //     'parent_id' => $mensFootwear->id,
        // ]);

        // // Women's Footwear
        // $womensFootwear = Category::create([
        //     'name' => "Women's Shoes",
        //     'slug' => 'womens-shoes',
        //     'parent_id' => $footwear->id,
        // ]);

        // Category::create([
        //     'name' => 'Heels',
        //     'slug' => 'heels',
        //     'parent_id' => $womensFootwear->id,
        // ]);

        // $heels = Category::where('slug', 'heels')->first();

        // Category::create([
        //     'name' => 'High Heels',
        //     'slug' => 'high-heels',
        //     'parent_id' => $heels->id,
        // ]);

        // Category::create([
        //     'name' => 'Kitten Heels',
        //     'slug' => 'kitten-heels',
        //     'parent_id' => $heels->id,
        // ]);

        // Category::create([
        //     'name' => 'Wedges',
        //     'slug' => 'wedges',
        //     'parent_id' => $heels->id,
        // ]);

        // Category::create([
        //     'name' => 'Flats',
        //     'slug' => 'flats',
        //     'parent_id' => $womensFootwear->id,
        // ]);

        // Category::create([
        //     'name' => 'Sandals',
        //     'slug' => 'sandals',
        //     'parent_id' => $womensFootwear->id,
        // ]);

        // Category::create([
        //     'name' => 'Sneakers',
        //     'slug' => 'sneakers',
        //     'parent_id' => $womensFootwear->id,
        // ]);

        // // ============================================
        // // ACCESSORIES CATEGORY TREE
        // // ============================================

        // $accessories = Category::create([
        //     'name' => 'Accessories',
        //     'slug' => 'accessories',
        //     'parent_id' => null,
        // ]);

        // Category::create([
        //     'name' => 'Bags',
        //     'slug' => 'bags',
        //     'parent_id' => $accessories->id,
        // ]);

        // $bags = Category::where('slug', 'bags')
        //     ->where('parent_id', $accessories->id)
        //     ->first();

        // Category::create([
        //     'name' => 'Backpacks',
        //     'slug' => 'backpacks',
        //     'parent_id' => $bags->id,
        // ]);

        // Category::create([
        //     'name' => 'Handbags',
        //     'slug' => 'handbags',
        //     'parent_id' => $bags->id,
        // ]);

        // Category::create([
        //     'name' => 'Messenger Bags',
        //     'slug' => 'messenger-bags',
        //     'parent_id' => $bags->id,
        // ]);

        // Category::create([
        //     'name' => 'Jewelry',
        //     'slug' => 'jewelry',
        //     'parent_id' => $accessories->id,
        // ]);

        // $jewelry = Category::where('slug', 'jewelry')->first();

        // Category::create([
        //     'name' => 'Necklaces',
        //     'slug' => 'necklaces',
        //     'parent_id' => $jewelry->id,
        // ]);

        // Category::create([
        //     'name' => 'Bracelets',
        //     'slug' => 'bracelets',
        //     'parent_id' => $jewelry->id,
        // ]);

        // Category::create([
        //     'name' => 'Earrings',
        //     'slug' => 'earrings',
        //     'parent_id' => $jewelry->id,
        // ]);

        // Category::create([
        //     'name' => 'Watches',
        //     'slug' => 'watches',
        //     'parent_id' => $accessories->id,
        // ]);

        // $watches = Category::where('slug', 'watches')->first();

        // Category::create([
        //     'name' => 'Smart Watches',
        //     'slug' => 'smart-watches',
        //     'parent_id' => $watches->id,
        // ]);

        // Category::create([
        //     'name' => 'Analog Watches',
        //     'slug' => 'analog-watches',
        //     'parent_id' => $watches->id,
        // ]);

        // Category::create([
        //     'name' => 'Digital Watches',
        //     'slug' => 'digital-watches',
        //     'parent_id' => $watches->id,
        // ]);

        // Category::create([
        //     'name' => 'Belts',
        //     'slug' => 'belts',
        //     'parent_id' => $accessories->id,
        // ]);

        // Category::create([
        //     'name' => 'Hats',
        //     'slug' => 'hats',
        //     'parent_id' => $accessories->id,
        // ]);

        // Category::create([
        //     'name' => 'Sunglasses',
        //     'slug' => 'sunglasses',
        //     'parent_id' => $accessories->id,
        // ]);

        // // ============================================
        // // ELECTRONICS CATEGORY TREE
        // // ============================================

        // $electronics = Category::create([
        //     'name' => 'Electronics',
        //     'slug' => 'electronics',
        //     'parent_id' => null,
        // ]);

        // Category::create([
        //     'name' => 'Smartphones',
        //     'slug' => 'smartphones',
        //     'parent_id' => $electronics->id,
        // ]);

        // $smartphones = Category::where('slug', 'smartphones')->first();

        // Category::create([
        //     'name' => 'Android Phones',
        //     'slug' => 'android-phones',
        //     'parent_id' => $smartphones->id,
        // ]);

        // Category::create([
        //     'name' => 'iPhones',
        //     'slug' => 'iphones',
        //     'parent_id' => $smartphones->id,
        // ]);

        // Category::create([
        //     'name' => 'Laptops',
        //     'slug' => 'laptops',
        //     'parent_id' => $electronics->id,
        // ]);

        // $laptops = Category::where('slug', 'laptops')->first();

        // Category::create([
        //     'name' => 'Gaming Laptops',
        //     'slug' => 'gaming-laptops',
        //     'parent_id' => $laptops->id,
        // ]);

        // Category::create([
        //     'name' => 'Business Laptops',
        //     'slug' => 'business-laptops',
        //     'parent_id' => $laptops->id,
        // ]);

        // Category::create([
        //     'name' => 'Ultrabooks',
        //     'slug' => 'ultrabooks',
        //     'parent_id' => $laptops->id,
        // ]);

        // Category::create([
        //     'name' => 'Tablets',
        //     'slug' => 'tablets',
        //     'parent_id' => $electronics->id,
        // ]);

        // Category::create([
        //     'name' => 'Headphones',
        //     'slug' => 'headphones',
        //     'parent_id' => $electronics->id,
        // ]);

        // $headphones = Category::where('slug', 'headphones')->first();

        // Category::create([
        //     'name' => 'Wireless Headphones',
        //     'slug' => 'wireless-headphones',
        //     'parent_id' => $headphones->id,
        // ]);

        // Category::create([
        //     'name' => 'Wired Headphones',
        //     'slug' => 'wired-headphones',
        //     'parent_id' => $headphones->id,
        // ]);

        // Category::create([
        //     'name' => 'Gaming Headsets',
        //     'slug' => 'gaming-headsets',
        //     'parent_id' => $headphones->id,
        // ]);

        $this->command->info('Categories seeded successfully!');
        $this->command->info('Total categories created: ' . Category::count());
    }
}
