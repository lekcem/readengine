<?php

/**
 * Template part for displaying Image Format
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pixel Ebook Store
 */

?>
<?php
	$class = '';
	if(!has_post_thumbnail()){
		$class = 'no-thumbnail';
	}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $class . ' ' ) ?> >
	<figure class="featured-image">
		<a href="<?php the_permalink(); ?>">
			<?php pixel_ebook_store_image_size( 'pixel-ebook-store-1370-550' ) ?>
		</a>
	</figure>

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