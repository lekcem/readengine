<?php
//custom post types PROJECT #1
function ebook_post_types(){
	register_post_type('authors', array(
		'public' => true,
		'labels' => array(
			'name'=> "Authors",
			'add_new_item' => 'Add New Author',
 			'edit_item' => 'Edit Author',
 			'all_items' => 'All Authors',
 			'singular_name' => "Author"
		),
		'menu_icon' => 'dashicons-edit'
	));

	register_post_type('books', array(
		//'capability_type' => 'book',
		//'map_meta_cap'=> true,
		'public' => true,
		'labels' => array(
			'name'=> "Books",
			'add_new_item' => 'Add New Book',
 			'edit_item' => 'Edit Book',
 			'all_items' => 'All Books',
 			'singular_name' => "Book"
		),
		'menu_icon' => 'dashicons-book-alt'
	));

	register_post_type('genre', array(
		'public' => true,
		'labels' => array(
			'name'=> "Genre",
			'add_new_item' => 'Add New Genre',
 			'edit_item' => 'Edit Genre',
 			'all_items' => 'All Genres',
 			'singular_name' => "Genre"
		),
		'menu_icon' => 'dashicons-album'
	));
	
}

add_action('init', 'ebook_post_types');
?>