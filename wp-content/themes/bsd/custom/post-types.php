<?php

function slideshow_post_type() {
	$labels = [
		'menu_name'          => esc_html__( 'Slideshows', 'bsd' ),
		'name_admin_bar'     => esc_html__( 'Slideshow', 'bsd' ),
		'add_new'            => esc_html__( 'Criar Slideshow', 'bsd' ),
		'add_new_item'       => esc_html__( 'Criar NovoSlideshow', 'bsd' ),
		'new_item'           => esc_html__( 'Novo Slideshow', 'bsd' ),
		'edit_item'          => esc_html__( 'Editar Slideshow', 'bsd' ),
		'view_item'          => esc_html__( 'Exibir Slideshow', 'bsd' ),
		'update_item'        => esc_html__( 'Exibir Slideshow', 'bsd' ),
		'all_items'          => esc_html__( 'Todos Slideshows', 'bsd' ),
		'search_items'       => esc_html__( 'Search Slideshows', 'bsd' ),
		'parent_item_colon'  => esc_html__( 'Parent Slideshow', 'bsd' ),
		'not_found'          => esc_html__( 'Nenhum Slideshows encontrado', 'bsd' ),
		'not_found_in_trash' => esc_html__( 'Nenhum Slideshows  removido', 'bsd' ),
		'name'               => esc_html__( 'Slideshows', 'bsd' ),
		'singular_name'      => esc_html__( 'Slideshow', 'bsd' ),
	];

	$args = [
		'label'             => __( 'slideshow', 'bsd' ),
		'labels'            => $labels,
		'supports'          => [
			'custom-fields',
			'title',
		],
		'taxonomies'        => [
			'category',
			'tag',
		],
		'menu_icon'         => 'dashicons-admin-site',
		'hierarchical'      => false,
		'public'            => true,
		'show_ui'           => true,
		'show_in_menu'      => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_position'     => 5,
		'show_in_rest'      => true,
		'rewrite'           => [ 'slug' => 'slideshow' ],
	];

	register_post_type( 'slideshows', $args );
}

add_action( 'init', 'slideshow_post_type', 0 );

function salista_post_type() {
	$labels = [
		'menu_name'          => esc_html__( 'Salistas', 'bsd' ),
		'name_admin_bar'     => esc_html__( 'Salista', 'bsd' ),
		'add_new'            => esc_html__( 'Criar Salista', 'bsd' ),
		'add_new_item'       => esc_html__( 'Criar Novo Salista', 'bsd' ),
		'new_item'           => esc_html__( 'Novo Salista', 'bsd' ),
		'edit_item'          => esc_html__( 'Editar Salista', 'bsd' ),
		'view_item'          => esc_html__( 'Exibir Salista', 'bsd' ),
		'update_item'        => esc_html__( 'Exibir Salista', 'bsd' ),
		'all_items'          => esc_html__( 'Todos os Salistas', 'bsd' ),
		'search_items'       => esc_html__( 'Search Salistas', 'bsd' ),
		'parent_item_colon'  => esc_html__( 'Parent Salista', 'bsd' ),
		'not_found'          => esc_html__( 'Nenhum Salistas encontrado', 'bsd' ),
		'not_found_in_trash' => esc_html__( 'Nenhum Salistas  removido', 'bsd' ),
		'name'               => esc_html__( 'Salistas', 'bsd' ),
		'singular_name'      => esc_html__( 'Salista', 'bsd' ),
	];

	$args = [
		'label'             => __( 'salista', 'bsd' ),
		'labels'            => $labels,
		'supports'          => [
//			'editor',
			'custom-fields',
			'excerpt',
			'thumbnail',
			'title',
		],
		'taxonomies'        => [
			'tag',
			'salista_categories',
			'torre_salista',
		],
		'menu_icon'         => 'dashicons-admin-site',
		'hierarchical'      => false,
		'public'            => true,
		'show_ui'           => true,
		'show_in_menu'      => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_position'     => 5,
		'show_in_rest'      => true,
		'rewrite'           => [ 'slug' => 'slideshow' ],
	];

	register_post_type( 'salistas', $args );
}

add_action( 'init', 'salista_post_type', 1 );

/**
 * Register custom query vars
 *
 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/query_vars
 */
function bsd_query_vars( $vars ) {
	$vars[] = 'loja';
	$vars[] = 'category';
	return $vars;
}
add_filter( 'query_vars', 'bsd_query_vars' );
