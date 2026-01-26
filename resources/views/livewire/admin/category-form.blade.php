<div class="container mx-auto px-4 py-8 mt-20">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">
                {{ $isEditMode ? 'Edit Category' : 'Create New Category' }}
            </h1>
            <p class="text-gray-600 mt-2">
                {{ $isEditMode ? 'Update category information and SEO settings' : 'Add a new category to your store' }}
            </p>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow p-6">
            <form wire:submit.prevent="save">
                <!-- Basic Information -->
                <div class="space-y-6 mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 border-b pb-2">Basic Information</h2>

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Category Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" wire:model.live="name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                            placeholder="e.g., Men's T-Shirts">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                            URL Slug <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-2">
                            <input type="text" id="slug" wire:model="slug"
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                placeholder="e.g., mens-tshirts">
                            <button type="button" wire:click="generateSlug"
                                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                                Generate
                            </button>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Used in URLs. Will be auto-generated from name if left
                            empty.</p>
                        @error('slug')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Parent Category -->
                    <div>
                        <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Parent Category (Optional)
                        </label>
                        <select id="parent_id" wire:model="parent_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">None (Top Level Category)</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @foreach ($category->children as $child)
                                    <option value="{{ $child->id }}">— {{ $child->name }}</option>
                                    @foreach ($child->children as $grandchild)
                                        <option value="{{ $grandchild->id }}">—— {{ $grandchild->name }}</option>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </select>
                        @error('parent_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description (Optional)
                        </label>
                        <textarea id="description" wire:model="description" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                            placeholder="Brief description of this category..."></textarea>
                        <p class="mt-1 text-xs text-gray-500">This will be displayed on the category page.</p>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="is_active" class="block text-sm font-medium text-gray-700 mb-2">
                            Active:
                        </label>
                        <input type="checkbox"  wire:model="is_active" class="toggle toggle-secondary" />
                      
                    </div>
                </div>

                <!-- SEO Settings -->
                <div class="space-y-6 mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 border-b pb-2">SEO Settings</h2>

                    <!-- Meta Title -->
                    <div>
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">
                            Meta Title (Optional)
                        </label>
                        <input type="text" id="meta_title" wire:model="meta_title"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                            placeholder="e.g., Buy Men's T-Shirts Online" maxlength="60">
                        <p class="mt-1 text-xs text-gray-500">
                            Recommended: 50-60 characters. Leave empty to use category name.
                            <span class="font-medium">{{ strlen($meta_title) }}/60</span>
                        </p>
                        @error('meta_title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Meta Description -->
                    <div>
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">
                            Meta Description (Optional)
                        </label>
                        <textarea id="meta_description" wire:model="meta_description" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                            placeholder="Brief description for search engines..." maxlength="160"></textarea>
                        <p class="mt-1 text-xs text-gray-500">
                            Recommended: 150-160 characters.
                            <span class="font-medium">{{ strlen($meta_description) }}/160</span>
                        </p>
                        @error('meta_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Meta Keywords -->
                    <div>
                        <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-2">
                            Meta Keywords (Optional)
                        </label>
                        <input type="text" id="meta_keywords" wire:model="meta_keywords"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                            placeholder="e.g., tshirts, mens clothing, casual wear">
                        <p class="mt-1 text-xs text-gray-500">Comma-separated keywords relevant to this category.</p>
                        @error('meta_keywords')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Preview -->
                @if ($name || $meta_description)
                    <div class="mb-8 p-4 bg-gray-50 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-700 mb-2">Search Engine Preview</h3>
                        <div class="space-y-1">
                            <div class="text-blue-600 text-lg">
                                {{ $meta_title ?: $name }} | {{ config('app.name') }}
                            </div>
                            <div class="text-green-700 text-sm">
                                {{ url('/') }}/{{ $slug ?: Str::slug($name) }}
                            </div>
                            <div class="text-gray-600 text-sm">
                                {{ $meta_description ?: ($description ? Str::limit($description, 155) : 'Shop ' . $name . ' at ' . config('app.name')) }}
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Actions -->
                <div class="flex justify-end space-x-3 pt-6 border-t">
                    <a href="{{ route('admin.categories.index') }}"
                        class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <span wire:loading.remove wire:target="save">
                            {{ $isEditMode ? 'Update Category' : 'Create Category' }}
                        </span>
                        <span wire:loading wire:target="save">
                            Saving...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
