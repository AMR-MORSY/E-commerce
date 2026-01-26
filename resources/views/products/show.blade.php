<x-layouts.app :seoTitle="$product->name" :seoDescription="Str::limit($product->description, 155)">


    <!-- Breadcrumbs (visible to users and search engines) -->
    <nav class="max-w-7xl mx-auto px-4 py-4 mt-20" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-2 text-sm">
            <li><a href="{{ url('/') }}" class="text-blue-600 hover:underline">Home</a></li>
            @foreach ($product->category->getBreadcrumbs() as $cat)
                <li class="flex items-center">
                    <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" />
                    </svg>
                    <a href="{{ route('category.show', ['categoryPath' => $cat->full_path]) }}"
                        class="text-blue-600 hover:underline">{{ $cat->name }}</a>
                </li>
            @endforeach
            <li class="flex items-center">
                <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" />
                </svg>
                <span class="text-gray-500">{{ $product->name }}</span>
            </li>
        </ol>
    </nav>

    <!-- LIVEWIRE COMPONENT FOR INTERACTIVE FEATURES -->
    @livewire('product-detail', [
        'product' => $product,
        'selectedColor' => $selectedColor,
        'selectedSize' => $selectedSize,
        'currentImages' => $currentImages,
        // 'discountedPrice' => $discountedPrice,
        // 'originalPrice' => $originalPrice,
    ])
</x-layouts.app>
