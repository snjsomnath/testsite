<?php
/**
 * Post Meta Box
 *
 * @package     WPCake
 * @author      WPCake
 * @link        https://wpcake.com/
 * @since       WPCake 1.0
 */

/**
 * Meta Boxes setup
 */
if ( ! class_exists( 'Wpcake_Meta_Boxes' ) ) {

	/**
	 * Meta Boxes setup
	 */
	class Wpcake_Meta_Boxes {

		/**
		 * Instance
		 *
		 * @var $instance
		 */
		private static $instance;

		/**
		 * Meta Option
		 *
		 * @var $meta_option
		 */
		private static $meta_option;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {

			add_action( 'load-post.php', array( $this, 'init_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
			add_action( 'do_meta_boxes', array( $this, 'remove_metabox' ) );
		}

		/**
		 * Check if layout is bb themer's layout
		 */
		public static function is_bb_themer_layout() {

			$is_layout = false;

			$post_type = get_post_type();
			$post_id   = get_the_ID();

			if ( 'fl-theme-layout' === $post_type && $post_id ) {

				$is_layout = true;
			}

			return $is_layout;
		}

		/**
		 *  Remove Metabox for beaver themer specific layouts
		 */
		public function remove_metabox() {

			$post_type = get_post_type();
			$post_id   = get_the_ID();

			if ( 'fl-theme-layout' === $post_type && $post_id ) {

				$template_type = get_post_meta( $post_id, '_fl_theme_layout_type', true );

				if ( ! ( 'archive' === $template_type || 'singular' === $template_type || '404' === $template_type ) ) {

					remove_meta_box( 'wpcake_settings_meta_box', 'fl-theme-layout', 'side' );
				}
			}
		}

		/**
		 *  Init Metabox
		 */
		public function init_metabox() {

			add_action( 'add_meta_boxes', array( $this, 'setup_meta_box' ) );
			add_action( 'save_post', array( $this, 'save_meta_box' ) );

			/**
			 * Set metabox options
			 *
			 * @see https://php.net/manual/en/filter.filters.sanitize.php
			 */
			self::$meta_option = apply_filters(
				'wpcake_meta_box_options',
				array(
					'wpcake-main-header-display' => array(
						'sanitize' => 'FILTER_DEFAULT',
					),
					'footer-sml-layout'       => array(
						'sanitize' => 'FILTER_DEFAULT',
					),
					'footer-adv-display'      => array(
						'sanitize' => 'FILTER_DEFAULT',
					),
					'transparent-header'         => array(
						'sanitize' => 'FILTER_DEFAULT',
					),
					'site-post-title'         => array(
						'sanitize' => 'FILTER_DEFAULT',
					),
					'disable-site-footer'         => array(
						'sanitize' => 'FILTER_DEFAULT',
					),
					'site-sidebar-layout'     => array(
						'default'  => 'default',
						'sanitize' => 'FILTER_DEFAULT',
					),
					'site-content-layout'     => array(
						'default'  => 'default',
						'sanitize' => 'FILTER_DEFAULT',
					),
					'wpcake-featured-img'        => array(
						'sanitize' => 'FILTER_DEFAULT',
					),
				)
			);
		}

		/**
		 *  Setup Metabox
		 */
		function setup_meta_box() {

			// Get all public posts.
			$post_types = get_post_types(
				array(
					'public' => true,
				)
			);

			$post_types['fl-theme-layout'] = 'fl-theme-layout';

			$metabox_name = sprintf(
				// Translators: %s is the theme name.
				__( '%s Settings', 'wpcake' ),
				wpcake_get_theme_name()
			);

			// Enable for all posts.
			foreach ( $post_types as $type ) {
        // Just use on pages for now!
				if ( 'page' == $type ) {
					add_meta_box(
						'wpcake_settings_meta_box',              // Id.
						$metabox_name,                          // Title.
						array( $this, 'markup_meta_box' ),      // Callback.
						$type,                                  // Post_type.
						'side',                                 // Context.
						'default'                               // Priority.
					);
				}
			}
		}

		/**
		 * Get metabox options
		 */
		public static function get_meta_option() {
			return self::$meta_option;
		}

		/**
		 * Metabox Markup
		 *
		 * @param  object $post Post object.
		 * @return void
		 */
		function markup_meta_box( $post ) {

			wp_nonce_field( basename( __FILE__ ), 'wpcake_settings_meta_box' );
			$stored = get_post_meta( $post->ID );

			// Set stored and override defaults.
			foreach ( $stored as $key => $value ) {
				self::$meta_option[ $key ]['default'] = ( isset( $stored[ $key ][0] ) ) ? $stored[ $key ][0] : '';
			}

			// Get defaults.
			$meta = self::get_meta_option();

			/**
			 * Get options
			 */
			$site_sidebar        = ( isset( $meta['site-sidebar-layout']['default'] ) ) ? $meta['site-sidebar-layout']['default'] : 'default';
			$site_content_layout = ( isset( $meta['site-content-layout']['default'] ) ) ? $meta['site-content-layout']['default'] : 'default';
      $primary_header      = ( isset( $meta['wpcake-main-header-display']['default'] ) ) ? $meta['wpcake-main-header-display']['default'] : '';
			$transparent_header = ( isset( $meta['transparent-header']['default'] ) ) ? $meta['transparent-header']['default'] : 'default';
			$site_post_title     = ( isset( $meta['site-post-title']['default'] ) ) ? $meta['site-post-title']['default'] : '';
			$wpcake_featured_img    = ( isset( $meta['wpcake-featured-img']['default'] ) ) ? $meta['wpcake-featured-img']['default'] : '';
			$disable_site_footer     = ( isset( $meta['disable-site-footer']['default'] ) ) ? $meta['disable-site-footer']['default'] : '';

			$show_meta_field = ! self::is_bb_themer_layout();
			do_action( 'wpcake_meta_box_markup_before', $meta );

			/**
			 * Option: Sidebar
			 */
			?>
			<div class="site-sidebar-layout-meta-wrap components-base-control__field">
				<p class="post-attributes-label-wrapper" >
					<strong> <?php esc_html_e( 'Sidebar', 'wpcake' ); ?> </strong>
				</p>
				<select name="site-sidebar-layout" id="site-sidebar-layout">
					<option value="default" <?php selected( $site_sidebar, 'default' ); ?> > <?php esc_html_e( 'Customizer Setting', 'wpcake' ); ?></option>
					<option value="right-sidebar" <?php selected( $site_sidebar, 'right-sidebar' ); ?> > <?php esc_html_e( 'Right Sidebar', 'wpcake' ); ?></option>
					<option value="left-sidebar" <?php selected( $site_sidebar, 'left-sidebar' ); ?> > <?php esc_html_e( 'Left Sidebar', 'wpcake' ); ?></option>
					<option value="no-sidebar" <?php selected( $site_sidebar, 'no-sidebar' ); ?> > <?php esc_html_e( 'No Sidebar', 'wpcake' ); ?></option>
				</select>
			</div>
			<?php
			/**
			 * Option: Sidebar
			 */
			?>
			<div class="site-content-layout-meta-wrap components-base-control__field">
				<p class="post-attributes-label-wrapper" >
					<strong> <?php esc_html_e( 'Content Layout', 'wpcake' ); ?> </strong>
				</p>
				<select name="site-content-layout" id="site-content-layout">
					<option value="default" <?php selected( $site_content_layout, 'default' ); ?> > <?php esc_html_e( 'Customizer Setting', 'wpcake' ); ?></option>
				  <option value="wpcake-layout-default" <?php selected( $site_content_layout, 'wpcake-layout-default' ); ?> > <?php esc_html_e( 'Full Width / Contained', 'wpcake' ); ?></option>
					<option value="wpcake-full-width" <?php selected( $site_content_layout, 'wpcake-full-width' ); ?> > <?php esc_html_e( 'Full Width / Stretched', 'wpcake' ); ?></option>
				</select>
			</div>
			<?php
			/**
			 * Option: Disable Sections - Primary Header, Title, Footer Widgets, Footer Bar
			 */
			?>
			<div class="disable-section-meta-wrap components-base-control__field">
				<p class="post-attributes-label-wrapper">
					<strong> <?php esc_html_e( 'Disable Sections', 'wpcake' ); ?> </strong>
				</p>
				<div class="disable-section-meta">
					<?php do_action( 'wpcake_meta_box_markup_disable_sections_before', $meta ); ?>

					<div class="wpcake-main-header-display-option-wrap">
						<label for="wpcake-main-header-display">
							<input type="checkbox" id="wpcake-main-header-display" name="wpcake-main-header-display" value="disabled" <?php checked( $primary_header, 'disabled' ); ?> />
							<?php esc_html_e( 'Disable Primary Header', 'wpcake' ); ?>
						</label>
					</div>

					<?php if ( $show_meta_field ) { ?>

						<div class="page-transparent-header-option-wrap">
							<label for="page-transparent-header">
								<input type="checkbox" id="transparent-header" name="transparent-header" value="enabled" <?php checked( $transparent_header, 'enabled' ); ?> />
								<?php esc_html_e( 'Transparent Header', 'wpcake' ); ?>
							</label>
						</div>

						<div class="site-post-title-option-wrap">
							<label for="site-post-title">
								<input type="checkbox" id="site-post-title" name="site-post-title" value="disabled" <?php checked( $site_post_title, 'disabled' ); ?> />
								<?php esc_html_e( 'Disable Title', 'wpcake' ); ?>
							</label>
						</div>

						<div class="wpcake-featured-img-option-wrap">
							<label for="wpcake-featured-img">
								<input type="checkbox" id="wpcake-featured-img" name="wpcake-featured-img" value="disabled" <?php checked( $wpcake_featured_img, 'disabled' ); ?> />
								<?php esc_html_e( 'Disable Featured Image', 'wpcake' ); ?>
							</label>
						</div>

						<div class="site-post-title-option-wrap">
							<label for="disable-site-footer">
								<input type="checkbox" id="disable-site-footer" name="disable-site-footer" value="disabled" <?php checked( $disable_site_footer, 'disabled' ); ?> />
								<?php esc_html_e( 'Disable Footer', 'wpcake' ); ?>
							</label>
						</div>


					<?php } ?>

				  <?php do_action( 'wpcake_meta_box_markup_disable_sections_after', $meta ); ?>
				</div>
			</div>
			<?php

			do_action( 'wpcake_meta_box_markup_after', $meta );
		}

		/**
		 * Metabox Save
		 *
		 * @param  number $post_id Post ID.
		 * @return void
		 */
		function save_meta_box( $post_id ) {

			// Checks save status.
			$is_autosave    = wp_is_post_autosave( $post_id );
			$is_revision    = wp_is_post_revision( $post_id );
			$is_valid_nonce = ( isset( $_POST['wpcake_settings_meta_box'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash($_POST['wpcake_settings_meta_box'])), basename( __FILE__ ) ) ) ? true : false;

			// Exits script depending on save status.
			if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
				return;
			}

			/**
			 * Get meta options
			 */
			$post_meta = self::get_meta_option();

			foreach ( $post_meta as $key => $data ) {

				// Sanitize values.
				$sanitize_filter = ( isset( $data['sanitize'] ) ) ? $data['sanitize'] : 'FILTER_DEFAULT';

				switch ( $sanitize_filter ) {

					case 'FILTER_SANITIZE_STRING':
							$meta_value = filter_input( INPUT_POST, $key, FILTER_SANITIZE_STRING );
						break;

					case 'FILTER_SANITIZE_URL':
							$meta_value = filter_input( INPUT_POST, $key, FILTER_SANITIZE_URL );
						break;

					case 'FILTER_SANITIZE_NUMBER_INT':
							$meta_value = filter_input( INPUT_POST, $key, FILTER_SANITIZE_NUMBER_INT );
						break;

					default:
							$meta_value = filter_input( INPUT_POST, $key, FILTER_DEFAULT );
						break;
				}

				// Store values.
				if ( $meta_value ) {
					update_post_meta( $post_id, $key, $meta_value );
				} else {
					delete_post_meta( $post_id, $key );
				}
			}

		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
Wpcake_Meta_Boxes::get_instance();
