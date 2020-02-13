<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Remix
 */
// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;
?>

	</div><!-- #content -->
	
	<?php get_sidebar('before-footer'); ?>		
	
		</div><!--.wrap-->	
		
	<footer id="colophon" class="site-footer" role="contentinfo" <?php hybrid_attr( 'footer' ); ?>>
		<div class="wrap">
		
	<?php get_sidebar('footer'); ?>
	
	<?php // do_action( 'remix_credits' );	?>
	<?php // do_action( 'remix_site_info' );	?>

		<?php get_template_part( 'template-parts/site', 'info' ); ?>
		<?php get_template_part( 'template-parts/navigation', 'footer' ); ?>	
		
		</div><!--.wrap-->		
	</footer><!-- footer #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
