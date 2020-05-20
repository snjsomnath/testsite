<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until	<main class="wrapper" id="site-content" role="main">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WPCake
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ); ?>" charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >

    <link rel="profile" href="http://gmpg.org/xfn/11">

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>
		<?php

			if ( function_exists( 'wp_body_open' ) ) {
				wp_body_open();
			} else {
				do_action( 'wp_body_open' );
			}
 		?>

		<a class="skip-link screen-reader-text" href="#site-content"><?php esc_html_e( 'Skip to the content', 'wpcake' ); ?></a>
		<a class="skip-link screen-reader-text" href="#menu-menu"><?php esc_html_e( 'Skip to the main menu', 'wpcake' ); ?></a>

		<?php
			$wpcake_enable_tb = get_theme_mod('wpcake_enable_topbar');
			if( ! empty( $wpcake_enable_tb ) && '' != get_theme_mod('wpcake_enable_topbar')){
				get_template_part( 'template-parts/top-bar' );
			}
		?>

		<?php
			$wpcake_pageid = wpcake_post_id();
			$wpcake_disable_head_meta = get_post_meta( $wpcake_pageid, 'wpcake-main-header-display', true);
			$wpcake_disable_head = get_theme_mod( 'wpcake_disable_header', false );

			$wpcake_mobile_logo = get_theme_mod('wpcake_custom_mobile_logo', false);

			 if( empty($wpcake_disable_head_meta) || 'disabled' != $wpcake_disable_head_meta):
  		 	if( empty( $wpcake_disable_head ) || 1 != $wpcake_disable_head):
				 ?>

				 <header role="banner">
					 <div class="header-inner">
						 <div class="site-identity<?php if($wpcake_mobile_logo): ?> has-mobile-logo<?php endif; ?>">

 							 <?php
 								 if ( function_exists( 'the_custom_logo' ) ) {
 									 the_custom_logo();
 								 }


	 						 ?>

							 <?php
								 if($wpcake_mobile_logo){?>
									 <a href="" class="custom-mobile-logo-link" rel="home" itemprop="url"><img src="<?php echo esc_url($wpcake_mobile_logo); ?>" class="custom-mobile-logo" alt="<?php bloginfo( 'name' ); ?>"></a>
								<?php }?>


 							 <?php
 							 	$wpcake_disable_blogname = get_theme_mod('wpcake_disable_blogname', false);
 								$wpcake_disable_blogdesc = get_theme_mod('wpcake_disable_blogdescription', true);

 								if( empty($wpcake_disable_blogname) || true != $wpcake_disable_blogname ): ?>

									<?php if( is_singular() ): ?>
										<h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h2>
									<?php else: ?>
										<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
									<?php endif; ?>

 								<?php endif; ?>

 					 		<?php
 								if( empty($wpcake_disable_blogdesc) || true != $wpcake_disable_blogdesc ):
 									if ( get_bloginfo( 'description' ) ) : ?>
 							 				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
 					 		<?php
 									endif;
 								endif;
 							?>

 						</div><!-- .site-identity -->


				 		<button type="button" class="toggle-menu" onclick="document.querySelector('body').classList.toggle('show-menu')"><?php esc_html_e( 'Menu', 'wpcake' ); ?></button>

						 <nav id="menu-menu" class="site-navigation" role="navigation">
						 	<?php wp_nav_menu( array( 'theme_location' => 'primary-menu') ); ?>
						 </nav>

					</div><!-- .header-inner -->
				 </header><!-- header -->

			<?php
			 endif;
		 endif;
		?>
