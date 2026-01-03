<?php

namespace App\Livewire\Admin;

use App\Models\Product;

use Livewire\Component;
use App\Models\Category;
use App\Models\Division;
use Illuminate\Support\Str;
use App\Models\ProductColor;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;

class ProductForm extends Component
{
    use WithFileUploads;

    public ?Product $product = null;
    public $isEdit = false;

    // #[Validate('required|string|max:255')]
    public $name = '';

    // #[Validate('nullable|string')]
    public $description = '';

    // #[Validate('required|numeric|min:0')]
    public $base_price = '';

    // #[Validate('required|string|max:255')]
    public $sku = '';

    public $is_active = true;

    // #[Validate('nullable|image|max:2048')]
    public $main_image;

    public $division;
    public $category_id;
    public $categories = [];
    public $colors = [];
    public $colorImages = [];
    public $existingColorImages = [];

    protected $availableSizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'];


    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'base_price' => 'required|numeric|min:0',

        'category_id' => 'required|exists:categories,id',
        // 'sku' => 'required|string|max:255',
        'is_active' => 'boolean',
        'main_image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
        'colors' => 'required|array|min:1',
        'colors.*.name' => 'required|string|max:255',
        'colors.*.hex_code' => [
            'required',
            'string',
            'max:7',
            'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'
        ],
        'colors.*.sizes.*.quantity' => 'nullable|integer|min:0',
        'colors.*.sizes.*.price_adjustment' => 'nullable|numeric',
        'colorImages' => 'nullable|array',
        'colorImages.*.images' => 'nullable|array',
        'colorImages.*.images.*' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048'
    ];


    public function updatedDivision($value)
    {
        $division = Division::find($value);
        $this->categories = $division->categories;
    }

    protected function getCategories()
    {
        $division = Division::all()->first();
        $this->categories = $division->categories;
        $this->category_id = $this->categories[0]['id'];
    }
    public function mount($productId = null)
    {
        if ($productId) {
            $this->product = Product::with(['colors.sizes', 'colors.media'])->findOrFail($productId);
            $this->isEdit = true;
            $this->loadProductData();
        } else {
            $this->getCategories();
            $this->addColor();
        }
    }

    public function loadProductData()
    {
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->base_price = $this->product->base_price;
        $this->sku = $this->product->sku;
        $this->is_active = $this->product->is_active;
        $this->division = $this->product->categories->first()->division->id;
        $this->category_id = $this->product->category->id;

        foreach ($this->product->colors as $index => $color) {
            $this->colors[$index] = [
                'id' => $color->id,
                'name' => $color->name,
                'hex_code' => $color->hex_code,
                'sizes' => [],
            ];

            foreach ($this->availableSizes as $size) {
                $existingSize = $color->sizes->where('size', $size)->first();
                $this->colors[$index]['sizes'][$size] = [
                    'id' => $existingSize?->id,
                    'enabled' => (bool) $existingSize,
                    'quantity' => $existingSize?->quantity ?? 0,
                    'price_adjustment' => $existingSize?->price_adjustment ?? 0,
                ];
            }

            // Store existing images
            $this->existingColorImages[$index] = $color->getMedia('color_images');
        }
    }

    public function addColor()
    {
        $index = count($this->colors);
        $this->colors[$index] = [
            'id' => null,
            'name' => '',
            'hex_code' => '#000000',
            'sizes' => [],
        ];

        foreach ($this->availableSizes as $size) {
            $this->colors[$index]['sizes'][$size] = [
                'id' => null,
                'enabled' => false,
                'quantity' => 0,
                'price_adjustment' => 0,
            ];
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

        $validated = $this->validate();

        // dd($validated);


        \DB::transaction(function () use ($validated) {
            if ($this->isEdit) {
                $this->product->update([
                    'name' => $this->name,
                    'description' => $this->description,
                    'base_price' => $this->base_price,
                    'category_id' => $this->category_id,
                    'slug' => Str::slug($this->name),
                    'is_active' => $this->is_active,
                ]);
            } else {
                $this->product = Product::create([
                    'name' => $this->name,
                    'description' => $this->description,
                    'base_price' => $this->base_price,
                    'category_id' => $this->category_id,
                    'slug' => Str::slug($this->name),
                    'is_active' => $this->is_active,
                ]);
            }

            // Handle main image
            if ($this->main_image) {
                $this->product->clearMediaCollection('main_image');
                $tempPath = $this->main_image->store('site-images', 's3');


                // Step 2: Copy from S3 to media library on S3
                $this->product->addMediaFromDisk($tempPath, 's3')

                    ->toMediaCollection('main-image');

                // Step 3: Clean up temp file
                Storage::disk('s3')->delete($tempPath);
                // $this->product->addMedia($this->main_image->getRealPath())
                //     ->usingFileName($this->main_image->getClientOriginalName())
                //     ->toMediaCollection('main_image');
            }

            // Handle colors
            $colorIds = [];
            foreach ($this->colors as $index => $colorData) {
                $color = null;

                if ($colorData['id']) {
                    $color = ProductColor::find($colorData['id']);
                    $color->update([
                        'name' => $colorData['name'],
                        'hex_code' => $colorData['hex_code'],
                    ]);
                } else {
                    $color = $this->product->colors()->create([
                        'name' => $colorData['name'],
                        'hex_code' => $colorData['hex_code'],
                    ]);
                }

                $colorIds[] = $color->id;

                // Handle color image
                if (isset($validated['colorImages'][$index]['images']) && $validated['colorImages'][$index]['images']) {
                    $color->clearMediaCollection('color_images');
                    foreach ($validated['colorImages'][$index]['images'] as $image) {
                        $tempPath = $image->store('site-images', 's3');
                        $color->addMediaFromDisk($tempPath, 's3')
                            ->toMediaCollection('color_images');
                        Storage::disk('s3')->delete($tempPath);
                    }
                }

                // Handle sizes
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

            // Delete removed colors
            $this->product->colors()->whereNotIn('id', $colorIds)->delete();
        });

        session()->flash('success', 'Product saved successfully!');
        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.admin.product-form', [
            'availableSizes' => $this->availableSizes,
            'divisions' => Division::all(),
            // 'categories' => Category::all(),
        ]);
    }
}
