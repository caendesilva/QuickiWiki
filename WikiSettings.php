<?php

/**
 * This file contains the settings for your Wiki. Please edit as you see fit!
 */
class WikiSettings {
    public static string $wikiName = 'QuickiWiki';
    public static string $wikiDescription = 'A quick and easy wiki for your needs!';

    /**
     * Should the sidebar stay fixed when scrolling?
     */
    public static bool $stickySidebar = true;

    /**
     * The navigation items for the sidebar where the key is the label, and the value is the route.
     * If the value is false, the item will not be shown, this is useful for conditional navigation items.
     */
    public static function navigationItems(): array
    {
        return [
            'Home' => 'home',
            'Profile' => \Illuminate\Support\Facades\Auth::check() ? 'profile.edit' : false,
        ];
    }

    /**
     * The text for the sidebar footer.
     */
    public static function footerText(): string
    {
        return 'QuickiWiki v'.\App\QuickiWiki::VERSION;
    }
}
