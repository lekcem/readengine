<?php
/**
 * Template part for displaying Gallery Format
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pixel Ebook Store
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class() ?> >

	<?php
		// Check if there is a gallery embedded in the post content
		$pixel_ebook_store_post_id = get_the_ID(); // Add this line to get the post ID
		$pixel_ebook_store_gallery_shortcode = get_post_gallery();

		if (!empty($pixel_ebook_store_gallery_shortcode)) {
			// Display the gallery
			echo '<div class="embedded-gallery">' . do_shortcode($pixel_ebook_store_gallery_shortcode) . '</div>';
		}
	?>

	<div class="entry-content">
		<header class="entry-header">
			<?php 
				pixel_ebook_store_entry_header();
				the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			?>
		</header>

		<div class="entry-meta">
			<?php pixel_ebook_store_post_meta(); ?>
		</div>
		
		<div class="entry-text">
			<?php
				$pixel_ebook_store_excerpt_limit = get_theme_mod('pixel_ebook_store_excerpt_limit', 50);
				echo "<p>" . wp_trim_words(get_the_excerpt(), $pixel_ebook_store_excerpt_limit) . "</p>";
			?>
		</div>

		<?php pixel_ebook_store_edit_link(); ?>

	</div>
	
</article>