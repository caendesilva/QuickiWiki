<?php

namespace App;

/**
 * General facade for QuickiWiki services.
 */
class QuickiWiki
{
    public const VERSION = '0.2.0';

    /** @return array<\App\Plugins\QuickNav\NavItem> */
    public static function sidebarMenu(): array
    {
        return \App\Plugins\QuickNav\NavigationMenu::make(\WikiSettings::navigationItems())->getItems();
    }
}
