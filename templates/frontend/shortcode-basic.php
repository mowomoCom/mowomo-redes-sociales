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

// Fetching atts from shortcode loader
$atts = $mwm_rrss_atts;
?>

<!-- mowomo-redes-sociales-icons-bar -->
<?php

if (!($appearance = get_option(MWM_RRSS_SLUG.'-appearance'))) {
    $appearance = '1';
}
if (!($alignment = get_option(MWM_RRSS_SLUG.'-alignment'))) {
    $alignment = '1';
}

$actives = array();
if (array_key_exists('twitter', $atts)) {
    if (strcmp($atts['twitter'], 'on') == 0) {
        array_push($actives, 'twitter');
    }
}
if (array_key_exists('facebook', $atts)) {
    if (strcmp($atts['facebook'], 'on') == 0) {
        array_push($actives, 'facebook');
    }
}
if (array_key_exists('pinterest', $atts)) {
    if (strcmp($atts['pinterest'], 'on') == 0) {
        array_push($actives, 'pinterest');
    }
}
if (array_key_exists('linkedin', $atts)) {
    if (strcmp($atts['linkedin'], 'on') == 0) {
        array_push($actives, 'linkedin');
    }
}
if (array_key_exists('whatsapp', $atts)) {
    if (strcmp($atts['whatsapp'], 'on') == 0) {
        array_push($actives, 'whatsapp');
    }
}

$args = array(
    'actives' => $actives,
    'appearance' => $appearance,
    'alignment' => $alignment
);

mwm_show_rrss_buttons($args);

?>