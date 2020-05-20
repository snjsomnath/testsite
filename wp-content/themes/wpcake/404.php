<?php
/**
 * The 404 template file.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPCake
 */


get_header(); ?>

		<main class="wrapper" id="site-content" role="main">

				<div class="content-area">

					<div class="content-inner">

            <div class="error-404 not-found">
      				<header class="page-header">
      					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'wpcake' ); ?></h1>
      				</header><!-- .page-header -->

      				<div class="page-content">
      					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'wpcake' ); ?></p>
      					<?php get_search_form(); ?>
      				</div><!-- .page-content -->
      			</div><!-- .error-404 -->

					</div><!-- .content-inner -->

				</div><!-- .content-area -->

				<?php do_action('wpcake_display_sidebar'); ?>

		</main><!-- .wrapper -->

		<?php get_footer(); ?>

	</body>
</html>
