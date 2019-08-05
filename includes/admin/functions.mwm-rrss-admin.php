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

function mwm_title($text) {
    echo '<h2 class="form-title">'.__($text, MWM_SLUG).'</h2>';
}

function mwm_table() {
    ?>
        <table class="form-table">
            <tbody>
    <?php
}

function mwm_endtable() {
    ?>
            </tbody>
        </table>
    <?php 
}

function mwm_select($name, $label, $value, $options, $help = null) {
    ?>
        <tr>
            <th><label><?php echo __($label, MWM_SLUG); ?></label></th>
            <td>
                <select name="<?php echo $name; ?>">
                    <?php foreach($options as $index => $option ) : ?>
                    <option value="<?php echo $index; ?>" <?php if( $value == $index ) { echo "selected";} ?>><?php echo __($option, MWM_SLUG); ?></option>
                    <?php endforeach; ?>
                </select>

                <?php if ($help) : ?>
                    <p class="description"><?php echo __($help, MWM_SLUG); ?></p>
                <?php endif; ?>
                
            </td>
        </tr>
    <?php
}

function mwm_input_text($name, $label, $value, $help = null) {
    ?>
        <tr>
            <th><label for="<?php echo $name; ?>"><?php echo __($label, MWM_SLUG); ?></label></th>
            <td>
                <input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo $value; ?>">

                <?php if ($help) : ?>
                    <p class="description"><?php echo __($help, MWM_SLUG); ?></p>
                <?php endif; ?>
            </td>
        </tr>
    <?php
}

function mwm_toggles($name, $values, $options) {
    foreach($options as $index => $option ) : ?>
        <tr>
            <th><?php echo __($option, MWM_SLUG); ?></th>
            <td>
                <input type="checkbox" name="<?php echo $name; ?>" value="<?php echo $index; ?>" class="mwm-toggle" <?php if(in_array($index, $values)){echo "checked";} ?> />
                <label for="<?php echo $name; ?>" class="mwm-toggle"><?php echo $option; ?></label>
            </td>
        </tr>
    <?php endforeach;
}


function mwm_toggle_twitter($name, $values, $options) {
     ?>
        <tr>
            <th><?php echo __($option, MWM_SLUG); ?></th>
            <td>
                <input type="checkbox" name="<?php echo $name; ?>" value="<?php echo $index; ?>" class="mwm-toggle" <?php if(in_array($index, $values)){echo "checked";} ?> />
                <label for="<?php echo $name; ?>" class="mwm-toggle"><?php echo $option; ?></label>
            </td>
            <td>
                <input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo $value; ?>">

                <?php if ($help) : ?>
                    <p class="description"><?php echo __($help, MWM_SLUG); ?></p>
                <?php endif; ?>
            </td>
        </tr>
    <?php 
}