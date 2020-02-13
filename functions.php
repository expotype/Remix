<?php
/**
 * Remix functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Remix
 */
// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'remix_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function remix_setup() {
		/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Remix, use a find and replace
	 * to change 'remix' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'remix', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop	

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'remix' ),
		'header' => esc_html__( 'Header Menu', 'remix' ),
		'footer' => esc_html__( 'Footer Menu', 'remix' ),

	) );

	// Add support for logo.
	add_theme_support( 'custom-logo', apply_filters( 'remix_custom_logo_args', array(
		'height'      => 120,
		'width'       => 120,
		'flex-height' => true,
		'flex-width'  => true,
	) ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'remix_custom_background_args', array(
		'default-color' => 'f2f2f2',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'remix_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function remix_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'remix_content_width', 800 );
}
add_action( 'after_setup_theme', 'remix_content_width', 0 );

/**
 * Register custom fonts
 */
if ( ! function_exists( 'remix_fonts_url' ) ) :
/**
 *  Return the Google fonts stylesheet URL if available.
 *
 * The use of Open Sans by default is localized. For languages that use
 * characters not supported by the font, the font can be disabled.
 *
 * @return string Google fonts URL for the theme or empty string if disabled.
 *
 * Reference: http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 *
 */
function remix_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'presstype' ) ) {
		$fonts[] = 'Roboto:400i,600i,700i,400,600,700';
	}

	/* translators: If there are characters in your language that are not supported by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Roboto Slab font: on or off', 'presstype' ) ) {
		$fonts[] = 'Roboto Slab:400,700';
	}	
	

	/* translators: To add an additional character subset specific to your language, translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language. */
	$subset = _x( 'no-subset', 'Roboto font: add new subset (greek, cyrillic, vietnamese)', 'presstype' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = esc_url( add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' ) );
	}

	return $fonts_url;
}
endif;

/**
 * Add preconnect for Google Fonts.
 *
 * code from Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function remix_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'remix-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'remix_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function remix_widgets_init() {
	
	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar', 'remix' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'remix' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );	

	register_sidebar( array(
		'name'          => esc_html__( 'First Front Page Widget Area', 'remix' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'remix' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Second Front Page Widget Area', 'remix' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'remix' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Header Widget Area', 'remix' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Appears to the right of the logo.', 'remix' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );	

	register_sidebar( array(
		'name'          => esc_html__( 'After Header Widget Area', 'remix' ),
		'id'            => 'sidebar-5',
		'description'   => esc_html__( 'Appears under the header.', 'remix' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Before Content Widget Area', 'remix' ),
		'id'            => 'sidebar-6',
		'description'   => esc_html__( 'Appears before the content', 'remix' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );	

	register_sidebar( array(
		'name'          => esc_html__( 'Before Footer Widget Area', 'remix' ),
		'id'            => 'sidebar-7',
		'description'   => esc_html__( 'Appears above the footer', 'remix' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );	
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area', 'remix' ),
		'id'            => 'sidebar-8',
		'description'   => esc_html__( 'Appears inside the footer', 'remix' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );	
	
		if ( 'content-no-sidebars' === get_theme_mod( 'remix_content_sidebars' ) ) {
		return;
	}	

	

}
add_action( 'widgets_init', 'remix_widgets_init' );


// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');


/**
 * Enqueue scripts and styles.
 */
function remix_scripts() {
	global $wp_styles;

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'remix-fonts', remix_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/assets/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'theme-style', get_stylesheet_uri(), array(), null );

	//  Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'remix-ie', get_template_directory_uri() . '/assets/css/ie.css', array('theme-style'), null );
	$wp_styles->add_data( 'remix-ie', 'conditional', 'lt IE 9' );
	
	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_template_directory_uri() . '/assets/js/html5shiv.min.js', array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'remix-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215' , true );
	wp_enqueue_script( 'remix-navigation-header', get_template_directory_uri() . '/assets/js/navigation-header.js', array(), '20151215' , true );	

	wp_enqueue_script( 'remix-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'remix_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Hybrid breadcrumb trail. Check if no plugin installed.
*/
if( !function_exists( 'breadcrumb_trail' ) ) {
	require_once( get_template_directory() . '/inc/breadcrumb-trail.php' );
}

/**
 * Load Hybrid Schema.org file.
*/
require_once( get_template_directory() . '/inc/schema.php' );

/**
 * Filter the excerpt length.

 */
function remix_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'remix_excerpt_length', 999 );

