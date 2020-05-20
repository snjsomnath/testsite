<?php
/**
 * This file sets up the theme info page
 *
 * @package WPCake WordPress theme
 */

class WPCake_Theme_Page {

  const WPCAKE_THEME_PAGE_PATH = 'inc/admin/theme-page/sections/';

	/**
	 * Constructor
	 * Sets up the welcome screen
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'register_menu' ) );
		add_action( 'load-themes.php', array( $this, 'activation_admin_notice' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );

		add_action( 'wpcakeWelcome', array( $this, 'header' ), 				  10 );
		add_action( 'wpcakeWelcome', array( $this, 'content' ), 			  20 );

	} // end constructor


  /**
	 * Creates the Theme Admin page
	 * @since 1.0
	 */
	public function register_menu() {
		add_theme_page( __('WPCake Theme Options', 'wpcake'), __('WPCake Options', 'wpcake'), 'edit_theme_options', 'wpcake-options', array( $this, 'theme_page' ), 999 );
	}


	/**
	 * Adds an admin notice upon successful activation.
	 * @since 1.0
	 */
	public function activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) { // input var okay
			add_action( 'admin_notices', array( $this, 'welcome_admin_notice' ), 99 );
		}
	}


	/**
	 * Display an admin notice linking to the welcome screen
	 * @since 0.1
	 */
	public function welcome_admin_notice() {
		?>
			<div class="updated notice is-dismissible">
        <?php /* translators: %1s: Theme info page, %2s: closing link, %3s: line break, $4s: strong tag, $5s: end strong tag  */ ?>
				<p><?php echo sprintf( esc_html__( 'Thanks for choosing %4$sWPCake%5$s! %3$s Learn how to get the most out of your new theme on the %1$swelcome screen%2$s.', 'wpcake' ), '<a href="' . esc_url( admin_url( 'themes.php?page=wpcake-options' ) ) . '">', '</a>', '<br/>', '<strong>', '</strong>' ); ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=wpcake-options' ) ); ?>" class="button button-primary button-large" style="text-decoration: none;"><?php esc_html_e( 'Get started with WPCake', 'wpcake' ); ?></a></p>
			</div>
		<?php
	}


	/**
	 * Load theme page css
	 * @return void
	 * @since  1.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( 'wpcake-theme-page', trailingslashit( WPCAKE_THEME_URI ) . 'inc/admin/theme-page/theme-info.css', WPCAKE_THEME_VERSION );
	}


	/**
	 * The theme options page
	 * @since 1.0.0
	 */
	public function theme_page() {
		?>
		<div class="wpcake-admin-wrap theme-options-wrap">

			<?php
			/**
			 * @hooked header - 10
			 * @hooked content - 10
			 */
			do_action( 'wpcakeWelcome' ); ?>

		</div>
		<?php
	}

  /**
	 * Header
	 * @since 1.0
	 */
	 public function header() {
	 	get_template_part( self::WPCAKE_THEME_PAGE_PATH . 'header' );
	 }

	/**
	 * Main content
	 * @since 1.0.
	 */
	public function content() {
		get_template_part( self::WPCAKE_THEME_PAGE_PATH . 'content' );
	}


}

return new WPCake_Theme_Page();
