<?php
/**
 * Topbar layout
 *
 * @package WPCake WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$wpcake_tbClass = '';

$wpcake_topbarWidth = get_theme_mod('wpcake_fullwidth_topbar');
if(!empty($wpcake_topbarWidth) && '' != $wpcake_topbarWidth ){
	$wpcake_tbClass = ' fullwidth';
}

$wpcake_topbarLayout = get_theme_mod('wpcake_topbar_layout');
if('center' == $wpcake_topbarLayout ){
	$wpcake_tbClass = $wpcake_tbClass . ' layout-center';
}elseif( 'alternate' == $wpcake_topbarLayout){
	$wpcake_tbClass = $wpcake_tbClass . ' layout-alternate';
}

?>

<div id="top-bar-wrap" class="top-bar-wrap<?php echo esc_attr( $wpcake_tbClass ); ?>">
  <div class="top-bar container">
    <div class="top-bar-inner">

			<div class="top-bar-content top-bar-left">
				<?php
					if ( has_nav_menu( 'topbar' ) ) {
						wp_nav_menu( array( 'theme_location' => 'topbar', 'depth' => 1) );
					}
				?>
      </div>

      <div class="top-bar-social">
				<?php
					if ( has_nav_menu( 'social' ) ) {
						wpcake_get_social_menu();
					}
				?>
      </div>

    </div>
  </div>
</div>
