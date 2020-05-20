<?php
/**
 * Footer Widgets template
 *
 * @package WPCake WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


$wpcake_disable_widgets = get_theme_mod('wpcake_footer_widgets_layout');
if($wpcake_disable_widgets != 'disable'){
  ?>

  <div class="footer-widgets">
    <div class="footer-inner">
      <div class="widget-area">
        <?php dynamic_sidebar( 'footer-one' ); ?>
      </div>
      <div class="widget-area">
        <?php dynamic_sidebar( 'footer-two' ); ?>
      </div>
      <div class="widget-area">
        <?php dynamic_sidebar( 'footer-three' ); ?>
      </div>
      <div class="widget-area">
        <?php dynamic_sidebar( 'footer-four' ); ?>
      </div>
    </div>
  </div>

<?php
}
