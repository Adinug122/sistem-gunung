<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'image',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    protected static function booted(): void
    {
        static::creating(function (Blog $blog): void {
            if (blank($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }

            $original = $blog->slug;
            $count = 1;

            while (static::where('slug', $blog->slug)->exists()) {
                $blog->slug = $original.'-'.$count;
                $count++;
            }
        });
    }
}
