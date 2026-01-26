<?php

// namespace App\Livewire\Admin;

// use App\Models\Product;

// use Livewire\Component;
// use App\Models\Category;

// use Illuminate\Support\Str;
// use App\Models\ProductColor;
// use Livewire\WithFileUploads;


// class ProductForm extends Component
// {
//     use WithFileUploads;

//     public ?Product $product = null;
//     public $isEdit = false;

//     // #[Validate('required|string|max:255')]
//     public $name = '';

//     // #[Validate('nullable|string')]
//     public $description = '';

//     // #[Validate('required|numeric|min:0')]
//     public $base_price = '';

//     // #[Validate('required|string|max:255')]
//     public $sku = '';

//     public $is_active = true;

//     // #[Validate('nullable|image|max:2048')]
//     public $main_image;

//    public $division;
//     public $category_id;
//     public $categories = [];
//     public $colors = [];
//     public $colorImages = [];
//     public $existingColorImages = [];

//     protected $availableSizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'];


//     protected $rules = [
//         'name' => 'required|string|max:255',
//         'description' => 'nullable|string',
//         'base_price' => 'required|numeric|min:0',

//         'category_id' => 'required|exists:categories,id',
//         // 'sku' => 'required|string|max:255',
//         'is_active' => 'boolean',
//         'main_image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
//         'colors' => 'required|array|min:1',
//         'colors.*.name' => 'required|string|max:255',
//         'colors.*.hex_code' => [
//             'required',
//             'string',
//             'max:7',
//             'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'
//         ],
//         'colors.*.sizes.*.quantity' => 'nullable|integer|min:0',
//         'colors.*.sizes.*.price_adjustment' => 'nullable|numeric',
//         'colorImages' => 'nullable|array',
//         'colorImages.*.images' => 'nullable|array',
//         'colorImages.*.images.*' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048'
//     ];




//     protected function getCategories()
//     {

//         $this->categories = Category::all();
//         $this->category_id = $this->categories[0]['id'];
//     }
//     public function mount($productId = null)
//     {
//         if ($productId) {
//             $this->product = Product::with(['colors.sizes', 'colors.media'])->findOrFail($productId);
//             $this->isEdit = true;
//             $this->loadProductData();
//         } else {
//             $this->getCategories();
//             $this->addColor();
//         }
//     }

//     public function loadProductData()
//     {
//         $this->getCategories();
//         $this->name = $this->product->name;
//         $this->description = $this->product->description;
//         $this->base_price = $this->product->base_price;
//         $this->sku = $this->product->sku;
//         $this->is_active = $this->product->is_active;
//         $this->division = $this->product->category->divisions()->first()->id;
//         $this->category_id = $this->product->category->id;

//         foreach ($this->product->colors as $index => $color) {
//             $this->colors[$index] = [
//                 'id' => $color->id,
//                 'name' => $color->name,
//                 'hex_code' => $color->hex_code,
//                 'sizes' => [],
//             ];

//             foreach ($this->availableSizes as $size) {
//                 $existingSize = $color->sizes->where('size', $size)->first();
//                 $this->colors[$index]['sizes'][$size] = [
//                     'id' => $existingSize?->id,
//                     'enabled' => (bool) $existingSize,
//                     'quantity' => $existingSize?->quantity ?? 0,
//                     'price_adjustment' => $existingSize?->price_adjustment ?? 0,
//                 ];
//             }

//             // Store existing images
//             $this->existingColorImages[$index] = $color->getMedia('color_images');
//         }
//     }

//     public function addColor()
//     {
//         $index = count($this->colors);
//         $this->colors[$index] = [
//             'id' => null,
//             'name' => '',
//             'hex_code' => '#000000',
//             'sizes' => [],
//         ];

//         foreach ($this->availableSizes as $size) {
//             $this->colors[$index]['sizes'][$size] = [
//                 'id' => null,
//                 'enabled' => false,
//                 'quantity' => 0,
//                 'price_adjustment' => 0,
//             ];
//         }
//     }

//     public function removeColor($index)
//     {
//         unset($this->colors[$index]);
//         unset($this->colorImages[$index]);
//         unset($this->existingColorImages[$index]);
//         $this->colors = array_values($this->colors);
//     }

//     public function save()
//     {

//         $validated = $this->validate();

//         // dd($validated);


