<div class="border-l-2 border-gray-200 pl-4" style="margin-left: {{ $level * 20 }}px">
    <div class="flex items-center justify-between py-2 hover:bg-gray-50 rounded px-2">
        <div class="flex items-center space-x-3">
            @if($category->children->count() > 0)
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            @else
                <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            @endif
            <span class="font-medium text-gray-900">{{ $category->name }}</span>
            <span class="text-sm text-gray-500">({{ $category->products()->count() }} products)</span>
        </div>
        <div class="flex items-center space-x-2">
            <a href="{{ route('admin.categories.edit', $category->id) }}" 
               class="text-blue-600 hover:text-blue-900 text-sm">
                Edit
            </a>
        </div>
    </div>
    
    @foreach($category->children as $child)
        @include('components.admin.categories.tree-item', ['category' => $child, 'level' => $level + 1])
    @endforeach
</div>
