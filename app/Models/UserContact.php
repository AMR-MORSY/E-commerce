<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserContact extends Model
{
    protected $fillable = [
        'city',
        'phone',
        'user_id',
        'country',
        'province',
        'address',
        'postal_code'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
