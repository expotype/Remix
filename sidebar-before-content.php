<?php
/**
 * The sidebar before content.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Remix
 */
// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! is_active_sidebar( 'sidebar-6' ) ) {
	return;
}
?>

<aside id="sidebar-before-content" class="widget-area" role="complementary" <?php hybrid_attr( 'sidebar', 'before-content' ); ?>>
	<?php dynamic_sidebar( 'sidebar-6' ); ?>
</aside><!-- #sidebar-before-content -->
