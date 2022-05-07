<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package bsd
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo get_theme_file_uri()?>/style/flickity.css">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'bsd' ); ?></a>

    <header class="site-header">
        <div id="masthead" class="container">
            <aside id="search" class="widget widget_search"><?php
                get_search_form(); ?></aside>
            <div class="site-branding">
                <div><?php the_custom_logo(); ?></div>
            </div><!-- .site-branding -->

            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="noicon">Categorias</span>
                    <span class="dashicons">
                        <img width="30" height="30" src="<?php echo get_theme_file_uri()?>/image/menu.svg" alt="Menu" />
                    </span>
                </button>
                <?php wp_nav_menu( [ 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu', 'container_aria_label'=>'teste ' ] ); ?>
            </nav><!-- #site-navigation -->
        </div>
    </header><!-- #masthead -->

