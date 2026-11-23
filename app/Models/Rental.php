<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Rental extends Model
{
    const JAMINAN_TYPE_KTP = 'ktp';

    const JAMINAN_TYPE_SIM = 'sim';

    const JAMINAN_TYPE_KTM = 'ktm';

    const JAMINAN_TYPE_KARTU_PELAJAR = 'kartu_pelajar';

    public static array $jaminanTypes = [
        self::JAMINAN_TYPE_KTP => 'KTP',
        self::JAMINAN_TYPE_SIM => 'SIM',
        self::JAMINAN_TYPE_KTM => 'KTM',
        self::JAMINAN_TYPE_KARTU_PELAJAR => 'Kartu Pelajar',
    ];

    const JAMINAN_STATUS_BELUM_DITERIMA = 'belum_diterima';

    const JAMINAN_STATUS_DITAHAN = 'ditahan';

    const JAMINAN_STATUS_DIKEMBALIKAN = 'dikembalikan';

    public static array $jaminanStatuses = [
        self::JAMINAN_STATUS_BELUM_DITERIMA => 'Belum Diterima',
        self::JAMINAN_STATUS_DITAHAN => 'Ditahan',
        self::JAMINAN_STATUS_DIKEMBALIKAN => 'Dikembalikan',
    ];

    protected $fillable = [
        'user_id',
        'rental_code',
        'start_date',
        'end_date',
        'jaminan',
        'jaminan_type',
        'jaminan_status',
        'jaminan_received_at',
        'jaminan_returned_at',
        'total_price',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'jaminan_received_at' => 'datetime',
        'jaminan_returned_at' => 'datetime',
        'total_price' => 'decimal:2',
        'status' => 'string',
        'jaminan_type' => 'string',
        'jaminan_status' => 'string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rentalDetails(): HasMany
    {
        return $this->hasMany(RentalDetails::class, 'rental_id');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payments::class, 'rental_id');
    }

    public function rentalReturn(): HasOne
    {
        return $this->hasOne(RentalReturn::class, 'rental_id');
    }

    public function testimonial(): HasOne
    {
        return $this->hasOne(Testimonial::class, 'rental_id');
    }

    public function jaminanLabel(): ?string
    {
        return self::$jaminanTypes[$this->jaminan_type] ?? null;
    }

    public function jaminanStatusLabel(): ?string
    {
        return self::$jaminanStatuses[$this->jaminan_status] ?? null;
    }

    public function dapatDiterimaJaminan(): bool
    {
        return $this->status === 'dibayar' && $this->jaminan_status === self::JAMINAN_STATUS_BELUM_DITERIMA;
    }

    public function dapatDikembalikanJaminan(): bool
    {
        return $this->status === 'diambil' && $this->jaminan_status === self::JAMINAN_STATUS_DITAHAN;
    }

    public function scopeStatus($query, string $status)
    {
        return $query->where('status', $status);
    }
}
