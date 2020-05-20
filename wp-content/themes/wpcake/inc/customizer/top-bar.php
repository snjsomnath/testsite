<?php

// Top Bar options

// General Section <- Topbar Panel
$wp_customize->add_section( 'wpcake_topbar_general', array(
  'title'          => esc_html__('Topbar', 'wpcake'),
  'panel'					=> 'wpcake_layout',
  'priority'       => 52,
) );

// Disable header
$wp_customize->add_setting( 'wpcake_enable_topbar', array(
  'default'           	=> false,
  'sanitize_callback' 	=> 'wpcake_switch_sanitization',
) );
$wp_customize->add_control( new WPCake_Toggle_Switch_Custom_control( $wp_customize, 'wpcake_enable_topbar', array(
  'label'	   				=> esc_html__( 'Enable Top Bar', 'wpcake' ),
  'section'  				=> 'wpcake_topbar_general',
  'priority' 				=> $priority++,
) ) );

// Full width
$wp_customize->add_setting( 'wpcake_fullwidth_topbar', array(
  'default'           	=> false,
  'sanitize_callback' 	=> 'wpcake_switch_sanitization',
) );
$wp_customize->add_control( new WPCake_Toggle_Switch_Custom_control( $wp_customize, 'wpcake_fullwidth_topbar', array(
  'label'	   				=> esc_html__( 'Enable Full Width', 'wpcake' ),
  'section'  				=> 'wpcake_topbar_general',
  'priority' 				=> $priority++,
) ) );

// Show on different devices
$wp_customize->add_setting( 'wpcake_topbar_devices', array(
    'default'           => 'all',
    'sanitize_callback' => 'wpcake_sanitize_text',
));
$wp_customize->add_control( 'wpcake_topbar_devices', array(
  'label'             => esc_html__( 'Show on Devices', 'wpcake' ),
  'section'           => 'wpcake_topbar_general',
  'type'              => 'select',
  'choices'           => array(
      'all'             => esc_html__('Show on all devices', 'wpcake'),
      'desktop'         => esc_html__('Show on desktop only', 'wpcake'),
      'large'           => esc_html__('Show on tablets and desktop', 'wpcake'),
  ),
  'priority'	 				=> $priority++,
));

// Set the primary header layout
$wp_customize->add_setting( 'wpcake_topbar_layout', array(
    'default'           => 'default',
    'sanitize_callback' => 'wpcake_sanitize_text',
));
$wp_customize->add_control( 'wpcake_topbar_layout', array(
  'label'             => esc_html__( 'Style', 'wpcake' ),
  'section'           => 'wpcake_topbar_general',
  'type'              => 'select',
  'choices'           => array(
      'default'         => esc_html__('Topbar menu left wp&amp; social menu Right', 'wpcake'),
      'alternate'       => esc_html__('Social menu left &amp; Topbar menu right', 'wpcake'),
      'center'          => esc_html__('All Center content', 'wpcake'),
  ),
  'priority'	 				=> $priority++,
));
