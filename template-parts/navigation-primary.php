<?php
/*
* Main navigation
*/
// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;
 ?>

<?php if ( has_nav_menu( 'primary' ) ) : ?>
<nav id="site-navigation" class="main-navigation" role="navigation" <?php hybrid_attr( 'menu', 'primary' ); ?>>
   
	<div class="wrap">	   
       <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'remix' ); ?></button>

       <?php wp_nav_menu( array(
        'theme_location' => 'primary',
        'menu_id' 		 => 'menu-primary',
		'menu_class'     => 'nav-menu',
		'container'      => false,	 
        'depth'          => 3,
         ) );
       ?>
	   
	</div><!--.wrap-->
	
</nav><!-- #site-navigation -->
<?php endif; ?>
