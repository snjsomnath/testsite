<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Espied
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses espied_header_style()
 * @uses espied_admin_header_style()
 * @uses espied_admin_header_image()
 *
 * @package Espied
 */
function espied_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'espied_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'ffffff',
		'width'                  => 1600,
		'height'                 => 320,
		'flex-height'            => true,
		'wp-head-callback'       => 'espied_header_style',
		'admin-head-callback'    => 'espied_admin_header_style',
		'admin-preview-callback' => 'espied_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'espied_custom_header_setup' );

if ( ! function_exists( 'espied_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see espied_custom_header_setup().
 */
function espied_header_style() {
	$header_text_color = get_header_textcolor();
	$header_image = get_header_image();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color && empty( $header_image ) ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-header {
			min-height: 0;
			padding: 0;
		}

		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-title a:hover,
		.site-title a:focus,
		.site-description {
			color: #<?php echo $header_text_color; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // espied_header_style

if ( ! function_exists( 'espied_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see espied_custom_header_setup().
 */
function espied_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		.displaying-header-wrapper {
			background-color: #000;
		}
		.displaying-header-wrapper:before,
		.displaying-header-wrapper:after {
			content: "";
			display: table;
		}
		.displaying-header-wrapper:after {
			clear: both;
		}
		#headimg h1 {
			font-family: Montserrat, sans;
		}
		#desc {
			font-family: "Open Sans", sans;
		}
		#headimg h1 {
			float: left;
			font-size: 19px;
			font-weight: 700;
			line-height: 24px;
			margin: 24px 0 24px 24px;
		}
		#headimg h1 a {
			color: #fff;
			text-decoration: none;
		}
		#desc {
			color: #fff;
			float: left;
			font-size: 11px;
			font-weight: 400;
			line-height: 16px;
			margin: 31px 0 0 12px;
			opacity: 0.6;
		}
		#headimg img {
			vertical-align: middle;
		}
		.displaying-header-image img {
			width: 100%;
			height: auto;
		}
	</style>
<?php
}
endif; // espied_admin_header_style

if ( ! function_exists( 'espied_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see espied_custom_header_setup().
 */
function espied_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<div class="displaying-header-wrapper">
			<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		</div>
		<?php if ( get_header_image() ) : ?>
		<div class="displaying-header-image">
			<img src="<?php header_image(); ?>" alt="">
		</div>
		<?php endif; ?>
	</div>
<?php
}
endif; // espied_admin_header_image
