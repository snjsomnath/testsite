<?php
/**
 * xi Portfolio Theme Customizer
 *
 * @package xi_portfolio
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function xi_portfolio_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	// $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


	// View PRO Version
	$wp_customize->add_section( 'xi-portfolio_style_view_pro', array(
		'title'       => '' . esc_html__( 'View PRO Version', 'xi-portfolio' ),
		'priority'    => 2,
		'description' => sprintf(
			__( '<div class="upsell-container">
					<h2>Go PRO Today!</h2>
					<p>Take it to the next level. See the features below:</p>
					<ul class="upsell-features">
                            <li>
                            	<h4>Portfolio Plugin</h4>
                            	<div class="description">Have a dedicated portfolio post types with an image library, category filtering and styled portfolio page.</div>
                            </li>

                            <li>
                            	<h4>Galleries & Albums</h4>
                            	<div class="description">Upload galleries/Albums in your portfolios with a single click</div>
                            </li>
                            


                            <li>
                            	<h4>One On One Email Support</h4>
                            	<div class="description">Get one on one email support from our experienced support stuff, we can also help you modify the theme to your liking</div>
                            </li>
                            
                    </ul> %s </div>', 'xi-portfolio' ),
			sprintf( '<a href="%1$s" target="_blank" class="button button-primary">%2$s</a>', esc_url( xi_portfolio_get_pro_link() ), esc_html__( 'View xi-portfolio PRO', 'xi-portfolio' ) )
		),
	) );

	$wp_customize->add_setting( 'xi-portfolio_pro_desc', array(
		'default'           => '',
		'sanitize_callback' => 'xi-portfolio_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'xi-portfolio_pro_desc', array(
		'section' => 'xi-portfolio_style_view_pro',
		'type'    => 'hidden',
	) );
}
add_action( 'customize_register', 'xi_portfolio_customize_register' );
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function xi_portfolio_customize_preview_js() {
	wp_enqueue_script( 'xi_portfolio_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'xi_portfolio_customize_preview_js' );

/**
 * Admin CSS
 */
function xi_portfolio_customizer_assets() {
    wp_enqueue_style( 'xi-portfolio_customizer_style', get_template_directory_uri() . '/css/admin.css', null, '1.0.1', false );
}
add_action( 'customize_controls_enqueue_scripts', 'xi_portfolio_customizer_assets' );
/**
 * Generate a link to the Noah Lite info page.
 */
function xi_portfolio_get_pro_link() {
    return 'https://thepixeltribe.com/template/xi-portfolio/';
}
