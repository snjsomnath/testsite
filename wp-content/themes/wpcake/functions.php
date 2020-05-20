<?php

/* DEFINE CONSTANTS
------------------------------------------------ */
define( 'WPCAKE_THEME_VERSION', '1.2.1' );
define( 'WPCAKE_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'WPCAKE_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );
define( 'WPCAKE_WOOCOMMERCE_ACTIVE', class_exists( 'WooCommerce' ) );

/* FREEMIUS INIT
------------------------------------------------ */
if ( ! function_exists( 'wpcake_fs' ) ) {
    // Create a helper function for easy SDK access.
    function wpcake_fs() {
        global $wpcake_fs;

        if ( ! isset( $wpcake_fs ) ) {
            // Include Freemius SDK.
            require_once dirname(__FILE__) . '/freemius/start.php';

            $wpcake_fs = fs_dynamic_init( array(
                'id'                  => '4149',
                'slug'                => 'wpcake',
                'type'                => 'theme',
                'public_key'          => 'pk_30870c926e673d62b8493bf4b9ba5',
                'is_premium'          => false,
                'has_addons'          => false,
                'has_paid_plans'      => false,
                'menu'                => array(
                    'slug'           => 'wpcake-options',
                    'account'        => false,
                    'parent'         => array(
                        'slug' => 'themes.php',
                    ),
                ),
            ) );
        }

        return $wpcake_fs;
    }

    // Init Freemius.
    wpcake_fs();
    // Signal that SDK was initiated.
    do_action( 'wpcake_fs_loaded' );
}


function wpcake_customizer_live_preview() {

	$js_uri  = WPCAKE_THEME_URI . 'assets/js/';
	wp_enqueue_script( 'themecustomizer', get_template_directory_uri(). '/assets/js/theme-customizer.js', '', '', true );

}
add_action( 'customize_preview_init', 'wpcake_customizer_live_preview' );


function wpcake_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'wpcake_content_width', 960 );
}
add_action( 'after_setup_theme', 'wpcake_content_width', 0 );


/* THEME SETUP
------------------------------------------------ */
if ( ! function_exists( 'wpcake_setup' ) ) {

	function wpcake_setup() {

		require_once WPCAKE_THEME_DIR . 'inc/helpers.php';
		require_once WPCAKE_THEME_DIR . 'inc/extras.php';

		// Automatic feed
		add_theme_support( 'automatic-feed-links' );

		// Post thumbnails
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'wpcake-post-image', 960, 9999 );

		// Title tag
		add_theme_support( 'title-tag' );

		// Post formats
		add_theme_support( 'post-formats', array( 'aside' ) );

		// Add nav menu
		register_nav_menu( 'primary-menu', __( 'Primary Menu', 'wpcake' ) );

		//Add secondary menu
		register_nav_menu( 'topbar', __( 'Top Bar Menu', 'wpcake' ) );

		//Add social menu
		register_nav_menu( 'social', __( 'Social Media Menu', 'wpcake' ) );

		// Customize the output of the social menu
		function wpcake_get_social_menu() {
			if ( has_nav_menu( 'social' ) ) :
				wp_nav_menu( 	array(
						'theme_location'  => 'social',
						'container'       => 'div',
						'container_id'    => 'menu-social',
						'container_class' => 'menu-social',
						'menu_id'         => 'menu-social-items',
						'menu_class'      => 'menu-social menu-items text-right',
						'depth'           => 1,
						'link_before'     => '<span class="screen-reader-text">',
						'link_after'      => '</span>',
						'fallback_cb'     => '',
				));
			endif;
		}

		// Add theme support for Custom Logo.
		add_theme_support(
			'custom-logo',
			array(
				'width'       => 180,
				'height'      => 60,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Add theme support for Custom Background
		add_theme_support( 'custom-background');

		/**
		 * Registers an editor stylesheet in a sub-directory.
		 */
		function wpcake_add_editor_styles_sub_dir() {
		    add_editor_style( trailingslashit( WPCAKE_THEME_URI ) . 'css/editor-style.css' );
		}
		add_action( 'after_setup_theme', 'wpcake_add_editor_styles_sub_dir' );


		// Make the theme translation ready
		load_theme_textdomain( 'wpcake', WPCAKE_THEME_DIR . '/languages' );

		$locale_file = WPCAKE_THEME_DIR . "/languages/" . get_locale();

		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}

	}
	add_action( 'after_setup_theme', 'wpcake_setup' );

}


