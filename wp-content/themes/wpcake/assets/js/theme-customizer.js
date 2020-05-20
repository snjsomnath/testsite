 /**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */

(function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		});
	});
	//Site title bottom Margin
	wp.customize( 'wpcake_title_bottom_margin', function( value ) {
		value.bind( function( to ) {
			$( '.site-title' ).css( 'marginBottom', to + 'px' );
		});
	});

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});

	// Site Title font size
	wp.customize('wpcake_site_title_size', function(control) {
		control.bind(function( to ) {
			$('header .site-title').css( 'fontSize', to + 'em' );
		});
	});

	// Site Tagline font size
	wp.customize('wpcake_site_tagline_size', function(control) {
		control.bind(function( to ) {
			$('header .site-description').css( 'fontSize', to + 'em' );
		});
	});

	// Logo Width
	wp.customize('wpcake_custom_logo_width', function(control) {
		control.bind(function( controlValue ) {
			$('header .custom-logo-link img.custom-logo').width( controlValue );
		});
	});

	// Logo Top Margin
	wp.customize('wpcake_custom_logo_margin', function(control) {
		control.bind(function( controlValue ) {
			$('.site-identity').css( 'marginTop', controlValue + 'px' );
		});
	});


	//Base font Size
	wp.customize( 'wpcake_base_font_size', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'fontSize', to + 'px' );
		});
	});

	//Article Line Height
	wp.customize( 'wpcake_base_line_height', function( value ) {
		value.bind( function( to ) {
			$( 'main p' ).css( 'lineHeight', to);
		});
	});


	//Site Title link Color
	wp.customize( 'wpcake_site_title_link_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).css( 'color', to );
		});
	});

	//body background color
	wp.customize( 'wpcake_bg_color', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'backgroundColor', to );
		});
	});

	//Body link Color
	wp.customize( 'wpcake_global_link_color', function( value ) {
		value.bind( function( to ) {
			$( 'a' ).css( 'color', to );
		});
	});

	//header bottom Margin
	wp.customize( 'wpcake_header_btm_margin', function( value ) {
		value.bind( function( to ) {
			$( 'header' ).css( 'marginBottom', to + 'px' );
		});
	});

	//header background Color
	wp.customize( 'wpcake_header_bg_color', function( value ) {
		value.bind( function( to ) {
			$( 'header' ).css( 'backgroundColor', to );
		});
	});

	//header Menu Top Margin
	wp.customize( 'wpcake_menu_font_size', function( value ) {
		value.bind( function( to ) {
			$( 'header nav *' ).css( 'fontSize', to + 'px' );
		});
	});

	//header Menu Top Margin
	wp.customize( 'wpcake_menu_top_margin', function( value ) {
		value.bind( function( to ) {
			$( 'header nav' ).css( 'marginTop', to + 'px' );
		});
	});

	//header link Color
	wp.customize( 'wpcake_header_link_color', function( value ) {
		value.bind( function( to ) {
			$( 'header nav *' ).css( 'color', to );
		});
	});

	//Headings bottom margin
	wp.customize( 'wpcake_headings_bottom_margin', function( value ) {
		value.bind( function( to ) {
			$( 'h1,h2,h3,h4,h5,h6' ).css( 'marginBottom', to + 'px' );
		});
	});

	//WooCommerce button color
	wp.customize( 'wpcake_wc_button_color', function( value ) {
		value.bind( function( to ) {
			$( '.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button' ).css( 'backgroundColor', to );
		});
	});

	//WooCommerce button txt color
	wp.customize( 'wpcake_wc_button_txt_color', function( value ) {
		value.bind( function( to ) {
			$( '.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button' ).css( 'color', to );
		});
	});

	//WooCommerce sale color
	wp.customize( 'wpcake_wc_sale_color', function( value ) {
		value.bind( function( to ) {
			$( '.woocommerce span.onsale' ).css( 'backgroundColor', to );
			$( '.woocommerce-message' ).css( 'borderColor', to );
		});
	});


	//footer widgets text color
	wp.customize( 'wpcake_footer_widgets_border_color', function( value ) {
		value.bind( function( to ) {
			$( '.footer-widgets' ).css( 'borderTopColor', to );
		});
	});

	//footer widgets background color
	wp.customize( 'wpcake_footer_widgets_bg_color', function( value ) {
		value.bind( function( to ) {
			$( '.footer-widgets' ).css( 'backgroundColor', to );
		});
	});

	//footer widgets text color
	wp.customize( 'wpcake_footer_widgets_txt_color', function( value ) {
		value.bind( function( to ) {
			$( '.footer-widgets' ).css( 'color', to );
		});
	});

	//footer widgets text color
	wp.customize( 'wpcake_footer_widgets_link_color', function( value ) {
		value.bind( function( to ) {
			$( '.footer-widgets a' ).css( 'color', to );
		});
	});

	//footer widgets title color
	wp.customize( 'wpcake_footer_widgets_title_color', function( value ) {
		value.bind( function( to ) {
			$( '.footer-widgets .widget-title' ).css( 'color', to );
		});
	});

	//footer top border color
	wp.customize( 'wpcake_footer_border_color', function( value ) {
		value.bind( function( to ) {
			$( 'footer' ).css( 'borderTopColor', to );
		});
	});

	//footer backgroundColor
	wp.customize( 'wpcake_footer_bg_color', function( value ) {
		value.bind( function( to ) {
			$( 'footer' ).css( 'backgroundColor', to );
		});
	});

	//footer text Color
	wp.customize( 'wpcake_footer_txt_color', function( value ) {
		value.bind( function( to ) {
			$( 'footer' ).css( 'color', to );
		});
	});

	//footer link Color
	wp.customize( 'wpcake_footer_link_color', function( value ) {
		value.bind( function( to ) {
			$( 'footer a:link, footer a:visited' ).css( 'color', to );
		});
	});

	//footer section one text
	wp.customize( 'wpcake_footer_section_one_text', function( value ) {
		value.bind( function( to ) {
			$( '.footer-inner .section_one' ).html( to );
		});
	});

	//footer section two text
	wp.customize( 'wpcake_footer_section_two_text', function( value ) {
		value.bind( function( to ) {
			$( '.footer-inner .section_two' ).html( to );
		});
	});


} )( jQuery );
