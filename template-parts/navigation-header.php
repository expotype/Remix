<?php
/*
*Header navigation
*/
// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;
?>
	<?php if ( has_nav_menu( 'header' ) ) : ?>
	<nav id="header-navigation" class="main-navigation toggle-navigation" role="navigation" <?php hybrid_attr( 'menu', 'header' ); ?>>
       <button class="menu-toggle" aria-controls="header-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'remix' ); ?></button>

       <?php wp_nav_menu( array(
        'theme_location' => 'header',
        'menu_id'		 => 'menu-header',
		'menu_class'     => 'nav-menu',
		'container'      => false,		 
        'depth'          => 2,
         ) );
       ?>

   </nav><!-- #site-navigation -->
   	<?php endif; ?>

