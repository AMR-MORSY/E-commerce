<div class=" flex justify-center items-center gap-1">
    {{-- <a href="{{ route('cart') }}"
        class="relative inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-indigo-700">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
            </path>
        </svg>
        Cart
        <span id="cart-count" class="ml-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
            {{ $cartItemsCount }}
        </span>
    </a> --}}
    <div class="relative">
        <!-- Cart icon -->
        <a class="btn btn-active btn-secondary lg:btn-neutral btn-circle" href="{{ route('cart') }}" >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>

            <!-- Badge -->
            <span class="badge badge-sm badge-primary absolute text-secondary-content lg:text-neutral-content -top-1 -right-1"> {{  $cartItemsCount }}</span>
        </a>
    </div>
    <p class=" text-base text-secondary-content lg:text-neutral-content font-medium hidden lg:block">{{number_format($subtotal,2)}} EGP</p>
</div>