if ( ! function_exists( 'wpcake_widgets_init' ) ) {
	function wpcake_widgets_init() {

		$heading = 'h4';
		$heading = apply_filters( 'wpcake_sidebar_heading', $heading );

		// Default Sidebar
		register_sidebar( array(
			'name'			=> esc_html__( 'Default Sidebar', 'wpcake' ),
			'id'				=> 'sidebar',
			'description'	=> esc_html__( 'Widgets in this area will be displayed in the left or right sidebar area if you choose the Left or Right Sidebar layout.', 'wpcake' ),
			'before_widget'	=> '<div id="%1$s" class="sidebar-box %2$s clr">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<'. $heading .' class="widget-title">',
			'after_title'	=> '</'. $heading .'>',
		) );

		// Search Results Sidebar
		if ( get_theme_mod( 'wpcake_search_custom_sidebar', true ) ) {
			register_sidebar( array(
				'name'			=> esc_html__( 'Search Results Sidebar', 'wpcake' ),
				'id'			=> 'search_sidebar',
				'description'	=> esc_html__( 'Widgets in this area are used in the search result page.', 'wpcake' ),
				'before_widget'	=> '<div id="%1$s" class="sidebar-box %2$s clr">',
				'after_widget'	=> '</div>',
				'before_title'	=> '<'. $heading .' class="widget-title">',
				'after_title'	=> '</'. $heading .'>',
			) );
		}

		// Footer 1
		register_sidebar( array(
			'name'			=> esc_html__( 'Footer 1', 'wpcake' ),
			'id'			=> 'footer-one',
			'description'	=> esc_html__( 'Widgets in this area are used in the first footer region.', 'wpcake' ),
			'before_widget'	=> '<div id="%1$s" class="footer-widget %2$s clr">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<'. $heading .' class="widget-title">',
			'after_title'	=> '</'. $heading .'>',
		) );

		// Footer 2
		register_sidebar( array(
			'name'			=> esc_html__( 'Footer 2', 'wpcake' ),
			'id'			=> 'footer-two',
			'description'	=> esc_html__( 'Widgets in this area are used in the second footer region.', 'wpcake' ),
			'before_widget'	=> '<div id="%1$s" class="footer-widget %2$s clr">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<'. $heading .' class="widget-title">',
			'after_title'	=> '</'. $heading .'>',
		) );

		// Footer 3
		register_sidebar( array(
			'name'			=> esc_html__( 'Footer 3', 'wpcake' ),
			'id'			=> 'footer-three',
			'description'	=> esc_html__( 'Widgets in this area are used in the third footer region.', 'wpcake' ),
			'before_widget'	=> '<div id="%1$s" class="footer-widget %2$s clr">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<'. $heading .' class="widget-title">',
			'after_title'	=> '</'. $heading .'>',
		) );

		// Footer 4
		register_sidebar( array(
			'name'			=> esc_html__( 'Footer 4', 'wpcake' ),
			'id'			=> 'footer-four',
			'description'	=> esc_html__( 'Widgets in this area are used in the fourth footer region.', 'wpcake' ),
			'before_widget'	=> '<div id="%1$s" class="footer-widget %2$s clr">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<'. $heading .' class="widget-title">',
			'after_title'	=> '</'. $heading .'>',
		) );
	}

	add_action( 'widgets_init', 'wpcake_widgets_init');
}




/* ENQUEUE STYLES
------------------------------------------------ */

if ( ! function_exists( 'wpcake_load_style' ) ) {

	function wpcake_load_style() {
		if ( ! is_admin() ) {
			wp_enqueue_style( 'wpcake_style', get_stylesheet_uri() );
		}
	}
	add_action( 'wp_enqueue_scripts', 'wpcake_load_style' );

}


/* ENQUEUE COMMENT-REPLY.JS
------------------------------------------------ */

