<div class="drawer lg:drawer-open">
    <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content flex flex-col items-center justify-center">

        <div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Product Management</h1>
                    {{-- <button wire:click="openModal"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                Add New Product
            </button> --}}

                    <button class="btn bg-base-200" onclick="my_modal_1.showModal()">Add New Product</button>

                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-base-200">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Product</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Category</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Price
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Stock
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($products as $product)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $product->category->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">${{ number_format($product->price, 2) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $product->quantity }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button wire:click="edit({{ $product->id }})"
                                            class="text-indigo-600 hover:text-indigo-900 mr-4">
                                            Edit
                                        </button>
                                        <button wire:click="delete({{ $product->id }})"
                                            wire:confirm="Are you sure you want to delete this product?"
                                            class="text-red-600 hover:text-red-900">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="px-6 py-4">
                        {{ $products->links() }}
                    </div>
                </div>

                <dialog id="my_modal_1" class="modal">
                    <div class="modal-box">
                        {{-- <h3 class="text-lg font-bold">Hello!</h3>
                <p class="py-4">Press ESC key or click the button below to close</p> --}}
                        <div class="mt-3">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">
                                {{ $editingId ? 'Edit Product' : 'Add New Product' }}
                            </h3>

                            <form wire:submit.prevent="save">
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                                    <input type="text" wire:model="name"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                    @error('name')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                    <textarea wire:model="description" rows="3"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"></textarea>
                                    @error('description')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Price *</label>
                                        <input type="number" step="0.01" wire:model="price"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                        @error('price')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Compare
                                            Price</label>
                                        <input type="number" step="0.01" wire:model="compare_price"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">SKU</label>
                                        <input type="text" wire:model="sku"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Quantity *</label>
                                        <input type="number" wire:model="quantity"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                        @error('quantity')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                                    <select wire:model="category_id"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="is_active"
                                            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <span class="ml-2 text-sm text-gray-700">Active</span>
                                    </label>
                                </div>

                                <div class="mb-6">
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="is_featured"
                                            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <span class="ml-2 text-sm text-gray-700">Featured</span>
                                    </label>
                                </div>

                                <div class="flex justify-end space-x-4">
                                    <button type="button" wire:click="closeModal"
                                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-action">
                            <form method="dialog">
                                <!-- if there is a button in form, it will close the modal -->
                                <button class="btn">Close</button>
                            </form>
                        </div>
                    </div>
                </dialog>

                @if ($showModal)
                    <div class="fixed inset-0 bg-gray-400 bg-opacity-50 overflow-y-auto h-full w-full z-50"
                        wire:click="closeModal">
                        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white"
                            wire:click.stop>
                            <div class="mt-3">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">
                                    {{ $editingId ? 'Edit Product' : 'Add New Product' }}
                                </h3>

                                <form wire:submit.prevent="save">
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                                        <input type="text" wire:model="name"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                        @error('name')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                        <textarea wire:model="description" rows="3"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"></textarea>
                                        @error('description')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Price *</label>
                                            <input type="number" step="0.01" wire:model="price"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                            @error('price')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Compare
                                                Price</label>
                                            <input type="number" step="0.01" wire:model="compare_price"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">SKU</label>
                                            <input type="text" wire:model="sku"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Quantity
                                                *</label>
                                            <input type="number" wire:model="quantity"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                            @error('quantity')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                                        <select wire:model="category_id"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="flex items-center">
                                            <input type="checkbox" wire:model="is_active"
                                                class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <span class="ml-2 text-sm text-gray-700">Active</span>
                                        </label>
                                    </div>

                                    <div class="mb-6">
                                        <label class="flex items-center">
                                            <input type="checkbox" wire:model="is_featured"
                                                class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <span class="ml-2 text-sm text-gray-700">Featured</span>
                                        </label>
                                    </div>

                                    <div class="flex justify-end space-x-4">
                                        <button type="button" wire:click="closeModal"
                                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                            Cancel
                                        </button>
                                        <button type="submit"
                                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                            Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <label for="my-drawer-3" class="btn drawer-button lg:hidden">
            Open drawer
        </label>
    </div>
    <div class="drawer-side">
        <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="menu bg-base-200 min-h-full w-80 p-4">
            <!-- Sidebar content here -->
            <li><a>Sidebar Item 1</a></li>
            <li><a>Sidebar Item 2</a></li>
        </ul>
    </div>
</div>
