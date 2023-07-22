<?php

namespace App;

use App\Plugins\QuickNav\NavigationMenu;
use WikiSettings;

/**
 * General facade for QuickiWiki services.
 */
class QuickiWiki
{
    public const VERSION = '0.4.0-dev';

    /** @return array<\App\Plugins\QuickNav\NavItem> */
    public static function navigationMenu(): array
    {
        return NavigationMenu::make(WikiSettings::navigationItems())->getItems();
    }

    /** @return array<\App\Plugins\QuickNav\NavItem> */
    public static function sidebarMenu(): array
    {
        return NavigationMenu::make(WikiSettings::sidebarItems())->getItems();
    }
}
