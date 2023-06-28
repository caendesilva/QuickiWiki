<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'article_id',
        'user_id',
        'message',
        'diff',
    ];

    /**
     * Get the article the contribution belongs to.
     */
    public function article(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Get the user that made the contribution.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Create a new contribution.
     */
    public static function log(Article $article, User $user, string $message, string $diff): static
    {
        return static::create([
            'article_id' => $article->id,
            'user_id' => $user->id,
            'message' => $message,
            'diff' => $diff,
        ]);
    }

    /**
     * Calculate the diff between two strings.
     */
    public static function diff(string $old, string $new): string
    {
        $old = explode("\n", $old);
        $new = explode("\n", $new);

        $diff = array_map(function ($old, $new) {
            if ($old === $new) {
                return $old;
            }

            return sprintf('<del>%s</del><ins>%s</ins>', $old, $new);
        }, $old, $new);

        return implode("\n", $diff);
    }
}
