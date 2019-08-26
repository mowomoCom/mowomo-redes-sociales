<?php
/**
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt.
 */

/**
 * Detects if the plugin has been entered directly.
 *
 * @since 1.3.0
 */
if (!defined('ABSPATH') || !defined('MWM_RRSS_VERSION')) {
    exit; // Exit if accessed directly.
}

/**
 * Check if exists the class 'mwm_dashboard'.
 *
 * @since 1.3.0
 */
if (!class_exists('mwm_dashboard')) {
    /**
     * Implements the mwm_dashboards class.
     * 
     * This is the class that controls the entire plugin.
     *
     * @since 1.3.0
     */
    class mwm_dashboard
    {
        /**
         * Single instance of the class.
         *
         * @var \mwm_dashboard
         *
         * @since 1.3.0
         */
        protected static $instance;

        /**
         * Returns single instance of the class.
         *
         * @since 1.3.0
         * 
         * @return \mwm_dashboard
         */
        public static function get_instance()
        {
            if (is_null(self::$instance)) :
                self::$instance = new self();
            endif;

            return self::$instance;
        }

        /**
         * Constructor.
         *
         * Initialice plugin and registers actions and filters to be used.
         *
         * @since 1.3.0
         * 
         * @return \mwm_dashboard
         */
        public function __construct()
        {
            // Ading scripts
            add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));

            // Initializing plugin information
            add_action('admin_init', array($this, 'init') );

            // Showing admin page
            // add_action('admin_menu', array($this, 'add_menu_to_admin'), 9);
            // add_action('admin_menu', array($this, 'add_license_page_to_admin'), 20);
            // add_filter('admin_footer_text', array($this, 'admin_footer'));
        }

        /**
         * Enqueue scripts and styles.
         *
         * @since 1.3.0
         * 
         * @return void
         */
        public function enqueue_scripts()
        {
            // Enqueuing scripts in the admin page
            wp_register_script(MWM_FRA_SLUG.'_admin_scripts', MWM_FRA_ASS.'js/admin_scripts.js', array('jquery'), '1.0.0', true);
            wp_register_style(MWM_FRA_SLUG.'_admin_styles', MWM_FRA_ASS.'css/admin_styles.min.css', array());
            wp_enqueue_script(MWM_FRA_SLUG.'_admin_scripts');
            wp_enqueue_style(MWM_FRA_SLUG.'_admin_styles');

            // Adding info to scripts
            wp_localize_script( MWM_FRA_SLUG.'_admin_scripts', 'admin_data', array(
                'ajax_url' => admin_url( 'admin-ajax.php' )
            ));
        }

        /**
         * Register settings for the plugin.
         *
         * @since 1.3.0
         * 
         * @return void
         */
        public function init()
        {
        }

        /**
         * Add the plugin menu and plugin menu page to the dashboard
         *
         * @since 1.3.0
         * 
         * @return void
         */
        public function add_menu_to_admin()
        {
            add_menu_page( 'mowomo', 'mowomo', 'manage_options', MWM_FRA_SLUG, array($this, 'get_main_admin_page'), MWM_FRA_ASS.'images/logo/logo-mowomo-white.svg' );
            add_submenu_page( MWM_FRA_SLUG, 'mowomo', __('General',MWM_FRA_SLUG), 'manage_options',  MWM_FRA_SLUG,"");
        }

        /**
         * Add the plugin menu and plugin menu page to the dashboard
         *
         * @since 1.3.0
         * 
         * @return void
         */
        public function add_license_page_to_admin()
        {
            add_submenu_page( MWM_FRA_SLUG, 'mowomo', __('Licencias activadas',MWM_FRA_SLUG), 'manage_options', 'mwm-licenses', array($this, 'get_licenses_page'));
        }

        /**
         * Load the administration page template.
         *
         * @since 1.3.0
         * 
         * @return void
         */
        public function get_main_admin_page()
        {
            // Configure the administrator page
            $admin_config = array(
                'title' => __('General', MWM_FRA_SLUG),
                'page_slug' => MWM_FRA_SLUG,
            );

            set_query_var( 'admin_config', $admin_config );

            // Load the base template
            mwm_dashboard_template('admin/admin', 'general', array());
        }

        /**
         * Load the administration page template.
         *
         * @since 1.3.0
         * 
         * @return void
         */
        public function get_licenses_page()
        {
            // Configure the administrator page
            $admin_config = array(
                'title' => __('mowomo Dashboard', MWM_FRA_SLUG),
                'page_slug' => MWM_FRA_SLUG,
                'tabs' => array(
                    __('Licencias Activadas') => array('admin/admin', 'licenses', array()),
                ),
            );

            set_query_var( 'admin_config', $admin_config );

            // Load the base template
            mwm_dashboard_admin();
        }

        /**
         * mowomo-redessociales
         *
         * @since      1.0.0
         *
         * Reemplaza el footer de WordPress en la pagina de mowomo RRSS
         *
        */
        public function admin_footer($footer_text)
        {
            if ( isset($_GET['page']) && $_GET['page'] == MWM_FRA_SLUG ) :
                $footer_text = __( 'Thanks for using mowomo Redes Sociales, plugin made by ', MWM_FRA_SLUG) . '<a href="https://mowomo.com" target="_blank" rel="nofollow">' . __('mowomo team', MWM_RRSS_SLUG). '</a>.';
            endif;
            return $footer_text;
        }

    }
}

/**
 * Unique access to instance of mwm_dashboard class.
 * 
 * @since 1.3.0
 *
 * @return \mwm_dashboard
 */
function mwm_dashboard()
{
    return mwm_dashboard::get_instance();
}
