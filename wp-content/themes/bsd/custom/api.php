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
		$items[] = $slideshow->to_array() + get_fields( $slideshow->ID );
	}

	$data = [
		'items'        => $items,
		'per_page'     => (int) $per_page,
		'current_page' => (int) $paged,
		'total'        => $slideshows->post_count,
	];

	return new WP_REST_Response( compact( 'data' ) );
}