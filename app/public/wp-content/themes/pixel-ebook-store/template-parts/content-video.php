<?php

/**
 * Template part for displaying Video Format
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pixel Ebook Store
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class() ?> >

	<?php
		// Get the post ID
		$pixel_ebook_store_post_id = get_the_ID();

		// Check if there are videos embedded in the post content
		$pixel_ebook_store_post = get_post($pixel_ebook_store_post_id);
		$pixel_ebook_store_content = do_shortcode(apply_filters('the_content', $pixel_ebook_store_post->post_content));
		$pixel_ebook_store_embeds = get_media_embedded_in_content($pixel_ebook_store_content);

		if (!empty($pixel_ebook_store_embeds)) {
			// Loop through embedded media and display videos
			foreach ($pixel_ebook_store_embeds as $pixel_ebook_store_embed) {
				// Check if the embed code contains a video tag or specific video providers like YouTube or Vimeo
				if (strpos($pixel_ebook_store_embed, 'video') !== false || strpos($pixel_ebook_store_embed, 'youtube') !== false || strpos($pixel_ebook_store_embed, 'vimeo') !== false || strpos($pixel_ebook_store_embed, 'dailymotion') !== false || strpos($pixel_ebook_store_embed, 'vine') !== false || strpos($pixel_ebook_store_embed, 'wordPress.tv') !== false || strpos($pixel_ebook_store_embed, 'hulu') !== false) {
					?>
					<div class="custom-embedded-video">
						<div class="video-container">
							<?php echo $pixel_ebook_store_embed; ?>
						</div>
						<div class="video-comments">
							<?php
							// Add your comments section here
							comments_template(); // This will include the default WordPress comments template
							?>
						</div>
					</div>
					<?php
				}
			}
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