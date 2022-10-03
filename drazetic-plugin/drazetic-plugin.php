<?php
/**
 * Plugin Name: Drazetic plugin
 * Plugin URI: http://burstbiz.com
 * Description: The very first plugin that I have ever created.
 * Version: 1.0
 * Author: Danijel Drazetic
 * Author URI: http://www.mywebsite.com
 */

//add_action( 'the_content', 'my_thank_you_text' );
//
//function my_thank_you_text ( $content ) {
//    return $content .= '<p>Thank you for reading!</p>';
//}


class drazeticWidget extends WP_Widget {
    function drazeticWidget() {
        $widget_ops = array(
            'classname' => 'drazeticWidget',
            'description' => 'simple calculator! '
        );

        $this->WP_Widget(
            'drazeticWidget',
            'drazeticWidget',
            $widget_ops
        );
    }

    function widget($args, $instance)
    { // widget sidebar output


          $plugin_url = plugin_dir_url(dirname(__FILE__, 1));
          wp_enqueue_style('css', $plugin_url . 'drazetic-plugin/assets/style.css');
          wp_enqueue_script('script', $plugin_url . 'drazetic-plugin/assets/script.js');
          extract($args, EXTR_SKIP);
          echo $before_widget; // pre-widget code from theme
          echo $this->greeting();
          echo $this->calculator();
          echo $after_widget; // post-widget code from theme

    }
    function greeting() {
        $plugin_url=plugin_dir_url( dirname( __FILE__, 1 ) );
        return file_get_contents($plugin_url . 'drazetic-plugin/additional.php');
    }


    function calculator() {
          $plugin_url=plugin_dir_url( dirname( __FILE__, 1 ) );
        return file_get_contents($plugin_url . 'drazetic-plugin/template-calc.phtml');
    }

}


add_action('widgets_init', function () {
    if( get_option('on_off')) {
        register_widget('drazeticWidget');
    }
});

add_action('wp_enqueue_scripts', 'callback_for_setting_up_scripts');
function callback_for_setting_up_scripts() {
    $plugin_url=plugin_dir_url( dirname( __FILE__, 1 ) );
    $script_url = $plugin_url . 'drazetic-plugin/assets/script.js';
    wp_register_style( 'namespace', $plugin_url .'drazetic-plugin/assets/style.css' );
    wp_enqueue_style( 'namespace' );
    wp_enqueue_script( 'namespaceformyscript', $script_url, array( 'jquery' ) );
}



add_action('admin_init', 'drazetic_plugin_register_settings');
function drazetic_plugin_register_settings() {

    register_setting('drazetic_plugin_options_group', 'first_field_name');

    register_setting('drazetic_plugin_options_group', 'second_field_name');

    register_setting('drazetic_plugin_options_group', 'on_off');
}

add_action('admin_menu', 'drazetic_plugin_setting_page');
function drazetic_plugin_setting_page() {

    add_options_page('Drazetic Plugin', 'Drazetic Plugin Setting', 'manage_options', 'drazetic-plugin-setting-url', 'drazetic_page_html_form');
    // drazetic_page_html_form is the function in which I have written the HTML for my drazetic plugin form.
}

function drazetic_page_html_form() { ?>
    <div class="wrap">
        <h2>Drazetic Plugin Setting Page Heading</h2>
        <form method="post" action="options.php">
            <?php settings_fields('drazetic_plugin_options_group'); ?>

            <table class="form-table">
                <tr>
                    <th><label for="third_field_id">On/Off Calculator Widget :</label></th>
                    <td>
                        <input type = 'checkbox' class="checkbox" id="on_off_id" name="on_off"   <?php echo  checked( 1, get_option('on_off'), false )  ?> value="1">
                    </td>
                </tr>
                <tr>
                    <th><label for="first_field_id">First Field Name:</label></th>
                    <td>
                        <input type = 'text' class="regular-text" id="first_field_id" name="first_field_name" value="<?php echo get_option('first_field_name'); ?>">
                    </td>
                </tr>

                <tr>
                    <th><label for="second_field_id">Second Field Name:</label></th>
                    <td>
                        <input type = 'text' class="regular-text" id="second_field_id" name="second_field_name" value="<?php echo get_option('second_field_name'); ?>">
                    </td>
                </tr>


            </table>

            <?php submit_button(); ?>
        </form>
    </div>
<?php }

function get_name()  {
return  get_option('first_field_name') . " " . get_option('second_field_name');
}
