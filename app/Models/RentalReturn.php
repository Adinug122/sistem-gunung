<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RentalReturn extends Model
{
    protected $table = 'returns';

    protected $fillable = [
        'rental_id',
        'return_date',
        'late_fee',
        'condition_notes',
    ];

    protected $casts = [
        'return_date' => 'date',
        'late_fee' => 'decimal:2',
    ];

    public function rental(): BelongsTo
    {
        return $this->belongsTo(Rental::class, 'rental_id');
    }
}
