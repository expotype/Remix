<?php
/*
*Footer navigation
*/
// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<?php if ( has_nav_menu( 'footer' ) ) : ?>
	<nav id="footer-navigation" class="footer-navigation" role="navigation" <?php hybrid_attr( 'menu', 'footer' ); ?>>
		<?php wp_nav_menu( array( 
			'theme_location' => 'footer', 
			'menu_id' => 'footer-menu',
			'depth'          => 1,
			) ); 
		?>
	</nav><!-- #site-navigation -->		
<?php endif; ?>
