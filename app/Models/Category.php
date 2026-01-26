<?php

namespace App\Models;

use Attribute;
use App\Models\Division;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'is_active',
        'parent_id',
       
        'code'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'parent_id' => 'integer',
    ];

    // Get full category path like "tshirts/long-sleeve-tshirt"
    public function getFullPathAttribute()
    {
        $path = [$this->slug];
        $parent = $this->parent;

        while ($parent) {
            array_unshift($path, $parent->slug);
            $parent = $parent->parent;
        }

        return implode('/', $path);
    }
    public function getCategoryCode($category, $increasedLetters = 0)
    {
        $code = [strtoupper(substr($category->name, 0, 3 + $increasedLetters))];

        $parent = $category->parent;

        while ($parent) {
            array_unshift($code, $parent->code);
            $parent = $parent->parent;
        }

        return implode('-', $code);
    }

    public function generateCode($category)
    {
        $increasedLetters = 0;
        do {
            $code = self::getCategoryCode($category, $increasedLetters);
            $increasedLetters++;
        } while (self::where('code', $code)->exists());

        return $code;
    }
    // Get breadcrumb array for schema markup
    public function getBreadcrumbs()
    {
        $breadcrumbs = collect([$this]);
        $parent = $this->parent;

        while ($parent) {
            $breadcrumbs->prepend($parent);
            $parent = $parent->parent;
        }

        return $breadcrumbs;
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($category) {

          
            // if (empty($category->code)) {

                $category->code = $category->generateCode($category);
            // }
            // Update full_path when saved
            $category->full_path = $category->getFullPathAttribute();
        });
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getProductsCountAttribute(): int
    {
        return $this->products()->count();
    }
    public function divisions(): BelongsToMany
    {
        return $this->belongsToMany(Division::class, 'category_division')->withPivot('is_active');
    }
}
