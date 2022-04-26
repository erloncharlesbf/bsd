<?php

function vehicle_type_taxonomy() {
    register_taxonomy(
        'vehicle_type_categories',
        'vehicles',
        array(
            'hierarchical' => true,
            'label' => 'Tipos de Veículos',
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'tipo-veiculos',
            )
        )
    );
}
add_action( 'init', 'vehicle_type_taxonomy');

function bodywork_type_taxonomy() {
    register_taxonomy(
        'bodywork_type_categories',
        'vehicles',
        array(
            'hierarchical' => true,
            'label' => 'Tipos de Carroceria',
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'tipo-carroceria',
            )
        )
    );
}
add_action( 'init', 'bodywork_type_taxonomy');

function colors_taxonomy() {
    register_taxonomy(
        'colors_categories',
        'vehicles',
        array(
            'hierarchical' => true,
            'label' => 'Cores',
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'cores',
            )
        )
    );
}
add_action( 'init', 'colors_taxonomy');

function car_doors_taxonomy() {
    register_taxonomy(
        'car_doors_categories',
        'vehicles',
        array(
            'hierarchical' => true,
            'label' => 'Portas',
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'portas',
            )
        )
    );
}
add_action( 'init', 'car_doors_taxonomy');

function brand_taxonomy()
{
    register_taxonomy(
        'brands_categories',
        'vehicles',
        array(
            'hierarchical' => true,
            'label' => 'Marcas',
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'marcas',
            )
        )
    );
}
add_action( 'init', 'brand_taxonomy');

function add_ons_taxonomy()
{
    register_taxonomy(
        'add_ons_categories',
        'vehicles',
        array(
            'hierarchical' => true,
            'label' => 'Opcionais',
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'opcionais',
            )
        )
    );
}
add_action( 'init', 'add_ons_taxonomy');
