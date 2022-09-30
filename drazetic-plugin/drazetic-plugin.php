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
              $plugin_url=plugin_dir_url( dirname( __FILE__, 1 ) );
              wp_enqueue_style( 'css', $plugin_url . 'drazetic-plugin/assets/style.css');
              wp_enqueue_script( 'script', $plugin_url . 'drazetic-plugin/assets/script.js');
              extract($args, EXTR_SKIP);
              echo $before_widget; // pre-widget code from theme
              echo $this->calculator();
              echo $after_widget; // post-widget code from theme
          }

          function calculator() {

        $calculator = <<<HTML

<h1 class="calculator-title">CALCULATOR</h1>
<div  id="calculator" class="calculator">
  
     <textarea disabled class="showResult" value="" rows="2" cols="20"></textarea>
    <div class="justify-content-around  d-flex  ">
        <div class="numbersCalc ">
            <button value="1" class="btn operationCalculator numberCalc">1</button>
            <button value="2" class="btn operationCalculator numberCalc">2</button>
            <button value="3" class="btn operationCalculator numberCalc">3</button>
            <button value="4" class="btn operationCalculator numberCalc">4</button>
            <button value="5" class="btn operationCalculator numberCalc">5</button>
            <button value="6" class="btn operationCalculator numberCalc">6</button>
            <button value="7" class="btn operationCalculator numberCalc">7</button>
            <button value="8" class="btn operationCalculator numberCalc">8</button>
            <button value="9" class="btn operationCalculator numberCalc">9</button>
            <button value="0" class="btn operationCalculator numberCalc">0</button>
            <button value="=" id="evaluate"  class="btn numberCalc">=</button>
            <button value="" id="clearCalc" class="btn numberCalc">C</button>
        </div>
         <div class="operationsCalc">
            <button value="+" class="btn operation operationCalculator numberCalc">+</button>
            <button value="-" class="btn operation operationCalculator numberCalc">-</button>
            <button value="*" class="btn operation operationCalculator numberCalc">*</button>
            <button value="/" class="btn operation operationCalculator numberCalc">/</button>
        </div>
    </div>

</div>

HTML;
     return $calculator;
          }

}


add_action('widgets_init', function () {
    register_widget('drazeticWidget');
});

add_action('wp_enqueue_scripts', 'callback_for_setting_up_scripts');
function callback_for_setting_up_scripts() {
    $plugin_url=plugin_dir_url( dirname( __FILE__, 1 ) );
    $script_url = $plugin_url . 'drazetic-plugin/assets/script.js';
    wp_register_style( 'namespace', $plugin_url .'drazetic-plugin/assets/style.css' );
    wp_enqueue_style( 'namespace' );
    wp_enqueue_script( 'namespaceformyscript', $script_url, array( 'jquery' ) );
}
