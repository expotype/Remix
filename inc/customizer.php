<?php
/**
 * Remix Theme Customizer.
 *
 * @package Remix
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
 // No direct access
if ( ! defined( 'ABSPATH' ) ) exit;
 
function remix_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	

	

	// Use selective refresh to preview changes to site title and tagline.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'            => '.site-title > a',
			'container_inclusive' => false,
			'render_callback'     => 'remix_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'            => '.site-description',
			'container_inclusive' => false,
			'render_callback'     => 'remix_customize_partial_blogdescription',
		) );
	}

	// Rename the label to "Site Title Color" because this only affects the site title in this theme.
	$wp_customize->get_control( 'header_textcolor' )->label = esc_html__( 'Site Title Color', 'remix' );

	// Rename the label to "Display Site Title & Tagline" in order to make this option extra clear.
	$wp_customize->get_control( 'display_header_text' )->label = esc_html__( 'Display Site Title &amp; Tagline', 'remix' );

	// Create heading color setting in the existing Color section 
	$wp_customize->add_setting( 'header_bg_color' , array(
		'default'     => '#ffffff',
		'type' => 'theme_mod',
		'sanitize_callback'    => 'sanitize_hex_color',
		'transport'   => 'postMessage'
	) );

	// Add the controls
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'link_color', array(
				'label' => __( 'Header Background Color', 'remix' ),
				'section' => 'colors',
				'settings' => 'header_bg_color'
			)
		)
	);
	// Create link color setting in the existing Color section 
	$wp_customize->add_setting( 'blog_titles' , array(
		'default'     => '#555555',
		'type' => 'theme_mod',
		'sanitize_callback'    => 'sanitize_hex_color',
		'transport'   => 'postMessage'
	) );

	// Add the controls
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'blog_titles', array(
				'label' => __( 'Blog/Page Titles', 'remix' ),
				'section' => 'colors',
				'settings' => 'blog_titles'
			)
		)
	);	
	
	// Register new section: Theme Options
	$wp_customize->add_section( 'remix_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'remix' ),
		'priority' => 130,
	) );
	
	// Register Container style setting
	$wp_customize->add_setting( 'remix_container_layout', array(
		'default'           => 'boxed',
		'sanitize_callback' => 'remix_sanitize_container_layout',
	) );
	$wp_customize->add_control( 'remix_container_layout', array(
		'label'             => esc_html__( 'Site Container', 'remix' ),
		'section'           => 'remix_theme_options',
		'priority'          => 1,
		'type'              => 'radio',
		'choices'           => array(
			'boxed'     => esc_html__( 'Boxed', 'remix' ),		
			'fullwidth' => esc_html__( 'Full Width', 'remix' ),
			)
	) );	
	

	// Register Content layout setting
	$wp_customize->add_setting( 'remix_content_sidebars', array(
		'default'           => 'content-sidebar',
		'sanitize_callback' => 'remix_sanitize_content_sidebars',
	) );
	$wp_customize->add_control( 'remix_content_sidebars', array(
		'label'             => esc_html__( 'Content Layout', 'remix' ),
		'section'           => 'remix_theme_options',
		'priority'          => 1,
		'type'              => 'radio',
		'choices'           => array(
			'content-sidebar'   => esc_html__( 'Content-Sidebar', 'remix' ),
			'sidebar-content'   => esc_html__( 'Sidebar-Content', 'remix' ),
			'content-no-sidebars' => esc_html__( 'Single Column Content', 'remix' ),
			//'single-column-narrow' => esc_html__( 'Single Column Content Narrow ', 'remix' ),			
			)
	) );	

	// Register new section: Theme Blog Options
	$wp_customize->add_section( 'remix_blog_options', array(
		'title'    => esc_html__( 'Theme Blog Options', 'remix' ),
		'priority' => 140,
	) );	
	
$wp_customize->add_setting( 
	'remix_read_more_text', array(
	'default'           => esc_html__('Continue reading', 'remix'),	
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 
	'remix_read_more_text', array(
	'label'    => __( 'Read More Text', 'remix' ),
	'section'  => 'remix_blog_options',
	'type'     => 'text',
	'priority' => 100,
	)
);
	
	
	}	
add_action( 'customize_register', 'remix_customize_register' );

// Render the site title for the selective refresh partial.

function remix_customize_partial_blogname() {
	bloginfo( 'name' );
}

// Render the site tagline for the selective refresh partial.

function remix_customize_partial_blogdescription() {
		bloginfo( 'description' );
}

/**
 * Sanitize the Container Layout.
 */
function remix_sanitize_container_layout( $layouts ) {
	if ( ! in_array( $layouts, array( 'boxed', 'fullwidth' ) ) ) {
		$layouts = 'boxed';
	}
	return $layouts;
}

/**
 * Sanitize the Content Sidebars.
 */
function remix_sanitize_content_sidebars( $sidebars ) {
	if ( ! in_array( $sidebars, array( 'content-sidebar', 'sidebar-content', 'content-no-sidebars' ) ) ) {
		$sidebars = 'content-sidebar';
	}
	return $sidebars;
}



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function remix_customize_preview_js() {
	wp_enqueue_script( 'remix_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), null, true );
}
add_action( 'customize_preview_init', 'remix_customize_preview_js' );


/*
* Output Customizer CSS
*/

function remix_customizer_css() {

	$header_bg_color = get_theme_mod('header_bg_color');
	$blog_titles = get_theme_mod('blog_titles');	

//	if ( $header_bg_color && $header_bg_color != "#ffffff" ) {
	?>
        <style type="text/css">
		.entry-title,.entry-title a, .widget-title, .more-link a {
			 color:<?php echo $blog_titles; ?>;
		}
        .site-header {
			 background-color:<?php echo $header_bg_color; ?>;				 
		}
        </style>
    <?php
//	}
}	
add_action( 'wp_head', 'remix_customizer_css');

// Customizer Blog Section
// require_once( get_template_directory() . '/inc/customizer/settings-texts.php' );