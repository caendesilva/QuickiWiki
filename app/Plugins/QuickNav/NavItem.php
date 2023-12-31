<?php

namespace App\Plugins\QuickNav;

use Illuminate\Support\Facades\Route;

class NavItem implements \Stringable
{
    protected string $label;
    protected string $destination;
    protected int $priority = 0;
    protected bool|\Closure $visible = true;

    protected array|\Closure $attributes = [];

    public static function make(string $label, string $destination, int $priority = 0): static
    {
        return new static($label, $destination, $priority);
    }

    public function __construct(string $label, string $destination, int $priority = 0)
    {
        $this->label = $label;
        $this->destination = $destination;
        $this->priority = $priority;
    }

    public static function divider(): static
    {
        return new static('[[ Divider ]]', '', 0);
    }

    public function __toString(): string
    {
        return $this->resolve();
    }

    public function resolve(): string
    {
        // If route exists, return route
        if (Route::has($this->destination)) {
            return route($this->destination);
        }

        // If route does not exist, return destination, assuming it is already a URL
        return $this->destination;
    }

    public function label(): string
    {
        return $this->label;
    }

    public function destination(): string
    {
        return $this->destination;
    }

    public function priority(): int
    {
        return $this->priority;
    }

    public function isActive(): bool
    {
        return request()->routeIs($this->destination);
    }

    public function isVisible(): bool
    {
        if ($this->visible instanceof \Closure) {
            return ($this->visible)();
        }

        return $this->visible;
    }

    public function getAttributes(): array
    {
        if ($this->attributes instanceof \Closure) {
            return ($this->attributes)();
        }

        return $this->attributes;
    }

    public function visible(bool|\Closure $visible = true): static
    {
        $this->visible = $visible;

        return $this;
    }

    public function attributes(array|\Closure $attributes): static
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function auth(): static
    {
        return $this->visible(fn () => auth()->check());
    }

    public function guest(): static
    {
        return $this->visible(fn () => auth()->guest());
    }
}
