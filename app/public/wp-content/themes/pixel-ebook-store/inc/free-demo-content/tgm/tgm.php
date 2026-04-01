<?php
require get_template_directory() . '/inc/free-demo-content/tgm/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function pixel_ebook_store_register_recommended_plugins_set() {
	$plugins = array(
		array(
			'name'             => __( 'Classic Widgets', 'pixel-ebook-store' ),
			'slug'             => 'classic-widgets',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
	);
	$pixel_ebook_store_config = array();
	tgmpa( $plugins, $pixel_ebook_store_config );
}
add_action( 'tgmpa_register', 'pixel_ebook_store_register_recommended_plugins_set' );
