<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payments extends Model
{
    protected $fillable = [
        'rental_id',
        'amount',
        'jaminan',
        'payment_method',
        'payment_status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'jaminan' => 'decimal:2',
    ];

    public function rental(): BelongsTo
    {
        return $this->belongsTo(Rental::class, 'rental_id');
    }
}
