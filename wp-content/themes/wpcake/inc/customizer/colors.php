<?php

// Colors Panel
$wp_customize->add_panel( 'wpcake_colors', array(
  'title'          => esc_html__('Colors &amp; Background', 'wpcake'),
  'priority'       => $priority++,
) );

// Global section <- Colors Panel
$wp_customize->add_section( 'wpcake_global_colors', array(
  'title'          => esc_html__('Global', 'wpcake'),
  'panel'					 => 'wpcake_colors',
  'priority'       => $priority++,
) );

// Global background color
$wp_customize->add_setting('wpcake_bg_color', array(
  'default'     => '#FFFFFF',
  'transport'		=> 'postMessage',
  'sanitize_callback' => 'wpcake_sanitize_hex',
));
$wp_customize->add_control( new WPCake_Customize_Alpha_Color_Control( $wp_customize, 'wpcake_bg_color',
  array(
    'label' => __( 'Background Color', 'wpcake' ),
    'section' => 'wpcake_global_colors',
    'show_opacity' => true,
    'priority'     => $priority++,
    'palette' => array(
      '#000',
      '#fff',
      '#df312c',
      '#df9a23',
      '#eef000',
      '#7ed934',
      '#1571c1',
      '#8309e7'
))) );

// Links
$wp_customize->add_setting('wpcake_global_link_color', array(
  'default'     => '#09769e',
  'transport'		=> 'postMessage',
  'sanitize_callback' => 'wpcake_sanitize_hex',
));
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'wpcake_global_link_color', array(
      'label'      => __( 'Link color', 'wpcake' ),
      'section'    => 'wpcake_global_colors',
      'priority'       => $priority++,
)));

// Hover Active links
$wp_customize->add_setting('wpcake_global_live_link_color', array(
  'default'     => '#000000',
  'sanitize_callback' => 'wpcake_sanitize_hex',
));
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'wpcake_global_live_link_color', array(
      'label'      => __( 'Link Active / Hover color', 'wpcake' ),
      'section'    => 'wpcake_global_colors',
      'priority'       => $priority++,
)));


// Header section <- Colors Panel
$wp_customize->add_section( 'wpcake_header_colors', array(
  'title'          => esc_html__('Header', 'wpcake'),
  'panel'					 => 'wpcake_colors',
  'priority'       => $priority++,
) );

// Header background color
$wp_customize->add_setting( 'wpcake_header_bg_color',
  array(
    'default' => '#FFFFFF',
    'transport'	=> 'postMessage',
    'sanitize_callback' => 'wpcake_hex_rgba_sanitization'
  )
);
$wp_customize->add_control( new WPCake_Customize_Alpha_Color_Control( $wp_customize, 'wpcake_header_bg_color',
  array(
    'label' => __( 'Background Color', 'wpcake' ),
    'section' => 'wpcake_header_colors',
    'show_opacity' => true,
    'priority'	=> $priority++,
    'palette' => array(
      '#000',
      '#fff',
      '#df312c',
      '#df9a23',
      '#eef000',
      '#7ed934',
      '#1571c1',
      '#8309e7'
))) );


/* SEPARATOR */
$wp_customize->add_setting( 'wpcake_site_title_separator', array(
    'type'          => 'theme_mod',
    'capability'    => 'edit_theme_options',
    'sanitize_callback'    => 'wpcake_sanitize_text',
));
$wp_customize->add_control( new WPCake_Customize_Separator_Control( $wp_customize, 'wpcake_site_title_separator', array(
    'label'     => __( 'Site Title', 'wpcake' ),
    'section'   => 'wpcake_header_colors',
    'priority'	=> $priority++,
)));

// Site Title link/text color
$wp_customize->add_setting('wpcake_site_title_link_color', array(
  'default'     => '#09769e',
  'transport'		=> 'postMessage',
  'sanitize_callback' => 'wpcake_sanitize_hex',
));
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'wpcake_site_title_link_color', array(
      'label'      => __( 'Link color', 'wpcake' ),
      'section'    => 'wpcake_header_colors',
      'priority'       => $priority++,
)));

