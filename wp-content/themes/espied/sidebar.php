<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Espied
 */
?>

<a href="#sidebar" class="sidebar-toggle"><span class="screen-reader-text"><?php _e( 'Toggle Sidebar', 'espied' ); ?></span></a>

<div id="sidebar" class="sidebar">
	<nav id="site-navigation" class="main-navigation" role="navigation">
		<h1 class="menu-heading"><?php _e( 'Menu', 'espied' ); ?></h1>
		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	</nav><!-- #site-navigation -->

	<?php if ( has_nav_menu( 'social' ) ) : ?>
	<nav id="social-navigation" class="social-navigation" role="navigation">
		<h1 class="menu-heading"><?php _e( 'Connect', 'espied' ); ?></h1>
		<?php wp_nav_menu( array( 'theme_location' => 'social', 'depth' => 1, 'link_before' => '<span class="screen-reader-text">', 'link_after' => '</span>' ) ); ?>
	</nav><!-- #social-navigation -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #secondary -->
	<?php endif; ?>
</div>