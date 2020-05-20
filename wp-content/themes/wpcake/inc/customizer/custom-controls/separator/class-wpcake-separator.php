<?php
/**
 * Customizer Control: separator
 *
 * Creates a separator heading within the customizer.
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

class WPCake_Customize_Separator_Control extends WP_Customize_Control {

    public $type = 'sepatator_control';

		/**
		 * Enqueue control related scripts/styles.
		 *
		 * @access public
		 */
		public function enqueue() {
			$css_uri = WPCAKE_THEME_URI . 'inc/customizer/custom-controls/separator/';

			wp_enqueue_style( 'wpcake-separator', $css_uri . 'separator.css', null, WPCAKE_THEME_VERSION );

		}

    /**
    * Render the control's content.
    */
    public function render_content() {
    ?>
      <h2 class="wpcake-separator"><?php echo esc_html( $this->label ); ?></h2>
    <?php
    }

  }


  if ( ! class_exists( 'WPCake_Customize_Control' ) ) {

		class WPCake_Customize_Control extends WP_Customize_Control {
			public $content = '';

			/**
			 * Constructor
			 */
			function __construct( $manager, $id, $args ) {
				// Just calling the parent constructor here
				parent::__construct( $manager, $id, $args );
			}

			/**
			 * This function renders the control's content.
			 */
			public function render_content() {
				echo esc_html($this->content);
			}
		}

	}
