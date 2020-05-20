<?php
/**
 * Espied functions and definitions
 *
 * @package Espied
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 552; /* pixels */
}

if ( ! function_exists( 'espied_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function espied_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Espied, use a find and replace
	 * to change 'espied' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'espied', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 840, 0 );
	add_image_size( 'portfolio-landscape', 480, 360, true );
	add_image_size( 'portfolio-portrait', 480, 640, true );
	add_image_size( 'portfolio-square', 480, 480, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'espied' ),
		'social'  => __( 'Social Links Menu', 'espied' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'gallery' ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'editor-style.css', 'fonts/genericons.css', espied_open_sans_font_url(), espied_montserrat_font_url() ) );
}
endif; // espied_setup
add_action( 'after_setup_theme', 'espied_setup' );

/**
 * Adjust content_width value for full width template.
 */
function espied_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) ) {
		$GLOBALS['content_width'] = 1320;
	}
}
add_action( 'template_redirect', 'espied_content_width' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function espied_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'espied' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'espied_widgets_init' );

/**
 * Register Open Sans Google fonts for Espied.
 *
 * @return string
 */
function espied_open_sans_font_url() {
	$open_sans_font_url = '';

	/* translators: If there are characters in your language that are not supported
	 * by Open Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'espied' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Open Sans character subset specific to your language,
		 * translate this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language.
		 */
		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'espied' );

		if ( 'cyrillic' == $subset ) {
			$subsets .= ',cyrillic,cyrillic-ext';
		} elseif ( 'greek' == $subset ) {
			$subsets .= ',greek,greek-ext';
		} elseif ( 'vietnamese' == $subset ) {
			$subsets .= ',vietnamese';
		}

		$query_args = array(
			'family' => urlencode( 'Open Sans:300italic,400italic,600italic,700italic,300,400,600,700' ),
			'subset' => urlencode( $subsets ),
		);

		$open_sans_font_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $open_sans_font_url;
}

/**
 * Register Montserrat Google fonts for Espied.
 *
 * @return string
 */
function espied_montserrat_font_url() {
	$montserrat_font_url = '';

	/* translators: If there are characters in your language that are not supported
	   by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'espied' ) ) {

		$montserrat_font_url = add_query_arg( 'family', urlencode( 'Montserrat:400,700' ), "https://fonts.googleapis.com/css" );
	}

	return $montserrat_font_url;
}


/**
 * Enqueue scripts and styles.
 */
function espied_scripts() {
	wp_enqueue_style( 'espied-open-sans', espied_open_sans_font_url(), array(), null );

	wp_enqueue_style( 'espied-montserrat', espied_montserrat_font_url(), array(), null );

	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.3' );

	wp_enqueue_style( 'espied-style', get_stylesheet_uri(), array( 'genericons' ) );

	wp_enqueue_script( 'espied-js-check', get_template_directory_uri() . '/js/js-check.js', array(), '20140811' );

	wp_enqueue_script( 'espied-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'espied-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20140304', true );
}
add_action( 'wp_enqueue_scripts', 'espied_scripts' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @return void
 */
function espied_admin_fonts() {
	wp_enqueue_style( 'espied-open-sans', espied_open_sans_font_url(), array(), null );

	wp_enqueue_style( 'espied-montserrat', espied_montserrat_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'espied_admin_fonts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



/**
 * Load plugin enhancement file to display admin notices.
 */
require get_template_directory() . '/inc/plugin-enhancements.php';