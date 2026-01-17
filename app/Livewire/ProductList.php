<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Cache;

#[Layout('components.layouts.app')]
class ProductList extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryFilter = '';
    public $sortBy = 'latest';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }



    // Optimize your query
    public function fetchProducts()
    {
        return Product::where('is_active', true)
            ->when($this->categoryFilter, fn($q) => $q->where('category_id', $this->categoryFilter))
            ->when($this->search, function ($q) {

                return $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->with('colors.sizes') // Eager loading is good
            ->orderBy($this->getSortColumn(), $this->getSortDirection())
            ->paginate(12);
    }

    private function getSortColumn(): string
    {
        return match ($this->sortBy) {
            'price_low', 'price_high' => 'price',
            'name' => 'name',
            default => 'created_at' // for 'latest'
        };
    }

    /**
     * Get the sort direction (ascending or descending)
     */
    private function getSortDirection(): string
    {
        return match ($this->sortBy) {
            'price_low' => 'asc',  // Low to high
            'price_high' => 'desc', // High to low
            'name' => 'asc',        // A to Z
            'latest' => 'desc',     // Newest first
            default => 'desc'       // Default to newest first
        };
    }

    /**
     * Get current page from request
     */
    private function getPage(): int
    {
        return request()->input('page', 1);
    }

    public function render()
    {



        if (empty($this->search) && empty($this->categoryFilter) && $this->sortBy === 'latest') {
              // Cache only the default view (homepage)
            $page = $this->getPage(); // Get current page
            // if (true) {

                $products = Cache::tags(['products', 'products_list'])->rememberForever(
                    "products_default_page_{$page}",

                    function () {
                        return $this->fetchProducts();
                    }
                );
               
            // } else {

            //     $products = Cache::rememberForever(
            //        "products_default_page_{$page}",
            //         function () {
            //             return $this->fetchProducts();
            //         }

            //     );
            // }
        } else {
            $products =  $this->fetchProducts();
        }







        // $query = Product::where('is_active', true)
        //     ->with('colors.sizes');

        // if ($this->search) {
        //     $query->where(function ($q) {
        //         $q->where('name', 'like', '%' . $this->search . '%')
        //             ->orWhere('description', 'like', '%' . $this->search . '%');
        //     });
        // }

        // if ($this->categoryFilter) {
        //     $query->where('category_id', $this->categoryFilter);
        // }

        // switch ($this->sortBy) {
        //     case 'price_low':
        //         $query->orderBy('price', 'asc');
        //         break;
        //     case 'price_high':
        //         $query->orderBy('price', 'desc');
        //         break;
        //     case 'name':
        //         $query->orderBy('name', 'asc');
        //         break;
        //     default:
        //         $query->latest();
        // }

        // $products = $query->paginate(12);
        $categories = Category::where('is_active', true)->get();
        // $categories = Category::all();

        return view('livewire.product-list', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