if ( ! function_exists( 'wpcake_load_scripts' ) ) {

	function wpcake_load_scripts() {

		wp_enqueue_script( 'wpcake_construct', WPCAKE_THEME_URI . 'assets/js/construct.js', array( 'jquery' ), WPCAKE_THEME_VERSION, true );
		wp_enqueue_script( 'wpcake_index', WPCAKE_THEME_URI . 'assets/js/index.js', array( 'jquery' ), WPCAKE_THEME_VERSION, true );

		if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'wpcake_load_scripts' );

}


if ( is_admin() ) {

	/**
	 * Admin Menu Settings
	 */

	// Create theme welcome page.
	require_once( WPCAKE_THEME_DIR . '/inc/admin/theme-page/theme-info.php' );


	/* PAGE ADDITIONS
	------------------------------------------------ */
	require_once( WPCAKE_THEME_DIR . 'inc/metabox/class-wpcake-meta-boxes.php' );

}

 /* CUSTOMIZER OPTIONS
 ------------------------------------------------ */
require_once( WPCAKE_THEME_DIR . 'inc/customizer/class-wpcake-customizer.php' );
require_once( WPCAKE_THEME_DIR . 'inc/customizer/customizer_styles.php' );

/* ---------------------------------------------------------------------------------------------
   SPECIFY GUTENBERG SUPPORT
------------------------------------------------------------------------------------------------ */


if ( ! function_exists( 'wpcake_add_gutenberg_features' ) ) :

	function wpcake_add_gutenberg_features() {

		/* Gutenberg Palette --------------------------------------- */

		add_theme_support( 'editor-color-palette', array(
			array(
				'name' 	=> _x( 'Black', 'Name of the black color in the Gutenberg palette', 'wpcake' ),
				'slug' 	=> 'black',
				'color' => '#000',
			),
			array(
				'name' 	=> _x( 'White', 'Name of the white color in the Gutenberg palette', 'wpcake' ),
				'slug' 	=> 'white',
				'color' => '#fff',
			),
		) );

	}
	add_action( 'after_setup_theme', 'wpcake_add_gutenberg_features' );

endif;

/* ---------------------------------------------------------------------------------------------
	 SETUP Blog Layout
------------------------------------------------------------------------------------------------ */
if ( ! function_exists( 'wpcake_blog_setup' ) ) {

	function wpcake_blog_setup() {

		$blog_style = get_theme_mod('wpcake_blog_style', 'default');
		if('grid' == $blog_style){
			// Masonry
			wp_enqueue_script( 'masonry');
			$js_uri  = WPCAKE_THEME_URI . 'assets/js/';
			wp_enqueue_script( 'wpcake-grid', $js_uri. 'grid.js', '', '', true );
		}

	}
}
add_action( 'wp_enqueue_scripts', 'wpcake_blog_setup' );


/* ---------------------------------------------------------------------------------------------
	 load Fontawesome styles if needed.
------------------------------------------------------------------------------------------------ */
if( ! function_exists( 'wpcake_fontawesome_styles' )){

		function wpcake_fontawesome_styles(){

			if ( has_nav_menu( 'social' ) ){
				wp_enqueue_style( 'wpcake_fontawesome', trailingslashit( WPCAKE_THEME_URI ) . 'assets/css/font-awesome.min.css', array(), '4.7.0' );
			}
			else{
				return;
			}

		}
}
add_action( 'wp_enqueue_scripts', 'wpcake_fontawesome_styles' );

/* ---------------------------------------------------------------------------------------------
	 WooCommerce
------------------------------------------------------------------------------------------------ */
require_once( WPCAKE_THEME_DIR . 'inc/integrations/woocommerce.php' );

/* ---------------------------------------------------------------------------------------------
	 Recommended plugin notice code
------------------------------------------------------------------------------------------------ */
require_once WPCAKE_THEME_DIR . 'inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'wpcake_register_required_plugins' );

function wpcake_register_required_plugins() {

	$plugins = array(

		array(
			'name'      => 'WPCake Demo Importer',
			'slug'      => 'wpcake-demo-importer',
			'required'  => false,
		),

	);

	$config = array(
		'id'           => 'wpcake',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

	);

	tgmpa( $plugins, $config );
}
