<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Espied
 */

if ( ! function_exists( 'espied_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function espied_paging_nav( $max_num_pages = '' ) {
	// Get max_num_pages if not provided
	if ( '' == $max_num_pages )
		$max_num_pages = $GLOBALS['wp_query']->max_num_pages;

	// Don't print empty markup if there's only one page.
	if ( $max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'espied' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link( '', $max_num_pages ) ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">Previous</span>', 'espied' ), $max_num_pages ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link( '', $max_num_pages ) ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( '<span class="meta-nav">Next</span>', 'espied' ), $max_num_pages ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'espied_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function espied_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'espied' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', __( '<span class="meta-nav">Previous</span><span>%title</span>', 'espied' ) );
				next_post_link( '<div class="nav-next">%link</div>', __( '<span class="meta-nav">Next</span><span>%title</span>', 'espied' ) );
			?>
			<?php if ( 'jetpack-portfolio' == get_post_type() ) : ?>
				<div class="nav-archive">
					<a href="<?php echo esc_url( get_post_type_archive_link( 'jetpack-portfolio' ) ); ?>">
						<?php _e( '<span class="meta-nav">Archive</span><span>View other projects</span>', 'espied' ); ?>
					</a>
				</div>
			<?php endif; ?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'espied_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post.
 */
function espied_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() ) {
		echo '<span class="featured-post">' . __( 'Sticky', 'espied' ) . '</span>';
	}

	if ( 'post' == get_post_type() ) {
		espied_entry_date();

		// Post author
		printf( __( '<span class="author vcard"><span class="screen-reader-text">Author</span> <a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>', 'espied' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'espied' ), get_the_author() ) ),
			esc_html( get_the_author() )
		);
	}

	if ( false != get_post_format() ) {
		printf( __( '<span class="entry-format"><span class="screen-reader-text">Format</span> <a href="%1$s" title="%2$s">%3$s</a></span>', 'espied' ),
			esc_url( get_post_format_link( get_post_format() ) ),
			esc_attr( sprintf( __( 'View all %s posts', 'espied' ), get_post_format_string( get_post_format() ) ) ),
			get_post_format_string( get_post_format() )
		);
	}

	$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'espied' ) );
	if ( $categories_list && espied_categorized_blog() ) {
		printf( __( '<span class="categories-links"><span class="screen-reader-text">Categories</span> %1$s</span>', 'espied' ),
			$categories_list
		);
	}

	/* translators: used between list items, there is a space after the comma */
	the_tags( sprintf( '<span class="tags-links"><span class="screen-reader-text">%s </span>', esc_html__( 'Tags', 'espied' ) ), esc_html__( ', ', 'espied' ), '</span>' );
}
endif;

if ( ! function_exists( 'espied_entry_date' ) ) :
/**
 * Prints HTML with meta information for the current post-date.
 */
function espied_entry_date() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="date"><span class="screen-reader-text">Posted on</span> %1$s</span>', 'espied' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 */
function espied_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so espied_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so espied_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in espied_categorized_blog.
 */
function espied_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'espied_category_transient_flusher' );
add_action( 'save_post',     'espied_category_transient_flusher' );

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 *
 * @return void
*/
function espied_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() || ( ! is_search() && 'jetpack-portfolio' == get_post_type() ) ) :

	?>

	<div class="post-thumbnail">
	<?php
		if ( 'jetpack-portfolio' == get_post_type() ) :
			$ratio = get_theme_mod( 'espied_portfolio_thumbnail' );
			switch ( $ratio ) {
				case 'portrait':
					the_post_thumbnail( 'portfolio-portrait' );
					break;
				case 'square':
					the_post_thumbnail( 'portfolio-square' );
					break;
				default :
					the_post_thumbnail( 'portfolio-landscape' );
			}
		else :
			the_post_thumbnail();
		endif;
	?>
	</div>

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>">
	<?php the_post_thumbnail(); ?>
	</a>

	<?php endif; // End is_singular()
}

if ( ! function_exists( 'espied_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @return void
 */
function espied_the_attached_image() {
	$post                = get_post();
	/**
	 * Filter the default Espied attachment size.
	 *
	 * @param array $dimensions {
	 *     An array of height and width dimensions.
	 *
	 *     @type int $height Height of the image in pixels. Default 1272.
	 *     @type int $width  Width of the image in pixels. Default 1272.
	 * }
	 */
	$attachment_size     = apply_filters( 'espied_attachment_size', array( 1272, 1272 ) );
	$next_attachment_url = wp_get_attachment_url();

	if ( $post->post_parent ) {
		/*
		 * Grab the IDs of all the image attachments in a gallery so we can get the URL
		 * of the next adjacent image in a gallery, or the first image (if we're
		 * looking at the last image in a gallery), or, in a gallery of one, just the
		 * link to that image file.
		 */
		$attachment_ids = get_posts( array(
			'post_parent'    => $post->post_parent,
			'fields'         => 'ids',
			'numberposts'    => 999,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'menu_order ID',
		) );

		// If there is more than 1 attachment in a gallery...
		if ( count( $attachment_ids ) > 1 ) {
			foreach ( $attachment_ids as $idx => $attachment_id ) {
				if ( $attachment_id == $post->ID ) {
					$next_id = $attachment_ids[ ( $idx + 1 ) % count( $attachment_ids ) ];
					break;
				}
			}

			// get the URL of the next image attachment...
			if ( $next_id ) {
				$next_attachment_url = get_attachment_link( $next_id );
			}

			// or get the URL of the first image attachment.
			else {
				$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
			}
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'espied_portfolio_pagination' ) ) :

function espied_portfolio_pagination() {
	global $post;
	$pagination_posts = array();

	$pagination_posts['previous'] = get_adjacent_post( false, '', true );
	$pagination_posts['current']  = get_post();
	$pagination_posts['next']     = get_adjacent_post( false, '', false );

	if ( ! $pagination_posts['previous'] && ! $pagination_posts['next'] )
		return false;
?>
	<nav class="navigation project-navigation" role="navigation">
		<h1><?php _e( 'More Projects', 'espied' ); ?></h1>
		<div class="project-navigation-wrapper">
			<ul>
			<?php
				foreach ( $pagination_posts as $pagination_post => $post ) :
					if ( is_object( $post ) && is_a( $post, 'WP_Post' ) && 'jetpack-portfolio' == $post->post_type ) :
						setup_postdata( $post );
			?>
						<li class="<?php echo esc_attr( $pagination_post ); ?>"><?php get_template_part( 'content', 'portfolio' ); ?></li>
			<?php
						wp_reset_postdata();
					else :
			?>
						<li class="<?php echo esc_attr( $pagination_post ); ?>">
							<div class="no-result jetpack-portfolio">
								<div class="post-thumbnail-wrapper"></div>
							</div>
						</li>
			<?php
					endif;
				endforeach;
			?>
			</ul>
		</div>
	</nav>
<?php
}
endif;

if ( ! function_exists( 'espied_view_link' ) ) :
/**
 * Prints an "View" plus off-screen title link for portfolio projects
 */
function espied_view_link() {
	echo '<a href="'. esc_url( get_permalink() ) . '" rel="bookmark" class="view-link">' . sprintf( __( 'View <span class="screen-reader-text">%1$s</span>', 'espied' ), esc_attr( strip_tags( get_the_title() ) ) ) . '</a>';
}
endif; // espied_view_link
