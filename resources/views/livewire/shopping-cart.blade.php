<div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Shopping Cart</h1>

        @if (count($cartItems) > 0)
            {{-- @dd($cartItems) --}}
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="divide-y divide-gray-200">
                    @foreach ($cartItems as $key => $item)
                        @php
                            $item = is_array($item) ? (object) $item : $item;
                            $product = is_array($item->product ?? null) ? (object) $item->product : $item->product;
                        @endphp
                        <div
                            class="p-6 flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-6">
                            <div class="flex-shrink-0">
                                <div class="h-24 w-24 bg-gray-200 rounded-lg flex items-center justify-center">
                                    @if ($item->product->colors->find($item->product_color_id)->hasMedia('color_images'))
                                        <img src="{{$item->product->colors->find($item->product_color_id)->getColorImageUrl('thumb') }}"  alt="{{ $item->product->name }}"
                                            class="h-full w-full object-cover rounded-lg">
                                           
                                    @else
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    @endif
                                </div>
                                <p class=" mt-5">Color:{{$item->product->colors->find($item->product_color_id)->name}}</p>
                                <p class=" mt-5">Size:{{$item->product->colors->find($item->product_color_id)->sizes->find($item->product_size_id)->size}}</p>
                            </div>

                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $item->product->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $item->product->category->name }}</p>
                                <p class="text-lg font-bold text-indigo-600 mt-2">
                                    ${{ number_format($item->product->base_price, 2) }}</p>
                                  
                            </div>
                          

                            <div class="flex items-center space-x-4">
                                <div class="flex items-center border border-gray-300 rounded-lg">
                                    @auth
                                        <button wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})"
                                            class="px-3 py-1 hover:bg-gray-100"
                                            {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                            -
                                        </button>
                                        <span class="px-4 py-1">{{ $item->quantity }}</span>
                                        <button wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})"
                                            class="px-3 py-1 hover:bg-gray-100">
                                            +
                                        </button>
                                    @else
                                        <button wire:click="updateQuantity({{ $key }}, {{ $item->quantity - 1 }})"
                                            class="px-3 py-1 hover:bg-gray-100"
                                            {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                            -
                                        </button>
                                        <span class="px-4 py-1">{{ $item->quantity }}</span>
                                        <button
                                            wire:click="updateQuantity({{ $key }}, {{ $item->quantity + 1 }})"
                                            class="px-3 py-1 hover:bg-gray-100">
                                            +
                                        </button>

                                    @endauth

                                </div>

                                <div class="text-right">
                                    <p class="text-lg font-bold text-gray-900">
                                        ${{ number_format($item->quantity * $item->product->base_price, 2) }}</p>
                                </div>
                                @auth
                                    <button wire:click="removeItem({{ $item->id }})"
                                        class="text-red-600 hover:text-red-800 ml-4">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                @else
                                   <button wire:click="removeItem({{ $key }})"
                                    class="text-red-600 hover:text-red-800 ml-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                                @endauth


                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="bg-gray-50 px-6 py-6">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-lg font-semibold text-gray-900">Subtotal:</span>
                        <span class="text-lg font-bold text-gray-900">${{ number_format($this->total, 2) }}</span>
                    </div>
                    <a href="{{ route('checkout') }}"
                        class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white text-center px-6 py-3 rounded-lg font-medium transition-colors">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-lg p-12 text-center">
                <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
                <p class="text-gray-600 mb-6">Start shopping to add items to your cart.</p>
                <a href="{{ route('home') }}"
                    class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    Continue Shopping
                </a>
            </div>
        @endif
    </div>


</div>
