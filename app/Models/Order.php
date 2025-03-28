<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    public function dish(): BelongsTo
    {
        return $this->belongsTo(Dish::class);
    }
}

