<?php

add_action( 'rest_api_init', function () {
	register_rest_route( 'bsd/v1', '/slideshows', [
		'methods'  => 'GET',
		'callback' => 'get_all_slideshows',
		'args'     => [
			'paged'    => [ 'validate_callback' => fn( $param, $request, $key ) => is_numeric( $param ) ],
			'per_page' => [ 'validate_callback' => fn( $param, $request, $key ) => is_numeric( $param ) ],
			'active'   => [ 'validate_callback' => fn( $param, $request, $key ) => is_numeric( $param ) ],
		],
	] );
	register_rest_route( 'bsd/v1', '/slideshows/filters', [
		'methods'  => 'GET',
		'callback' => 'get_slideshow_filters',
	] );
} );

/**
 * Lista todos os slideshows
 *
 * @param WP_REST_Request $request
 *
 * @return WP_REST_Response
 */
function get_all_slideshows( WP_REST_Request $request ): WP_REST_Response {
	$paged    = $request->get_param( 'paged' ) ?: 1;
	$per_page = $request->get_param( 'per_page' ) ?: - 1;
	$active   = $request->get_param( 'active' );

	$filters = [];
	$args    = [
		'post_type'      => 'slideshows',
		'posts_per_page' => $per_page,
		'post_status'    => 'publish',
		'paged'          => $paged
	];
	if ( null !== $active ) {
		$filters[] = [
			'key'     => 'active',
			'value'   => $active,
			'compare' => '=',
		];
	}

	if ( ! empty( $filters ) ) {
		$args['meta_query'] = $filters;
	}
	$slideshows = new WP_Query( $args );

	$items = [];

	foreach ( $slideshows->get_posts() as $slideshow ) {
		$items[] = format_slideshow( $slideshow );
	}

	$data = [
		'items'        => $items,
		'per_page'     => (int) $per_page,
		'current_page' => (int) $paged,
		'total'        => $slideshows->post_count,
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
function get_slideshow_filters( WP_REST_Request $request ): WP_REST_Response {
	$data = [];

	$categories = get_terms( [
		'taxonomy'   => 'categories',
		'hide_empty' => false,
	] );

	$data['categories'] = array_map(
		static fn( $brand ) => [ 'id' => $brand->term_id, 'name' => $brand->name, ],
		$categories
	);

	return new WP_REST_Response( compact( 'data' ) );
}

/**
 * @param $slideshow
 *
 * @return array
 */
function format_slideshow( $slideshow ): array {
	return [
		'name'           => $slideshow->post_title,
		'legend'         => $slideshow->post_excerpt,
		'link'           => get_field( 'link', $slideshow->ID ),
		'new_window'     => get_field( 'abrir_em_nova_aba', $slideshow->ID ),
		'imagem_desktop' => get_field( 'imagem_desktop', $slideshow->ID ),
		'imagem_mobile'  => get_field( 'imagem_mobile', $slideshow->ID ),
		'ordem'          => get_field( 'order', $slideshow->ID ),
		'status'         => get_field( 'status', $slideshow->ID ),
	];
}