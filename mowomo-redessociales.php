<?php
/**
 * Plugin Name: mowomo Social Share
 * Plugin URI: https://mowomo.com
 * Description: Light and simple plugin for allowing the readers of your blog to share your entries on their social networks. If you only need to offer the possibility to your readers of sharing your blog entries... Why getting complicated?
 * Author: mowomo
 * Author URI: https://mowomo.com/sobre-mowomo
 * Text Domain: mowomo-redes-sociales
 * Domain Path: /languages/
 * Version: 2.0.2
 * License: GPLv2 or later.
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * WC requires at least: 4.6
 * WC tested up to: 5.4.2
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
if (defined('MWM_RRSS_VERSION')) {
    return;
} else {
    define('MWM_RRSS_VERSION', '2.0.2');
}
if (!defined('MWM_RRSS_SLUG')) {
    define('MWM_RRSS_SLUG', 'mowomo-redes-sociales');
}
if (!defined('MWM_RRSS_NAME')) {
    define('MWM_RRSS_NAME', 'Social Share');
}
if (!defined('MWM_RRSS_PRO')) {
    define('MWM_RRSS_PRO', FALSE);
}
if (!defined('MWM_RRSS_FILE')) {
    define('MWM_RRSS_FILE', __FILE__);
}
if (!defined('MWM_RRSS_URL')) {
    define('MWM_RRSS_URL', plugins_url('/', MWM_RRSS_FILE));
}
if (!defined('MWM_RRSS_DIR')) {
    define('MWM_RRSS_DIR', plugin_dir_path(MWM_RRSS_FILE));
}
if (!defined('MWM_RRSS_INIT')) {
    define('MWM_RRSS_INIT', basename( dirname( __FILE__ ) ));
}
if (!defined('MWM_RRSS_LANG')) {
    define('MWM_RRSS_LANG', MWM_RRSS_INIT . '/languages/' );
}
if (!defined('MWM_RRSS_ASS')) {
    define('MWM_RRSS_ASS', MWM_RRSS_URL.'assets/');
}
if (!defined('MWM_RRSS_INC')) {
    define('MWM_RRSS_INC', MWM_RRSS_DIR.'includes/');
}
if (!defined('MWM_RRSS_TPL')) {
    define('MWM_RRSS_TPL', MWM_RRSS_DIR.'templates/');
}
if (!defined('MWM_RRSS_FRA')) {
    define('MWM_RRSS_FRA', MWM_RRSS_DIR.'mowomo-dashboard/');
}

/**
 * Check if exists the function 'mwm_dashboard_constructor'.
 *
 * @since 1.3.0
 */
if (!function_exists('mwm_dashboard_constructor')) {
    require_once MWM_RRSS_FRA.'mowomo-dashboard.php';
    mwm_dashboard_constructor();
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
     * @global string MWM_RRSS_INC Shortcut to folder includes
     */
    function mwm_rrss_constructor()
    {
        // Load textdomain
        load_plugin_textdomain( MWM_RRSS_SLUG, FALSE, MWM_RRSS_LANG );

        // Load includes
        require_once MWM_RRSS_INC.'functions.mwm-rrss.php';

        // Let's start the game =)
        mwm_rrss();
    }
    add_action('plugins_loaded', 'mwm_rrss_constructor');
}