// Site Title link Active/Hover color
$wp_customize->add_setting('wpcake_site_title_link_active_color', array(
  'default'     => '#000000',
  'sanitize_callback' => 'wpcake_sanitize_hex',
));
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'wpcake_site_title_link_active_color', array(
      'label'      => __( 'Link Active / Hover Color', 'wpcake' ),
      'section'    => 'wpcake_header_colors',
      'priority'       => $priority++,
)));


/* SEPARATOR */
$wp_customize->add_setting( 'wpcake_menu_separator', array(
    'type'          => 'theme_mod',
    'capability'    => 'edit_theme_options',
    'sanitize_callback'    => 'wpcake_sanitize_text',
));
$wp_customize->add_control( new WPCake_Customize_Separator_Control( $wp_customize, 'wpcake_menu_separator', array(
    'label'     => __( 'Top Level Menu', 'wpcake' ),
    'section'   => 'wpcake_header_colors',
    'priority'	=> $priority++,
)));

// Header link/text color
$wp_customize->add_setting('wpcake_header_link_color', array(
  'default'     => '#09769e',
  'transport'		=> 'postMessage',
  'sanitize_callback' => 'wpcake_sanitize_hex',
));
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'wpcake_header_link_color', array(
      'label'      => __( 'Link / Text color', 'wpcake' ),
      'section'    => 'wpcake_header_colors',
      'priority'       => $priority++,
)));

// Header link Active/Hover color
$wp_customize->add_setting('wpcake_header_link_active_color', array(
  'default'     => '#000000',
  'sanitize_callback' => 'wpcake_sanitize_hex',
));
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'wpcake_header_link_active_color', array(
      'label'      => __( 'Link Active / Hover Color', 'wpcake' ),
      'section'    => 'wpcake_header_colors',
      'priority'       => $priority++,
)));

/* SEPARATOR */
$wp_customize->add_setting( 'wpcake_submenu_separator', array(
    'type'          => 'theme_mod',
    'capability'    => 'edit_theme_options',
    'sanitize_callback'    => 'wpcake_sanitize_text',
));
$wp_customize->add_control( new WPCake_Customize_Separator_Control( $wp_customize, 'wpcake_submenu_separator', array(
    'label'     => __( 'Submenu', 'wpcake' ),
    'section'   => 'wpcake_header_colors',
    'priority'	=> $priority++,
)));

// Header sub menu background color
$wp_customize->add_setting('wpcake_header_sub_nav_bg_color', array(
  'default'     => '#000000',
  'sanitize_callback' => 'wpcake_sanitize_hex',
));
$wp_customize->add_control( new WPCake_Customize_Alpha_Color_Control( $wp_customize, 'wpcake_header_sub_nav_bg_color',
  array(
    'label' => __( 'Submenu Background Color', 'wpcake' ),
    'description' => __('Not used on mobile screens', 'wpcake'),
    'section' => 'wpcake_header_colors',
    'show_opacity' => true,
    'priority'     => $priority++,
    'palette' => array(
      '#000',
      '#fff',
      '#df312c',
      '#df9a23',
      '#eef000',
      '#7ed934',
      '#1571c1',
      '#8309e7'
))) );

// Header sub menu link color
$wp_customize->add_setting('wpcake_header_sub_nav_link_color', array(
  'default'     => '#FFFFFF',
  'sanitize_callback' => 'wpcake_sanitize_hex',
));
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'wpcake_header_sub_nav_link_color', array(
      'label'      => __( 'Submenu Link / Text Color', 'wpcake' ),
      'description' => __('Not used on mobile screens', 'wpcake'),
      'section'    => 'wpcake_header_colors',
      'priority'       => $priority++,
)));

// Header sub menu link hover color
$wp_customize->add_setting('wpcake_header_sub_nav_link_active_color', array(
  'default'     => '#09769e',
  'sanitize_callback' => 'wpcake_sanitize_hex',
));
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'wpcake_header_sub_nav_link_active_color', array(
      'label'      => __( 'Submenu Link  Active / Hover Color', 'wpcake' ),
      'description' => __('Not used on mobile screens', 'wpcake'),
      'section'    => 'wpcake_header_colors',
      'priority'       => $priority++,
)));

