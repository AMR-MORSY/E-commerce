<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Support\Str;
use App\Enums\CategoriesEnum;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DivisionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = [
            ['name' => 'Men',"code"=>'MN', 'description' => 'Latest Mens wear and gadgets'],
            ['name' => 'Women',"code"=>"WMN", 'description' => 'Fashionable women clothing and accessories'],
            ['name' => 'Kids', 'code'=>'KID', 'description' => 'Shiny and colorful kids clothing and accessories'],
          
        ];

        foreach ($divisions as $division) {
            Division::create([
                'name' => $division['name'],
                'slug' => Str::slug($division['name']),
                'description' => $division['description'],
                "code"=>$division['code'],
                'is_active' => true,
            ]);
        }

        $divisions=Division::all();
        $categories=CategoriesEnum::cases();
        foreach ($divisions as $division) {
            foreach ($categories as $category) {
                $division->categories()->create([
                    'name' => $category->label(),
                    'slug' => Str::slug($category->label()),
                    'description' => $division->description,
                    "code"=>$category->value,
                ]);
            }
        }
    }
}
