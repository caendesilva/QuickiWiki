<?php

namespace App\Models;

use App\Models\Support\ArticleDiff;
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
        'content',
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
    public static function log(Article $article, User $user, string $content, string $message): static
    {
        return static::create([
            'article_id' => $article->id,
            'user_id' => $user->id,
            'content' => $content,
            'message' => $message,
        ]);
    }

    /**
     * Calculate the diff between the revision and the one before it.
     */
    public function diff(): ArticleDiff
    {
        $old = $this->article->contributions()->where('id', '<', $this->id)->latest()->first();

        return new ArticleDiff($this->content, $old ? $old->content : null);
    }
}