// WooCommerce section <- Colors Panel
if( wpcake_check_for_woocommerce() ){

  $wp_customize->add_section( 'wpcake_wc_colors', array(
    'title'          => esc_html__('WooCommerce', 'wpcake'),
    'panel'					 => 'wpcake_colors',
    'priority'       => $priority++,
  ) );

  // Icon color
  $wp_customize->add_setting('wpcake_wc_icon_color', array(
    'default'     => '#09769e',
    'sanitize_callback' => 'wpcake_sanitize_hex',
  ));
  $wp_customize->add_control( new WPCake_Customize_Alpha_Color_Control( $wp_customize, 'wpcake_wc_icon_color',
    array(
      'label' => __( 'Cart Icon color', 'wpcake' ),
      'section' => 'wpcake_wc_colors',
      'show_opacity' => false,
      'priority'     => $priority++,
      'palette' => array(
        '#000',
        '#fff',
        '#df312c',
        '#df9a23',
        '#eef000',
        '#7ed934',
        '#1571c1',
        '#8309e7'
  ))) );

  // button color
  $wp_customize->add_setting('wpcake_wc_button_color', array(
    'default'     => '#09769e',
    'transport' => 'postMessage',
    'sanitize_callback' => 'wpcake_sanitize_hex',
  ));
  $wp_customize->add_control( new WPCake_Customize_Alpha_Color_Control( $wp_customize, 'wpcake_wc_button_color',
    array(
      'label' => __( 'Shop button color', 'wpcake' ),
      'section' => 'wpcake_wc_colors',
      'show_opacity' => false,
      'priority'     => $priority++,
      'palette' => array(
        '#000',
        '#fff',
        '#df312c',
        '#df9a23',
        '#eef000',
        '#7ed934',
        '#1571c1',
        '#8309e7'
  ))) );

  // button txt color
  $wp_customize->add_setting('wpcake_wc_button_txt_color', array(
    'default'     => '#FFFFFF',
    'transport' => 'postMessage',
    'sanitize_callback' => 'wpcake_sanitize_hex',
  ));
  $wp_customize->add_control( new WPCake_Customize_Alpha_Color_Control( $wp_customize, 'wpcake_wc_button_txt_color',
    array(
      'label' => __( 'Shop button text color', 'wpcake' ),
      'section' => 'wpcake_wc_colors',
      'show_opacity' => false,
      'priority'     => $priority++,
      'palette' => array(
        '#000',
        '#fff',
        '#df312c',
        '#df9a23',
        '#eef000',
        '#7ed934',
        '#1571c1',
        '#8309e7'
  ))) );

  // Sale color
  $wp_customize->add_setting('wpcake_wc_sale_color', array(
    'default'     => '#77a464',
    'transport' => 'postMessage',
    'sanitize_callback' => 'wpcake_sanitize_hex',
  ));
  $wp_customize->add_control( new WPCake_Customize_Alpha_Color_Control( $wp_customize, 'wpcake_wc_sale_color',
    array(
      'label' => __( 'Shop sale color', 'wpcake' ),
      'section' => 'wpcake_wc_colors',
      'show_opacity' => false,
      'priority'     => $priority++,
      'palette' => array(
        '#000',
        '#fff',
        '#df312c',
        '#df9a23',
        '#eef000',
        '#7ed934',
        '#1571c1',
        '#77a464'
  ))) );

}/* END WOOCOMMERCE CHECK */


// Footer widegt section <- Colors Panel
$wp_customize->add_section( 'wpcake_footer_widgets_colors', array(
  'title'          => esc_html__('Footer Widgets', 'wpcake'),
  'panel'					 => 'wpcake_colors',
  'priority'       => $priority++,
) );

