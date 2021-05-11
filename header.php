<?php 
/**
 * The header for our theme.
 * 
 * Displays all of the <head> section and everything up till <div id="conten">
 * 
 * @package havana
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/dist/styles/style.min.css" media="all"/>

<?php wp_head(); ?>
<?php 

$bodyClasses = '';

/**
 * Get the header image to display
 */
$headerImageUrl = '';
$headerImageGradientColor = '';
$stop1Opacity = 0.6;
$stop2Opacity = 0.4;
if ( get_header_image() ) {
    $headerImageUrl = get_header_image();
    $headerImageGradientColor = '41,51,56';
}
if ( ( is_single() || is_page() ) && has_post_thumbnail() ) {
    $imageAttachment = wp_get_attachment_image_src( get_post_thumbnail_id(), 'havana-wallpaper' );

    if ( ! empty( $imageAttachment ) ) {
        $headerImageUrl = $imageAttachment[0];
    }
}
if ( is_single() || is_page() ) {
    $headerImageGradientColor = '41,51,56';
    $stop1Opacity = 0.7;
    $stop2Opacity = 0.5;
}
if ( ! empty( $headerImageUrl ) ) {
    $bodyClasses = ' has-header-image';
}

/**
 * Add sidebar class
 */
if ( is_single() || is_page() ) {
    if ( is_active_sidebar( 'sidebar-1' ) ) {
        $bodyClasses .= ' has-sidebar';
    }
}

?>
<style id="havana_header">
    header#masthead {
        background-image: linear-gradient( 45deg, 
            rgba(<?= $headerImageGradientColor ?>, <?= $stop1Opacity ?>) 0%, 
            rgba(<?= $headerImageGradientColor ?>, <?= $stop2Opacity ?>), 48%, 
            rgba(<?= $headerImageGradientColor ?>, 0) 100%), 
            url(<?= esc_url( $headerImageUrl ) ?> 
        );
    }
</style>
</head>

<body <?php body_class( $bodyClasses ) ?>>
<div id="page" class="hfeed site">
    <a href="#content" class="skip-link screen-reader-text">
        <?php _e( 'Skip to content', 'havana' ); ?>
    </a>

    <?php 

    /**
     * Header image
     */
    if ( ! empty( $headerImageUrl ) ) : ?>
    <header id="masthead" class="site-header" role="banner">
        <?php
        // For the frontpage, display the site tagline
        if ( is_home() || is_front_page() ) {
            ?>
            <div id="masthead-inner" class="tagline">

                <?php if ( get_bloginfo( 'description' ) ) : ?>
                    <h1 class="site-description">
                        <?php bloginfo( 'description' ); ?>
                    </h1>
                <?php endif; ?>
                
                <?php havana_get_home_caption() ?>
            </div>
            <?php

        // For the rest of the pages, display the title    
        } else if ( is_single() ) {
            ?>
            <div id="masthead-inner">
                <?php 
                if ( 'post' == get_post_type() ) {
                    ?><span class="entry-category"><?php havana_entry_category() ?></span><?php
                    ?><span class="entry-date"><?php havana_posted_on() ?></span><?php
                }
                ?>
                <h1 class="site-description"><?php the_title(); ?></h1>
            </div>
            <?php

        } else if ( is_archive() ) {
            ?>
            <div id="masthead-inner">
                <h1 class="site-description"><?php the_archive_title() ?></h1>
            </div>
            <?php

        } else if ( is_search() ) {
            ?>
            <div id="masthead-inner">
                <span class="search-label"><?php _e( 'Search Results for:', 'havana' ) ?></span>
                <h1 class="site-description"><?= esc_html( get_search_query() ) ?></h1>
            </div>
            <?php

        } else if ( is_404() ) {
            ?>
                <div id="masthead-inner">
                    <h1 class="site-description"><?php the_title() ?></h1>
                </div>
            <?php

        // For the rest of the pages, display the title
        } else {
            ?>
            <div id="masthead-inner">
                <h1 class="site-description"><?php the_title() ?></h1>
            </div>
            <?php
        }
        ?>

        <nav id="site-navigation" class="main-navigation" role="navigation">
            <div class="main-menu">
                <?php 
                $title = __( 'Menu', 'havana' );
                if ( is_single() || is_page() ) {
                    ?>
                    <div id="site-top">
                        <span class="social-navigation"><?php havana_create_social_icons() ?></span>
                        
                        <?php 
                        if ( functions_exists( 'jetpack_the_site_logo' ) ) {
                            jetpack_the_site_logo();
                        } else {
                            ?><a href="<?= esc_url( home_url( '/' ) ); ?>" class="site-title site-logo-link" rel="home">
                                <?php esc_url( bloginfo( 'name' ) ); ?>
                            </a><?php
                        }
                        ?>
                        
                    </div>
                    <?php
                }
                ?>
                <h4><?= esc_html( $title ); ?></h4>
                <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
            </div>
        </nav>
    </header>
    
    <?php
    endif;

    /**
     * Main menu
     */
    ?>

    <?php 
    
    /**
     * Logo & Social icons
     */
    if ( is_home() || is_front_page() || is_archive() || is_search() || is_404() ) {
        ?>
        <div id="site-top">
            <span class="social-navigation">
                <?php havana_create_social_icons() ?>
            </span>

            <?php
            if ( function_exists( 'jetpack_the_site_logo' ) ) {
                jetpack_the_site_logo();
            } else {
                ?>
                <a href="<?= esc_url( home_url( '/' ) ); ?>" class="site-title site-logo-link" rel="home">
                    <?php esc_html( bloginfo( 'name' ) ); ?>
                </a>
                <?php
            }
            ?>

        </div>
        <?php
    }
    ?>
<div id="content" class="site-content">