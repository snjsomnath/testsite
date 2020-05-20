<?php
/**
 * @package Espied
 */
if ( isset( $GLOBALS['content_width'] ) ) :
	if ( 'image' == get_post_format() ) :
		$GLOBALS['content_width'] = 1272;
	else :
		$GLOBALS['content_width'] = 552;
	endif;
endif;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php espied_post_thumbnail(); ?>

	<?php
		if ( 'link' == get_post_format() ) :
			the_title( '<header class="entry-header"><h1 class="entry-title"><a href="' . esc_url( espied_get_link_url() ) . '" rel="bookmark">', '</a></h1></header>' );
		else :
			if ( is_single() ) :
				the_title( '<header class="entry-header"><h1 class="entry-title">', '</h1></header>' );
			else :
				the_title( '<header class="entry-header"><h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1></header>' );
			endif;
		endif;
	?>

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<?php else : ?>

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

	<?php endif; ?>

	<footer class="entry-meta">
		<?php espied_entry_meta(); ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'espied' ), __( '1 Comment', 'espied' ), __( '% Comments', 'espied' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'espied' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
