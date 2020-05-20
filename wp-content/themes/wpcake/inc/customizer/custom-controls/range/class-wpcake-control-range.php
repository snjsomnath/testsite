<?php
/**
 * Customizer Control: slider.
 *
 * Creates a jQuery slider control.
 *
 * @package     WPCake
 * @author      WPCake
 * @link        https://wpcake.com/
 * @since       1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPCake_Slider_Custom_Control extends WP_Customize_Control
{
    public $type = 'slider_control';

		/**
		 * Enqueue control related scripts/styles.
		 *
		 * @access public
		 */
		public function enqueue() {
			$file_uri = WPCAKE_THEME_URI . 'inc/customizer/custom-controls/range/';

			wp_enqueue_script( 'wpcake-range', $file_uri . 'range.js', array( 'jquery', 'jquery-ui-core' ), WPCAKE_THEME_VERSION, true );
			wp_enqueue_style( 'wpcake-range', $file_uri . 'range.css', null, WPCAKE_THEME_VERSION );

		}

    public function render_content() {
        ?>
				<div class="slider-custom-control">
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><input type="number" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-slider-value" <?php $this->link(); ?> />
					<div class="slider" slider-min-value="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" slider-max-value="<?php echo esc_attr( $this->input_attrs['max'] ); ?>" slider-step-value="<?php echo esc_attr( $this->input_attrs['step'] ); ?>"></div><span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr( $this->value() ); ?>"></span>
				</div>
        <?php
    }

}
