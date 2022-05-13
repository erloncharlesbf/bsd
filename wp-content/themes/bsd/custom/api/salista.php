<?php

add_action( 'rest_api_init', function () {
	register_rest_route( 'bsd/v1', '/salistas', [
		'methods'  => 'GET',
		'callback' => 'get_all_salistas',
		'args'     => [
			'paged'      => [ 'validate_callback' => fn( $param, $request, $key ) => is_numeric( $param ) ],
			'per_page'   => [ 'validate_callback' => fn( $param, $request, $key ) => is_numeric( $param ) ],
			'category'   => [ 'validate_callback' => fn( $param, $request, $key ) => is_string( $param ) ],
			'first_char' => [ 'validate_callback' => fn( $param, $request, $key ) => is_string( $param ) ],
		],
	] );

	register_rest_route( 'bsd/v1', '/salistas/(?P<slug>\S+)', [
		'methods'  => 'GET',
		'callback' => 'get_salista',
	] );

	register_rest_route( 'bsd/v1', '/salistas-categorias', [
		'methods'  => 'GET',
		'callback' => 'get_salista_categories',
	] );

	register_rest_route( 'bsd/v1', '/salistas/torres', [
		'methods'  => 'GET',
		'callback' => 'get_salista_torres',
	] );
} );

/**
 * Lista todos os slideshows
 *
 * @param WP_REST_Request $request
 *
 * @return WP_REST_Response
 */
function get_all_salistas( WP_REST_Request $request ): WP_REST_Response {
	global $wpdb;
	$paged      = $request->get_param( 'paged' ) ?: 1;
	$per_page   = $request->get_param( 'per_page' ) ?: - 1;
	$category   = $request->get_param( 'category' );
	$search     = $request->get_param( 'search' );
	$first_char = $request->get_param( 'first_char' );

	$args = [
		'posts_per_page' => $per_page,
		'paged'          => $paged,
		'orderby'        => 'title',
		'post_type'      => [ 'salistas' ],
		'post_status'    => [ 'publish' ],
		'order'          => 'ASC',
	];

	if ( $first_char ) {
		$postIds = $wpdb->get_col( $wpdb->prepare( "
	SELECT      ID
	FROM        $wpdb->posts
	WHERE       $wpdb->posts.post_title like %s
	AND 		$wpdb->posts.post_type = 'salistas'
	ORDER BY    $wpdb->posts.post_title",
			"$first_char%" ) );
		if ( ! $postIds ) {
			return new WP_REST_Response( [
				'items'        => [],
				'per_page'     => (int) $per_page,
				'current_page' => (int) $paged,
				'total'        => 0,
			] );
		}
		$args['post__in'] = $postIds;
	}

	if ( $search ) {
		$args['s'] = $search;
	}

	if ( $category ) {
		$args['tax_query'] = [
			[
				'taxonomy' => 'salista_categories',
				'terms'    => $category,
			],
		];
	}

	$salistas = new WP_Query( $args );

	$items = [];

	foreach ( $salistas->get_posts() as $salista ) {
		$items[] = format_salista( $salista );
	}

	$data = [
		'items'        => $items,
		'per_page'     => (int) $per_page,
		'current_page' => (int) $paged,
		'headers'      => [
			'first_chars' => array_values( array_unique( array_map( fn( $item ) => $item['nome'][0], $items ) ) ),
		],
		'total'        => $salistas->post_count,
	];

	return new WP_REST_Response( compact( 'data' ) );
}

function get_salista( WP_REST_Request $request ): WP_REST_Response {
	$salista = get_page_by_path( $request->get_url_params()['slug'], OBJECT, 'salistas' );
	if ( $salista === null ) {
		return new WP_REST_Response( [ 'error' => 'Salista Não encontrado' ], 404 );
	}

	$data = format_salista( $salista );

	return new WP_REST_Response( compact( 'data' ) );
}

/**
 * Lista os filtros disponiveis para serem utilizados na listagem dos veiculos
 *
 * @param WP_REST_Request $request
 *
 * @return WP_REST_Response
 */
function get_salista_categories( WP_REST_Request $request ): WP_REST_Response {
	$paged    = $request->get_param( 'paged' ) ?: 1;
	$per_page = $request->get_param( 'per_page' ) ?: - 1;
	$items    = array_map(
		static fn( $category ) => [
			'id'   => $category->term_id,
			'name' => $category->name,
			'icon' => get_field( 'icone', $category )
		],
		get_terms( [ 'taxonomy' => 'salista_categories', 'hide_empty' => false, ] )
	);

	$data = [
		'items'        => $items,
		'per_page'     => (int) $per_page,
		'current_page' => (int) $paged,
		'total'        => count( $items ),
	];

	return new WP_REST_Response( compact( 'data' ) );
}

/**
 * Lista os filtros disponiveis para serem utilizados na listagem dos veiculos
 *
 * @param WP_REST_Request $request
 *
 * @return WP_REST_Response
 */
function get_salista_torres( WP_REST_Request $request ): WP_REST_Response {
	$paged    = $request->get_param( 'paged' ) ?: 1;
	$per_page = $request->get_param( 'per_page' ) ?: - 1;

	$items = array_map(
		static fn( $brand ) => [ 'id' => $brand->term_id, 'name' => $brand->name, ],
		get_terms( [ 'taxonomy' => 'torre_salista', 'hide_empty' => false, ] )
	);

	$data = [
		'items'        => $items,
		'per_page'     => (int) $per_page,
		'current_page' => (int) $paged,
		'total'        => count( $items ),
	];

	return new WP_REST_Response( compact( 'data' ) );
}

function format_salista( $salista ): array {
	return [
		'andar'                    => get_field( 'andar', $salista->ID ),
		'content'                  => $salista->post_content,
		'email'                    => get_field( 'e-mail', $salista->ID ),
		'facebook'                 => get_field( 'facebook', $salista->ID ),
		'horario_de_funcionamento' => get_field( 'horario_de_funcionamento', $salista->ID ),
		'id'                       => $salista->ID,
		'instagram'                => get_field( 'instagram', $salista->ID ),
		'linkedin'                 => get_field( 'linkedin', $salista->ID ),
		'logo'                     => get_field( 'logo', $salista->ID ),
		'slug'                     => $salista->post_name,
		'sala'                     => get_field( 'sala', $salista->ID ),
		'site'                     => get_field( 'site', $salista->ID ),
		'imagem_desktop'           => get_field( 'imagem_desktop', $salista->ID ),
		'imagem_mobile'            => get_field( 'imagem_mobile', $salista->ID ),
		'telefone_de_contato'      => get_field( 'telefone_de_contato', $salista->ID ),
		'thumbnail'                => get_the_post_thumbnail_url( $salista->ID, 'full' ),
		'nome'                     => $salista->post_title,
		'torre'                    => get_the_terms( $salista->ID, 'torre_salista' )[0]->name,
		'whatsapp'                 => get_field( 'whatsapp', $salista->ID ),
		'youtube'                  => get_field( 'youtube', $salista->ID ),
	];
}