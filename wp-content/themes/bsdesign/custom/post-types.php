<?php

function slideshow_post_type() {
	$labels = [
		'menu_name'          => esc_html__( 'Slideshows', 'twentytwentytwo' ),
		'name_admin_bar'     => esc_html__( 'Slideshow', 'twentytwentytwo' ),
		'add_new'            => esc_html__( 'Criar Slideshow', 'twentytwentytwo' ),
		'add_new_item'       => esc_html__( 'Criar NovoSlideshow', 'twentytwentytwo' ),
		'new_item'           => esc_html__( 'Novo Slideshow', 'twentytwentytwo' ),
		'edit_item'          => esc_html__( 'Editar Slideshow', 'twentytwentytwo' ),
		'view_item'          => esc_html__( 'Exibir Slideshow', 'twentytwentytwo' ),
		'update_item'        => esc_html__( 'Exibir Slideshow', 'twentytwentytwo' ),
		'all_items'          => esc_html__( 'Todos Slideshows', 'twentytwentytwo' ),
		'search_items'       => esc_html__( 'Search Slideshows', 'twentytwentytwo' ),
		'parent_item_colon'  => esc_html__( 'Parent Slideshow', 'twentytwentytwo' ),
		'not_found'          => esc_html__( 'Nenhum Slideshows encontrado', 'twentytwentytwo' ),
		'not_found_in_trash' => esc_html__( 'Nenhum Slideshows  removido', 'twentytwentytwo' ),
		'name'               => esc_html__( 'Slideshows', 'twentytwentytwo' ),
		'singular_name'      => esc_html__( 'Slideshow', 'twentytwentytwo' ),
	];

	$args = [
		'label'             => __( 'slideshow', 'twentytwentytwo' ),
		'labels'            => $labels,
		'supports'          => [
			'title',
			'excerpt',
			'thumbnail',
			'custom-fields'
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
		'menu_name'          => esc_html__( 'Salistas', 'twentytwentytwo' ),
		'name_admin_bar'     => esc_html__( 'Salista', 'twentytwentytwo' ),
		'add_new'            => esc_html__( 'Criar Salista', 'twentytwentytwo' ),
		'add_new_item'       => esc_html__( 'Criar Novo Salista', 'twentytwentytwo' ),
		'new_item'           => esc_html__( 'Novo Salista', 'twentytwentytwo' ),
		'edit_item'          => esc_html__( 'Editar Salista', 'twentytwentytwo' ),
		'view_item'          => esc_html__( 'Exibir Salista', 'twentytwentytwo' ),
		'update_item'        => esc_html__( 'Exibir Salista', 'twentytwentytwo' ),
		'all_items'          => esc_html__( 'Todos os Salistas', 'twentytwentytwo' ),
		'search_items'       => esc_html__( 'Search Salistas', 'twentytwentytwo' ),
		'parent_item_colon'  => esc_html__( 'Parent Salista', 'twentytwentytwo' ),
		'not_found'          => esc_html__( 'Nenhum Salistas encontrado', 'twentytwentytwo' ),
		'not_found_in_trash' => esc_html__( 'Nenhum Salistas  removido', 'twentytwentytwo' ),
		'name'               => esc_html__( 'Salistas', 'twentytwentytwo' ),
		'singular_name'      => esc_html__( 'Salista', 'twentytwentytwo' ),
	];

	$args = [
		'label'             => __( 'salista', 'twentytwentytwo' ),
		'labels'            => $labels,
		'supports'          => [
			'title',
			'excerpt',
			'thumbnail',
			'custom-fields'
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