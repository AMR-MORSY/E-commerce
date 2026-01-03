 {{-- <div class="max-w-7xl mx-auto py-6 px-4">
    <div class="bg-white shadow-md rounded-lg p-6 overflow-y-scroll">
        <h2 class="text-2xl font-bold mb-6">
            {{ $isEdit ? 'Edit Product' : 'Create Product' }}
        </h2>

        <form wire:submit="save">
            <!-- Basic Information -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">Basic Information</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Product Name *</label>
                        <input type="text" wire:model="name"
                            class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>


                    <div>
                        <label class="block text-sm font-medium mb-1">Base Price *</label>
                        <input type="number" step="0.01" wire:model="base_price"
                            class="w-full border rounded px-3 py-2 @error('base_price') border-red-500 @enderror">
                        @error('base_price')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Status</label>
                        <select wire:model="is_active" class="w-full border rounded px-3 py-2">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium mb-1">Description</label>
                    <textarea wire:model="description" rows="3" class="w-full border rounded px-3 py-2"></textarea>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium mb-1">Main Product Image</label>
                    <input type="file" wire:model="main_image" accept="image/*"
                        class="w-full border rounded px-3 py-2">
                    @if ($main_image)
                        <div class="mt-2">
                            <img src="{{ $main_image->temporaryUrl() }}" class="w-32 h-32 object-cover rounded">
                        </div>
                    @elseif ($isEdit && $product->hasMedia('main_image'))
                        <div class="mt-2">
                            <img src="{{ $product->getFirstMediaUrl('main_image') }}"
                                class="w-32 h-32 object-cover rounded">
                        </div>
                    @endif
                    <div wire:loading wire:target="main_image" class="text-sm text-blue-500 mt-1">Uploading...</div>
                </div>
            </div>

            <!-- Colors and Sizes -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-4 border-b pb-2">
                    <h3 class="text-lg font-semibold">Colors & Sizes</h3>
                    <button type="button" wire:click="addColor"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Add Color
                    </button>
                </div>

                @foreach ($colors as $colorIndex => $color)
                    <div class="border rounded-lg p-4 mb-4 bg-gray-50">
                        <div class="flex justify-between items-start mb-4">
                            <h4 class="font-semibold text-md">Color #{{ $colorIndex + 1 }}</h4>
                            <button type="button" wire:click="removeColor({{ $colorIndex }})"
                                class="text-red-500 hover:text-red-700">
                                Remove
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Color Name *</label>
                                <input type="text" wire:model="colors.{{ $colorIndex }}.name"
                                    class="w-full border rounded px-3 py-2">
                                @error("colors.{$colorIndex}.name")
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1">Hex Code *</label>
                                <div class="flex gap-2">
                                    <input type="color" wire:model.live="colors.{{ $colorIndex }}.hex_code"
                                        class="w-16 h-10 border rounded">
                                    <input type="text" wire:model="colors.{{ $colorIndex }}.hex_code"
                                        class="flex-1 border rounded px-3 py-2">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1">Color Image</label>
                             

                                <input type="file" wire:model="colorImages.{{ $colorIndex }}.images"
                                    accept="image/*" multiple
                                    class="w-full border rounded px-3 py-2 text-sm @error('colorImages.' . $colorIndex . '.images.*') border-red-500 @enderror">
                                <x-validation-errors field="colorImages.{{ $colorIndex }}.images" />
                                <div wire:loading wire:target="colorImages.{{ $colorIndex }}.images"
                                    class="text-sm text-blue-500 mt-1">Uploading...</div>
                            </div>
                        </div>

                        <!-- Image Preview -->
                        <div class="mb-4">
                            @if (isset($colorImages[$colorIndex]['images']) && $colorImages[$colorIndex]['images'])
                                <div class="flex flex-wrap gap-2 mt-2">
                                    @foreach ($colorImages[$colorIndex]['images'] as $image)
                                        <img src="{{ $image->temporaryUrl() }}" class="w-24 h-24 object-cover rounded">
                                    @endforeach
                                   
                                @elseif (isset($existingColorImages[$colorIndex]) && $existingColorImages[$colorIndex]->isNotEmpty())
                                    <img src="{{ $existingColorImages[$colorIndex]->first()->getUrl() }}"
                                        class="w-24 h-24 object-cover rounded">
                            @endif
                        </div>
                    </div>

                    <!-- Sizes -->
                    <div>
                        <label class="block text-sm font-medium mb-2">Available Sizes</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-3">
                            @foreach ($availableSizes as $size)
                                <div
                                    class="border rounded p-3 {{ $colors[$colorIndex]['sizes'][$size]['enabled'] ? 'bg-white' : 'bg-gray-100' }}">
                                    <div class="flex items-center mb-2">
                                        <input type="checkbox"
                                            wire:model.live="colors.{{ $colorIndex }}.sizes.{{ $size }}.enabled"
                                            id="size_{{ $colorIndex }}_{{ $size }}" class="mr-2">
                                        <label for="size_{{ $colorIndex }}_{{ $size }}"
                                            class="font-medium">{{ $size }}</label>
                                    </div>

                                    @if ($colors[$colorIndex]['sizes'][$size]['enabled'])
                                        <div class="space-y-2">
                                            <input type="number"
                                                wire:model="colors.{{ $colorIndex }}.sizes.{{ $size }}.quantity"
                                                placeholder="Qty" class="w-full border rounded px-2 py-1 text-sm">
                                            <input type="number" step="0.01"
                                                wire:model="colors.{{ $colorIndex }}.sizes.{{ $size }}.price_adjustment"
                                                placeholder="Price ±" class="w-full border rounded px-2 py-1 text-sm">
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
            </div>
            @endforeach
            <!-- Submit Buttons -->
            <div class="flex gap-3 justify-end  pt-4">
                <a href="{{ route('admin.products.index') }}" class="px-6 py-2 border rounded hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                    {{ $isEdit ? 'Update Product' : 'Create Product' }}
                </button>
            </div>
        </form>
    </div>



</div>  --}}

