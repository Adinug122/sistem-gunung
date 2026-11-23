<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'variant_name',
        'sku',
        'stock',
        'price_per_day',
    ];

    protected $casts = [
        'stock' => 'integer',
        'price_per_day' => 'decimal:2',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function rentalDetails(): HasMany
    {
        return $this->hasMany(RentalDetails::class, 'product_variant_id');
    }
}
