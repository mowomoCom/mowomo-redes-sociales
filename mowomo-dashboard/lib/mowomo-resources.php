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
 * @since 1.0.0
 */
if (!defined('ABSPATH') || !defined('MWM_RRSS_VERSION'))
{
    exit; // Exit if accessed directly.
}

if (!function_exists('mwm_title')) {
    function mwm_title($text) 
    {
        echo '<h2 class="form-title">'.$text.'</h2>';
    }
}

if (!function_exists('mwm_table')) {
    function mwm_table() 
    {
        ?>
            <table class="form-table">
                <tbody>
        <?php
    }
}

if (!function_exists('mwm_endtable')) {
    function mwm_endtable() 
    {
        ?>
                </tbody>
            </table>
        <?php 
    }
}

if (!function_exists('mwm_select')) {
    function mwm_select($name, $label, $value, $options, $help = null)
    {
        ?>
            <tr>
                <th><label><?php echo $label ?></label></th>
                <td>
                    <select name="<?php echo $name; ?>">
                        <?php foreach($options as $index => $option ) : ?>
                        <option value="<?php echo $index; ?>" <?php if( $value == $index ) { echo "selected";} ?>><?php echo $option ?></option>
                        <?php endforeach; ?>
                    </select>
    
                    <?php if ($help) : ?>
                        <p class="description"><?php echo $help ?></p>
                    <?php endif; ?>
                    
                </td>
            </tr>
        <?php
    }
}

if (!function_exists('mwm_input_text')) {
    function mwm_input_text($name, $label, $value, $help = null, $enabled = true, $copy = false)
    {
        ?>
            <tr>
                <th><label for="<?php echo $name; ?>"><?php echo $label ?></label></th>
                <td>
                    <?php if(!$copy) : ?>
                        <input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo $value; ?>" <?php echo !$enabled ? "readonly" : ""; ?>>
                    <?php else : ?>
                        <div class="input-group">
                            <input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo $value; ?>" <?php echo !$enabled ? "readonly" : ""; ?>>
                            <button type="button"><?php echo __("Copy", 'mowomo-dashboard'); ?></button>
                        </div>
                    <?php endif; ?>
                    
    
                    <?php if ($help) : ?>
                        <p class="description"><?php echo $help ?></p>
                    <?php endif; ?>
                </td>
            </tr>
        <?php
    }
}

if (!function_exists('mwm_toggles')) {
    function mwm_toggles($name, $values, $options)
    {
        foreach($options as $index => $option ) : ?>
            <?php if(is_array($option)) : ?>
                <tr>
                    <th><?php echo $option[0] ?></th>
                    <td>
                        <input type="checkbox" name="<?php echo $name; ?>" value="<?php echo $index; ?>" class="mwm-toggle" <?php if(in_array($index, $values)){echo "checked";} ?> />
                        <label for="<?php echo $name; ?>" class="mwm-toggle"><?php echo $option[0]; ?></label>
                        <?php if (isset($option[1])) : ?>
                            <p class="description"><?php echo $option[1]; ?></p>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php else: ?>
                <tr>
                    <th><?php echo $option ?></th>
                    <td>
                        <input type="checkbox" name="<?php echo $name; ?>" value="<?php echo $index; ?>" class="mwm-toggle" <?php if(in_array($index, $values)){echo "checked";} ?> />
                        <label for="<?php echo $name; ?>" class="mwm-toggle"><?php echo $option; ?></label>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach;
    }
}

if (!function_exists('mwm_toggles_shortcodes')) {
    function mwm_toggles_shortcodes($name, $values, $options)
    {
        foreach($options as $index => $option ) : ?>
            <?php if(is_array($option)) : ?>
                <tr>
                    <th><?php echo $option[0]; ?></th>
                    <td>
                        <input type="checkbox" name="<?php echo $name; ?>" value="<?php echo $index; ?>" class="mwm-toggle" <?php if(in_array($index, $values)){echo "checked";} ?> />
                        <label for="<?php echo $name; ?>" class="mwm-toggle"><?php echo $option[0]; ?></label>
                        <?php if (isset($option[1])) : ?>
                            <p class="description"><?php echo $option[1]; ?></p>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php else: ?>
                <tr>
                    <th><?php echo $option; ?></th>
                    <td>
                        <input type="checkbox" name="<?php echo $name; ?>" value="<?php echo $index; ?>" class="mwm-toggle" <?php if(in_array($index, $values)){echo "checked";} ?> />
                        <label for="<?php echo $name; ?>" class="mwm-toggle"><?php echo $option; ?></label>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach;
    }
}

/**
 * Simple Templating function from plugin path
 *
 * @param $slug   - Slug of the file.
 * @param $name   - Name of the file.
 * @return string - Output of the template file. Likely HTML.
 */
if (!function_exists('mwm_template')) {
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
}

/**
 * Advance Templating function that load the plugin admin tab
 *
 * @param $slug   - Slug of the file.
 * @param $name   - Name of the file.
 * @return string - Output of the template file. Likely HTML.
 */
if (!function_exists('mwm_template_admin')) {
    function mwm_template_admin(){
        // Make the file
        $file = MWM_FRA_TPL.'schema/admin-base-plugin.php';
    
        // Ensure the file exists
        if ( !file_exists( $file ) ) {
            return '';
        }
      
        // Buffer the output (including the file is "output")
        return load_template($file);
    }
}

/**
 * Simple Templating function from plugin dashboard path
 *
 * @param $slug   - Slug of the file.
 * @param $name   - Name of the file.
 * @return string - Output of the template file. Likely HTML.
 */
if (!function_exists('mwm_dashboard_template')) {
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
}

/**
 * Advance Templating function that load the plugin dashboard admin tab
 *
 * @param $slug   - Slug of the file.
 * @param $name   - Name of the file.
 * @return string - Output of the template file. Likely HTML.
 */
if (!function_exists('mwm_dashboard_admin')) {
    function mwm_dashboard_admin(){
        // Make the file
        $file = MWM_FRA_TPL.'schema/admin-base.php';
    
        // Ensure the file exists
        if ( !file_exists( $file ) ) {
            return '';
        }
      
        // Buffer the output (including the file is "output")
        return load_template($file);
    }
}

/**
 * Return the post url
 *
 * @since      1.0.0
 *
 * @return string
*/
if (!function_exists('mwm_rrss_get_post_url')) {
    function mwm_rrss_get_post_url()
    {
        global $post;
    
        $post_url = get_permalink( $post );
    
        return apply_filters( 'mwm_rrss_get_post_url', $post_url, $post->ID );
    }
}

/**
 * Show advance information about the variable
 *
 * @since      1.0.0
 *
 * @return void
*/
if(!function_exists('echop')) {
    function echop($var)
    {
    echo '<pre>',var_dump($var),'</pre>';
    }
}

/**
 * Get if two strings are equals or not
 *
 * @since      1.0.0
 *
 * @return void
*/
if(!function_exists('equals')) {
    function equals(string $string1, string $string2)
    {
        if (strcmp($string1, $string2) == 0) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Get slug from text
 *
 * @since      1.0.0
 *
 * @return string
*/
if(!function_exists('slugify')) {
    function slugify($text)
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        
        if (empty($text)) return 'n-a';
    
        return $text;
    }
}