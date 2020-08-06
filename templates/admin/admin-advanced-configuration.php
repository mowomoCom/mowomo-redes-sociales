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
if (!($appearance = get_option(MWM_RRSS_SLUG.'-appearance'))) {
    $appearance = '1';
    update_option( MWM_RRSS_SLUG.'-appearance', '1');
}
if (!($alignment = get_option(MWM_RRSS_SLUG.'-alignment'))) {
    $alignment = '1';
    update_option( MWM_RRSS_SLUG.'-alignment', '1');
}
$actives = get_option(MWM_RRSS_SLUG.'-actives');
if (!is_array($actives)) {
    update_option( MWM_RRSS_SLUG.'-actives', array());
    $actives = array();
}
$options = array(
    '1' => __( 'Colored with square edges','mowomo-redes-sociales'),
    '2' => __( 'Colored with slightly rounded edges','mowomo-redes-sociales'),
    '5' => __( 'Only colored icon with square borders','mowomo-redes-sociales'),
    '6' => __( 'Only colored icon with slightly rounded edges','mowomo-redes-sociales'),
    '7' => __( 'Only colored icon with rounded edges','mowomo-redes-sociales'),
    '3' => __( 'In black and white with square edges','mowomo-redes-sociales'),
    '4' => __( 'In black and white with slightly rounded edges','mowomo-redes-sociales'),
    '8' => __( 'Only black and white icon with square borders','mowomo-redes-sociales'),
    '9' => __( 'Only black and white icon with slightly rounded edges','mowomo-redes-sociales'),
    '10' => __( 'Only black and white icon with rounded edges','mowomo-redes-sociales'),
);

// Structure
mwm_title(__('Button desing', 'mowomo-redes-sociales'));
mwm_table();

?>

<tr>
    <th><?php echo __('Appearance', 'mowomo-redes-sociales'); ?></th>
    <td>
        <div class="mwm-option-boxes">
            <?php foreach ($options as $key => $option) : ?>

                <div class="mwm-option-box <?php echo strcmp($appearance, $key) == 0 ? 'active' : ''; ?>" mwm-option-box="<?php echo $key; ?>">
                    <div>
                        <input type="radio" name="<?php echo MWM_RRSS_SLUG.'-appearance'; ?>" value="<?php echo $key; ?>" <?php echo strcmp($appearance, $key) == 0 ? 'checked' : ''; ?>>
                        <label><?php echo $option; ?></label>
                    </div>
                    
                    <?php mwm_show_rrss_buttons(array(
                        'actives' => $actives,
                        'appearance' => $key,
                        'alignment' => $alignment
                    )) ?>

                </div>
            <?php endforeach; ?>
        </div>
    </td>
</tr>

<?php
    mwm_select(
        MWM_RRSS_SLUG.'-alignment',
        __('Button alignment','mowomo-redes-sociales'),
        $alignment,
        array(
            '1' => __('On the left', 'mowomo-redes-sociales'),
            '2' => __('In the middle', 'mowomo-redes-sociales'),
            '3' => __('On the right', 'mowomo-redes-sociales'),
        )
    );
mwm_endtable(); 