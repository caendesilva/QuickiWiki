<?php

namespace App\Models\Support;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

/**
 * Simple diffing for strings.
 *
 * @experimental
 */
class ArticleDiff implements Htmlable
{
    protected const STATE_CREATED = 'created';
    protected const STATE_CHANGED = 'changed';
    protected const STATE_UNCHANGED = 'unchanged';
    protected const STATE_ADDED = 'added';
    protected const STATE_SUBTRACTED = 'subtracted';

    protected readonly string $new;
    protected readonly ?string $old;

    protected readonly string $state;
    protected readonly int $delta;


    public function __construct(string $new, ?string $old = null)
    {
        $this->new = $new;
        $this->old = $old;

        $this->state = $this->calculateState();
        $this->delta = $this->calculateDelta();
    }

    public function toHtml(): HtmlString
    {
        return new HtmlString($this->getMessage());
    }

    public function getMessage(): string
    {
        if ($this->state === self::STATE_CREATED) {
            return sprintf("Article created with %s bytes.", strlen($this->new));
        }

        if ($this->state === self::STATE_UNCHANGED) {
            return 'No changes made.';
        }

        return sprintf("%s %s bytes.", match ($this->delta <=> 0) {
            -1 => 'Removed',
            1 => 'Added',
            default => 'Changed',
        }, abs($this->delta));
    }

    protected function calculateState(): string
    {
        if ($this->old === null) {
            return self::STATE_CREATED;
        }

        if ($this->old === $this->new) {
            return self::STATE_UNCHANGED;
        }

        return match (strlen($this->new) <=> strlen($this->old)) {
            default => self::STATE_CHANGED,
            -1 => self::STATE_SUBTRACTED,
            1 => self::STATE_ADDED,
        };
    }

    protected function calculateDelta(): int
    {
        return strlen($this->new) - strlen($this->old);
    }
}
