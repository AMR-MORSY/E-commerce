<?php

// namespace App\Livewire\Admin;

// use App\Models\Product;
// use Livewire\Component;
// use Livewire\WithPagination;

// class ProductIndex extends Component
// {
//     use WithPagination;

//     public $search = '';
//     public $statusFilter = 'all';
//     public $perPage = 10;
//     public $sortBy = 'created_at';
//     public $sortDirection = 'desc';

//     protected $queryString = [
//         'search' => ['except' => ''],
//         'statusFilter' => ['except' => 'all'],
//     ];

//     public function updatingSearch()
//     {
//         $this->resetPage();
//     }

//     public function updatingStatusFilter()
//     {
//         $this->resetPage();
//     }

//     public function sortByColumn($column)
//     {
//         if ($this->sortBy === $column) {
//             $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
//         } else {
//             $this->sortBy = $column;
//             $this->sortDirection = 'asc';
//         }
//     }

//     public function deleteProduct($productId)
//     {
//         $product = Product::find($productId);
        
//         if ($product) {
//             $product->delete();
//             session()->flash('success', 'Product deleted successfully!');
//         }
//     }

//     public function toggleStatus($productId)
//     {
//         $product = Product::find($productId);
        
//         if ($product) {
//             $product->update(['is_active' => !$product->is_active]);
//             session()->flash('success', 'Product status updated!');
//         }
//     }

//     public function render()
//     {
//         $products = Product::query()
//             ->with(['colors.sizes'])
//             ->when($this->search, function ($query) {
//                 $query->where(function ($q) {
//                     $q->where('name', 'like', '%' . $this->search . '%')
//                       ->orWhere('sku', 'like', '%' . $this->search . '%')
//                       ->orWhere('description', 'like', '%' . $this->search . '%');
//                 });
//             })
//             ->when($this->statusFilter !== 'all', function ($query) {
//                 $query->where('is_active', $this->statusFilter === 'active');
//             })
//             ->orderBy($this->sortBy, $this->sortDirection)
//             ->paginate($this->perPage);

//         return view('livewire.admin.product-index', [
//             'products' => $products,
//         ]);
//     }
// }




namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class ProductIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = 'all';
    public $typeFilter = 'all'; // New: filter by product type
    public $perPage = 10;
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => 'all'],
        'typeFilter' => ['except' => 'all'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingTypeFilter()
    {
        $this->resetPage();
    }

    public function sortByColumn($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function deleteProduct($productId)
    {
        $product = Product::find($productId);
        
        if ($product) {
            $product->delete();
            session()->flash('success', 'Product deleted successfully!');
        }
    }

    public function toggleStatus($productId)
    {
        $product = Product::find($productId);
        
        if ($product) {
            $product->update(['is_active' => !$product->is_active]);
            session()->flash('success', 'Product status updated!');
        }
    }

    public function render()
    {
        $products = Product::query()
            ->with(['colors.sizes'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('sku', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter !== 'all', function ($query) {
                $query->where('is_active', $this->statusFilter === 'active');
            })
            ->when($this->typeFilter !== 'all', function ($query) {
                $query->where('type', $this->typeFilter);
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.product-index', [
            'products' => $products,
            'productTypes' => [
                'simple' => 'Accessories',
                'variable_color' => 'Bags',
                'variable_color_size' => 'Clothing',
            ],
        ]);
    }
}