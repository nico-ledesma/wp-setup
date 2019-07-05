<?php

namespace Cusqo\WPSetup\Modules;

use Cusqo\WPSetup\Module;

/**
 * Module: disable-front-toolbar
 *
 * Disable the admin toolbar shown in the front end for logged-in users.
 *
 * @example wpSetup('disable-front-toolbar')
 */
class DisableFrontToolbar extends Module
{
    /**
     * Run module
     */
    public function run()
    {
        if (!is_admin()) {
            $this->removeToolbar();
        }
    }

    /**
     * Remove admin toolbar in the frontend
     */
    private function removeToolbar()
    {
        add_filter('show_admin_bar', '__return_false');
    }
}
