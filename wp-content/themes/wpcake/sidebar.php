<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package WPCake WordPress theme
 */

	// Return if full width or full screen
	if ( wpcake_sidebar_layout() == 'no-sidebar' ) {
		return;
	}

?>

<?php do_action( 'wpcake_before_sidebar' ); ?>

<aside id="right-sidebar" class="sidebar-container widget-area sidebar-primary">

	<?php do_action( 'wpcake_before_sidebar_inner' ); ?>

	<div id="right-sidebar-inner" class="clr">

		<?php
		$wpcakeSidebar = wpcake_get_sidebar();
		if ( $wpcakeSidebar ) {
			dynamic_sidebar( $wpcakeSidebar );
		} ?>

	</div><!-- #sidebar-inner -->

	<?php do_action( 'wpcake_after_sidebar_inner' ); ?>

</aside><!-- #right-sidebar -->

<?php do_action( 'wpcake_after_sidebar' ); ?>
