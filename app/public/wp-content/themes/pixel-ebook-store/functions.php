<?php
/**
 * Pixel Ebook Store functions and definitions
 *
 * @package Pixel Ebook Store
 */

if ( ! function_exists( 'pixel_ebook_store_setup' ) ) :
	function pixel_ebook_store_setup() {
		
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'woocommerce' );

		load_theme_textdomain( 'pixel-ebook-store', get_template_directory() . '/languages' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Post thumbnail support should be enabled for pages and posts.
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'pixel-ebook-store' ),
			'menu-2' => esc_html__( 'Footer', 'pixel-ebook-store' ),
		) );

		/*
		 * To produce valid HTML5, change the default core markup for the comments, search form, and search form.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		
		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'width'       => 270,
			'height'      => 80,
			'flex-height' => true,
			'flex-width'  => true,
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add custom image size.
		add_image_size( 'pixel-ebook-store-1920-550', 1920, 550, true );
		add_image_size( 'pixel-ebook-store-1370-550', 1370, 550, true );
		add_image_size( 'pixel-ebook-store-590-310', 590, 310, true );
		add_image_size( 'pixel-ebook-store-420-380', 420, 380, true );
		add_image_size( 'pixel-ebook-store-420-300', 420, 300, true );
		add_image_size( 'pixel-ebook-store-420-200', 420, 200, true );
		add_image_size( 'pixel-ebook-store-290-150', 290, 150, true );
		add_image_size( 'pixel-ebook-store-80-60', 80, 60, true );
		
		add_theme_support( 'align-wide' );
		add_theme_support( 'wp-block-styles' );

		add_theme_support( 'custom-background', apply_filters( 'pixel_ebook_store_custom_background', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));
        
        add_theme_support( 'responsive-embeds' );

		add_theme_support('custom-header', array(
			'default-image'      => '',
			'width'              => 1920,
			'height'             => 200,
			'flex-height'        => true,
			'flex-width'         => true,
			'uploads'            => true,
		));

		/*
		* Enable support for Post Formats.
		*
		* See: https://codex.wordpress.org/Post_Formats
		*/
		add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

		define('PIXEL_EBOOK_STORE_BUY_NOW',__('https://www.themepixels.net/products/bookstore-wordpress-theme/','pixel-ebook-store'));
		define('PIXEL_EBOOK_STORE_LIVE_DEMO',__('https://themepixels.net/demo-site/pixel-ebook-store/','pixel-ebook-store'));
		define('PIXEL_EBOOK_STORE_FREE_DOC',__('https://www.themepixels.net/docs/pixel-ebook-store-free/','pixel-ebook-store'));
		define('PIXEL_EBOOK_STORE_BUNDLE',__('https://www.themepixels.net/products/wp-theme-bundle/','pixel-ebook-store'));
		define('PIXEL_EBOOK_STORE_THEME_SUPPORT',__('https://wordpress.org/support/theme/pixel-ebook-store','pixel-ebook-store'));

		/**
		* FREE DEMO CONTENT.
		*/
		require get_template_directory() . '/inc/free-demo-content/pixel_ebook_store_config_file.php';

	}
endif;
add_action( 'after_setup_theme', 'pixel_ebook_store_setup' );

/**
 * Enqueue scripts and styles.
 */
