<?php

namespace App\Models;

use App\Models\Governorate;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['governorate_id', 'name_ar', 'name_en'];

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }
}
