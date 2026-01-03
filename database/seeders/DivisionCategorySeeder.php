<?php

namespace Database\Seeders;

use App\Models\Category;
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

        foreach(CategoriesEnum::cases() as $category) {
            Category::create([
                'name' => $category->label(),
                'slug' => Str::slug($category->label()),
                'description' => "latest fashionable for.{{$category->label()}}.clothing and accessories",
                "code"=>$category->value,
                
            ]);
        }

        $divisions=Division::all();
        $categories=Category::all();
        foreach ($divisions as $division) {
            foreach ($categories as $category) {
                $division->categories()->attach($category->id, [
                    'is_active' => true
                ]);
            }
        }
    }
}
