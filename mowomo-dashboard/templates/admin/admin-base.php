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
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Load configuration
$admin_title = $admin_config['title'];
$page_slug = $admin_config['page_slug'];
$admin_tabs = $admin_config['tabs'];

// MAKE THE MAGIC!

?>

<!-- Admin Page -->
<div id="mwm-wrap" class="wrap">


    <!-- Page Title -->
    <h2><?php echo $admin_title; ?></h2>

    <!-- Nav Tab Wrapper -->
    <h2 class="nav-tab-wrapper">
        <?php foreach ($admin_tabs as $tab_title => $tab_slug) : ?>
            <a href="javascript:void(0);" mwm-tab="<?php echo $tab_slug[1] ?>" class="nav-tab <?php echo $active_tab == $tab_slug[1] ? 'nav-tab-active' : ''; ?>"><?php echo $tab_title; ?></a>
        <?php endforeach; ?>
    </h2>

    <!-- Dinamic Admin Form -->
    <form id="mwm-admin-form" mwm-current-tab="<?php echo $active_tab; ?>" mwm-page-slug="<?php echo $page_slug; ?>" action="options.php" method="post">
        <?php
            settings_fields( MWM_FRA_SLUG.'-options' );
            @do_settings_fields( MWM_FRA_SLUG ,MWM_FRA_SLUG.'-options' );
        ?>
        <?php foreach ($admin_tabs as $tab_title => $tab_slug) : ?>
            <div id="tab-<?php echo $tab_slug[1]; ?>" class="mwm-tab <?php echo !$first_tab ? 'hidden' : ''; ?>">
                <?php
                    print mwm_dashboard_template($tab_slug[0], $tab_slug[1]);
                ?>
            </div>
        <?php endforeach; ?>

        <p><?php @submit_button(); ?></p>
    </form>

    <?php settings_errors(); ?>
</div>