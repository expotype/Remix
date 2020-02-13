<?php
/**
 * The sidebar before footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Remix
 */
// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! is_active_sidebar( 'sidebar-7' ) ) {
	return;
}
?>

<aside id="sidebar-before-footer" class="widget-area" role="complementary" <?php hybrid_attr( 'sidebar', 'before-footer' ); ?>>
	<?php dynamic_sidebar( 'sidebar-7' ); ?>
</aside><!-- #sidebar-before-footer -->
