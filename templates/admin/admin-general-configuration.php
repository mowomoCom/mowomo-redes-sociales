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

mwm_title('Position of buttons');
mwm_table();

    mwm_select(
        'mwm_rrss_posicion',
        'Position of buttons',
        get_option('mwm_rrss_posicion'),
        array(
            '0' => 'Don\'t show',
            '1' => 'Before the post',
            '2' => 'After the post',
            '3' => 'Before and after the post'
        ),
        'Choose where you want to make the social buttons appear'
    );



mwm_endtable(); 
mwm_table();
    mwm_input_text(
        'mwm_rrss_twitter',
        'Usuario de Twitter',
        get_option('mwm_rrss_twitter'),
        'Introducir el usuario sin @. E.j: mowomocom'
    );
mwm_endtable(); 
mwm_title("Which buttons do you want to show?"); 
mwm_table(); 
mwm_toggle_twitter('mwm_rrss_actives[]',get_option('mwm_rrss_actives'),        array(
    'twitter' => 'Twitter',));
    mwm_toggles(
        'mwm_rrss_actives[]',
        get_option('mwm_rrss_actives'),
        array(
            'facebook' => 'Facebook',
            'pinterest' => 'Pinterest',
            'linkedin' => 'Linkedin',
            'whatsapp' => 'WhatsApp',
        )
    );

mwm_endtable(); 

/*
?>

<p><?php _e('ShortCode for use wherever you want',MWM_SLUG); ?> -->  [rrss_buttons <?php if($twitter){echo 'twitter="on" ';}
                                                                if($facebook){echo 'facebook="on" ';}
                                                                if($pinterest){echo 'pinterest="on" ';}
                                                                if($linkedin){echo 'linkdin="on" ';}
                                                                if($whatsapp){echo 'whatsapp="on" ';} ?>]</p>
    