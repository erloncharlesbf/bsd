<?php

add_action('rest_api_init', function () {
    register_rest_route( 'bsdesign/v1', '/vehicles/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'get_vehicle_by_id',
    ));

    register_rest_route( 'bsdesign/v1', '/vehicles', array(
        'methods' => 'GET',
        'callback' => 'get_all_vehicles',
        'args' => array(
            'paged' => array(
                'validate_callback' => function($param, $request, $key) {
                     return is_numeric( $param );
                }
            ),
            'per_page' => [
                'validate_callback' => function($param, $request, $key) {
                     return is_numeric( $param );
                }
            ],
            'brand' => [
                'validate_callback' => function($param, $request, $key) {
                    return is_numeric($param);
                }
            ],
            'car_doors' => [
                'validate_callback' => function($param, $request, $key) {
                    return is_numeric($param);
                }
            ],
            'color' => [
                'validate_callback' => function($param, $request, $key) {
                    return is_numeric($param);
                }
            ],
            'initial_price' => [
                'validate_callback' => function($param, $request, $key) {
                    return $request->get_param('end_price') > $param;
                }
            ],
            'end_price' => [
                'validate_callback' => function($param, $request, $key) {
                    return $request->get_param('initial_price') < $param;
                }
            ],
        ),
    ));

    register_rest_route( 'bsdesign/v1', '/vehicles/filters', [
        'methods' => 'GET',
        'callback' => 'get_vehicle_filters',
    ]);
});

/**
 * Exibe um veiculo pelo ID
 * @param WP_REST_Request $request
 * @return WP_REST_Response
 */
function get_vehicle_by_id(WP_REST_Request $request): WP_REST_Response
{
    $vehicle = get_post($request->get_param('id'));
    if ($vehicle->post_status !== 'publish') {
        return new WP_REST_Response(null, 404);
    }
    $data = get_vehicle_response($vehicle);

    return new WP_REST_Response(compact('data'));
}

/**
 * Lista todos os veiculos
 *
 * @param WP_REST_Request $request
 * @return WP_REST_Response
 */
function get_all_vehicles(WP_REST_Request $request): WP_REST_Response
{
    $paged = $request->get_param('paged') ?: 1;
    $per_page = $request->get_param('per_page') ?: -1;
    $brand = $request->get_param('brand');
    $car_doors = $request->get_param('car_doors');
    $color = $request->get_param('color');
    $initial_price = $request->get_param('initial_price');
    $end_price = $request->get_param('end_price');

    $filters = [];
    $args = ['post_type' => 'vehicles', 'posts_per_page' => $per_page, 'post_status' => 'publish', 'paged' => $paged];
    if (null !== $brand) {
        $filters[] = array(
            'key' => 'brand',
            'value' => $brand,
            'compare' => '=',
        );
    }

    if (null !== $car_doors) {
        $filters[] = array(
            'key' => 'car_doors',
            'value' => $car_doors,
            'compare' => '=',
        );
    }

    if (null !== $color) {
        $filters[] = array(
            'key' => 'color',
            'value' => $color,
            'compare' => '=',
        );
    }

    if (isset($initial_price, $end_price)) {
        $filters[] = [
            'key' => 'price',
            'value' => array($initial_price, $end_price),
            'compare' => 'BETWEEN',
            'type' => 'NUMERIC',
        ];
    }

    if (!empty($filters)) {
        $args['meta_query'] = $filters;
    }
    $vehicles = new WP_Query($args);

    $items = [];
    foreach ($vehicles->get_posts() as $vehicle) {
        $items[] = get_vehicle_response($vehicle);
    }

    $data = [
        'items' => $items,
        'per_page' => (int) $per_page,
        'current_page' => (int) $paged,
        'total' => $vehicles->post_count,
    ];

    return new WP_REST_Response(compact('data'));
}

/**
 * Lista os filtros disponiveis para serem utilizados na listagem dos veiculos
 *
 * @param WP_REST_Request $request
 * @return WP_REST_Response
 */
function get_vehicle_filters(WP_REST_Request $request): WP_REST_Response
{
    $data = [];

    $brands = get_terms([
        'taxonomy' => 'brands_categories',
        'hide_empty' => false,
    ]);

    $colors = get_terms([
        'taxonomy' => 'colors_categories',
        'hide_empty' => false,
    ]);

    $car_doors = get_terms([
        'taxonomy' => 'car_doors_categories',
        'hide_empty' => false,
    ]);

    $data['brands'] = array_map(static function($brand){
        return [
            'id' => $brand->term_id,
            'name' => $brand->name,
        ];
    }, $brands);

    $data['colors'] = array_map(static function($color){
        return [
            'id' => $color->term_id,
            'name' => $color->name,
        ];
    }, $colors);

    $data['car_doors'] = array_map(static function($car_door){
        return [
            'id' => $car_door->term_id,
            'name' => $car_door->name,
        ];
    }, $car_doors);

    return new WP_REST_Response(compact('data'));
}

/**
 * Gera o JSON do veiculo
 * @param $vehicle
 * @return array
 */
function get_vehicle_response($vehicle): array
{
    $vehicle_type = get_field('vehicle_type', $vehicle->ID);
    $brand = get_field('brand', $vehicle->ID);
    $color = get_field('color', $vehicle->ID);
    $price = get_field('price', $vehicle->ID);
    $car_doors = get_field('car_doors', $vehicle->ID);

    $add_ons = [];
    if (get_field('add_ons', $vehicle->ID)) {
        $add_ons = array_map(static function($add_on) {
            return $add_on->name;
        }, get_field('add_ons', $vehicle->ID));
    }

    if (get_field('gallery', $vehicle->ID)) {
        $gallery = array_map(static function($image_id) {
            return wp_get_attachment_url($image_id);
        }, explode(',', get_field('gallery', $vehicle->ID)));
    }

    return [
        'id' => $vehicle->ID,
        'post_title' => $vehicle->post_title,
        'post_content' => $vehicle->post_content,
        'post_date' => $vehicle->post_date,
        'color' => $color->name,
        'vehicle_type' => $vehicle_type->name,
        'brand' => $brand->name,
        'fuel' => get_field('fuel', $vehicle->ID),
        'year' => get_field('year', $vehicle->ID),
        'price' => number_format($price, 2, ',', '.'),
        'km' => get_field('km', $vehicle->ID),
        'fipe' => get_field('fipe', $vehicle->ID) ?: null,
        'car_doors' => $car_doors->name,
        'axle' => get_field('axle', $vehicle->ID) ? (int) get_field('axle', $vehicle->ID) : 0,
        'add_ons' => $add_ons,
        'whatsapp' => get_field('whatsapp', $vehicle->ID) ?: null,
        'thumbnail' => get_the_post_thumbnail_url($vehicle->ID),
        'gallery' => $gallery,
    ];
}