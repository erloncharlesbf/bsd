<?php

$includes = array(
	'custom/post-types.php',
	'custom/taxonomies.php',
	'custom/assets.php',
	'custom/helper.php',
	'custom/ajax.php',
	'custom/api.php',
);

foreach ($includes as $file) {
	if (!$filepath = locate_template($file)) {
		trigger_error(sprintf(__('Error locating %s for inclusion'), $file), E_USER_ERROR);
	}
	require_once $filepath;
}
unset($file, $filepath);

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' 	=> 'Informações da Loja',
        'menu_title'	=> 'Informações da Loja',
    ));
}