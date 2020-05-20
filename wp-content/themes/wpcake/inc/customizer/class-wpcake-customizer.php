<?php
/**
 * WPCake Customizer Class
 *
 * @package WPCake WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPCake_Customize' ) ) :

  /* CUSTOMIZER SETTINGS
  ------------------------------------------------ */
  class WPCake_Customize {

		public function __construct() {
			add_action( 'customize_register',	array( $this, 'custom_controls' ) );
			add_action( 'customize_register', array( $this, 'register' ) );
			add_action( 'customize_preview_init', array( $this, 'customize_preview_init' ) );
			add_action( 'wp_head', array( $this, 'set_fonts') );
		}

		public static function custom_controls(){

			// Path
			$control_dir = WPCAKE_THEME_DIR . 'inc/customizer/custom-controls/';

			// Load customize control classes
			require_once ( $control_dir . 'separator/class-wpcake-separator.php' );
			require_once ( $control_dir . 'range/class-wpcake-control-range.php' );
			require_once ( $control_dir . 'radio-image/class-control-radio-image.php' );
			require_once ( $control_dir . 'text-radio-button/class-control-text-radio-button.php' );
			require_once ( $control_dir . 'alpha-color/class-alpha-color.php' );
			require_once ( $control_dir . 'image-checkbox/class-image-checkbox.php' );
			require_once ( $control_dir . 'google-fonts/class-google-fonts.php' );
			require_once ( $control_dir . 'toggle/class-toggle.php' );
		}

  	public static function register ( $wp_customize ) {

      $priority = 50;

			// Set custom logo width
			$wp_customize->add_setting( 'wpcake_custom_logo_width', array(
					'default'   => 170,
					'transport'	=> 'postMessage',
					'sanitize_callback' => 'absint',
				));
			$wp_customize->add_control( new WPCake_Slider_Custom_Control( $wp_customize, 'wpcake_custom_logo_width',
				array(
					'label' => __( 'Logo Width', 'wpcake' ),
					'section' => 'title_tagline',
					'priority'    => 9,
					'description' => __('Measurement is in pixel.', 'wpcake'),
					'input_attrs' => array(
						'min' => 50,
						'max' => 900,
						'step' => 1,
					),
				)));

			// Set custom logo top margin
			$wp_customize->add_setting( 'wpcake_custom_logo_margin', array(
					'default'   => 0,
					'transport'	=> 'postMessage',
					'sanitize_callback' => 'wpcake_sanitize_integer',
				));
			$wp_customize->add_control( new WPCake_Slider_Custom_Control( $wp_customize, 'wpcake_custom_logo_margin',
				array(
					'label' => __( 'Logo Top Margin', 'wpcake' ),
					'section' => 'title_tagline',
					'priority'    => 9,
					'description' => __('Measurement is in pixel.', 'wpcake'),
					'input_attrs' => array(
						'min' => -30,
						'max' => 150,
						'step' => 1,
					),
				)));

			// Add option for uploading a mobile logo
			$wp_customize->add_setting( 'wpcake_custom_mobile_logo', array(
					'sanitize_callback' => 'wpcake_sanitize_url',
			));
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpcake_custom_mobile_logo',
				array(
					'label' => __( 'Small screen logo', 'wpcake' ),
					'description' => __('This image will replace the main logo on most mobile devices.', 'wpcake'),
					'section' => 'title_tagline',
					'priority'    => 9,
			)));


			// Disable Blogname
			$wp_customize->add_setting( 'wpcake_disable_blogname', array(
				'default'           	=> false,
				'sanitize_callback' 	=> 'wpcake_sanitize_checkbox',
			) );
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wpcake_disable_blogname', array(
				'label'	   				=> esc_html__( 'Disable site title', 'wpcake' ),
				'type' 					=> 'checkbox',
				'section'  				=> 'title_tagline',
				'priority' 				=> 11,
			) ) );


			// Disable Blogdescription
			$wp_customize->add_setting( 'wpcake_disable_blogdescription', array(
				'default'           	=> true,
				'sanitize_callback' 	=> 'wpcake_sanitize_checkbox',
			) );
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wpcake_disable_blogdescription', array(
				'label'	   				=> esc_html__( 'Disable site tagline', 'wpcake' ),
				'type' 					=> 'checkbox',
				'section'  				=> 'title_tagline',
				'priority' 				=> 11,
			) ) );



			function wpcake_check_site_title_status( $control ) {
				$value = $control->manager->get_setting('wpcake_disable_blogname')->value();
				 if ( empty($value)|| '' == $value ) {
						return true;
				 } else {
						return false;
				 }
			}

			// Layout Panel
      $wp_customize->add_panel( 'wpcake_layout', array(
				'title'          => esc_html__('Layout', 'wpcake'),
        'priority'       => $priority++,
      ) );

			// Global Section <- Layout Panel
			$wp_customize->add_section( 'wpcake_layout_content', array(
				'title'          => esc_html__('Global', 'wpcake'),
				'panel'					=> 'wpcake_layout',
				'priority'       => $priority++,
			) );

			// Header Section <- Layout Panel
			$wp_customize->add_section( 'wpcake_layout_header', array(
				'title'          => esc_html__('Header', 'wpcake'),
				'panel'					=> 'wpcake_layout',
        'priority'       => $priority++,
      ) );

			// WooCommerce section <- Colors Panel
			if( wpcake_check_for_woocommerce() ){

				// WooCommerce Section <- Layout Panel
				$wp_customize->add_section( 'wpcake_layout_wc', array(
					'title'          => esc_html__('WooCommerce', 'wpcake'),
					'panel'					=> 'wpcake_layout',
					'priority'       => $priority++,
				) );

				// hide/show Menu Cart icon
				$wp_customize->add_setting( 'wpcake_wc_mini_total', array(
					'default'           	=> false,
					'sanitize_callback' 	=> 'wpcake_sanitize_checkbox',
				) );

				$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wpcake_wc_mini_total', array(
					'label'	   				=> esc_html__( 'Hide mini cart from main menu', 'wpcake' ),
					'type' 					=> 'checkbox',
					'section'  				=> 'wpcake_layout_wc',
					'priority' 				=> $priority++,
				) ) );

				// WooCommerce sidebar layout
				$wp_customize->add_setting( 'wpcake_wc_sidebar', array(
					'default'   => 'right-sidebar',
					'sanitize_callback' => 'wpcake_sanitize_text',
				));
				$wp_customize->add_control( new WPCake_Text_Radio_Button_Custom_Control( $wp_customize, 'wpcake_wc_sidebar',
					array(
						'label' 						=> __( 'WooCommerce Sidebar', 'wpcake' ),
						'section' 					=> 'wpcake_layout_wc',
						'priority'	 				=> $priority++,
						'choices' => array(
							'left-sidebar'      => esc_html__('Left', 'wpcake'),
							'no-sidebar'   => esc_html__('No Sidebar', 'wpcake'),
							'right-sidebar'      => esc_html__('Right', 'wpcake')
					))));

				// WooCommerce single product sidebar layout
				$wp_customize->add_setting( 'wpcake_wc_single_sidebar', array(
					'default'   => 'right-sidebar',
					'sanitize_callback' => 'wpcake_sanitize_text',
				));
				$wp_customize->add_control( new WPCake_Text_Radio_Button_Custom_Control( $wp_customize, 'wpcake_wc_single_sidebar',
					array(
						'label' 						=> __( 'Single Product Sidebar', 'wpcake' ),
						'section' 					=> 'wpcake_layout_wc',
						'priority'	 				=> $priority++,
						'choices' => array(
							'left-sidebar'      => esc_html__('Left', 'wpcake'),
							'no-sidebar'   			=> esc_html__('No Sidebar', 'wpcake'),
							'right-sidebar'     => esc_html__('Right', 'wpcake')
					))));


			}/* END WOOCOMMERCE CHECK */

			// Blog / Archive Section <- Layout Panel
			$wp_customize->add_section( 'wpcake_layout_blog_archive', array(
				'title'          => esc_html__('Blog / Archive', 'wpcake'),
				'panel'					=> 'wpcake_layout',
				'priority'       => $priority++,
			) );

			// Blog Archive style
			$wp_customize->add_setting( 'wpcake_blog_style',
				array(
					'default' => 'default',
					'sanitize_callback' => 'wpcake_radio_sanitization'
				)
			);
			$wp_customize->add_control( new WPCake_Text_Radio_Button_Custom_Control( $wp_customize, 'wpcake_blog_style',
				array(
					'label' => __( 'Blog Style', 'wpcake' ),
					'section' => 'wpcake_layout_blog_archive',
					'choices' => array(
						'grid' => __( 'Grid', 'wpcake' ),
						'default'			=> __( 'Large Img', 'wpcake' ),
						'thumb' => __( 'Thumbnail', 'wpcake'  )
					)
				)
			) );

			// Disable header
			$wp_customize->add_setting( 'wpcake_disable_header', array(
				'default'           	=> false,
				'sanitize_callback' 	=> 'wpcake_switch_sanitization',
			) );
			$wp_customize->add_control( new WPCake_Toggle_Switch_Custom_control( $wp_customize, 'wpcake_disable_header', array(
				'label'	   				=> esc_html__( 'Disable Header', 'wpcake' ),
				'section'  				=> 'wpcake_layout_header',
				'priority' 				=> $priority++,
			) ) );

			// Header Max-width
			$wp_customize->add_setting( 'wpcake_contain_header', array(
				'default'           	=> true,
				'sanitize_callback' 	=> 'wpcake_switch_sanitization',
			) );
			$wp_customize->add_control( new WPCake_Toggle_Switch_Custom_control( $wp_customize, 'wpcake_contain_header', array(
				'label'	   				=> esc_html__( 'Set max width for header', 'wpcake' ),
				'section'  				=> 'wpcake_layout_header',
				'priority' 				=> $priority++,
			) ) );

			// Header max-width value
			$wp_customize->add_setting( 'wpcake_header_max_width', array(
					'default'   => 1240,
					'sanitize_callback' => 'absint',
				));
			$wp_customize->add_control( new WPCake_Slider_Custom_Control( $wp_customize, 'wpcake_header_max_width',
				array(
					'label' => __( 'Header maximum width', 'wpcake' ),
					'section' => 'wpcake_layout_header',
					'priority' 				=> $priority++,
					'input_attrs' => array(
						'min' => 720,
						'max' => 2000,
						'step' => 1,
					),
					'active_callback' => 'wpcake_check_max_width',
				)
			) );

			function wpcake_check_max_width( $control ) {
			   if ( $control->manager->get_setting('wpcake_contain_header')->value() != '' ) {
			      return true;
			   } else {
			      return false;
			   }
			}

			// Register the radio image control class as a JS control type.
			$wp_customize->register_control_type( 'Wpcake_Customize_Control_Radio_Image' );

			// Set the primary header layout
			$wp_customize->add_setting(
				'wpcake_header_layout',
				array(
					'default'           => 'default',
					'sanitize_callback' => 'wpcake_sanitize_text',
				)
			);
			$wp_customize->add_control(
				new Wpcake_Customize_Control_Radio_Image(
					$wp_customize,
					'wpcake_header_layout',
					array(
						'label'    => esc_html__( 'Primary Header Layout', 'wpcake' ),
						'section'  => 'wpcake_layout_header',
						'priority' => $priority++,
						'choices'  => array(
							'default' => array(
								'label' => esc_html__( 'Default Layout', 'wpcake' ),
								'url'   => WPCAKE_THEME_URI . '/assets/images/header-layout-1-76x48.png'
							),
							'center' => array(
								'label' => esc_html__( 'Center Layout', 'wpcake' ),
								'url'   => WPCAKE_THEME_URI . '/assets/images/header-layout-2-76x48.png'
							),
							'right' => array(
								'label' => esc_html__( 'Logo on right', 'wpcake' ),
								'url'   => WPCAKE_THEME_URI . '/assets/images/header-layout-3-76x48.png'
							)
						)
					)
				)
			);

			// Header bottom margin
			$wp_customize->add_setting( 'wpcake_header_btm_margin', array(
					'default'   => 100,
					'transport' => 'postMessage',
					'sanitize_callback' => 'absint',
				));
			$wp_customize->add_control( new WPCake_Slider_Custom_Control( $wp_customize, 'wpcake_header_btm_margin',
				array(
					'label' => __( 'Header Bottom Margin', 'wpcake' ),
					'section' => 'wpcake_layout_header',
					'priority' 				=> $priority++,
					'input_attrs' => array(
						'min' => 0,
						'max' => 400,
						'step' => 1,
					),
				)
			) );

			// Transparent Header
			$wp_customize->add_setting( 'wpcake_transparent_header',
				array(
					'default' => false,
					'sanitize_callback' => 'wpcake_switch_sanitization'
				)
			);
			$wp_customize->add_control( new WPCake_Toggle_Switch_Custom_control( $wp_customize, 'wpcake_transparent_header',
				array(
					'label' => __( 'Transparent Header', 'wpcake' ),
					'description' => __('The header will not be transparent on mobile screens', 'wpcake'),
					'section' => 'wpcake_layout_header',
					'priority' 				=> $priority++,
				)
			) );


			// Set sidebar layout
      $wp_customize->add_setting( 'wpcake_site_sidebar', array(
        'default'   => 'right-sidebar',
        'sanitize_callback' => 'wpcake_sanitize_text',
      ));
			$wp_customize->add_control( new WPCake_Text_Radio_Button_Custom_Control( $wp_customize, 'wpcake_site_sidebar',
				array(
					'label' 						=> __( 'Sidebar', 'wpcake' ),
					'section' 					=> 'wpcake_layout_content',
					'priority'	 				=> $priority++,
					'choices' => array(
						'left-sidebar'      => esc_html__('Left', 'wpcake'),
						'no-sidebar'   => esc_html__('No Sidebar', 'wpcake'),
						'right-sidebar'      => esc_html__('Right', 'wpcake')
				))));

			// Use custom search sidebar on search results page
			$wp_customize->add_setting( 'wpcake_search_custom_sidebar', array(
				'default'           	=> true,
				'sanitize_callback' 	=> 'wpcake_sanitize_checkbox',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wpcake_search_custom_sidebar', array(
				'label'	   				=> esc_html__( 'Custom sidebar for search results page', 'wpcake' ),
				'type' 					=> 'checkbox',
				'section'  				=> 'wpcake_layout_content',
				'priority' 				=> $priority++,
			) ) );

			// Set Page Layout
      $wp_customize->add_setting( 'wpcake_default_container', array(
          'default'   => 'plain-container',
          'sanitize_callback' => 'wpcake_sanitize_text',
        ));
      $wp_customize->add_control( 'wpcake_default_container', array(
        'label'             => esc_html__( 'Container', 'wpcake' ),
        'section'           => 'wpcake_layout_content',
        'type'              => 'select',
    		'choices'           => array(
      			'plain-container'   => esc_html__('Full Width / Contained', 'wpcake'),
            'page-builder'      => esc_html__('Full Width / Stretched', 'wpcake'),
    		),
        'priority'	 				=> $priority++,
      ));

			// Header max-width value
			$wp_customize->add_setting( 'wpcake_main_max_width', array(
					'default'   => 1240,
					'sanitize_callback' => 'absint',
				));
			$wp_customize->add_control( new WPCake_Slider_Custom_Control( $wp_customize, 'wpcake_main_max_width',
				array(
					'label' => __( 'Set maximum width', 'wpcake' ),
					'section' => 'wpcake_layout_content',
					'priority' 				=> $priority++,
					'input_attrs' => array(
						'min' => 720,
						'max' => 2000,
						'step' => 1,
					),
					'active_callback' => 'wpcake_check_main_max_width',
				)
			) );

			function wpcake_check_main_max_width( $control ) {
				 if ( $control->manager->get_setting('wpcake_default_container')->value() != 'page-builder' ) {
						return true;
				 } else {
						return false;
				 }
			}

			// Disable Page Title throughout site
			$wp_customize->add_setting( 'wpcake_disable_page_title', array(
				'default'           	=> false,
				'sanitize_callback' 	=> 'wpcake_sanitize_checkbox',
			) );
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wpcake_disable_page_title', array(
				'label'	   				=> esc_html__( 'Disable entry title', 'wpcake' ),
				'type' 					=> 'checkbox',
				'section'  				=> 'wpcake_layout_content',
				'priority' 				=> $priority++,
			) ) );

			// Disable Featured Image throughout site
			$wp_customize->add_setting( 'wpcake_disable_featured_image', array(
				'default'           	=> false,
				'sanitize_callback' 	=> 'wpcake_sanitize_checkbox',
			) );
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wpcake_disable_featured_image', array(
				'label'	   				=> esc_html__( 'Disable featured image', 'wpcake' ),
				'type' 					=> 'checkbox',
				'section'  				=> 'wpcake_layout_content',
				'priority' 				=> $priority++,
			) ) );

			// Typography Section
      $wp_customize->add_panel( 'wpcake_typography', array(
				'title'          => esc_html__('Typography', 'wpcake'),
        'priority'       => $priority++,
      ) );

			$wp_customize->add_section( 'wpcake_body_typography', array(
				'title'          => esc_html__('Body', 'wpcake'),
				'panel'					 => 'wpcake_typography',
				'priority'       => $priority++,
			) );

			$wp_customize->add_section( 'wpcake_site_title_typography', array(
				'title'          => esc_html__('Site Title & Description', 'wpcake'),
				'panel'					 => 'wpcake_typography',
				'priority'       => $priority++,
			) );

			$wp_customize->add_section( 'wpcake_headings_typography', array(
				'title'          => esc_html__('Headings', 'wpcake'),
				'panel'					 => 'wpcake_typography',
				'priority'       => $priority++,
			) );

			$wp_customize->add_section( 'wpcake_nav_typography', array(
				'title'          => esc_html__('Site menu', 'wpcake'),
				'panel'					 => 'wpcake_typography',
				'priority'       => $priority++,
			) );


			// ======== System fonts setup
			$wpcakeSysListFonts        		= array(); // 1
			$sys_webfonts_array    		= file( WPCAKE_THEME_DIR . '/assets/fonts/system-fonts.json');
			$sys_webfonts          		= implode( '', $sys_webfonts_array );
			$wpcakeSysListFonts_decode 		= json_decode( $sys_webfonts, true );

			foreach ( $wpcakeSysListFonts_decode['items'] as $key => $value ) {
				$sys_item_family                     = $wpcakeSysListFonts_decode['items'][$key]['family'];
				$wpcakeSysListFonts[$sys_item_family]        = $sys_item_family;
			}

			require_once WPCAKE_THEME_DIR . 'inc/customizer/body-typography.php';

			require_once WPCAKE_THEME_DIR . 'inc/customizer/site-title-typography.php';

			require_once WPCAKE_THEME_DIR . 'inc/customizer/headings-typography.php';

			require_once WPCAKE_THEME_DIR . 'inc/customizer/nav-typography.php';


			// Top Bar Options
			require_once WPCAKE_THEME_DIR . 'inc/customizer/top-bar.php';

			// Colors Options
			require_once WPCAKE_THEME_DIR . 'inc/customizer/colors.php';


			// Footer Section
      $wp_customize->add_section( 'wpcake_footer', array(
				'title'          => esc_html__('Footer', 'wpcake'),
				'panel'					 => 'wpcake_layout',
        'priority'       => $priority++,
      ) );

			/* SEPARATOR */
			$wp_customize->add_setting( 'wpcake_footer_widgets_separator', array(
					'type'          => 'theme_mod',
					'capability'    => 'edit_theme_options',
					'sanitize_callback'    => 'wpcake_sanitize_text',
			));
			$wp_customize->add_control( new WPCake_Customize_Separator_Control( $wp_customize, 'wpcake_footer_widgets_separator', array(
					'label'     => __( 'Footer Widgets', 'wpcake' ),
					'section'   => 'wpcake_footer',
					'priority'	=> $priority++,
			)));

			// Set the footer layout
			$wp_customize->add_setting(
				'wpcake_footer_widgets_layout',
				array(
					'default'           => 'default',
					'sanitize_callback' => 'wpcake_sanitize_text',
				)
			);
			$wp_customize->add_control(
				new Wpcake_Customize_Control_Radio_Image(
					$wp_customize,
					'wpcake_footer_widgets_layout',
					array(
						'label'    => esc_html__( 'Footer widgets section', 'wpcake' ),
						'section'  => 'wpcake_footer',
						'priority'	=> $priority++,
						'choices'  => array(
							'disable' => array(
								'label' => esc_html__( 'Disable', 'wpcake' ),
								'url'   => WPCAKE_THEME_URI . '/assets/images/footer-layout-3-76x48.png'
							),
							'default' => array(
								'label' => esc_html__( 'Four column', 'wpcake' ),
								'url'   => WPCAKE_THEME_URI . '/assets/images/footer-widgets.png'
							)
						)
					)
				)
			);

			// Header max-width value
			$wp_customize->add_setting( 'wpcake_footer_widgets_border_width', array(
					'default'   => 7,
					'sanitize_callback' => 'absint',
				));
			$wp_customize->add_control( new WPCake_Slider_Custom_Control( $wp_customize, 'wpcake_footer_widgets_border_width',
				array(
					'label' => __( 'Widget section border width', 'wpcake' ),
					'section' => 'wpcake_footer',
					'priority' 				=> $priority++,
					'active_callback' 	=> 'wpcake_check_footer_widgets_status',
					'input_attrs' => array(
						'min' => 0,
						'max' => 20,
						'step' => 1,
					),
				)
			) );

			function wpcake_check_footer_widgets_status( $control ) {
				$value = $control->manager->get_setting('wpcake_footer_widgets_layout')->value();
				 if ( $value == 'default' ) {
						return true;
				 } else {
						return false;
				 }
			}


			/* SEPARATOR */
			$wp_customize->add_setting( 'wpcake_footer_section_separator', array(
					'type'          => 'theme_mod',
					'capability'    => 'edit_theme_options',
					'sanitize_callback'    => 'wpcake_sanitize_text',
			));
			$wp_customize->add_control( new WPCake_Customize_Separator_Control( $wp_customize, 'wpcake_footer_section_separator', array(
					'label'     => __( 'Footer Bar', 'wpcake' ),
					'section'   => 'wpcake_footer',
					'priority'	=> $priority++,
			)));

			// Set the footer layout
			$wp_customize->add_setting(
				'wpcake_footer_layout',
				array(
					'default'           => 'center',
					'sanitize_callback' => 'wpcake_sanitize_text',
				)
			);
			$wp_customize->add_control(
				new Wpcake_Customize_Control_Radio_Image(
					$wp_customize,
					'wpcake_footer_layout',
					array(
						'label'    => esc_html__( 'Footer Copyright Area Layout', 'wpcake' ),
						'section'  => 'wpcake_footer',
						'priority'	=> $priority++,
						'choices'  => array(
							'split' => array(
								'label' => esc_html__( 'Split Layout', 'wpcake' ),
								'url'   => WPCAKE_THEME_URI . '/assets/images/footer-layout-1-76x48.png'
							),
							'center' => array(
								'label' => esc_html__( 'Center Layout', 'wpcake' ),
								'url'   => WPCAKE_THEME_URI . '/assets/images/footer-layout-2-76x48.png'
							),
							'disable' => array(
								'label' => esc_html__( 'Disable', 'wpcake' ),
								'url'   => WPCAKE_THEME_URI . '/assets/images/footer-layout-3-76x48.png'
							)
						)
					)
				)
			);

			// Header max-width value
			$wp_customize->add_setting( 'wpcake_footer_border_width', array(
					'default'   => 1,
					'sanitize_callback' => 'absint',
				));
			$wp_customize->add_control( new WPCake_Slider_Custom_Control( $wp_customize, 'wpcake_footer_border_width',
				array(
					'label' => __( 'Footer top border width', 'wpcake' ),
					'section' => 'wpcake_footer',
					'priority' 				=> $priority++,
					'active_callback' 	=> 'wpcake_check_footer_status',
					'input_attrs' => array(
						'min' => 0,
						'max' => 20,
						'step' => 1,
					),
				)
			) );

			function wpcake_check_footer_status( $control ) {
				$value = $control->manager->get_setting('wpcake_footer_layout')->value();
				 if ( $value != 'disable' ) {
						return true;
				 } else {
						return false;
				 }
			}

			// Transparent Header
			$wp_customize->add_setting( 'wpcake_transparent_footer',
				array(
					'default' => false,
					'sanitize_callback' => 'wpcake_switch_sanitization'
				)
			);
			$wp_customize->add_control( new WPCake_Toggle_Switch_Custom_control( $wp_customize, 'wpcake_transparent_footer',
				array(
					'label' => __( 'Transparent Footer', 'wpcake' ),
					'active_callback' 	=> 'wpcake_check_footer_status',
					'section' => 'wpcake_footer',
					'priority' 				=> $priority++,
				)
			) );

			$wp_customize->add_setting( 'wpcake_footer_section_one', array(
					'default'   => 'default',
					'sanitize_callback' => 'wpcake_sanitize_text',
				));
			$wp_customize->add_control( new WPCake_Text_Radio_Button_Custom_Control( $wp_customize, 'wpcake_footer_section_one',
				array(
					'label' 						=> __( 'Copyright Section 1 Text', 'wpcake' ),
					'section' 					=> 'wpcake_footer',
					'active_callback' 	=> 'wpcake_check_footer_status',
					'priority'	 				=> $priority++,
					'choices' => array(
						'default'   			=> esc_html__('Default', 'wpcake'),
      			'footer_text'   	=> esc_html__('Custom', 'wpcake')
				))));


			$wp_customize->add_setting( 'wpcake_footer_section_one_text', array(
					'default'   => '',
					'transport'	=> 'postMessage',
					'sanitize_callback' => 'wpcake_sanitize_textarea',
				));
			$wp_customize->add_control( 'wpcake_footer_section_one_text', array(
				'label'             => esc_html__( 'Custom Text', 'wpcake' ),
				'section'           => 'wpcake_footer',
				'description'				=> __('Allows for basic HTML', 'wpcake'),
				'type'              => 'textarea',
				'active_callback'		=> function( $control ) {
        return (
            wpcake_check_s1_footer_status( $control )
            &&
            wpcake_check_footer_status( $control )
        	);
				},
				'priority'	 				=> $priority++,
			));

			function wpcake_check_s1_footer_status( $control ) {
				$value = $control->manager->get_setting('wpcake_footer_section_one')->value();
				 if ( $value == 'footer_text' ) {
						return true;
				 } else {
						return false;
				 }
			}

			$wp_customize->add_setting( 'wpcake_footer_section_two', array(
					'default'   => 'default',
					'sanitize_callback' => 'wpcake_sanitize_text',
				));
			$wp_customize->add_control( new WPCake_Text_Radio_Button_Custom_Control( $wp_customize, 'wpcake_footer_section_two',
				array(
					'label' 						=> __( 'Copyright Section 2 Text', 'wpcake' ),
					'section' 					=> 'wpcake_footer',
					'active_callback' 	=> 'wpcake_check_footer_status',
					'priority'	 				=> $priority++,
					'choices' => array(
						'default'   			=> esc_html__('Default', 'wpcake'),
						'footer_text'   	=> esc_html__('Custom', 'wpcake'),
						'disable'   	=> esc_html__('Disable', 'wpcake')
				))));


			$wp_customize->add_setting( 'wpcake_footer_section_two_text', array(
					'default'   => '',
					'transport' => 'postMessage',
					'sanitize_callback' => 'wpcake_sanitize_textarea',
				));
			$wp_customize->add_control( 'wpcake_footer_section_two_text', array(
				'label'             => esc_html__( 'Custom Text', 'wpcake' ),
				'section'           => 'wpcake_footer',
				'description'				=> __('Allows for basic HTML', 'wpcake'),
				'type'              => 'textarea',
				'active_callback' 	=> function( $control ) {
        return (
            wpcake_check_s2_footer_status( $control )
            &&
            wpcake_check_footer_status( $control )
        	);
				},
				'priority'	 				=> $priority++,
			));
			function wpcake_check_s2_footer_status( $control) {
				$value = $control->manager->get_setting('wpcake_footer_section_two')->value();
				 if ( $value == 'footer_text' ) {
						return true;
				 } else {
						return false;
				 }
			}

  		// Make built-in controls use live JS preview
  		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
  		$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
			$wp_customize->remove_control('background_color');


  		// SANITATION

      // Sanitize Text
			if ( ! function_exists( 'wpcake_sanitize_text' ) ) {
	      function wpcake_sanitize_text( $input ) {
	          return sanitize_text_field( $input );
	      }
			}

			// Integer sanitization
			if ( ! function_exists( 'wpcake_sanitize_integer' ) ) {
				function wpcake_sanitize_integer( $input ) {
					return (int) $input;
				}
			}

			// number sanitization
			function wpcake_sanitize_number( $val ) {
				return is_numeric( $val ) ? $val : 0;
			}


			// Sanitize Textarea
			if ( ! function_exists( 'wpcake_sanitize_textarea' ) ) {
				function wpcake_sanitize_textarea($input) {
					$output = wp_kses( $input, wpcake_allowed_html());
					return $output;
				}
			}

			// Sanitize Colors
			if ( ! function_exists( 'wpcake_sanitize_hex' ) ) {
				function wpcake_sanitize_hex($input){
					return maybe_hash_hex_color($input);
				}
			}

			// Sanitize website address
			if ( ! function_exists( 'wpcake_sanitize_url' ) ) {
				function wpcake_sanitize_url($input){
					return esc_url_raw($input);
				}
			}

  		// Sanitize boolean for checkbox
			if ( ! function_exists( 'wpcake_sanitize_checkbox' ) ) {
	  		function wpcake_sanitize_checkbox( $checked ) {
	  			return ( ( isset( $checked ) && true == $checked ) ? true : false );
	  		}
			}

			//Radio Button and Select sanitization
			if ( ! function_exists( 'wpcake_radio_sanitization' ) ) {
				function wpcake_radio_sanitization( $input, $setting ) {
					//get the list of possible radio box or select options
						 $choices = $setting->manager->get_control( $setting->id )->choices;

					if ( array_key_exists( $input, $choices ) ) {
						return $input;
					} else {
						return $setting->default;
					}
				}
			}
			// Switch sanitization
			if ( ! function_exists( 'wpcake_switch_sanitization' ) ) {
				function wpcake_switch_sanitization( $input ) {
					if ( true === $input ) {
						return 1;
					} else {
						return 0;
					}
				}
			}

			// Alpha Color (Hex & RGBa) sanitization
			if ( ! function_exists( 'wpcake_hex_rgba_sanitization' ) ) {
				function wpcake_hex_rgba_sanitization( $input, $setting ) {
					if ( empty( $input ) || is_array( $input ) ) {
						return $setting->default;
					}

					if ( false === strpos( $input, 'rgba' ) ) {
						// If string doesn't start with 'rgba' then santize as hex color
						$input = sanitize_hex_color( $input );
					} else {
						// Sanitize as RGBa color
						$input = str_replace( ' ', '', $input );
						sscanf( $input, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
						$input = 'rgba(' . wpcake_in_range( $red, 0, 255 ) . ',' . wpcake_in_range( $green, 0, 255 ) . ',' . wpcake_in_range( $blue, 0, 255 ) . ',' . wpcake_in_range( $alpha, 0, 1 ) . ')';
					}
					return $input;
				}
			}

			// Only allow values between a certain minimum & maxmium range
			if ( ! function_exists( 'wpcake_in_range' ) ) {
				function wpcake_in_range( $input, $min, $max ){
					if ( $input < $min ) {
						$input = $min;
					}
					if ( $input > $max ) {
						$input = $max;
					}
						return $input;
				}
			}

			/**
			 * Google Font sanitization
			 *
			 * @param  string	JSON string to be sanitized
			 * @return string	Sanitized input
			 */
			if ( ! function_exists( 'wpcake_google_font_sanitization' ) ) {
				function wpcake_google_font_sanitization( $input ) {
					$val =  json_decode( $input, true );
					if( is_array( $val ) ) {
						foreach ( $val as $key => $value ) {
							$val[$key] = sanitize_text_field( $value );
						}
						$input = json_encode( $val );
					}
					else {
						$input = json_encode( sanitize_text_field( $val ) );
					}
					return $input;
				}
			}


  	}

		// Initiate the live preview JS
		public static function customize_preview_init() {
			$js_uri  = WPCAKE_THEME_URI . 'assets/js/';
			wp_enqueue_script( 'wpcake_customizer', $js_uri . 'theme-customizer.js', array( 'jquery','customize-preview' ), '', true );
		}


		public static function wpcake_font_css_output() {

			$disable_google_fonts = get_theme_mod('wpcake_disable_google_fonts');
			$disable_st_google_fonts = get_theme_mod('wpcake_st_disable_google_fonts');
			$disable_st_desc_google_fonts = get_theme_mod('wpcake_st_desc_disable_google_fonts');
			$disable_h_google_fonts = get_theme_mod('wpcake_h_disable_google_fonts');
			$disable_n_google_fonts = get_theme_mod('wpcake_n_disable_google_fonts');

			// Body
			if( empty( $disable_google_fonts ) ||  '' == $disable_google_fonts ){
				$font_family = get_theme_mod( 'wpcake_google_fonts', '{"font":"PT Serif","regularweight":"regular","italicweight":"italic","boldweight":"400","category":"serif"}' );
				$font = json_decode($font_family);
				$font_family = $font->font;
				$font_fallback = $font->category;
				$font_family = $font_family;
				$font_weight = $font->regularweight;
				self::enqueue_google_fonts('wpcake-font', $font_family, $font_weight);
			}else{
				$font_family = get_theme_mod( 'wpcake_system_fonts', 'inherit' );
				$font_weight = get_theme_mod( 'wpcake_system_fonts_weights', '400' );
			}

			// Site Title
			if( empty( $disable_st_google_fonts ) ||  '' == $disable_st_google_fonts ){
				$siteTitle_font_family = get_theme_mod( 'wpcake_st_google_fonts', '{"font":"inherit","regularweight":"regular","italicweight":"italic","boldweight":"400","category":"serif"}' );
				$font = json_decode($siteTitle_font_family);
				$siteTitle_font_family = $font->font;
				$siteTitle_font_fallback = $font->category;
				$siteTitle_font_family = $siteTitle_font_family;
				$siteTitle_font_weight = $font->regularweight;
				if( $font_family != $siteTitle_font_family && 'inherit' != $siteTitle_font_family){
					self::enqueue_google_fonts('wpcake-site-title-font', $siteTitle_font_family, $siteTitle_font_weight);
				}
			}else{
				$siteTitle_font_family = get_theme_mod( 'wpcake_st_system_fonts', 'inherit' );
				$siteTitle_font_weight = get_theme_mod( 'wpcake_st_system_fonts_weights', '400' );
			}

			// Site Description
			if( empty( $disable_st_desc_google_fonts ) ||  '' == $disable_st_desc_google_fonts ){
				$siteDesc_font_family = get_theme_mod( 'wpcake_st_desc_google_fonts', '{"font":"inherit","regularweight":"regular","italicweight":"italic","boldweight":"400","category":"serif"}' );
				$font = json_decode($siteDesc_font_family);
				$siteDesc_font_family = $font->font;
				$siteDesc_font_fallback = $font->category;
				$siteDesc_font_family = $siteDesc_font_family;
				$siteDesc_font_weight = $font->regularweight;
				if( $font_family != $siteDesc_font_family && $siteTitle_font_family != $siteDesc_font_family && 'inherit' != $siteDesc_font_family){
					self::enqueue_google_fonts('wpcake-site-desc-font', $siteDesc_font_family, $siteDesc_font_weight);
				}
			}else{
				$siteDesc_font_family = get_theme_mod( 'wpcake_st_desc_system_fonts', 'inherit' );
				$siteDesc_font_weight = get_theme_mod( 'wpcake_st_desc_system_fonts_weights', '400' );
			}


			// Headings
			if( empty( $disable_h_google_fonts ) ||  '' == $disable_h_google_fonts ){
				$headings_font_family = get_theme_mod( 'wpcake_h_google_fonts', '{"font":"inherit","regularweight":"regular","italicweight":"italic","boldweight":"400","category":"serif"}' );
				$font = json_decode($headings_font_family);
				$headings_font_family = $font->font;
				$headings_font_fallback = $font->category;
				$headings_font_family = $headings_font_family;
				$headings_font_weight = $font->regularweight;
				if( $font_family != $headings_font_family && 'inherit' != $headings_font_family){
					self::enqueue_google_fonts('wpcake-headings-font', $headings_font_family, $headings_font_weight);
				}
			}else{
				$headings_font_family = get_theme_mod( 'wpcake_h_system_fonts', 'inherit' );
				$headings_font_weight = get_theme_mod( 'wpcake_h_system_fonts_weights', '400' );
			}

			// Main Menu
			if( empty( $disable_n_google_fonts ) ||  '' == $disable_n_google_fonts ){
				$nav_font_family = get_theme_mod( 'wpcake_n_google_fonts', '{"font":"inherit","regularweight":"regular","italicweight":"italic","boldweight":"400","category":"serif"}' );
				$font = json_decode($nav_font_family);
				$nav_font_family = $font->font;
				$nav_font_fallback = $font->category;
				$nav_font_family = $nav_font_family;
				$nav_font_weight = $font->regularweight;
				if( $font_family != $nav_font_family && $headings_font_family != $nav_font_family  && 'inherit' != $nav_font_family){
					self::enqueue_google_fonts('wpcake-nav-font', $nav_font_family, $nav_font_weight);
				}
			}else{
				$nav_font_family = get_theme_mod( 'wpcake_n_system_fonts', 'inherit' );
				$nav_font_weight = get_theme_mod( 'wpcake_n_system_fonts_weights', '400' );
			}

		    // Start output buffering
		    ob_start();
		    ?>
		        body * {
							font-family: <?php echo esc_attr( $font_family ); ?>;
							<?php if( $disable_google_fonts ):
								?>
									font-weight:<?php echo esc_attr( $font_weight ); ?>;
								<?php
							endif; ?>
						}
						<?php if( $headings_font_family != 'inherit' ):?>
						h1,h2,h3,h4,h5,h6,
						h1 *,h2 *,h3 *,h4 *,h5 *,h6 *{
							font-family: <?php echo esc_attr( $headings_font_family ); ?>;
							<?php if( $disable_h_google_fonts ):
								?>
									font-weight:<?php echo esc_attr( $headings_font_weight ); ?>;
								<?php
							endif; ?>
						}
						<?php endif; ?>

						<?php
						 if('inherit' != $siteTitle_font_family ): ?>
						 	header .site-title,
							header .site-title a{
								font-family: <?php echo esc_attr( $siteTitle_font_family ); ?>;
								<?php if( $disable_st_google_fonts ):
									?>
										font-weight:<?php echo esc_attr( $siteTitle_font_weight ); ?>;
									<?php
								endif; ?>
							}
						<?php
						 endif;
						?>

						<?php
						 if('inherit' != $siteDesc_font_family ): ?>
						 	header .site-description,
							header .site-description a{
								font-family: <?php echo esc_attr( $siteDesc_font_family ); ?>;
								<?php if( $disable_st_desc_google_fonts ):
									?>
										font-weight:<?php echo esc_attr( $siteDesc_font_weight ); ?>;
									<?php
								endif; ?>
							}
						<?php
						 endif;
						?>

						<?php
						if( 'inherit' != $nav_font_family ): ?>
							header nav *,
							.toggle-menu{
								font-family:<?php echo esc_attr( $nav_font_family ); ?>;
								<?php if( $disable_n_google_fonts ):
									?>
										font-weight:<?php echo esc_attr( $nav_font_weight ); ?>;
									<?php
								endif; ?>

							}
						<?php endif; ?>
		    <?php
		    // Release output buffering
		    return ob_get_clean();
		}

		public static function enqueue_google_fonts( $id, $font_family, $font_weight ){
			wp_enqueue_style( $id, '//fonts.googleapis.com/css?family=' . esc_attr( $font_family ) . ':' . $font_weight );
		}

		/* Front-end custom styles */
		public static function set_fonts() {
				echo '<style id="wpcake-custom-font" type="text/css">' . esc_html(self::wpcake_font_css_output()) . '</style>';
		}

  }

endif;

return new WPCake_Customize();