//         \DB::transaction(function () use ($validated) {
//             if ($this->isEdit) {
//                 $this->product->update([
//                     'name' => $this->name,
//                     'description' => $this->description,
//                     'base_price' => $this->base_price,
//                     'category_id' => $this->category_id,
//                     'slug' => Str::slug($this->name),
//                     'is_active' => $this->is_active,
//                 ]);
//             } else {
//                 $this->product = Product::create([
//                     'name' => $this->name,
//                     'description' => $this->description,
//                     'base_price' => $this->base_price,
//                     'category_id' => $this->category_id,
//                     'slug' => Str::slug($this->name),
//                     'is_active' => $this->is_active,
//                 ]);
//             }

//             // Handle main image
//             if ($this->main_image) {
//                  $this->product->clearMediaCollection('main_image');

//                 // Option 1: Direct upload (Recommended)
//                 $this->product->addMedia($this->main_image->getRealPath())
//                     ->usingFileName($this->main_image->hashName())
//                     ->toMediaCollection('main_image', 's3');
//             }

//             // Handle colors
//             $colorIds = [];
//             foreach ($this->colors as $index => $colorData) {
//                 $color = null;

//                 if ($colorData['id']) {
//                     $color = ProductColor::find($colorData['id']);
//                     $color->update([
//                         'name' => $colorData['name'],
//                         'hex_code' => $colorData['hex_code'],
//                     ]);
//                 } else {
//                     $color = $this->product->colors()->create([
//                         'name' => $colorData['name'],
//                         'hex_code' => $colorData['hex_code'],
//                     ]);
//                 }

//                 $colorIds[] = $color->id;

//                 // Handle color image
//                 if (isset($validated['colorImages'][$index]['images']) && $validated['colorImages'][$index]['images']) {
//                     $color->clearMediaCollection('color_images');
//                     foreach ($validated['colorImages'][$index]['images'] as $image) {

//                         $color->addMedia($image->getRealPath())
//                             ->usingFileName($image->hashName())
//                             ->toMediaCollection('color_images', 's3');
//                     }
//                 }

//                 // Handle sizes
//                 $sizeIds = [];
//                 foreach ($colorData['sizes'] as $sizeName => $sizeData) {
//                     if ($sizeData['enabled']) {
//                         if ($sizeData['id']) {
//                             $size = $color->sizes()->find($sizeData['id']);
//                             $size->update([
//                                 'quantity' => $sizeData['quantity'],
//                                 'price_adjustment' => $sizeData['price_adjustment'],
//                             ]);
//                             $sizeIds[] = $size->id;
//                         } else {
//                             $size = $color->sizes()->create([
//                                 'size' => $sizeName,
//                                 'quantity' => $sizeData['quantity'],
//                                 'price_adjustment' => $sizeData['price_adjustment'],
//                             ]);
//                             $sizeIds[] = $size->id;
//                         }
//                     }
//                 }

//                 // Delete removed sizes
//                 $color->sizes()->whereNotIn('id', $sizeIds)->delete();
//             }

//             // Delete removed colors
//             $this->product->colors()->whereNotIn('id', $colorIds)->delete();
//         });

//         session()->flash('success', 'Product saved successfully!');
//         return redirect()->route('admin.products.index');
//     }

//     public function render()
//     {
//         return view('livewire.admin.product-form', [
//             'availableSizes' => $this->availableSizes,

//         ]);
//     }
// }




namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductColor;
use Livewire\WithFileUploads;

class ProductForm extends Component
{
    use WithFileUploads;

    public ?Product $product = null;
    public $isEdit = false;

    public $name = '';
    public $description = '';
    public $base_price = '';
    public $sku = '';
    public $is_active = true;
    public $main_image;

    // Product Type
    public $productType = Product::TYPE_VARIABLE_COLOR_SIZE; // Default to clothing
    public $simpleQuantity = 0; // For accessories

    // public $division;
    public $category_id;
    public $categories;
    public $colors = [];
    public $colorImages = [];
    public $existingColorImages = [];

    protected $availableSizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'];