function pixel_ebook_store_scripts() {

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.css' );

	if ( is_rtl() ){
		wp_enqueue_style( 'bootstrap-rtl', get_template_directory_uri() . '/assets/bootstrap/css/rtl/bootstrap.min.css' );

		wp_enqueue_style( 'pixel-ebook-store-rtl-style', get_template_directory_uri() . '/rtl.css' );
	}

	// Theme stylesheet.
	wp_enqueue_style( 'pixel-ebook-store-style', get_stylesheet_uri() );
	require get_parent_theme_file_path( '/extra-pixel-customize.php' );
	wp_add_inline_style( 'pixel-ebook-store-style',$pixel_ebook_store_pix_theme_css );

	wp_enqueue_style( 'pixel-ebook-store-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/font-awesome/css/all.min.css' );
	
	wp_enqueue_style( 'owl.carousel.css', get_template_directory_uri() . '/assets/css/owl.carousel.css' );
	wp_enqueue_style( 'josefin-google-font', 'https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap', false );
	wp_enqueue_style( 'poppins-google-font', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', false );

	$scripts = array(
		array(
			'id'     => 'bootstrap',
			'url'    => get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.js',
			'footer' => true
		),
		array(
			'id'     => 'owl.carousel.js',
			'url'    => get_template_directory_uri() . '/assets/js/owl.carousel.js',
			'footer' => true
		),
		array(
			'id'     => 'pixel-ebook-store-custom',
			'url'    => get_template_directory_uri() . '/assets/js/custom.js',
			'footer' => true
		)
	);

	pixel_ebook_store_add_scripts( $scripts );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pixel_ebook_store_scripts' );

// Change number or products per row to 6
	add_filter('loop_shop_columns', 'pixel_ebook_store_loop_columns');
	if (!function_exists('pixel_ebook_store_loop_columns')) {
		function pixel_ebook_store_loop_columns() {
			$pixel_ebook_store_columns = get_theme_mod( 'pixel_ebook_store_per_columns', 3 );
			return $pixel_ebook_store_columns;
		}
	}

	//Change number of products that are displayed per page (shop page)
	add_filter( 'loop_shop_per_page', 'pixel_ebook_store_per_page', 10 );
	function pixel_ebook_store_per_page( $pixel_ebook_store_cols ) {
	  	$pixel_ebook_store_cols = get_theme_mod( 'pixel_ebook_store_product_per_page', 10 );
		return $pixel_ebook_store_cols;
	}

	function pixel_ebook_store_sanitize_number_absint( $number, $setting ) {
		// Ensure $number is an absolute integer (whole number, zero or greater).
		$number = absint( $number );

		// If the input is an absolute integer, return it; otherwise, return the default
		return ( $number ? $number : $setting->default );
	}


function pixel_ebook_store_sanitize_number_range( $number, $setting ) {

	// Ensure input is an absolute integer.
	$number = absint( $number );

	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;

	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );

	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );

	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );

	// If the number is within the valid range, return it; otherwise, return the default
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}

function pixel_ebook_store_sanitize_checkbox( $input ) {
    // Boolean check
    return ( ( isset( $input ) && true == $input ) ? true : false );
}

/*radio button sanitization*/
function pixel_ebook_store_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}


/**
* Add script
* 
* @since Pixel Ebook Store 1.0.0
*/
function pixel_ebook_store_add_scripts( $scripts ){
	foreach ( $scripts as $key => $value ) {
		wp_enqueue_script( $value['id'] , $value['url'] , array( 'jquery', 'jquery-masonry' ), 0.8, $value['footer'] );
	}
}

/**
 * Sanitizes Image Upload.
 *
 * @param string $input potentially dangerous data.
 */
function pixel_ebook_store_sanitize_image( $input ) {
	$filetype = wp_check_filetype( $input );
	if ( $filetype['ext'] && wp_ext2type( $filetype['ext'] ) === 'image' ) {
		return esc_url( $input );
	}
	return '';
}

