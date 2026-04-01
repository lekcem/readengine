<?php
/**
 * Section of the single.php template used to display the page content
 *
 * @package Pixel Ebook Store
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-container">
		<div class="entry-content">

			<h2><?php the_title(); ?></h2>

			<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pixel-ebook-store' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<div class="entry-meta footer-meta">
            <?php pixel_ebook_store_post_meta(); ?>
        </div><!-- .entry-meta -->
	</div><!-- .entry-container -->
</article><!-- #post-<?php the_ID(); ?> -->
