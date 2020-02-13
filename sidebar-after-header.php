<?php
/**
 * The sidebar in the header.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Remix
 */
// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! is_active_sidebar( 'sidebar-5' ) ) {
	return;
}
?>

<aside id="sidebar-after-header" class="widget-area" role="complementary" <?php hybrid_attr( 'sidebar', 'after-header' ); ?>>
	<?php dynamic_sidebar( 'sidebar-5' ); ?>
</aside><!-- #sidebar-header -->
