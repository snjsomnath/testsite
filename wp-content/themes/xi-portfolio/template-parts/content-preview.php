<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package xi_portfolio
 */

?>


<figure id="post-<?php the_ID(); ?>" class="all col-4-12 grid-item portfolio-item snip1577" >
<a href="<?php the_permalink(); ?>">
	<?php 	if ( has_post_thumbnail() ) { ?>
	
				<?php the_post_thumbnail('xi-portfolio-thumb'); ?>

	<?php } else { ?>
	<img src="<?php echo esc_url( get_template_directory_uri() );?>/img/default-image.jpg" >
	<?php } ?>
  <figcaption>
    
    	<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>

    <h4> <?php //do_action('portfolio-terms'); ?> </h4>
  </figcaption>

</a>

</figure><!-- #post-## -->