// Footer widgets title color
$wp_customize->add_setting('wpcake_footer_widgets_title_color', array(
  'default'     => '#FFFFFF',
  'transport'		=> 'postMessage',
  'sanitize_callback' => 'wpcake_sanitize_hex',
));
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'wpcake_footer_widgets_title_color', array(
      'label'      => __( 'Widget Title Color', 'wpcake' ),
      'section'    => 'wpcake_footer_widgets_colors',
      'priority'       => $priority++,
)));

// Footer widgets text color
$wp_customize->add_setting('wpcake_footer_widgets_txt_color', array(
  'default'     => '#FFFFFF',
  'transport'		=> 'postMessage',
  'sanitize_callback' => 'wpcake_sanitize_hex',
));
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'wpcake_footer_widgets_txt_color', array(
      'label'      => __( 'Text color', 'wpcake' ),
      'section'    => 'wpcake_footer_widgets_colors',
      'priority'       => $priority++,
)));

// Footer widgets link color
$wp_customize->add_setting('wpcake_footer_widgets_link_color', array(
  'default'     => '#aaaaaa',
  'transport'		=> 'postMessage',
  'sanitize_callback' => 'wpcake_sanitize_hex',
));
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'wpcake_footer_widgets_link_color', array(
      'label'      => __( 'Link color', 'wpcake' ),
      'section'    => 'wpcake_footer_widgets_colors',
      'priority'       => $priority++,
)));

// Footer widgets link hover color
$wp_customize->add_setting('wpcake_footer_widgets_link_hover_color', array(
  'default'     => '#FFFFFF',
  'sanitize_callback' => 'wpcake_sanitize_hex',
));
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'wpcake_footer_widgets_link_hover_color', array(
      'label'      => __( 'Link Hover color', 'wpcake' ),
      'section'    => 'wpcake_footer_widgets_colors',
      'priority'       => $priority++,
)));

/* SEPARATOR */
$wp_customize->add_setting( 'wpcake_footer_txt_separator', array(
    'type'          => 'theme_mod',
    'capability'    => 'edit_theme_options',
    'sanitize_callback'    => 'wpcake_sanitize_text',
));
$wp_customize->add_control( new WPCake_Customize_Separator_Control( $wp_customize, 'wpcake_footer_txt_separator', array(
    'label'     => __( 'Background', 'wpcake' ),
    'section'   => 'wpcake_footer_widgets_colors',
    'priority'	=> $priority++,
)));

// Footer widgets border color
$wp_customize->add_setting('wpcake_footer_widgets_border_color', array(
  'default'     => '#6f6f6f',
  'transport'		=> 'postMessage',
  'sanitize_callback' => 'wpcake_sanitize_hex',
));
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'wpcake_footer_widgets_border_color', array(
      'label'      => __( 'Top border color', 'wpcake' ),
      'section'    => 'wpcake_footer_widgets_colors',
      'priority'       => $priority++,
)));

// Footer widgets background color
$wp_customize->add_setting('wpcake_footer_widgets_bg_color', array(
  'default'     => '#3a3a3a',
  'transport'		=> 'postMessage',
  'sanitize_callback' => 'wpcake_sanitize_hex',
));
$wp_customize->add_control( new WPCake_Customize_Alpha_Color_Control( $wp_customize, 'wpcake_footer_widgets_bg_color',
  array(
    'label' => __( 'Background Color', 'wpcake' ),
    'section' => 'wpcake_footer_widgets_colors',
    'show_opacity' => true,
    'priority'	=> $priority++,
    'palette' => array(
      '#000',
      '#fff',
      '#3a3a3a',
      '#df9a23',
      '#eef000',
      '#7ed934',
      '#1571c1',
      '#8309e7'
))) );

// Footer widgets background image
$wp_customize->add_setting('wpcake_footer_widgets_bg_image', array(
  'sanitize_callback' => 'wpcake_sanitize_url',
));
$wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 'wpcake_footer_widgets_bg_image',
	array(
		'label'      => __( 'Background Image', 'wpcake' ),
		'section'    => 'wpcake_footer_widgets_colors',
    'priority'	=> $priority++,
	) )
);




// Footer section <- Colors Panel
$wp_customize->add_section( 'wpcake_footer_colors', array(
  'title'          => esc_html__('Footer', 'wpcake'),
  'panel'					 => 'wpcake_colors',
  'priority'       => $priority++,
) );

