<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Remix
 */
// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>
	<header class="entry-header">
	
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif; ?>

	</header><!-- .entry-header -->

		<?php if ( has_post_thumbnail() && !is_single() ) : ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
			</div>
		<?php endif; ?>
		
		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php remix_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
		

		<?php if ( !is_singular() ) : ?>				
			<div class="entry-summary" itemprop="text" <?php hybrid_attr( 'entry-summary' ); ?>>
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
			

			
			<?php else : ?>				
			
			<div class="entry-content" itemprop="text">
			
			<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'remix' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
	
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'remix' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-footer">
		<?php remix_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
