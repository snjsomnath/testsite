<?php
/**
 * The template for displaying image attachments
 *
 * @package Espied
 */

// Retrieve attachment metadata.
$metadata = wp_get_attachment_metadata();

get_header();
?>

	<div id="primary" class="content-area image-attachment">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<div class="entry-attachment">
						<div class="attachment">
							<?php espied_the_attached_image(); ?>
						</div><!-- .attachment -->

						<?php if ( has_excerpt() ) : ?>
						<div class="entry-caption">
							<?php the_excerpt(); ?>
						</div><!-- .entry-caption -->
						<?php endif; ?>
					</div><!-- .entry-attachment -->

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

				<footer class="entry-meta">
					<span class="date"><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></span>

					<span class="full-size-link"><a href="<?php echo wp_get_attachment_url(); ?>"><?php echo $metadata['width']; ?> &times; <?php echo $metadata['height']; ?></a></span>

					<?php if ( $post->post_parent ) { ?>
					<span class="parent-post-link"><a href="<?php echo get_permalink( $post->post_parent ); ?>" rel="gallery"><?php echo get_the_title( $post->post_parent ); ?></a></span>
					<?php } ?>

					<?php edit_post_link( __( 'Edit', 'espied' ), '<span class="edit-link">', '</span>' ); ?>
				</footer><!-- .entry-meta -->
			</article><!-- #post-## -->

			<?php if ( $post->post_parent ) { ?>
			<nav class="navigation image-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php _e( 'Image navigation', 'espied' ); ?></h1>
				<div class="nav-links">
					<div class="nav-previous"><?php previous_image_link( false, '<span class="meta-nav">' . __( 'Previous Image', 'espied' ) . '</span>' ); ?></div>
					<div class="nav-next"><?php next_image_link( false, '<span class="meta-nav">' . __( 'Next Image', 'espied' ) . '</span>' ); ?></div>
				</div><!-- .nav-links -->
			</nav><!-- #image-navigation -->
			<?php } ?>

			<?php comments_template(); ?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
