<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class DiscountManager extends Component
{
    use WithPagination;

    public $selectedProducts = [];
    public $bulkDiscountType = 'percentage';
    public $bulkDiscountValue = 0;
    public $bulkStartsAt = '';
    public $bulkEndsAt = '';
    public $bulkFreeShipping = false;
    public $search = '';

    public function applyBulkDiscount()
    {
        $this->validate([
            'bulkDiscountType' => 'required|in:percentage,fixed',
            'bulkDiscountValue' => 'required|numeric|min:0',
            'bulkStartsAt' => 'nullable|date',
            'bulkEndsAt' => 'nullable|date|after:bulkStartsAt',
        ]);

        if (empty($this->selectedProducts)) {
            session()->flash('error', 'Please select at least one product');
            return;
        }

        Product::whereIn('id', $this->selectedProducts)->update([
            'has_discount' => true,
            'discount_type' => $this->bulkDiscountType,
            'discount_value' => $this->bulkDiscountValue,
            'discount_starts_at' => $this->bulkStartsAt ?: null,
            'discount_ends_at' => $this->bulkEndsAt ?: null,
            'free_shipping' => $this->bulkFreeShipping,
        ]);

        session()->flash('success', 'Discount applied to ' . count($this->selectedProducts) . ' products');
        $this->reset(['selectedProducts', 'bulkDiscountValue', 'bulkStartsAt', 'bulkEndsAt', 'bulkFreeShipping']);
    }

    public function removeDiscount($productId)
    {
        Product::where('id', $productId)->update([
            'has_discount' => false,
            'discount_type' => null,
            'discount_value' => null,
            'discount_starts_at' => null,
            'discount_ends_at' => null,
        ]);

        session()->flash('success', 'Discount removed');
    }

    public function toggleFreeShipping($productId)
    {
        $product = Product::find($productId);
        $product->update(['free_shipping' => !$product->free_shipping]);
        
        session()->flash('success', 'Free shipping updated');
    }

    public function render()
    {
        $products = Product::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('sku', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('livewire.admin.discount-manager', [
            'products' => $products,
        ]);
    }
}
