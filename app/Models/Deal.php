<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(int $int)
 */
class Deal extends Model
{
    use HasFactory;

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function productsDeals(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductsDeals::class);
    }
}
