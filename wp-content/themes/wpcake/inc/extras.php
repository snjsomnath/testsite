<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package     WPCake
 * @author      WPCake
 * @link        https://wpcake.com/
 * @since       WPCake 1.0
 */

if ( ! function_exists( 'wpcake_get_theme_name' ) ) :

	/**
	 * Get theme name.
	 *
	 * @return string Theme Name.
	 */
	function wpcake_get_theme_name() {

		$theme_name = __( 'WPCake', 'wpcake' );

		return apply_filters( 'wpcake_theme_name', $theme_name );
	}

endif;
