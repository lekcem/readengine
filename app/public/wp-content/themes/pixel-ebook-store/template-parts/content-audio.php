<?php

/**
 * Template part for displaying Audio Format
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

		// Check if there are audio embedded in the post content
		$pixel_ebook_store_post = get_post($pixel_ebook_store_post_id);
		$pixel_ebook_store_content = do_shortcode(apply_filters('the_content', $pixel_ebook_store_post->post_content));
		$pixel_ebook_store_embeds = get_media_embedded_in_content($pixel_ebook_store_content);

		if (!empty($pixel_ebook_store_embeds)) {
			// Loop through embedded media and display only audio
			foreach ($pixel_ebook_store_embeds as $pixel_ebook_store_embed) {
				// Check if the embed code contains an audio tag or specific audio providers like SoundCloud
				if (strpos($pixel_ebook_store_embed, 'audio') !== false || strpos($pixel_ebook_store_embed, 'soundcloud') !== false) {
					?>
					<div class="custom-embedded-audio">
						<div class="media-container">
							<?php echo $pixel_ebook_store_embed; ?>
						</div>
						<div class="media-comments">
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