<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Division extends Model
{
    //
    protected $fillable = ['name', 'slug', 'description', 'code', 'is_active'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_division')->withPivot('is_active');
    }
}
