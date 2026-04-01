<?php
/**
 * Range Button Customizer Control
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if WP_Customize_Control does not exsist.
if ( ! class_exists( 'WP_Customize_Control' ) ) {
    return null;
}

/**
 * This class is for the range control in the Customizer.
 *
 * @access public
 */
/** Range Control */

// Customizer slider control
class pixel_ebook_store_Slider extends WP_Customize_Control {
    public $type = 'slider_control';
    public function enqueue() {
        wp_enqueue_script( 'pixel-ebook-store-custom-controls-js', trailingslashit( esc_url(get_template_directory_uri()) ) . 'assets/js/custom-range-controls.js', array( 'jquery', 'jquery-ui-core' ), '1.0', true );
        wp_enqueue_style( 'pixel-ebook-store-custom-controls-css', trailingslashit( esc_url(get_template_directory_uri()) ) . 'assets/css/custom-range-controls.css', array(), '1.0', 'all' );
    }
    public function render_content() {
    ?>
        <div class="slider-custom-control">
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><input type="number" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-slider-value"  <?php $this->link(); ?> />
            <div class="slider" slider-min-value="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" slider-max-value="<?php echo esc_attr( $this->input_attrs['max'] ); ?>" slider-step-value="<?php echo esc_attr( $this->input_attrs['step'] ); ?>"></div><span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr( $this->input_attrs['reset'] ); ?>"></span>
        </div>
    <?php
    }
}