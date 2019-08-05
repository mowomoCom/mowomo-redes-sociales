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
if (!defined('ABSPATH') || !defined('MWM_VERSION')) {
    exit; // Exit if accessed directly.
}

/**
 * Check if exists the class 'mwm_rrss_admin'.
 *
 * @since 1.3.0
 */
if (!class_exists('mwm_rrss_admin')) {
    /**
     * Implements the mwm_rrss_admins class.
     * 
     * This is the class that controls the entire plugin.
     *
     * @since 1.3.0
     */
    class mwm_rrss_admin
    {
        /**
         * Single instance of the class.
         *
         * @var \mwm_rrss_admin
         *
         * @since 1.3.0
         */
        protected static $instance;

        /**
         * Returns single instance of the class.
         *
         * @since 1.3.0
         * 
         * @return \mwm_rrss_admin
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
         * @return \mwm_rrss_admin
         */
        public function __construct()
        {
            // Ading scripts
            add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));

            // Initializing plugin information
            add_action('admin_init', array($this, 'init') );

            // Showing admin page
            add_action('admin_menu', array($this, 'show_page'));
            add_filter('admin_footer_text', array($this, 'admin_footer'));
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
            if (isset($_GET['page']) && $_GET['page'] == MWM_SLUG) {
                wp_register_script('mwm_admin_scripts', MWM_ASS.'js/admin_scripts.js', array('jquery'), '1.0.0', true);
                wp_register_style('mwm_admin_styles', MWM_ASS.'css/admin_styles.min.css', array());
                wp_enqueue_script('mwm_admin_scripts');
                wp_enqueue_style('mwm_admin_styles');

                // Adding info to scripts
                wp_localize_script( 'mwm_admin_scripts', 'mwm_admin_data', array(
                    'ajax_url' => admin_url( 'admin-ajax.php' )
                ));
            }
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
            register_setting( 'mwm_rrss_option', 'mwm_rrss_actives' );
            register_setting( 'mwm_rrss_option', 'mwm_rrss_posicion' );
            register_setting( 'mwm_rrss_option', 'mwm_rrss_twitter' );
        }

        /**
         * Add the plugin page in the WordPress administrator.
         *
         * @since 1.3.0
         * 
         * @return void
         */
        public function show_page()
        {
            add_menu_page( 'mowomo page', 'mowomo RRSS', 'manage_options', MWM_SLUG, array($this, 'get_page'), MWM_ASS.'images/logo/logo-mowomo-white.svg' );
        }

        /**
         * Load the administration page template.
         *
         * @since 1.3.0
         * 
         * @return void
         */
        public function get_page()
        {
            // Configure the administrator page
            $admin_config = array(
                'title' => __('mowomo Redes Sociales', MWM_SLUG),
                'page_slug' => MWM_SLUG,
                'tabs' => array(
                    __('Configuración general') => array('admin/admin', 'general-configuration', array()),
                    __('Configuración avanzada') => array('admin/admin', 'advanced-configuration')
                ),
            );
            

            set_query_var( 'admin_config', $admin_config );

            // Load the base template
            mwm_rrss_get_template_part('admin/admin', 'base');
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
            if ( isset($_GET['page']) && $_GET['page'] == MWM_SLUG ) :
                $footer_text = __( 'Thanks for using mowomo Redes Sociales, plugin made by ', MWM_SLUG) . '<a href="https://mowomo.com" target="_blank" rel="nofollow">' . __('mowomo team', MWM_SLUG). '</a>.';
            endif;
            return $footer_text;
        }

    }
}

/**
 * Unique access to instance of mwm_rrss_admin class.
 * 
 * @since 1.3.0
 *
 * @return \mwm_rrss_admin
 */
function mwm_rrss_admin()
{
    return mwm_rrss_admin::get_instance();
}
