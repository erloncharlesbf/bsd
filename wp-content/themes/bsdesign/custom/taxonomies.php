<?php

function salista_categories_taxonomy() {
	register_taxonomy(
		'salista_categories',
		'salistas',
		array(
			'hierarchical' => true,
			'label'        => 'Categoria de Salista',
			'query_var'    => true,
			'rewrite'      => [ 'slug' => 'salista_categoria', ]
		)
	);
}

add_action( 'init', 'salista_categories_taxonomy' );


function torre_salista_taxonomy() {
	register_taxonomy(
		'torre_salista',
		'salistas',
		array(
			'hierarchical' => false,
			'label'        => 'Torre',
			'query_var'    => true,
			'rewrite'      => [ 'slug' => 'torre', ]
		)
	);
}

add_action( 'init', 'torre_salista_taxonomy' );
