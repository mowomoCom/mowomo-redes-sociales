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
 * @since 1.0.0
 */
if (!defined('ABSPATH') || !defined('MWM_RRSS_VERSION')) {
    exit; // Exit if accessed directly.
}

/**
 * Check if exists the class 'mwm_dashboard'.
 *
 * @since 1.0.0
 */
if (!class_exists('mwm_dashboard')) {
    /**
     * Implements the mwm_dashboards class.
     * 
     * This is the class that controls the entire plugin.
     *
     * @since 1.0.0
     */
    class mwm_dashboard
    {
        /**
         * Single instance of the class.
         *
         * @var \mwm_dashboard
         *
         * @since 1.0.0
         */
        protected static $instance;

        /**
         * Returns single instance of the class.
         *
         * @since 1.0.0
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
         * Variable
         * 
         * mowomo plugins
         *
         * @since 1.0.0
         * 
         * @return array
         */
        protected $plugins = array();

        /**
         * Variable
         * 
         * mowomo notifications
         *
         * @since 1.0.0
         * 
         * @return array
         */
        protected $notifications = array();

        /**
         * Constructor.
         *
         * Initialice plugin and registers actions and filters to be used.
         *
         * @since 1.0.0
         * 
         * @return \mwm_dashboard
         */
        private function __construct()
        {
            // Ading scripts
            add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));

            // Initializing plugin information
            add_action('admin_init', array($this, 'init') );

            // Showing admin page
            add_action('admin_menu', array($this, 'add_menu_to_admin'));
            // add_action('admin_menu', array($this, 'add_license_page_to_admin'), 20);
            add_filter('admin_footer_text', array($this, 'admin_footer'));

            // Showing admin bar
            add_action( 'wp_before_admin_bar_render', array($this, 'show_admin_bar'));
        }

        /**
         * Enqueue scripts and styles.
         *
         * @since 1.0.0
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
         * @since 1.0.0
         * 
         * @return void
         */
        public  function init()
        {

        }

        /**
         * Add the plugin menu and plugin menu page to the dashboard
         *
         * @since 1.0.0
         * 
         * @return void
         */
        public function add_menu_to_admin()
        {
            // add_menu_page( 'mowomo', 'mowomo', 'manage_options', MWM_FRA_SLUG, array($this, 'get_main_admin_page'), MWM_FRA_ASS.'images/logo/logo-mowomo-white.svg' );
            // add_submenu_page( MWM_FRA_SLUG, 'mowomo', __('Panel General',MWM_FRA_SLUG), 'manage_options',  MWM_FRA_SLUG,"");
        }

        /**
         * Add the plugin menu and plugin menu page to the dashboard
         *
         * @since 1.0.0
         * 
         * @return void
         */
        public  function add_license_page_to_admin()
        {
            // add_submenu_page( MWM_FRA_SLUG, 'mowomo', __('Gestión de licencias',MWM_FRA_SLUG), 'manage_options', MWM_FRA_SLUG.'-licenses', array($this, 'get_licenses_page'));
        }

        /**
         * Load the administration page template.
         *
         * @since 1.0.0
         * 
         * @return void
         */
        public function get_main_admin_page()
        {
            // Configure the administrator page
            $admin_config = array(
                'title' => __('General panel - mowomo', 'mowomo-dashboard'),
                'page_slug' => MWM_FRA_SLUG,
            );

            set_query_var( 'admin_config', $admin_config );

            // Load the base template
            mwm_dashboard_template('admin/admin', 'general', array());
        }

        /**
         * Load the administration page template.
         *
         * @since 1.0.0
         * 
         * @return void
         */
        public function get_licenses_page()
        {
            // Configure the administrator page
            $admin_config = array(
                'title' => __('License management - mowomo', 'mowomo-dashboard'),
                'page_slug' => MWM_FRA_SLUG,
                'tabs' => array(
                    __('Activated licenses', 'mowomo-dashboard') => array('admin/admin', 'licenses', array()),
                ),
            );

            set_query_var( 'admin_config', $admin_config );

            // Load the base template
            mwm_dashboard_admin();
        }

        /**
         * Modify the footer text
         *
         * @since 1.0.0
         * 
         * @return string
         *
        */
        public function admin_footer($footer_text)
        {
            if ( isset($_GET['page']) && ($_GET['page'] == MWM_FRA_SLUG || $_GET['page'] == MWM_FRA_SLUG.'-licenses') ) :
                $footer_text = __( 'Thanks for using mowomo Social Share, plugin made by ', 'mowomo-dashboard') . '<a href="https://mowomo.com" target="_blank" rel="nofollow">' . __('mowomo team', 'mowomo-dashboard'). '</a>.';
            endif;
            return $footer_text;
        }

        /**
         * Show the admin bar
         *
         * @since 1.0.0
         * 
         * @return void
         *
        */
        public function show_admin_bar()
        {
            global $wp_admin_bar;

            // General Menu
            $wp_admin_bar->add_menu( array(
                'parent' => false,
                'id' => MWM_FRA_SLUG,
                'title' => '<img id="mwm-admin-bar-logo" src="'.MWM_FRA_ASS.'images/logo/logo-mowomo-white.svg"/>',
                'href' => admin_url('admin.php?page=mowomo-dashboard'),
                'meta' => false
            ));

            // $wp_admin_bar->add_menu( array(
            //     'parent' => MWM_FRA_SLUG,
            //     'id' => MWM_FRA_SLUG.'-general',
            //     'title' => __('Avisos generales', 'mowomo-dashboard' ),
            //     'href' => admin_url('admin.php?page=mowomo-dashboard'),
            //     'meta' => false
            // ));

            // Plugin notifications menu
            foreach ($this->plugins as $p_key => $p_value) {
                if (count($p_value->get_info('notifications')) > 0) {
                    $wp_admin_bar->add_menu( array(
                        'parent' => MWM_FRA_SLUG,
                        'id' => $p_value->get_info('slug'),
                        'title' => $p_value->get_info('name'),
                        'href' => admin_url('admin.php?page='.$p_value->get_info('slug')),
                        'meta' => false
                    ));
                    
                    foreach ($p_value->get_info('notifications') as $n_key => $v_value) {
                        $wp_admin_bar->add_menu( array(
                            'parent' => $p_value->get_info('slug'),
                            'id' => $v_value->get_info('code'),
                            'title' => __('Aviso:', 'mowomo-dashboard').' '.$v_value->get_info('name'),
                            'href' => admin_url($v_value->get_info('url')),
                            'meta' => false
                        ));
                    }
                }
            }

            // $wp_admin_bar->add_menu( array(
            //     'parent' => MWM_FRA_SLUG,
            //     'id' => MWM_FRA_SLUG.'-offers',
            //     'title' => __('Ofertas y promociones', 'mowomo-dashboard' ),
            //     'href' => admin_url('admin.php?page=mowomo-dashboard'),
            //     'meta' => false
            // ));
            
        }



        /**
         * Add plugins to mowomo
         *
         * @since 1.0.0
         * 
         * @return boolean
         */
        public function add_plugin($plugin)
        {
            if (is_a($plugin, 'mwm_plugin')) {
                array_push($this->plugins, $plugin);
                return true;
            } else {
                return false;
            }
        }

        /**
         * Load mowomo plugins
         *
         * @since 1.0.0
         * 
         * @return array
         */
        public function get_plugins($slug = '')
        {
            if ($slug == '') return $this->plugins;

            foreach ($this->plugins as $key => $value) {
                if (strcmp($value->get_info('slug'), $slug) == 0) {
                    return $value;
                }
            }

            return false;
        }

        /**
         * Load mowomo no pro plugins
         *
         * @since 1.0.0
         * 
         * @return array
         */
        public function get_no_pro_plugins()
        {
            $plugins = array();
            
            foreach ($this->plugins as $key => $value) {
                if (!$value->get_info('is_pro')) array_push($plugins, $value);
            }

            return $plugins;
        }

        /**
         * Add notifications to mowomo
         *
         * @since 1.0.0
         * 
         * @return boolean
         */
        public function add_notification($notification)
        {
            if (is_a($notification, 'mwm_notification')) {
                array_push($this->notifications, $notification);
                return true;
            } else {
                return false;
            }
        }

        /**
         * Load mowomo notifications
         *
         * @since 1.0.0
         * 
         * @return array
         */
        public function get_notifications($type = '')
        {
            $notifications = array();

            if ($type == '') return $this->notifications;

            foreach ($this->notifications as $key => $value) {
                if (strcmp($type, $value->get_info('type'))) array_push($notifications, $value);
            }

            return $this->notifications;
        }

    }
}

/**
 * Unique access to instance of mwm_dashboard class.
 * 
 * @since 1.0.0
 *
 * @return \mwm_dashboard
 */
function mwm_dashboard()
{
    return mwm_dashboard::get_instance();
}
