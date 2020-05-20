<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WPCake
 */

?>

<?php
  // Get footer widgets
  if( is_active_sidebar( 'footer-one' ) ){
    get_template_part( 'template-parts/footer-widgets' );
  }
?>

<?php

  $wpcake_disable_footer_meta = get_post_meta($id, 'disable-site-footer', true);
  $wpcake_footer_layout = get_theme_mod('wpcake_footer_layout', 'center');

  if( empty($wpcake_disable_footer_meta) || 'disabled' != $wpcake_disable_footer_meta):
      if( 'disable' != $wpcake_footer_layout ):

   ?>

   <footer role="contentinfo">
    <div class="footer-inner <?php echo 'wpcake-' . esc_attr( $wpcake_footer_layout ); ?>">

     <div class="footer-section section_one">
       <?php
        $wpcake_footer_type = get_theme_mod('wpcake_footer_section_one', 'default');
        if( $wpcake_footer_type == 'default' ):
        ?>
          <p>&copy; <?php the_time(date( 'Y' )); ?> <?php bloginfo( 'name' ); ?> </p>
        <?php
        elseif( $wpcake_footer_type == 'footer_text' ):

          $wpcake_footer_text = get_theme_mod('wpcake_footer_section_one_text');
          echo wp_kses($wpcake_footer_text, wpcake_allowed_html());

        endif;
        ?>
      </div>

      <?php

        $wpcake_footer_2_type = get_theme_mod('wpcake_footer_section_two', 'default');

        if( $wpcake_footer_2_type != 'disable'):

      ?>

        <div class="footer-section section_two">
        <?php
         if( $wpcake_footer_2_type == 'default' ):
           echo sprintf( '<p>%s <a href="%s">WPCake.com</a></p>', esc_html('Theme by', 'wpcake' ), esc_url('https://www.wpcake.com') );
         elseif($wpcake_footer_2_type == 'footer_text'):

          $wpcake_footer_2_text = get_theme_mod('wpcake_footer_section_two_text');
          echo wp_kses($wpcake_footer_2_text, wpcake_allowed_html());

        endif;
        ?>
        </div>

      <?php endif; ?>

    </div><!-- .footer-inner -->
  </footer><!-- footer -->

<?php
  endif;
 endif;

 wp_footer();
