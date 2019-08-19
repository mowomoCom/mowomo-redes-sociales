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
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque maximus hendrerit est, eget volutpat neque consectetur sit amet. Suspendisse at malesuada diam. Proin vel orci sem. Phasellus eget tempus ex. Mauris sed fringilla neque. Etiam at tellus at elit tristique feugiat. Etiam dapibus massa id justo varius tempor. In maximus finibus sem non sagittis. Sed eget leo nisl. Maecenas ac ipsum et urna lacinia malesuada. Duis eleifend eros a tellus fringilla, id pretium diam auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vulputate mollis lorem, nec interdum nulla faucibus vitae. Vivamus nisl tellus, malesuada eget efficitur id, aliquam a lacus. Nulla risus massa, aliquet nec ultrices consectetur, dignissim ac nisi.

Suspendisse eleifend dolor vitae tristique maximus. Nulla tincidunt fringilla est eget scelerisque. Maecenas volutpat, turpis sed lacinia pellentesque, est nulla fermentum lorem, eu varius dui orci ac neque. Proin sed est eget dui interdum maximus. Vivamus dolor ante, dapibus eget enim vitae, porta porta nibh. Praesent ac sodales nisi, at lacinia purus. In vehicula porta rhoncus. Aliquam erat volutpat. Integer efficitur scelerisque enim, nec maximus diam condimentum sed. Cras at mi in sem ullamcorper fringilla. Sed facilisis hendrerit dolor, non ornare quam molestie volutpat. Duis rutrum augue vitae massa ultricies, vitae mattis nisl varius. Pellentesque finibus ac tortor et convallis.
        </div>

        <div class="mwm-right-side">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque maximus hendrerit est, eget volutpat neque consectetur sit amet. Suspendisse at malesuada diam. Proin vel orci sem. Phasellus eget tempus ex. Mauris sed fringilla neque. Etiam at tellus at elit tristique feugiat. Etiam dapibus massa id justo varius tempor. In maximus finibus sem non sagittis. Sed eget leo nisl. Maecenas ac ipsum et urna lacinia malesuada. Duis eleifend eros a tellus fringilla, id pretium diam auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vulputate mollis lorem, nec interdum nulla faucibus vitae. Vivamus nisl tellus, malesuada eget efficitur id, aliquam a lacus. Nulla risus massa, aliquet nec ultrices consectetur, dignissim ac nisi.

Suspendisse eleifend dolor vitae tristique maximus. Nulla tincidunt fringilla est eget scelerisque. Maecenas volutpat, turpis sed lacinia pellentesque, est nulla fermentum lorem, eu varius dui orci ac neque. Proin sed est eget dui interdum maximus. Vivamus dolor ante, dapibus eget enim vitae, porta porta nibh. Praesent ac sodales nisi, at lacinia purus. In vehicula porta rhoncus. Aliquam erat volutpat. Integer efficitur scelerisque enim, nec maximus diam condimentum sed. Cras at mi in sem ullamcorper fringilla. Sed facilisis hendrerit dolor, non ornare quam molestie volutpat. Duis rutrum augue vitae massa ultricies, vitae mattis nisl varius. Pellentesque finibus ac tortor et convallis.
        </div>
    </div>

    <?php settings_errors(); ?>
</div>

<?php
