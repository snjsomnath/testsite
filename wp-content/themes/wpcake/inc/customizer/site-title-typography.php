<?php

// Site Title & Description Typography

/* SEPARATOR */
$wp_customize->add_setting( 'wpcake_st_title_separator', array(
    'type'          => 'theme_mod',
    'capability'    => 'edit_theme_options',
    'sanitize_callback'    => 'wpcake_sanitize_text',
));
$wp_customize->add_control( new WPCake_Customize_Separator_Control( $wp_customize, 'wpcake_st_title_separator', array(
    'label'     => __( 'Site Title', 'wpcake' ),
    'section'   => 'wpcake_site_title_typography',
    'priority'	=> $priority++,
)));

// Font Family
$wp_customize->add_setting( 'wpcake_st_disable_google_fonts', array(
  'default'           	=> false,
  'sanitize_callback' 	=> 'wpcake_sanitize_checkbox',
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wpcake_st_disable_google_fonts', array(
  'label'	   				=> esc_html__( 'Use system fonts', 'wpcake' ),
  'type' 					=> 'checkbox',
  'section'  				=> 'wpcake_site_title_typography',
  'priority' 				=> $priority++,
) ) );

// System Fonts
$wpcakeSysListFonts = array('inherit' => 'inherit') + $wpcakeSysListFonts;
$wp_customize->add_setting( 'wpcake_st_system_fonts', array(
    'default'   => 'inherit',
    'sanitize_callback' => 'wpcake_sanitize_text',
  ));
$wp_customize->add_control( 'wpcake_st_system_fonts', array(
  'label'             => esc_html__( 'System Fonts', 'wpcake' ),
  'section'           => 'wpcake_site_title_typography',
  'type'              => 'select',
  'choices'           => $wpcakeSysListFonts,
  'priority'	 				=> $priority++,
  'active_callback' => 'wpcake_check_st_if_system',
));
// System Fonts Weights
$wp_customize->add_setting( 'wpcake_st_system_fonts_weights', array(
    'default'   => '400',
    'sanitize_callback' => 'wpcake_sanitize_text',
  ));
$wp_customize->add_control( 'wpcake_st_system_fonts_weights', array(
  'label'             => esc_html__( 'Font Weight', 'wpcake' ),
  'section'           => 'wpcake_site_title_typography',
  'type'              => 'select',
  'choices'           => array(
    '100'		=> __('Lighter', 'wpcake'),
    '300'		=> __('Light', 'wpcake'),
    '400'		=> __('Regular', 'wpcake'),
    '700'		=> __('Bold', 'wpcake'),
    '800'		=> __('Bolder', 'wpcake'),
  ),
  'priority'	 				=> $priority++,
  'active_callback' => 'wpcake_check_st_if_system',
));
function wpcake_check_st_if_system( $control ) {
   if ( $control->manager->get_setting('wpcake_st_disable_google_fonts')->value() != '' ) {
      return true;
   } else {
      return false;
   }
}

