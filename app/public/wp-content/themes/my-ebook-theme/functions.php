<?php
/**
 * Ebook Store Theme Functions
 */

// Theme setup
function ebook_store_setup() {
    // Add theme support
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-logo');
    add_theme_support('responsive-embeds');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'ebook-store'),
        'footer' => __('Footer Menu', 'ebook-store'),
    ));
    
    // Set thumbnail sizes
    add_image_size('book-cover', 300, 450, true);
    add_image_size('author-photo', 200, 200, true);
}
add_action('after_setup_theme', 'ebook_store_setup');

// Register Custom Post Types
function ebook_store_cpt() {
    
    // Books CPT
    $book_labels = array(
        'name' => __('Books', 'ebook-store'),
        'singular_name' => __('Book', 'ebook-store'),
        'menu_name' => __('Books', 'ebook-store'),
        'add_new' => __('Add New Book', 'ebook-store'),
        'add_new_item' => __('Add New Book', 'ebook-store'),
        'edit_item' => __('Edit Book', 'ebook-store'),
        'new_item' => __('New Book', 'ebook-store'),
        'view_item' => __('View Book', 'ebook-store'),
        'search_items' => __('Search Books', 'ebook-store'),
        'not_found' => __('No books found', 'ebook-store'),
        'not_found_in_trash' => __('No books found in trash', 'ebook-store'),
    );
    
    $book_args = array(
        'labels' => $book_labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'books'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-book-alt',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
    );
    register_post_type('books', $book_args);
    
    // Authors CPT
    $author_labels = array(
        'name' => __('Authors', 'ebook-store'),
        'singular_name' => __('Author', 'ebook-store'),
        'menu_name' => __('Authors', 'ebook-store'),
        'add_new' => __('Add New Author', 'ebook-store'),
        'add_new_item' => __('Add New Author', 'ebook-store'),
        'edit_item' => __('Edit Author', 'ebook-store'),
        'new_item' => __('New Author', 'ebook-store'),
        'view_item' => __('View Author', 'ebook-store'),
        'search_items' => __('Search Authors', 'ebook-store'),
        'not_found' => __('No authors found', 'ebook-store'),
        'not_found_in_trash' => __('No authors found in trash', 'ebook-store'),
    );
    
    $author_args = array(
        'labels' => $author_labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'authors'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-businessperson',
        'supports' => array('title', 'editor', 'thumbnail'),
    );
    register_post_type('authors', $author_args);
}
add_action('init', 'ebook_store_cpt');

// Register Custom Taxonomies
function ebook_store_taxonomies() {
    
    // Genre Taxonomy
    $genre_labels = array(
        'name' => __('Genres', 'ebook-store'),
        'singular_name' => __('Genre', 'ebook-store'),
        'search_items' => __('Search Genres', 'ebook-store'),
        'all_items' => __('All Genres', 'ebook-store'),
        'parent_item' => __('Parent Genre', 'ebook-store'),
        'parent_item_colon' => __('Parent Genre:', 'ebook-store'),
        'edit_item' => __('Edit Genre', 'ebook-store'),
        'update_item' => __('Update Genre', 'ebook-store'),
        'add_new_item' => __('Add New Genre', 'ebook-store'),
        'new_item_name' => __('New Genre Name', 'ebook-store'),
        'menu_name' => __('Genres', 'ebook-store'),
    );
    
    $genre_args = array(
        'hierarchical' => true,
        'labels' => $genre_labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'genre'),
    );
    register_taxonomy('genre', array('books'), $genre_args);
    
    // Age Group Taxonomy
    $age_labels = array(
        'name' => __('Age Groups', 'ebook-store'),
        'singular_name' => __('Age Group', 'ebook-store'),
        'search_items' => __('Search Age Groups', 'ebook-store'),
        'all_items' => __('All Age Groups', 'ebook-store'),
        'parent_item' => __('Parent Age Group', 'ebook-store'),
        'parent_item_colon' => __('Parent Age Group:', 'ebook-store'),
        'edit_item' => __('Edit Age Group', 'ebook-store'),
        'update_item' => __('Update Age Group', 'ebook-store'),
        'add_new_item' => __('Add New Age Group', 'ebook-store'),
        'new_item_name' => __('New Age Group Name', 'ebook-store'),
        'menu_name' => __('Age Groups', 'ebook-store'),
    );
    
    $age_args = array(
        'hierarchical' => true,
        'labels' => $age_labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'age-group'),
    );
    register_taxonomy('age_group', array('books'), $age_args);
}
add_action('init', 'ebook_store_taxonomies');

