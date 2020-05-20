<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Neptune WP
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses xi_portfolioheader_style()
 */
function xi_portfoliocustom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'xi_portfoliocustom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'eee',
		'width'                  => 1920,
		'height'                 => 550,
		'flex-height'            => true,
		//'default-image' 		 => get_template_directory_uri() . '/img/header-default.jpg',
		'uploads'       		 => true,
		'wp-head-callback'       => 'xi_portfolioheader_style',
	) ) );
}
add_action( 'after_setup_theme', 'xi_portfoliocustom_header_setup' );

if ( ! function_exists( 'xi_portfolioheader_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see xi_portfoliocustom_header_setup().
	 */
	function xi_portfolioheader_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
		?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
			// If the user has set a custom color for the text use that.
			else :
		?>
			.site-title a,
			h1.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
			#menu-icon span {
				background: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;
