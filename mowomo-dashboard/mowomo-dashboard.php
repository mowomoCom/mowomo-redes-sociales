<?php
/**
 * Framework Name: mowomo dashboard
 * Version: 1.0.0
 * Author: mowomo
 * Text Domain: mowomo-dashboard
 * Domain Path: /languages/
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
 * @since 1.0.0
 */
if (defined('MWM_FRA_VERSION')) {
    return;
} else {
    define('MWM_FRA_VERSION', '1.0.0');
}
if (!defined('MWM_FRA_SLUG')) {
    define('MWM_FRA_SLUG', 'mowomo-dashboard');
}
if (!defined('MWM_FRA_INIT')) {
    define('MWM_FRA_INIT', dirname(__FILE__));
}
if (!defined('MWM_FRA_URL')) {
    define('MWM_FRA_URL', plugins_url('/', MWM_FRA_INIT));
}
if (!defined('MWM_FRA_DIR')) {
    define('MWM_FRA_DIR', plugin_dir_path(MWM_FRA_INIT));
}
if (!defined('MWM_FRA_INIT')) {
    define('MWM_FRA_INIT', dirname(plugin_basename(MWM_FRA_INIT)));
}
if (!defined('MWM_FRA_LAN')) {
    define('MWM_FRA_LAN', MWM_FRA_URL.MWM_FRA_SLUG.'/languages/');
}
if (!defined('MWM_FRA_ASS')) {
    define('MWM_FRA_ASS', MWM_FRA_URL.MWM_FRA_SLUG.'/assets/');
}
if (!defined('MWM_FRA_PLU_ASS')) {
    define('MWM_FRA_PLU_ASS', MWM_FRA_DIR.'assets/');
}
if (!defined('MWM_FRA_INC')) {
    define('MWM_FRA_INC', MWM_FRA_DIR.MWM_FRA_SLUG.'/includes/');
}
if (!defined('MWM_FRA_PLU_INC')) {
    define('MWM_FRA_PLU_INC', MWM_FRA_DIR.'includes/');
}
if (!defined('MWM_FRA_TPL')) {
    define('MWM_FRA_TPL', MWM_FRA_DIR.MWM_FRA_SLUG.'/templates/');
}
if (!defined('MWM_FRA_PLU_TPL')) {
    define('MWM_FRA_PLU_TPL', MWM_FRA_DIR.'templates/');
}
if (!defined('MWM_FRA_LIB')) {
    define('MWM_FRA_LIB', MWM_FRA_DIR.MWM_FRA_SLUG.'/lib/');
}

/**
 * Plugin dashboard Construction.
 * 
 * Function that builds the complete plugin dashboard structure.
 *
 * @since 1.0.0
 */
function mwm_dashboard_constructor() 
{
    // Load textdomain
    load_plugin_textdomain( MWM_FRA_SLUG, FALSE, MWM_FRA_LAN );

    // Load includes
    require_once MWM_FRA_LIB.'mowomo-resources.php';
    require_once MWM_FRA_INC.'functions.php';

    // Let's start the game =)
    mwm_dashboard();
}