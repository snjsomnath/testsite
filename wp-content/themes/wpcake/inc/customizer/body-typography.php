<?php

// Site Body Typography

// Turn off undeline on hover
$wp_customize->add_setting( 'wpcake_a_toggle_underline', array(
  'default'           	=> false,
  'sanitize_callback' 	=> 'wpcake_sanitize_checkbox',
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wpcake_a_toggle_underline', array(
  'label'	   				=> esc_html__( 'Bold links on hover/active state.', 'wpcake' ),
  'type' 					=> 'checkbox',
  'section'  				=> 'wpcake_body_typography',
  'priority' 				=> $priority++,
) ) );

// Font Family
$wp_customize->add_setting( 'wpcake_disable_google_fonts', array(
  'default'           	=> false,
  'sanitize_callback' 	=> 'wpcake_sanitize_checkbox',
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wpcake_disable_google_fonts', array(
  'label'	   				=> esc_html__( 'Use system fonts', 'wpcake' ),
  'type' 					=> 'checkbox',
  'section'  				=> 'wpcake_body_typography',
  'priority' 				=> $priority++,
) ) );

// System Fonts
$wp_customize->add_setting( 'wpcake_system_fonts', array(
    'default'   => 'Georgia, serif',
    'sanitize_callback' => 'wpcake_sanitize_text',
  ));
$wp_customize->add_control( 'wpcake_system_fonts', array(
  'label'             => esc_html__( 'System Fonts', 'wpcake' ),
  'section'           => 'wpcake_body_typography',
  'type'              => 'select',
  'choices'           => $wpcakeSysListFonts,
  'priority'	 				=> $priority++,
  'active_callback' => 'wpcake_check_if_system',
));
// System Fonts Weights
$wp_customize->add_setting( 'wpcake_system_fonts_weights', array(
    'default'   => '400',
    'sanitize_callback' => 'wpcake_sanitize_text',
  ));
$wp_customize->add_control( 'wpcake_system_fonts_weights', array(
  'label'             => esc_html__( 'Font Weight', 'wpcake' ),
  'section'           => 'wpcake_body_typography',
  'type'              => 'select',
  'choices'           => array(
    '100'		=> __('Lighter', 'wpcake'),
    '300'		=> __('Light', 'wpcake'),
    '400'		=> __('Regular', 'wpcake'),
    '700'		=> __('Bold', 'wpcake'),
    '800'		=> __('Bolder', 'wpcake'),
  ),
  'priority'	 				=> $priority++,
  'active_callback' => 'wpcake_check_if_system',
));
function wpcake_check_if_system( $control ) {
   if ( $control->manager->get_setting('wpcake_disable_google_fonts')->value() != '' ) {
      return true;
   } else {
      return false;
   }
}

$wp_customize->add_setting( 'wpcake_google_fonts',
  array(
    'default' => json_encode(
      array(
        'font' => 'PT Serif',
        'regularweight' => 'regular',
        'italicweight' => 'italic',
        'boldweight' => '400',
        'category' => 'serif'
      )
    ),
    'sanitize_callback' => 'wpcake_google_font_sanitization',
  )
);
$wp_customize->add_control( new WPCake_Google_Font_Select_Custom_Control( $wp_customize, 'wpcake_google_fonts',
  array(
    'label' => __( 'Main Font', 'wpcake' ),
    'description' => esc_html__( 'All Google Fonts sorted by popularity', 'wpcake' ),
    'priority'	 	=> $priority++,
    'section' => 'wpcake_body_typography',
    'input_attrs' => array(
      'font_count' => 'all',
      'orderby' => 'popular',
    ),
    'active_callback' 	=> 'wpcake_check_if_google',
  )
) );
function wpcake_check_if_google( $control ) {
   if ( $control->manager->get_setting('wpcake_disable_google_fonts')->value() != '' ) {
      return false;
   } else {
      return true;
   }
}

// Set Base font size
$wp_customize->add_setting( 'wpcake_base_font_size', array(
    'default'   => 18,
    'transport'	=> 'postMessage',
    'sanitize_callback' => 'absint',
  ));
$wp_customize->add_control( new WPCake_Slider_Custom_Control( $wp_customize, 'wpcake_base_font_size',
  array(
    'label' => __( 'Base Font Size', 'wpcake' ),
    'section' => 'wpcake_body_typography',
    'priority'    => $priority++,
    'description' => __('Measurement is in pixel.', 'wpcake'),
    'input_attrs' => array(
      'min' => 8,
      'max' => 32,
      'step' => 1,
    ),
  )));

// Set article line height
$wp_customize->add_setting( 'wpcake_base_line_height', array(
    'default'   => 1.55,
    'transport'	=> 'postMessage',
    'sanitize_callback' => 'wpcake_sanitize_number',
  ));
$wp_customize->add_control( new WPCake_Slider_Custom_Control( $wp_customize, 'wpcake_base_line_height',
  array(
    'label' => __( 'Article Line Height', 'wpcake' ),
    'section' => 'wpcake_body_typography',
    'priority'    => $priority++,
    'description' => __('Default 1.55', 'wpcake'),
    'input_attrs' => array(
      'min' => 1,
      'max' => 3,
      'step' => 0.05,
    ),
  )));
