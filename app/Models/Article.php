<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'slug',
        'title',
        'content',
        'metadata',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'metadata' => 'array',
    ];

    /**
     * Get the article route key name.
     */
    public function getRouteKeyName(): string {
        return 'slug';
    }

    /**
     * Get the article's metadata.
     */
    public function getMetadata(): array
    {
        return $this->metadata ?? [];
    }

    /**
     * Get the article's contributions.
     */
    public function contributions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Contribution::class);
    }

    /**
     * Is the article restricted to users with the editor role?
     */
    public function isRestricted(): bool
    {
        return $this->getMetadata()['restricted'] ?? false;
    }
}
