<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Str;


class SkuGenerator
{
    /**
     * Generate a unique SKU based on product attributes
     *
     * @param string $name Product name
     * @param string|null $categoryCode Category name
     * @param int $maxAttempts Maximum regeneration attempts
     * @return string
     * @throws \Exception When unable to generate unique SKU
     */

    public function generate(string $name, string $categoryCode, int $maxAttempts): string
    {
        $baseSku = $this->createBaseSku($name, $categoryCode);
        $sku = $baseSku;
        $attempts = 0;

        do {
            if ($attempts >= $maxAttempts) {
                throw new \Exception("Failed to generate unique SKU after {$maxAttempts} attempts.");
            }

            // Add random suffix if not first attempt
            if ($attempts > 0) {
                $sku = $baseSku . '-' . Str::upper(Str::random(3));
            }

            $attempts++;
        } while ($this->skuExists($sku));

        return $sku;
    }

    protected function createBaseSku(string $name, ?string $categoryCode):string
    {
        // Clean the product name: take first 3 chars, uppercase, alphanumeric only
        $namePart = Str::upper(Str::substr(preg_replace('/[^A-Za-z0-9]/', '', $name), 0, 3));

        // Use category code or default
        $categoryPart = $categoryCode ? Str::upper($categoryCode) : 'GEN';

         // Add timestamp component (year + month + 2 random digits)
         $timestampPart = date('ym') . rand(10, 99);

         return "{$categoryPart}-{$namePart}-{$timestampPart}";
    }

     /**
     * Check if SKU already exists in database
     */
    protected function skuExists(string $sku): bool
    {
        return Product::where('sku', $sku)->exists();
    }
}
