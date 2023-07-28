<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    /**
     * The orders that belong to the product.
     */
    public function orders(): BelongsToMany
    {
        return $this
            ->belongsToMany(Order::class, 'orders_lines', 'product_id', 'order_id')
            ->withPivot('qty')
            ->withTimestamps();
    }
}
