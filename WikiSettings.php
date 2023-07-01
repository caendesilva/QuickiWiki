<?php

// This file contains the settings for your Wiki. Please edit as you see fit!

final class WikiSettings {
    public static string $WikiName = 'QuickiWiki';
    public static string $WikiDescription = 'A quick and easy wiki for your needs!';

    public static bool $StickySidebar = true;

    // The navigation items for the sidebar where the key is the label, and the value is the route.
    // If the value is false, the item will not be shown, this is useful for conditional navigation items.
    public static function navigationItems(): array
    {
        return [
            'Home' => 'home',
            'Profile' => \Illuminate\Support\Facades\Auth::check() ? 'profile.edit' : false,
        ];
    }
}
