<?php
/**
 * havana functions and definitions
 * 
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package havana
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 600; /* pixels */
}

if ( ! function_exists( 'havana_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function havana_setup() {

	/*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on my, use a find and replace
     * to change 'my' to the name of your theme in all the template files.
     */
	load_theme_textdomain( 'havana', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 400, 225, true );
	add_image_size( 'havana-wallpaper', 1600, 1024, true );
	add_image_size( 'jetpack-portfolio', 600, 400, true );
    
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'havana' ),
		'social' => __( 'Social Menu', 'havana' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	// add_theme_support( 'post-formats', array(
	// 	'aside',
	// ) );

	// Set up the WordPress core custom background feature.
	// add_theme_support( 'custom-background', apply_filters( 'havana_custom_background_args', array(
	//         'default-color' => 'ffffff',
	//         'default-image' => '',
	//     ) ) );
	
	// Remove the header text
	defined( 'NO_HEADER_TEXT' ) or define( 'NO_HEADER_TEXT', true );
}
endif; // havana_setup
add_action( 'after_setup_theme', 'havana_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function havana_widgets_init() {
	
	register_sidebar( array(
		'name'          => __( 'Frontpage Footer Left Widget', 'havana' ),
		'id'            => 'footer-frontpage-left',
		'description'   => __( 'The frontpage footer left widget area', 'havana' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) ); 
    register_sidebar( array(
		'name'          => __( 'Frontpage Footer Middle Widget', 'havana' ),
		'id'            => 'footer-frontpage-mid',
		'description'   => __( 'The frontpage footer middle widget area', 'havana' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Frontpage Footer Right Widget', 'havana' ),
		'id'            => 'footer-frontpage-right',
		'description'   => __( 'The frontpage footer right widget area', 'havana' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Innerpage Footer Left Widget', 'havana' ),
		'id'            => 'footer-innerpage-left',
		'description'   => __( 'The innerpage footer left widget area', 'havana' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Innerpage Footer Right Widget', 'havana' ),
		'id'            => 'footer-innerpage-right',
		'description'   => __( 'The innerpage footer widget area', 'havana' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'havana_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function havana_scripts() {
    
    // Use our copy of genericons instead of Jetpack's since we are using a newer version
	// wp_deregister_style( 'genericons' );

	if ( ! wp_script_is( 'genericons', 'registered' ) ) {
		wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons.css' );
	}
	
	wp_enqueue_style( 'havana-style', get_stylesheet_uri() );
	
	// wp_enqueue_style( 'havana-google-fonts', 'http://fonts.googleapis.com/css?family=Lato:100,400,700,900,400italic,900italic|PT+Serif:400,700,400italic,700italic' );
	                                         
    // wp_enqueue_style( 'havana_fontawesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
    
    //wp_enqueue_script( 'havana-scroll-article', get_template_directory_uri() . '/js/scroll-article.js', array( 'jquery' ), '20150216', true );
    // wp_enqueue_script( 'havana-background-picture', get_template_directory_uri() . '/js/background-picture.js', array( 'jquery' ), '20150216', true );
    
    // wp_enqueue_script( 'havana-hide-search', get_template_directory_uri() . '/js/hide-search.js', array(), '20140404', true );
    
    // wp_enqueue_script( 'havana-masonry-settings.js', get_template_directory_uri() . '/js/masonry-settings.js', array( 'masonry' ), '20140129'. true );
    
	wp_enqueue_script( 'havana-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'havana-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'havana_scripts' );

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
 * Load TGM Plugin Activation
 */
// require get_template_directory() . '/tgm-plugin-activation.php';

/**
 * Load Titan Framework plugin checker
 */
// require get_template_directory() . '/titan-framework-checker.php';

/**
 * Load Titan Framework options
 */
// require get_template_directory() . '/titan-options.php';