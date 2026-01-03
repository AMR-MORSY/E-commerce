<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="md:flex">
                    <div class="md:w-1/2">
                        <div class="h-96 bg-gray-200 flex items-center justify-center">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                            @else
                                <svg class="w-48 h-48 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            @endif
                        </div>
                    </div>
                    <div class="md:w-1/2 p-8">
                        <div class="mb-4">
                            <span class="text-sm text-indigo-600 font-medium">{{ $product->category->name }}</span>
                        </div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                        
                        <div class="mb-6">
                            <div class="flex items-center space-x-4">
                                <span class="text-3xl font-bold text-indigo-600">${{ number_format($product->price, 2) }}</span>
                                @if($product->compare_price)
                                    <span class="text-xl text-gray-500 line-through">${{ number_format($product->compare_price, 2) }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-6">
                            <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                        </div>

                        <div class="mb-6">
                            <div class="flex items-center space-x-4 mb-4">
                                <label class="text-sm font-medium text-gray-700">Quantity:</label>
                                <div class="flex items-center border border-gray-300 rounded-lg">
                                    <button 
                                        wire:click="decrementQuantity"
                                        class="px-3 py-1 hover:bg-gray-100"
                                        {{ $quantity <= 1 ? 'disabled' : '' }}
                                    >
                                        -
                                    </button>
                                    <input 
                                        type="number" 
                                        wire:model="quantity" 
                                        min="1" 
                                        max="{{ $product->quantity }}"
                                        class="w-16 text-center border-0 focus:ring-0"
                                    >
                                    <button 
                                        wire:click="incrementQuantity"
                                        class="px-3 py-1 hover:bg-gray-100"
                                        {{ $quantity >= $product->quantity ? 'disabled' : '' }}
                                    >
                                        +
                                    </button>
                                </div>
                                <span class="text-sm text-gray-600">
                                    {{ $product->quantity }} available
                                </span>
                            </div>
                        </div>

                        <div class="mb-6">
                            <p class="text-sm {{ $product->quantity > 0 ? 'text-green-600' : 'text-red-600' }} font-medium mb-4">
                                {{ $product->quantity > 0 ? '✓ In Stock' : '✗ Out of Stock' }}
                            </p>
                        </div>

                        <div class="flex space-x-4">
                            <button 
                                wire:click="addToCart"
                                class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-colors {{ $product->quantity == 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                {{ $product->quantity == 0 ? 'disabled' : '' }}
                            >
                                Add to Cart
                            </button>
                        </div>

                        @if($product->sku)
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <p class="text-sm text-gray-600">
                                    <span class="font-medium">SKU:</span> {{ $product->sku }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
</div>
