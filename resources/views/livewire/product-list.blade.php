<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Our Products</h1>
                
                <div class="flex flex-col md:flex-row gap-4 mb-6">
                    <div class="flex-1">
                        <input 
                            type="text" 
                            wire:model.live.debounce.300ms="search" 
                            placeholder="Search products..." 
                            class="input"
                        >
                    </div>
                    
                    <select 
                        wire:model.live="categoryFilter" 
                        class="select"
                    >
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    
                    <select 
                        wire:model.live="sortBy" 
                       class="select"
                    >
                        <option value="latest">Latest</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                        <option value="name">Name: A to Z</option>
                    </select>
                </div>
            </div>

            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                 
                  
                    @foreach($products as $product)
                        <div class="card bg-base-100  shadow-sm">
                            <a href="{{ route('product.detail', $product->slug) }}">
                                <div class="h-48 bg-gray-200 flex items-center justify-center">
                                    @if($product->image)
                                        <figure><img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" /></figure>
                                      
                                    @else
                               
                                        <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                   
                                       
                                    @endif
                                </div>
                            </a>
                            <div class="card-body">
                                <a href="{{ route('product.detail', $product->slug) }}">
                                    <h2 class="card-title">{{ $product->name }}</h2>
                                </a>
                                <p class="text-sm text-gray-500 mb-2">{{ $product->category->name }}</p>
                                <div class="flex items-center justify-between mb-3">
                                    <div>
                                        <span class="text-xl font-bold">${{ number_format($product->price, 2) }}</span>
                                        @if($product->compare_price)
                                            <span class="text-sm line-through ml-2">${{ number_format($product->compare_price, 2) }}</span>
                                        @endif
                                    </div>
                                </div>
                                <p class="text-sm mb-3 line-clamp-2">{{ Str::limit($product->description, 100) }}</p>
                                <div class="flex items-center justify-between card-actions">
                                    <span class="text-sm {{ $product->quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $product->quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                                    </span>
                                    <button 
                                        wire:click="addToCart({{ $product->id }})"
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ $product->quantity == 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                        {{ $product->quantity == 0 ? 'disabled' : '' }}
                                    >
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">No products found.</p>
                </div>
            @endif
        </div>
</div>
