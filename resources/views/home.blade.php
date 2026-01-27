<x-layouts.app seoTitle="Shop Quality Products Online"
    seoDescription="Discover amazing products at great prices. Free shipping on orders over $50. Shop clothing, footwear, accessories and more."
    :seoCanonical="url('/')" seoKeywords="online shopping, clothing, footwear, accessories, electronics, free shipping">

    {{-- <style>
        .our-products {
            font-family: "DynaPuff", system-ui;
            font-weight: 600;
            /* or 700 for bolder */
            font-size: 60px;
            /* Adjust as needed */
            color: #222;
            /* Dark gray for contrast */
        }
    </style> --}}

    <div>
        <div class="hero min-h-[50vh]">
            <div class="hero-overlay bg-secondary"></div>
            <div class="hero-content text-neutral-content text-center">
                <div class="max-w-md">

                    <span class="text-rotate text-5xl">
                        <span class="justify-items-center">
                            <span>DESIGN</span>
                            <span>DEVELOP</span>
                            <span>DEPLOY</span>
                            <span>SCALE</span>
                            <span>MAINTAIN</span>
                            <span>REPEAT</span>
                        </span>
                    </span>
                    <p class="mb-5">
                        Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem
                        quasi. In deleniti eaque aut repudiandae et a id nisi.
                    </p>
                    <button class="btn btn-primary">Get Started</button>
                </div>
                <div class="hover-3d">

                    <!-- content -->
                    <figure class="max-w-100 rounded-2xl">
                        <img src="{{ asset('storage/images/sheko.jpg') }}" alt="3D card" />
                    </figure>
                    <!-- 8 empty divs needed for the 3D effect -->
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="mb-8">
                <h1 class=" text-bold text-8xl mb-4 ">Our Products</h1>

                {{-- <div class="flex flex-col md:flex-row gap-4 mb-6">
                    <div class="flex-1">
                        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search products..."
                            class="input">
                    </div>
    
                    <select wire:model.live="categoryFilter" class="select">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
    
                    <select wire:model.live="sortBy" class="select">
                        <option value="latest">Latest</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                        <option value="name">Name: A to Z</option>
                    </select>
                </div> --}}
            </div>

            @if ($featuredProducts->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">


                    @foreach ($featuredProducts as $product)
                        <div class="card bg-base-100  shadow-sm">
                            <a
                                href="{{ route('product.show', [
                                    'categoryPath' => $product->category->full_path,
                                    'product' => $product->slug,
                                ]) }}">
                                <div
                                    class="relative w-full aspect-square bg-gray-200 flex items-center justify-center overflow-hidden">
                                    @if ($product->hasMedia('main_image'))
                                        <img src="{{ $product->getFirstMediaUrl('main_image', 'medium') }}"
                                            alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    @endif
                                </div>
                            </a>
                            <div class="card-body">
                                <a
                                    href="{{ route('product.show', [
                                        'categoryPath' => $product->category->full_path,
                                        'product' => $product->slug,
                                    ]) }}">
                                    <h2 class="card-title">{{ $product->name }}</h2>
                                </a>
                                <p class=" text-neutral mb-2">{{ $product->category->name }}</p>
                                {{-- <div class="flex items-center justify-between mb-3">
                                    <div>
                                        <span class="text-xl font-bold">${{ number_format($product->getFinalPrice(), 2) }}</span>
                                      
                                    </div>
                                </div> --}}
                                <div class="flex items-center gap-4 mb-2">
                                    @if ($product->has_discount)
                                        <!-- Discounted Price -->
                                        <div class=" font-bold text-neutral">
                                            EGP {{ number_format($product->getFinalPrice()) }}
                                        </div>
                                        <!-- Original Price -->
                                        <div class=" text-neutral line-through">
                                            {{ number_format($product->base_price) }}
                                        </div>
                                        <!-- Discount Badge -->

                                        <div class="bg-neutral text-white px-3 py-1 rounded-full text-sm font-semibold">
                                            -{{ $product->getDiscountPercentage() }}%
                                        </div>
                                    @else
                                        {{-- <div class="text-3xl font-bold text-blue-600">
                                            ${{ number_format($discountedPrice, 2) }}
                                        </div> --}}

                                        <div class=" font-bold text-neutral">
                                            EGP {{ number_format($product->base_price) }}
                                        </div>
                                    @endif
                                </div>

                                <p class=" text-base-content mb-3 line-clamp-2">{{ Str::limit($product->description, 100) }}</p>
                                <div class="flex items-center justify-between card-actions">
                                    <span
                                        class="text-sm {{ $product->total_stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $product->total_stock > 0 ? 'In Stock' : 'Out of Stock' }}
                                    </span>
                                    {{-- <button wire:click="addToCart({{ $product->id }})"
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ $product->quantity == 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                        {{ $product->quantity == 0 ? 'disabled' : '' }}>
                                        Add to Cart
                                    </button> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">No products found.</p>
                </div>
            @endif
        </div>
    </div>

   

</x-layouts.app>