$wp_customize->add_setting( 'wpcake_st_google_fonts',
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
$wp_customize->add_control( new WPCake_Google_Font_Select_Custom_Control( $wp_customize, 'wpcake_st_google_fonts',
  array(
    'label' => __( 'Site Title Font', 'wpcake' ),
    'description' => esc_html__( 'All Google Fonts sorted by popularity', 'wpcake' ),
    'priority'	 	=> $priority++,
    'section' => 'wpcake_site_title_typography',
    'input_attrs' => array(
      'font_count' => 'all',
      'orderby' => 'popular',
    ),
    'active_callback' 	=> 'wpcake_check_st_if_google',
  )
) );
function wpcake_check_st_if_google( $control ) {
   if ( $control->manager->get_setting('wpcake_st_disable_google_fonts')->value() != '' ) {
      return false;
   } else {
      return true;
   }
}


  // Set Site Title Font Size
  $wp_customize->add_setting( 'wpcake_site_title_size', array(
      'default'   => 1.5,
      'transport'	=> 'postMessage',
      'sanitize_callback' => 'wpcake_sanitize_number',
    ));
  $wp_customize->add_control( new WPCake_Slider_Custom_Control( $wp_customize, 'wpcake_site_title_size',
    array(
      'label' => __( 'Title Font Size', 'wpcake' ),
      'section' => 'wpcake_site_title_typography',
      'priority'    => $priority++,
      'description' => __('Measurement is in em.', 'wpcake'),
      'input_attrs' => array(
        'min' => 1,
        'max' => 3,
        'step' => 0.05,
      ),
      'active_callback' => 'wpcake_check_if_title_active',
    )));

    // Set title bottom margin
    $wp_customize->add_setting( 'wpcake_title_bottom_margin', array(
        'default'   => 30,
        'transport'	=> 'postMessage',
        'sanitize_callback' => 'wpcake_sanitize_number',
      ));
    $wp_customize->add_control( new WPCake_Slider_Custom_Control( $wp_customize, 'wpcake_title_bottom_margin',
      array(
        'label' => __( 'Title Bottom Margin', 'wpcake' ),
        'section' => 'wpcake_site_title_typography',
        'priority'    => $priority++,
        'description' => __('Measurement is in pixel.', 'wpcake'),
        'active_callback' 	=> 'wpcake_check_site_title_status',
        'input_attrs' => array(
          'min' => -20,
          'max' => 100,
          'step' => 1,
        ),
        'active_callback' => 'wpcake_check_if_title_active',
      )));

      function wpcake_check_if_title_active( $control ) {
         if ( $control->manager->get_setting('wpcake_disable_blogname')->value() != '' ) {
            return false;
         } else {
            return true;
         }
      }

      /* SEPARATOR */
      $wp_customize->add_setting( 'wpcake_st_description_separator', array(
          'type'          => 'theme_mod',
          'capability'    => 'edit_theme_options',
          'sanitize_callback'    => 'wpcake_sanitize_text',
      ));
      $wp_customize->add_control( new WPCake_Customize_Separator_Control( $wp_customize, 'wpcake_st_description_separator', array(
          'label'     => __( 'Site Description', 'wpcake' ),
          'section'   => 'wpcake_site_title_typography',
          'priority'	=> $priority++,
      )));

      // Font Family
      $wp_customize->add_setting( 'wpcake_st_desc_disable_google_fonts', array(
        'default'           	=> false,
        'sanitize_callback' 	=> 'wpcake_sanitize_checkbox',
      ) );
      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wpcake_st_desc_disable_google_fonts', array(
        'label'	   				=> esc_html__( 'Use system fonts', 'wpcake' ),
        'type' 					=> 'checkbox',
        'section'  				=> 'wpcake_site_title_typography',
        'priority' 				=> $priority++,
      ) ) );

      // System Fonts
      $wpcakeSysListFonts = array('inherit' => 'inherit') + $wpcakeSysListFonts;
      $wp_customize->add_setting( 'wpcake_st_desc_system_fonts', array(
          'default'   => 'inherit',
          'sanitize_callback' => 'wpcake_sanitize_text',
        ));
      $wp_customize->add_control( 'wpcake_st_desc_system_fonts', array(
        'label'             => esc_html__( 'System Fonts', 'wpcake' ),
        'section'           => 'wpcake_site_title_typography',
        'type'              => 'select',
        'choices'           => $wpcakeSysListFonts,
        'priority'	 				=> $priority++,
        'active_callback' => 'wpcake_check_st_desc_if_system',
      ));
      // System Fonts Weights
      $wp_customize->add_setting( 'wpcake_st_desc_system_fonts_weights', array(
          'default'   => '400',
          'sanitize_callback' => 'wpcake_sanitize_text',
        ));
      $wp_customize->add_control( 'wpcake_st_desc_system_fonts_weights', array(
        'label'             => esc_html__( 'Font Weight', 'wpcake' ),
        'section'           => 'wpcake_site_title_typography',
        'type'              => 'select',
        'choices'           => array(
          '100'		=> __('Lighter', 'wpcake'),
          '300'		=> __('Light', 'wpcake'),
          '400'		=> __('Regular', 'wpcake'),
          '700'		=> __('Bold', 'wpcake'),
          '800'		=> __('Bolder', 'wpcake'),
        ),
        'priority'	 				=> $priority++,
        'active_callback' => 'wpcake_check_st_desc_if_system',
      ));
      function wpcake_check_st_desc_if_system( $control ) {
         if ( $control->manager->get_setting('wpcake_st_desc_disable_google_fonts')->value() != '' ) {
            return true;
         } else {
            return false;
         }
      }

      $wp_customize->add_setting( 'wpcake_st_desc_google_fonts',
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
      $wp_customize->add_control( new WPCake_Google_Font_Select_Custom_Control( $wp_customize, 'wpcake_st_desc_google_fonts',
        array(
          'label' => __( 'Site Description Font', 'wpcake' ),
          'description' => esc_html__( 'All Google Fonts sorted by popularity', 'wpcake' ),
          'priority'	 	=> $priority++,
          'section' => 'wpcake_site_title_typography',
          'input_attrs' => array(
            'font_count' => 'all',
            'orderby' => 'popular',
          ),
          'active_callback' 	=> 'wpcake_check_st_desc_if_google',
        )
      ) );
      function wpcake_check_st_desc_if_google( $control ) {
         if ( $control->manager->get_setting('wpcake_st_desc_disable_google_fonts')->value() != '' ) {
            return false;
         } else {
            return true;
         }
      }


    // Set Site Tagline Font Size
    $wp_customize->add_setting( 'wpcake_site_tagline_size', array(
        'default'   => 1,
        'transport'	=> 'postMessage',
        'sanitize_callback' => 'wpcake_sanitize_number',
      ));
    $wp_customize->add_control( new WPCake_Slider_Custom_Control( $wp_customize, 'wpcake_site_tagline_size',
      array(
        'label' => __( 'Description Font Size', 'wpcake' ),
        'section' => 'wpcake_site_title_typography',
        'priority'    => $priority++,
        'description' => __('Measurement is in em.', 'wpcake'),
        'input_attrs' => array(
          'min' => 0.5,
          'max' => 3,
          'step' => 0.05,
        ),
        'active_callback' => 'wpcake_check_if_tagline_active',
      )));

      function wpcake_check_if_tagline_active( $control ) {
         if ( $control->manager->get_setting('wpcake_disable_blogdescription')->value() != '' ) {
            return false;
         } else {
            return true;
         }
      }
