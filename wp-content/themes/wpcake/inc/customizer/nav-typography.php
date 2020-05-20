<?php

// Site Navigation Typography

// Turn off undeline on hover
$wp_customize->add_setting( 'wpcake_n_disable_underline', array(
  'default'           	=> false,
  'sanitize_callback' 	=> 'wpcake_sanitize_checkbox',
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wpcake_n_disable_underline', array(
  'label'	   				=> esc_html__( 'Color change only on hover/active state', 'wpcake' ),
  'type' 					=> 'checkbox',
  'section'  				=> 'wpcake_nav_typography',
  'priority' 				=> $priority++,
) ) );

// Font Family
$wp_customize->add_setting( 'wpcake_n_disable_google_fonts', array(
  'default'           	=> false,
  'sanitize_callback' 	=> 'wpcake_sanitize_checkbox',
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wpcake_n_disable_google_fonts', array(
  'label'	   				=> esc_html__( 'Use system fonts', 'wpcake' ),
  'type' 					=> 'checkbox',
  'section'  				=> 'wpcake_nav_typography',
  'priority' 				=> $priority++,
) ) );

// System Fonts
$wpcakeSysListFonts = array('inherit' => 'inherit') + $wpcakeSysListFonts;
$wp_customize->add_setting( 'wpcake_n_system_fonts', array(
    'default'   => 'inherit',
    'sanitize_callback' => 'wpcake_sanitize_text',
  ));
$wp_customize->add_control( 'wpcake_n_system_fonts', array(
  'label'             => esc_html__( 'System Fonts', 'wpcake' ),
  'section'           => 'wpcake_nav_typography',
  'type'              => 'select',
  'choices'           => $wpcakeSysListFonts,
  'priority'	 				=> $priority++,
  'active_callback' => 'wpcake_check_n_if_system',
));
// System Fonts Weights
$wp_customize->add_setting( 'wpcake_n_system_fonts_weights', array(
    'default'   => '400',
    'sanitize_callback' => 'wpcake_sanitize_text',
  ));
$wp_customize->add_control( 'wpcake_n_system_fonts_weights', array(
  'label'             => esc_html__( 'Font Weight', 'wpcake' ),
  'section'           => 'wpcake_nav_typography',
  'type'              => 'select',
  'choices'           => array(
    '100'		=> __('Lighter', 'wpcake'),
    '300'		=> __('Light', 'wpcake'),
    '400'		=> __('Regular', 'wpcake'),
    '700'		=> __('Bold', 'wpcake'),
    '800'		=> __('Bolder', 'wpcake'),
  ),
  'priority'	 				=> $priority++,
  'active_callback' => 'wpcake_check_n_if_system',
));
function wpcake_check_n_if_system( $control ) {
   if ( $control->manager->get_setting('wpcake_n_disable_google_fonts')->value() != '' ) {
      return true;
   } else {
      return false;
   }
}

$wp_customize->add_setting( 'wpcake_n_google_fonts',
  array(
    'default' => json_encode(
      array(
        'font' => 'inherit',
        'regularweight' => 'regular',
        'italicweight' => 'italic',
        'boldweight' => '400',
        'category' => 'serif'
      )
    ),
    'sanitize_callback' => 'wpcake_google_font_sanitization',
  )
);
$wp_customize->add_control( new WPCake_Google_Font_Select_Custom_Control( $wp_customize, 'wpcake_n_google_fonts',
  array(
    'label' => __( 'Main Menu Font', 'wpcake' ),
    'description' => esc_html__( 'All Google Fonts sorted by popularity', 'wpcake' ),
    'priority'	 	=> $priority++,
    'section' => 'wpcake_nav_typography',
    'input_attrs' => array(
      'font_count' => 'all',
      'orderby' => 'popular',
    ),
    'active_callback' 	=> 'wpcake_check_n_if_google',
  )
) );
function wpcake_check_n_if_google( $control ) {
   if ( $control->manager->get_setting('wpcake_n_disable_google_fonts')->value() != '' ) {
      return false;
   } else {
      return true;
   }
}

// Set Nav font size
$wp_customize->add_setting( 'wpcake_menu_font_size', array(
    'default'   => 18,
    'transport'	=> 'postMessage',
    'sanitize_callback' => 'absint',
  ));
$wp_customize->add_control( new WPCake_Slider_Custom_Control( $wp_customize, 'wpcake_menu_font_size',
  array(
    'label' => __( 'Font Size', 'wpcake' ),
    'section' => 'wpcake_nav_typography',
    'priority'    => $priority++,
    'description' => __('Measurement is in pixel.', 'wpcake'),
    'input_attrs' => array(
      'min' => 10,
      'max' => 70,
      'step' => 1,
    ),
  )));

// Set Nav Top Margin
$wp_customize->add_setting( 'wpcake_menu_top_margin', array(
    'default'   => 28,
    'transport'	=> 'postMessage',
    'sanitize_callback' => 'absint',
  ));
$wp_customize->add_control( new WPCake_Slider_Custom_Control( $wp_customize, 'wpcake_menu_top_margin',
  array(
    'label' => __( 'Top Margin', 'wpcake' ),
    'section' => 'wpcake_nav_typography',
    'priority'    => $priority++,
    'description' => __('Measurement is in pixel.', 'wpcake'),
    'input_attrs' => array(
      'min' => 0,
      'max' => 250,
      'step' => 1,
    ),
  )));
