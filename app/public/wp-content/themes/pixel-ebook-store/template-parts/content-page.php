<?php
/**
 * The page.php template portion that displays the page content
 *
 * @package Pixel Ebook Store
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pixel-ebook-store' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php pixel_ebook_store_edit_link(); ?>
	
</article><!-- #post-<?php the_ID(); ?> -->
