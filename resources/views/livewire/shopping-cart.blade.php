{{-- <div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Shopping Cart</h1>

       
        @if (count($cartItems) > 0)
            
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="divide-y divide-gray-200">
                    @foreach ($cartItems as $key => $item)
                       
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


</div> --}}

{{-- 
<div>
    <div class="@if ($isDrawer) p-4 @else max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 @endif">
        @if (!$isDrawer)
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Shopping Cart</h1>
        @endif

        @if (count($cartItems) > 0)
            <div class="@if ($isDrawer) space-y-4 @else bg-white rounded-lg shadow-lg overflow-hidden @endif">
                @if ($isDrawer)
                    <div class="flex justify-between items-center mb-4 pb-4 border-b">
                        <h2 class="text-xl font-bold text-gray-900">Your Cart</h2>
                        <button @if ($isDrawer) onclick="closeDrawer()" @endif class="btn btn-sm btn-ghost">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                @endif
                
                <div class="@if (!$isDrawer) divide-y divide-gray-200 @endif">
                    @foreach ($cartItems as $key => $item)
                        <div class="@if ($isDrawer) bg-base-100 rounded-lg p-4 mb-3 border @else p-6 flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-6 @endif">
                            <div class="@if ($isDrawer) flex items-start space-x-3 @else flex-shrink-0 @endif">
                                <div class="@if ($isDrawer) h-16 w-16 @else h-24 w-24 @endif bg-gray-200 rounded-lg flex items-center justify-center overflow-hidden">
                                    @if ($item->product->colors->find($item->product_color_id)->hasMedia('color_images'))
                                        <img src="{{ $item->product->colors->find($item->product_color_id)->getColorImageUrl('thumb') }}" 
                                             alt="{{ $item->product->name }}"
                                             class="h-full w-full object-cover">
                                    @else
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    @endif
                                </div>
                                
                                <div class="@if ($isDrawer) flex-1 @endif">
                                    <h3 class="@if ($isDrawer) text-sm font-semibold text-gray-900 line-clamp-1 @else text-lg font-semibold text-gray-900 @endif">
                                        {{ $item->product->name }}
                                    </h3>
                                    @if (!$isDrawer)
                                        <p class="text-sm text-gray-500">{{ $item->product->category->name }}</p>
                                    @endif
                                    
                                    <div class="@if ($isDrawer) text-xs text-gray-600 mt-1 space-y-1 @else mt-2 @endif">
                                        <p>Color: {{ $item->product->colors->find($item->product_color_id)->name }}</p>
                                        <p>Size: {{ $item->product->colors->find($item->product_color_id)->sizes->find($item->product_size_id)->size }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="@if ($isDrawer) mt-3 flex items-center justify-between @else flex-1 min-w-0 mt-4 md:mt-0 @endif">
                                <div class="@if (!$isDrawer) flex items-center space-x-4 @else flex items-center space-x-3 @endif">
                                    <div class="flex items-center border border-gray-300 rounded-lg">
                                        <button wire:click="updateQuantity({{ $item->id ?? $key }}, {{ $item->quantity - 1 }})"
                                                class="px-3 py-1 hover:bg-gray-100 {{ $item->quantity <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                            -
                                        </button>
                                        <span class="px-3 py-1 text-center min-w-[40px]">{{ $item->quantity }}</span>
                                        <button wire:click="updateQuantity({{ $item->id ?? $key }}, {{ $item->quantity + 1 }})"
                                                class="px-3 py-1 hover:bg-gray-100">
                                            +
                                        </button>
                                    </div>

                                    <div class="@if ($isDrawer) text-right @endif">
                                        <p class="@if ($isDrawer) text-sm font-bold text-gray-900 @else text-lg font-bold text-gray-900 @endif">
                                            ${{ number_format($item->quantity * $item->product->base_price, 2) }}
                                        </p>
                                        @if ($isDrawer)
                                            <p class="text-xs text-gray-500">${{ number_format($item->product->base_price, 2) }} each</p>
                                        @endif
                                    </div>
                                </div>

                                <button wire:click="removeItem({{ $item->id ?? $key }})"
                                        class="@if ($isDrawer) ml-2 @else ml-4 @endif text-red-600 hover:text-red-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="@if ($isDrawer) border-t pt-4 mt-4 @else bg-gray-50 px-6 py-6 @endif">
                    <div class="flex justify-between items-center mb-4">
                        <span class="@if ($isDrawer) text-lg font-semibold text-gray-900 @else text-lg font-semibold text-gray-900 @endif">
                            Subtotal:
                        </span>
                        <span class="@if ($isDrawer) text-lg font-bold text-gray-900 @else text-lg font-bold text-gray-900 @endif">
                            ${{ number_format($this->total, 2) }}
                        </span>
                    </div>
                    
                    @if ($isDrawer)
                        <div class="space-y-3">
                            <a href="{{ route('cart') }}"
                               class="block w-full bg-gray-200 hover:bg-gray-300 text-gray-900 text-center px-4 py-3 rounded-lg font-medium transition-colors">
                                View Full Cart
                            </a>
                            <a href="{{ route('checkout') }}"
                               class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white text-center px-4 py-3 rounded-lg font-medium transition-colors">
                                Checkout
                            </a>
                        </div>
                    @else
                        <a href="{{ route('checkout') }}"
                           class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white text-center px-6 py-3 rounded-lg font-medium transition-colors">
                            Proceed to Checkout
                        </a>
                    @endif
                </div>
            </div>
        @else
            <div class="@if ($isDrawer) text-center py-8 @else bg-white rounded-lg shadow-lg p-12 text-center @endif">
                <svg class="@if ($isDrawer) mx-auto h-16 w-16 @else mx-auto h-24 w-24 @endif text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
                <h2 class="@if ($isDrawer) text-lg font-bold text-gray-900 mb-2 @else text-2xl font-bold text-gray-900 mb-2 @endif">
                    Your cart is empty
                </h2>
                <p class="@if ($isDrawer) text-sm text-gray-600 mb-4 @else text-gray-600 mb-6 @endif">
                    Start shopping to add items to your cart.
                </p>
                @if ($isDrawer)
                    <button onclick="closeDrawer()"
                            class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-900 px-4 py-2 rounded-lg font-medium transition-colors">
                        Continue Shopping
                    </button>
                @else
                    <a href="{{ route('home') }}"
                       class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                        Continue Shopping
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>

@if ($isDrawer)
<script>
    function closeDrawer() {
        const drawerCheckbox = document.querySelector('.drawer-toggle');
        if (drawerCheckbox) {
            drawerCheckbox.checked = false;
        }
    }
</script>
@endif --}}



<div>
    <div
        class="@if ($isDrawer) p-4 h-full flex flex-col @else max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 @endif bg-base-100">

        <!-- Header -->
        @if ($isDrawer)
            <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900">Your Cart</h2>
                <button onclick="closeDrawer()" class="btn btn-ghost btn-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="flex-1 overflow-y-auto">
            @else
                <div class="mb-8 ">
                    <h1 class="text-3xl font-bold text-gray-900">Shopping Cart</h1>
                    <p class="text-gray-600 mt-2">Review your items and proceed to checkout</p>
                </div>
        @endif

        @if (count($cartItems) > 0)

            @if (!$isDrawer)
                <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                    <!-- Cart Items (Left Column for standalone) -->
                    <div class="lg:col-span-8">
            @endif

            <!-- Cart Items Container -->
            <div
                class="@if ($isDrawer) space-y-4 @else bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden @endif">

                @if (!$isDrawer)
                    <!-- Cart Header for standalone -->
                    <div class="bg-secondary px-6 py-4 border-b border-gray-200">
                        <div class="flex justify-between items-center ">
                            <h2 class="text-lg font-semibold text-white">Your Items ({{ count($cartItems) }})</h2>
                            <button wire:click="clearCart"
                                class="text-sm text-primary-content hover:text-red-800 font-medium">
                                Clear Cart
                            </button>
                        </div>
                    </div>
                @endif

                <!-- Cart Items List -->
                <div class="@if (!$isDrawer) divide-y divide-gray-100 bg-base-200 @endif">
                    @foreach ($cartItems as $key => $item)
                        <div
                            class="@if ($isDrawer) bg-base-100 rounded-lg p-4 border border-gray-200 @else p-6 hover:bg-base-100 transition-colors duration-200 @endif">
                            <div class="flex gap-4 ">
                                <!-- Product Image -->
                                <div class="flex-shrink-0">
                                    <div
                                        class="@if ($isDrawer) h-20 w-20 @else h-32 w-32 @endif rounded-lg overflow-hidden bg-gray-100 border border-gray-200">
                                        @if ($item->product->colors->find($item->product_color_id)->hasMedia('color_images'))
                                            <img src="{{ $item->product->colors->find($item->product_color_id)->getColorImageUrl('thumb') }}"
                                                alt="{{ $item->product->name }}" class="h-full w-full object-cover">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center">
                                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Product Details -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-col h-full">
                                        <!-- Product Title -->
                                        <div class="flex-1">
                                            <div class="flex justify-between">
                                                <div>
                                                    <h3
                                                        class="@if ($isDrawer) text-sm font-semibold text-gray-900 line-clamp-1 @else text-lg font-semibold text-gray-900 @endif">
                                                        @if (!$isDrawer)
                                                            <a href="{{ route('product.detail', $item->product->slug) }}"
                                                                class="hover:text-indigo-600 transition-colors">
                                                                {{ $item->product->name }}
                                                            </a>
                                                        @else
                                                            {{ Str::limit($item->product->name, 25) }}
                                                        @endif
                                                    </h3>
                                                    @if (!$isDrawer)
                                                        <p class="text-sm text-gray-500 mt-1">
                                                            {{ $item->product->category->name }}</p>
                                                    @endif
                                                </div>
                                                <div class="text-right">
                                                    <p
                                                        class="@if ($isDrawer) text-base font-bold text-gray-900 @else text-lg font-bold text-gray-900 @endif">
                                                        ${{ number_format($item->quantity * $item->product->getFinalPrice(), 2) }}
                                                    </p>
                                                    @if ($item->product->discount > 0 && !$isDrawer)
                                                        <p class="text-sm text-gray-500 line-through">
                                                            ${{ number_format($item->quantity * $item->product->base_price, 2) }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Variants -->
                                            <div
                                                class="@if ($isDrawer) mt-2 @else mt-4 @endif flex flex-wrap gap-2">
                                                <div
                                                    class="inline-flex items-center @if ($isDrawer) px-2 py-1 text-xs @else px-3 py-1.5 text-sm @endif rounded-full bg-gray-100 text-gray-800">
                                                    <span class="w-2 h-2 rounded-full mr-1.5"
                                                        style="background-color: {{ $item->product->colors->find($item->product_color_id)->hex_code ?? '#6b7280' }}"></span>
                                                    {{ $item->product->colors->find($item->product_color_id)->name }}
                                                </div>
                                                <div
                                                    class="inline-flex items-center @if ($isDrawer) px-2 py-1 text-xs @else px-3 py-1.5 text-sm @endif rounded-full bg-gray-100 text-gray-800">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                    </svg>
                                                    {{ $item->product->colors->find($item->product_color_id)->sizes->find($item->product_size_id)->size }}
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Quantity Controls & Actions -->
                                        <div
                                            class="flex items-center justify-between @if ($isDrawer) mt-3 pt-3 border-t border-gray-100 @else mt-4 pt-4 border-t border-gray-100 @endif">
                                            <div
                                                class="flex items-center @if ($isDrawer) space-x-3 @else space-x-4 @endif">
                                                <div
                                                    class="flex items-center border border-gray-300 rounded-lg bg-white">
                                                    <button
                                                        wire:click="updateQuantity({{ $item->id ?? $key }}, {{ $item->quantity - 1 }})"
                                                        class="@if ($isDrawer) px-2 py-1 @else px-3 py-2 @endif hover:bg-gray-100 rounded-l-lg transition-colors {{ $item->quantity <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                        {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M20 12H4" />
                                                        </svg>
                                                    </button>
                                                    <span
                                                        class="@if ($isDrawer) px-2 py-1 text-center min-w-[40px] @else px-4 py-2 text-center min-w-[60px] @endif font-medium">
                                                        {{ $item->quantity }}
                                                    </span>
                                                    <button
                                                        wire:click="updateQuantity({{ $item->id ?? $key }}, {{ $item->quantity + 1 }})"
                                                        class="@if ($isDrawer) px-2 py-1 @else px-3 py-2 @endif hover:bg-gray-100 rounded-r-lg transition-colors">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M12 4v16m8-8H4" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                @if (!$isDrawer)
                                                    <div class="text-sm text-gray-600">
                                                        <p class="font-medium">
                                                            ${{ number_format($item->product->getFinalPrice($item->product->colors->find($item->product_color_id)->sizes->find($item->product_size_id)->price_adjustment), 2) }}
                                                            each</p>
                                                        <p class="text-xs text-gray-500">Stock:
                                                            {{ $item->product->colors->find($item->product_color_id)->sizes->find($item->product_size_id)->quantity }}
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>

                                            <button wire:click="removeItem({{ $item->id ?? $key }})"
                                                class="text-red-600 hover:text-red-800 hover:bg-red-50 @if ($isDrawer) p-1 @else p-2 @endif rounded-lg transition-colors"
                                                title="Remove item">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            @if (!$isDrawer)
                <!-- Continue Shopping for standalone -->
                <div class="mt-6">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Continue Shopping
                    </a>
                </div>
    </div> <!-- Close left column for standalone -->

    <!-- Order Summary (Right Column for standalone) -->
    <div class="lg:col-span-4 mt-8 lg:mt-0">
        <div class="bg-base-200 rounded-xl shadow-sm border border-gray-200 sticky top-8">
            <div class="p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Order Summary</h2>

                <!-- Price Breakdown -->
                <div class="space-y-3">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal ({{ count($cartItems) }} items)</span>
                        {{-- <span>${{ number_format($this->subtotal, 2) }}</span> --}}
                    </div>

                    {{-- @if ($this->totalDiscount > 0)
                                <div class="flex justify-between text-green-600">
                                    <span>Discount</span>
                                    <span>- ${{ number_format($this->totalDiscount, 2) }}</span>
                                </div>
                                @endif --}}

                    <div class="flex justify-between text-gray-600">
                        <span>Shipping</span>
                        <span class="text-sm">Calculated at checkout</span>
                    </div>

                    <div class="flex justify-between text-gray-600">
                        <span>Tax</span>
                        <span class="text-sm">Calculated at checkout</span>
                    </div>
                </div>

                <!-- Total -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex justify-between items-center text-lg font-bold text-gray-900">
                        <span>Total</span>
                        <span>${{ number_format($this->total, 2) }}</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">USD</p>
                </div>

                <!-- Checkout Button -->
                {{-- <a href="{{ route('checkout') }}"
                    class="mt-6 block w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-center px-6 py-4 rounded-lg font-semibold text-lg transition-all duration-200 transform hover:-translate-y-0.5 shadow-lg hover:shadow-xl">
                    Proceed to Checkout
                </a> --}}
                <a href="{{ route('checkout') }}"
                    class="mt-6 block w-full bg-neutral text-white text-center px-6 py-4 rounded-lg font-semibold text-lg transition-all duration-200 transform hover:-translate-y-0.5 shadow-lg hover:shadow-xl">
                    Proceed to Checkout
                </a>
            </div>
        </div>
    </div>
</div> <!-- Close grid for standalone -->
@else
<!-- For Drawer - Summary at bottom -->
<div class="mt-6 pt-6 border-t border-gray-200">
    <div class="space-y-3">
        <div class="flex justify-between text-gray-600">
            <span>Subtotal ({{ count($cartItems) }} items)</span>
            {{-- <span>${{ number_format($this->subtotal, 2) }}</span> --}}
        </div>
        {{--                     
                    @if ($this->totalDiscount > 0)
                    <div class="flex justify-between text-green-600">
                        <span>Discount</span>
                        <span>- ${{ number_format($this->totalDiscount, 2) }}</span>
                    </div>
                    @endif --}}

        <div class="flex justify-between text-lg font-bold text-gray-900 mt-4 pt-4 border-t border-gray-200">
            <span>Total</span>
            <span>${{ number_format($this->total, 2) }}</span>
        </div>
    </div>

    <div class="mt-6 space-y-3">
        <a href="{{ route('cart') }}"
            class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-900 text-center px-4 py-3 rounded-lg font-medium transition-colors">
            View Full Cart
        </a>
        <a href="{{ route('checkout') }}"
            class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white text-center px-4 py-3 rounded-lg font-medium transition-colors">
            Checkout
        </a>
    </div>
</div>

</div> <!-- Close overflow-y-auto for drawer -->
@endif
@else
<!-- Empty Cart State -->
<div
    class="@if ($isDrawer) h-full flex flex-col items-center justify-center text-center py-8 @else bg-white rounded-2xl shadow-sm border border-gray-200 p-12 text-center max-w-2xl mx-auto @endif">
    <div
        class="@if ($isDrawer) inline-flex items-center justify-center w-16 h-16 bg-indigo-50 rounded-full mb-4 @else inline-flex items-center justify-center w-24 h-24 bg-indigo-50 rounded-full mb-6 @endif">
        <svg class="@if ($isDrawer) w-8 h-8 @else w-12 h-12 @endif text-indigo-600" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
            </path>
        </svg>
    </div>
    <h2
        class="@if ($isDrawer) text-lg font-bold text-gray-900 mb-2 @else text-2xl font-bold text-gray-900 mb-3 @endif">
        Your cart is empty
    </h2>
    <p
        class="@if ($isDrawer) text-sm text-gray-600 mb-6 max-w-xs @else text-gray-600 mb-8 max-w-md mx-auto @endif">
        Looks like you haven't added any items to your cart yet.
    </p>
    @if ($isDrawer)
        <button onclick="closeDrawer()"
            class="w-full bg-gray-100 hover:bg-gray-200 text-gray-900 px-6 py-3 rounded-lg font-medium transition-colors">
            Continue Shopping
        </button>
    @else
        <div class="space-y-4 sm:space-y-0 sm:space-x-4">
            <a href="{{ route('home') }}"
                class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors shadow-md hover:shadow-lg">
                Start Shopping
            </a>
            <a href="{{ route('home', ['category' => 'featured']) }}"
                class="inline-block border-2 border-gray-300 hover:border-gray-400 text-gray-800 hover:text-gray-900 px-8 py-3 rounded-lg font-semibold transition-colors">
                View Featured
            </a>
        </div>
    @endif
</div>
@endif
</div>
</div>

@if ($isDrawer)
    <script>
        function closeDrawer() {
            const drawerCheckbox = document.querySelector('.drawer-toggle');
            if (drawerCheckbox) {
                drawerCheckbox.checked = false;
            }
        }
    </script>
@endif
