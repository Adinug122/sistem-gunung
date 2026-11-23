<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RentalDetails extends Model
{
    protected $fillable = [
        'rental_id',
        'product_id',
        'product_variant_id',
        'quantity',
        'price_per_day',
        'subtotal',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price_per_day' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function rental(): BelongsTo
    {
        return $this->belongsTo(Rental::class, 'rental_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }
}
