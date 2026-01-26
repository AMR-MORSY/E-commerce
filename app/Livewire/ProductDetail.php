<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Services\CartService;
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



    public function mount($product)
    {

        // $this->product = Product::where('slug', $slug)
        //     ->where('is_active', true)
        //     ->with(['colors.sizes', 'colors.media'])
        //     ->firstOrFail();

        $this->product = $product;
     
        // Auto-select for different product types
        if ($this->product->hasColorsOnly() || $this->product->hasColorsAndSizes()) {
            if ($this->product->colors->isNotEmpty()) {
                $this->selectedColor=$this->product->colors->first();
            }
        }
        if ($this->selectedColor && $this->product->hasColorsAndSizes()) {
            $this->selectedSize = $this->selectedColor->sizes()->first();
        }
    }

    // public Product $product;
    // public ?ProductColor $selectedColor = null;
    // public ?ProductSize $selectedSize = null;
    // public $currentImageIndex = 0;
    // public $quantity = 1;
    // public $currentImages;
    // public $discountedPrice;
    // public $originalPrice;

    // public function mount(
    //     Product $product,
    //     $selectedColor = null,
    //     $selectedSize = null,
    //     $currentImages = null,
    //     $discountedPrice = 0,
    //     $originalPrice = 0
    // ) {
    //     $this->product = $product;
    //     $this->selectedColor = $selectedColor;
    //     $this->selectedSize = $selectedSize;
    //     $this->currentImages = $currentImages;
    //     $this->discountedPrice = $discountedPrice;
    //     $this->originalPrice = $originalPrice;
    // }

    public function selectColor($colorId)
    {
        $this->selectedColor = $this->product->colors->find($colorId);

        $this->currentImageIndex = 0; // Reset carousel to first image

        // For clothing, auto-select first available size
        if ($this->product->hasColorsAndSizes()) {
            $this->selectedSize = null; // Reset size selection when color changes

            $firstAvailableSize = $this->selectedColor->sizes
                ->where('quantity', '>', 0)
                ->first();

            if ($firstAvailableSize) {
                $this->selectedSize = $firstAvailableSize;
            }
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
        $maxQuantity = $this->getMaxQuantity();

        if ($this->quantity < $maxQuantity) {
            $this->quantity++;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function getMaxQuantity()
    {
        if ($this->product->isSimple()) {
            return $this->product->simple_quantity ?? 0;
        }

        if ($this->product->hasColorsOnly() && $this->selectedColor) {
            return $this->selectedColor->quantity ?? 0;
        }

        if ($this->product->hasColorsAndSizes() && $this->selectedSize) {
            return $this->selectedSize->quantity ?? 0;
        }

        return 0;
    }

    public function addToCart(CartService $cartService)
    {

        // Validate based on product type
        if ($this->product->isSimple()) {
            // Simple product - just check quantity
            if ($this->product->simple_quantity < $this->quantity) {
                session()->flash('error', 'Not enough stock available');
                return;
            }
            $cartService->addItem($this->product, null, null, $this->quantity);
        } elseif ($this->product->hasColorsOnly()) {
            // Bags - need color
            if (!$this->selectedColor) {
                session()->flash('error', 'Please select a color');
                return;
            }

            if ($this->selectedColor->quantity < $this->quantity) {
                session()->flash('error', 'Not enough stock available');
                return;
            }
            $cartService->addItem($this->product, $this->selectedColor->id, null, $this->quantity);
        } elseif ($this->product->hasColorsAndSizes()) {
            // Clothing - need color and size
            if (!$this->selectedColor || !$this->selectedSize) {
                session()->flash('error', 'Please select a color and size');
                return;
            }

            if ($this->selectedSize->quantity < $this->quantity) {
                session()->flash('error', 'Not enough stock available');
                return;
            }
            $cartService->addItem($this->product, $this->selectedColor->id, $this->selectedSize->id, $this->quantity);
        }

        // $cartItem = $cartService->addItem($this->product, $this->selectedColor->id, $this->selectedSize->id, $this->quantity);

        $this->dispatch("cart-updated");
        $this->quantity = 1;
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

    public function getDiscountedPrice()
    {
        $sizeAdjustment = 0;

        if ($this->product->hasColorsAndSizes() && $this->selectedSize) {
            $sizeAdjustment = $this->selectedSize->price_adjustment ?? 0;
        }

        return $this->product->getFinalPrice($sizeAdjustment);
    }

    /**
     * a computed property returns product base price + selected size price_adjustment. computed property value is updating when selected size value get updated
     */

    public function getOriginalPrice()
    {
        $basePrice = $this->product->base_price;

        if ($this->product->hasColorsAndSizes() && $this->selectedSize) {
            return $basePrice + ($this->selectedSize->price_adjustment ?? 0);
        }

        return $basePrice;
    }

    public function getDiscountAmount()
    {
        $sizeAdjustment = 0;

        if ($this->product->hasColorsAndSizes() && $this->selectedSize) {
            $sizeAdjustment = $this->selectedSize->price_adjustment ?? 0;
        }

        return $this->product->getDiscountAmount($sizeAdjustment);
    }

    /**
     * a computed property returns the final price after applying the discount as well as the size price adjustment
     */
    // public function getDiscountedPrice()
    // {


    //     if ($this->selectedSize) {
    //         return $this->product->getFinalPrice($this->selectedSize->price_adjustment);
    //     }
    // }



    public function render()
    {
        return view('livewire.product-detail', [
            'currentImages' => $this->getCurrentImages(),
            // 'currentPrice' => $this->getCurrentPrice(),
            'originalPrice' => $this->getOriginalPrice(),
            // 'discountedPrice'=>$this->getDiscountedPrice(),
            'discountAmount' => $this->getDiscountAmount(),
            'hasDiscount' => $this->product->hasActiveDiscount(),
            'discountPercentage' => $this->product->getDiscountPercentage(),
            'hasFreeShipping' => $this->product->free_shipping,
            'maxQuantity' => $this->getMaxQuantity(),
        ]);
    }
}
