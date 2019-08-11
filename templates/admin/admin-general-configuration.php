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

// Args
$rrss = get_option(MWM_RRSS_SLUG.'-actives');
if (!is_array($rrss)) {
    update_option( MWM_RRSS_SLUG.'-actives', array());
    $rrss = array();
}

$shortcode = '[rrss_buttons';
if (in_array('twitter', $rrss)) {
    $shortcode .= ' twitter=\'on\'';
}
if (in_array('facebook', $rrss)) {
    $shortcode .= ' facebook=\'on\'';
}
if (in_array('pinterest', $rrss)) {
    $shortcode .= ' pinterest=\'on\'';
}
if (in_array('linkedin', $rrss)) {
    $shortcode .= ' linkedin=\'on\'';
}
if (in_array('whatsapp', $rrss)) {
    $shortcode .= ' whatsapp=\'on\'';
}
$shortcode .= "]";

// Structure
mwm_title('Position of buttons');
mwm_table();
    mwm_select(
        MWM_RRSS_SLUG.'-posicion',
        'Position of buttons',
        get_option(MWM_RRSS_SLUG.'-posicion'),
        array(
            '0' => 'Don\'t show',
            '1' => 'Before the post',
            '2' => 'After the post',
            '3' => 'Before and after the post'
        ),
        'Choose where you want to make the social buttons appear'
    );
    mwm_input_text(
        MWM_RRSS_SLUG.'-twitter',
        'Usuario de Twitter',
        get_option(MWM_RRSS_SLUG.'-twitter'),
        'Introducir el usuario sin @. E.j: mowomocom'
    );
mwm_endtable(); 

mwm_title("Which buttons do you want to show?"); 
mwm_table(); 
    mwm_toggles(
        MWM_RRSS_SLUG.'-actives[]',
        get_option(MWM_RRSS_SLUG.'-actives'),
        array(
            'twitter' => 'Twitter',
            'facebook' => 'Facebook',
            'pinterest' => 'Pinterest',
            'linkedin' => 'Linkedin',
            'whatsapp' => 'WhatsApp',
        )
    );
    mwm_input_text(
        'mwm_rrss_shortcode',
        'Shortcode para que lo uses donde quieras',
        $shortcode,
        null,
        false,
        true
    );
mwm_endtable(); 