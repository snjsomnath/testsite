<?php
/**
 * Apply customizer styles
 *
 *
 * @package     WPCake
 * @author      WPCake
 * @link        https://wpcake.com/
 * @since       1.0
 */

function wpcake_styles_from_customizer() {

    // Start output buffering
    ob_start();

    ?>

    body{
      font-size: <?php echo esc_attr( get_theme_mod('wpcake_base_font_size', 18) ); ?>px;
      background-color: <?php echo esc_attr( get_theme_mod( 'wpcake_bg_color', '#FFFFFF' ) ); ?>;
    }

    a,
    a:visited{
      color: <?php echo esc_attr( get_theme_mod( 'wpcake_global_link_color', '#09769e' ) ); ?>;
    }
    a:hover,
    a:active,
    a:focus{
      color: <?php echo esc_attr( get_theme_mod( 'wpcake_global_live_link_color', '#000000' ) ); ?>;
    }

    <?php
      // Hide topbar
      $device = get_theme_mod( 'wpcake_topbar_devices' );
      if( 'desktop' == $device){
    ?>
        /* Desktop only */
        @media only screen and (max-width : 991px) {
          .top-bar-wrap{
            display: none;
          }
        }
    <?php
      }elseif( 'large' == $device){
    ?>
        /* Tablets and Desktop only */
        @media only screen and (max-width : 767px) {
          .top-bar-wrap{
            display: none;
          }
        }
    <?php
      }
    ?>
    header {
      margin-bottom: <?php echo esc_attr( get_theme_mod('wpcake_header_btm_margin', 20) ); ?>px;
      background-color: <?php echo esc_attr( get_theme_mod( 'wpcake_header_bg_color', '#FFFFFF' ) ); ?>;
    }

<?php
  $disableUnderline = get_theme_mod('wpcake_a_toggle_underline', false);
  if(! empty( $disableUnderline ) ){
    ?>
    a:hover,
    a:active,
    a:focus,
    .wrapper a:hover,
    .wrapper a:active,
    .wrapper a:focus{
      text-decoration: none;
      font-weight: bold;
    }
    <?php
  }

 ?>
    <?php
      $maxWidth = get_theme_mod('wpcake_default_container', 'plain-container');
      if( $maxWidth == 'plain-container' ){
        ?>
        .wrapper{
          max-width: <?php echo esc_attr( get_theme_mod('wpcake_main_max_width', 1240) ); ?>px;
        }
        <?php
      }
    ?>
    <?php
      // set max-width of header container
      $maxHeader = get_theme_mod('wpcake_contain_header', true);
      if( $maxHeader ){ ?>

        header .header-inner{
          max-width: <?php echo esc_attr( get_theme_mod('wpcake_header_max_width', 1240) ); ?>px;
        }
      <?php
        $maxTopBar = get_theme_mod('wpcake_fullwidth_topbar', false);
        if(empty($maxTopBar)){ ?>

          .top-bar-inner{
            max-width: <?php echo esc_attr( get_theme_mod('wpcake_header_max_width', 1240) ); ?>px;
          }

        <?php } ?>

    <?php } ?>



    header .site-title{
      font-size: <?php echo esc_attr( get_theme_mod('wpcake_site_title_size', 1.5) ); ?>em;
      margin-bottom: <?php echo esc_attr( get_theme_mod('wpcake_title_bottom_margin', 4) ); ?>px;
    }
    header .site-description{
      font-size: <?php echo esc_attr( get_theme_mod('wpcake_site_tagline_size', 1) ); ?>em;
    }
    .site-title a:link,
    .site-title a:visited{
      color: <?php echo esc_attr( get_theme_mod( 'wpcake_site_title_link_color', '#09769e' ) ); ?>;
    }
    header .site-title a:hover,
    header .site-title a:active,
    header .site-title a:focus{
      color: <?php echo esc_attr( get_theme_mod( 'wpcake_site_title_link_active_color', '#000000' ) ); ?>;
    }
    header .site-identity{
      margin-top: <?php echo esc_attr( get_theme_mod('wpcake_custom_logo_margin', 0) ); ?>px;
    }
    header nav{
      margin-top: <?php echo esc_attr( get_theme_mod('wpcake_menu_top_margin', 28)); ?>px;
    }
    header nav * {
      font-size: <?php echo esc_attr( get_theme_mod( 'wpcake_menu_font_size', 18 ) ); ?>px;
      color: <?php echo esc_attr( get_theme_mod( 'wpcake_header_link_color', '#000000' ) ); ?>;
    }
    header nav a,
    header nav a:visited {
      color: <?php echo esc_attr( get_theme_mod( 'wpcake_header_link_color', '#09769e' ) ); ?>;
    }

    header nav a:hover,
    header nav a:active,
    header nav a:focus,
    header nav .current_page_item > a,
    header nav .current-menu-item > a{
      color: <?php echo esc_attr( get_theme_mod( 'wpcake_header_link_active_color', '#000000' ) ); ?>;
      text-decoration: underline!important;
      <?php
        $wpcakeNoUnderline = get_theme_mod('wpcake_n_disable_underline');
        if(! empty( $wpcakeNoUnderline ) ){
          ?>
          text-decoration: none!important;
          font-weight: normal;
          <?php
        }
      ?>
    }
    @media ( min-width: 790px ) {
      header nav ul ul a{
        background-color: <?php echo esc_attr( get_theme_mod( 'wpcake_header_sub_nav_bg_color', '#000000' ) ); ?>;
        color: <?php echo esc_attr( get_theme_mod( 'wpcake_header_sub_nav_link_color', '#FFFFFF' ) ); ?>;
      }
      header nav ul ul a:hover,
      header nav ul ul a:active,
      header nav ul ul a:focus,
      header nav ul ul .current-menu-item a,
      header nav ul ul .current_page_item a {
        color: <?php echo esc_attr( get_theme_mod( 'wpcake_header_sub_nav_link_active_color', '#09769e' ) ); ?>;
      }
    }

		header .custom-logo-link img.custom-logo {
			width: <?php echo esc_attr( get_theme_mod( 'wpcake_custom_logo_width', 170 ) ); ?>px;
		}

    <?php

      // if customizer transparent header
      $transparentHeader = get_theme_mod( 'wpcake_transparent_header', 0 );

      // if page specific transparent header
      $id = wpcake_post_id();
      $transparent_page_header = get_post_meta( $id, 'transparent-header', false );


      if( $transparentHeader === 1 || ! empty( $transparent_page_header ) ){
    ?>
      @media ( min-width: 790px ) {
          header{
            background: transparent;
          }
      }
    <?php
      }
    ?>

  <?php
    $wpcakeminitotal = get_theme_mod('wpcake_wc_mini_total');
    if(! empty( $wpcakeminitotal ) ){ ?>
      .wpcake-wc-count{
        display:none;
      }
  <?php
    }
  ?>

    .wpcake-cart-count{
      background-color: <?php echo esc_attr(get_theme_mod('wpcake_wc_icon_color', '#09769e') )?>;
    }
    .wpcake-cart-count:after{
      border-color: <?php echo esc_attr(get_theme_mod('wpcake_wc_icon_color', '#09769e') )?>;
    }

    .woocommerce #respond input#submit,
    .woocommerce a.button,
    .woocommerce button.button,
    .woocommerce input.button{
      border: none;
      color: <?php echo esc_attr(get_theme_mod('wpcake_wc_button_txt_color', '#FFFFFF') )?>;
      background-color: <?php echo esc_attr(get_theme_mod('wpcake_wc_button_color', '#09769e') )?>;
    }

    .woocommerce span.onsale{
      background-color: <?php echo esc_attr(get_theme_mod('wpcake_wc_sale_color', '#77a464') )?>;
    }
    .woocommerce-message{
      border-color: <?php echo esc_attr(get_theme_mod('wpcake_wc_sale_color', '#77a464') )?>;
    }

    <?php
      // WooCommerce page sidebar position
      $wpcakewcsidebar = get_theme_mod('wpcake_wc_sidebar');
      if( get_theme_mod('wpcake_wc_sidebar') == 'right-sidebar' || empty( $wpcakewcsidebar ) ){ ?>
          .woocommerce-page .content-area{
            float:left;
            width: 70%;
            padding: 0 60px 0 0;
          }
    <?php
      } elseif(get_theme_mod('wpcake_wc_sidebar') == 'left-sidebar'){ ?>
        .woocommerce-page .content-area{
          float:right;
          width: 70%;
          padding: 0 0 0 60px;
        }
    <?php
      } elseif(get_theme_mod('wpcake_wc_sidebar') == 'no-sidebar'){?>
        .woocommerce-page .content-area{
          padding: 0;
          width: 100%;
          float: none;
        }
    <?php
      } ?>

    <?php
      // WooCommerce single product page sidebar position
      $wpcakewcsinglesidebar = get_theme_mod('wpcake_wc_single_sidebar');
      if( get_theme_mod('wpcake_wc_single_sidebar') == 'right-sidebar' || empty( $wpcakewcsinglesidebar ) ){ ?>
        .woocommerce-page.single-product .content-area{
          float:left;
          width: 70%;
          padding: 0 60px 0 0;
        }
    <?php
      } elseif(get_theme_mod('wpcake_wc_single_sidebar') == 'left-sidebar'){ ?>
        .woocommerce-page.single-product .content-area{
          float:right;
          width: 70%;
          padding: 0 0 0 60px;
        }
    <?php
    } elseif(get_theme_mod('wpcake_wc_single_sidebar') == 'no-sidebar'){ ?>
        .woocommerce-page.single-product main .content-area{
          width: 100%;
          float:none;
          padding: 0;
        }
    <?php
      } ?>


    h1,h2,h3,h4,h5,h6,h1 *,h2 *,h3 *,h4 *,h5 *,h6 *{
      margin-bottom: <?php echo esc_attr( get_theme_mod( 'wpcake_headings_bottom_margin', 30 ) ); ?>px;
    }

    main p {
      line-height: <?php echo esc_attr(get_theme_mod('wpcake_base_line_height', 1.55)); ?>
    }

    .footer-widgets{
      border-top-width: <?php echo esc_attr( get_theme_mod( 'wpcake_footer_widgets_border_width', 7 ) ); ?>px;
      border-color: <?php echo esc_attr( get_theme_mod( 'wpcake_footer_widgets_border_color', '#6f6f6f' ) ); ?>;
      color: <?php echo esc_attr( get_theme_mod( 'wpcake_footer_widgets_txt_color', '#ffffff' ) ); ?>;
      background-color: <?php echo esc_attr( get_theme_mod( 'wpcake_footer_widgets_bg_color', '#3a3a3a' ) ); ?>;
      <?php
      $wpcakewigetsbgimg = get_theme_mod( 'wpcake_footer_widgets_bg_image');
      if( ! empty( $wpcakewigetsbgimg ) ){ ?>
        background-image: url(<?php echo esc_url( get_theme_mod( 'wpcake_footer_widgets_bg_image' ) ); ?>);
      <?php  } ?>

    }
    .footer-widgets a,
    .footer-widgets a:visited{
      color: <?php echo esc_attr( get_theme_mod( 'wpcake_footer_widgets_link_color', '#aaaaaa' ) ); ?>;
    }
    .footer-widgets a:hover,
    .footer-widgets a:focus,
    .footer-widgets a:active{
      color: <?php echo esc_attr( get_theme_mod( 'wpcake_footer_widgets_link_hover_color', '#ffffff' ) ); ?>;
    }

    .footer-widgets .widget-title {
      color: <?php echo esc_attr( get_theme_mod( 'wpcake_footer_widgets_title_color', '#ffffff' ) ); ?>;
    }

    footer{
      background-color: <?php echo esc_attr( get_theme_mod( 'wpcake_footer_bg_color', '#000000' ) ); ?>;

      border-top-width: <?php echo esc_attr( get_theme_mod( 'wpcake_footer_border_width', 1 ) ); ?>px;
      border-top-color: <?php echo esc_attr( get_theme_mod( 'wpcake_footer_border_color', '#6f6f6f' ) ); ?>;
      <?php
      $wpcakefooterbgimage = get_theme_mod( 'wpcake_footer_bg_image');
      if(! empty( $wpcakefooterbgimage ) ){ ?>
        background-image: url(<?php echo esc_url( get_theme_mod( 'wpcake_footer_bg_image' ) ); ?>);
      <?php } ?>
    }
    <?php
      $transparentFooter = get_theme_mod('wpcake_transparent_footer', 0);
      if( $transparentFooter === 1 ){
    ?>
        footer{
          z-index: 99999;
          background: transparent;
        }
    <?php
      }
    ?>

    footer{
      color: <?php echo esc_attr( get_theme_mod( 'wpcake_footer_txt_color', '#FFFFFF' ) ); ?>;
    }

    footer a:link,
    footer a:visited{
      color: <?php echo esc_attr( get_theme_mod( 'wpcake_footer_link_color', '#09769e' ) ); ?>;
    }
    footer a:hover,
    footer a:focus,
    footer a:active{
      color: <?php echo esc_attr( get_theme_mod( 'wpcake_footer_link_active_color', '#DDDDDD' ) ); ?>;
    }

		<?php

		// Release output buffering
		return ob_get_clean();
}


function wpcake_customizer_wp_head() {

  wp_add_inline_style( 'wpcake_style', wpcake_styles_from_customizer() );

}

add_action('wp_enqueue_scripts', 'wpcake_customizer_wp_head', 20);
