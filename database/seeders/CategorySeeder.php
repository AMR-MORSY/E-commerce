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
        $categories = [
            ['name' => 'Electronics',"code"=>'ELEC', 'description' => 'Latest electronic devices and gadgets'],
            ['name' => 'Clothing',"code"=>"CLTH", 'description' => 'Fashionable clothing and accessories'],
            ['name' => 'Home & Garden', 'code'=>'HOME', 'description' => 'Everything for your home and garden'],
            ['name' => 'Sports & Outdoors', "code"=>"SPRT", 'description' => 'Sports equipment and outdoor gear'],
            ['name' => 'Books', "code"=>'BOOK', 'description' => 'Books and reading materials'],
            ['name' => 'Toys & Games',"code"=>"TOY", 'description' => 'Fun toys and games for all ages'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                "code"=>$category['code'],
                'is_active' => true,
            ]);
        }
    }
}
