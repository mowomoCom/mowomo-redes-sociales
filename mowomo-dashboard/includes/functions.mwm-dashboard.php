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
if (!defined('ABSPATH') || !defined('MWM_RRSS_VERSION'))
{
    exit; // Exit if accessed directly.
}

function mwm_title($text) 
{
    echo '<h2 class="form-title">'.__($text, MWM_RRSS_SLUG).'</h2>';
}

function mwm_table() 
{
    ?>
        <table class="form-table">
            <tbody>
    <?php
}

function mwm_endtable() 
{
    ?>
            </tbody>
        </table>
    <?php 
}

function mwm_select($name, $label, $value, $options, $help = null)
{
    ?>
        <tr>
            <th><label><?php echo __($label, MWM_RRSS_SLUG); ?></label></th>
            <td>
                <select name="<?php echo $name; ?>">
                    <?php foreach($options as $index => $option ) : ?>
                    <option value="<?php echo $index; ?>" <?php if( $value == $index ) { echo "selected";} ?>><?php echo __($option, MWM_RRSS_SLUG); ?></option>
                    <?php endforeach; ?>
                </select>

                <?php if ($help) : ?>
                    <p class="description"><?php echo __($help, MWM_RRSS_SLUG); ?></p>
                <?php endif; ?>
                
            </td>
        </tr>
    <?php
}

function mwm_input_text($name, $label, $value, $help = null, $enabled = true, $copy = false)
{
    ?>
        <tr>
            <th><label for="<?php echo $name; ?>"><?php echo __($label, MWM_RRSS_SLUG); ?></label></th>
            <td>
                <?php if(!$copy) : ?>
                    <input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo $value; ?>" <?php echo !$enabled ? "readonly" : ""; ?>>
                <?php else : ?>
                    <div class="input-group">
                        <input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo $value; ?>" <?php echo !$enabled ? "readonly" : ""; ?>>
                        <button type="button"><?php echo __("Copiar", MWM_RRSS_SLUG); ?></button>
                    </div>
                <?php endif; ?>
                

                <?php if ($help) : ?>
                    <p class="description"><?php echo __($help, MWM_RRSS_SLUG); ?></p>
                <?php endif; ?>
            </td>
        </tr>
    <?php
}

function mwm_toggles($name, $values, $options)
{
    foreach($options as $index => $option ) : ?>
        <?php if(is_array($option)) : ?>
            <tr>
                <th><?php echo __($option[0], MWM_RRSS_SLUG); ?></th>
                <td>
                    <input type="checkbox" name="<?php echo $name; ?>" value="<?php echo $index; ?>" class="mwm-toggle" <?php if(in_array($index, $values)){echo "checked";} ?> />
                    <label for="<?php echo $name; ?>" class="mwm-toggle"><?php echo $option[0]; ?></label>
                    <?php if (isset($option[1])) : ?>
                        <p class="description"><?php echo __($option[1], MWM_RRSS_SLUG); ?></p>
                    <?php endif; ?>
                </td>
            </tr>
        <?php else: ?>
            <tr>
                <th><?php echo __($option, MWM_RRSS_SLUG); ?></th>
                <td>
                    <input type="checkbox" name="<?php echo $name; ?>" value="<?php echo $index; ?>" class="mwm-toggle" <?php if(in_array($index, $values)){echo "checked";} ?> />
                    <label for="<?php echo $name; ?>" class="mwm-toggle"><?php echo $option; ?></label>
                </td>
            </tr>
        <?php endif; ?>
    <?php endforeach;
}

/**
 * Simple Templating function from plugin path
 *
 * @param $slug   - Slug of the file.
 * @param $name   - Name of the file.
 * @return string - Output of the template file. Likely HTML.
 */
function mwm_template( $slug, $name, $args = null ){
    // Make the file
    $file = MWM_FRA_PLU_TPL.$slug.'-'.$name.'.php';

    // Ensure the file exists
    if ( !file_exists( $file ) ) {
        return '';
    }

    // Make values in the associative array easier to access by extracting them
    if ( is_array( $args ) ){
        extract( $args );
    }
  
    // Buffer the output (including the file is "output")
    return load_template($file);
}

/**
 * Advance Templating function that load the plugin admin tab
 *
 * @param $slug   - Slug of the file.
 * @param $name   - Name of the file.
 * @return string - Output of the template file. Likely HTML.
 */
function mwm_template_admin(){
    // Make the file
    $file = MWM_FRA_TPL.'admin/admin-base-plugin.php';

    // Ensure the file exists
    if ( !file_exists( $file ) ) {
        return '';
    }
  
    // Buffer the output (including the file is "output")
    return load_template($file);
}

/**
 * Simple Templating function from plugin dashboard path
 *
 * @param $slug   - Slug of the file.
 * @param $name   - Name of the file.
 * @return string - Output of the template file. Likely HTML.
 */
function mwm_dashboard_template( $slug, $name, $args = null ){
    // Make the file
    $file = MWM_FRA_TPL.$slug.'-'.$name.'.php';

    // Ensure the file exists
    if ( !file_exists( $file ) ) {
        return '';
    }

    // Make values in the associative array easier to access by extracting them
    if ( is_array( $args ) ){
        extract( $args );
    }
  
    // Buffer the output (including the file is "output")
    return load_template($file);
}

/**
 * Advance Templating function that load the plugin dashboard admin tab
 *
 * @param $slug   - Slug of the file.
 * @param $name   - Name of the file.
 * @return string - Output of the template file. Likely HTML.
 */
function mwm_dashboard_admin(){
    // Make the file
    $file = MWM_FRA_TPL.'admin/admin-base.php';

    // Ensure the file exists
    if ( !file_exists( $file ) ) {
        return '';
    }
  
    // Buffer the output (including the file is "output")
    return load_template($file);
}

/**
 * Return the post url
 *
 * @since      1.0.0
 *
 * @return string
*/
function mwm_rrss_get_post_url()
{
    global $post;

    $post_url = get_permalink( $post );

    return apply_filters( 'mwm_rrss_get_post_url', $post_url, $post->ID );
}

/**
 * Return pro plugins
 *
 * @since      1.0.0
 *
 * @return string
*/
function mwm_pro_plugins()
{
    return get_option('mwm-plugins');
}

/**
 * Return no pro plugins
 *
 * @since      1.0.0
 *
 * @return string
*/
function mwm_no_pro_plugins()
{
    $plugins = mwm_pro_plugins();
    $no_pro_plugins = array();
    foreach ($plugins as $key => $value) {
        if (!$value['pro']) {
            $no_pro_plugins = array_merge($no_pro_plugins, array($key => $value));
        }
    }
    return $no_pro_plugins;
}

/**
 * Return every notice from the plugins
 *
 * @since      1.0.0
 *
 * @return string
*/
function mwm_plugin_notices()
{
    return get_option('mwm-plugin-notices');
}