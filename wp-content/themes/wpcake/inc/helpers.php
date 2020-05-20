<?php
/**
 * This file includes helper functions used throughout the theme.
 *
 * @package WPCake WordPress theme
 */

 /**
  * Check if WooCommerce is active
  *
  * @since 1.0.5
  */
 add_action('plugins_loaded', 'wpcake_check_for_woocommerce');
 function wpcake_check_for_woocommerce() {
     if (!defined('WC_VERSION')) {
         // no woocommerce :(
         return false;
     } else {
         return true;
     }
 }

 /**
  * Store current post ID
  *
  * @since 1.0
  */
 if ( ! function_exists( 'wpcake_post_id' ) ) {

 	function wpcake_post_id() {

 		// Default value
 		$id = '';

 		// If singular get_the_ID
 		if ( is_singular() ) {
 			$id = get_the_ID();
 		}

 		// Get ID of WooCommerce product archive
 		elseif ( WPCAKE_WOOCOMMERCE_ACTIVE && is_shop() ) {
 			$shop_id = wc_get_page_id( 'shop' );
 			if ( isset( $shop_id ) ) {
 				$id = $shop_id;
 			}
 		}

 		// Posts page
 		elseif ( is_home() && $page_for_posts = get_option( 'page_for_posts' ) ) {
 			$id = $page_for_posts;
 		}

 		// Apply filters
 		$id = apply_filters( 'wpcake_post_id', $id );

 		// Sanitize
 		$id = $id ? $id : '';

 		// Return ID
 		return $id;

 	}

 }

 /**
  * SETUP Allowed HTML tags for wp_kses()
  *
  * @since 1.0
  */
 if ( ! function_exists( 'wpcake_allowed_html' ) ) {

 	function wpcake_allowed_html() {

 	  $allowedposttags = array();
 		$allowed_atts = array(
 			'align'      => array(),
 			'class'      => array(),
 			'type'       => array(),
 			'id'         => array(),
 			'dir'        => array(),
 			'lang'       => array(),
 			'style'      => array(),
 			'xml:lang'   => array(),
 			'src'        => array(),
 			'alt'        => array(),
 			'href'       => array(),
 			'rel'        => array(),
 			'rev'        => array(),
 			'target'     => array(),
 			'novalidate' => array(),
 			'type'       => array(),
 			'value'      => array(),
 			'name'       => array(),
 			'tabindex'   => array(),
 			'action'     => array(),
 			'method'     => array(),
 			'for'        => array(),
 			'width'      => array(),
 			'height'     => array(),
 			'data'       => array(),
 			'title'      => array(),
 		);
 		$allowedposttags['form']     = $allowed_atts;
 		$allowedposttags['label']    = $allowed_atts;
 		$allowedposttags['input']    = $allowed_atts;
 		$allowedposttags['textarea'] = $allowed_atts;
 		$allowedposttags['iframe']   = $allowed_atts;
 		$allowedposttags['script']   = $allowed_atts;
 		$allowedposttags['style']    = $allowed_atts;
 		$allowedposttags['strong']   = $allowed_atts;
 		$allowedposttags['small']    = $allowed_atts;
 		$allowedposttags['table']    = $allowed_atts;
 		$allowedposttags['span']     = $allowed_atts;
 		$allowedposttags['abbr']     = $allowed_atts;
 		$allowedposttags['code']     = $allowed_atts;
 		$allowedposttags['pre']      = $allowed_atts;
 		$allowedposttags['div']      = $allowed_atts;
 		$allowedposttags['img']      = $allowed_atts;
 		$allowedposttags['h1']       = $allowed_atts;
 		$allowedposttags['h2']       = $allowed_atts;
 		$allowedposttags['h3']       = $allowed_atts;
 		$allowedposttags['h4']       = $allowed_atts;
 		$allowedposttags['h5']       = $allowed_atts;
 		$allowedposttags['h6']       = $allowed_atts;
 		$allowedposttags['ol']       = $allowed_atts;
 		$allowedposttags['ul']       = $allowed_atts;
 		$allowedposttags['li']       = $allowed_atts;
 		$allowedposttags['em']       = $allowed_atts;
 		$allowedposttags['hr']       = $allowed_atts;
 		$allowedposttags['br']       = $allowed_atts;
 		$allowedposttags['tr']       = $allowed_atts;
 		$allowedposttags['td']       = $allowed_atts;
 		$allowedposttags['p']        = $allowed_atts;
 		$allowedposttags['a']        = $allowed_atts;
 		$allowedposttags['b']        = $allowed_atts;
 		$allowedposttags['i']        = $allowed_atts;

 		return $allowedposttags;
 	}
 }


