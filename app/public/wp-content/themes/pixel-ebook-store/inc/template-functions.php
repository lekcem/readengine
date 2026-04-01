<?php
/**
 * Features that improve the theme by integrating with WordPress
 *
 * @package Pixel Ebook Store
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function pixel_ebook_store_body_classes( $classes ) {
	// Adds a class of theme skin
	if( get_theme_mod( 'skin_select', 'default' ) == 'dark' ){
		$classes[] = 'dark-skin';
	}elseif( get_theme_mod( 'skin_select', 'default' ) == 'blackwhite' ){
		$classes[] = 'black-white-skin';
	}else{
		$classes[] = 'default-skin';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'pixel_ebook_store_body_classes' );

/**
 * Page/Post title in frontpage and blog
 */
function pixel_ebook_store_page_title_display() {
	if ( is_singular() || ( !is_home() && is_front_page() ) ): ?>
		<h1 class="page-title entry-title"><?php single_post_title(); ?></h1>
	<?php elseif ( is_archive() ) : 
		the_archive_title( '<h1 class="page-title">', '</h1>' );
	elseif ( is_search() ) : ?>
		<h1 class="page-title entry-title">
			<?php // translators: %s is the search query
		 		printf( esc_html__( 'Search Results for: %s', 'pixel-ebook-store' ), get_search_query() ); 
			?>
		</h1>
	<?php elseif ( is_404() ) :
		echo '<h1 class="page-title entry-title">' . esc_html__( 'Oops! That page can&#39;t be found.', 'pixel-ebook-store' ) . '</h1>';
	endif;
}

/**
 * Adds custom size in images and fallback to a default image if no featured image is available
 */
function pixel_ebook_store_image_size( $pixel_ebook_store_image_size ) {
    // Get the post's featured image ID
    $pixel_ebook_store_image_id = get_post_thumbnail_id();

    // If a featured image is set, use it, otherwise fallback to a default image
    if ( $pixel_ebook_store_image_id ) {
        // Get the alt text for the featured image
        $pixel_ebook_store_alt_text = esc_attr( get_post_meta( $pixel_ebook_store_image_id, '_wp_attachment_image_alt', true ) );
        
        // Display the post thumbnail
        the_post_thumbnail( $pixel_ebook_store_image_size, array( 'alt' => $pixel_ebook_store_alt_text ) );
    } else {
        // Get the default image URL from the theme's 'images' folder
        $pixel_ebook_store_default_image_url = get_template_directory_uri() . '/assets/images/default-posts-image.png'; // Adjust the path as necessary
        
        // Display the default image with proper escaping
        echo '<img src="' . esc_url( $pixel_ebook_store_default_image_url ) . '" alt="' . esc_attr__( 'Default Image', 'pixel-ebook-store' ) . '" />';
    }
}

/* Breadcrumb Begin */
function pixel_ebook_store_breadcrumb_function() {
	if (!is_home()) {
		echo '<a href="';
			echo esc_url( home_url() );
		echo '">';
			bloginfo('name');
		echo "</a> ";
		if (is_category() || is_single()) {
			the_category(',');
			if (is_single()) {
				echo "<span> ";
					the_title();
				echo "</span> ";
			}
		} elseif (is_page()) {
			echo "<span> ";
				the_title();
		}
	}
}

/**
* Adds a submit button in search form
* 
* @since Pixel Ebook Store 1.0.0
* @param string $form
* @return string
*/
function pixel_ebook_store_modify_search_form( $form ){
	return str_replace( '</form>', '<button type="submit" class="search-button"><span class="fas fa-search"></span></button></form>', $form );
}
add_filter( 'get_search_form', 'pixel_ebook_store_modify_search_form' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function pixel_ebook_store_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'pixel_ebook_store_pingback_header' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pixel_ebook_store_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'pixel_ebook_store_content_width', 720 );
}
add_action( 'after_setup_theme', 'pixel_ebook_store_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @since Pixel Ebook Store 1.0.0
 */
function pixel_ebook_store_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'pixel-ebook-store' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'pixel-ebook-store' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title-wrap"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	));

	for( $i = 1; $i <= 4; $i++ ){
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar', 'pixel-ebook-store' ) . ' ' . $i,
			'id'            => 'footer-sidebar-' . $i,
			'description'   => esc_html__( 'Add widgets here.', 'pixel-ebook-store' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="footer-item">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
}
add_action( 'widgets_init', 'pixel_ebook_store_widgets_init' );


if( ! function_exists( 'pixel_ebook_store_sort_category' ) ):
/**
 * Helper function for pixel_ebook_store_get_the_category()
 *
 * @since Pixel Ebook Store 1.0.0
 */
function pixel_ebook_store_sort_category( $a, $b ){
    return $a->term_id < $b->term_id;
}
endif;

/**
 * To disable archive prefix title.
 * @since Pixel Ebook Store 1.0.0
 */

function pixel_ebook_store_modify_archive_title( $title ) {
	if( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
    } elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>' ;
    } elseif ( is_year() ) {
        $title = get_the_date( _x( 'Y', 'yearly archives date format', 'pixel-ebook-store' ) );
    } elseif ( is_month() ) {
        $title = get_the_date( _x( 'F Y', 'monthly archives date format', 'pixel-ebook-store' ) );
    } elseif ( is_day() ) {
        $title = get_the_date( _x( 'F j, Y', 'daily archives date format', 'pixel-ebook-store' ) );
     } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }

	return $title;
}

