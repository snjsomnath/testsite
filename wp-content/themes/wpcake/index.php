<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPCake
 */


get_header(); ?>

		<main class="wrapper" id="site-content" role="main">

				<div class="content-area">

					<div class="content-inner">

						<?php

							if ( have_posts() ) :
								/* Start the Loop */
								while ( have_posts() ) : the_post();

									/*
									 * Include the Post-Format-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
									 */
									get_template_part( 'template-parts/content' );

								endwhile;

							else :

								get_template_part( 'template-parts/content', 'none' );

							endif;

						?>

					</div><!-- .content-inner -->


	        <?php if ( ( ! is_singular() ) && ( $wp_query->post_count >= get_option( 'posts_per_page' ) ) ) : ?>

		        <div class="pagination">

							<?php previous_posts_link( '&larr; ' . __( 'Newer posts', 'wpcake' ) ); ?>
							<?php next_posts_link( __( 'Older posts', 'wpcake') . ' &rarr;' ); ?>

		        </div><!-- .pagination -->

	      	<?php endif; ?>

				</div><!-- .content-area -->

				<?php do_action('wpcake_display_sidebar'); ?>

		</main><!-- .wrapper -->

		<?php get_footer(); ?>

	</body>
</html>
