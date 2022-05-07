<?php

add_action( 'rest_api_init', function () {
	register_rest_route( 'bsd/v1', '/salistas', [
		'methods'  => 'GET',
		'callback' => 'get_all_salistas',
		'args'     => [
			'paged'    => [ 'validate_callback' => fn( $param, $request, $key ) => is_numeric( $param ) ],
			'per_page' => [ 'validate_callback' => fn( $param, $request, $key ) => is_numeric( $param ) ],
			'active'   => [ 'validate_callback' => fn( $param, $request, $key ) => is_numeric( $param ) ],
		],
	] );
	register_rest_route( 'bsd/v1', '/salistas/categories', [
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
	$paged    = $request->get_param( 'paged' ) ?: 1;
	$per_page = $request->get_param( 'per_page' ) ?: - 1;
	$active   = $request->get_param( 'active' );

	$filters = [];
	$args    = [
		'post_type'      => 'salistas',
		'posts_per_page' => $per_page,
		'post_status'    => 'publish',
		'paged'          => $paged
	];
	if ( $active !== null ) {
		$filters[] = [
			'key'     => 'active',
			'value'   => $active,
			'compare' => '=',
		];
	}

	if ( ! empty( $filters ) ) {
		$args['meta_query'] = $filters;
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
		'total'        => $salistas->post_count,
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
function get_salista_categories( WP_REST_Request $request ): WP_REST_Response {
	$paged    = $request->get_param( 'paged' ) ?: 1;
	$per_page = $request->get_param( 'per_page' ) ?: - 1;
	$items = array_map(
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
		'total'        => count($items),
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
	$data = [];

	$data['categories'] = array_map(
		static fn( $brand ) => [ 'id' => $brand->term_id, 'name' => $brand->name, ],
		get_terms( [ 'taxonomy' => 'torre_salista', 'hide_empty' => false, ] )
	);

	return new WP_REST_Response( compact( 'data' ) );
}

function format_salista( $salista ): array {
	return [
		'andar'                    => get_field( 'andar', $salista->ID ),
		'content'                  => $salista->post_content,
		'descricao'                => get_field( 'descricao', $salista->ID ),
		'e-mail'                   => get_field( 'e-mail', $salista->ID ),
		'facebook'                 => get_field( 'facebook', $salista->ID ),
		'horario_de_funcionamento' => get_field( 'horario_de_funcionamento', $salista->ID ),
		'id'                       => $salista->ID,
		'instagram'                => get_field( 'instagram', $salista->ID ),
		'legend'                   => $salista->post_excerpt,
		'linkedin'                 => get_field( 'linkedin', $salista->ID ),
		'name'                     => $salista->post_title,
		'sala'                     => get_field( 'andar', $salista->ID ),
		'site'                     => get_field( 'site', $salista->ID ),
		'torre'                    => get_the_terms( $salista->ID, 'torre_salista' ),
		'telefone_de_contato'      => get_field( 'telefone_de_contato', $salista->ID ),
		'thumbnail'                => get_the_post_thumbnail_url( $salista->ID, 'full' ),
		'whatsapp'                 => get_field( 'whatsapp', $salista->ID ),
		'youtube'                  => get_field( 'youtube', $salista->ID ),
	];
}