<div class="max-w-7xl mx-auto py-6 px-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-6">
            {{ $isEdit ? 'Edit Product' : 'Create Product' }}
        </h2>

        <form wire:submit="save">
            <!-- Basic Information -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">Basic Information</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Product Name *</label>
                        <input type="text" wire:model="name"
                            class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Base Price *</label>
                        <input type="number" step="0.01" wire:model="base_price"
                            class="w-full border rounded px-3 py-2 @error('base_price') border-red-500 @enderror">
                        @error('base_price')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Status</label>
                        <select wire:model="is_active" class="w-full border rounded px-3 py-2">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Division</label>
                        <select wire:model.live="division" class="w-full border rounded px-3 py-2">
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                                
                            @endforeach
                           
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Category</label>
                        <select wire:model="category_id" class="w-full border rounded px-3 py-2">
                           @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                           @endforeach
                        </select>
                        @error("category_id")
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium mb-1">Description</label>
                    <textarea wire:model="description" rows="3" class="w-full border rounded px-3 py-2"></textarea>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium mb-1">Main Product Image</label>
                    <input type="file" wire:model="main_image" accept="image/*"
                        class="w-full border rounded px-3 py-2">
                    @if ($main_image)
                        <div class="mt-2">
                            <img src="{{ $main_image->temporaryUrl() }}" class="w-32 h-32 object-cover rounded">
                        </div>
                    @elseif ($isEdit && $product?->hasMedia('main_image'))
                        <div class="mt-2">
                            <img src="{{ $product->getFirstMediaUrl('main_image') }}"
                                class="w-32 h-32 object-cover rounded">
                        </div>
                    @endif
                    <div wire:loading wire:target="main_image" class="text-sm text-blue-500 mt-1">Uploading...</div>
                </div>
            </div>

            <!-- Colors and Sizes -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-4 border-b pb-2">
                    <h3 class="text-lg font-semibold">Colors & Sizes</h3>
                    <button type="button" wire:click="addColor"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Add Color
                    </button>
                </div>

                @if(empty($colors))
                    <div class="text-center py-8 text-gray-500">
                        No colors added yet. Click "Add Color" to get started.
                    </div>
                @else
                    @foreach ($colors as $colorIndex => $color)
                        <div class="border rounded-lg p-4 mb-4 bg-gray-50" wire:key="color-{{ $colorIndex }}">
                            <div class="flex justify-between items-start mb-4">
                                <h4 class="font-semibold text-md">Color #{{ $colorIndex + 1 }}</h4>
                                @if(count($colors) > 1)
                                    <button type="button" wire:click="removeColor({{ $colorIndex }})"
                                        class="text-red-500 hover:text-red-700 text-sm">
                                        Remove Color
                                    </button>
                                @endif
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium mb-1">Color Name *</label>
                                    <input type="text" wire:model="colors.{{ $colorIndex }}.name"
                                        class="w-full border rounded px-3 py-2 text-sm">
                                    @error("colors.{$colorIndex}.name")
                                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium mb-1">Hex Code *</label>
                                    <div class="flex gap-2">
                                        <input type="color" wire:model.live="colors.{{ $colorIndex }}.hex_code"
                                            class="w-16 h-10 border rounded cursor-pointer">
                                        <input type="text" wire:model="colors.{{ $colorIndex }}.hex_code"
                                            class="flex-1 border rounded px-3 py-2 text-sm">
                                    </div>
                                    @error("colors.{$colorIndex}.hex_code")
                                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium mb-1">Color Images</label>
                                    <input type="file" wire:model="colorImages.{{ $colorIndex }}.images"
                                        accept="image/*" multiple
                                        class="w-full border rounded px-3 py-2 text-sm">
                                    
                                    <!-- Image validation errors -->
                                    @error("colorImages.{$colorIndex}.images")
                                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                    
                                    @foreach ($errors->get("colorImages.{$colorIndex}.images.*") as $messages)
                                        @foreach ($messages as $message)
                                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                        @endforeach
                                    @endforeach
                                    
                                    <div wire:loading wire:target="colorImages.{{ $colorIndex }}.images"
                                        class="text-sm text-blue-500 mt-1">Uploading...</div>
                                </div>
                            </div>

                            <!-- Image Preview -->
                            @if(isset($colorImages[$colorIndex]['images']) && count($colorImages[$colorIndex]['images']) > 0)
                                <div class="mb-4">
                                    <p class="text-sm font-medium mb-2">Uploaded Images:</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($colorImages[$colorIndex]['images'] as $imageIndex => $image)
                                            <div class="relative">
                                                <img src="{{ $image->temporaryUrl() }}" 
                                                     class="w-20 h-20 object-cover rounded border">
                                                @error("colorImages.{$colorIndex}.images.{$imageIndex}")
                                                    <div class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                                        !
                                                    </div>
                                                @enderror
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @elseif(isset($existingColorImages[$colorIndex]) && $existingColorImages[$colorIndex]->count() > 0)
                                <div class="mb-4">
                                    <p class="text-sm font-medium mb-2">Existing Images:</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($existingColorImages[$colorIndex] as $image)
                                            <img src="{{ $image->getUrl() }}" 
                                                 class="w-20 h-20 object-cover rounded border">
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Sizes -->
                            <div>
                                <label class="block text-sm font-medium mb-2">Available Sizes</label>
                                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-3">
                                    @foreach ($availableSizes as $size)
                                        <div
                                            class="border rounded p-3 {{ $colors[$colorIndex]['sizes'][$size]['enabled'] ? 'bg-white' : 'bg-gray-100' }}">
                                            <div class="flex items-center mb-2">
                                                <input type="checkbox"
                                                    wire:model.live="colors.{{ $colorIndex }}.sizes.{{ $size }}.enabled"
                                                    id="size_{{ $colorIndex }}_{{ $size }}" class="mr-2">
                                                <label for="size_{{ $colorIndex }}_{{ $size }}"
                                                    class="font-medium text-sm">{{ $size }}</label>
                                            </div>

                                            @if ($colors[$colorIndex]['sizes'][$size]['enabled'])
                                                <div class="space-y-2">
                                                    <div>
                                                        <input type="number"
                                                            wire:model="colors.{{ $colorIndex }}.sizes.{{ $size }}.quantity"
                                                            placeholder="Quantity"
                                                            class="w-full border rounded px-2 py-1 text-sm">
                                                        @error("colors.{$colorIndex}.sizes.{$size}.quantity")
                                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div>
                                                        <input type="number" step="0.01"
                                                            wire:model="colors.{{ $colorIndex }}.sizes.{{ $size }}.price_adjustment"
                                                            placeholder="Price ±"
                                                            class="w-full border rounded px-2 py-1 text-sm">
                                                        @error("colors.{$colorIndex}.sizes.{$size}.price_adjustment")
                                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Submit Buttons - Always visible at bottom -->
            <div class="sticky bottom-0 bg-white border-t pt-4 mt-8">
                <div class="flex gap-3 justify-end">
                    <a href="{{ route('admin.products.index') }}" 
                       class="px-6 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50 transition">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">
                        {{ $isEdit ? 'Update Product' : 'Create Product' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>