<?php
/**
 * Plugin Name: mowomo Redes Sociales
 * Plugin URI: https://mowomo.com/                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
 * Description: Light and simple plugin for allowing the readers of your blog to share your entries on their social networks. If you only need to offer the possibility to your readers of sharing your blog entries... Why getting complicated?
 * Author: mowomo
 * Author URI: https://mowomo.com/sobre-mowomo
 * Text Domain: mowomo-redes-sociales
 * Domain Path: /lenguages/
 * Version: 1.3.0
 * License: GPLv2 or later.
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * WC requires at least: 5.0.0
 * WC tested up to: 5.2.2
 */

/**
 * Pa' fuera.
 *
 * @since 1.0.0
 */
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Define constants.
 *
 * @since 1.3.0
 */
if (defined('MWM_VERSION')) {
    return;
} else {
    define('MWM_VERSION', '1.3.0');
}
if (!defined('MWM_SLUG')) {
    define('MWM_SLUG', 'mowomo-redes-sociales');
}
if (!defined('MWM_FILE')) {
    define('MWM_FILE', __FILE__);
}
if (!defined('MWM_URL')) {
    define('MWM_URL', plugins_url('/', MWM_FILE));
}
if (!defined('MWM_DIR')) {
    define('MWM_DIR', plugin_dir_path(MWM_FILE));
}
if (!defined('MWM_INIT')) {
    define('MWM_INIT', dirname(plugin_basename(MWM_FILE)));
}
if (!defined('MWM_ASS')) {
    define('MWM_ASS', MWM_URL.'assets/');
}
if (!defined('MWM_INC')) {
    define('MWM_INC', MWM_DIR.'includes/');
}
if (!defined('MWM_TPL')) {
    define('MWM_TPL', MWM_DIR.'templates/');
}

/**
 * Check if exists the function 'mwm_rrss_constructor'.
 *
 * @since 1.3.0
 */
if (!function_exists('mwm_rrss_constructor')) {
    /**
     * Plugin Construction.
     * 
     * Function that builds the complete plugin structure.
     *
     * @since 1.3.0
     * 
     * @global string MWM_INC Shortcut to folder includes
     */
    function mwm_rrss_constructor()
    {
        // Load textdomain
        load_plugin_textdomain('mwm', FALSE, MWM_INIT.'/languages/');

        // Load includes
        require_once MWM_INC.'class.mwm-rrss.php';
        require_once MWM_INC.'admin/class.mwm-rrss-admin.php';
        require_once MWM_INC.'class.mwm-rrss-shortcodes.php';
        require_once MWM_INC.'functions.mwm-rrss.php';
        require_once MWM_INC.'admin/functions.mwm-rrss-admin.php';

        // Let's start the game =)
        mwm_rrss();
    }
    add_action('plugins_loaded', 'mwm_rrss_constructor');
}
