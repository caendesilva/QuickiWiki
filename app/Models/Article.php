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
        'history',
        'meta',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'history' => 'array',
        'meta' => 'array',
    ];

    /**
     * Get the article route key name.
     */
    public function getRouteKeyName(): string {
        return 'slug';
    }

    /**
     * Get the article's history.
     */
    public function getHistory(): array
    {
        return $this->history ?? [];
    }
    
    /**
     * Get the article's metadata.
     */
    public function getMeta(): array
    {
        return $this->meta ?? [];
    }
}
