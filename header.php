<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Remix
 */
// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

?><!DOCTYPE html>

<!--[if IE 8]>
<html class="ie ie8 no-js" <?php language_attributes(); ?>>
<![endif]-->

<!--[if !(IE 8)]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php hybrid_attr( 'body' ); ?>>

<?php wp_body_open(); ?>

<div id="page" class="site site-wrap">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'remix' ); ?></a>

	<?php if ( get_header_image() ) { ?>
		<header id="masthead" class="site-header header-bg-image" style="background-image: url(<?php echo get_header_image(); ?>) " role="banner" <?php hybrid_attr( 'header' ); ?>>		
		<?php } else { ?>		
		<header id="masthead" class="site-header" role="banner" <?php hybrid_attr( 'header' ); ?>>
	<?php }	?>
	
	
		<div class="wrap">
			<div class="site-branding">

				<?php // Custom logo
				remix_custom_logo(); ?>

					<div id="site-branding-text">
					<?php if ( is_front_page() || is_home() ) : ?>

					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>

				</div><!-- #site-branding-text -->
			</div><!-- .site-branding -->
	
			<?php get_template_part( 'template-parts/navigation-header' ); ?>	
			<?php  get_sidebar ('header'); ?>	

			</div><!--.wrap-->	
			<?php get_template_part( 'template-parts/navigation-primary' ); ?>		
		</header><!-- #masthead -->
		
		<?php do_action( 'remix_after_header' ); // after header hook ?>	

		<div class="wrap content-wrap">
		
		<?php get_sidebar ('after-header'); ?>
	<div id="content" class="site-content">
