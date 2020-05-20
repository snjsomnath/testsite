<?php
/**
 * @package Espied
 */
// Access global variable directly to set content_width
if ( isset( $GLOBALS['content_width'] ) )
	$GLOBALS['content_width'] = 1272;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php
			echo get_the_term_list( $post->ID, 'jetpack-portfolio-type', '<div class="entry-meta"><span class="portfolio-type-links">', _x(', ', 'Used between list items, there is a space after the comma.', 'espied' ), '</span></div>' );
		?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'espied' ) ); ?>
		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'espied' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
			echo get_the_term_list( $post->ID, 'jetpack-portfolio-tag', '<span class="tags-links">', _x(', ', 'Used between list items, there is a space after the comma.', 'espied' ), '</span>' );
		?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'espied' ), __( '1 Comment', 'espied' ), __( '% Comments', 'espied' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'espied' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
