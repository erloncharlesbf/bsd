<?php

function bsd_settings(): void {
	add_settings_section(
		'first_section', //section name for the section to add
		'New Reading Settings', //section title visible on the page
		'reading_section_description', //section description
		'Reading'//page to which section will be added.
	);

	add_settings_field(
		'first_field_option', //ID for the settings field to add
		'TestField', //settings title visible on the page
		'options_callback', //callback for displaying the settings field
		'Reading', // settings page to where option is displayed
		'first_section'// section id for parent section.
	);
}

//callback for displaying setting description
function reading_section_description(): void {
	echo '<p>This is the new Reading section. </p>';
}

//callback for displaying the setting field
function options_callback( $args ): void {
	echo '<p>This is the new Reading setting callback. </p>';
}

//admin hook defined in functions.php. This calls the above function at
// initialization time.
add_action( 'admin_init', 'bsd_settings' );
