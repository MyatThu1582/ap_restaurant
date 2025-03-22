<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
class Dish extends Model
{
    public function category(): BelongsTo
    {
        return $this->belongsTo(category::class);
    }
    
}
