<div class="max-w-7xl mx-auto py-6 px-4">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Products</h1>
        <a href="{{ route('admin.products.create') }}" 
           class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-medium">
            Add New Product
        </a>
    </div>

    <!-- Success Message -->
    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-md p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Search</label>
                <input type="text" 
                       wire:model.live.debounce.300ms="search" 
                       placeholder="Search by name, SKU, or description..." 
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Status</label>
                <select wire:model.live="statusFilter" class="w-full border rounded px-3 py-2">
                    <option value="all">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Per Page</label>
                <select wire:model.live="perPage" class="w-full border rounded px-3 py-2">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Image
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                            wire:click="sortByColumn('name')">
                            <div class="flex items-center">
                                Product
                                @if($sortBy === 'name')
                                    <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                            wire:click="sortByColumn('sku')">
                            <div class="flex items-center">
                                SKU
                                @if($sortBy === 'sku')
                                    <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                            wire:click="sortByColumn('base_price')">
                            <div class="flex items-center">
                                Price
                                @if($sortBy === 'base_price')
                                    <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Colors
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Stock
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($product->hasMedia('main_image'))
                                    <img src="{{ $product->getFirstMediaUrl('main_image','medium') }}" 
                                         alt="{{ $product->name }}"
                                         class="w-16 h-16 object-cover rounded">
                                @else
                                    {{-- <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                        <span class="text-gray-400 text-xs">No Image</span>
                                    </div> --}}
                                    <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($product->description, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $product->sku }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                ${{ number_format($product->base_price, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex gap-1">
                                    @foreach($product->colors->take(5) as $color)
                                        <div class="w-6 h-6 rounded-full border border-gray-300" 
                                             style="background-color: {{ $color->hex_code }}"
                                             title="{{ $color->name }}">
                                        </div>
                                    @endforeach
                                    @if($product->colors->count() > 5)
                                        <span class="text-xs text-gray-500 self-center">
                                            +{{ $product->colors->count() - 5 }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium {{ $product->total_stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $product->total_stock }} units
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button wire:click="toggleStatus({{ $product->id }})" 
                                        class="px-3 py-1 rounded-full text-xs font-semibold {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" 
                                       class="text-blue-600 hover:text-blue-900">
                                        Edit
                                    </a>
                                    <button wire:click="deleteProduct({{ $product->id }})"
                                            wire:confirm="Are you sure you want to delete this product?"
                                            class="text-red-600 hover:text-red-900">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                    <p class="text-lg font-medium">No products found</p>
                                    <p class="text-sm mt-1">Get started by creating your first product</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $products->links() }}
        </div>
    </div>
</div>