<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Discount & Free Shipping Manager</h1>

    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Bulk Discount Form -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-bold mb-4">Apply Bulk Discount</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium mb-1">Discount Type</label>
                <select wire:model="bulkDiscountType" class="w-full border rounded px-3 py-2">
                    <option value="percentage">Percentage (%)</option>
                    <option value="fixed">Fixed Amount ($)</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Discount Value</label>
                <input type="number" step="0.01" wire:model="bulkDiscountValue" 
                    placeholder="{{ $bulkDiscountType === 'percentage' ? 'e.g., 20' : 'e.g., 10.00' }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Start Date (Optional)</label>
                <input type="datetime-local" wire:model="bulkStartsAt" 
                    class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">End Date (Optional)</label>
                <input type="datetime-local" wire:model="bulkEndsAt" 
                    class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="flex items-center gap-4 mb-4">
            <label class="flex items-center gap-2">
                <input type="checkbox" wire:model="bulkFreeShipping" class="rounded">
                <span class="text-sm font-medium">Apply Free Shipping</span>
            </label>
        </div>

        <button wire:click="applyBulkDiscount" 
            class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded font-medium">
            Apply to Selected Products ({{ count($selectedProducts) }})
        </button>
    </div>

    <!-- Search -->
    <div class="bg-white rounded-lg shadow-md p-4 mb-6">
        <input type="text" wire:model.live.debounce.300ms="search" 
            placeholder="Search products..." 
            class="w-full border rounded px-3 py-2">
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left">
                        <input type="checkbox" 
                            wire:model.live="selectedProducts"
                            value="all"
                            class="rounded">
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Base Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Discount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Final Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Free Shipping</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <input type="checkbox" 
                                wire:model.live="selectedProducts" 
                                value="{{ $product->id }}"
                                class="rounded">
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                            <div class="text-sm text-gray-500">{{ $product->sku }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            ${{ number_format($product->base_price, 2) }}
                        </td>
                        <td class="px-6 py-4">
                            @if($product->hasActiveDiscount())
                                <div class="text-sm">
                                    <span class="font-semibold text-red-600">
                                        @if($product->discount_type === 'percentage')
                                            -{{ $product->discount_value }}%
                                        @else
                                            -${{ number_format($product->discount_value, 2) }}
                                        @endif
                                    </span>
                                    @if($product->discount_starts_at || $product->discount_ends_at)
                                        <div class="text-xs text-gray-500 mt-1">
                                            @if($product->discount_starts_at)
                                                From: {{ $product->discount_starts_at->format('M d, Y') }}
                                            @endif
                                            @if($product->discount_ends_at)
                                                <br>To: {{ $product->discount_ends_at->format('M d, Y') }}
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @else
                                <span class="text-gray-400">No discount</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-semibold {{ $product->hasActiveDiscount() ? 'text-green-600' : 'text-gray-900' }}">
                                ${{ number_format($product->getFinalPrice(), 2) }}
                            </span>
                            @if($product->hasActiveDiscount())
                                <div class="text-xs text-green-600">
                                    Save ${{ number_format($product->getDiscountAmount(), 2) }}
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <button wire:click="toggleFreeShipping({{ $product->id }})"
                                class="px-3 py-1 rounded-full text-xs font-semibold {{ $product->free_shipping ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $product->free_shipping ? 'FREE' : 'Paid' }}
                            </button>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            @if($product->has_discount)
                                <button wire:click="removeDiscount({{ $product->id }})"
                                    wire:confirm="Remove discount from this product?"
                                    class="text-red-600 hover:text-red-900">
                                    Remove Discount
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $products->links() }}
        </div>
    </div>
</div>