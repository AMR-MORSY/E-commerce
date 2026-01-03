<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

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

    public function addToCart($productId)
    {
        if (!auth()->check()) {
            // Store cart items in session for guests
            $product = Product::with('category')->findOrFail($productId);

            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
               $cart[$productId]['quantity']++;
              
            } else {
                $cart[$productId] =  [
                    'product_id' => $productId,
                    'quantity' => 1,
                    "product" => $product,
                ] ;
            }

            session()->put('cart', $cart);
            session()->flash('message', 'Product added to cart! You can review it after logging in.');

            $this->dispatch('cart-updated');

            return;
        }

        $product = Product::findOrFail($productId);
        
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $cartItem = $user->cartItems()->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
            session()->flash('message', 'Product quantity updated in cart!');
        } else {
            $user->cartItems()->create([
                'product_id' => $productId,
                'quantity' => 1,
            ]);
            session()->flash('message', 'Product added to cart!');
        }

        $this->dispatch('cart-updated');
    }

    public function render()
    {
        $query = Product::where('is_active', true)
            ->with('category');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->categoryFilter) {
            $query->where('category_id', $this->categoryFilter);
        }

        switch ($this->sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            default:
                $query->latest();
        }

        $products = $query->paginate(12);
        $categories = Category::where('is_active', true)->get();

        return view('livewire.product-list', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
