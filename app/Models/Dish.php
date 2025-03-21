<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
class Dish extends Model
{
    public function category(): HasOne
    {
        return $this->hasOne(category::class);
    }
    
}
