<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class CategoryIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $deleteConfirmId = null;
    public $showDeleteModal = false;

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($categoryId)
    {
        $this->deleteConfirmId = $categoryId;
        $this->showDeleteModal = true;
    }
    public function render()
    {
        $categories = Category::with(['parent', 'children'])
        ->when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('slug', 'like', '%' . $this->search . '%');
        })
        ->orderBy('parent_id')
        ->orderBy('name')
        ->paginate(20);

        
            // Get category tree for better visualization
            $categoryTree = Category::whereNull('parent_id')
            ->with('children.children')
            ->get();
        return view('livewire.admin.category-index', [
            'categories' => $categories,
            'categoryTree' => $categoryTree
        ]);
    }
}
