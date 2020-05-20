<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Wpcake
 */

?>

<div <?php post_class( 'post' ); ?>>

  <?php if ( ! get_post_format() == 'aside' ) : ?>

    <?php

      $wpcake_disable_entry_title_meta = get_post_meta($id, 'site-post-title', true);
      $wpcake_disable_entry_title = get_theme_mod('wpcake_disable_page_title', false);

      if( empty($wpcake_disable_entry_title_meta) ||
        'disabled' != $wpcake_disable_entry_title_meta):
        if( empty($wpcake_disable_entry_title) ||
       'disabled' != $wpcake_disable_entry_title):

       if ( is_sticky() && is_home() && ! is_paged() ) {
         printf( '<span class="sticky-post">%s</span>', esc_html_x( 'Featured', 'post', 'wpcake' ) );
       }
    ?>
    <?php if( is_singular() ){ ?>
      <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    <?php }else{ ?>
      <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php }?>


       <?php

    if ( get_post_type() == 'post' ) : ?>
       <div class="meta">

        <p>

            <a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>

            <?php if ( comments_open() ) : ?>
                <span class="sep"></span><?php comments_popup_link( __( 'Add Comment', 'wpcake' ), __( '1 Comment', 'wpcake' ), '% ' . __( 'Comments', 'wpcake' ), '', __( 'Comments off', 'wpcake' ) ); ?>
            <?php endif; ?>

        <?php if ( is_singular( 'post' ) ) : ?>

            <?php esc_html_e( 'In', 'wpcake' ); ?> <?php the_category( ', ' ); ?>
            <span class="sep"></span>
            <?php the_tags( ' #', ' #', ' ' ); ?></p>

        <?php endif; ?>

      </div><!-- .meta -->
      <?php endif; ?>
    <?php
        endif;
      endif;
    ?>

  <?php endif; ?>

  <?php

    $wpcake_disable_featured_image_meta = get_post_meta($id, 'wpcake-featured-img', true);
    $wpcake_disable_featured_image = get_theme_mod('wpcake_disable_featured_image', false);

    if( empty($wpcake_disable_featured_image_meta) ||
      'disabled' != $wpcake_disable_featured_image_meta):

      if( empty($wpcake_disable_featured_image) ||
     'disabled' != $wpcake_disable_featured_image):

         if ( has_post_thumbnail() ) : ?>

            <a href="<?php the_permalink(); ?>" class="featured-image">
                <?php the_post_thumbnail( 'wpcake-post-image' ); ?>
            </a>
  <?php
        endif;

      endif;

    endif;
  ?>

  <div class="content">

      <?php the_content(); ?>

  </div><!-- .content -->

  <?php

  if ( is_singular() ) wp_link_pages();

    if ( get_post_type() == 'post' ) : ?>


    <?php endif;

    if ( is_singular() ) comments_template(); ?>


</div><!-- .post -->
