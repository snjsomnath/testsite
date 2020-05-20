<?php
/**
 * The template used for displaying Portfolio Archive view
 *
 * @package Espied
 */
?>

<header class="page-header">
	<?php espied_portfolio_title( '<h1 class="page-title">', '</h1>' ); ?>

	<?php espied_portfolio_thumbnail( '<div class="portfolio-featured-image">', '</div>' ); ?>

	<?php espied_portfolio_content( '<div class="taxonomy-description">', '</div>' ); ?>
</header><!-- .page-header -->

<div class="portfolio-wrapper">
	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'portfolio' ); ?>

	<?php endwhile; ?>
</div><!-- .portfolio-wrapper -->

<?php espied_paging_nav( $post->max_num_pages ); ?>