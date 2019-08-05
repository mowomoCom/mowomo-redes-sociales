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

// Fetching atts from shortcode loader
$atts = $mwm_rrss_atts;
?>

<!-- mowomo-redes-sociales-icons-bar -->
<div class="mwm_rrss_contenedor">
    <?php if ($atts['twitter'] == "on") : ?>
        <a class="mwm_rrss mwm_twitter" mwm-rrss-url="<?php echo 'https://twitter.com/intent/tweet?text='.get_the_title().' '.get_permalink().' vía @'.get_option('mwm_rrss_twitter'); ?>"><i class="icon-rrss-twitter"></i> <?php echo esc_html( __( "Twitter", MWM_SLUG ) ); ?> </a>
    <?php endif; ?>

    <?php if ($atts['facebook'] == "on") : ?>
        <a class="mwm_rrss mwm_facebook" mwm-rrss-url="<?php echo 'https://www.facebook.com/sharer/sharer.php?u='. get_permalink(); ?>"><i class="icon-rrss-facebook"></i> <?php echo esc_html( __( "Facebook", "mwm-redes-sociales" ) ); ?> </a>
    <?php endif; ?>

    <?php if ($atts['pinterest'] == "on") : ?>
        <a class="mwm_rrss mwm_pinterest" mwm-rrss-url="<?php echo 'http://pinterest.com/pin/create/button/?url='. get_permalink() .'&media='.get_the_post_thumbnail_url().'&description='.get_the_title(); ?>"><i class="icon-rrss-pinterest"></i> <?php echo esc_html( __( "Pinterest", MWM_SLUG ) ); ?> </a>
    <?php endif; ?>

    <?php if ($atts['linkdin'] == "on") : ?>
        <a class="mwm_rrss mwm_linkedin" mwm-rrss-url="<?php echo 'https://www.linkedin.com/shareArticle?mini=true&url=' . get_permalink() . '&title=' . get_the_title() . '&source=' . get_the_post_thumbnail_url(); ?>"><i class="icon-rrss-linkedin"></i> <?php echo esc_html( __( "Linkedin", MWM_SLUG ) ); ?> </a>
    <?php endif; ?>

    <?php if ($atts['whatsapp'] == "on") : ?>
        <a class="mwm_rrss mwm_whatsapp" href="<?php echo 'whatsapp://send?text='. get_the_title() .' – '.get_permalink(); ?>" data-action="share/whatsapp/share"><i class="icon-rrss-whatsapp"></i> <?php echo esc_html( __( "WhatsApp", MWM_SLUG ) ); ?> </a>
    <?php endif; ?>
</div>