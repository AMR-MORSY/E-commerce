{{-- <div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="md:flex">
                <div class="md:w-1/2">
                    <div class="relative w-full aspect-square bg-gray-200 flex items-center justify-center overflow-hidden">
                        @if ($product->hasMedia('main_image'))
                            <img src="{{ $product->getFirstMediaUrl('main_image', 'large') }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover">
                        @else
                            <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
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
                            <span
                                class="text-3xl font-bold text-indigo-600">${{ number_format($product->price, 2) }}</span>
                            @if ($product->compare_price)
                                <span
                                    class="text-xl text-gray-500 line-through">${{ number_format($product->compare_price, 2) }}</span>
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
                                <button wire:click="decrementQuantity" class="px-3 py-1 hover:bg-gray-100"
                                    {{ $quantity <= 1 ? 'disabled' : '' }}>
                                    -
                                </button>
                                <input type="number" wire:model="quantity" min="1"
                                    max="{{ $product->quantity }}" class="w-16 text-center border-0 focus:ring-0">
                                <button wire:click="incrementQuantity" class="px-3 py-1 hover:bg-gray-100"
                                    {{ $quantity >= $product->quantity ? 'disabled' : '' }}>
                                    +
                                </button>
                            </div>
                            <span class="text-sm text-gray-600">
                                {{ $product->quantity }} available
                            </span>
                        </div>
                    </div>

                    <div class="mb-6">
                        <p
                            class="text-sm {{ $product->quantity > 0 ? 'text-green-600' : 'text-red-600' }} font-medium mb-4">
                            {{ $product->quantity > 0 ? '✓ In Stock' : '✗ Out of Stock' }}
                        </p>
                    </div>

                    <div class="flex space-x-4">
                        <button wire:click="addToCart"
                            class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-colors {{ $product->quantity == 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                            {{ $product->quantity == 0 ? 'disabled' : '' }}>
                            Add to Cart
                        </button>
                    </div>

                    @if ($product->sku)
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
</div> --}}

{{-- resources/views/livewire/frontend/product-view.blade.php --}}
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- Left Side: Image Carousel -->
        <div class="space-y-4">
            <!-- Main Image Display -->
            <div class="relative bg-gray-100 rounded-lg overflow-hidden aspect-square">
                @if ($currentImages->isNotEmpty())
                    <img src="{{ $currentImages[$currentImageIndex]->getUrl('large') }}" alt="{{ $product->name }}"
                        class="w-full h-full object-cover">

                    <!-- Navigation Arrows -->
                    @if ($currentImages->count() > 1)
                        <button wire:click="previousImage"
                            class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-3 rounded-full shadow-lg transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>

                        <button wire:click="nextImage"
                            class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-3 rounded-full shadow-lg transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                        <!-- Image Counter -->
                        <div class="absolute bottom-4 right-4 bg-black/60 text-white px-3 py-1 rounded-full text-sm">
                            {{ $currentImageIndex + 1 }} / {{ $currentImages->count() }}
                        </div>
                    @endif

                    <!-- Zoom Icon -->
                    <div class="absolute top-4 right-4 bg-white/80 p-2 rounded-full cursor-pointer hover:bg-white transition"
                        onclick="document.getElementById('zoom-modal').classList.remove('hidden')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7" />
                        </svg>
                    </div>
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                        <span>No image available</span>
                    </div>
                @endif
            </div>

            <!-- Thumbnail Navigation -->
            @if ($currentImages->count() > 1)
                <div class="flex gap-2 overflow-x-auto pb-2">
                    @foreach ($currentImages as $index => $image)
                        <button wire:click="setImageIndex({{ $index }})"
                            class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden border-2 transition {{ $currentImageIndex === $index ? 'border-blue-500' : 'border-gray-200 hover:border-gray-400' }}">
                            <img src="{{ $image->getUrl('thumb') }}" alt="View {{ $index + 1 }}"
                                class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Right Side: Product Details -->
        <div class="space-y-6">
            <!-- Product Info -->
            <p class=" text-3xl  text-accent-content font-bold">{{ $product->name }}</p>
            <!-- Price Section -->
            <div class="flex items-center gap-4 mb-2">
                @if ($product->has_discount)
                    <!-- Discounted Price -->
                    <div class="text-base font-bold text-accent-content">
                        EGP {{ number_format($discountedPrice, 2) }}
                    </div>
                    <!-- Original Price -->
                    <div class="text-base text-accent-content  line-through">
                        EGP{{ number_format($originalPrice, 2) }}
                    </div>
                    <!-- Discount Badge -->
                    <div class="bg-neutral text-white px-3 py-1 rounded-full text-sm font-semibold">
                        -{{ $product->getDiscountPercentage() }}%
                    </div>
                @else
                    <div class="text-base font-bold text-neutral">
                        EGP {{ number_format($discountedPrice, 2) }}
                    </div>
                    @if ($selectedSize && $selectedSize->price_adjustment != 0)
                        <div class="text-base text-neutral">
                            Base: EGP {{ number_format($product->base_price, 2) }}
                        </div>
                    @endif
                @endif
            </div>

            @if ($product->description)
                <div class="prose prose-sm">
                    <p class="text-neutral">{{ $product->description }}</p>
                </div>
            @endif

            <!-- Flash Messages -->
            @if (session()->has('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Color Selection -->
            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-3">
                    Color:
                    @if ($selectedColor)
                        <span class="font-normal text-gray-600">{{ $selectedColor->name }}</span>
                    @endif
                </label>
                <div class="flex flex-wrap gap-3">
                    @foreach ($product->colors as $color)
                        <button wire:click="selectColor({{ $color->id }})" class="group relative">
                            <!-- Color Image -->
                            <div
                                class="w-20 h-20 rounded-lg overflow-hidden border-2 transition {{ $selectedColor && $selectedColor->id === $color->id ? 'border-blue-500 ring-2 ring-blue-200' : 'border-gray-200 hover:border-gray-400' }}">
                                @if ($color->hasMedia('color_images'))
                                    <img src="{{ $color->getColorImageUrl('thumb') }}" alt="{{ $color->name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center"
                                        style="background-color: {{ $color->hex_code }}">
                                    </div>
                                @endif
                            </div>

                            <!-- Color Name Tooltip -->
                            <div
                                class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2 py-1 bg-gray-900 text-white text-xs rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition pointer-events-none">
                                {{ $color->name }}
                            </div>

                            <!-- Stock Indicator -->
                            @if ($color->total_quantity === 0)
                                <div class="absolute inset-0 bg-white/80 flex items-center justify-center rounded-lg">
                                    <span class="text-xs font-semibold text-red-600">Out of Stock</span>
                                </div>
                            @endif
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Size Selection -->
            @if ($selectedColor)
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-3">
                        Size:
                        @if ($selectedSize)
                            <span class="font-normal text-gray-600">{{ $selectedSize->size }}</span>
                        @endif
                    </label>
                    <div class="grid grid-cols-4 gap-2">
                        @foreach ($selectedColor->sizes as $size)
                            <button wire:click="selectSize({{ $size->id }})"
                                @if ($size->quantity === 0) disabled @endif
                                class="relative px-4 py-3 text-center border-2 rounded-lg font-medium transition
                                           {{ $selectedSize && $selectedSize->id === $size->id
                                               ? 'border-neutral bg-base-200'
                                               : ($size->quantity > 0
                                                   ? 'border-gray-200 hover:border-gray-400 text-gray-900'
                                                   : 'border-gray-200 bg-gray-100 text-gray-400 cursor-not-allowed') }}">
                                {{ $size->size }}
                                {{--                                 
                                @if ($size->quantity === 0)
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="w-full h-0.5 bg-red-500 rotate-45"></div>
                                    </div>
                                @elseif($size->quantity < 5)
                                    <div class="absolute -top-1 -right-1 w-2 h-2 bg-orange-500 rounded-full"></div>
                                @endif --}}
                            </button>
                        @endforeach
                    </div>

                    @if ($selectedSize)
                        <div class="mt-2 text-sm text-gray-600">
                            @if ($selectedSize->quantity < 5)
                                <span class="text-orange-600 font-medium">Only {{ $selectedSize->quantity }} left in
                                    stock</span>
                            @else
                                <span class="text-green-600">In stock ({{ $selectedSize->quantity }} available)</span>
                            @endif
                        </div>
                    @endif
                </div>
            @endif

            <!-- Quantity Selector -->
            @if ($selectedSize)
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-3">Quantity</label>
                    <div class="flex items-center gap-3">
                        <button wire:click="decrementQuantity" @if ($quantity <= 1) disabled @endif
                            class="w-10 h-10 border-neutral border-2 rounded-lg flex items-center justify-center hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                        </button>

                        <input type="number" wire:model="quantity" min="1" max="{{ $selectedSize->quantity }}"
                            class="w-20 text-center border-neutral border-2 rounded-lg px-3 py-2 font-medium">

                        <button wire:click="incrementQuantity" @if ($quantity >= $selectedSize->quantity) disabled @endif
                            class="w-10 h-10 border-neutral border-2 rounded-lg flex items-center justify-center hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            <!-- Add to Cart Button -->
            <button wire:click="addToCart" @if (!$selectedColor || !$selectedSize || $selectedSize->quantity === 0) disabled @endif
                class="mt-6 block w-full bg-neutral cursor-pointer text-white text-center px-6 py-4 rounded-lg font-semibold text-lg transition-all duration-200 transform hover:-translate-y-0.5 shadow-lg hover:shadow-xl">

                <span class="loading loading-spinner text-white" wire:loading wire:target="addToCart"></span>

                @if (!$selectedColor || !$selectedSize)
                    Select Color & Size
                @elseif($selectedSize->quantity === 0)
                    Out of Stock
                @else
                    Add to Cart
                @endif
            </button>

            <!-- Product Features -->
            <div class="border-t pt-6 space-y-3">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="text-sm text-gray-600">Free shipping on orders over $50</span>
                </div>
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="text-sm text-gray-600">Easy 30-day returns</span>
                </div>
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="text-sm text-gray-600">Secure payment options</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Zoom Modal -->
    <div id="zoom-modal" class="hidden fixed inset-0 bg-black/90 z-50 flex items-center justify-center p-4"
        onclick="this.classList.add('hidden')">
        @if ($currentImages->isNotEmpty())
            <img src="{{ $currentImages[$currentImageIndex]->getUrl('zoom') }}" alt="{{ $product->name }}"
                class="max-w-full max-h-full object-contain">
        @endif
        <button class="absolute top-4 right-4 text-white hover:text-gray-300">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

</div>

@push('scripts')
    <script>
        // Keyboard navigation for carousel
        document.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowLeft') {
                @this.call('previousImage');
            } else if (e.key === 'ArrowRight') {
                @this.call('nextImage');
            } else if (e.key === 'Escape') {
                document.getElementById('zoom-modal').classList.add('hidden');
            }
        });
    </script>
@endpush
