<?php
/**
 * The sidebar in the footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Remix
 */
// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;


if ( ! is_active_sidebar( 'sidebar-8' ) ) {
	return;
}
?>

<aside id="sidebar-footer" class="widget-area" role="complementary" <?php hybrid_attr( 'sidebar', 'footer' ); ?>>
	<?php dynamic_sidebar( 'sidebar-8' ); ?>
</aside><!-- #sidebar-footer -->
