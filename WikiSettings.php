<?php

use App\QuickiWiki;
use App\Plugins\QuickNav\NavItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
     * The navigation items for the top navigation bar.
     *
     * Remember that the items here will be hidden on mobile devices!
     */
    public static function navigationItems(): array
    {
        return [
            NavItem::make('Log in', 'login')->guest(),
            NavItem::make('Register', 'register')->visible(! Auth::check() && Route::has('register')),
        ];
    }

    /**
     * The navigation items for the sidebar.
     */
    public static function sidebarItems(): array
    {
        return [
            NavItem::make('Home', 'home'),
            NavItem::make('Profile', 'profile.edit')->auth(),
        ];
    }

    /**
     * The text for the sidebar footer.
     */
    public static function footerText(): string
    {
        return '[QuickiWiki](https://quickiwiki.desilva.se) &nbsp;v'. QuickiWiki::VERSION;
    }
}
