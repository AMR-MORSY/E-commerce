<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSize;
use Illuminate\Support\Str;
use App\Models\ProductColor;
use App\Services\SkuGenerator;
use Illuminate\Database\Seeder;
use App\Observers\ProductObserver;

class ProductSeeder extends Seeder
{
    protected $skuGenerator;

    public function __construct(SkuGenerator $skuGenerator)
    {
        $this->skuGenerator = $skuGenerator;

        // Debug: Check if observer is instantiated
        // \Log::info('=== PRODUCT OBSERVER CONSTRUCTOR FIRED ===');
        // \Log::info('SkuGenerator injected: ' . get_class($skuGenerator));
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $electronics = Category::where('name', 'Electronics')->first();
        // $clothing = Category::where('name', 'Clothing')->first();
        // $home = Category::where('name', 'Home & Garden')->first();
        // $sports = Category::where('name', 'Sports & Outdoors')->first();
        // $books = Category::where('name', 'Books')->first();

        // $products = [
            // Electronics
            // ['name' => 'Wireless Headphones', 'description' => 'Premium wireless headphones with noise cancellation', 'price' => 199.99, 'compare_price' => 249.99, 'quantity' => 50, 'category_id' => $electronics->id, 'is_featured' => true,'category_code' => $electronics->code],
            // ['name' => 'Smart Watch', 'description' => 'Feature-rich smartwatch with health tracking', 'price' => 299.99, 'compare_price' => 349.99, 'quantity' => 30, 'category_id' => $electronics->id,'category_code' => $electronics->code, 'is_featured' => true],
            // ['name' => 'Laptop Stand', 'description' => 'Ergonomic aluminum laptop stand', 'price' => 49.99, 'quantity' => 100, 'category_id' => $electronics->id,'category_code' => $electronics->code],
            // ['name' => 'USB-C Cable', 'description' => 'High-speed USB-C charging cable', 'price' => 19.99, 'quantity' => 200, 'category_id' => $electronics->id,'category_code' => $electronics->code],
            
            // Clothing
            // ['name' => 'Cotton T-Shirt', 'description' => 'Comfortable 100% cotton t-shirt', 'price' => 24.99, 'compare_price' => 29.99, 'quantity' => 150, 'category_id' => $clothing->id,'category_code' => $clothing->code],
            // ['name' => 'Denim Jeans', 'description' => 'Classic fit denim jeans', 'price' => 79.99, 'compare_price' => 99.99, 'quantity' => 80, 'category_id' => $clothing->id, 'is_featured' => true,'category_code' => $clothing->code],
            // ['name' => 'Running Shoes', 'description' => 'Lightweight running shoes with cushioning', 'price' => 119.99, 'quantity' => 60, 'category_id' => $clothing->id,'category_code' => $clothing->code],
            
            // Home & Garden
            // ['name' => 'Coffee Maker', 'description' => 'Programmable coffee maker with timer', 'price' => 89.99, 'compare_price' => 119.99, 'quantity' => 40, 'category_code' => $home->code,'category_id' => $home->id, 'is_featured' => true],
            // ['name' => 'Garden Tool Set', 'description' => 'Complete set of gardening tools', 'price' => 59.99, 'quantity' => 25, 'category_id' => $home->id, 'category_code' => $home->code],
            // ['name' => 'Throw Pillow', 'description' => 'Decorative throw pillow for your sofa', 'price' => 29.99, 'quantity' => 100, 'category_id' => $home->id, 'category_code' => $home->code],
            
            // Sports & Outdoors
            // ['name' => 'Yoga Mat', 'description' => 'Non-slip yoga mat for exercise', 'price' => 34.99, 'quantity' => 75, 'category_id' => $sports->id, 'category_code' => $sports->code],
            // ['name' => 'Water Bottle', 'description' => 'Insulated stainless steel water bottle', 'price' => 24.99, 'quantity' => 120, 'category_id' => $sports->id, 'category_code' => $sports->code],
            // ['name' => 'Tennis Racket', 'description' => 'Professional tennis racket', 'price' => 149.99, 'compare_price' => 179.99, 'quantity' => 20, 'category_id' => $sports->id, 'category_code' => $sports->code],
            
            // Books
        //     ['name' => 'Programming Guide', 'description' => 'Complete guide to modern programming', 'price' => 39.99, 'quantity' => 50, 'category_id' => $books->id, 'category_code' => $books->code],
        //     ['name' => 'Fiction Novel', 'description' => 'Bestselling fiction novel', 'price' => 14.99, 'compare_price' => 19.99, 'quantity' => 200, 'category_id' => $books->id, 'category_code' => $books->code],
        //  ];

        // foreach ($products as $product) {
        //   $createdProduct=  Product::create([
        //         'name' => $product['name'],
        //         'slug' => Str::slug($product['name']),
        //         'description' => $product['description'],
        //         'base_price' => $product['price'],
        //         // 'compare_price' => $product['compare_price'] ?? null,
        //         // 'quantity' => $product['quantity'],
        //         'category_id' => $product['category_id'],
        //         'is_active' => true,
        //         'is_featured' => $product['is_featured'] ?? false,
        //         'sku' => $this->skuGenerator->generate(
        //             name: $product['name'],
        //             categoryCode: $product['category_code'] ?? null,
        //             maxAttempts:10 // Assuming relationship exists
        //         ),
        //     ]);
        // }

         // Product 1: T-Shirt
         $tshirt = Product::create([
            'name' => 'Classic Cotton T-Shirt',
            'description' => 'Premium quality 100% cotton t-shirt, perfect for everyday wear',
            'base_price' => 29.99,
            'is_active' => true,
            'is_featured' => false,
            'category_id' => 2,
            'slug' => Str::slug('Classic Cotton T-Shirt'),
            'sku' => $this->skuGenerator->generate(
                    name:'Classic Cotton T-Shirt',
                    categoryCode: 'CLTH' ,
                    maxAttempts:10 // Assuming relationship exists
                )
        ]);

        $this->createColorWithSizes($tshirt, [
            'name' => 'White',
            'hex_code' => '#FFFFFF',
            'sizes' => [
                'S' => ['quantity' => 50, 'price_adjustment' => 0],
                'M' => ['quantity' => 75, 'price_adjustment' => 0],
                'L' => ['quantity' => 60, 'price_adjustment' => 0],
                'XL' => ['quantity' => 40, 'price_adjustment' => 2.00],
                'XXL' => ['quantity' => 25, 'price_adjustment' => 4.00],
            ]
        ]);

        $this->createColorWithSizes($tshirt, [
            'name' => 'Black',
            'hex_code' => '#000000',
            'sizes' => [
                'S' => ['quantity' => 45, 'price_adjustment' => 0],
                'M' => ['quantity' => 80, 'price_adjustment' => 0],
                'L' => ['quantity' => 70, 'price_adjustment' => 0],
                'XL' => ['quantity' => 50, 'price_adjustment' => 2.00],
                'XXL' => ['quantity' => 30, 'price_adjustment' => 4.00],
            ]
        ]);

        $this->createColorWithSizes($tshirt, [
            'name' => 'Navy Blue',
            'hex_code' => '#001F3F',
            'sizes' => [
                'S' => ['quantity' => 30, 'price_adjustment' => 0],
                'M' => ['quantity' => 55, 'price_adjustment' => 0],
                'L' => ['quantity' => 45, 'price_adjustment' => 0],
                'XL' => ['quantity' => 35, 'price_adjustment' => 2.00],
            ]
        ]);

        // Product 2: Hoodie
        $hoodie = Product::create([
            'name' => 'Comfort Fleece Hoodie',
            'description' => 'Warm and cozy fleece hoodie with adjustable drawstring',
            'base_price' => 59.99,
            'is_active' => true,
            'is_featured' => false,
            'category_id' => 2,
            'slug' => Str::slug( 'Comfort Fleece Hoodie'),
            'sku' => $this->skuGenerator->generate(
                    name: 'Comfort Fleece Hoodie',
                    categoryCode: 'CLTH' ,
                    maxAttempts:10 // Assuming relationship exists
                )
        ]);

        $this->createColorWithSizes($hoodie, [
            'name' => 'Gray',
            'hex_code' => '#808080',
            'sizes' => [
                'S' => ['quantity' => 25, 'price_adjustment' => 0],
                'M' => ['quantity' => 40, 'price_adjustment' => 0],
                'L' => ['quantity' => 35, 'price_adjustment' => 0],
                'XL' => ['quantity' => 30, 'price_adjustment' => 5.00],
                'XXL' => ['quantity' => 20, 'price_adjustment' => 8.00],
            ]
        ]);

        $this->createColorWithSizes($hoodie, [
            'name' => 'Burgundy',
            'hex_code' => '#800020',
            'sizes' => [
                'M' => ['quantity' => 35, 'price_adjustment' => 0],
                'L' => ['quantity' => 40, 'price_adjustment' => 0],
                'XL' => ['quantity' => 25, 'price_adjustment' => 5.00],
            ]
        ]);

        // Product 3: Jeans
        $jeans = Product::create([
            'name' => 'Slim Fit Denim Jeans',
            'description' => 'Stylish slim fit jeans with stretch fabric for comfort',
            'base_price' => 79.99,
            'is_active' => true,
            'is_featured' => false,
            'category_id' => 2,
            'slug' => Str::slug( 'Slim Fit Denim Jeans'),
            'sku' => $this->skuGenerator->generate(
                    name: 'Slim Fit Denim Jeans',
                    categoryCode: 'CLTH' ?? null,
                    maxAttempts:10 // Assuming relationship exists
                )
        ]);

        $this->createColorWithSizes($jeans, [
            'name' => 'Dark Blue',
            'hex_code' => '#003366',
            'sizes' => [
                'S' => ['quantity' => 20, 'price_adjustment' => 0],
                'M' => ['quantity' => 35, 'price_adjustment' => 0],
                'L' => ['quantity' => 30, 'price_adjustment' => 0],
                'XL' => ['quantity' => 25, 'price_adjustment' => 5.00],
            ]
        ]);

        $this->createColorWithSizes($jeans, [
            'name' => 'Black',
            'hex_code' => '#000000',
            'sizes' => [
                'S' => ['quantity' => 18, 'price_adjustment' => 0],
                'M' => ['quantity' => 40, 'price_adjustment' => 0],
                'L' => ['quantity' => 35, 'price_adjustment' => 0],
                'XL' => ['quantity' => 22, 'price_adjustment' => 5.00],
            ]
        ]);

        $this->createColorWithSizes($jeans, [
            'name' => 'Light Blue',
            'hex_code' => '#ADD8E6',
            'sizes' => [
                'M' => ['quantity' => 25, 'price_adjustment' => 0],
                'L' => ['quantity' => 28, 'price_adjustment' => 0],
                'XL' => ['quantity' => 15, 'price_adjustment' => 5.00],
            ]
        ]);

        // Product 4: Polo Shirt
        $polo = Product::create([
            'name' => 'Premium Polo Shirt',
            'description' => 'Classic polo shirt with premium cotton blend',
            'base_price' => 39.99,
            'is_active' => true,
            'is_featured' => false,
            'category_id' => 2,
            'slug' => Str::slug( 'Premium Polo Shirt'),
            'sku' => $this->skuGenerator->generate(
                    name: 'Premium Polo Shirt',
                    categoryCode: 'CLTH' ?? null,
                    maxAttempts:10 // Assuming relationship exists
                )
        ]);

        $this->createColorWithSizes($polo, [
            'name' => 'White',
            'hex_code' => '#FFFFFF',
            'sizes' => [
                'S' => ['quantity' => 40, 'price_adjustment' => 0],
                'M' => ['quantity' => 60, 'price_adjustment' => 0],
                'L' => ['quantity' => 50, 'price_adjustment' => 0],
                'XL' => ['quantity' => 35, 'price_adjustment' => 3.00],
            ]
        ]);

        $this->createColorWithSizes($polo, [
            'name' => 'Forest Green',
            'hex_code' => '#228B22',
            'sizes' => [
                'S' => ['quantity' => 30, 'price_adjustment' => 0],
                'M' => ['quantity' => 45, 'price_adjustment' => 0],
                'L' => ['quantity' => 40, 'price_adjustment' => 0],
                'XL' => ['quantity' => 25, 'price_adjustment' => 3.00],
                'XXL' => ['quantity' => 15, 'price_adjustment' => 5.00],
            ]
        ]);

        // Product 5: Sweatpants
        $sweatpants = Product::create([
            'name' => 'Athletic Sweatpants',
            'description' => 'Comfortable athletic sweatpants with elastic waistband',
            'base_price' => 44.99,
            'is_active' => true,
            'is_featured' => false,
            'category_id' => 2,
            'slug' => Str::slug('Athletic Sweatpants'),
            'sku' => $this->skuGenerator->generate(
                    name: 'Athletic Sweatpants',
                    categoryCode: 'CLTH' ?? null,
                    maxAttempts:10 // Assuming relationship exists
                )
            
        ]);

        $this->createColorWithSizes($sweatpants, [
            'name' => 'Charcoal',
            'hex_code' => '#36454F',
            'sizes' => [
                'S' => ['quantity' => 30, 'price_adjustment' => 0],
                'M' => ['quantity' => 50, 'price_adjustment' => 0],
                'L' => ['quantity' => 45, 'price_adjustment' => 0],
                'XL' => ['quantity' => 35, 'price_adjustment' => 4.00],
                'XXL' => ['quantity' => 20, 'price_adjustment' => 6.00],
            ]
        ]);

        $this->createColorWithSizes($sweatpants, [
            'name' => 'Navy',
            'hex_code' => '#000080',
            'sizes' => [
                'M' => ['quantity' => 40, 'price_adjustment' => 0],
                'L' => ['quantity' => 38, 'price_adjustment' => 0],
                'XL' => ['quantity' => 28, 'price_adjustment' => 4.00],
            ]
        ]);

        
    }

    private function createColorWithSizes(Product $product, array $colorData): void
    {
        $color = ProductColor::create([
            'product_id' => $product->id,
            'name' => $colorData['name'],
            'hex_code' => $colorData['hex_code'],
        ]);

        foreach ($colorData['sizes'] as $sizeName => $sizeData) {
            ProductSize::create([
                'product_color_id' => $color->id,
                'size' => $sizeName,
                'quantity' => $sizeData['quantity'],
                'price_adjustment' => $sizeData['price_adjustment'] ?? 0,
            ]);
        }
    }
    
}