    public $is_featured=true;

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'base_price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'productType' => 'required|in:simple,variable_color,variable_color_size',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'main_image' => 'required|mimes:jpg,jpeg,png,webp|max:2048',
        ];

        // Simple products (accessories) - just need quantity
        if ($this->productType === Product::TYPE_SIMPLE) {
            $rules['simpleQuantity'] = 'required|integer|min:1';
        }

        // Products with colors (bags and clothing)
        if (
            $this->productType === Product::TYPE_VARIABLE_COLOR ||
            $this->productType === Product::TYPE_VARIABLE_COLOR_SIZE
        ) {
            $rules['colors'] = 'required|array|min:1';
            $rules['colors.*.name'] = 'required|string|max:255';
            $rules['colors.*.hex_code'] = [
                'required',
                'string',
                'max:7',
                'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'
            ];
            $rules['colorImages'] = 'required|array|min:1';
            $rules['colorImages.*.images'] = 'required|array';
            $rules['colorImages.*.images.*'] = 'required|mimes:jpg,jpeg,png,webp|max:2048';
        }

        // Bags (variable_color) - color quantity required
        if ($this->productType === Product::TYPE_VARIABLE_COLOR) {
            $rules['colors.*.quantity'] = 'required|integer|min:1';
        }

        // Clothing (variable_color_size) - sizes required
        if ($this->productType === Product::TYPE_VARIABLE_COLOR_SIZE) {
            $rules['colors.*.sizes'] = 'required|array|min:1';
            // $rules['colors.*.sizes.*.quantity'] = 'required|integer|min:1';
            $rules['colors.*.sizes.*.price_adjustment'] = 'nullable|numeric';
        }

        return $rules;
    }

    protected function getCategories()
    {
        $this->categories = Category::whereNull('parent_id')
        ->with('children.children')
        ->get();
        if ($this->categories->isNotEmpty()) {
            $this->category_id = $this->categories[0]['id'];
        }
    }

    public function mount($productId = null)
    {
        if ($productId) {
            $this->product = Product::with(['colors.sizes', 'colors.media'])->findOrFail($productId);
            $this->isEdit = true;
            $this->loadProductData();
        } else {
            $this->getCategories();
            // Don't add color by default for simple products
            if ($this->productType !== Product::TYPE_SIMPLE) {
                $this->addColor();
            }
        }
    }

    public function loadProductData()
    {
        $this->getCategories();
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->base_price = $this->product->base_price;
        $this->sku = $this->product->sku;
        $this->is_active = $this->product->is_active;
        $this->is_featured = $this->product->is_featured;
        $this->productType = $this->product->type;
        $this->simpleQuantity = $this->product->simple_quantity ?? 0;


        // Load colors only if not simple product
        if (!$this->product->isSimple()) {
            foreach ($this->product->colors as $index => $color) {
                $this->colors[$index] = [
                    'id' => $color->id,
                    'name' => $color->name,
                    'hex_code' => $color->hex_code,
                    'quantity' => $color->quantity ?? 0, // For bags
                    'sizes' => [],
                ];

                // Load sizes only for clothing
                if ($this->product->hasColorsAndSizes()) {
                    foreach ($this->availableSizes as $size) {
                        $existingSize = $color->sizes->where('size', $size)->first();
                        $this->colors[$index]['sizes'][$size] = [
                            'id' => $existingSize?->id,
                            'enabled' => (bool) $existingSize,
                            'quantity' => $existingSize?->quantity ?? 0,
                            'price_adjustment' => $existingSize?->price_adjustment ?? 0,
                        ];
                    }
                }

                // Store existing images
                $this->existingColorImages[$index] = $color->getMedia('color_images');
            }
        }
    }

    public function updatedProductType()
    {
        // dd($this->productType);
        // Clear colors when switching to simple
        if ($this->productType === Product::TYPE_SIMPLE) {
            $this->colors = [];
        } else {
            // Add one color if switching from simple
            if (empty($this->colors)) {
                $this->addColor();
            }
        }
    }


    public function addColor()
    {
        // Don't add colors for simple products
        if ($this->productType === Product::TYPE_SIMPLE) {
            return;
        }

        $index = count($this->colors);
        $this->colors[$index] = [
            'id' => null,
            'name' => '',
            'hex_code' => '#000000',
            'quantity' => 0, // For bags
            'sizes' => [],
        ];

        // Only add sizes for clothing
        if ($this->productType === Product::TYPE_VARIABLE_COLOR_SIZE) {
            foreach ($this->availableSizes as $size) {
                $this->colors[$index]['sizes'][$size] = [
                    'id' => null,
                    'enabled' => false,
                    'quantity' => 0,
                    'price_adjustment' => 0,
                ];
            }
        }
    }

    public function removeColor($index)
    {
        unset($this->colors[$index]);
        unset($this->colorImages[$index]);
        unset($this->existingColorImages[$index]);
        $this->colors = array_values($this->colors);
    }

    public function save()
    {
       
        // try {
        //     $validated = $this->validate();
        // } catch (\Illuminate\Validation\ValidationException $e) {
        //     // This will show you exactly what validation failed
        //     dd('Validation failed:', $e->errors());
        // }
        
        $validated = $this->validate();
        \DB::transaction(function () use ($validated) {
            $productData = [
                'name' => $validated['name'],
                'description' => $validated['description'],
                'base_price' => $validated['base_price'],
                'category_id' => $validated['category_id'],
                'slug' => Str::slug($validated['name']),
                'is_active' => $validated['is_active'],
                'type' => $validated['productType'],
                'is_featured'=>$validated['is_featured'],
                'simple_quantity' => $validated['productType'] === Product::TYPE_SIMPLE ? $validated['simpleQuantity'] : null,
            ];

            if ($this->isEdit) {
                $this->product->update($productData);
            } else {
                $this->product = Product::create($productData);
            }

            // Handle main image
            if ($this->main_image) {
                $this->product->clearMediaCollection('main_image');
                $this->product->addMedia($this->main_image->getRealPath())
                    ->usingFileName($this->main_image->hashName())
                    ->toMediaCollection('main_image', 's3');
            }

            // Handle colors only for non-simple products
            if ($this->productType !== Product::TYPE_SIMPLE) {
                $colorIds = [];

                foreach ($this->colors as $index => $colorData) {
                    $color = null;

                    if ($colorData['id']) {
                        $color = ProductColor::find($colorData['id']);
                        $color->update([
                            'name' => $colorData['name'],
                            'hex_code' => $colorData['hex_code'],
                            'quantity' => $this->productType === Product::TYPE_VARIABLE_COLOR ? ($colorData['quantity'] ?? 0) : null,
                        ]);
                    } else {
                        $color = $this->product->colors()->create([
                            'name' => $colorData['name'],
                            'hex_code' => $colorData['hex_code'],
                            'quantity' => $this->productType === Product::TYPE_VARIABLE_COLOR ? ($colorData['quantity'] ?? 0) : null,
                        ]);
                    }

                    $colorIds[] = $color->id;

                    // Handle color images
                    if (isset($validated['colorImages'][$index]['images']) && $validated['colorImages'][$index]['images']) {
                        $color->clearMediaCollection('color_images');
                        foreach ($validated['colorImages'][$index]['images'] as $image) {
                            $color->addMedia($image->getRealPath())
                                ->usingFileName($image->hashName())
                                ->toMediaCollection('color_images', 's3');
                        }
                    }

                    // Handle sizes only for clothing (variable_color_size)
                    if ($this->productType === Product::TYPE_VARIABLE_COLOR_SIZE) {
                        $sizeIds = [];
                        foreach ($colorData['sizes'] as $sizeName => $sizeData) {
                            if ($sizeData['enabled']) {
                                if ($sizeData['id']) {
                                    $size = $color->sizes()->find($sizeData['id']);
                                    $size->update([
                                        'quantity' => $sizeData['quantity'],
                                        'price_adjustment' => $sizeData['price_adjustment'],
                                    ]);
                                    $sizeIds[] = $size->id;
                                } else {
                                    $size = $color->sizes()->create([
                                        'size' => $sizeName,
                                        'quantity' => $sizeData['quantity'],
                                        'price_adjustment' => $sizeData['price_adjustment'],
                                    ]);
                                    $sizeIds[] = $size->id;
                                }
                            }
                        }

                        // Delete removed sizes
                        $color->sizes()->whereNotIn('id', $sizeIds)->delete();
                    }
                }

                // Delete removed colors
                $this->product->colors()->whereNotIn('id', $colorIds)->delete();
            } else {
                // For simple products, delete all colors if any exist
                $this->product->colors()->delete();
            }
        });

        session()->flash('success', 'Product saved successfully!');
        return redirect()->route('admin.products.index');
    }
    // Helper method to format categories recursively
    private function getNestedCategories($categories, $level = 0)
    {
        $formatted = [];

        foreach ($categories as $category) {
            $prefix = str_repeat('— ', $level);  // Using em dash for better visual hierarchy
            $formatted[] = [
                'id' => $category->id,
                'name' => $prefix . $category->name,
                'level' => $level
            ];

            // Recursively add children
            if ($category->children && $category->children->isNotEmpty()) {
                $childCategories = $this->getNestedCategories($category->children, $level + 1);
                $formatted = array_merge($formatted, $childCategories);
            }
        }

        return $formatted;
    }

    public function render()
    {
        return view('livewire.admin.product-form', [
            'availableSizes' => $this->availableSizes,
            'productTypes' => [
                Product::TYPE_SIMPLE => 'Simple Product (Accessories)',
                Product::TYPE_VARIABLE_COLOR => 'Variable Color (Bags)',
                Product::TYPE_VARIABLE_COLOR_SIZE => 'Variable Color & Size (Clothing)',
            ],
            'nestedCategories' => $this->getNestedCategories($this->categories)
        ]);
    }
}