/* SEPARATOR */
$wp_customize->add_setting( 'wpcake_footer_bg_separator', array(
    'type'          => 'theme_mod',
    'capability'    => 'edit_theme_options',
    'sanitize_callback'    => 'wpcake_sanitize_text',
));
$wp_customize->add_control( new WPCake_Customize_Separator_Control( $wp_customize, 'wpcake_footer_bg_separator', array(
    'label'     => __( 'Background', 'wpcake' ),
    'section'   => 'wpcake_footer_colors',
    'priority'	=> $priority++,
)));

// Footer border color
$wp_customize->add_setting('wpcake_footer_border_color', array(
  'default'     => '#6f6f6f',
  'transport'		=> 'postMessage',
  'sanitize_callback' => 'wpcake_sanitize_hex',
));
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'wpcake_footer_border_color', array(
      'label'      => __( 'Top border color', 'wpcake' ),
      'section'    => 'wpcake_footer_colors',
      'priority'       => $priority++,
)));

// Footer background color
$wp_customize->add_setting('wpcake_footer_bg_color', array(
  'default'     => '#2d2d2d',
  'transport'		=> 'postMessage',
  'sanitize_callback' => 'wpcake_sanitize_hex',
));
$wp_customize->add_control( new WPCake_Customize_Alpha_Color_Control( $wp_customize, 'wpcake_footer_bg_color',
  array(
    'label' => __( 'Background Color', 'wpcake' ),
    'section' => 'wpcake_footer_colors',
    'show_opacity' => true,
    'priority'	=> $priority++,
    'palette' => array(
      '#000',
      '#fff',
      '#df312c',
      '#df9a23',
      '#eef000',
      '#7ed934',
      '#1571c1',
      '#8309e7'
))) );

// Footer background image
$wp_customize->add_setting('wpcake_footer_bg_image', array(
  'sanitize_callback' => 'wpcake_sanitize_url',
));
$wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 'wpcake_footer_bg_image',
	array(
		'label'      => __( 'Background Image', 'wpcake' ),
		'section'    => 'wpcake_footer_colors',
    'priority'	=> $priority++,
	) )
);

/* SEPARATOR */
$wp_customize->add_setting( 'wpcake_footer_text_separator', array(
    'type'          => 'theme_mod',
    'capability'    => 'edit_theme_options',
    'sanitize_callback'    => 'wpcake_sanitize_text',
));
$wp_customize->add_control( new WPCake_Customize_Separator_Control( $wp_customize, 'wpcake_footer_text_separator', array(
    'label'     => __( 'Font colors', 'wpcake' ),
    'section'   => 'wpcake_footer_colors',
    'priority'	=> $priority++,
)));

// Footer text color
$wp_customize->add_setting('wpcake_footer_txt_color', array(
  'default'     => '#FFFFFF',
  'transport'		=> 'postMessage',
  'sanitize_callback' => 'wpcake_sanitize_hex',
));
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'wpcake_footer_txt_color', array(
      'label'      => __( 'Text color', 'wpcake' ),
      'section'    => 'wpcake_footer_colors',
      'priority'       => $priority++,
)));

// Footer link color
$wp_customize->add_setting('wpcake_footer_link_color', array(
  'default'     => '#09769e',
  'transport'		=> 'postMessage',
  'sanitize_callback' => 'wpcake_sanitize_hex',
));
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'wpcake_footer_link_color', array(
      'label'      => __( 'Link color', 'wpcake' ),
      'section'    => 'wpcake_footer_colors',
      'priority'       => $priority++,
)));

// Footer link Active/Hover color
$wp_customize->add_setting('wpcake_footer_link_active_color', array(
  'default'     => '#dddddd',
  'sanitize_callback' => 'wpcake_sanitize_hex',
));
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'wpcake_footer_link_active_color', array(
      'label'      => __( 'Link Hover Color', 'wpcake' ),
      'section'    => 'wpcake_footer_colors',
      'priority'       => $priority++,
)));
