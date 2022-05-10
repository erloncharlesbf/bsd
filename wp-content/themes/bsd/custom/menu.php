<?php

function theme_option_page(): void {
	?>
    <div class="wrap">
        <h1>Configurações do site</h1>
        <form method="post" action="options.php">
			<?php
			settings_fields( "theme-options-grp" );
			do_settings_sections( "theme-options" );
			submit_button();
			?>
        </form>
    </div>
	<?php
}

function add_theme_menu_item(): void {
	add_theme_page( "Configuração do site",
		"Configuração do site",
		"manage_options",
		"theme-options",
		"theme_option_page" );
}

add_action( "admin_menu", "add_theme_menu_item" );
function redes_sociais(): void {
	echo '<p>Configure suas redes sociais</p>';
}

function google_analytics(): void {
	echo '<p>Configure Google Analytics</p>';
}

function facebook_callback(): void {
	$options = get_option( 'facebook_option' );
	echo " <input name=\"facebook_option\" id=\"facebook_option\" type=\"url\" class=\"code\" value=\"$options\" />";
}

function instagram_callback(): void {
	$options = get_option( 'instagram_option' );
	echo " <input name=\"instagram_option\" id=\"instagram_option\" type=\"url\" class=\"code\" value=\"$options\" />";
}

function linkedin_callback(): void {
	$options = get_option( 'linkedin_option' );
	echo " <input name=\"linkedin_option\" id=\"linkedin_option\" type=\"url\" class=\"code\" value=\"$options\" />";
}

function whatsapp_callback(): void {
	$options = get_option( 'whatsapp_option' );
	echo " <input name=\"whatsapp_option\" id=\"whatsapp_option\" type=\"text\" class=\"code\" value=\"$options\" />";
}

function twitter_callback(): void {
	$options = get_option( 'twitter_option' );
	echo " <input name=\"twitter_option\" id=\"twitter_option\" type=\"url\" class=\"code\" value=\"$options\" />";
}

function youtube_callback(): void {
	$options = get_option( 'youtube_option' );
	echo " <input name=\"youtube_option\" id=\"youtube_option\" type=\"url\" class=\"code\" value=\"$options\" />";
}

function analytics_callback(): void {
	$options = get_option( 'analytics_option' );
	echo "<textarea name=\"analytics_option\" id=\"analytics_option\" class=\"code\" >$options</textarea>";
}

function bsd_theme_settings(): void {
	add_settings_section( 'first_section',
		'Redes Sociais',
		'redes_sociais',
		'theme-options' );
	add_settings_section( 'second_section',
		'Google Analytics',
		'google_analytics',
		'theme-options' );
	add_settings_field( 'facebook_option',
		'Facebook',
		'facebook_callback',
		'theme-options',
		'first_section' );
	add_settings_field( 'instagram_option',
		'Instagram',
		'instagram_callback',
		'theme-options',
		'first_section' );
	add_settings_field( 'linkedin_option',
		'linkedin',
		'linkedin_callback',
		'theme-options',
		'first_section' );
	add_settings_field( 'whatsapp_option',
		'WhatsApp',
		'whatsapp_callback',
		'theme-options',
		'first_section' );
	add_settings_field( 'twitter_option',
		'Twitter',
		'twitter_callback',
		'theme-options',
		'first_section' );
	add_settings_field( 'youtube_option',
		'Youtube',
		'youtube_callback',
		'theme-options',
		'first_section' );
	add_settings_field( 'analytics_option',
		'Google Analytics Code',
		'analytics_callback',
		'theme-options',
		'second_section' );

	register_setting( 'theme-options-grp', 'facebook_option' );
	register_setting( 'theme-options-grp', 'instagram_option' );
	register_setting( 'theme-options-grp', 'twitter_option' );
	register_setting( 'theme-options-grp', 'linkedin_option' );
	register_setting( 'theme-options-grp', 'whatsapp_option' );
	register_setting( 'theme-options-grp', 'youtube_option' );
	register_setting( 'theme-options-grp', 'analytics_option' );
}

add_action( 'admin_init', 'bsd_theme_settings' );