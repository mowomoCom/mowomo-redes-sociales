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

// Load configuration
$admin_title = $admin_config['title'];
$page_slug = $admin_config['page_slug'];

?>

<!-- Admin Page -->
<div id="mwm-wrap" class="wrap">
    <!-- Page Title -->
    <h2><?php echo $admin_title; ?></h2>

    <div class="mwm-content">
        <div class="mwm-left-side">
            <?php 
                $no_pro_plugins = mwm_no_pro_plugins();
                
                if (!empty($no_pro_plugins)) : ?>
                    <div class="mwm-card">
                        <h3><?php echo __('Pro version', MWM_FRA_SLUG); ?></h3>
                        <p><?php echo __('All plugins in this table can be updated to a pro version with new features', MWM_FRA_SLUG); ?></p>
                    </div>
                    <div class="mwm-table">
                        <table >
                            <tbody>
                                <?php
                                    
                                    foreach ($no_pro_plugins as $no_pro_plugin) : ?>
                                        
                                        <tr>
                                            <th>
                                                <span><?php echo $no_pro_plugin['name']; ?></span>
                                            </th>
                                            <td>
                                                <span><?php echo $no_pro_plugin['update_message']; ?></span>
                                            </td>
                                            <td>
                                                <a class="button-primary" href="<?php echo $no_pro_plugin['update_url']; ?>"><?php echo __('Get PRO', MWM_FRA_SLUG); ?></a>
                                            </td>
                                        </tr>
                                    <?php endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif;
            ?>

            <?php 
                $plugin_notices = mwm_plugin_notices();
                
                if (!empty($plugin_notices)) : ?>
                    <div class="mwm-card">
                        <h3><?php echo __('Plugin notices', MWM_FRA_SLUG); ?></h3>
                        <p><?php echo __('All plugins in this table have notices that could be resolved at this moment.', MWM_FRA_SLUG); ?></p>
                    </div>
                    <div class="mwm-table">
                        <table >
                            <tbody>
                                <?php
                                    
                                    foreach ($plugin_notices as $plugin_notice) : ?>
                                        
                                        <tr>
                                            <th>
                                                <span><?php echo $plugin_notice['name']; ?></span>
                                            </th>
                                            <td>
                                                <span><?php echo $plugin_notice['message']; ?></span>
                                            </td>
                                            <td>
                                                <a class="button-primary" href="<?php echo $plugin_notice['slug']; ?>"><?php echo __('Solve', MWM_FRA_SLUG); ?></a>
                                            </td>
                                        </tr>
                                    <?php endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif;
            ?>

            <div class="mwm-card">
                <h3><?php echo __('Other interesting plugins', MWM_FRA_SLUG); ?></h3>
                <p><?php echo __('All these plugins can help you in many different ways, know them.', MWM_FRA_SLUG); ?></p>
            </div>

            <div class="mwm-card">
                <h3><?php echo __('New to mowomo?', MWM_FRA_SLUG); ?></h3>
                <p><?php echo __('mowomo is a company that makes custom developments for WordPress, both themes and plugins. It also offers other types of products.', MWM_FRA_SLUG); ?></p>
            </div>  
        </div>

        <div class="mwm-right-side">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque maximus hendrerit est, eget volutpat neque consectetur sit amet. Suspendisse at malesuada diam. Proin vel orci sem. Phasellus eget tempus ex. Mauris sed fringilla neque. Etiam at tellus at elit tristique feugiat. Etiam dapibus massa id justo varius tempor. In maximus finibus sem non sagittis. Sed eget leo nisl. Maecenas ac ipsum et urna lacinia malesuada. Duis eleifend eros a tellus fringilla, id pretium diam auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vulputate mollis lorem, nec interdum nulla faucibus vitae. Vivamus nisl tellus, malesuada eget efficitur id, aliquam a lacus. Nulla risus massa, aliquet nec ultrices consectetur, dignissim ac nisi.

Suspendisse eleifend dolor vitae tristique maximus. Nulla tincidunt fringilla est eget scelerisque. Maecenas volutpat, turpis sed lacinia pellentesque, est nulla fermentum lorem, eu varius dui orci ac neque. Proin sed est eget dui interdum maximus. Vivamus dolor ante, dapibus eget enim vitae, porta porta nibh. Praesent ac sodales nisi, at lacinia purus. In vehicula porta rhoncus. Aliquam erat volutpat. Integer efficitur scelerisque enim, nec maximus diam condimentum sed. Cras at mi in sem ullamcorper fringilla. Sed facilisis hendrerit dolor, non ornare quam molestie volutpat. Duis rutrum augue vitae massa ultricies, vitae mattis nisl varius. Pellentesque finibus ac tortor et convallis.
        </div>
    </div>

    <?php settings_errors(); ?>
</div>

<?php
