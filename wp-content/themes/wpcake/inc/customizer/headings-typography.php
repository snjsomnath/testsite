<?php

// Site Headings Typography

// Font Family
$wp_customize->add_setting( 'wpcake_h_disable_google_fonts', array(
  'default'           	=> false,
  'sanitize_callback' 	=> 'wpcake_sanitize_checkbox',
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wpcake_h_disable_google_fonts', array(
  'label'	   				=> esc_html__( 'Use system fonts', 'wpcake' ),
  'type' 					=> 'checkbox',
  'section'  				=> 'wpcake_headings_typography',
  'priority' 				=> $priority++,
) ) );

// System Fonts
$wpcakeSysListFonts = array('inherit' => 'inherit') + $wpcakeSysListFonts;

$wp_customize->add_setting( 'wpcake_h_system_fonts', array(
    'default'   => 'inherit',
    'sanitize_callback' => 'wpcake_sanitize_text',
  ));
$wp_customize->add_control( 'wpcake_h_system_fonts', array(
  'label'             => esc_html__( 'System Fonts', 'wpcake' ),
  'section'           => 'wpcake_headings_typography',
  'type'              => 'select',
  'choices'           => $wpcakeSysListFonts,
  'priority'	 				=> $priority++,
  'active_callback' => 'wpcake_check_h_if_system',
));
// System Fonts Weights
$wp_customize->add_setting( 'wpcake_h_system_fonts_weights', array(
    'default'   => '400',
    'sanitize_callback' => 'wpcake_sanitize_text',
  ));
$wp_customize->add_control( 'wpcake_h_system_fonts_weights', array(
  'label'             => esc_html__( 'Font Weight', 'wpcake' ),
  'section'           => 'wpcake_headings_typography',
  'type'              => 'select',
  'choices'           => array(
    '100'		=> __('Lighter', 'wpcake'),
    '300'		=> __('Light', 'wpcake'),
    '400'		=> __('Regular', 'wpcake'),
    '700'		=> __('Bold', 'wpcake'),
    '800'		=> __('Bolder', 'wpcake'),
  ),
  'priority'	 				=> $priority++,
  'active_callback' => 'wpcake_check_h_if_system',
));
function wpcake_check_h_if_system( $control ) {
   if ( $control->manager->get_setting('wpcake_h_disable_google_fonts')->value() != '' ) {
      return true;
   } else {
      return false;
   }
}

$wp_customize->add_setting( 'wpcake_h_google_fonts',
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
$wp_customize->add_control( new WPCake_Google_Font_Select_Custom_Control( $wp_customize, 'wpcake_h_google_fonts',
  array(
    'label' => __( 'Headings Font', 'wpcake' ),
    'description' => esc_html__( 'All Google Fonts sorted by popularity', 'wpcake' ),
    'priority'	 	=> $priority++,
    'section' => 'wpcake_headings_typography',
    'input_attrs' => array(
      'font_count' => 'all',
      'orderby' => 'popular',
    ),
    'active_callback' 	=> 'wpcake_check_h_if_google',
  )
) );
function wpcake_check_h_if_google( $control ) {
   if ( $control->manager->get_setting('wpcake_h_disable_google_fonts')->value() != '' ) {
      return false;
   } else {
      return true;
   }
}

// Set Headings bottom Margin
$wp_customize->add_setting( 'wpcake_headings_bottom_margin', array(
    'default'   => 30,
    'transport'	=> 'postMessage',
    'sanitize_callback' => 'absint',
  ));
$wp_customize->add_control( new WPCake_Slider_Custom_Control( $wp_customize, 'wpcake_headings_bottom_margin',
  array(
    'label' => __( 'Bottom Margin', 'wpcake' ),
    'section' => 'wpcake_headings_typography',
    'priority'    => $priority++,
    'description' => __('Measurement is in pixel.', 'wpcake'),
    'input_attrs' => array(
      'min' => -30,
      'max' => 100,
      'step' => 1,
    ),
  )));
