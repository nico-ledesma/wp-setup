<?php

namespace Cusqo\WPSetup\Modules;

use Cusqo\WPSetup\Module;

/**
 * Module: enhance-embeds
 *
 * Additional wrappers for oembed to allow better styling
 *
 * @example wpSetup('enhance-embeds')
 */
class EnhanceEmbeds extends Module
{
    /**
     * Run module
     */
    public function run()
    {
        if (!is_admin()) {
            $this->wrapEmbeds();
        }
    }

    /**
     * Wrap embeds in extra markup
     */
    private function wrapEmbeds()
    {
        add_filter( 'embed_oembed_html', function($html){
            return '<div class="wp-embed"><div class="wp-embed-inner">' . $html . '</div></div>';
        }, 10);
    }
}
