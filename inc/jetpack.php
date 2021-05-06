<?php
/**
 * Jetpack Compatibility File
 * 
 * @link https://jetpack.com/
 *
 * @package havana
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function havana_jetpack_setup() {
    // Add theme support for Infinite Scroll.
	add_theme_support(
		'infinite-scroll',
		array(
			'container' => 'main',
			'render'    => 'my_infinite_scroll_render',
			'footer'    => 'page',
		)
	);

    // Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Content Options.
	add_theme_support(
		'jetpack-content-options',
		array(
			'post-details' => array(
				'stylesheet' => 'my-style',
				'date'       => '.posted-on',
				'categories' => '.cat-links',
				'tags'       => '.tags-links',
				'author'     => '.byline',
				'comment'    => '.comments-link',
			),
			'featured-images' => array(
				'archive' => true,
				'post'    => true,
				'page'    => true,
			),
		)
	);
}
add_action( 'after_setup_theme', 'havana_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function my_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_type() );
		endif;
	}
}


/**
 * Add theme support for Portfolio Custom Post Type.
 * @see http://www.elegantthemes.com/blog/tips-tricks/what-you-need-to-know-about-the-new-portfolio-post-type-in-jetpack-3-1
 * @see http://en.support.wordpress.com/portfolios/portfolio-shortcode/
 */
function me_theme_jetpack_portfolio_cpt() {
	add_theme_support( 'jetpack-portfolio' );
}
add_action( 'after_setup_theme', 'me_theme_jetpack_portfolio_cpt' );


/**
 * Make all videos responsive
 * @see http://www.elegantthemes.com/blog/tips-tricks/what-you-need-to-know-about-the-new-portfolio-post-type-in-jetpack-3-1
 * @see http://en.support.wordpress.com/portfolios/portfolio-shortcode/
 */
function me_theme_jetpack_responsive_videos() {
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'me_theme_jetpack_responsive_videos' );

/**
 * Make all videos responsive
 * @see http://jetpack.me/support/site-logo/
 */
function havana_jetpack_site_logo() {
	$args = array(
	    'header-text' => array(
	        'site-title',
	        'site-description',
	    ),
	    'size' => 'full',
	);
	add_theme_support( 'site-logo', $args );
}
add_action( 'after_setup_theme', 'havana_jetpack_site_logo' );


function me_theme_jetpack_post_thumbnail_html( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
	if ( get_post_type( $post_id ) == 'jetpack-portfolio' && ( $size == 'full' || $size == 'large' ) ) {
		$size = 'jetpack-portfolio';
		return get_the_post_thumbnail( $post_id, $size, $attr );
	}
	return $html;
}
add_filter( 'post_thumbnail_html', 'me_theme_jetpack_post_thumbnail_html', 10, 5 );