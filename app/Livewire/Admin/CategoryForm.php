<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryForm extends Component
{
    public $categoryId = null;
    public $name = '';
    public $slug = '';
    public $parent_id = null;
    public $description = '';
    public $meta_title = '';
    public $meta_description = '';
    public $meta_keywords = '';
    public $isEditMode = false;
    public $is_active = true;

    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:categories,slug',
        'parent_id' => 'nullable|exists:categories,id',
        'description' => 'nullable|string',
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:500',
        'meta_keywords' => 'nullable|string|max:255',
        'is_active' => 'required|boolean'
    ];

    public function mount($categoryId = null)
    {
        if ($categoryId) {
            $this->isEditMode = true;
            $this->categoryId = $categoryId;
            $this->loadCategory();
        }
    }
    public function loadCategory()
    {
        $category = Category::findOrFail($this->categoryId);

        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->parent_id = $category->parent_id;
        $this->description = $category->description;
        $this->meta_title = $category->meta_title;
        $this->meta_description = $category->meta_description;
        $this->meta_keywords = $category->meta_keywords;
        $this->is_active = $category->is_active;
    }
    public function updatedName($value)
    {
        // Auto-generate slug from name if not in edit mode or slug is empty
        if (!$this->isEditMode || empty($this->slug)) {
            $this->slug = Str::slug($value);
        }
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }


    public function save()
    {
        // Update validation rules for edit mode
        if ($this->isEditMode) {
            $this->rules['slug'] = 'required|string|max:255|unique:categories,slug,' . $this->categoryId;
        }

        $this->validate();

        // Check for circular reference (prevent category from being its own parent)
        if ($this->isEditMode && $this->parent_id && $this->parent_id == $this->categoryId) {
            $this->addError('parent_id', 'A category cannot be its own parent.');
            return;
        }

        // Check for circular reference in hierarchy
        if ($this->parent_id && $this->isEditMode) {
            if ($this->wouldCreateCircularReference($this->categoryId, $this->parent_id)) {
                $this->addError('parent_id', 'This would create a circular reference in the category hierarchy.');
                return;
            }
        }

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'parent_id' => $this->parent_id,
            'description' => $this->description,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'is_active' => $this->is_active
        ];

        if ($this->isEditMode) {
            $category = Category::findOrFail($this->categoryId);
            $category->update($data);
            session()->flash('success', 'Category updated successfully!');
        } else {
            //  dd($data);
            Category::create($data);
            session()->flash('success', 'Category created successfully!');
        }

        return redirect()->route('admin.categories.index');
    }

    private function wouldCreateCircularReference($categoryId, $newParentId)
    {
        $parent = Category::find($newParentId);

        while ($parent) {
            if ($parent->id == $categoryId) {
                return true;
            }
            $parent = $parent->parent;
        }

        return false;
    }

    public function render()
    {
        // Get all categories except current one (for parent selection)
        $categories = Category::whereNull('parent_id')
            ->with('children.children')
            ->when($this->isEditMode, function ($query) {
                $query->where('id', '!=', $this->categoryId);
            })
            ->get();

        return view('livewire.admin.category-form', [
            'categories' => $categories
        ]);
    }
}
