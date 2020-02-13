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

if ( ! is_active_sidebar( 'sidebar-4' ) ) {
	return;
}
?>

<aside id="sidebar-header" class="widget-area" role="complementary" <?php hybrid_attr( 'sidebar', 'header' ); ?>>
	<?php dynamic_sidebar( 'sidebar-4' ); ?>
</aside><!-- #sidebar-header -->