// Sanitization function to ensure it's an integer within the range
function pixel_ebook_store_sanitize_number( $input ) {
    $input = absint( $input ); // Convert to a non-negative integer
    return ( $input >= 1 && $input <= 6 ) ? $input : 1; // Return input if within range, or default to 1
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Dynamic CSS.
 */
require get_template_directory() . '/inc/customizer/loader.php';

/**
* GET START.
*/
require get_template_directory() . '/themeinfo/pixel_ebook_store_themeinfo_page.php';

/**
 * Typography Fonts
 */
require get_template_directory() . '/inc/typography-settings/typography-fonts.php';

// NOTICE FUNCTION
function pixel_ebook_store_activation_notice() {
    if (get_option('pixel_ebook_store_notice_dismissed')) {
        return;
    }

    if (isset($_GET['page']) && $_GET['page'] === 'pixel-ebook-store-themeinfo-page') {
        return;
    }
    ?>
    <div class="updated notice notice-theme-info-class is-dismissible" data-notice="theme_info">
        <div class="pixel-ebook-store-theme-info-notice clearfix">
            <div class="pixel-ebook-store-theme-notice-content">
				<div class="notice-content">
					<div class="inner-notice-contetn">
						<h2 class="pixel-ebook-store-notice-h2">
							<?php
							printf(
								/* translators: 1: Theme name */
								esc_html__('Hello! Thank you for choosing our %1$s!', 'pixel-ebook-store'), '<strong>' . esc_html(wp_get_theme()->get('Name')) . '</strong>'
							);
							?>
						</h2>

						<p class="pixel-ebook-store-notice-p">
							<?php
							printf(
								/* translators: 1: Theme name */
								esc_html__('%1$s has been successfully installed and is ready for use. The links below will help you get started.', 'pixel-ebook-store'), '<strong>' . esc_html(wp_get_theme()->get('Name')) . '</strong>'
							);
							?>
						</p>
					</div>
					<div class="inner-notice-buttons">
						<a class="pixel-ebook-store-btn-theme-info button button-primary" target="_blank" href="<?php echo esc_url(admin_url('themes.php?page=pixel-ebook-store-themeinfo-page')); ?>" id="pixel-ebook-store-themeinfo-button"> <?php esc_html_e('Pixel Ebook Store Theme Information', 'pixel-ebook-store') ?></a>
						
						<a class="pixel-ebook-store-btn-theme-info button button-primary buy-noww" target="_blank" href="<?php echo esc_url(PIXEL_EBOOK_STORE_BUY_NOW); ?>" id="pixel-ebook-store-bundle-button"> <?php esc_html_e('Buy Now', 'pixel-ebook-store') ?></a>
						<a class="pixel-ebook-store-btn-theme-info button button-primary bundlee" target="_blank" href="<?php echo esc_url(PIXEL_EBOOK_STORE_BUNDLE); ?>" id="pixel-ebook-store-bundle-button"> <?php esc_html_e('Get All Themes', 'pixel-ebook-store') ?></a>
						<a class="pixel-ebook-store-btn-theme-info button button-primary live-demoo" target="_blank" href="<?php echo esc_url(PIXEL_EBOOK_STORE_LIVE_DEMO); ?>" id="pixel-ebook-store-bundle-button"> <?php esc_html_e('Live Demo', 'pixel-ebook-store') ?></a>
					</div>
				</div>
				<div class="notice-image">
					<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/bundle-img.png' ); ?>" alt="<?php esc_attr_e( 'Theme Screenshot', 'pixel-ebook-store' ); ?>">
				</div>
            </div>
        </div>
    </div>
    <?php
}

add_action('admin_notices', 'pixel_ebook_store_activation_notice');

add_action('wp_ajax_pixel_ebook_store_dismiss_notice', 'pixel_ebook_store_dismiss_notice');

function pixel_ebook_store_notice_status() {
    delete_option('pixel_ebook_store_notice_dismissed');
}
add_action('after_switch_theme', 'pixel_ebook_store_notice_status');

function pixel_ebook_store_dismiss_notice() {
    update_option('pixel_ebook_store_notice_dismissed', true);
    wp_send_json_success();
}

function pixel_ebook_store_admin_enqueue_scripts(){
	wp_enqueue_style('pixel-ebook-store-admin-style', esc_url( get_template_directory_uri() ) . '/assets/css/pixel-ebook-store-notice.css');
	wp_enqueue_script('pixel-ebook-store-dismiss-notice-script', get_stylesheet_directory_uri() . '/assets/js/pixel-ebook-store-notice.js', array('jquery'), null, true);
}
add_action( 'admin_enqueue_scripts', 'pixel_ebook_store_admin_enqueue_scripts' );

function pixel_ebook_store_remove_customize_register() {
    global $wp_customize;

    $wp_customize->remove_setting( 'display_header_text' );
    $wp_customize->remove_control( 'display_header_text' );

}

add_action( 'customize_register', 'pixel_ebook_store_remove_customize_register', 11 );