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
                    <span class="dashicons"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                 width="24" height="24"
                                                 viewBox="0 0 172 172"
                                                 style=" fill:#000000;"><g transform=""><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="#ffffff"></path><g id="original-icon" fill="#000000"><path d="M14.33333,35.83333v14.33333h143.33333v-14.33333zM14.33333,78.83333v14.33333h143.33333v-14.33333zM14.33333,121.83333v14.33333h143.33333v-14.33333z"></path></g><path d="" fill="none"></path></g></g></svg></span>
                </button>
                <?php wp_nav_menu( [ 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu', ] ); ?>
            </nav><!-- #site-navigation -->
        </div>
    </header><!-- #masthead -->

