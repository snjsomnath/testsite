<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Espied
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php espied_post_thumbnail(); ?>

	<?php the_title( '<header class="entry-header"><h1 class="entry-title">', '</h1></header>' ); ?>

	<div class="entry-content">
		<?php
			the_content();
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'espied' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
	<footer class="entry-meta"><?php edit_post_link( __( 'Edit', 'espied' ), '<span class="edit-link">', '</span>' ); ?></footer><!-- .entry-meta -->
</article><!-- #post-## -->
