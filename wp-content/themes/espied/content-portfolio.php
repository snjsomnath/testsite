<?php
/**
 * The template for displaying Projects on index view
 *
 * @package Espied
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-thumbnail-wrapper">
		<?php espied_post_thumbnail(); ?>
	</div>

	<a href="<?php the_permalink(); ?>" rel="bookmark" class="image-link" tabindex="-1"></a>

	<div class="project-info">
		<div>
			<div>
				<?php
					echo get_the_term_list( $post->ID, 'jetpack-portfolio-type', '<footer class="entry-meta"><span class="portfolio-type-links">', _x( ', ', 'Used between list items, there is a space after the comma.', 'espied' ), '</span></footer>' );
				?>

				<?php the_title( '<header class="entry-header"><h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1></header>' ); ?>

				<?php espied_view_link(); ?>
			</div>
		</div>
	</div>
</article><!-- #post-## -->