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
	register_rest_route( 'bsd/v1', '/slideshows/categories', [
		'methods'  => 'GET',
		'callback' => 'get_slideshow_categories',
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

	$args = [
		'post_type'      => 'slideshows',
		'posts_per_page' => $per_page,
		'post_status'    => 'publish',
		'paged'          => $paged,
	];

	$slideshows = new WP_Query( $args );

	$items = array_map( static fn( $slideshow ) => format_slideshow( $slideshow ), $slideshows->get_posts() );

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
function get_slideshow_categories( WP_REST_Request $request ): WP_REST_Response {
	$paged    = $request->get_param( 'paged' ) ?: 1;
	$per_page = $request->get_param( 'per_page' ) ?: - 1;

	$items = array_map(
		static fn( $brand ) => [ 'id' => $brand->term_id, 'name' => $brand->name, ],
		get_terms( [ 'taxonomy' => 'category', 'hide_empty' => false, ] )
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
 * @param $slideshow
 *
 * @return array
 */
function format_slideshow( $slideshow ): array {
	return [
		'imagem_desktop' => get_field( 'imagem_desktop', $slideshow->ID ),
		'imagem_mobile'  => get_field( 'imagem_mobile', $slideshow->ID ),
		'legend'         => $slideshow->post_excerpt,
		'link'           => get_field( 'link', $slideshow->ID ),
		'name'           => $slideshow->post_name,
		'new_window'     => get_field( 'abrir_em_nova_aba', $slideshow->ID ),
		'ordem'          => (int) get_field( 'order', $slideshow->ID ),
		'status'         => (bool) get_field( 'status', $slideshow->ID ),
		'title'          => $slideshow->post_title,
		'thumbnail'      => get_the_post_thumbnail_url( $slideshow->ID, 'full' ),
	];
}