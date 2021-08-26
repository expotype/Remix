<?php
/**
 * Template Name: Block Editor Template
 *
 * Description: Use this page for buiding with blocks, such as Gutenberg, Getwid, ...
 *
 *
 * @package Remix
 */
// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

get_header(); ?>

	<div id="primary" class="site-content content-area fullwidth">
		<div id="content" role="main" <?php hybrid_attr( 'content' ); ?>>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', 'blocks' ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
