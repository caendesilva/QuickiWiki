<?php

namespace App\Plugins\QuickNav;

use Illuminate\Support\Facades\Route;

class NavItem implements \Stringable
{
    protected string $label;
    protected string $destination;
    protected int $priority = 0;
    protected bool|\Closure $visible = true;

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

    public function visible(bool|\Closure $visible = true): static
    {
        $this->visible = $visible;

        return $this;
    }
}
