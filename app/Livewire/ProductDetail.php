<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\ProductSize;
use App\Models\ProductColor;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class ProductDetail extends Component
{


    public Product $product;
    public ?ProductColor $selectedColor = null;
    public ?ProductSize $selectedSize = null;
    public $currentImageIndex = 0;
    public $quantity = 1;
    

    public  $productFound = false;

    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with(['colors.sizes', 'colors.media'])
            ->firstOrFail();

        // Select first available color by default
        if ($this->product->colors->isNotEmpty()) {
            $this->selectColor($this->product->colors->first()->id);
        }
    }

    public function selectColor($colorId)
    {
        $this->selectedColor = $this->product->colors->find($colorId);
        $this->selectedSize = null; // Reset size selection when color changes
        $this->currentImageIndex = 0; // Reset carousel to first image

        // Auto-select first available size if exists
        $firstAvailableSize = $this->selectedColor->sizes
            ->where('quantity', '>', 0)
            ->first();

        if ($firstAvailableSize) {
            $this->selectedSize = $firstAvailableSize;
        }
    }

    public function selectSize($sizeId)
    {
        $this->selectedSize = $this->selectedColor->sizes->find($sizeId);
    }

    public function nextImage()
    {
        $totalImages = $this->getCurrentImages()->count();
        if ($totalImages > 0) {
            $this->currentImageIndex = ($this->currentImageIndex + 1) % $totalImages;
        }
    }

    public function previousImage()
    {
        $totalImages = $this->getCurrentImages()->count();
        if ($totalImages > 0) {
            $this->currentImageIndex = ($this->currentImageIndex - 1 + $totalImages) % $totalImages;
        }
    }

    public function setImageIndex($index)
    {
        $this->currentImageIndex = $index;
    }

    public function incrementQuantity()
    {
        if ($this->selectedSize && $this->quantity < $this->selectedSize->quantity) {
            $this->quantity++;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {

        if (!$this->selectedColor || !$this->selectedSize) {
            session()->flash('error', 'Please select a color and size');
            return;
        }

        if ($this->selectedSize->quantity < $this->quantity) {
            session()->flash('error', 'Not enough stock available');
            return;
        }

        if (!auth()->check()) {
            // Store cart items in session for guests


            $cart = session()->get('cart', []);



            $cart = array_map(function ($item) { //////////updating the product's quantity if user selected the same product'color and size
                if ($item['product_id'] == $this->product->id && $item['product_color_id'] == $this->selectedColor->id && $item['product_size_id'] == $this->selectedSize->id) {
                    $this->productFound = true;
                    $item['quantity'] = $item['quantity'] + $this->quantity;
                }
                return $item;
            }, $cart);

            if (!$this->productFound) //////////creating another product
            {
                $cart[] =  [
                    'product_id' => $this->product->id,
                    'quantity' => $this->quantity,
                    'product_color_id' => $this->selectedColor->id,
                    'product_size_id' => $this->selectedSize->id,
                    "product" => $this->product,
                ];
            }



            session()->flash('message', 'Product added to cart! You can review it after logging in.');



            session()->put('cart', $cart);





            return redirect()->route('product.detail', $this->product->slug);
        }
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $cartItem = $user->cartItems()->where('product_id', $this->product->id)->where('product_color_id', $this->selectedColor->id)->where('product_size_id', $this->selectedSize->id)->first();

        if ($cartItem) {
            $cartItemQuantity = $cartItem->quantity;
            $cartItem->update(['quantity' => $cartItemQuantity + $this->quantity]);
            session()->flash('message', 'Product quantity updated in cart!');
        } else {
            $user->cartItems()->create([
                'product_id' => $this->product->id,
                'quantity' => $this->quantity,
                'product_color_id' => $this->selectedColor->id,
                'product_size_id' => $this->selectedSize->id,
            ]);
            session()->flash('message', 'Product added to cart!');
        }
        return redirect()->route('product.detail', $this->product->slug);
    }

    public function getCurrentImages()
    {
        if (!$this->selectedColor) {
            // Fallback to main product image
            return collect([$this->product->hasMedia('main_image')
                ? $this->product->getFirstMedia('main_image')
                : null])->filter();
        }

        // Get all images for selected color
        $images = $this->selectedColor->getMedia('color_images');

        // If no color images, fallback to main product image
        if ($images->isEmpty() && $this->product->hasMedia('main_image')) {
            $images = collect([$this->product->getFirstMedia('main_image')]);
        }

        return $images;
    }

    /**
     * a computed property returns the final price after applying the discount as well as the size price adjustment
     */
    public function getCurrentPrice()
    {
        // $basePrice = $this->product->base_price;

        // if ($this->selectedSize && $this->selectedSize->price_adjustment) {
        //     return $basePrice + $this->selectedSize->price_adjustment;
        // }

        // return $basePrice;

        if ($this->selectedSize) {
            return $this->product->getFinalPrice($this->selectedSize->price_adjustment);
        }
    }
    /**
     * a computed property returns product base price + selected size price_adjustment
     */

    public function getOriginalPrice()
    {
        

        if ($this->selectedSize) {
            return $this->product->base_price + $this->selectedSize->price_adjustment;
        }
    }
    public function render()
    {
        return view('livewire.product-detail', [
            'currentImages' => $this->getCurrentImages(),
            'currentPrice' => $this->getCurrentPrice(),
            'originalPrice' => $this->getOriginalPrice()
        ]);
    }
}
