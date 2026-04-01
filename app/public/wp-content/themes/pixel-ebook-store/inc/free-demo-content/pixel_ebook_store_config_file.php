<?php
/**
 * Settings for theme wizard
 *
 * @package Whizzie
 * @author Catapult Themes
 * @since 1.0.0
 */

/**
 * Define constants
 **/
if ( ! defined( 'WHIZZIE_DIR' ) ) {
	define( 'WHIZZIE_DIR', dirname( __FILE__ ) );
}
// Load the Whizzie class and other dependencies
require trailingslashit( WHIZZIE_DIR ) . 'free-content.php';
// Gets the theme object
$current_theme = wp_get_theme();
$theme_title = $current_theme->get( 'Name' );

/**
 * Make changes below
 **/

// Change the title and slug of your wizard page
$pixel_ebook_store_config['pixel_ebook_store_page_slug'] 	= 'pixel-ebook-store';
$pixel_ebook_store_config['pixel_ebook_store_page_title']	= 'Free Demo Content';

// You can remove elements here as required
// Don't rename the IDs - nothing will break but your changes won't get carried through
$pixel_ebook_store_config['steps'] = array(
	'intro' => array(
		'id'			=> 'intro',
		'title'			=> __( 'Welcome to ', 'pixel-ebook-store' ) . $theme_title,
		'icon'			=> 'dashboard',
		'button_text'	=> __( 'System Status', 'pixel-ebook-store' ),
		'can_skip'		=> false,
	),
	'plugins' => array(
		'id'			=> 'plugins',
		'title'			=> __( 'Plugins', 'pixel-ebook-store' ),
		'icon'			=> 'admin-plugins',
		'button_text'	=> __( 'Install Plugins', 'pixel-ebook-store' ),
		'can_skip'		=> true,
	),
	'widgets' => array(
		'id'			=> 'widgets',
		'title'			=> __( 'Free Demo Content', 'pixel-ebook-store' ),
		'icon'			=> 'welcome-widgets-menus',
		'button_text_one'	=> __( 'Click On The Image To Import Customizer Demo', 'pixel-ebook-store' ),
		'button_text_two'	=> __( 'Click On The Image To Import Gutenberg Block Demo', 'pixel-ebook-store' ),
		'can_skip'		=> true,
	),
	'done' => array(
		'id'			=> 'done',
		'title'			=> __( 'All Done', 'pixel-ebook-store' ),
		'icon'			=> 'yes',
	)
);

/**
 * This kicks off the wizard
 **/
if( class_exists( 'PixelEbookStoreThemeWhizzie' ) ) {
	$PixelEbookStoreThemeWhizzie = new PixelEbookStoreThemeWhizzie( $pixel_ebook_store_config );
}
