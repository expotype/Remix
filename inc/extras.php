<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Remix
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
 // No direct access
if ( ! defined( 'ABSPATH' ) ) exit;
 
function remix_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	
	// Switch full-width layout, when no active widgets in the sidebar or full-width template.
	if ( ! is_active_sidebar( 'sidebar-1' )
		 || is_page_template( 'page-templates/full-width.php' )
		 || is_attachment() ) {
			 $classes[] = 'full-width';
	}
	
	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}	
	
	// Adds a class for container style.

	if ( 'boxed' === get_theme_mod( 'remix_container_layout', 'boxed' )) {
		$classes[] = 'container-boxed';
	}
	if ( 'fullwidth' === get_theme_mod( 'remix_container_layout', 'boxed' )) {
		$classes[] = 'container-fullwidth';
	}	

	// Adds a class for the sidebars.
	
	if ( 'content-sidebar' ===  get_theme_mod ('remix_content_sidebars') ) {
		$classes[] = 'content-sidebar-right';	
	} 
	if ( 'sidebar-content' ===  get_theme_mod ('remix_content_sidebars') ) {
		$classes[] = 'sidebar-left-content';	
	} 	
	if ( 'content-no-sidebars' ===  get_theme_mod ('remix_content_sidebars') ) {
		$classes[] = 'content-nosidebar';	
	} 		

	

	return $classes;
}
add_filter( 'body_class', 'remix_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function remix_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}
add_action( 'wp_head', 'remix_pingback_header' );