/**
* WordPress' missing is_blog_page() function.  Determines if the currently viewed page is
* one of the blog pages, including the blog home page, archive, category/tag, author, or single
* post pages.
*
* @return bool
*/
if ( ! function_exists( 'wpcake_is_blog_page' ) ) {

   function wpcake_is_blog_page(){
       global $post;

       // Post type must be 'post'.
       $post_type = get_post_type($post);

       // Check all blog-related conditional tags, as well as the current post type,
       // to determine if we're viewing a blog page.
       return ( $post_type === 'post' ) && ( is_home() || is_archive() || is_single() );
   }

 }



 /**
  * Adds classes to the body tag
  *
  * @since 1.0
  */
 if ( ! function_exists( 'wpcake_body_classes' ) ) {

 	function wpcake_body_classes( $classes ) {

 		$id = wpcake_post_id();

    // RTL
		if ( is_rtl() ) {
			$classes[] = 'rtl';
		}

    $primary_header_layout = get_theme_mod( 'wpcake_header_layout', 'default' );

    if('center' == $primary_header_layout){
      $classes[] = 'wpcake-header-center';
    }elseif('right' == $primary_header_layout){
      $classes[] = 'wpcake-header-right';
    }

 		$single_content_layout = get_post_meta( $id, 'site-content-layout', true );
 		$site_content_layout = get_theme_mod( 'wpcake_default_container', 'plain-container' );


    // Check Blog style Layout
    $blog_style = get_theme_mod('wpcake_blog_style', 'default');
    if(true == wpcake_is_blog_page()){
      $classes[] = 'wpcake-blog-' . esc_attr($blog_style);
    }

 		//check if the in-page setting has been changed from customizer settings (default)

 		if (
 			empty( $single_content_layout )
 			|| 'default' == $single_content_layout
 		 	|| $single_content_layout == $site_content_layout
 		) {

 			// If its not been changed or set to show customizer setting or its the same as the site setting.
 			if ( 'page-builder' == $site_content_layout ) {

 				$classes[] = 'wpcake-full-width';

 			} elseif ( 'plain-container' == $site_content_layout ) {

 				$classes[] = 'wpcake-layout-default';

 			}

 		}else{

 		 	// If option other than customizer setting
 			$classes[] = $single_content_layout;

 		}

    // Sidebars
    $defaultclass  = 'right-sidebar';
    $metaSidebar   = get_post_meta( wpcake_post_id(), 'site-sidebar-layout', true );
    $siteSidebar   = get_theme_mod('wpcake_site_sidebar', 'right-sidebar');

    if ( $metaSidebar && $metaSidebar != 'default' ) {
      $classes[] = $metaSidebar;
    }else{
      $classes[] = $siteSidebar;
    }

 		return $classes;
 	}
 	add_action( 'body_class', 'wpcake_body_classes' );

 }


/**
 * Returns correct sidebar layout
 *
 * @since 1.0
 */
if ( ! function_exists( 'wpcake_sidebar_layout' ) ) {

	function wpcake_sidebar_layout() {

		// Define variables
		$class  = 'right-sidebar';
		$page   = get_post_meta( wpcake_post_id(), 'site-sidebar-layout', true );
    $site   = get_theme_mod( 'wpcake_site_sidebar' , $class);

    // Check meta first to override and return (prevents filters from overriding meta)
    if( wpcake_check_for_woocommerce() ){
      if( is_product() ){
        $wooSingle = get_theme_mod( 'wpcake_wc_single_sidebar', $class );
        $class = $wooSingle;
      }else{
        $woo = get_theme_mod( 'wpcake_wc_sidebar', $class );
        $class = $woo;
      }
    } elseif ( $page && $page != 'default' ) {
			$class = $page;
		}else{
      $class = $site;
    }

		// Apply filters and return
		return $class;

	}

}


/**
 * Returns the sidebar
 *
 * @since  1.0
 */
if ( ! function_exists( 'wpcake_display_sidebar' ) ) {

	function wpcake_display_sidebar() {

    if ( wpcake_sidebar_layout() == 'no-sidebar' ) {
  		return;
  	}

		// Add the default sidebar
		get_sidebar();

	}

	add_action( 'wpcake_display_sidebar', 'wpcake_display_sidebar' );

}


/**
* Returns the correct sidebar ID
*
* @since  1.0
*/
if ( ! function_exists( 'wpcake_get_sidebar' ) ) {

 function wpcake_get_sidebar( $sidebar = 'sidebar' ) {

   // Search
   if ( is_search() && true == get_theme_mod( 'wpcake_search_custom_sidebar', true ) ) {
     $sidebar = 'search_sidebar';
   }

   // Never show empty sidebar
   if ( ! is_active_sidebar( $sidebar ) ) {
     $sidebar = 'sidebar';
   }

   // Return the correct sidebar
   return $sidebar;

 }

}