// Add Meta Boxes for Book-Author Relationship
function ebook_store_add_meta_boxes() {
    add_meta_box(
        'book_author',
        __('Book Author', 'ebook-store'),
        'ebook_store_author_meta_box_callback',
        'books',
        'side',
        'default'
    );
    
    add_meta_box(
        'book_details',
        __('Book Details', 'ebook-store'),
        'ebook_store_details_meta_box_callback',
        'books',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'ebook_store_add_meta_boxes');

function ebook_store_author_meta_box_callback($post) {
    wp_nonce_field('ebook_store_save_meta_box_data', 'ebook_store_meta_box_nonce');
    
    $selected_author = get_post_meta($post->ID, '_book_author', true);
    
    $authors = get_posts(array(
        'post_type' => 'authors',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC'
    ));
    ?>
    <p>
        <label for="book_author_select"><?php _e('Select Author:', 'ebook-store'); ?></label>
        <select id="book_author_select" name="book_author_select" style="width: 100%;">
            <option value=""><?php _e('-- Select Author --', 'ebook-store'); ?></option>
            <?php foreach ($authors as $author): ?>
                <option value="<?php echo $author->ID; ?>" <?php selected($selected_author, $author->ID); ?>>
                    <?php echo esc_html($author->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>
    <?php
}

function ebook_store_details_meta_box_callback($post) {
    $price = get_post_meta($post->ID, '_book_price', true);
    $isbn = get_post_meta($post->ID, '_book_isbn', true);
    $download_link = get_post_meta($post->ID, '_book_download_link', true);
    $publication_date = get_post_meta($post->ID, '_book_publication_date', true);
    ?>
    <p>
        <label for="book_price"><?php _e('Price ($):', 'ebook-store'); ?></label>
        <input type="text" id="book_price" name="book_price" value="<?php echo esc_attr($price); ?>" style="width: 100%;">
    </p>
    <p>
        <label for="book_isbn"><?php _e('ISBN:', 'ebook-store'); ?></label>
        <input type="text" id="book_isbn" name="book_isbn" value="<?php echo esc_attr($isbn); ?>" style="width: 100%;">
    </p>
    <p>
        <label for="book_download_link"><?php _e('Download/Purchase Link:', 'ebook-store'); ?></label>
        <input type="url" id="book_download_link" name="book_download_link" value="<?php echo esc_url($download_link); ?>" style="width: 100%;">
    </p>
    <p>
        <label for="book_publication_date"><?php _e('Publication Date:', 'ebook-store'); ?></label>
        <input type="date" id="book_publication_date" name="book_publication_date" value="<?php echo esc_attr($publication_date); ?>" style="width: 100%;">
    </p>
    <?php
}

// Save Meta Box Data
function ebook_store_save_meta_box_data($post_id) {
    if (!isset($_POST['ebook_store_meta_box_nonce'])) {
        return;
    }
    
    if (!wp_verify_nonce($_POST['ebook_store_meta_box_nonce'], 'ebook_store_save_meta_box_data')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['book_author_select'])) {
        update_post_meta($post_id, '_book_author', sanitize_text_field($_POST['book_author_select']));
    }
    
    if (isset($_POST['book_price'])) {
        update_post_meta($post_id, '_book_price', sanitize_text_field($_POST['book_price']));
    }
    
    if (isset($_POST['book_isbn'])) {
        update_post_meta($post_id, '_book_isbn', sanitize_text_field($_POST['book_isbn']));
    }
    
    if (isset($_POST['book_download_link'])) {
        update_post_meta($post_id, '_book_download_link', esc_url_raw($_POST['book_download_link']));
    }
    
    if (isset($_POST['book_publication_date'])) {
        update_post_meta($post_id, '_book_publication_date', sanitize_text_field($_POST['book_publication_date']));
    }
}
add_action('save_post', 'ebook_store_save_meta_box_data');

// Enqueue Scripts and Styles
function ebook_store_enqueue_scripts() {
    // Enqueue CSS
    wp_enqueue_style('ebook-store-style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0');
    
    // Enqueue JavaScript
    wp_enqueue_script('ebook-store-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
    
    // Localize script for AJAX
    wp_localize_script('ebook-store-main', 'ebook_store_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ebook_store_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'ebook_store_enqueue_scripts');

// AJAX Search Handler
function ebook_store_ajax_search() {
    check_ajax_referer('ebook_store_nonce', 'nonce');
    
    $search_term = sanitize_text_field($_POST['search_term']);
    
    $args = array(
        'post_type' => array('books', 'authors'),
        's' => $search_term,
        'posts_per_page' => 10,
    );
    
    $query = new WP_Query($args);
    $results = array();
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $results[] = array(
                'title' => get_the_title(),
                'url' => get_permalink(),
                'type' => get_post_type(),
                'image' => get_the_post_thumbnail_url(get_the_ID(), 'thumbnail')
            );
        }
    }
    wp_reset_postdata();
    
    wp_send_json_success($results);
}
add_action('wp_ajax_ebook_store_search', 'ebook_store_ajax_search');
add_action('wp_ajax_nopriv_ebook_store_search', 'ebook_store_ajax_search');

// Register Widget Areas
function ebook_store_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'ebook-store'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here.', 'ebook-store'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'ebook_store_widgets_init');

// Custom Excerpt Length
function ebook_store_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'ebook_store_excerpt_length');