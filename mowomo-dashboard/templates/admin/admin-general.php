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

// Load configuration
$admin_title = $admin_config['title'];
$page_slug = $admin_config['page_slug'];

// echop(mwm_dashboard()->get_plugins()[0]->get_info(array('slug', 'name', 'notifications')));

$feed = new mwm_feed(MWM_RRSS_SLUG.'-feed-uno', 'https://www.mowomo.com', 'hola', 10, 1, false);
// echop($feed->get_info(''));


?>

<!-- Admin Page -->
<div id="mwm-wrap" class="wrap">
    <!-- Page Title -->
    <h2><?php echo $admin_title; ?></h2>

    <div class="mwm-content">
        <div class="mwm-left-side">
            <?php $no_pro_plugins = mwm_dashboard()->get_no_pro_plugins(); ?>
                <div class="mwm-card">
                    <h3><?php echo __('Pro version', 'mowomo-dashboard' ); ?></h3>
                    <p><?php echo __('All plugins in this table can be updated to a pro version with new features', 'mowomo-dashboard' ); ?></p>
                </div>
                <div class="mwm-table">
                    <table >
                        <tbody>
                            <?php if(count($no_pro_plugins) > 0) : ?>
                                <?php foreach ($no_pro_plugins as $no_pro_plugin) : ?>     
                                    <tr>
                                        <th>
                                            <span><?php echo $no_pro_plugin->get_info('name'); ?></span>
                                        </th>
                                        <td>
                                            <span><?php echo $no_pro_plugin->get_info('update_message'); ?></span>
                                        </td>
                                        <td>
                                            <a class="button-primary" href="<?php echo $no_pro_plugin->get_info('update_url'); ?>"><?php echo __('Get PRO', 'mowomo-dashboard' ); ?></a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            <?php else: ?>
                                <tr>
                                    <th>
                                        <span><?php echo __('Enhorabuena, todos tus plugins cuentan con la versión PRO.', 'mowomo-dashboard' ) ?></span>
                                    </th>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            <?php $notifications = mwm_dashboard()->get_notifications(); ?>
                <div class="mwm-card">
                    <h3><?php echo __('Plugin notifications', 'mowomo-dashboard' ); ?></h3>
                    <p><?php echo __('This table shows all mowomo notifications detected by the system.', 'mowomo-dashboard' ); ?></p>
                </div>
                <div class="mwm-table">
                    <table >
                        <tbody>
                            <?php if (count($notifications) > 0) : ?>
                                <?php foreach ($notifications as $notification) : ?> 
                                    <?php 
                                        $notification_class = 'mwm-noti ';
                                        switch($notification->get_info('type')) {
                                            case 0: $notification_class .= 'mwm-noti-success'; break;
                                            case 1: $notification_class .= 'mwm-noti-info'; break;
                                            case 2: $notification_class .= 'mwm-noti-warning'; break;
                                            case 3: $notification_class .= 'mwm-noti-danger'; break;
                                        }
                                    ?>
                                    <tr class="<?php echo $notification_class; ?>">
                                        <th>
                                            <span><?php echo $notification->get_info('name'); ?></span>
                                        </th>
                                        <td>
                                            <span><?php echo $notification->get_info('message'); ?></span>
                                        </td>
                                        <td>
                                            <a class="button-primary" href="<?php echo $notification->get_info('url'); ?>"><?php echo __('Solve', 'mowomo-dashboard' ); ?></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <th>
                                        <span><?php echo __('Enhorabuena, has resuelto todas las notificaciones de mowomo.', 'mowomo-dashboard' ) ?></span>
                                    </th>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            
            <?php /*
            <div class="mwm-card">
                <h3><?php echo __('Other interesting plugins', 'mowomo-dashboard' ); ?></h3>
                <p><?php echo __('All these plugins can help you in many different ways, know them.', 'mowomo-dashboard' ); ?></p>
            </div>
            */ ?>

            <div class="mwm-card">
                <h3><?php echo __('New to mowomo?', 'mowomo-dashboard' ); ?></h3>
                <p><?php echo __('mowomo is a company that makes custom developments for WordPress, both themes and plugins. It also offers other types of products.', 'mowomo-dashboard' ); ?></p>
            </div>

            <div class="mwm-items">
                
            </div>
        </div>

        <!-- <div class="mwm-right-side">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque maximus hendrerit est, eget volutpat neque consectetur sit amet. Suspendisse at malesuada diam. Proin vel orci sem. Phasellus eget tempus ex. Mauris sed fringilla neque. Etiam at tellus at elit tristique feugiat. Etiam dapibus massa id justo varius tempor. In maximus finibus sem non sagittis. Sed eget leo nisl. Maecenas ac ipsum et urna lacinia malesuada. Duis eleifend eros a tellus fringilla, id pretium diam auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vulputate mollis lorem, nec interdum nulla faucibus vitae. Vivamus nisl tellus, malesuada eget efficitur id, aliquam a lacus. Nulla risus massa, aliquet nec ultrices consectetur, dignissim ac nisi.

Suspendisse eleifend dolor vitae tristique maximus. Nulla tincidunt fringilla est eget scelerisque. Maecenas volutpat, turpis sed lacinia pellentesque, est nulla fermentum lorem, eu varius dui orci ac neque. Proin sed est eget dui interdum maximus. Vivamus dolor ante, dapibus eget enim vitae, porta porta nibh. Praesent ac sodales nisi, at lacinia purus. In vehicula porta rhoncus. Aliquam erat volutpat. Integer efficitur scelerisque enim, nec maximus diam condimentum sed. Cras at mi in sem ullamcorper fringilla. Sed facilisis hendrerit dolor, non ornare quam molestie volutpat. Duis rutrum augue vitae massa ultricies, vitae mattis nisl varius. Pellentesque finibus ac tortor et convallis.
        </div> -->
    </div>

    <?php settings_errors(); ?>
</div>