<?php
/**
 * This file includes woocommerce specific code used throughout the theme.
 *
 * @package WPCake WordPress theme
 */

/* Display mini cart amount and AJAX update only if not marked as hidden */
$wpcakeWCMiniTotal = get_theme_mod('wpcake_wc_mini_total');
if( empty( $wpcakeWCMiniTotal ) ){

  /* Display amount and items */
  add_filter('wp_nav_menu_items','wpcake_wcmenucart', 10, 2);
  /* AJAX update */
  add_filter( 'woocommerce_add_to_cart_fragments', 'wpcake_wc_header_add_to_cart_fragment' );

}


function wpcake_wcmenucart($menu, $args) {

 if ( ! wpcake_check_for_woocommerce() || 'primary-menu' !== $args->theme_location )
   return $menu;

 $viewing_cart = __('View your shopping cart', 'wpcake');
 $start_shopping = __('Start shopping', 'wpcake');
 $cart_url =  wc_get_cart_url();
 $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );

 global $woocommerce;
 $cart_contents_count = $woocommerce->cart->cart_contents_count;
 $cart_total = $woocommerce->cart->get_cart_total();

 ob_start();

   if ($cart_contents_count == 0) {
     $menu_item = '<li class="wpcake-wc-count"><a class="wpcake-cart-container" href="'. esc_url( $shop_page_url ) .'" title="'. esc_attr( $start_shopping ) .'">';
   } else {
     $menu_item = '<li class="wpcake-wc-count"><a class="wpcake-cart-container" href="'. esc_url( $cart_url ) .'" title="'. esc_attr( $viewing_cart ) .'">';
   }

   $menu_item .= '<span class="wpcake-cart-count">';
   $menu_item .=  esc_html($cart_contents_count);
   $menu_item .= '</span>';
   $menu_item .=  $cart_total ;
   $menu_item .= '</a>';
   $menu_item .= '</li>';

   $allowed_html = array(
       'li' => array(
         'class' => array()
       ),
       'a' => array(
           'class' => array(),
           'href' => array(),
           'title' => array(),
       ),
       'span' => array(
         'class' => array()
       )
   );
   echo wp_kses($menu_item, $allowed_html);


 $social = ob_get_clean();
 return $menu . $social;

}

 /* AJAX update of cart amount */
 function wpcake_wc_header_add_to_cart_fragment( $fragments ) {

  global $woocommerce;
	$viewing_cart = __('View your shopping cart', 'wpcake');
	$start_shopping = __('Start shopping', 'wpcake');
	$cart_url =  wc_get_cart_url();
	$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
	$cart_contents_count =  $woocommerce->cart->cart_contents_count;
	$cart_total = $woocommerce->cart->get_cart_total();

 	ob_start();

 	if ($cart_contents_count == 0) {
 		$menu_item_u = '<a class="wpcake-cart-container" href="'. esc_url( $shop_page_url ) .'" title="'. esc_attr( $start_shopping ) .'">';
 	} else {
 		$menu_item_u = '<a class="wpcake-cart-container" href="'. esc_url( $cart_url ) .'" title="'. esc_attr( $viewing_cart ) .'">';
 	}

 	$menu_item_u .= '<span class="wpcake-cart-count">';
 	$menu_item_u .= esc_html($cart_contents_count);
 	$menu_item_u .= '</span>';
 	$menu_item_u .= $cart_total;
 	$menu_item_u .= '</a>';

  $allowed_html = array(
      'a' => array(
          'class' => array(),
          'href' => array(),
          'title' => array(),
      ),
      'span' => array(
        'class' => array()
      )
  );
  echo wp_kses($menu_item_u, $allowed_html);

 	$fragments['a.wpcake-cart-container'] = ob_get_clean();

 	return $fragments;
 }
