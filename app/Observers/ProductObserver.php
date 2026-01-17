<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Services\SkuGenerator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class ProductObserver
{
    protected $skuGenerator;

    public function __construct(SkuGenerator $skuGenerator)
    {
        $this->skuGenerator = $skuGenerator;

    }

    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        
        if (empty($product->sku)) {
            // dd($product->category->code);
            $sku= $this->skuGenerator->generate(
                name: $product->name,
                categoryCode: $product->category->code ?? null,
                maxAttempts:10 // Assuming relationship exists
            );

            $product->update(['sku'=>$sku]);
        }

        $this->clearProductListCache();

    }
    private function clearProductListCache(): void
    {
       
       
            // Clear only specific tags
            Cache::tags(['products_list'])->flush();
       
      
    }
    /**
     * Handle the Product "updating" event.
     * Prevent SKU modification once set.
     */
    public function updating(Product $product): void
    {
        if ($product->isDirty('sku') && !is_null($product->getOriginal('sku'))) {
            // Option 1: Reset to original value (safer)
            $product->sku = $product->getOriginal('sku');

            // Option 2: Throw exception (strict)
            // throw new \Exception('SKU cannot be modified once set.');
        }
        $this->clearProductListCache();
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        $this->clearProductListCache();
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        $this->clearProductListCache();
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        $this->clearProductListCache();
    }
}
