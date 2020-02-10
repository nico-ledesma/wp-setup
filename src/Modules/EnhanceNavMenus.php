<?php

namespace Cusqo\WPSetup\Modules;

use Cusqo\WPSetup\Module;

/**
 * Module: enhance-nav-menus
 *
 * Add additional classes to nav menus indicating item depth, for better CSS targeting.
 * Level numbers start at zero. Classes added are:
 *  .sub-menu-lvl-$depth
 *  .menu-item-lvl-$depth
 *
 * @example wpSetup('enhance-nav-menus')
 */
class EnhanceNavMenus extends Module
{
    /**
     * Run module
     */
    public function run()
    {
        if (!is_admin()) {
            $this->addSubMenuClasses();
            $this->addMenuItemClasses();
        }
    }

    /**
     * Add class indicating sub-menu depth
     */
    protected function addSubMenuClasses()
    {
        add_filter('nav_menu_submenu_css_class', function ($classes, $args, $depth) {
            $classes[] = 'sub-menu-lvl-' . $depth;
            return $classes;
        }, 10, 3);
    }

    /**
     * Add class indicating menu-item depth
     */
    protected function addMenuItemClasses()
    {
        add_filter('nav_menu_css_class', function ($classes, $item, $args, $depth) {
            $classes[] = 'menu-item-lvl-' . $depth;
            return $classes;
        }, 10, 4);
    }
}