/**
 * Filter the "read more" excerpt string and link to the post.
 */
// function remix_excerpt_more( $more ) {
//    return '<span class="more-link"><a href="'.get_the_permalink().'" > ... Read More &raquo;</a></span>';
//}
// add_filter( 'excerpt_more', 'remix_excerpt_more' );


/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'Continue reading' link.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */

 // addded read more in customizer
 
if ( ! function_exists( 'remix_excerpt_more' ) ) :
	function remix_excerpt_more( $more ) {
		$link = sprintf( '<span class="more-link"><a href="%1$s" >%2$s</a></span>',
			esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			/*	sprintf( esc_html__( 'Continue reading %s', 'remix' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )*/
			sprintf( get_theme_mod( 'remix_read_more_text', 'Continue reading <span class="genericon genericon-play"></span>' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
			);
		return '<p>' . $link . '</p>'; 
	}
	add_filter( 'excerpt_more', 'remix_excerpt_more' );
endif;






//hook breadcrumbs

if ( ! function_exists( 'add_hybrid_breadcrumbs' ) ) {
	function add_hybrid_breadcrumbs() {

	echo '<div class="wrap">';
	echo breadcrumb_trail( array( 'show_browse' => false, 'show_on_front' => false ) );
	echo '</div>';
}
}

// add_action ('remix_after_header', 'add_hybrid_breadcrumbs');


if ( ! function_exists( 'remix_add_footer_credits' ) ) :
add_action('remix_credits','remix_add_footer_credits');
function remix_add_footer_credits()
{
	$credits = sprintf( '<span class="copyright">&copy; %1$s</span> &bull; <a href="%2$s" target="_blank" itemprop="url">%3$s</a>',
		date( 'Y' ),
		esc_url( 'http://expotype.com' ),
		__( 'expotype','expotype' )
	);
	
	echo apply_filters( 'remix_credits_mod', $credits );
}
endif;

if ( ! function_exists( 'remix_add_site_info' ) ) {
	/**
	 * Display the theme credit
	 * @since  1.0.0
	 * @return void
	 */
	function remix_add_site_info() {
		$remix_theme = wp_get_theme();
        $name = $remix_theme->get( 'Name' );
		$url = $remix_theme->get( 'ThemeURI' );
		$author = $remix_theme->get( 'Author' );
		$copyright = __( '&copy; ', 'remix' ) . esc_attr( date_i18n( __( 'Y', 'remix' ) ) ) . '&nbsp;' . get_bloginfo( 'name' );
	
			echo '<div class="site-info">';
		    echo esc_html( apply_filters( 'remix_copyright_text', $copyright ) );
		    if ( apply_filters( 'remix_credit_link', true ) ) {
		        printf( __( ' &bull; Theme: %1$s by %2$s &bull; ', 'remix' ), esc_attr( $name ), '<a href="' . esc_url( $url ) . '" alt="' . esc_attr( $name ) . '" title="' . esc_attr( $name ) . '" rel="designer">' . esc_attr( $author ) . '</a>' );
				
			} ?>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'remix' ) ); ?>"><?php printf( __( 'Powered by %s', 'remix' ), 'WordPress' ); ?></a>
			<?php echo '</div>';			
			
	} 
}
add_action('remix_site_info','remix_add_site_info');

/*
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'remix' ) ); ?>"><?php printf( esc_html__( 'powered by %s', 'remix' ), 'WordPress' ); ?></a>
			<span class="sep"> &bull; </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'remix' ), 'remix', '<a href="http://expotype.com/" rel="designer">expotype</a>' ); ?>
		</div><!-- .site-info -->
*/		
