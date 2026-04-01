<?php
/**
* loads every component associated with the customizer. 
*
* @since Pixel Ebook Store 1.0.0
*/

function pixel_ebook_store_modify_default_settings( $wp_customize ){

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

}
add_action( 'customize_register', 'pixel_ebook_store_modify_default_settings' );