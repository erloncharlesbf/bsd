<?php

add_action( 'rest_api_init', function () {
	register_rest_route( 'bsd/v1', '/options', [
		'methods'  => 'GET',
		'callback' => 'get_options',
	] );
} );

/**
 * Lista todos os slideshows
 *
 * @param WP_REST_Request $request
 *
 * @return WP_REST_Response
 */
function get_options( WP_REST_Request $request ): WP_REST_Response {
	$data = [
		'name'        => get_option( 'blogname' ),
		'description' => get_option( 'blogdescription' ),
		'facebook'    => get_option( 'facebook_option' ),
		'instagram'   => get_option( 'instagram_option' ),
		'linkedin'    => get_option( 'linkedin_option' ),
		'whatsapp'    => get_option( 'whatsapp_option' ),
		'twitter'     => get_option( 'twitter_option' ),
		'youtube'     => get_option( 'youtube_option' ),
		'analytics'   => get_option( 'analytics_option' )
	];

	return new WP_REST_Response( compact( 'data' ) );
}
