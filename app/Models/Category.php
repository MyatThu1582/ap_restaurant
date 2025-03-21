<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dish;

class Category extends Model
{
    public function dish(): HasMany
    {
        return $this->hasMany(Dish::class);
    }
}
