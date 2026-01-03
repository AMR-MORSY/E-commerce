<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class AdminProducts extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $showModal = false;
    public $editingId = null;
    public $name = '';
    public $description = '';
    public $price = '';
    public $compare_price = '';
    public $sku = '';
    public $quantity = 0;
    public $category_id = '';
    public $is_active = true;
    public $is_featured = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'compare_price' => 'nullable|numeric|min:0',
        'sku' => 'nullable|string|max:255',
        'quantity' => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,id',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->editingId = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->compare_price = $product->compare_price;
        $this->sku = $product->sku;
        $this->quantity = $product->quantity;
        $this->category_id = $product->category_id;
        $this->is_active = $product->is_active;
        $this->is_featured = $product->is_featured;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'price' => $this->price,
            'compare_price' => $this->compare_price,
            'sku' => $this->sku,
            'quantity' => $this->quantity,
            'category_id' => $this->category_id,
            'is_active' => $this->is_active,
            'is_featured' => $this->is_featured,
        ];

        if ($this->editingId) {
            Product::where('id', $this->editingId)->update($data);
            session()->flash('message', 'Product updated successfully!');
        } else {
            Product::create($data);
            session()->flash('message', 'Product created successfully!');
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
        session()->flash('message', 'Product deleted successfully!');
    }

    public function resetForm()
    {
        $this->editingId = null;
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->compare_price = '';
        $this->sku = '';
        $this->quantity = 0;
        $this->category_id = '';
        $this->is_active = true;
        $this->is_featured = false;
    }

    public function render()
    {
        $products = Product::with('category')->latest()->paginate(10);
        $categories = Category::where('is_active', true)->get();

        return view('livewire.admin-products', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
