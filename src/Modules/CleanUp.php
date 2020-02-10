<?php

namespace Cusqo\WPSetup\Modules;

use Cusqo\WPSetup\Module;

/**
 * Module: clean-up
 *
 * Generic theme modifications that remove unnecesary WordPress features.
 *
 * @example wpSetup('clean-up')
 */
class CleanUp extends Module
{
    /**
     * Run module
     */
    public function run()
    {
        if (!is_admin()) {
            $this->removeTags();
            $this->addResponsiveEmbeds();
        }
    }

    /**
     * Remove unnecessary head tags
     */
    private function removeTags()
    {
        add_action('init', function () {
            remove_action('wp_head', 'feed_links_extra', 3);
            remove_action('wp_head', 'rsd_link');
            remove_action('wp_head', 'wlwmanifest_link');
            remove_action('wp_head', 'wp_generator');
            remove_action('wp_head', 'wp_shortlink_wp_head');
            remove_action('wp_head', 'rest_output_link_wp_head', 10);
            remove_action('wp_head', 'print_emoji_detection_script', 7);
            remove_action('admin_print_scripts', 'print_emoji_detection_script');
            remove_action('wp_print_styles', 'print_emoji_styles');
            remove_action('admin_print_styles', 'print_emoji_styles');
            remove_action('wp_head', 'wp_oembed_add_discovery_links');
            remove_action('wp_head', 'wp_oembed_add_host_js');
            add_filter('emoji_svg_url', '__return_false');
            add_filter('show_recent_comments_widget_style', '__return_false');
        }, 9999);
    }
}
