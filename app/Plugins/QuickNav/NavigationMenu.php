<?php

namespace App\Plugins\QuickNav;

class NavigationMenu
{
    protected array $items;

    public static function make(array $items): static
    {
        return new static($items);
    }

    public function __construct(array $items)
    {
        $this->items = collect($items)
            ->filter(fn ($item) => $item->isVisible())
            ->sortBy('priority')
            ->toArray();
    }

    /** @return array<\App\Plugins\QuickNav\NavItem> */
    public function getItems(): array
    {
        return $this->items;
    }
}