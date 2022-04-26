<?php

function vehicle_post_type() {

    $labels = array(
        'name'                => __( 'Veículos', 'twentytwenty' ),
        'singular_name'       => __( 'Veículo', 'twentytwenty' ),
        'menu_name'           => __( 'Veículos', 'twentytwenty' ),
        'parent_item_colon'   => __( 'Parent Veículo', 'twentytwenty' ),
        'all_items'           => __( 'Todos os Veículos', 'twentytwenty' ),
        'view_item'           => __( 'Visualizar Veículo', 'twentytwenty' ),
        'add_new_item'        => __( 'Add Novo Veículo', 'twentytwenty' ),
        'add_new'             => __( 'Adicionar Veículo', 'twentytwenty' ),
        'edit_item'           => __( 'Edit Veículo', 'twentytwenty' ),
        'update_item'         => __( 'Atualizar Veículo', 'twentytwenty' ),
        'search_items'        => __( 'Pesquisar Veículos', 'twentytwenty' ),
        'not_found'           => __( 'Nenhum Veículo encontrada', 'twentytwenty' ),
        'not_found_in_trash'  => __( 'Nenhum Veículo encontrada na lixeira', 'twentytwenty' ),
    );

    $args = array(
        'label'               => __( 'veiculos', 'twentytwenty' ),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'),
        'taxonomies'          => array('vehicle_type_categories', 'bodywork_type_categories', 'colors_categories', 'car_doors_categories', 'brands_categories', 'add_ons_categories'),
        'menu_icon'           => 'dashicons-performance',
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'show_in_rest'        => true,
        'rewrite'             => array('slug' => 'veiculos'),
    );

    register_post_type( 'vehicles', $args );
}
add_action( 'init', 'vehicle_post_type', 0 );