add_filter( 'get_the_archive_title', 'pixel_ebook_store_modify_archive_title' );

if( ! function_exists( 'pixel_ebook_store_get_the_category' ) ):
/**
* Returns categories after sorting by term id descending
* 
* @since Pixel Ebook Store 1.0.0
* @uses pixel_ebook_store_sort_category()
* @return array
*/
function pixel_ebook_store_get_the_category( $id = false ){
    $failed = true;

    if( !$id ){
        $id = get_the_id();
    }
    
    # Check if Yoast Plugin is installed 
    # If yes then, get Primary category, set by Plugin

    if ( class_exists( 'WPSEO_Primary_Term' ) ){

        # Show the post's 'Primary' category, if this Yoast feature is available, & one is set
        $wpseo_primary_term = new WPSEO_Primary_Term( 'category', $id );
        $wpseo_primary_term = $wpseo_primary_term->get_primary_term();

        $pixel_ebook_store_cat[0] = get_term( $wpseo_primary_term );

        if ( !is_wp_error( $pixel_ebook_store_cat[0] ) ) { 
           $failed = false;
        }
    }

    if( $failed ){

      $pixel_ebook_store_cat = get_the_category( $id );
      usort( $pixel_ebook_store_cat, 'pixel_ebook_store_sort_category' );  
    }
    
    return $pixel_ebook_store_cat;
}

endif;

/**
* Get post categoriesby by term id
* 
* @since Pixel Ebook Store 1.0.0
* @uses pixel_ebook_store_get_post_categories()
* @return array
*/
function pixel_ebook_store_get_post_categories(){

	$terms = get_terms( array(
	    'taxonomy' => 'category',
	    'hide_empty' => true,
	) );

	if( empty($terms) || !is_array( $terms ) ){
		return array();
	}

	$data = array();
	foreach ( $terms as $key => $value) {
		$term_id = absint( $value->term_id );
		$data[$term_id] =  esc_html( $value->name );
	}
	return $data;

}

/**
* Get Custom Logo URL
* 
* @since Pixel Ebook Store 1.0.0
*/
function pixel_ebook_store_get_custom_logo_url(){
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
    if ( is_array($image) ){
	    return $image[0];
	}else{
		return '';
	}
}

if( !function_exists( 'pixel_ebook_store_get_intermediate_image_sizes' ) ){
	/**
	* Array of image sizes.
	* 
	* @since Pixel Ebook Store 1.3.6
	* @return array
	*/
	function pixel_ebook_store_get_intermediate_image_sizes(){

		$data 	= array(
			'full'			=> esc_html__( 'Full Size', 'pixel-ebook-store' ),
			'large'			=> esc_html__( 'Large Size', 'pixel-ebook-store' ),
			'medium'		=> esc_html__( 'Medium Size', 'pixel-ebook-store' ),
			'medium_large'	=> esc_html__( 'Medium Large Size', 'pixel-ebook-store' ),
			'thumbnail'		=> esc_html__( 'Thumbnail Size', 'pixel-ebook-store' ),
			'1536x1536'		=> esc_html__( '1536x1536 Size', 'pixel-ebook-store' ),
			'2048x2048'		=> esc_html__( '2048x2048 Size', 'pixel-ebook-store' ),
			'pixel-ebook-store-1920-550' => esc_html__( '1920x550 Size', 'pixel-ebook-store' ),
			'pixel-ebook-store-1370-550'	=> esc_html__( '1370x550 Size', 'pixel-ebook-store' ),
			'pixel-ebook-store-590-310'	=> esc_html__( '590x310 Size', 'pixel-ebook-store' ),
			'pixel-ebook-store-420-380'	=> esc_html__( '420x380 Size', 'pixel-ebook-store' ),
			'pixel-ebook-store-420-300'	=> esc_html__( '420x300 Size', 'pixel-ebook-store' ),
			'pixel-ebook-store-420-200'	=> esc_html__( '420x200 Size', 'pixel-ebook-store' ),
			'pixel-ebook-store-290-150'	=> esc_html__( '290x150 Size', 'pixel-ebook-store' ),
			'pixel-ebook-store-80-60'	=> esc_html__( '80x60 Size', 'pixel-ebook-store' ),
		);
		
		return $data;

	}
}