<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model
{
    //
    protected $fillable = ['name', 'slug', 'description', 'code', 'is_active'];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}
