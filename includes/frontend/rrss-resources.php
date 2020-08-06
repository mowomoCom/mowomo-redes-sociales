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

function mwm_show_rrss_buttons(array $args = array()) {

    if (!array_key_exists('actives', $args)) {
        $actives = array('twitter', 'facebook', 'pinterest', 'linkedin', 'whatsapp');
    } else {
        $actives = $args['actives'];
    }

    if (!array_key_exists('appearance', $args)) {
        $appearance = '1';
    } else {
        $appearance = $args['appearance'];
    }

    if (!array_key_exists('alignment', $args)) {
        $alingment = '1';
    } else {
        $alingment = $args['alignment'];
    }

    ?>
        <div class="mwm_rrss_contenedor mwm_rrss_appearance_<?php echo $appearance; ?> mwm_rrss_alingment_<?php echo $alingment; ?>">
            <?php if (in_array('twitter', $actives)) : ?>
                <a class="mwm_rrss mwm_twitter" mwm-rrss-url="<?php echo !is_admin() ? 'https://twitter.com/intent/tweet?text='.get_the_title().' '.get_permalink().' vía @'.get_option(MWM_RRSS_SLUG.'-twitter') : ''; ?>"><i class="icon-rrss-twitter"></i><?php echo (strcmp($appearance, '1') == 0 || strcmp($appearance, '2') == 0 || strcmp($appearance, '3') == 0 || strcmp($appearance, '4') == 0) ? __( "Twitter", 'mowomo-redes-sociales' ) : ''; ?></a>
            <?php endif; ?>

            <?php if (in_array('facebook', $actives)) : ?>
                <a class="mwm_rrss mwm_facebook" mwm-rrss-url="<?php echo !is_admin() ? 'https://www.facebook.com/sharer/sharer.php?u='. get_permalink() : ''; ?>"><i class="icon-rrss-facebook"></i><?php echo (strcmp($appearance, '1') == 0 || strcmp($appearance, '2') == 0 || strcmp($appearance, '3') == 0 || strcmp($appearance, '4') == 0) ? __( "Facebook", "mwm-redes-sociales" ) : ''; ?></a>
            <?php endif; ?>

            <?php if (in_array('pinterest', $actives)) : ?>
                <a class="mwm_rrss mwm_pinterest" mwm-rrss-url="<?php echo !is_admin() ? 'http://pinterest.com/pin/create/button/?url='. get_permalink() .'&media='.get_the_post_thumbnail_url().'&description='.get_the_title() : ''; ?>"><i class="icon-rrss-pinterest"></i><?php echo (strcmp($appearance, '1') == 0 || strcmp($appearance, '2') == 0 || strcmp($appearance, '3') == 0 || strcmp($appearance, '4') == 0) ? __( "Pinterest", 'mowomo-redes-sociales' ) : ''; ?> </a>
            <?php endif; ?>

            <?php if (in_array('linkedin', $actives)) : ?>
                <a class="mwm_rrss mwm_linkedin" mwm-rrss-url="<?php echo !is_admin() ? 'https://www.linkedin.com/shareArticle?mini=true&url=' . get_permalink() . '&title=' . get_the_title() . '&source=' . get_the_post_thumbnail_url() : ''; ?>"><i class="icon-rrss-linkedin"></i><?php echo (strcmp($appearance, '1') == 0 || strcmp($appearance, '2') == 0 || strcmp($appearance, '3') == 0 || strcmp($appearance, '4') == 0) ? __( "Linkedin", 'mowomo-redes-sociales' ) : ''; ?> </a>
            <?php endif; ?>

            <?php if (in_array('whatsapp', $actives)) : ?>
                <a class="mwm_rrss mwm_whatsapp" mwm-rrss-url="<?php echo !is_admin() ? 'https://api.whatsapp.com/send?text='. get_the_title() .' – '.get_permalink() : ''; ?>" ><i class="icon-rrss-whatsapp"></i><?php echo (strcmp($appearance, '1') == 0 || strcmp($appearance, '2') == 0 || strcmp($appearance, '3') == 0 || strcmp($appearance, '4') == 0) ? __( "WhatsApp", 'mowomo-redes-sociales' ) : ''; ?> </a>
            <?php endif; ?>
        </div>
    <?php
}