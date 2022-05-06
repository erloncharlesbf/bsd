<?php
// Register Sidebars
function header_sidebar() {
	$args = [
		'id'          => 'header_search',
		'class'       => 'search-sidebar',
		'name'        => __( 'search_sidebar', 'bsd' ),
		'description' => __( 'Barra de busca global', 'bsd' ),
	];
	register_sidebar( $args );
}

add_action( 'widgets_init', 'header_sidebar' );
