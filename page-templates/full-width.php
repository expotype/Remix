<?php
/**
 * Template Name: Full-width Page Template, No Sidebar
 *
 * Description: Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package Remix
 */
// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

get_header(); ?>

	<div id="primary" class="site-content content-area fullwidth">
		<div id="content" role="main" <?php hybrid_attr( 'content' ); ?>>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>